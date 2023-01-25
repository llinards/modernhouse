<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('products')->insert([
        [
          'name' => 'Moduļu Mājas',
          'slug' => 'modulu-majas',
          'cover_photo_filename' => 'cover.jpg',
          'created_at' => Carbon::now(),
          'is_active' => true
        ],
        [
          'name' => 'Dvīņu māja',
          'slug' => 'dvinu-maja',
          'cover_photo_filename' => 'cover.jpg',
          'created_at' => Carbon::now(),
          'is_active' => true
        ],
        [
          'name' => 'Privātmāja',
          'slug' => 'privatmaja',
          'cover_photo_filename' => 'cover.jpg',
          'created_at' => Carbon::now(),
          'is_active' => true
        ]
      ]);
    }
}
