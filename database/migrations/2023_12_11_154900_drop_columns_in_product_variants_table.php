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
      $table->dropColumn('name_lv');
      $table->dropColumn('name_en');
      $table->dropColumn('name_se');
      $table->dropColumn('name_no');
      $table->dropColumn('description_lv');
      $table->dropColumn('description_en');
      $table->dropColumn('description_se');
      $table->dropColumn('description_no');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::table('product_variants', function (Blueprint $table) {
      $table->string('name_lv')->after('id');
      $table->string('name_en')->after('name_lv')->nullable()->default('Nav tulkojuma!');
      $table->string('name_se')->after('name_en')->nullable()->default('Nav tulkojuma!');
      $table->string('name_no')->after('name_se')->nullable()->default('Nav tulkojuma!');
      $table->text('description_lv')->after('name_no');
      $table->text('description_en')->after('description_lv')->nullable();
      $table->text('description_se')->after('description_en')->nullable();
      $table->text('description_no')->after('description_se')->nullable();
    });
  }
};
