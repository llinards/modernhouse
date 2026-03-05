<?php

namespace Database\Factories;

use App\Models\ProductVariant;
use App\Models\ProductVariantAttachment;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductVariantAttachmentFactory extends Factory
{
    protected $model = ProductVariantAttachment::class;

    public function definition(): array
    {
        return [
            'filename' => 'attachment-' . fake()->unique()->numberBetween(1, 1000) . '.pdf',
            'language' => 'lv',
            'product_variant_id' => ProductVariant::factory(),
        ];
    }
}
