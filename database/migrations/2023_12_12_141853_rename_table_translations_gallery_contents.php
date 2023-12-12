<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::rename('translations_gallery_contents', 'translations_galleries');
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::rename('translations_galleries', 'translations_gallery_contents');
  }
};
