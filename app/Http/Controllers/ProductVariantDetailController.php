<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductVariantDetail;
use App\Models\ProductVariant;
use App\Models\ProductVariantDetail;
use App\Models\ProductVariantDetailIcon;
use Illuminate\Support\Facades\Log;

class ProductVariantDetailController extends Controller
{
  public function index(ProductVariant $productVariant)
  {
    $productVariantDetails = $productVariant->productVariantDetails->where('language', app()->getLocale());
    return view('admin.product-variant.product-variant-details.index',
      compact('productVariant', 'productVariantDetails'));
  }

  public function create(ProductVariant $productVariant)
  {
    $productVariantDetailIcons = ProductVariantDetailIcon::all();
    return view('admin.product-variant.product-variant-details.create',
      compact('productVariant', 'productVariantDetailIcons'));
  }

  public function store(StoreProductVariantDetail $data)
  {
    try {
      if (isset($data['product-variant-detail-new-icon'])) {
        $newIcon = $data['product-variant-detail-new-icon'];
        $fileName = $newIcon->getClientOriginalName();
        $newIcon->storeAs('icons/product-variant-detail-icons', $fileName, 'public');
        ProductVariantDetailIcon::create([
          'name' => $fileName
        ]);
      }
      ProductVariantDetail::create([
        'name' => $data['product-variant-detail-name'],
        'hasThis' => $data['product-variant-detail-available'] === 'on' ? true : false,
        'icon' => isset($data['product-variant-detail-new-icon']) ? basename($data['product-variant-detail-new-icon']->getClientOriginalName(),
          ".svg") : basename($data['product-variant-detail-icon'], ".svg"),
        'product_variant_id' => $data['product-variant-id'],
        'count' => $data['product-variant-detail-count'],
        'language' => app()->getLocale()
      ]);
      return back()->with('success', 'Pievienots!');
    } catch (\Exception $e) {
      Log::error($e);
      return back()->with('error', 'Kļūda! Mēģini vēlreiz.');
    }
  }

  public function destroy(ProductVariant $productVariant, ProductVariantDetail $productVariantDetail)
  {
    try {
      $productVariantDetail->delete();
      return back()->with('success', 'Dzēsts!');
    } catch (\Exception $e) {
      Log::error($e);
      return back()->with('error', 'Kļūda! Mēģini vēlreiz.');
    }
  }
}
