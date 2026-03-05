<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductVariantFactory extends Factory
{
    protected $model = ProductVariant::class;

    public function definition(): array
    {
        $name = fake()->unique()->city();

        return [
            'slug' => Str::slug($name),
            'price_basic' => fake()->numberBetween(20000, 50000),
            'price_middle' => fake()->numberBetween(35000, 60000),
            'price_full' => fake()->numberBetween(50000, 80000),
            'product_id' => Product::factory(),
            'is_active' => true,
            'building_area' => fake()->randomFloat(2, 30, 250),
            'living_area' => fake()->randomFloat(2, 20, 200),
        ];
    }

    public function inactive(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_active' => false,
        ]);
    }

    public function withoutPrices(): static
    {
        return $this->state(fn (array $attributes) => [
            'price_basic' => 0,
            'price_middle' => 0,
            'price_full' => 0,
        ]);
    }
}
