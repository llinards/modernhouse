<?php

namespace App\Livewire\Admin;

use App\Http\Services\ProjectCatalogService;
use App\Models\ProjectCatalog;
use Illuminate\Support\Collection;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProjectCatalogList extends Component
{
  use WithFileUploads;

  public Collection $catalogs;

  /** @var array<string, mixed> */
  public array $form = [];

  public ?int $editingCatalogId = null;
  public bool $showModal = false;

  public function mount(): void
  {
    $this->resetForm();
    $this->loadCatalogs();
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

  public function store(): void
  {
    $this->validateForm();

    app(ProjectCatalogService::class)->store($this->form);

    $this->closeModal();
    $this->loadCatalogs();
    session()->flash('success', 'Katalogs pievienots!');
  }

  public function edit(int $catalogId): void
  {
    $catalog = ProjectCatalog::with('translations')->findOrFail($catalogId);

    $this->editingCatalogId = $catalog->id;
    $this->form = [
      'is_active' => (bool) $catalog->is_active,
      'translations' => $this->buildTranslationsForm($catalog),
    ];
    $this->resetValidation();
    $this->showModal = true;
  }

  public function update(): void
  {
    $this->validateForm();

    $catalog = ProjectCatalog::findOrFail($this->editingCatalogId);
    app(ProjectCatalogService::class)->update($catalog, $this->form);

    $this->closeModal();
    $this->loadCatalogs();
    session()->flash('success', 'Katalogs atjaunots!');
  }

  public function destroy(int $catalogId): void
  {
    $catalog = ProjectCatalog::findOrFail($catalogId);
    app(ProjectCatalogService::class)->destroy($catalog);

    $this->loadCatalogs();
    session()->flash('success', 'Katalogs dzēsts!');
  }

  public function updateOrder(array $orderedCatalogs): void
  {
    usort($orderedCatalogs, fn ($a, $b) => $a['order'] <=> $b['order']);
    $sortedIds = array_map(fn ($item) => (int) $item['value'], $orderedCatalogs);

    app(ProjectCatalogService::class)->reorder($sortedIds);
    $this->loadCatalogs();
    session()->flash('success', 'Secība atjaunota.');
  }

  public function render()
  {
    return view('livewire.admin.project-catalog-list', [
      'languages' => config('app.languages'),
    ]);
  }

  protected function rules(): array
  {
    $rules = [
      'form.is_active' => 'boolean',
    ];

    foreach (array_keys(config('app.languages')) as $language) {
      $rules["form.translations.$language.menu_name"] = 'nullable|string|max:255';
      $rules["form.translations.$language.new_pdf"] = 'nullable|file|mimes:pdf|max:51200';
    }

    return $rules;
  }

  protected function messages(): array
  {
    $messages = [];

    foreach (array_keys(config('app.languages')) as $language) {
      $label = strtoupper($language);
      $messages["form.translations.$language.menu_name.max"] = "Izvēlnes nosaukums ($label) ir pārāk garš (līdz 255 simboliem).";
      $messages["form.translations.$language.new_pdf.file"] = "Pievienotais fails ($label) nav derīgs.";
      $messages["form.translations.$language.new_pdf.mimes"] = "$label failam jābūt PDF formātā.";
      $messages["form.translations.$language.new_pdf.max"] = "$label PDF fails nedrīkst pārsniegt 50 MB.";
    }

    return $messages;
  }

  private function validateForm(): void
  {
    $this->validate();

    $errors = [];
    $hasAny = false;

    foreach ($this->form['translations'] ?? [] as $language => $entry) {
      $menuName = trim((string) ($entry['menu_name'] ?? ''));
      $remove = (bool) ($entry['remove'] ?? false);

      if ($menuName === '' || $remove) {
        continue;
      }

      $hasAny = true;

      $hasNewPdf = isset($entry['new_pdf']) && $entry['new_pdf'] !== null;
      $hasExistingPdf = ! empty($entry['existing_pdf_filename']);

      if (! $hasNewPdf && ! $hasExistingPdf) {
        $errors["form.translations.$language.new_pdf"] = 'Šai valodai jāpievieno PDF fails.';
      }
    }

    if (! $hasAny) {
      $errors['form.translations'] = 'Aizpildi vismaz vienu valodu.';
    }

    if ($errors !== []) {
      throw \Illuminate\Validation\ValidationException::withMessages($errors);
    }
  }

  private function loadCatalogs(): void
  {
    $this->catalogs = ProjectCatalog::with('translations')->ordered()->get();
  }

  private function resetForm(): void
  {
    $this->editingCatalogId = null;
    $this->form = [
      'is_active' => true,
      'translations' => $this->emptyTranslationsForm(),
    ];
    $this->resetValidation();
  }

  /**
   * @return array<string, array{menu_name: string, existing_pdf_filename: string|null, new_pdf: null, remove: bool}>
   */
  private function emptyTranslationsForm(): array
  {
    $translations = [];
    foreach (array_keys(config('app.languages')) as $language) {
      $translations[$language] = [
        'menu_name' => '',
        'existing_pdf_filename' => null,
        'new_pdf' => null,
        'remove' => false,
      ];
    }

    return $translations;
  }

  /**
   * @return array<string, array{menu_name: string, existing_pdf_filename: string|null, new_pdf: null, remove: bool}>
   */
  private function buildTranslationsForm(ProjectCatalog $catalog): array
  {
    $translations = $this->emptyTranslationsForm();

    foreach ($catalog->translations as $translation) {
      if (! isset($translations[$translation->language])) {
        continue;
      }

      $translations[$translation->language] = [
        'menu_name' => $translation->menu_name,
        'existing_pdf_filename' => $translation->pdf_filename,
        'new_pdf' => null,
        'remove' => false,
      ];
    }

    return $translations;
  }
}
