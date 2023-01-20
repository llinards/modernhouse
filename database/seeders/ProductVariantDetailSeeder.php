<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductVariantDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_variant_details')->insert([
          [
            'name' => 'Guļamistabas',
            'hasThis' => true,
            'icon' => 'bed',
            'count' => 2,
            'product_variant_id' => 1,
            'created_at' => Carbon::now(),
          ],
          [
            'name' => 'Viesistaba ar virtuves zonu',
            'hasThis' => true,
            'icon' => 'fork-knife',
            'count' => 1,
            'product_variant_id' => 1,
            'created_at' => Carbon::now(),
          ],
          [
            'name' => 'Vannas istaba',
            'hasThis' => true,
            'icon' => 'bathtub',
            'count' => 1,
            'product_variant_id' => 1,
            'created_at' => Carbon::now(),
          ],
          [
            'name' => 'Lofts',
            'hasThis' => false,
            'icon' => 'ladder-simple',
            'count' => 0,
            'product_variant_id' => 1,
            'created_at' => Carbon::now(),
          ],
          [
            'name' => 'Sauna',
            'hasThis' => true,
            'icon' => 'leaf',
            'count' => 1,
            'product_variant_id' => 1,
            'created_at' => Carbon::now(),
          ],
          [
            'name' => 'Terase',
            'hasThis' => true,
            'icon' => 'selection-plus',
            'count' => 1,
            'product_variant_id' => 1,
            'created_at' => Carbon::now(),
          ],
          [
            'name' => 'Guļamistabas',
            'hasThis' => true,
            'icon' => 'bed',
            'count' => 1,
            'product_variant_id' => 2,
            'created_at' => Carbon::now(),
          ],
          [
            'name' => 'Viesistaba ar virtuves zonu',
            'hasThis' => true,
            'icon' => 'fork-knife',
            'count' => 1,
            'product_variant_id' => 2,
            'created_at' => Carbon::now(),
          ],
          [
            'name' => 'Vannas istaba',
            'hasThis' => true,
            'icon' => 'bathtub',
            'count' => 1,
            'product_variant_id' => 2,
            'created_at' => Carbon::now(),
          ],
          [
            'name' => 'Lofts 6,4 m2',
            'hasThis' => true,
            'icon' => 'ladder-simple',
            'count' => 0,
            'product_variant_id' => 2,
            'created_at' => Carbon::now(),
          ],
          [
            'name' => 'Sauna',
            'hasThis' => false,
            'icon' => 'leaf',
            'count' => 0,
            'product_variant_id' => 2,
            'created_at' => Carbon::now(),
          ],
          [
            'name' => 'Terase',
            'hasThis' => false,
            'icon' => 'selection-plus',
            'count' => 0,
            'product_variant_id' => 2,
            'created_at' => Carbon::now(),
          ],
          [
            'name' => 'Guļamistabas',
            'hasThis' => true,
            'icon' => 'bed',
            'count' => 1,
            'product_variant_id' => 3,
            'created_at' => Carbon::now(),
          ],
          [
            'name' => 'Viesistaba ar virtuves zonu',
            'hasThis' => true,
            'icon' => 'fork-knife',
            'count' => 1,
            'product_variant_id' => 3,
            'created_at' => Carbon::now(),
          ],
          [
            'name' => 'Vannas istaba',
            'hasThis' => true,
            'icon' => 'bathtub',
            'count' => 1,
            'product_variant_id' => 3,
            'created_at' => Carbon::now(),
          ],
          [
            'name' => 'Lofts 15,3 m2',
            'hasThis' => true,
            'icon' => 'ladder-simple',
            'count' => 0,
            'product_variant_id' => 3,
            'created_at' => Carbon::now(),
          ],
          [
            'name' => 'Sauna',
            'hasThis' => false,
            'icon' => 'leaf',
            'count' => 0,
            'product_variant_id' => 3,
            'created_at' => Carbon::now(),
          ],
          [
            'name' => 'Terase',
            'hasThis' => false,
            'icon' => 'selection-plus',
            'count' => 0,
            'product_variant_id' => 3,
            'created_at' => Carbon::now(),
          ]
        ]);
    }
}
