<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\TranslationsProduct;
use Illuminate\Database\Eloquent\Factories\Factory;

class TranslationsProductFactory extends Factory
{
    protected $model = TranslationsProduct::class;

    public function definition(): array
    {
        return [
            'name' => fake()->words(2, true),
            'language' => 'lv',
            'product_id' => Product::factory(),
        ];
    }
}
