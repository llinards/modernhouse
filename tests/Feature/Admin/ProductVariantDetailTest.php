<?php

use App\Models\ProductVariant;
use App\Models\ProductVariantDetail;
use App\Models\User;

beforeEach(function () {
    $this->user = User::factory()->create();
});

describe('ProductVariantDetail model', function () {
    it('orders details by order column via global scope', function () {
        $variant = ProductVariant::factory()->create();

        ProductVariantDetail::factory()->create([
            'product_variant_id' => $variant->id,
            'name' => 'Second',
            'order' => 1,
        ]);
        ProductVariantDetail::factory()->create([
            'product_variant_id' => $variant->id,
            'name' => 'First',
            'order' => 0,
        ]);

        $details = ProductVariantDetail::where('product_variant_id', $variant->id)->get();

        expect($details->first()->name)->toBe('First')
            ->and($details->last()->name)->toBe('Second');
    });
});
