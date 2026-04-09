<?php

use App\Http\Services\ProductVariantDetailService;
use App\Models\ProductVariant;
use App\Models\ProductVariantDetail;
use App\Models\ProductVariantDetailIcon;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;

beforeEach(function () {
    $this->user = User::factory()->create();
});

describe('ProductVariantDetail model', function () {
    it('orders details by order column via global scope', function () {
        $variant = ProductVariant::factory()->create();

        ProductVariantDetail::factory()->create([
            'product_variant_id' => $variant->id,
            'name' => 'Second',
            'order' => 1,
        ]);
        ProductVariantDetail::factory()->create([
            'product_variant_id' => $variant->id,
            'name' => 'First',
            'order' => 0,
        ]);

        $details = ProductVariantDetail::where('product_variant_id', $variant->id)->get();

        expect($details->first()->name)->toBe('First')
            ->and($details->last()->name)->toBe('Second');
    });
});

describe('ProductVariantDetailService', function () {
    beforeEach(function () {
        $this->service = new ProductVariantDetailService();
        $this->variant = ProductVariant::factory()->create();
        Storage::fake('public');
    });

    it('stores a detail with an existing icon', function () {
        $detail = $this->service->store($this->variant, [
            'name' => 'Guļamistabas',
            'hasThis' => true,
            'count' => 3,
            'icon' => 'bed',
        ]);

        expect($detail)->toBeInstanceOf(ProductVariantDetail::class)
            ->and($detail->name)->toBe('Guļamistabas')
            ->and($detail->hasThis)->toBeTruthy()
            ->and($detail->count)->toBe(3)
            ->and($detail->icon)->toBe('bed')
            ->and($detail->language)->toBe('lv')
            ->and($detail->product_variant_id)->toBe($this->variant->id);
    });

    it('stores a detail with a new icon upload', function () {
        $file = UploadedFile::fake()->create('custom.svg', 1, 'image/svg+xml');

        $detail = $this->service->store($this->variant, [
            'name' => 'Custom',
            'hasThis' => false,
            'count' => 1,
            'newIcon' => $file,
        ]);

        expect($detail->icon)->toBe('custom')
            ->and(ProductVariantDetailIcon::where('name', 'custom.svg')->exists())->toBeTrue();
        Storage::disk('public')->assertExists('icons/product-variant-detail-icons/custom.svg');
    });

    it('assigns sequential order when storing', function () {
        $this->service->store($this->variant, [
            'name' => 'First',
            'hasThis' => true,
            'count' => 1,
            'icon' => 'bed',
        ]);
        $second = $this->service->store($this->variant, [
            'name' => 'Second',
            'hasThis' => true,
            'count' => 2,
            'icon' => 'leaf',
        ]);

        expect($second->order)->toBe(1);
    });

    it('updates a detail', function () {
        $detail = ProductVariantDetail::factory()->create([
            'product_variant_id' => $this->variant->id,
            'name' => 'Old Name',
            'count' => 1,
        ]);

        $updated = $this->service->update($detail, [
            'name' => 'New Name',
            'hasThis' => false,
            'count' => 5,
            'icon' => 'leaf',
        ]);

        expect($updated->name)->toBe('New Name')
            ->and($updated->count)->toBe(5)
            ->and($updated->icon)->toBe('leaf');
    });

    it('updates a detail with a new icon upload', function () {
        $detail = ProductVariantDetail::factory()->create([
            'product_variant_id' => $this->variant->id,
        ]);
        $file = UploadedFile::fake()->create('new-icon.svg', 1, 'image/svg+xml');

        $updated = $this->service->update($detail, [
            'name' => $detail->name,
            'hasThis' => $detail->hasThis,
            'count' => $detail->count,
            'newIcon' => $file,
        ]);

        expect($updated->icon)->toBe('new-icon')
            ->and(ProductVariantDetailIcon::where('name', 'new-icon.svg')->exists())->toBeTrue();
        Storage::disk('public')->assertExists('icons/product-variant-detail-icons/new-icon.svg');
    });

    it('destroys a detail', function () {
        $detail = ProductVariantDetail::factory()->create([
            'product_variant_id' => $this->variant->id,
        ]);

        $this->service->destroy($detail);

        expect(ProductVariantDetail::find($detail->id))->toBeNull();
    });

    it('reorders details', function () {
        $first = ProductVariantDetail::factory()->create([
            'product_variant_id' => $this->variant->id,
            'order' => 0,
        ]);
        $second = ProductVariantDetail::factory()->create([
            'product_variant_id' => $this->variant->id,
            'order' => 1,
        ]);

        $this->service->reorder([$second->id, $first->id]);

        expect($second->fresh()->order)->toBe(0)
            ->and($first->fresh()->order)->toBe(1);
    });

    it('destroys an unused icon', function () {
        $icon = ProductVariantDetailIcon::factory()->create(['name' => 'unused.svg']);
        Storage::disk('public')->put('icons/product-variant-detail-icons/unused.svg', 'fake');

        $result = $this->service->destroyIcon($icon);

        expect($result)->toBeTrue()
            ->and(ProductVariantDetailIcon::find($icon->id))->toBeNull();
        Storage::disk('public')->assertMissing('icons/product-variant-detail-icons/unused.svg');
    });

    it('refuses to destroy an icon in use', function () {
        $icon = ProductVariantDetailIcon::factory()->create(['name' => 'bed.svg']);
        ProductVariantDetail::factory()->create([
            'product_variant_id' => $this->variant->id,
            'icon' => 'bed',
        ]);

        $result = $this->service->destroyIcon($icon);

        expect($result)->toBeFalse()
            ->and(ProductVariantDetailIcon::find($icon->id))->not->toBeNull();
    });

    it('copies details from one variant to another', function () {
        $source = ProductVariant::factory()->create();
        ProductVariantDetail::factory()->create([
            'product_variant_id' => $source->id,
            'name' => 'Bedrooms',
            'icon' => 'bed',
            'count' => 3,
            'language' => 'lv',
            'order' => 0,
        ]);
        ProductVariantDetail::factory()->create([
            'product_variant_id' => $source->id,
            'name' => 'Bathrooms',
            'icon' => 'bathtub',
            'count' => 1,
            'language' => 'lv',
            'order' => 1,
        ]);
        // Different language — should NOT be copied
        ProductVariantDetail::factory()->create([
            'product_variant_id' => $source->id,
            'name' => 'Bedrooms EN',
            'language' => 'en',
        ]);

        $this->service->copyFromVariant($source, $this->variant, 'lv');

        $copied = ProductVariantDetail::where('product_variant_id', $this->variant->id)
            ->where('language', 'lv')
            ->get();

        expect($copied)->toHaveCount(2)
            ->and($copied->first()->name)->toBe('Bedrooms')
            ->and($copied->last()->name)->toBe('Bathrooms');
    });

    it('appends copied details after existing ones', function () {
        ProductVariantDetail::factory()->create([
            'product_variant_id' => $this->variant->id,
            'name' => 'Existing',
            'order' => 0,
            'language' => 'lv',
        ]);

        $source = ProductVariant::factory()->create();
        ProductVariantDetail::factory()->create([
            'product_variant_id' => $source->id,
            'name' => 'Copied',
            'order' => 0,
            'language' => 'lv',
        ]);

        $this->service->copyFromVariant($source, $this->variant, 'lv');

        $details = ProductVariantDetail::where('product_variant_id', $this->variant->id)
            ->where('language', 'lv')
            ->get();

        expect($details)->toHaveCount(2)
            ->and($details->first()->name)->toBe('Existing')
            ->and($details->first()->order)->toBe(0)
            ->and($details->last()->name)->toBe('Copied')
            ->and($details->last()->order)->toBe(1);
    });
});

describe('ProductVariantDetailList Livewire component', function () {
    beforeEach(function () {
        $this->variant = ProductVariant::factory()->create();
        Storage::fake('public');
    });

    it('renders with existing details', function () {
        $detail = ProductVariantDetail::factory()->create([
            'product_variant_id' => $this->variant->id,
            'name' => 'Guļamistabas',
            'language' => 'lv',
        ]);

        Livewire::actingAs($this->user)
            ->test(\App\Livewire\Admin\ProductVariantDetailList::class, ['productVariant' => $this->variant])
            ->assertSee('Guļamistabas');
    });

    it('stores a new detail', function () {
        ProductVariantDetailIcon::factory()->create(['name' => 'bed.svg']);

        Livewire::actingAs($this->user)
            ->test(\App\Livewire\Admin\ProductVariantDetailList::class, ['productVariant' => $this->variant])
            ->set('form.name', 'Guļamistabas')
            ->set('form.hasThis', true)
            ->set('form.count', 3)
            ->set('form.icon', 'bed')
            ->call('store')
            ->assertHasNoErrors();

        expect(ProductVariantDetail::where('product_variant_id', $this->variant->id)->count())->toBe(1);
    });

    it('validates required fields on store', function () {
        Livewire::actingAs($this->user)
            ->test(\App\Livewire\Admin\ProductVariantDetailList::class, ['productVariant' => $this->variant])
            ->call('store')
            ->assertHasErrors(['form.name']);
    });

    it('updates an existing detail', function () {
        $detail = ProductVariantDetail::factory()->create([
            'product_variant_id' => $this->variant->id,
            'name' => 'Old Name',
            'language' => 'lv',
        ]);

        Livewire::actingAs($this->user)
            ->test(\App\Livewire\Admin\ProductVariantDetailList::class, ['productVariant' => $this->variant])
            ->call('edit', $detail->id)
            ->set('form.name', 'New Name')
            ->call('update')
            ->assertHasNoErrors();

        expect($detail->fresh()->name)->toBe('New Name');
    });

    it('deletes a detail', function () {
        $detail = ProductVariantDetail::factory()->create([
            'product_variant_id' => $this->variant->id,
            'language' => 'lv',
        ]);

        Livewire::actingAs($this->user)
            ->test(\App\Livewire\Admin\ProductVariantDetailList::class, ['productVariant' => $this->variant])
            ->call('destroy', $detail->id)
            ->assertHasNoErrors();

        expect(ProductVariantDetail::find($detail->id))->toBeNull();
    });

    it('reorders details', function () {
        $first = ProductVariantDetail::factory()->create([
            'product_variant_id' => $this->variant->id,
            'order' => 0,
            'language' => 'lv',
        ]);
        $second = ProductVariantDetail::factory()->create([
            'product_variant_id' => $this->variant->id,
            'order' => 1,
            'language' => 'lv',
        ]);

        Livewire::actingAs($this->user)
            ->test(\App\Livewire\Admin\ProductVariantDetailList::class, ['productVariant' => $this->variant])
            ->call('updateDetailOrder', [
                ['value' => $second->id, 'order' => 0],
                ['value' => $first->id, 'order' => 1],
            ]);

        expect($second->fresh()->order)->toBe(0)
            ->and($first->fresh()->order)->toBe(1);
    });

    it('copies details from another variant', function () {
        $source = ProductVariant::factory()->create();
        ProductVariantDetail::factory()->create([
            'product_variant_id' => $source->id,
            'name' => 'Copied Detail',
            'language' => 'lv',
        ]);

        Livewire::actingAs($this->user)
            ->test(\App\Livewire\Admin\ProductVariantDetailList::class, ['productVariant' => $this->variant])
            ->set('copyFromVariantId', $source->id)
            ->call('copyFromVariant')
            ->assertHasNoErrors();

        expect(ProductVariantDetail::where('product_variant_id', $this->variant->id)->count())->toBe(1);
    });

    it('stores a detail with a new icon upload', function () {
        $file = UploadedFile::fake()->create('pool.svg', 1, 'image/svg+xml');

        Livewire::actingAs($this->user)
            ->test(\App\Livewire\Admin\ProductVariantDetailList::class, ['productVariant' => $this->variant])
            ->set('form.name', 'Baseins')
            ->set('form.hasThis', true)
            ->set('form.count', 1)
            ->set('form.newIcon', $file)
            ->call('store')
            ->assertHasNoErrors();

        $detail = ProductVariantDetail::where('product_variant_id', $this->variant->id)->first();

        expect($detail->icon)->toBe('pool')
            ->and(ProductVariantDetailIcon::where('name', 'pool.svg')->exists())->toBeTrue();
    });
});

describe('Product variant details page', function () {
    beforeEach(function () {
        $this->product = \App\Models\Product::factory()->create();
        $this->variant = ProductVariant::factory()->create(['product_id' => $this->product->id]);
        \App\Models\TranslationsProductVariants::factory()->create([
            'product_variant_id' => $this->variant->id,
            'language' => 'lv',
        ]);
    });

    it('shows a link to the details page on the variant edit page', function () {
        $this->actingAs($this->user)
            ->get("/admin/lv/product-variant/{$this->variant->id}/edit")
            ->assertSuccessful()
            ->assertSee('product-variant-details');
    });

    it('renders the details page with the Livewire component', function () {
        $this->actingAs($this->user)
            ->get("/admin/lv/product-variant/{$this->variant->id}/product-variant-details")
            ->assertSuccessful()
            ->assertSeeLivewire(\App\Livewire\Admin\ProductVariantDetailList::class);
    });
});
