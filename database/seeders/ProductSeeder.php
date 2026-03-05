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
use Illuminate\Support\Facades\Storage;

class ProductSeeder extends Seeder
{
    /** @var array<int, array{name: string, icon: string, maxCount: int}> */
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

    /** @var int[][] */
    private array $palette = [
        [52, 73, 94],
        [39, 174, 96],
        [41, 128, 185],
        [142, 68, 173],
        [211, 84, 0],
        [22, 160, 133],
        [192, 57, 43],
        [44, 62, 80],
    ];

    private int $colorIndex = 0;

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
                'cover_photo_filename' => 'cover.jpg',
                'order' => $productData['order'],
            ]);

            $this->generatePlaceholderImage(
                "product-images/{$product->slug}/cover.jpg",
                $productData['name_lv'],
                1200,
                800,
            );

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

        $variantTranslation = TranslationsProductVariants::factory()->create([
            'product_variant_id' => $variant->id,
            'language' => 'lv',
        ]);

        TranslationsProductVariants::factory()->create([
            'product_variant_id' => $variant->id,
            'language' => 'en',
        ]);

        $basePath = "product-images/{$product->slug}/{$variant->slug}";

        $imageCount = fake()->numberBetween(2, 5);
        for ($i = 0; $i < $imageCount; $i++) {
            $filename = 'image-' . ($i + 1) . '.jpg';

            ProductVariantImage::factory()->create([
                'product_variant_id' => $variant->id,
                'filename' => $filename,
                'order' => $i,
            ]);

            $this->generatePlaceholderImage(
                "{$basePath}/{$filename}",
                $variantTranslation->name . ' #' . ($i + 1),
                1200,
                800,
            );
        }

        $planFilename = 'plan-1.jpg';

        ProductVariantPlan::factory()->create([
            'product_variant_id' => $variant->id,
            'filename' => $planFilename,
            'language' => 'lv',
        ]);

        $this->generatePlaceholderImage(
            "{$basePath}/plan/{$planFilename}",
            "Plan: {$variantTranslation->name}",
            1000,
            700,
            true,
        );

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

    private function generatePlaceholderImage(
        string $storagePath,
        string $label,
        int $width,
        int $height,
        bool $isPlan = false,
    ): void {
        $image = imagecreatetruecolor($width, $height);

        if ($isPlan) {
            $bg = imagecolorallocate($image, 245, 245, 245);
            $textColor = imagecolorallocate($image, 80, 80, 80);
            $lineColor = imagecolorallocate($image, 200, 200, 200);
        } else {
            $rgb = $this->palette[$this->colorIndex % count($this->palette)];
            $this->colorIndex++;
            $bg = imagecolorallocate($image, $rgb[0], $rgb[1], $rgb[2]);
            $textColor = imagecolorallocate($image, 255, 255, 255);
            $lineColor = imagecolorallocate($image, min($rgb[0] + 30, 255), min($rgb[1] + 30, 255), min($rgb[2] + 30, 255));
        }

        imagefill($image, 0, 0, $bg);

        if ($isPlan) {
            $this->drawPlanGrid($image, $width, $height, $lineColor);
        } else {
            $this->drawHouseOutline($image, $width, $height, $lineColor);
        }

        $fontSize = 5;
        $textWidth = imagefontwidth($fontSize) * strlen($label);
        $textHeight = imagefontheight($fontSize);
        $x = (int) (($width - $textWidth) / 2);
        $y = (int) (($height - $textHeight) / 2);

        imagestring($image, $fontSize, $x, $y, $label, $textColor);

        $dimensionLabel = "{$width}x{$height}";
        $dimWidth = imagefontwidth(3) * strlen($dimensionLabel);
        imagestring($image, 3, (int) (($width - $dimWidth) / 2), $y + $textHeight + 10, $dimensionLabel, $textColor);

        $directory = dirname($storagePath);
        Storage::disk('public')->makeDirectory($directory);

        $fullPath = Storage::disk('public')->path($storagePath);
        imagejpeg($image, $fullPath, 85);
        imagedestroy($image);
    }

    private function drawHouseOutline(\GdImage $image, int $width, int $height, int $color): void
    {
        $cx = (int) ($width / 2);
        $baseY = (int) ($height * 0.7);
        $topY = (int) ($height * 0.25);
        $houseWidth = (int) ($width * 0.3);

        imageline($image, $cx - $houseWidth, $baseY, $cx + $houseWidth, $baseY, $color);
        imageline($image, $cx - $houseWidth, $baseY, $cx - $houseWidth, (int) ($height * 0.4), $color);
        imageline($image, $cx + $houseWidth, $baseY, $cx + $houseWidth, (int) ($height * 0.4), $color);
        imageline($image, $cx - $houseWidth, (int) ($height * 0.4), $cx, $topY, $color);
        imageline($image, $cx + $houseWidth, (int) ($height * 0.4), $cx, $topY, $color);

        $doorW = (int) ($houseWidth * 0.3);
        $doorH = (int) (($baseY - $height * 0.4) * 0.6);
        imagerectangle($image, $cx - (int) ($doorW / 2), $baseY - $doorH, $cx + (int) ($doorW / 2), $baseY, $color);
    }

    private function drawPlanGrid(\GdImage $image, int $width, int $height, int $color): void
    {
        $spacing = 50;

        for ($x = $spacing; $x < $width; $x += $spacing) {
            imageline($image, $x, 0, $x, $height, $color);
        }

        for ($y = $spacing; $y < $height; $y += $spacing) {
            imageline($image, 0, $y, $width, $y, $color);
        }

        $margin = (int) ($width * 0.15);
        $thick = imagecolorallocate($image, 120, 120, 120);

        imagerectangle($image, $margin, $margin, $width - $margin, $height - $margin, $thick);
        imageline($image, (int) ($width * 0.5), $margin, (int) ($width * 0.5), $height - $margin, $thick);
        imageline($image, $margin, (int) ($height * 0.5), $width - $margin, (int) ($height * 0.5), $thick);
    }
}
