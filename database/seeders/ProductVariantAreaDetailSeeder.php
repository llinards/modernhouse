<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductVariantAreaDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_variant_area_details')->insert([
          [
            'name' => 'Dzīvojamā platība',
            'square_meters' => 40.95,
            'product_variant_id' => 1,
            'created_at' => Carbon::now(),
          ],
          [
            'name' => 'Apbūves platība',
            'square_meters' => 52,
            'product_variant_id' => 1,
            'created_at' => Carbon::now(),
          ],
          [
            'name' => 'Dzīvojamā platība',
            'square_meters' => 27.1,
            'product_variant_id' => 2,
            'created_at' => Carbon::now(),
          ],
          [
            'name' => 'Apbūves platība',
            'square_meters' => 34.8,
            'product_variant_id' => 2,
            'created_at' => Carbon::now(),
          ],
          [
            'name' => 'Dzīvojamā platība',
            'square_meters' => 27.1,
            'product_variant_id' => 3,
            'created_at' => Carbon::now(),
          ],
          [
            'name' => 'Apbūves platība',
            'square_meters' => 34.8,
            'product_variant_id' => 3,
            'created_at' => Carbon::now(),
          ],
          [
            'name' => 'Dzīvojamā platība',
            'square_meters' => 144,
            'product_variant_id' => 4,
            'created_at' => Carbon::now(),
          ],
          [
            'name' => 'Apbūves platība',
            'square_meters' => 211.5,
            'product_variant_id' => 4,
            'created_at' => Carbon::now(),
          ],
          [
            'name' => 'Dzīvojamā platība',
            'square_meters' => 144,
            'product_variant_id' => 5,
            'created_at' => Carbon::now(),
          ],
          [
            'name' => 'Apbūves platība',
            'square_meters' => 228,
            'product_variant_id' => 5,
            'created_at' => Carbon::now(),
          ],
        ]);
    }
}
