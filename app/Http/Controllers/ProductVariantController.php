<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductVariantRequest;
use App\Http\Requests\UpdateProductVariantRequest;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductVariantAreaDetail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductVariantController extends Controller
{
  public function create()
  {
    $allProducts = Product::select('id')
      ->with([
        'translations' => function ($query) {
          $query->select('name', 'product_id', 'language')->where('language', app()->getLocale());
        },
      ])
      ->get();
    return view('admin.product-variant.create', compact('allProducts'));
  }

  public function store(StoreProductVariantRequest $data)
  {
    $productVariantSlug = Str::slug($data['product-variant-name']);
    try {
      $newProductVariant = ProductVariant::create([
        'name_'.app()->getLocale() => $data['product-variant-name'],
        'slug' => $productVariantSlug,
        'price_basic' => $data['product-variant-basic-price'],
        'price_full' => $data['product-variant-full-price'],
        'description_'.app()->getLocale() => $data['product-variant-description'],
        'product_id' => $data['product-id'],
        'is_active' => false
      ]);
      foreach ($data['product-variant-images'] as $image) {
        $fileName = basename($image);
        Storage::disk('public')->move($image,
          'product-images/'.$newProductVariant->product->slug.'/'.$productVariantSlug.'/'.$fileName);
        $newProductVariant->productVariantImages()->create([
          'filename' => $fileName
        ]);
      }
      return redirect('/admin')->with('success', 'Pievienots!');
    } catch (\Exception $e) {
      Log::debug($e);
      return back()->with('error', 'Kļūda! Mēģini vēlreiz.');
    }
  }

  public function show(ProductVariant $productVariant)
  {
    return view('admin.product-variant.edit', compact('productVariant'));
  }

  public function update(UpdateProductVariantRequest $data)
  {
    try {
      $productVariantToUpdate = ProductVariant::findOrFail($data->id);
      $productVariantSlug = app()->getLocale() === 'lv' ? Str::slug($data['product-variant-name']) : $productVariantToUpdate->slug;

      if ((app()->getLocale() === 'lv') && $productVariantSlug !== $productVariantToUpdate->slug) {
        $newProductVariantImageDirectory = 'product-images/'.$productVariantToUpdate->product->slug.'/'.$productVariantSlug;
        $oldProductVariantImageDirectory = 'product-images/'.$productVariantToUpdate->product->slug.'/'.$productVariantToUpdate->slug;
        Storage::disk('public')->makeDirectory($newProductVariantImageDirectory);
        Storage::disk('public')->move($oldProductVariantImageDirectory, $newProductVariantImageDirectory);
      }
      $productVariantToUpdate->update([
        'name_'.app()->getLocale() => $data['product-variant-name'],
        'slug' => $productVariantSlug,
        'price_basic' => $data['product-variant-basic-price'],
        'price_full' => $data['product-variant-full-price'],
        'description_'.app()->getLocale() => $data['product-variant-description'],
        'is_active' => isset($data['product-variant-available']),
      ]);
      foreach ($data['product-variant-area-details-name'] as $key => $productVariantAreaDetail) {
        if (isset($data['product-variant-area-details-id'][$key])) {
          $productVariantAreaDetailToUpdate = ProductVariantAreaDetail::find($data['product-variant-area-details-id'][$key]);
          $productVariantAreaDetailToUpdate->update([
            'name_'.app()->getLocale() => $data['product-variant-area-details-name'][$key],
            'square_meters' => $data['product-variant-area-details-square-meters'][$key],
            'product_variant_id' => $data['id']
          ]);
        } else {
          ProductVariantAreaDetail::create([
            'name_'.app()->getLocale() => $data['product-variant-area-details-name'][$key],
            'square_meters' => $data['product-variant-area-details-square-meters'][$key],
            'product_variant_id' => $data['id']
          ]);
        }
      }
      if (isset($data['product-variant-images'])) {
        foreach ($data['product-variant-images'] as $image) {
          $fileName = basename($image);
          Storage::disk('public')->move($image,
            'product-images/'.$productVariantToUpdate->product->slug.'/'.$productVariantToUpdate->slug.'/'.$fileName);
          $productVariantToUpdate->productVariantImages()->create([
            'filename' => $fileName
          ]);
        }
      }
      return redirect('/admin')->with('success', 'Atjaunots!');
    } catch (\Exception $e) {
      Log::debug($e);
      return back()->with('error', 'Kļūda! Mēģini vēlreiz.');
    }
  }

  public function destroy(ProductVariant $productVariant)
  {
    try {
      Storage::disk('public')->deleteDirectory('product-images/'.$productVariant->product->slug.'/'.Str::slug($productVariant->name));
      $productVariant->delete();
      return redirect('/admin')->with('success', 'Dzēsts!');
    } catch (\Exception $e) {
      Log::debug($e);
      return back()->with('error', 'Kļūda! Mēģini vēlreiz.');
    }
  }
}
