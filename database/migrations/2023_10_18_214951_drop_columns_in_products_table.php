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
    Schema::table('products', function (Blueprint $table) {
      $table->dropColumn('name_lv');
      $table->dropColumn('name_en');
      $table->dropColumn('name_se');
      $table->dropColumn('name_no');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::table('products', function (Blueprint $table) {
      $table->string('name_lv')->after('slug')->nullable()->default('Nav tulkojuma!');
      $table->string('name_en')->after('slug')->nullable()->default('Nav tulkojuma!');
      $table->string('name_se')->after('slug')->nullable()->default('Nav tulkojuma!');
      $table->string('name_no')->after('slug')->nullable()->default('Nav tulkojuma!');
    });
  }
};
