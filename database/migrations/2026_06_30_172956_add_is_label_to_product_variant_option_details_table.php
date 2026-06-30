<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('product_variant_option_details', function (Blueprint $table) {
            $table->boolean('is_label')->default(false)->after('detail');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_variant_option_details', function (Blueprint $table) {
            $table->dropColumn('is_label');
        });
    }
};
