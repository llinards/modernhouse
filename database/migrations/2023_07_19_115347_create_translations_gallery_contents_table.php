<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up(): void
  {
    Schema::create('translations_gallery_contents', function (Blueprint $table) {
      $table->id();
      $table->string('title');
      $table->text('content')->nullable();
      $table->string('language');
      $table->timestamps();
      $table->foreignId('gallery_content_id')->references('id')->on('gallery_contents')->onDelete('cascade');
    });
  }

  public function down(): void
  {
    Schema::dropIfExists('translations_gallery_contents');
  }
};
