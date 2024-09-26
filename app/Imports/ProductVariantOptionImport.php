<?php

namespace App\Imports;

use App\Models\ProductVariantOption;
use App\Models\ProductVariantOptionDetail;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class ProductVariantOptionImport implements ToCollection
{
  private const TITLE_COLUMN = 0;
  private const OPTION_TITLE_COLUMN = 1;
  private const DETAIL_COLUMN = 1;
  private const BASIC_COLUMN = 2;
  private const MIDDLE_COLUMN = 3;
  private const FULL_COLUMN = 4;

  protected int $productVariantId;
  protected int $currentProductVariantOptionPosition = 1;
  protected int $currentProductVariantOptionDetailPosition = 1;

  private ?ProductVariantOption $currentOption = null;

  public function __construct(int $productVariantId)
  {
    $this->productVariantId = $productVariantId;
  }

  public function collection(Collection $rows): void
  {
    foreach ($rows as $row) {
      if ($this->isTitleRow($row)) {
        $this->createProductVariantOption($row);
      } else {
        $this->createProductVariantOptionDetail($row);
      }
    }
  }

  private function isTitleRow(Collection $row): bool
  {
    return str_contains($row[self::TITLE_COLUMN] ?? '', 'Title');
  }

  private function createProductVariantOption(Collection $row): void
  {
    $this->currentOption                             = ProductVariantOption::create([
      'option_title'       => trim($row[self::OPTION_TITLE_COLUMN]),
      'product_variant_id' => $this->productVariantId,
      'order'              => $this->currentProductVariantOptionPosition++,
    ]);
    $this->currentProductVariantOptionDetailPosition = 1;
  }

  private function createProductVariantOptionDetail(Collection $row): void
  {
    if (empty(trim($row[self::DETAIL_COLUMN] ?? '')) || ! $this->currentOption) {
      return;
    }

    ProductVariantOptionDetail::create([
      'product_variant_option_id' => $this->currentOption->id,
      'detail'                    => trim($row[self::DETAIL_COLUMN] ?? ''),
      'has_in_basic'              => ! empty(trim($row[self::BASIC_COLUMN] ?? '')),
      'has_in_middle'             => ! empty(trim($row[self::MIDDLE_COLUMN] ?? '')),
      'has_in_full'               => ! empty(trim($row[self::FULL_COLUMN] ?? '')),
      'order'                     => $this->currentProductVariantOptionDetailPosition++,
    ]);
  }
}
