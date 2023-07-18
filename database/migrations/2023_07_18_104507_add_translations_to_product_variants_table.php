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
      $table->string('slug')->after('id');
      $table->renameColumn('name', 'name_lv');
      $table->string('name_en')->after('name')->nullable()->default('Nav tulkojuma!');
      $table->string('name_se')->after('name_en')->nullable()->default('Nav tulkojuma!');
      $table->string('name_no')->after('name_se')->nullable()->default('Nav tulkojuma!');
      $table->renameColumn('description', 'description_lv');
      $table->text('description_en')->after('description')->nullable();
      $table->text('description_se')->after('description_en')->nullable();
      $table->text('description_no')->after('description_se')->nullable();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::table('product_variants', function (Blueprint $table) {
      $table->dropColumn('slug');
      $table->renameColumn('name_lv', 'name');
      $table->dropColumn('name_en');
      $table->dropColumn('name_se');
      $table->dropColumn('name_no');
      $table->renameColumn('description_lv', 'description');
      $table->dropColumn('description_en');
      $table->dropColumn('description_se');
      $table->dropColumn('description_no');
    });
  }
};
