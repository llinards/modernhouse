<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up(): void
  {
    Schema::create('project_catalog_translations', function (Blueprint $table) {
      $table->id();
      $table->foreignId('project_catalog_id')->references('id')->on('project_catalogs')->onDelete('cascade');
      $table->string('language');
      $table->string('menu_name');
      $table->string('pdf_filename');
      $table->timestamps();
      $table->unique(['project_catalog_id', 'language']);
    });
  }

  public function down(): void
  {
    Schema::dropIfExists('project_catalog_translations');
  }
};
