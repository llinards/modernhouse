<?php

use App\Http\Requests\ProductVariantOptionDetailRequest;
use App\Http\Requests\ProductVariantOptionRequest;
use App\Http\Services\ProductVariantOptionService;
use App\Livewire\Admin\ProductVariantOptionList;
use App\Models\ProductVariant;
use App\Models\ProductVariantOption;
use App\Models\ProductVariantOptionDetail;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
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
        $this->service->storeProductVariantOption(ProductVariantOptionRequest::create('/', 'POST', [
            'id' => $this->variant->id,
            'product_variant_option' => 'Ārsienas',
        ]));

        $option = ProductVariantOption::where('product_variant_id', $this->variant->id)->first();

        expect($option)->not->toBeNull()
            ->and($option->option_title)->toBe('Ārsienas')
            ->and($option->language)->toBe('lv');
    });

    it('stores an option detail with package flags true when keys are present', function () {
        $option = ProductVariantOption::factory()->create();

        $this->service->storeProductVariantOptionDetail(ProductVariantOptionDetailRequest::create('/', 'POST', [
            'id' => $option->id,
            'product_variant_option_detail' => 'Concrete walls',
            'has_in_basic' => 'on',
            'has_in_middle' => 'on',
            'has_in_full' => 'on',
        ]));

        $detail = ProductVariantOptionDetail::where('product_variant_option_id', $option->id)->first();

        expect($detail->detail)->toBe('Concrete walls')
            ->and($detail->has_in_basic)->toBeTruthy()
            ->and($detail->has_in_middle)->toBeTruthy()
            ->and($detail->has_in_full)->toBeTruthy();
    });

    it('stores an option detail with flags false when checkbox keys are absent', function () {
        $option = ProductVariantOption::factory()->create();

        $this->service->storeProductVariantOptionDetail(ProductVariantOptionDetailRequest::create('/', 'POST', [
            'id' => $option->id,
            'product_variant_option_detail' => 'Optional extra',
        ]));

        $detail = ProductVariantOptionDetail::where('product_variant_option_id', $option->id)->first();

        expect($detail->has_in_basic)->toBeFalsy()
            ->and($detail->has_in_middle)->toBeFalsy()
            ->and($detail->has_in_full)->toBeFalsy();
    });

    it('assigns sequential order when storing options', function () {
        $this->service->storeProductVariantOption(ProductVariantOptionRequest::create('/', 'POST', [
            'id' => $this->variant->id,
            'product_variant_option' => 'First',
        ]));
        $this->service->storeProductVariantOption(ProductVariantOptionRequest::create('/', 'POST', [
            'id' => $this->variant->id,
            'product_variant_option' => 'Second',
        ]));

        $options = ProductVariantOption::where('product_variant_id', $this->variant->id)->get();

        expect($options->firstWhere('option_title', 'First')->order)->toBe(0)
            ->and($options->firstWhere('option_title', 'Second')->order)->toBe(1);
    });

    it('assigns sequential order when storing option details', function () {
        $option = ProductVariantOption::factory()->create();

        $this->service->storeProductVariantOptionDetail(ProductVariantOptionDetailRequest::create('/', 'POST', [
            'id' => $option->id,
            'product_variant_option_detail' => 'First',
        ]));
        $this->service->storeProductVariantOptionDetail(ProductVariantOptionDetailRequest::create('/', 'POST', [
            'id' => $option->id,
            'product_variant_option_detail' => 'Second',
        ]));

        $details = ProductVariantOptionDetail::where('product_variant_option_id', $option->id)->get();

        expect($details->firstWhere('detail', 'First')->order)->toBe(0)
            ->and($details->firstWhere('detail', 'Second')->order)->toBe(1);
    });

    it('updates an option title', function () {
        $option = ProductVariantOption::factory()->create(['option_title' => 'Old Title']);

        $this->service->updateProductVariantOption(ProductVariantOptionRequest::create('/', 'POST', [
            'id' => $option->id,
            'product_variant_option' => 'New Title',
        ]));

        expect($option->fresh()->option_title)->toBe('New Title');
    });

    it('throws when updating a non-existent option', function () {
        $this->service->updateProductVariantOption(ProductVariantOptionRequest::create('/', 'POST', [
            'id' => 999999,
            'product_variant_option' => 'Whatever',
        ]));
    })->throws(ModelNotFoundException::class);

    it('updates an option detail name and toggles flags', function () {
        $detail = ProductVariantOptionDetail::factory()->create([
            'detail' => 'Old detail',
            'has_in_basic' => true,
            'has_in_middle' => true,
            'has_in_full' => true,
        ]);

        $this->service->updateProductVariantOptionDetail(ProductVariantOptionDetailRequest::create('/', 'POST', [
            'id' => $detail->id,
            'product_variant_option_detail' => 'New detail',
            'has_in_full' => 'on',
        ]));

        $detail->refresh();

        expect($detail->detail)->toBe('New detail')
            ->and($detail->has_in_basic)->toBeFalsy()
            ->and($detail->has_in_middle)->toBeFalsy()
            ->and($detail->has_in_full)->toBeTruthy();
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

    it('destroys all options and details for a variant', function () {
        $option = ProductVariantOption::factory()->create(['product_variant_id' => $this->variant->id]);
        $detail = ProductVariantOptionDetail::factory()->create([
            'product_variant_option_id' => $option->id,
        ]);

        $this->service->destroyProductVariantOptions($this->variant);

        expect(ProductVariantOption::find($option->id))->toBeNull()
            ->and(ProductVariantOptionDetail::find($detail->id))->toBeNull();
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
            'detail' => 'Concrete',
        ]);

        $this->service->copyFromVariant($source, $this->variant, 'lv');

        $copied = ProductVariantOption::where('product_variant_id', $this->variant->id)->get();

        expect($copied)->toHaveCount(1)
            ->and($copied->first()->option_title)->toBe('Walls')
            ->and($copied->first()->productVariantOptionDetails)->toHaveCount(1)
            ->and($copied->first()->productVariantOptionDetails->first()->detail)->toBe('Concrete');
    });

    it('appends copied options after existing ones', function () {
        ProductVariantOption::factory()->create([
            'product_variant_id' => $this->variant->id,
            'option_title' => 'Existing',
            'order' => 0,
            'language' => 'lv',
        ]);

        $source = ProductVariant::factory()->create();
        ProductVariantOption::factory()->create([
            'product_variant_id' => $source->id,
            'option_title' => 'Copied',
            'order' => 0,
            'language' => 'lv',
        ]);

        $this->service->copyFromVariant($source, $this->variant, 'lv');

        $options = ProductVariantOption::where('product_variant_id', $this->variant->id)->get();

        expect($options)->toHaveCount(2)
            ->and($options->firstWhere('option_title', 'Existing')->order)->toBe(0)
            ->and($options->firstWhere('option_title', 'Copied')->order)->toBe(1);
    });

    it('only copies options in the given language', function () {
        $source = ProductVariant::factory()->create();
        ProductVariantOption::factory()->create([
            'product_variant_id' => $source->id,
            'language' => 'lv',
        ]);
        ProductVariantOption::factory()->create([
            'product_variant_id' => $source->id,
            'language' => 'en',
        ]);

        $this->service->copyFromVariant($source, $this->variant, 'lv');

        expect(ProductVariantOption::where('product_variant_id', $this->variant->id)->count())->toBe(1);
    });
});

describe('ProductVariantOptionList Livewire component', function () {
    beforeEach(function () {
        $this->variant = ProductVariant::factory()->create();
    });

    it('renders with existing options for the variant', function () {
        ProductVariantOption::factory()->create([
            'product_variant_id' => $this->variant->id,
            'option_title' => 'Visible Option',
            'language' => 'lv',
        ]);

        Livewire::actingAs($this->user)
            ->test(ProductVariantOptionList::class, ['productVariant' => $this->variant])
            ->assertSee('Visible Option');
    });

    it('renders a uniquely identified add-detail modal per option', function () {
        $first = ProductVariantOption::factory()->create([
            'product_variant_id' => $this->variant->id,
            'language' => 'lv',
        ]);
        $second = ProductVariantOption::factory()->create([
            'product_variant_id' => $this->variant->id,
            'language' => 'lv',
        ]);

        Livewire::actingAs($this->user)
            ->test(ProductVariantOptionList::class, ['productVariant' => $this->variant])
            ->assertSee('store-product-variant-option-detail-modal-'.$first->id)
            ->assertSee('store-product-variant-option-detail-modal-'.$second->id);
    });

    it('renders detail package checkboxes with a value that submits when checked', function () {
        $option = ProductVariantOption::factory()->create([
            'product_variant_id' => $this->variant->id,
            'language' => 'lv',
        ]);
        ProductVariantOptionDetail::factory()->create([
            'product_variant_option_id' => $option->id,
        ]);

        $html = Livewire::actingAs($this->user)
            ->test(ProductVariantOptionList::class, ['productVariant' => $this->variant])
            ->html();

        // Each field renders in the add-detail modal and the edit-detail modal;
        // both must submit value="1" so a checked box persists as true.
        foreach (['has_in_basic', 'has_in_middle', 'has_in_full'] as $field) {
            expect(preg_match_all('/name="'.$field.'"\s+value="1"/', $html))->toBe(2);
        }
    });

    it('shows a details-count badge on each option row', function () {
        $option = ProductVariantOption::factory()->create([
            'product_variant_id' => $this->variant->id,
            'language' => 'lv',
        ]);
        ProductVariantOptionDetail::factory()->count(2)->create([
            'product_variant_option_id' => $option->id,
        ]);

        Livewire::actingAs($this->user)
            ->test(ProductVariantOptionList::class, ['productVariant' => $this->variant])
            ->assertSeeHtml('class="badge bg-secondary">2</span>');
    });

    it('shows package-tier indicators on detail rows', function () {
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
            ->html();

        expect($html)
            ->toMatch('/class="badge bg-light text-muted"\s+title="Bāzes komplektācija">Bāzes/')
            ->and($html)->toMatch('/class="badge bg-success"\s+title="Pilnā komplektācija">Pilnā/');
    });

    it('renders a collapse target for each option', function () {
        $option = ProductVariantOption::factory()->create([
            'product_variant_id' => $this->variant->id,
            'language' => 'lv',
        ]);

        Livewire::actingAs($this->user)
            ->test(ProductVariantOptionList::class, ['productVariant' => $this->variant])
            ->assertSee('option-details-'.$option->id);
    });

    it('filters options by the current language on mount', function () {
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
            ->assertSee('Kopēt opcijas no cita varianta');
    });

    it('redirects guests away from the options page', function () {
        $this->get(route('product-variant-options.index', ['locale' => 'lv', 'productVariant' => $this->variant->id]))
            ->assertRedirect();
    });

    it('stores an option via the store route', function () {
        $this->actingAs($this->user)
            ->post(route('product-variant-options.store-product-variant-option', ['locale' => 'lv']), [
                'id' => $this->variant->id,
                'product_variant_option' => 'Ārsienas',
            ])
            ->assertRedirect()
            ->assertSessionHas('success');

        expect(ProductVariantOption::where('product_variant_id', $this->variant->id)
            ->where('option_title', 'Ārsienas')
            ->exists())->toBeTrue();
    });

    it('validates the required option title on store', function () {
        $this->actingAs($this->user)
            ->post(route('product-variant-options.store-product-variant-option', ['locale' => 'lv']), [
                'id' => $this->variant->id,
            ])
            ->assertSessionHasErrors('product_variant_option');
    });

    it('updates an option via the update route', function () {
        $option = ProductVariantOption::factory()->create([
            'product_variant_id' => $this->variant->id,
            'option_title' => 'Old Title',
        ]);

        $this->actingAs($this->user)
            ->patch(route('product-variant-options.update-product-variant-option', [
                'locale' => 'lv',
                'productVariantOption' => $option->id,
            ]), [
                'id' => $option->id,
                'product_variant_option' => 'New Title',
            ])
            ->assertRedirect()
            ->assertSessionHas('success');

        expect($option->fresh()->option_title)->toBe('New Title');
    });

    it('stores an option detail via the store-detail route', function () {
        $option = ProductVariantOption::factory()->create(['product_variant_id' => $this->variant->id]);

        $this->actingAs($this->user)
            ->post(route('product-variant-options.store-product-variant-option-detail', ['locale' => 'lv']), [
                'id' => $option->id,
                'product_variant_option_detail' => 'Concrete walls',
                'has_in_full' => 'on',
            ])
            ->assertRedirect()
            ->assertSessionHas('success');

        $detail = ProductVariantOptionDetail::where('product_variant_option_id', $option->id)->first();

        expect($detail->detail)->toBe('Concrete walls')
            ->and($detail->has_in_basic)->toBeFalsy()
            ->and($detail->has_in_full)->toBeTruthy();
    });

    it('updates an option detail via the update-detail route', function () {
        $detail = ProductVariantOptionDetail::factory()->create(['detail' => 'Old detail']);

        $this->actingAs($this->user)
            ->patch(route('product-variant-options.update-product-variant-option-detail', [
                'locale' => 'lv',
                'productVariantOptionDetail' => $detail->id,
            ]), [
                'id' => $detail->id,
                'product_variant_option_detail' => 'New detail',
            ])
            ->assertRedirect()
            ->assertSessionHas('success');

        expect($detail->fresh()->detail)->toBe('New detail');
    });

    it('destroys a single option via the route', function () {
        $option = ProductVariantOption::factory()->create(['product_variant_id' => $this->variant->id]);

        $this->actingAs($this->user)
            ->delete(route('product-variant-options.destroy-product-variant-option', [
                'locale' => 'lv',
                'productVariantOption' => $option->id,
            ]))
            ->assertRedirect()
            ->assertSessionHas('success');

        expect(ProductVariantOption::find($option->id))->toBeNull();
    });

    it('destroys a single option detail via the route', function () {
        $detail = ProductVariantOptionDetail::factory()->create();

        $this->actingAs($this->user)
            ->delete(route('product-variant-options.destroy-product-variant-option-detail', [
                'locale' => 'lv',
                'productVariantOptionDetail' => $detail->id,
            ]))
            ->assertRedirect()
            ->assertSessionHas('success');

        expect(ProductVariantOptionDetail::find($detail->id))->toBeNull();
    });

    it('destroys all options for a variant via the route', function () {
        $option = ProductVariantOption::factory()->create(['product_variant_id' => $this->variant->id]);
        $detail = ProductVariantOptionDetail::factory()->create([
            'product_variant_option_id' => $option->id,
        ]);

        $this->actingAs($this->user)
            ->delete(route('product-variant-options.destroy', [
                'locale' => 'lv',
                'productVariant' => $this->variant->id,
            ]))
            ->assertRedirect()
            ->assertSessionHas('success');

        expect(ProductVariantOption::find($option->id))->toBeNull()
            ->and(ProductVariantOptionDetail::find($detail->id))->toBeNull();
    });

    it('copies options from another variant via the copy route', function () {
        $source = ProductVariant::factory()->create();
        $option = ProductVariantOption::factory()->create([
            'product_variant_id' => $source->id,
            'language' => 'lv',
        ]);
        ProductVariantOptionDetail::factory()->create(['product_variant_option_id' => $option->id]);

        $this->actingAs($this->user)
            ->post(route('product-variant-options.copy', ['locale' => 'lv', 'productVariant' => $this->variant->id]), [
                'source_variant_id' => $source->id,
            ])
            ->assertRedirect()
            ->assertSessionHas('success');

        $copied = ProductVariantOption::where('product_variant_id', $this->variant->id)->get();

        expect($copied)->toHaveCount(1)
            ->and($copied->first()->productVariantOptionDetails)->toHaveCount(1);
    });

    it('validates the source variant on copy', function () {
        $this->actingAs($this->user)
            ->post(route('product-variant-options.copy', ['locale' => 'lv', 'productVariant' => $this->variant->id]), [])
            ->assertSessionHasErrors('source_variant_id');
    });
});
