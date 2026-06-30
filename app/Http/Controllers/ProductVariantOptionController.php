<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImportTechSpecPdfRequest;
use App\Http\Requests\ProductVariantOptionDetailRequest;
use App\Http\Requests\ProductVariantOptionRequest;
use App\Http\Services\FileService;
use App\Http\Services\ProductVariantOptionPdfImportService;
use App\Http\Services\ProductVariantOptionService;
use App\Imports\ProductVariantOptionImport;
use App\Models\ProductVariant;
use App\Models\ProductVariantOption;
use App\Models\ProductVariantOptionDetail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;

class ProductVariantOptionController extends Controller
{
  protected FileService $fileService;
  protected ProductVariantOptionService $productVariantOptionService;

  public function __construct(
    FileService $fileService,
    ProductVariantOptionService $productVariantOptionService,
    private ProductVariantOptionPdfImportService $pdfImportService,
  ) {
    $this->fileService                 = $fileService;
    $this->productVariantOptionService = $productVariantOptionService;
  }

  public function index(string $locale, ProductVariant $productVariant): View
  {
    $availableVariants = ProductVariant::where('id', '!=', $productVariant->id)
                                       ->with([
                                         'translations'         => fn ($query) => $query->where('language', app()->getLocale()),
                                         'product.translations' => fn ($query) => $query->where('language', app()->getLocale()),
                                       ])
                                       ->get();

    return view('admin.product-variant.product-variant-options.index', compact('productVariant', 'availableVariants'));
  }

  public function import(Request $data): RedirectResponse
  {
    $data->validate([
      'product-variant-id'            => ['required', 'exists:product_variants,id'],
      'product-variant-options-excel' => ['required', 'array'],
    ]);

    try {
      $filePath = storage_path('app/public/'.$data['product-variant-options-excel'][0]);

      DB::transaction(function () use ($data, $filePath) {
        Excel::import(new ProductVariantOptionImport($data['product-variant-id']), $filePath);
      });

      $this->fileService->destroyFile(basename($filePath), 'uploads/temp');

      return back()->with('success', 'Tehniskā specifikācija importēta!');
    } catch (\Exception $e) {
      Log::error('Product variant option import failed', ['exception' => $e]);

      return back()->with('error', 'Kļūda! Mēģini vēlreiz.');
    }
  }

  public function importPdf(ImportTechSpecPdfRequest $request, string $locale, ProductVariant $productVariant): RedirectResponse
  {
    try {
      $files = [];

      foreach (ImportTechSpecPdfRequest::PACKAGE_FIELDS as $package => $field) {
        if ($request->hasFile($field)) {
          $files[$package] = $request->file($field)->getRealPath();
        }
      }

      $this->pdfImportService->import($productVariant, $files);

      return back()->with('success', 'Tehniskā specifikācija importēta no PDF!');
    } catch (\Exception $e) {
      Log::error('Product variant option PDF import failed', ['exception' => $e]);

      return back()->with('error', 'Kļūda! Mēģini vēlreiz.');
    }
  }

  public function storeProductVariantOption(ProductVariantOptionRequest $data): RedirectResponse
  {
    try {
      DB::transaction(fn () => $this->productVariantOptionService->storeProductVariantOption($data));

      return back()->with('success', 'Pievienots!');
    } catch (\Exception $e) {
      Log::error('Product variant option store failed', ['exception' => $e]);

      return back()->with('error', 'Kļūda! Mēģini vēlreiz.');
    }
  }

  public function storeProductVariantOptionDetail(ProductVariantOptionDetailRequest $data): RedirectResponse
  {
    try {
      DB::transaction(fn () => $this->productVariantOptionService->storeProductVariantOptionDetail($data));

      return back()->with('success', 'Pievienots!');
    } catch (\Exception $e) {
      Log::error('Product variant option detail store failed', ['exception' => $e]);

      return back()->with('error', 'Kļūda! Mēģini vēlreiz.');
    }
  }

  public function updateProductVariantOption(ProductVariantOptionRequest $data): RedirectResponse
  {
    try {
      DB::transaction(fn () => $this->productVariantOptionService->updateProductVariantOption($data));

      return back()->with('success', 'Opcija atjaunota!');
    } catch (\Exception $e) {
      Log::error('Product variant option update failed', ['exception' => $e]);

      return back()->with('error', 'Kļūda! Mēģini vēlreiz.');
    }
  }

  public function updateProductVariantOptionDetail(ProductVariantOptionDetailRequest $data): RedirectResponse
  {
    try {
      DB::transaction(fn () => $this->productVariantOptionService->updateProductVariantOptionDetail($data));

      return back()->with('success', 'Opcija atjaunota!');
    } catch (\Exception $e) {
      Log::error('Product variant option detail update failed', ['exception' => $e]);

      return back()->with('error', 'Kļūda! Mēģini vēlreiz.');
    }
  }

  public function copyProductVariantOptions(string $locale, ProductVariant $productVariant, Request $data): RedirectResponse
  {
    $data->validate([
      'source_variant_id' => ['required', 'exists:product_variants,id'],
    ]);

    try {
      $source = ProductVariant::findOrFail($data->input('source_variant_id'));

      DB::transaction(fn () => $this->productVariantOptionService->copyFromVariant(
        $source,
        $productVariant,
        app()->getLocale(),
      ));

      return back()->with('success', 'Opcijas nokopētas!');
    } catch (\Exception $e) {
      Log::error('Product variant option copy failed', ['exception' => $e]);

      return back()->with('error', 'Kļūda! Mēģini vēlreiz.');
    }
  }

  public function destroy(string $locale, ProductVariant $productVariant): RedirectResponse
  {
    return $this->destroyEntity(fn(
    ) => $this->productVariantOptionService->destroyProductVariantOptions($productVariant));
  }

  public function destroyProductVariantOption(string $locale, ProductVariantOption $productVariantOption): RedirectResponse
  {
    return $this->destroyEntity(fn(
    ) => $this->productVariantOptionService->destroyProductVariantOption($productVariantOption));
  }

  public function destroyProductVariantOptionDetail(string $locale, ProductVariantOptionDetail $productVariantOptionDetail): RedirectResponse
  {
    return $this->destroyEntity(fn(
    ) => $this->productVariantOptionService->destroyProductVariantOptionDetail($productVariantOptionDetail));
  }

  private function destroyEntity(callable $callback): RedirectResponse
  {
    try {
      DB::transaction($callback);

      return back()->with('success', 'Opcija izdzēsta!');
    } catch (\Exception $e) {
      Log::error('Product variant option deletion failed', ['exception' => $e]);

      return back()->with('error', 'Kļūda! Mēģini vēlreiz.');
    }
  }
}
