<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductVariantDetail;
use App\Models\ProductVariant;
use App\Models\ProductVariantDetail;
use App\Models\ProductVariantDetailIcon;
use Illuminate\Support\Facades\Lang;

class ProductVariantDetailController extends Controller
{
  public function index(ProductVariant $productVariant)
  {
    $allProductVariantDetails = $productVariant->productVariantDetails;
    return view('admin.product-variant.product-variant-details.index', compact('productVariant', 'allProductVariantDetails'));
  }

  public function create(ProductVariant $productVariant)
  {
    $allProductVariantDetails = $productVariant->productVariantDetails;
    $allProductVariantDetailIcons = ProductVariantDetailIcon::all();
    return view('admin.product-variant.product-variant-details.create', compact('productVariant', 'allProductVariantDetails', 'allProductVariantDetailIcons'));
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
      $newProductVariantDetail = ProductVariantDetail::create([
        'name' => $data['product-variant-detail-name'],
        'hasThis' => $data['product-variant-detail-available'] === 'on' ? true : false,
        'icon' => isset($data['product-variant-detail-new-icon']) ? basename($data['product-variant-detail-new-icon']->getClientOriginalName(), ".svg") : basename($data['product-variant-detail-icon'], ".svg"),
        'product_variant_id' => $data['product-variant-id'],
        'count' => $data['product-variant-detail-count']
      ]);
      return back()->with('success', Lang::get('updated'));
    } catch (\Exception $e) {
      return back()->with('error', Lang::get('error try again'));
    }
  }

  public function destroy(ProductVariant $productVariant, ProductVariantDetail $productVariantDetail)
  {
    try {
      $productVariantDetail->delete();
      return back()->with('success', Lang::get('deleted'));
    } catch (\Exception $e) {
      return back()->with('error', Lang::get('error try again'));
    }
  }
}