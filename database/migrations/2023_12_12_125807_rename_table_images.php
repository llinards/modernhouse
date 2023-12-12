<?php

use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::rename('images', 'product_variant_images');
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::rename('product_variant_images', 'images');
  }
};
