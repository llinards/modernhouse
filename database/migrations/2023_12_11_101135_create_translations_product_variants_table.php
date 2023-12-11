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
    Schema::create('translations_product_variants', function (Blueprint $table) {
      $table->id();
      $table->string('name');
      $table->text('description');
      $table->string('language');
      $table->foreignId('product_variant_id')->references('id')->on('product_variants')->onDelete('cascade');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('translations_product_variants');
  }
};
