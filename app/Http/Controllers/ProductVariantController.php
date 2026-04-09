<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductVariantRequest;
use App\Http\Requests\UpdateProductVariantRequest;
use App\Http\Services\ProductVariantService;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class ProductVariantController extends Controller
{
  public function create(): View
  {
    $products = Product::select('id')
                       ->with([
                         'translations' => function ($query) {
                           $query->select('name', 'product_id')->where('language', app()->getLocale());
                         },
                       ])
                       ->get();

    return view('admin.product-variant.create', compact('products'));
  }

  public function store(StoreProductVariantRequest $request, ProductVariantService $productVariantService): RedirectResponse
  {
    try {
      return DB::transaction(function () use ($request, $productVariantService) {
        $productVariant = $productVariantService->addProductVariant($request);

        $productVariantService->addTranslation(
          $productVariant,
          $request->input('product-variant-name'),
          $request->input('product-variant-description'),
        );

        $productVariantService->addImage($productVariant, $request->input('product-variant-images'));

        if ($request->has('product-variant-plan')) {
          $productVariantService->addPlan($productVariant, $request->input('product-variant-plan'));
        }

        if ($request->has('product-variant-attachments')) {
          $productVariantService->addAttachment($productVariant, $request->input('product-variant-attachments'));
        }

        return redirect()->route('admin.products.index', ['locale' => app()->getLocale()])
                         ->with('success', 'Pievienots!');
      });
    } catch (\Exception $e) {
      Log::error('Product variant store failed', ['exception' => $e]);

      return back()->with('error', 'Kļūda! Mēģini vēlreiz.');
    }
  }

  public function show(string $locale, ProductVariant $productVariant): View
  {
    $product = $productVariant->product;

    $productVariant->load([
      'translations' => function ($query) {
        $query->select('product_variant_id', 'name', 'description', 'language')
              ->where('language', app()->getLocale());
      },
      'productVariantImages',
      'productVariantPlan' => fn ($query) => $query->where('language', app()->getLocale()),
      'productVariantAttachments' => fn ($query) => $query->where('language', app()->getLocale()),
    ]);

    return view('admin.product-variant.edit', compact('productVariant', 'product'));
  }

  public function update(string $locale, ProductVariant $productVariant, UpdateProductVariantRequest $request, ProductVariantService $productVariantService): RedirectResponse
  {
    try {
      return DB::transaction(function () use ($productVariant, $request, $productVariantService) {
        $productVariantService->updateProductVariant($productVariant, $request);

        $translation = $productVariantService->getTranslation($productVariant);
        if ($translation) {
          $productVariantService->updateTranslation(
            $translation,
            $request->input('product-variant-name'),
            $request->input('product-variant-description'),
          );
        } else {
          $productVariantService->addTranslation(
            $productVariant,
            $request->input('product-variant-name'),
            $request->input('product-variant-description'),
          );
        }

        $productVariantService->syncImages($productVariant, $request->input('product-variant-images', []));
        $productVariantService->syncPlans($productVariant, $request->input('product-variant-plan', []));
        $productVariantService->syncAttachment($productVariant, $request->input('product-variant-attachments', []));

        return back()->with('success', 'Atjaunots!');
      });
    } catch (\Exception $e) {
      Log::error('Product variant update failed', ['exception' => $e, 'product_variant_id' => $productVariant->id]);

      return back()->with('error', 'Kļūda! Mēģini vēlreiz.');
    }
  }

  public function destroy(string $locale, ProductVariant $productVariant, ProductVariantService $productVariantService): RedirectResponse
  {
    try {
      DB::transaction(function () use ($productVariant, $productVariantService) {
        $productVariantService->destroyProductVariant($productVariant);
      });

      return redirect()->route('admin.products.index', ['locale' => app()->getLocale()])
                       ->with('success', 'Dzēsts!');
    } catch (\Exception $e) {
      Log::error('Product variant delete failed', ['exception' => $e, 'product_variant_id' => $productVariant->id]);

      return back()->with('error', 'Kļūda! Mēģini vēlreiz.');
    }
  }
}
