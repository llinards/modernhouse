<?php

namespace Database\Factories;

use App\Models\ProductVariantDetailIcon;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductVariantDetailIconFactory extends Factory
{
    protected $model = ProductVariantDetailIcon::class;

    public function definition(): array
    {
        return [
            'name' => fake()->unique()->randomElement([
                'auto_nojume.svg',
                'bathtub.svg',
                'bed.svg',
                'fork-knife.svg',
                'ladder-simple.svg',
                'leaf.svg',
                'noliktava.svg',
                'selection-plus.svg',
            ]),
        ];
    }
}
