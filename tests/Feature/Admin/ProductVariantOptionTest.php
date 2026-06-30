<?php

use App\Http\Services\ProductVariantOptionService;
use App\Livewire\Admin\ProductVariantOptionList;
use App\Models\ProductVariant;
use App\Models\ProductVariantOption;
use App\Models\ProductVariantOptionDetail;
use App\Models\User;
use Livewire\Livewire;

beforeEach(function () {
    $this->user = User::factory()->create();
});

describe('ProductVariantOption model', function () {
    it('orders options by order column via global scope', function () {
        $variant = ProductVariant::factory()->create();

        ProductVariantOption::factory()->create([
            'product_variant_id' => $variant->id,
            'option_title' => 'Second',
            'order' => 1,
        ]);
        ProductVariantOption::factory()->create([
            'product_variant_id' => $variant->id,
            'option_title' => 'First',
            'order' => 0,
        ]);

        $options = ProductVariantOption::where('product_variant_id', $variant->id)->get();

        expect($options->first()->option_title)->toBe('First')
            ->and($options->last()->option_title)->toBe('Second');
    });

    it('orders option details by order column via global scope', function () {
        $option = ProductVariantOption::factory()->create();

        ProductVariantOptionDetail::factory()->create([
            'product_variant_option_id' => $option->id,
            'detail' => 'Second',
            'order' => 1,
        ]);
        ProductVariantOptionDetail::factory()->create([
            'product_variant_option_id' => $option->id,
            'detail' => 'First',
            'order' => 0,
        ]);

        $details = ProductVariantOptionDetail::where('product_variant_option_id', $option->id)->get();

        expect($details->first()->detail)->toBe('First')
            ->and($details->last()->detail)->toBe('Second');
    });

    it('deletes option details when the option is deleted', function () {
        $option = ProductVariantOption::factory()->create();
        $detail = ProductVariantOptionDetail::factory()->create([
            'product_variant_option_id' => $option->id,
        ]);

        $option->delete();

        expect(ProductVariantOptionDetail::find($detail->id))->toBeNull();
    });

    it('deletes options and their details when the variant is deleted', function () {
        $variant = ProductVariant::factory()->create();
        $option = ProductVariantOption::factory()->create(['product_variant_id' => $variant->id]);
        $detail = ProductVariantOptionDetail::factory()->create([
            'product_variant_option_id' => $option->id,
        ]);

        $variant->delete();

        expect(ProductVariantOption::find($option->id))->toBeNull()
            ->and(ProductVariantOptionDetail::find($detail->id))->toBeNull();
    });
});

describe('ProductVariantOptionService', function () {
    beforeEach(function () {
        $this->service = new ProductVariantOptionService();
        $this->variant = ProductVariant::factory()->create();
    });

    it('stores an option with the current locale as language', function () {
        $this->service->storeProductVariantOption($this->variant, 'Ārsienas');

        $option = ProductVariantOption::where('product_variant_id', $this->variant->id)->first();

        expect($option)->not->toBeNull()
            ->and($option->option_title)->toBe('Ārsienas')
            ->and($option->language)->toBe('lv');
    });

    it('stores an option detail with the given package flags', function () {
        $option = ProductVariantOption::factory()->create();

        $this->service->storeProductVariantOptionDetail($option, [
            'detail' => 'Concrete walls',
            'has_in_basic' => true,
            'has_in_middle' => true,
            'has_in_full' => true,
        ]);

        $detail = ProductVariantOptionDetail::where('product_variant_option_id', $option->id)->first();

        expect($detail->detail)->toBe('Concrete walls')
            ->and($detail->has_in_basic)->toBeTrue()
            ->and($detail->has_in_middle)->toBeTrue()
            ->and($detail->has_in_full)->toBeTrue();
    });

    it('defaults package flags to false when absent', function () {
        $option = ProductVariantOption::factory()->create();

        $this->service->storeProductVariantOptionDetail($option, ['detail' => 'Optional extra']);

        $detail = ProductVariantOptionDetail::where('product_variant_option_id', $option->id)->first();

        expect($detail->has_in_basic)->toBeFalse()
            ->and($detail->has_in_middle)->toBeFalse()
            ->and($detail->has_in_full)->toBeFalse();
    });

    it('stores a label detail', function () {
        $option = ProductVariantOption::factory()->create();

        $this->service->storeProductVariantOptionDetail($option, [
            'detail' => 'Ārējā apdare',
            'is_label' => true,
        ]);

        $detail = ProductVariantOptionDetail::where('product_variant_option_id', $option->id)->first();

        expect($detail->is_label)->toBeTrue()
            ->and($detail->has_in_basic)->toBeFalse();
    });

    it('assigns sequential order when storing options', function () {
        $this->service->storeProductVariantOption($this->variant, 'First');
        $this->service->storeProductVariantOption($this->variant, 'Second');

        $options = ProductVariantOption::where('product_variant_id', $this->variant->id)->get();

        expect($options->firstWhere('option_title', 'First')->order)->toBe(0)
            ->and($options->firstWhere('option_title', 'Second')->order)->toBe(1);
    });

    it('assigns sequential order when storing option details', function () {
        $option = ProductVariantOption::factory()->create();

        $this->service->storeProductVariantOptionDetail($option, ['detail' => 'First']);
        $this->service->storeProductVariantOptionDetail($option, ['detail' => 'Second']);

        $details = ProductVariantOptionDetail::where('product_variant_option_id', $option->id)->get();

        expect($details->firstWhere('detail', 'First')->order)->toBe(0)
            ->and($details->firstWhere('detail', 'Second')->order)->toBe(1);
    });

    it('updates an option title', function () {
        $option = ProductVariantOption::factory()->create(['option_title' => 'Old Title']);

        $this->service->updateProductVariantOption($option, 'New Title');

        expect($option->fresh()->option_title)->toBe('New Title');
    });

    it('updates an option detail name and toggles flags', function () {
        $detail = ProductVariantOptionDetail::factory()->create([
            'detail' => 'Old detail',
            'has_in_basic' => true,
            'has_in_middle' => true,
            'has_in_full' => true,
        ]);

        $this->service->updateProductVariantOptionDetail($detail, [
            'detail' => 'New detail',
            'has_in_full' => true,
        ]);

        $detail->refresh();

        expect($detail->detail)->toBe('New detail')
            ->and($detail->has_in_basic)->toBeFalse()
            ->and($detail->has_in_middle)->toBeFalse()
            ->and($detail->has_in_full)->toBeTrue();
    });

    it('destroys an option and cascade-deletes its details', function () {
        $option = ProductVariantOption::factory()->create();
        $detail = ProductVariantOptionDetail::factory()->create([
            'product_variant_option_id' => $option->id,
        ]);

        $this->service->destroyProductVariantOption($option);

        expect(ProductVariantOption::find($option->id))->toBeNull()
            ->and(ProductVariantOptionDetail::find($detail->id))->toBeNull();
    });

    it('destroys a single option detail', function () {
        $detail = ProductVariantOptionDetail::factory()->create();

        $this->service->destroyProductVariantOptionDetail($detail);

        expect(ProductVariantOptionDetail::find($detail->id))->toBeNull();
    });

    it('copies options and their details from another variant', function () {
        $source = ProductVariant::factory()->create();
        $option = ProductVariantOption::factory()->create([
            'product_variant_id' => $source->id,
            'option_title' => 'Walls',
            'language' => 'lv',
        ]);
        ProductVariantOptionDetail::factory()->create([
            'product_variant_option_id' => $option->id,
            'detail' => 'Heading',
            'is_label' => true,
            'order' => 0,
        ]);
        ProductVariantOptionDetail::factory()->create([
            'product_variant_option_id' => $option->id,
            'detail' => 'Concrete',
            'is_label' => false,
            'order' => 1,
        ]);

        $this->service->copyFromVariant($source, $this->variant, 'lv');

        $copied = ProductVariantOption::where('product_variant_id', $this->variant->id)->first();

        expect($copied->option_title)->toBe('Walls')
            ->and($copied->productVariantOptionDetails)->toHaveCount(2)
            ->and($copied->productVariantOptionDetails->firstWhere('detail', 'Heading')->is_label)->toBeTrue()
            ->and($copied->productVariantOptionDetails->firstWhere('detail', 'Concrete')->is_label)->toBeFalse();
    });

    it('only copies options in the given language', function () {
        $source = ProductVariant::factory()->create();
        ProductVariantOption::factory()->create(['product_variant_id' => $source->id, 'language' => 'lv']);
        ProductVariantOption::factory()->create(['product_variant_id' => $source->id, 'language' => 'en']);

        $this->service->copyFromVariant($source, $this->variant, 'lv');

        expect(ProductVariantOption::where('product_variant_id', $this->variant->id)->count())->toBe(1);
    });
});

describe('ProductVariantOptionList Livewire component', function () {
    beforeEach(function () {
        $this->variant = ProductVariant::factory()->create();
    });

    it('renders existing options filtered by language', function () {
        ProductVariantOption::factory()->create([
            'product_variant_id' => $this->variant->id,
            'option_title' => 'Latvian Option',
            'language' => 'lv',
        ]);
        ProductVariantOption::factory()->create([
            'product_variant_id' => $this->variant->id,
            'option_title' => 'English Option',
            'language' => 'en',
        ]);

        Livewire::actingAs($this->user)
            ->test(ProductVariantOptionList::class, ['productVariant' => $this->variant])
            ->assertSee('Latvian Option')
            ->assertDontSee('English Option');
    });

    it('stores an option', function () {
        Livewire::actingAs($this->user)
            ->test(ProductVariantOptionList::class, ['productVariant' => $this->variant])
            ->call('openOptionModal')
            ->set('optionForm.title', 'Ārsienas')
            ->call('storeOption')
            ->assertHasNoErrors();

        expect(ProductVariantOption::where('product_variant_id', $this->variant->id)
            ->where('option_title', 'Ārsienas')->exists())->toBeTrue();
    });

    it('validates the option title', function () {
        Livewire::actingAs($this->user)
            ->test(ProductVariantOptionList::class, ['productVariant' => $this->variant])
            ->call('storeOption')
            ->assertHasErrors('optionForm.title');
    });

    it('edits and updates an option', function () {
        $option = ProductVariantOption::factory()->create([
            'product_variant_id' => $this->variant->id,
            'option_title' => 'Old Title',
            'language' => 'lv',
        ]);

        Livewire::actingAs($this->user)
            ->test(ProductVariantOptionList::class, ['productVariant' => $this->variant])
            ->call('editOption', $option->id)
            ->assertSet('optionForm.title', 'Old Title')
            ->set('optionForm.title', 'New Title')
            ->call('updateOption')
            ->assertHasNoErrors();

        expect($option->fresh()->option_title)->toBe('New Title');
    });

    it('destroys an option', function () {
        $option = ProductVariantOption::factory()->create([
            'product_variant_id' => $this->variant->id,
            'language' => 'lv',
        ]);

        Livewire::actingAs($this->user)
            ->test(ProductVariantOptionList::class, ['productVariant' => $this->variant])
            ->call('destroyOption', $option->id);

        expect(ProductVariantOption::find($option->id))->toBeNull();
    });

    it('stores a detail with package flags under an option', function () {
        $option = ProductVariantOption::factory()->create([
            'product_variant_id' => $this->variant->id,
            'language' => 'lv',
        ]);

        Livewire::actingAs($this->user)
            ->test(ProductVariantOptionList::class, ['productVariant' => $this->variant])
            ->call('openDetailModal', $option->id)
            ->set('detailForm.detail', 'Concrete walls')
            ->set('detailForm.has_in_full', true)
            ->call('storeDetail')
            ->assertHasNoErrors();

        $detail = ProductVariantOptionDetail::where('product_variant_option_id', $option->id)->first();

        expect($detail->detail)->toBe('Concrete walls')
            ->and($detail->has_in_basic)->toBeFalse()
            ->and($detail->has_in_full)->toBeTrue();
    });

    it('stores a label detail', function () {
        $option = ProductVariantOption::factory()->create([
            'product_variant_id' => $this->variant->id,
            'language' => 'lv',
        ]);

        Livewire::actingAs($this->user)
            ->test(ProductVariantOptionList::class, ['productVariant' => $this->variant])
            ->call('openDetailModal', $option->id)
            ->set('detailForm.detail', 'Ārējā apdare')
            ->set('detailForm.is_label', true)
            ->call('storeDetail')
            ->assertHasNoErrors();

        expect(ProductVariantOptionDetail::where('product_variant_option_id', $option->id)
            ->where('is_label', true)->where('detail', 'Ārējā apdare')->exists())->toBeTrue();
    });

    it('validates the detail text', function () {
        $option = ProductVariantOption::factory()->create([
            'product_variant_id' => $this->variant->id,
            'language' => 'lv',
        ]);

        Livewire::actingAs($this->user)
            ->test(ProductVariantOptionList::class, ['productVariant' => $this->variant])
            ->call('openDetailModal', $option->id)
            ->call('storeDetail')
            ->assertHasErrors('detailForm.detail');
    });

    it('edits and updates a detail', function () {
        $option = ProductVariantOption::factory()->create([
            'product_variant_id' => $this->variant->id,
            'language' => 'lv',
        ]);
        $detail = ProductVariantOptionDetail::factory()->create([
            'product_variant_option_id' => $option->id,
            'detail' => 'Old detail',
        ]);

        Livewire::actingAs($this->user)
            ->test(ProductVariantOptionList::class, ['productVariant' => $this->variant])
            ->call('editDetail', $detail->id)
            ->assertSet('detailForm.detail', 'Old detail')
            ->set('detailForm.detail', 'New detail')
            ->call('updateDetail')
            ->assertHasNoErrors();

        expect($detail->fresh()->detail)->toBe('New detail');
    });

    it('destroys a detail', function () {
        $option = ProductVariantOption::factory()->create([
            'product_variant_id' => $this->variant->id,
            'language' => 'lv',
        ]);
        $detail = ProductVariantOptionDetail::factory()->create([
            'product_variant_option_id' => $option->id,
        ]);

        Livewire::actingAs($this->user)
            ->test(ProductVariantOptionList::class, ['productVariant' => $this->variant])
            ->call('destroyDetail', $detail->id);

        expect(ProductVariantOptionDetail::find($detail->id))->toBeNull();
    });

    it('copies options from another variant', function () {
        $source = ProductVariant::factory()->create();
        $option = ProductVariantOption::factory()->create([
            'product_variant_id' => $source->id,
            'language' => 'lv',
        ]);
        ProductVariantOptionDetail::factory()->create(['product_variant_option_id' => $option->id]);

        Livewire::actingAs($this->user)
            ->test(ProductVariantOptionList::class, ['productVariant' => $this->variant])
            ->set('copyFromVariantId', $source->id)
            ->call('copyFromVariant');

        expect(ProductVariantOption::where('product_variant_id', $this->variant->id)->count())->toBe(1);
    });

    it('shows a details-count badge and package-tier indicators', function () {
        $option = ProductVariantOption::factory()->create([
            'product_variant_id' => $this->variant->id,
            'language' => 'lv',
        ]);
        ProductVariantOptionDetail::factory()->create([
            'product_variant_option_id' => $option->id,
            'has_in_basic' => false,
            'has_in_middle' => false,
            'has_in_full' => true,
        ]);

        $html = Livewire::actingAs($this->user)
            ->test(ProductVariantOptionList::class, ['productVariant' => $this->variant])
            ->assertSeeHtml('class="badge bg-secondary">1</span>')
            ->html();

        expect($html)
            ->toMatch('/class="badge bg-light text-muted"\s+title="Bāzes komplektācija">Bāzes/')
            ->and($html)->toMatch('/class="badge bg-success"\s+title="Pilnā komplektācija">Pilnā/');
    });

    it('persists new order when reordering options', function () {
        $first = ProductVariantOption::factory()->create([
            'product_variant_id' => $this->variant->id,
            'order' => 0,
            'language' => 'lv',
        ]);
        $second = ProductVariantOption::factory()->create([
            'product_variant_id' => $this->variant->id,
            'order' => 1,
            'language' => 'lv',
        ]);

        Livewire::actingAs($this->user)
            ->test(ProductVariantOptionList::class, ['productVariant' => $this->variant])
            ->call('updateProductVariantOptionOrder', [
                ['value' => $second->id, 'order' => 0],
                ['value' => $first->id, 'order' => 1],
            ]);

        expect($second->fresh()->order)->toBe(0)
            ->and($first->fresh()->order)->toBe(1);
    });

    it('persists nested option and detail order when reordering details', function () {
        $option = ProductVariantOption::factory()->create([
            'product_variant_id' => $this->variant->id,
            'order' => 0,
            'language' => 'lv',
        ]);
        $firstDetail = ProductVariantOptionDetail::factory()->create([
            'product_variant_option_id' => $option->id,
            'order' => 0,
        ]);
        $secondDetail = ProductVariantOptionDetail::factory()->create([
            'product_variant_option_id' => $option->id,
            'order' => 1,
        ]);

        Livewire::actingAs($this->user)
            ->test(ProductVariantOptionList::class, ['productVariant' => $this->variant])
            ->call('updateProductVariantOptionDetailOrder', [
                [
                    'value' => $option->id,
                    'order' => 5,
                    'items' => [
                        ['value' => $secondDetail->id, 'order' => 0],
                        ['value' => $firstDetail->id, 'order' => 1],
                    ],
                ],
            ]);

        expect($option->fresh()->order)->toBe(5)
            ->and($secondDetail->fresh()->order)->toBe(0)
            ->and($firstDetail->fresh()->order)->toBe(1);
    });
});

describe('Product variant option routes', function () {
    beforeEach(function () {
        $this->variant = ProductVariant::factory()->create();
    });

    it('renders the options page with the Livewire component', function () {
        ProductVariantOption::factory()->create([
            'product_variant_id' => $this->variant->id,
            'language' => 'lv',
        ]);

        $this->actingAs($this->user)
            ->get(route('product-variant-options.index', ['locale' => 'lv', 'productVariant' => $this->variant->id]))
            ->assertSuccessful()
            ->assertSeeLivewire(ProductVariantOptionList::class)
            ->assertSee('Kopēt no cita varianta');
    });

    it('redirects guests away from the options page', function () {
        $this->get(route('product-variant-options.index', ['locale' => 'lv', 'productVariant' => $this->variant->id]))
            ->assertRedirect();
    });
});
