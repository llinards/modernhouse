<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductVariantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('product_variants')->insert([
        [
          'product_id' => 1,
          'name' => 'Model One - One',
          'price' => 250000,
          'price_basic' => 250000,
          'price_full' => 275000,
          'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quasi maxime earum cum dolorum, unde molestias eligendi debitis rem esse consequuntur odit alias voluptas dolor laudantium sit! Deserunt cum odio et?',
          'created_at' => Carbon::now(),
        ],
        [
          'product_id' => 1,
          'name' => 'Model One - Two',
          'price' => 275000,
          'price_basic' => 275000,
          'price_full' => 300000,
          'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quasi maxime earum cum dolorum, unde molestias eligendi debitis rem esse consequuntur odit alias voluptas dolor laudantium sit! Deserunt cum odio et?',
          'created_at' => Carbon::now(),
        ],
        [
          'product_id' => 1,
          'name' => 'Model One - Three',
          'price' => 300000,
          'price_basic' => 300000,
          'price_full' => 325000,
          'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quasi maxime earum cum dolorum, unde molestias eligendi debitis rem esse consequuntur odit alias voluptas dolor laudantium sit! Deserunt cum odio et?',
          'created_at' => Carbon::now(),
        ],
        [
          'product_id' => 2,
          'name' => 'Model Two',
          'price' => 500000,
          'price_basic' => 500000,
          'price_full' => 550000,
          'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quasi maxime earum cum dolorum, unde molestias eligendi debitis rem esse consequuntur odit alias voluptas dolor laudantium sit! Deserunt cum odio et?',
          'created_at' => Carbon::now(),
        ]
      ]);
    }
}
