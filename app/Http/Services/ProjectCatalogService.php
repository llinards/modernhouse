<?php

namespace App\Http\Services;

use App\Models\ProjectCatalog;
use App\Models\ProjectCatalogTranslation;
use Illuminate\Support\Facades\Storage;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class ProjectCatalogService
{
  public const STORAGE_ROOT = 'project-catalogs';

  /**
   * @param  array{is_active: bool, translations: array<string, array{menu_name: string|null, new_pdf: mixed, existing_pdf_filename: string|null, remove: bool}>}  $form
   */
  public function store(array $form): ProjectCatalog
  {
    $catalog = ProjectCatalog::create([
      'is_active' => $form['is_active'] ?? true,
      'order' => (ProjectCatalog::max('order') ?? 0) + 1,
    ]);

    foreach ($form['translations'] as $language => $entry) {
      $newPdf = $entry['new_pdf'] ?? null;
      $menuName = trim((string) ($entry['menu_name'] ?? ''));

      if ($menuName === '' || ! $newPdf instanceof TemporaryUploadedFile) {
        continue;
      }

      $filename = $this->storePdf($newPdf, $catalog->id, $language);

      ProjectCatalogTranslation::create([
        'project_catalog_id' => $catalog->id,
        'language' => $language,
        'menu_name' => $menuName,
        'pdf_filename' => $filename,
      ]);
    }

    return $catalog;
  }

  /**
   * @param  array{is_active: bool, translations: array<string, array{menu_name: string|null, new_pdf: mixed, existing_pdf_filename: string|null, remove: bool}>}  $form
   */
  public function update(ProjectCatalog $catalog, array $form): void
  {
    $catalog->update(['is_active' => $form['is_active'] ?? false]);

    foreach ($form['translations'] as $language => $entry) {
      $translation = $catalog->translations()->where('language', $language)->first();
      $newPdf = $entry['new_pdf'] ?? null;
      $menuName = trim((string) ($entry['menu_name'] ?? ''));
      $remove = (bool) ($entry['remove'] ?? false);

      if ($remove && $translation) {
        $this->deletePdf($catalog->id, $language, $translation->pdf_filename);
        $translation->delete();
        continue;
      }

      if ($translation) {
        $updates = [];

        if ($menuName !== '') {
          $updates['menu_name'] = $menuName;
        }

        if ($newPdf instanceof TemporaryUploadedFile) {
          $this->deletePdf($catalog->id, $language, $translation->pdf_filename);
          $updates['pdf_filename'] = $this->storePdf($newPdf, $catalog->id, $language);
        }

        if ($updates !== []) {
          $translation->update($updates);
        }

        continue;
      }

      if ($menuName !== '' && $newPdf instanceof TemporaryUploadedFile) {
        ProjectCatalogTranslation::create([
          'project_catalog_id' => $catalog->id,
          'language' => $language,
          'menu_name' => $menuName,
          'pdf_filename' => $this->storePdf($newPdf, $catalog->id, $language),
        ]);
      }
    }
  }

  public function destroy(ProjectCatalog $catalog): void
  {
    Storage::disk('public')->deleteDirectory(self::STORAGE_ROOT.'/'.$catalog->id);
    $catalog->delete();
  }

  /**
   * @param  list<int>  $sortedIds
   */
  public function reorder(array $sortedIds): void
  {
    foreach ($sortedIds as $order => $id) {
      ProjectCatalog::where('id', $id)->update(['order' => $order]);
    }
  }

  private function storePdf(TemporaryUploadedFile $file, int $catalogId, string $language): string
  {
    $filename = $file->getClientOriginalName();
    $directory = self::STORAGE_ROOT.'/'.$catalogId.'/'.$language;

    $file->storeAs($directory, $filename, 'public');

    return $filename;
  }

  private function deletePdf(int $catalogId, string $language, ?string $filename): void
  {
    if (! $filename) {
      return;
    }

    Storage::disk('public')->delete(self::STORAGE_ROOT.'/'.$catalogId.'/'.$language.'/'.$filename);
  }
}
