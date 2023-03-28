<?php

namespace App\Http\Controllers;

use App\Models\ProductVariant;
use App\Models\ProductVariantDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;

class ProductVariantDetailController extends Controller
{
  public function index(ProductVariant $productVariant)
  {
    $allProductVariantDetails = $productVariant->productVariantDetails;
    return view('admin.product-variant.product-variant-details.index', compact('productVariant', 'allProductVariantDetails'));
  }

  public function update(Request $data)
  {
    return $data;
  }

  public function destroy(ProductVariant $productVariant, ProductVariantDetail $productVariantDetail)
  {
    try {
      $productVariantDetail->delete();
      return back()->with('success', Lang::get('deleted'));
    } catch(\Exception $e) {
      return back()->with('error', Lang::get('error try again'));
    }
  }
}
