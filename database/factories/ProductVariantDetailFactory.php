<?php

namespace Database\Factories;

use App\Models\ProductVariant;
use App\Models\ProductVariantDetail;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductVariantDetailFactory extends Factory
{
    protected $model = ProductVariantDetail::class;

    /** @var array<int, array{name: string, icon: string}> */
    private static array $detailTypes = [
        ['name' => 'Guļamistabas', 'icon' => 'bed'],
        ['name' => 'Viesistaba ar virtuves zonu', 'icon' => 'fork-knife'],
        ['name' => 'Vannas istaba', 'icon' => 'bathtub'],
        ['name' => 'Lofts', 'icon' => 'ladder-simple'],
        ['name' => 'Sauna', 'icon' => 'leaf'],
        ['name' => 'Terase', 'icon' => 'selection-plus'],
    ];

    public function definition(): array
    {
        $detail = fake()->randomElement(self::$detailTypes);

        return [
            'name' => $detail['name'],
            'hasThis' => fake()->boolean(70),
            'icon' => $detail['icon'],
            'count' => fake()->numberBetween(0, 3),
            'order' => 0,
            'product_variant_id' => ProductVariant::factory(),
            'language' => 'lv',
        ];
    }
}
