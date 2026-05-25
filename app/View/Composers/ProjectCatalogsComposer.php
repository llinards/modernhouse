<?php

namespace App\View\Composers;

use App\Models\ProjectCatalog;
use Illuminate\View\View;

class ProjectCatalogsComposer
{
  public function compose(View $view): void
  {
    $locale = app()->getLocale();

    $projectCatalogs = ProjectCatalog::where('is_active', true)
      ->with([
        'translations' => function ($query) use ($locale) {
          $query->where('language', $locale);
        },
      ])
      ->whereHas('translations', function ($query) use ($locale) {
        $query->where('language', $locale);
      })
      ->ordered()
      ->get();

    $view->with('projectCatalogs', $projectCatalogs);
  }
}
