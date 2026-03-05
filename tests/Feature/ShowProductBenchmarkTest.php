<?php

use App\Livewire\ShowProduct;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductVariantAttachment;
use App\Models\ProductVariantDetail;
use App\Models\ProductVariantImage;
use App\Models\ProductVariantOption;
use App\Models\ProductVariantOptionDetail;
use App\Models\ProductVariantPlan;
use App\Models\TranslationsProduct;
use App\Models\TranslationsProductVariants;
use Illuminate\Support\Facades\DB;
use Livewire\Livewire;

beforeEach(function () {
    app()->setLocale('lv');

    $this->product = Product::factory()->create(['slug' => 'bench-product']);

    TranslationsProduct::factory()->create([
        'product_id' => $this->product->id,
        'name' => 'Benchmark produkts',
        'language' => 'lv',
    ]);

    // Create 5 variants with full relationship trees
    $this->variants = collect();
    for ($i = 1; $i <= 5; $i++) {
        $variant = ProductVariant::factory()->create([
            'product_id' => $this->product->id,
            'slug' => "variant-{$i}",
        ]);

        TranslationsProductVariants::factory()->create([
            'product_variant_id' => $variant->id,
            'name' => "Variants {$i}",
            'description' => "<p>Apraksts {$i}</p>",
            'language' => 'lv',
        ]);

        ProductVariantImage::factory()->count(4)->create(['product_variant_id' => $variant->id]);
        ProductVariantDetail::factory()->count(6)->create(['product_variant_id' => $variant->id, 'language' => 'lv']);
        ProductVariantPlan::factory()->create(['product_variant_id' => $variant->id, 'language' => 'lv']);
        ProductVariantAttachment::factory()->create(['product_variant_id' => $variant->id, 'language' => 'lv']);

        $option = ProductVariantOption::factory()->create([
            'product_variant_id' => $variant->id,
            'language' => 'lv',
        ]);
        ProductVariantOptionDetail::factory()->count(5)->create([
            'product_variant_option_id' => $option->id,
        ]);

        $this->variants->push($variant);
    }
});

it('BENCHMARK: mount + switch queries and time', function () {
    // --- Mount benchmark ---
    DB::enableQueryLog();
    $startMount = microtime(true);

    $component = Livewire::test(ShowProduct::class, [
        'product' => $this->product,
    ]);

    $mountTime = round((microtime(true) - $startMount) * 1000, 2);
    $mountQueries = collect(DB::getQueryLog());
    DB::flushQueryLog();

    // --- Switch benchmark ---
    $startSwitch = microtime(true);

    $component->call('switchProductVariant', 'variant-3');

    $switchTime = round((microtime(true) - $startSwitch) * 1000, 2);
    $switchQueries = collect(DB::getQueryLog());
    DB::disableQueryLog();

    // Output results
    echo "\n";
    echo "=== SHOWPRODUCT BENCHMARK ===\n";
    echo "Product with 5 variants, each having 4 images, 6 details, 1 plan, 1 attachment, 1 option with 5 details\n";
    echo "\n";
    echo "MOUNT:\n";
    echo "  Queries: {$mountQueries->count()}\n";
    echo "  Time:    {$mountTime}ms\n";
    echo "\n";
    echo "SWITCH VARIANT:\n";
    echo "  Queries: {$switchQueries->count()}\n";
    echo "  Time:    {$switchTime}ms\n";
    echo "\n";
    echo "TOTAL: " . ($mountQueries->count() + $switchQueries->count()) . " queries\n";
    echo "=============================\n";

    expect(true)->toBeTrue();
});
