<?php

namespace Database\Factories;

use App\Models\ProductVariant;
use App\Models\ProductVariantImage;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductVariantImageFactory extends Factory
{
    protected $model = ProductVariantImage::class;

    public function definition(): array
    {
        return [
            'filename' => 'image-' . fake()->unique()->numberBetween(1, 1000) . '.jpg',
            'product_variant_id' => ProductVariant::factory(),
            'order' => fake()->numberBetween(0, 10),
        ];
    }
}
