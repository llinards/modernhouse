<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductVariantDetail;
use App\Models\ProductVariantImage;
use App\Models\ProductVariantOption;
use App\Models\ProductVariantOptionDetail;
use App\Models\ProductVariantPlan;
use App\Models\TranslationsProduct;
use App\Models\TranslationsProductVariants;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /** @var array<int, array{name: string, icon: string}> */
    private array $detailTypes = [
        ['name' => 'Guļamistabas', 'icon' => 'bed', 'maxCount' => 3],
        ['name' => 'Viesistaba ar virtuves zonu', 'icon' => 'fork-knife', 'maxCount' => 1],
        ['name' => 'Vannas istaba', 'icon' => 'bathtub', 'maxCount' => 2],
        ['name' => 'Lofts', 'icon' => 'ladder-simple', 'maxCount' => 1],
        ['name' => 'Sauna', 'icon' => 'leaf', 'maxCount' => 1],
        ['name' => 'Terase', 'icon' => 'selection-plus', 'maxCount' => 1],
    ];

    /** @var string[] */
    private array $optionCategories = [
        'Ārsienas', 'Iekšējās sienas', 'Grīda', 'Jumts',
        'Logi un durvis', 'Apkure', 'Elektroinstalācija', 'Santehnika',
    ];

    public function run(): void
    {
        $products = [
            ['slug' => 'modulu-majas', 'name_lv' => 'Moduļu mājas', 'name_en' => 'Modular Houses', 'variants' => 3, 'order' => 1],
            ['slug' => 'dvinu-majas', 'name_lv' => 'Dvīņu mājas', 'name_en' => 'Twin Houses', 'variants' => 1, 'order' => 2],
            ['slug' => 'privatmajas', 'name_lv' => 'Privātmājas', 'name_en' => 'Private Houses', 'variants' => 1, 'order' => 3],
        ];

        foreach ($products as $productData) {
            $product = Product::factory()->create([
                'slug' => $productData['slug'],
                'order' => $productData['order'],
            ]);

            TranslationsProduct::factory()->create([
                'product_id' => $product->id,
                'name' => $productData['name_lv'],
                'language' => 'lv',
            ]);

            TranslationsProduct::factory()->create([
                'product_id' => $product->id,
                'name' => $productData['name_en'],
                'language' => 'en',
            ]);

            for ($i = 0; $i < $productData['variants']; $i++) {
                $this->createVariant($product);
            }
        }
    }

    private function createVariant(Product $product): void
    {
        $variant = ProductVariant::factory()->create([
            'product_id' => $product->id,
        ]);

        TranslationsProductVariants::factory()->create([
            'product_variant_id' => $variant->id,
            'language' => 'lv',
        ]);

        TranslationsProductVariants::factory()->create([
            'product_variant_id' => $variant->id,
            'language' => 'en',
        ]);

        ProductVariantImage::factory()
            ->count(fake()->numberBetween(2, 5))
            ->sequence(fn ($sequence) => ['order' => $sequence->index])
            ->create(['product_variant_id' => $variant->id]);

        ProductVariantPlan::factory()->create([
            'product_variant_id' => $variant->id,
            'language' => 'lv',
        ]);

        foreach ($this->detailTypes as $detailType) {
            $hasThis = fake()->boolean(70);

            ProductVariantDetail::factory()->create([
                'product_variant_id' => $variant->id,
                'name' => $detailType['name'],
                'icon' => $detailType['icon'],
                'hasThis' => $hasThis,
                'count' => $hasThis ? fake()->numberBetween(1, $detailType['maxCount']) : 0,
                'language' => 'lv',
            ]);
        }

        $selectedCategories = fake()->randomElements(
            $this->optionCategories,
            fake()->numberBetween(3, 6)
        );

        foreach ($selectedCategories as $index => $category) {
            $option = ProductVariantOption::factory()->create([
                'product_variant_id' => $variant->id,
                'option_title' => $category,
                'language' => 'lv',
                'order' => $index,
            ]);

            ProductVariantOptionDetail::factory()
                ->count(fake()->numberBetween(3, 8))
                ->sequence(fn ($sequence) => ['order' => $sequence->index])
                ->create(['product_variant_option_id' => $option->id]);
        }
    }
}
