<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('product_variant_details', function (Blueprint $table) {
            $table->integer('order')->default(0)->after('count');
        });

        // Backfill sequential order per variant+language group
        $groups = DB::table('product_variant_details')
            ->select('product_variant_id', 'language')
            ->distinct()
            ->get();

        foreach ($groups as $group) {
            $details = DB::table('product_variant_details')
                ->where('product_variant_id', $group->product_variant_id)
                ->where('language', $group->language)
                ->orderBy('id')
                ->get();

            foreach ($details as $index => $detail) {
                DB::table('product_variant_details')
                    ->where('id', $detail->id)
                    ->update(['order' => $index]);
            }
        }
    }

    public function down(): void
    {
        Schema::table('product_variant_details', function (Blueprint $table) {
            $table->dropColumn('order');
        });
    }
};
