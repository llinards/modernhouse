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
    Schema::table('product_variant_options', function (Blueprint $table) {
      $table->dropColumn('option_category');
      $table->dropColumn('options');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::table('product_variant_options', function (Blueprint $table) {
      $table->text('option_category');
      $table->text('options');
    });
  }
};
