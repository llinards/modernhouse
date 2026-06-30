<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImportTechSpecPdfRequest;
use App\Http\Services\ProductVariantOptionPdfImportService;
use App\Models\ProductVariant;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class ProductVariantOptionController extends Controller
{
  public function __construct(private ProductVariantOptionPdfImportService $pdfImportService) {}

  public function index(string $locale, ProductVariant $productVariant): View
  {
    return view('admin.product-variant.product-variant-options.index', compact('productVariant'));
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
}
