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
    Schema::table('product_variants', function (Blueprint $table) {
      $table->decimal('building_area')->nullable()->default('0.00');
      $table->decimal('living_area')->nullable()->default('0.00');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::table('product_variants', function (Blueprint $table) {
      $table->dropColumn('building_area');
      $table->dropColumn('living_area');
    });
  }
};
