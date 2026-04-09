<?php

namespace App\Http\Services;

use App\Models\ProductVariant;
use App\Models\ProductVariantDetail;
use App\Models\ProductVariantDetailIcon;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ProductVariantDetailService
{
    public function store(ProductVariant $productVariant, array $data): ProductVariantDetail
    {
        $icon = $this->resolveIcon($data);

        $maxOrder = ProductVariantDetail::withoutGlobalScope('order')
            ->where('product_variant_id', $productVariant->id)
            ->where('language', app()->getLocale())
            ->max('order');

        return ProductVariantDetail::create([
            'name' => $data['name'],
            'hasThis' => $data['hasThis'] ?? false,
            'icon' => $icon,
            'count' => $data['count'] ?? 0,
            'order' => $maxOrder !== null ? $maxOrder + 1 : 0,
            'product_variant_id' => $productVariant->id,
            'language' => app()->getLocale(),
        ]);
    }

    public function update(ProductVariantDetail $detail, array $data): ProductVariantDetail
    {
        $icon = $this->resolveIcon($data) ?? $detail->icon;

        $detail->update([
            'name' => $data['name'],
            'hasThis' => $data['hasThis'] ?? false,
            'icon' => $icon,
            'count' => $data['count'] ?? 0,
        ]);

        return $detail;
    }

    public function destroy(ProductVariantDetail $detail): void
    {
        $detail->delete();
    }

    public function reorder(array $orderedIds): void
    {
        foreach ($orderedIds as $index => $id) {
            ProductVariantDetail::withoutGlobalScope('order')
                ->where('id', $id)
                ->update(['order' => $index]);
        }
    }

    public function copyFromVariant(ProductVariant $source, ProductVariant $target, string $language): void
    {
        $maxOrder = ProductVariantDetail::withoutGlobalScope('order')
            ->where('product_variant_id', $target->id)
            ->where('language', $language)
            ->max('order');

        $nextOrder = $maxOrder !== null ? $maxOrder + 1 : 0;

        $sourceDetails = ProductVariantDetail::where('product_variant_id', $source->id)
            ->where('language', $language)
            ->get();

        foreach ($sourceDetails as $detail) {
            ProductVariantDetail::create([
                'name' => $detail->name,
                'hasThis' => $detail->hasThis,
                'icon' => $detail->icon,
                'count' => $detail->count,
                'order' => $nextOrder++,
                'product_variant_id' => $target->id,
                'language' => $language,
            ]);
        }
    }

    public function destroyIcon(ProductVariantDetailIcon $icon): bool
    {
        $iconName = basename($icon->name, '.svg');
        $inUse = ProductVariantDetail::where('icon', $iconName)->exists();

        if ($inUse) {
            return false;
        }

        Storage::disk('public')->delete('icons/product-variant-detail-icons/' . $icon->name);
        $icon->delete();

        return true;
    }

    private function resolveIcon(array $data): ?string
    {
        if (isset($data['newIcon']) && $data['newIcon'] instanceof UploadedFile) {
            $file = $data['newIcon'];
            $fileName = $file->getClientOriginalName();
            $file->storeAs('icons/product-variant-detail-icons', $fileName, 'public');

            ProductVariantDetailIcon::create(['name' => $fileName]);

            return basename($fileName, '.svg');
        }

        return $data['icon'] ?? null;
    }
}
