<?php

namespace App\Http\Controllers;

use App\Models\ProductVariant;

class ProductVariantDetailController extends Controller
{
    public function index(string $locale, ProductVariant $productVariant)
    {
        return view('admin.product-variant.product-variant-details.index', compact('productVariant'));
    }
}
