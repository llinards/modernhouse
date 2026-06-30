<?php

namespace App\Http\Services;

use App\Http\Services\Pdf\TechSpecPdfParser;
use App\Models\ProductVariant;
use App\Models\ProductVariantOption;
use App\Models\ProductVariantOptionDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * Builds a variant's technical-specification options from uploaded spec PDFs.
 *
 * Each PDF represents one package (basic / middle / full). The full sheet is a
 * superset of the basic one, so the parses are merged into a single ordered set
 * of options whose detail rows are flagged with every package whose PDF
 * contained them. The variant's existing options for the current locale are
 * replaced with the result.
 */
class ProductVariantOptionPdfImportService
{
  /** Packages in priority (richest-first) order, used for master ordering. */
  private const PACKAGES = ['full', 'middle', 'basic'];

  public function __construct(private TechSpecPdfParser $parser) {}

  /**
   * @param array<string, string> $filesByPackage  package (basic|middle|full) => file path
   */
  public function import(ProductVariant $productVariant, array $filesByPackage): void
  {
    $parsedByPackage = [];

    foreach ($filesByPackage as $package => $path) {
      $parsedByPackage[$package] = $this->parser->parse($path);
    }

    $options = $this->merge($parsedByPackage);

    DB::transaction(function () use ($productVariant, $options): void {
      $this->replaceOptions($productVariant, $options);
    });
  }

  /**
   * @param  array<string, array<int, array{element: string, rows: array}>> $parsedByPackage
   * @return array<int, array{title: string, rows: array<int, array>}>
   */
  private function merge(array $parsedByPackage): array
  {
    $indexByPackage = [];

    foreach ($parsedByPackage as $package => $optionList) {
      foreach ($optionList as $option) {
        $indexByPackage[$package][$this->key($option['element'])] = $option;
      }
    }

    $merged = [];

    foreach ($this->orderedElements($parsedByPackage) as $key => $title) {
      $template = $this->richestOption($indexByPackage, $key);

      if ($template === null) {
        continue;
      }

      $rows = $this->buildRows($template['rows']);

      foreach ($parsedByPackage as $package => $_) {
        if (isset($indexByPackage[$package][$key])) {
          $this->markPackage($rows, $indexByPackage[$package][$key]['rows'], $package, $title);
        }
      }

      $merged[] = ['title' => $title, 'rows' => $rows];
    }

    return $merged;
  }

  /**
   * Element titles in display order: the richest package first, then any
   * elements seen only in lower-priority packages.
   *
   * @return array<string, string> normalized key => display title
   */
  private function orderedElements(array $parsedByPackage): array
  {
    $ordered = [];

    foreach (self::PACKAGES as $package) {
      foreach ($parsedByPackage[$package] ?? [] as $option) {
        $ordered[$this->key($option['element'])] ??= $option['element'];
      }
    }

    return $ordered;
  }

  /**
   * @return array{element: string, rows: array}|null
   */
  private function richestOption(array $indexByPackage, string $key): ?array
  {
    $richest = null;

    foreach (self::PACKAGES as $package) {
      $candidate = $indexByPackage[$package][$key] ?? null;

      if ($candidate !== null && ($richest === null || count($candidate['rows']) > count($richest['rows']))) {
        $richest = $candidate;
      }
    }

    return $richest;
  }

  /**
   * @return array<int, array>
   */
  private function buildRows(array $templateRows): array
  {
    $rows = [];

    foreach ($templateRows as $row) {
      $rows[] = $row['type'] === 'label'
        ? ['type' => 'label', 'text' => $row['text']]
        : ['type' => 'item', 'text' => $row['text'], 'flags' => ['basic' => false, 'middle' => false, 'full' => false]];
    }

    return $rows;
  }

  /**
   * Two-pointer subsequence match: walk the package's items in order against
   * the master rows, flagging each matched master item for the package.
   */
  private function markPackage(array &$rows, array $packageRows, string $package, string $element): void
  {
    $packageItems = array_values(array_filter($packageRows, static fn ($row) => $row['type'] === 'item'));
    $pointer      = 0;

    foreach ($rows as &$row) {
      if ($row['type'] !== 'item' || $pointer >= count($packageItems)) {
        continue;
      }

      if ($this->key($row['text']) === $this->key($packageItems[$pointer]['text'])) {
        $row['flags'][$package] = true;
        $pointer++;
      }
    }
    unset($row);

    if ($pointer < count($packageItems)) {
      Log::warning('TechSpec PDF import: items not matched against master', [
        'package'   => $package,
        'element'   => $element,
        'unmatched' => count($packageItems) - $pointer,
      ]);
    }
  }

  private function replaceOptions(ProductVariant $productVariant, array $options): void
  {
    $locale = app()->getLocale();

    $existingIds = ProductVariantOption::withoutGlobalScope('order')
      ->where('product_variant_id', $productVariant->id)
      ->where('language', $locale)
      ->pluck('id');

    ProductVariantOptionDetail::whereIn('product_variant_option_id', $existingIds)->delete();
    ProductVariantOption::whereIn('id', $existingIds)->delete();

    foreach ($options as $optionOrder => $option) {
      $created = ProductVariantOption::create([
        'product_variant_id' => $productVariant->id,
        'option_title'       => $option['title'],
        'language'           => $locale,
        'order'              => $optionOrder,
      ]);

      foreach ($option['rows'] as $rowOrder => $row) {
        ProductVariantOptionDetail::create([
          'product_variant_option_id' => $created->id,
          'detail'                    => $row['text'],
          'is_label'                  => $row['type'] === 'label',
          'has_in_basic'              => $row['flags']['basic'] ?? false,
          'has_in_middle'             => $row['flags']['middle'] ?? false,
          'has_in_full'               => $row['flags']['full'] ?? false,
          'order'                     => $rowOrder,
        ]);
      }
    }
  }

  private function key(string $text): string
  {
    return mb_strtolower(trim(preg_replace('/\s+/u', ' ', $text)));
  }
}
