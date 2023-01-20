<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductVariantRequest;
use App\Http\Requests\UpdateProductVariantRequest;
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
      try {
        $newProductVariant = ProductVariant::create([
          'name' => $data['product-variant-name'],
          'price_basic' => $data['product-variant-basic-price'],
          'price_full' => $data['product-variant-full-price'],
          'description' => $data['product-variant-description'],
          'product_id' => $data['product-id']
        ]);
        foreach($data['product-variant-images'] as $image) {
          $fileName = basename($image);
          Storage::disk('public')->move($image, 'product-images/'.$newProductVariant->product->slug.'/'.Str::slug($data['product-variant-name']).'/'.$fileName);
          $newProductVariant->productVariantImages()->create([
            'filename' => $fileName
          ]);
        }
        return redirect('/admin')->with('success', Lang::get('added'));
      } catch (\Exception $e) {
        return back()->with('error', Lang::get('error try again'));
      }
    }

    public function show (ProductVariant $productVariant)
    {
      return view('admin.product-variant.edit', compact('productVariant'));
    }

    public function update (UpdateProductVariantRequest $data)
    {
      try {
        $productVariantToUpdate = ProductVariant::findOrFail($data->id);
        if ($data['product-variant-name'] !== $productVariantToUpdate->name) {
          $newProductVariantImageDirectory = 'product-images/'.$productVariantToUpdate->product->slug.'/'.Str::slug($data['product-variant-name']);
          $oldProductVariantImageDirectory = 'product-images/'.$productVariantToUpdate->product->slug.'/'.Str::slug($productVariantToUpdate->name);
          Storage::disk('public')->makeDirectory($newProductVariantImageDirectory);
          Storage::disk('public')->move($oldProductVariantImageDirectory, $newProductVariantImageDirectory);
        }
        $productVariantToUpdate->update([
          'name' => $data['product-variant-name'],
          'price_basic' => $data['product-variant-basic-price'],
          'price_full' => $data['product-variant-full-price'],
          'description' => $data['product-variant-description'],
        ]);
        if (isset($data['product-variant-images'])) {
          foreach($data['product-variant-images'] as $image) {
            $fileName = basename($image);
            Storage::disk('public')->move($image, 'product-images/'.$productVariantToUpdate->product->slug.'/'.Str::slug($data['product-variant-name']).'/'.$fileName);
            $productVariantToUpdate->productVariantImages()->create([
              'filename' => $fileName
            ]);
          }
        }
        return redirect('/admin')->with('success', Lang::get('updated'));
      } catch (\Exception $e) {
        return back()->with('error', Lang::get('error try again'));
      }
    }

    public function destroy (ProductVariant $productVariant)
    {
      try {
        Storage::disk('public')->deleteDirectory('product-images/'.$productVariant->product->slug.'/'.Str::slug($productVariant->name));
        $productVariant->delete();
        return redirect('/admin')->with('success', Lang::get('deleted'));
      } catch (\Exception $e) {
        return back()->with('error', Lang::get('error try again'));
      }
    }
}
