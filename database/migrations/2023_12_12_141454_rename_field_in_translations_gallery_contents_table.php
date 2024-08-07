<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::table('translations_gallery_contents', function (Blueprint $table) {
      $table->renameColumn('gallery_content_id', 'gallery_id');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::table('translations_gallery_contents', function (Blueprint $table) {
      $table->renameColumn('gallery_id', 'gallery_content_id');
    });
  }
};
