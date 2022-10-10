<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('options')->insert([
        [
          'product_id' => 1,
          'name' => 'Model One - One',
          'price' => 250000,
          'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quasi maxime earum cum dolorum, unde molestias eligendi debitis rem esse consequuntur odit alias voluptas dolor laudantium sit! Deserunt cum odio et?',
          'created_at' => Carbon::now(),
        ],
        [
          'product_id' => 1,
          'name' => 'Model One - Two',
          'price' => 270000,
          'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quasi maxime earum cum dolorum, unde molestias eligendi debitis rem esse consequuntur odit alias voluptas dolor laudantium sit! Deserunt cum odio et?',
          'created_at' => Carbon::now(),
        ],
        [
          'product_id' => 1,
          'name' => 'Model One - Three',
          'price' => 300000,
          'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quasi maxime earum cum dolorum, unde molestias eligendi debitis rem esse consequuntur odit alias voluptas dolor laudantium sit! Deserunt cum odio et?',
          'created_at' => Carbon::now(),
        ],
        [
          'product_id' => 2,
          'name' => 'Model Two',
          'price' => 750000,
          'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quasi maxime earum cum dolorum, unde molestias eligendi debitis rem esse consequuntur odit alias voluptas dolor laudantium sit! Deserunt cum odio et?',
          'created_at' => Carbon::now(),
        ]
      ]);
    }
}
