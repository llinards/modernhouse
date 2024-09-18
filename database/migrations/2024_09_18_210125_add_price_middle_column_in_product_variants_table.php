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
      $table->decimal('price_middle')->after('price_basic')->default(0.00);
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::table('product_variants', function (Blueprint $table) {
      $table->dropColumn('price_middle');
    });
  }
};
