<?php

use App\Models\Product;
use App\Models\TranslationsProduct;
use App\Models\User;

beforeEach(function () {
    $this->user = User::factory()->create();
});

describe('Admin authentication', function () {
    it('redirects guests from admin to login', function () {
        $this->get('/admin/lv')
            ->assertRedirect('/login');
    });

    it('allows authenticated users to access admin', function () {
        $this->actingAs($this->user)
            ->get('/admin/lv')
            ->assertSuccessful();
    });
});

describe('Admin product list', function () {
    it('displays products in admin panel', function () {
        $product = Product::factory()->create();
        TranslationsProduct::factory()->create([
            'product_id' => $product->id,
            'name' => 'Admin produkts',
            'language' => 'lv',
        ]);

        $this->actingAs($this->user)
            ->get('/admin/lv')
            ->assertSuccessful()
            ->assertSee('Admin produkts');
    });
});
