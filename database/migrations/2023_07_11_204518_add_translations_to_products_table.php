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
      $table->renameColumn('name', 'name_lv');
      $table->string('name_en')->after('name')->nullable()->default('Nav tulkojuma!');
      $table->string('name_se')->after('name_en')->nullable()->default('Nav tulkojuma!');
      $table->string('name_no')->after('name_se')->nullable()->default('Nav tulkojuma!');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::table('products', function (Blueprint $table) {
      $table->renameColumn('name_lv', 'name');
      $table->dropColumn('name_en');
      $table->dropColumn('name_se');
      $table->dropColumn('name_no');
    });
  }
};
