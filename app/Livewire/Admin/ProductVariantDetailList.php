<?php

namespace App\Livewire\Admin;

use App\Http\Services\ProductVariantDetailService;
use App\Models\ProductVariant;
use App\Models\ProductVariantDetail;
use App\Models\ProductVariantDetailIcon;
use Illuminate\Support\Collection;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProductVariantDetailList extends Component
{
    use WithFileUploads;

    public ProductVariant $productVariant;
    public Collection $details;
    public Collection $icons;

    /** @var array{name: string, hasThis: bool, count: int|null, icon: string, newIcon: mixed} */
    public array $form = [
        'name' => '',
        'hasThis' => false,
        'count' => null,
        'icon' => '',
        'newIcon' => null,
    ];

    public ?int $editingDetailId = null;
    public ?int $copyFromVariantId = null;
    public bool $showModal = false;
    public bool $showCopyModal = false;

    public function mount(ProductVariant $productVariant): void
    {
        $this->productVariant = $productVariant;
        $this->loadDetails();
        $this->loadIcons();
    }

    public function store(): void
    {
        $this->validate();

        $service = app(ProductVariantDetailService::class);
        $service->store($this->productVariant, $this->form);

        $this->resetForm();
        $this->loadDetails();
        $this->loadIcons();
        session()->flash('success', 'Pievienots!');
    }

    public function edit(int $detailId): void
    {
        $detail = $this->productVariant->productVariantDetails()->findOrFail($detailId);
        $this->editingDetailId = $detail->id;
        $this->form = [
            'name' => $detail->name,
            'hasThis' => (bool) $detail->hasThis,
            'count' => $detail->count,
            'icon' => $detail->icon,
            'newIcon' => null,
        ];
        $this->showModal = true;
    }

    public function update(): void
    {
        $this->validate();

        $detail = $this->productVariant->productVariantDetails()->findOrFail($this->editingDetailId);
        $service = app(ProductVariantDetailService::class);
        $service->update($detail, $this->form);

        $this->resetForm();
        $this->loadDetails();
        $this->loadIcons();
        session()->flash('success', 'Atjaunots!');
    }

    public function destroy(int $detailId): void
    {
        $detail = $this->productVariant->productVariantDetails()->findOrFail($detailId);
        $service = app(ProductVariantDetailService::class);
        $service->destroy($detail);

        $this->loadDetails();
        session()->flash('success', 'Dzēsts!');
    }

    public function updateDetailOrder(array $orderedDetails): void
    {
        $service = app(ProductVariantDetailService::class);

        usort($orderedDetails, fn ($a, $b) => $a['order'] <=> $b['order']);
        $sortedIds = array_map(fn ($item) => $item['value'], $orderedDetails);

        $service->reorder($sortedIds);
        $this->loadDetails();
        session()->flash('success', 'Secība atjaunota.');
    }

    public function copyFromVariant(): void
    {
        if (! $this->copyFromVariantId) {
            return;
        }

        $source = ProductVariant::findOrFail($this->copyFromVariantId);
        $service = app(ProductVariantDetailService::class);
        $service->copyFromVariant($source, $this->productVariant, app()->getLocale());

        $this->copyFromVariantId = null;
        $this->showCopyModal = false;
        $this->loadDetails();
        session()->flash('success', 'Detaļas nokopētas!');
    }

    public function openModal(): void
    {
        $this->resetForm();
        $this->showModal = true;
    }

    public function closeModal(): void
    {
        $this->resetForm();
        $this->showModal = false;
    }

    public function openCopyModal(): void
    {
        $this->showCopyModal = true;
    }

    public function closeCopyModal(): void
    {
        $this->copyFromVariantId = null;
        $this->showCopyModal = false;
    }

    public function render()
    {
        $availableVariants = $this->showCopyModal
            ? ProductVariant::where('id', '!=', $this->productVariant->id)
                ->with(['product.translations' => fn ($q) => $q->where('language', app()->getLocale())])
                ->get()
            : collect();

        return view('livewire.admin.product-variant-detail-list', [
            'availableVariants' => $availableVariants,
        ]);
    }

    protected function rules(): array
    {
        return [
            'form.name' => 'required|string',
            'form.count' => 'required|numeric',
            'form.icon' => 'required_without:form.newIcon|string',
            'form.newIcon' => 'nullable|file|mimes:svg',
        ];
    }

    protected function messages(): array
    {
        return [
            'form.name.required' => 'Nosaukums ir obligāts.',
            'form.count.required' => 'Skaits ir obligāts.',
            'form.count.numeric' => 'Skaitam jābūt skaitlim.',
            'form.icon.required_without' => 'Izvēlieties ikonu vai augšupielādējiet jaunu.',
        ];
    }

    private function loadIcons(): void
    {
        $this->icons = ProductVariantDetailIcon::all();
    }

    private function loadDetails(): void
    {
        $this->details = ProductVariantDetail::where('product_variant_id', $this->productVariant->id)
            ->where('language', app()->getLocale())
            ->get();
    }

    private function resetForm(): void
    {
        $this->editingDetailId = null;
        $this->form = [
            'name' => '',
            'hasThis' => false,
            'count' => null,
            'icon' => '',
            'newIcon' => null,
        ];
        $this->resetValidation();
    }
}
