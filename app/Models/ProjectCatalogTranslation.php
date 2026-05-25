<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProjectCatalogTranslation extends Model
{
  protected $fillable = [
    'project_catalog_id',
    'language',
    'menu_name',
    'pdf_filename',
  ];

  public function projectCatalog(): BelongsTo
  {
    return $this->belongsTo(ProjectCatalog::class);
  }
}
