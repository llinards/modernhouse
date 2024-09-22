<?php

namespace App\Http\Controllers;

use App\Imports\ProductVariantOptionImport;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class ProductVariantOptionController extends Controller
{
  public function index(ProductVariant $productVariant)
  {
    return view('admin.product-variant.product-variant-options.index', compact('productVariant'));
  }

  public function import(Request $data)
  {
    try {
      Excel::import(new ProductVariantOptionImport($data['product-variant-id']),
        storage_path('app/public/'.$data['product-variant-options-excel'][0]));

      return back()->with('success', 'Tehniskā specifikācija importēta!');
    } catch (\Exception $e) {
      Log::error($e);

      return back()->with('error', 'Kļūda! Mēģini vēlreiz.');
    }
  }
}
