<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProductVariantOptionsRequest;
use App\Http\Services\FileService;
use App\Http\Services\ProductVariantOptionService;
use App\Imports\ProductVariantOptionImport;
use App\Models\ProductVariant;
use App\Models\ProductVariantOption;
use App\Models\ProductVariantOptionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class ProductVariantOptionController extends Controller
{
  protected FileService $fileService;
  protected ProductVariantOptionService $productVariantOptionService;

  public function __construct(FileService $fileService, ProductVariantOptionService $productVariantOptionService)
  {
    $this->fileService                 = $fileService;
    $this->productVariantOptionService = $productVariantOptionService;
  }

  public function index(ProductVariant $productVariant)
  {
    $productVariantOptions = ProductVariantOption::where('product_variant_id', $productVariant->id)
                                                 ->where('language', app()->getLocale())
                                                 ->get();

    return view('admin.product-variant.product-variant-options.index',
      compact('productVariant', 'productVariantOptions'));
  }

  public function import(Request $data)
  {
    try {
      Excel::import(new ProductVariantOptionImport($data['product-variant-id']),
        storage_path('app/public/'.$data['product-variant-options-excel'][0]));

      $this->fileService->destroyFile(basename($data['product-variant-options-excel'][0]), 'uploads/temp');

      return back()->with('success', 'Tehniskā specifikācija importēta!');
    } catch (\Exception $e) {
      Log::error($e);

      return back()->with('error', 'Kļūda! Mēģini vēlreiz.');
    }
  }

  public function updateProductVariantOptionDetail(UpdateProductVariantOptionsRequest $data)
  {
    try {
      $this->productVariantOptionService->updateProductVariantOptionDetail($data);

      return back()->with('success', 'Opcija atjaunota!');
    } catch (\Exception $e) {
      Log::error($e);

      return back()->with('error', 'Kļūda! Mēģini vēlreiz.');
    }
  }

  public function destroy(ProductVariant $productVariant)
  {
    return $this->destroyEntity(function () use ($productVariant) {
      $this->productVariantOptionService->destroyProductVariantOptions($productVariant);
    });
  }

  public function destroyProductVariantOption(ProductVariantOption $productVariantOption)
  {
    return $this->destroyEntity(function () use ($productVariantOption) {
      $this->productVariantOptionService->destroyProductVariantOption($productVariantOption);
    });
  }

  public function destroyProductVariantOptionDetail(ProductVariantOptionDetail $productVariantOptionDetail)
  {
    return $this->destroyEntity(function () use ($productVariantOptionDetail) {
      $this->productVariantOptionService->destroyProductVariantOptionDetail($productVariantOptionDetail);
    });
  }

  private function destroyEntity(callable $callback)
  {
    try {
      $callback();

      return back()->with('success', 'Opcija izdzēsta!');
    } catch (\Exception $e) {
      Log::error($e);

      return back()->with('error', 'Kļūda! Mēģini vēlreiz.');
    }
  }
}
