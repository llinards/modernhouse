<?php

namespace App\Livewire\Admin;

use App\Http\Services\ProductVariantOptionService;
use App\Models\ProductVariant;
use App\Models\ProductVariantOption;
use App\Models\ProductVariantOptionDetail;
use Illuminate\Support\Collection;
use Livewire\Component;

class ProductVariantOptionList extends Component
{
  public ProductVariant $productVariant;
  public Collection $options;

  /** @var array{title: string} */
  public array $optionForm = ['title' => ''];
  public ?int $editingOptionId = null;
  public bool $showOptionModal = false;

  /** @var array{detail: string, is_label: bool, has_in_basic: bool, has_in_middle: bool, has_in_full: bool} */
  public array $detailForm = [
    'detail'        => '',
    'is_label'      => false,
    'has_in_basic'  => false,
    'has_in_middle' => false,
    'has_in_full'   => false,
  ];
  public ?int $editingDetailId = null;
  public ?int $detailOptionId = null;
  public bool $showDetailModal = false;

  public ?int $copyFromVariantId = null;
  public bool $showCopyModal = false;

  public function mount(ProductVariant $productVariant): void
  {
    $this->productVariant = $productVariant;
    $this->loadOptions();
  }

  /* ----------------------------------------------------------------- Options */

  public function openOptionModal(): void
  {
    $this->resetOptionForm();
    $this->showOptionModal = true;
  }

  public function editOption(int $optionId): void
  {
    $option                = $this->productVariant->productVariantOptions()->findOrFail($optionId);
    $this->editingOptionId = $option->id;
    $this->optionForm      = ['title' => $option->option_title];
    $this->showOptionModal = true;
  }

  public function storeOption(): void
  {
    $this->validateOnly('optionForm.title');

    app(ProductVariantOptionService::class)->storeProductVariantOption($this->productVariant, $this->optionForm['title']);

    $this->closeOptionModal();
    $this->loadOptions();
    session()->flash('success', 'Pievienots!');
  }

  public function updateOption(): void
  {
    $this->validateOnly('optionForm.title');

    $option = $this->productVariant->productVariantOptions()->findOrFail($this->editingOptionId);
    app(ProductVariantOptionService::class)->updateProductVariantOption($option, $this->optionForm['title']);

    $this->closeOptionModal();
    $this->loadOptions();
    session()->flash('success', 'Atjaunots!');
  }

  public function destroyOption(int $optionId): void
  {
    $option = $this->productVariant->productVariantOptions()->findOrFail($optionId);
    app(ProductVariantOptionService::class)->destroyProductVariantOption($option);

    $this->loadOptions();
    session()->flash('success', 'Dzēsts!');
  }

  public function closeOptionModal(): void
  {
    $this->resetOptionForm();
    $this->showOptionModal = false;
  }

  /* ----------------------------------------------------------------- Details */

  public function openDetailModal(int $optionId): void
  {
    $this->resetDetailForm();
    $this->detailOptionId  = $optionId;
    $this->showDetailModal = true;
  }

  public function editDetail(int $detailId): void
  {
    $detail = $this->findDetail($detailId);

    $this->editingDetailId = $detail->id;
    $this->detailOptionId  = $detail->product_variant_option_id;
    $this->detailForm      = [
      'detail'        => $detail->detail,
      'is_label'      => $detail->is_label,
      'has_in_basic'  => $detail->has_in_basic,
      'has_in_middle' => $detail->has_in_middle,
      'has_in_full'   => $detail->has_in_full,
    ];
    $this->showDetailModal = true;
  }

  public function storeDetail(): void
  {
    $this->validateOnly('detailForm.detail');

    $option = $this->productVariant->productVariantOptions()->findOrFail($this->detailOptionId);
    app(ProductVariantOptionService::class)->storeProductVariantOptionDetail($option, $this->detailForm);

    $this->closeDetailModal();
    $this->loadOptions();
    session()->flash('success', 'Pievienots!');
  }

  public function updateDetail(): void
  {
    $this->validateOnly('detailForm.detail');

    $detail = $this->findDetail($this->editingDetailId);
    app(ProductVariantOptionService::class)->updateProductVariantOptionDetail($detail, $this->detailForm);

    $this->closeDetailModal();
    $this->loadOptions();
    session()->flash('success', 'Atjaunots!');
  }

  public function destroyDetail(int $detailId): void
  {
    app(ProductVariantOptionService::class)->destroyProductVariantOptionDetail($this->findDetail($detailId));

    $this->loadOptions();
    session()->flash('success', 'Dzēsts!');
  }

  public function closeDetailModal(): void
  {
    $this->resetDetailForm();
    $this->showDetailModal = false;
  }

  /* -------------------------------------------------------------- Reordering */

  public function updateProductVariantOptionOrder(array $productVariantOptions): void
  {
    foreach ($productVariantOptions as $productVariantOption) {
      ProductVariantOption::findOrFail($productVariantOption['value'])->update(['order' => $productVariantOption['order']]);
    }

    $this->loadOptions();
    session()->flash('success', 'Secība atjaunota.');
  }

  public function updateProductVariantOptionDetailOrder(array $productVariantOptionDetails): void
  {
    foreach ($productVariantOptionDetails as $productVariantOptionDetail) {
      ProductVariantOption::findOrFail($productVariantOptionDetail['value'])->update(['order' => $productVariantOptionDetail['order']]);

      foreach ($productVariantOptionDetail['items'] as $detail) {
        ProductVariantOptionDetail::findOrFail($detail['value'])->update(['order' => $detail['order']]);
      }
    }

    $this->loadOptions();
    session()->flash('success', 'Secība atjaunota.');
  }

  /* --------------------------------------------------------------- Copy */

  public function openCopyModal(): void
  {
    $this->showCopyModal = true;
  }

  public function copyFromVariant(): void
  {
    if (! $this->copyFromVariantId) {
      return;
    }

    $source = ProductVariant::findOrFail($this->copyFromVariantId);
    app(ProductVariantOptionService::class)->copyFromVariant($source, $this->productVariant, app()->getLocale());

    $this->copyFromVariantId = null;
    $this->showCopyModal     = false;
    $this->loadOptions();
    session()->flash('success', 'Opcijas nokopētas!');
  }

  public function closeCopyModal(): void
  {
    $this->copyFromVariantId = null;
    $this->showCopyModal     = false;
  }

  public function render()
  {
    $availableVariants = $this->showCopyModal
      ? ProductVariant::where('id', '!=', $this->productVariant->id)
        ->with([
          'translations'         => fn ($query) => $query->where('language', app()->getLocale()),
          'product.translations' => fn ($query) => $query->where('language', app()->getLocale()),
        ])
        ->get()
      : collect();

    return view('livewire.admin.product-variant-option-list', [
      'availableVariants' => $availableVariants,
    ]);
  }

  protected function rules(): array
  {
    return [
      'optionForm.title' => 'required|string',
      'detailForm.detail' => 'required|string',
    ];
  }

  protected function messages(): array
  {
    return [
      'optionForm.title.required'  => 'Nosaukums ir obligāts.',
      'detailForm.detail.required' => 'Apraksts ir obligāts.',
    ];
  }

  private function findDetail(int $detailId): ProductVariantOptionDetail
  {
    return ProductVariantOptionDetail::whereHas(
      'productVariantOption',
      fn ($query) => $query->where('product_variant_id', $this->productVariant->id),
    )->findOrFail($detailId);
  }

  private function loadOptions(): void
  {
    $this->options = ProductVariantOption::where('product_variant_id', $this->productVariant->id)
                                         ->where('language', app()->getLocale())
                                         ->with('productVariantOptionDetails')
                                         ->get();
  }

  private function resetOptionForm(): void
  {
    $this->editingOptionId = null;
    $this->optionForm      = ['title' => ''];
    $this->resetValidation();
  }

  private function resetDetailForm(): void
  {
    $this->editingDetailId = null;
    $this->detailOptionId  = null;
    $this->detailForm      = [
      'detail'        => '',
      'is_label'      => false,
      'has_in_basic'  => false,
      'has_in_middle' => false,
      'has_in_full'   => false,
    ];
    $this->resetValidation();
  }
}
