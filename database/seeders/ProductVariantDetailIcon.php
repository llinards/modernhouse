<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductVariantDetailIcon extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::table('product_variant_detail_icons')->insert([
      [
        'name' => 'auto_nojume.svg',
        'created_at' => Carbon::now(),
      ],
      [
        'name' => 'bathtub.svg',
        'created_at' => Carbon::now(),
      ],
      [
        'name' => 'bed.svg',
        'created_at' => Carbon::now(),
      ],
      [
        'name' => 'fork-knife.svg',
        'created_at' => Carbon::now(),
      ],
      [
        'name' => 'ladder-simple.svg',
        'created_at' => Carbon::now(),
      ],
      [
        'name' => 'leaf.svg',
        'created_at' => Carbon::now(),
      ],
      [
        'name' => 'noliktava.svg',
        'created_at' => Carbon::now(),
      ],
      [
        'name' => 'selection-plus.svg',
        'created_at' => Carbon::now(),
      ],
    ]);
  }
}
