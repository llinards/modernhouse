<?php

namespace Database\Factories;

use App\Models\ProductVariantOption;
use App\Models\ProductVariantOptionDetail;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductVariantOptionDetailFactory extends Factory
{
    protected $model = ProductVariantOptionDetail::class;

    public function definition(): array
    {
        return [
            'detail' => fake()->sentence(4),
            'has_in_basic' => fake()->boolean(60),
            'has_in_middle' => fake()->boolean(80),
            'has_in_full' => true,
            'product_variant_option_id' => ProductVariantOption::factory(),
            'order' => fake()->numberBetween(0, 10),
        ];
    }
}
