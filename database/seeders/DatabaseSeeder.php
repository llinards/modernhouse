<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
          ProductSeeder::class,
          ProductVariantSeeder::class,
          ImageSeeder::class,
          ProductVariantOptionSeeder::class,
          UserSeeder::class,
          ProductVariantAreaDetailSeeder::class,
          ProductVariantDetailSeeder::class,
//          NewsContentSeeder::class,
          GalleryContentSeeder::class,
          GalleryImageSeeder::class,
        ]);
    }
}
