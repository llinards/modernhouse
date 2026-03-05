<?php

namespace Database\Factories;

use App\Models\ProductVariant;
use App\Models\ProductVariantOption;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductVariantOptionFactory extends Factory
{
    protected $model = ProductVariantOption::class;

    public function definition(): array
    {
        return [
            'option_title' => fake()->randomElement([
                'Ārsienas', 'Iekšējās sienas', 'Grīda', 'Jumts',
                'Logi un durvis', 'Apkure', 'Elektroinstalācija', 'Santehnika',
            ]),
            'product_variant_id' => ProductVariant::factory(),
            'language' => 'lv',
            'order' => fake()->numberBetween(0, 10),
        ];
    }
}
