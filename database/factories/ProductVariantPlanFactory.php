<?php

namespace Database\Factories;

use App\Models\ProductVariant;
use App\Models\ProductVariantPlan;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductVariantPlanFactory extends Factory
{
    protected $model = ProductVariantPlan::class;

    public function definition(): array
    {
        return [
            'filename' => 'plan-' . fake()->unique()->numberBetween(1, 1000) . '.jpg',
            'language' => 'lv',
            'product_variant_id' => ProductVariant::factory(),
        ];
    }
}
