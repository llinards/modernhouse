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
    Schema::create('product_variant_attachments', function (Blueprint $table) {
      $table->id();
      $table->string('filename');
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
    Schema::dropIfExists('product_variant_attachments');
  }
};