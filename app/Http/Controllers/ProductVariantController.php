<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductVariantRequest;
use App\Models\Image;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductVariantController extends Controller
{
    public function create()
    {
      $allProducts = Product::all();
      return view('admin.product-variant.create', compact('allProducts'));
    }

    public function store(StoreProductVariantRequest $data)
    {
      $parentProduct = Product::findOrFail($data['product-id']);
      try {
        $newProductVariant = ProductVariant::create([
          'name' => $data['product-variant-name'],
          'price' => 0,
          'price_basic' => $data['product-variant-basic-price'],
          'price_full' => $data['product-variant-full-price'],
          'description' => $data['product-variant-description'],
          'product_id' => $data['product-id']
        ]);
        foreach($data['product-variant-images'] as $image) {
          $fileName = basename($image);
          Storage::disk('public')->move($image, 'product-images/'.$parentProduct->slug.'/'.Str::slug($data['product-variant-name']).'/'.$fileName);
          $newProductVariant->productVariantImages()->create([
            'filename' => $fileName,
            'product_variant_id' => $newProductVariant->id
          ]);
        }
        return redirect('/admin')->with('success', Lang::get('added'));
      } catch (\Exception $e) {
        return back()->with('error', Lang::get('error try again'));
      }
    }
}
