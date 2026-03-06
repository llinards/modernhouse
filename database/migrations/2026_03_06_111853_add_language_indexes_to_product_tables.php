<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('translations_products', function (Blueprint $table) {
            $table->index(['product_id', 'language']);
        });

        Schema::table('translations_product_variants', function (Blueprint $table) {
            $table->index(['product_variant_id', 'language']);
        });

        Schema::table('product_variant_details', function (Blueprint $table) {
            $table->index(['product_variant_id', 'language']);
        });

        Schema::table('product_variant_options', function (Blueprint $table) {
            $table->index(['product_variant_id', 'language']);
        });

        Schema::table('product_variant_attachments', function (Blueprint $table) {
            $table->index(['product_variant_id', 'language']);
        });

        Schema::table('product_variant_plans', function (Blueprint $table) {
            $table->index(['product_variant_id', 'language']);
        });

        Schema::table('product_variants', function (Blueprint $table) {
            $table->index(['product_id', 'is_active']);
        });
    }

    public function down(): void
    {
        Schema::table('translations_products', function (Blueprint $table) {
            $table->dropIndex(['product_id', 'language']);
        });

        Schema::table('translations_product_variants', function (Blueprint $table) {
            $table->dropIndex(['product_variant_id', 'language']);
        });

        Schema::table('product_variant_details', function (Blueprint $table) {
            $table->dropIndex(['product_variant_id', 'language']);
        });

        Schema::table('product_variant_options', function (Blueprint $table) {
            $table->dropIndex(['product_variant_id', 'language']);
        });

        Schema::table('product_variant_attachments', function (Blueprint $table) {
            $table->dropIndex(['product_variant_id', 'language']);
        });

        Schema::table('product_variant_plans', function (Blueprint $table) {
            $table->dropIndex(['product_variant_id', 'language']);
        });

        Schema::table('product_variants', function (Blueprint $table) {
            $table->dropIndex(['product_id', 'is_active']);
        });
    }
};
