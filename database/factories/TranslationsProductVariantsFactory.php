<?php

namespace Database\Factories;

use App\Models\ProductVariant;
use App\Models\TranslationsProductVariants;
use Illuminate\Database\Eloquent\Factories\Factory;

class TranslationsProductVariantsFactory extends Factory
{
    protected $model = TranslationsProductVariants::class;

    public function definition(): array
    {
        return [
            'name' => 'Modulis ' . fake()->city(),
            'description' => '<p>' . fake()->paragraphs(2, true) . '</p>',
            'language' => 'lv',
            'product_variant_id' => ProductVariant::factory(),
        ];
    }
}
