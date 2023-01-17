<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('images')->insert([
          [
            'product_variant_id' => 1,
            'filename' => '1.jpg',
            'created_at' => Carbon::now()
          ],
          [
            'product_variant_id' => 1,
            'filename' => '2.jpg',
            'created_at' => Carbon::now()
          ],
          [
            'product_variant_id' => 1,
            'filename' => '3.jpg',
            'created_at' => Carbon::now()
          ],
          [
            'product_variant_id' => 1,
            'filename' => '4.jpg',
            'created_at' => Carbon::now()
          ],
          [
            'product_variant_id' => 1,
            'filename' => '5.jpg',
            'created_at' => Carbon::now()
          ],
          [
            'product_variant_id' => 1,
            'filename' => '6.jpg',
            'created_at' => Carbon::now()
          ],
          [
            'product_variant_id' => 1,
            'filename' => '7.jpg',
            'created_at' => Carbon::now()
          ],
          [
            'product_variant_id' => 2,
            'filename' => '1.jpg',
            'created_at' => Carbon::now()
          ],
          [
            'product_variant_id' => 2,
            'filename' => '2.jpg',
            'created_at' => Carbon::now()
          ],
          [
            'product_variant_id' => 2,
            'filename' => '3.jpg',
            'created_at' => Carbon::now()
          ],
          [
            'product_variant_id' => 2,
            'filename' => '4.jpg',
            'created_at' => Carbon::now()
          ],
          [
            'product_variant_id' => 2,
            'filename' => '5.jpg',
            'created_at' => Carbon::now()
          ],
          [
            'product_variant_id' => 2,
            'filename' => '6.jpg',
            'created_at' => Carbon::now()
          ],
          [
            'product_variant_id' => 2,
            'filename' => '7.jpg',
            'created_at' => Carbon::now()
          ],
          [
            'product_variant_id' => 2,
            'filename' => '8.jpg',
            'created_at' => Carbon::now()
          ],
          [
            'product_variant_id' => 2,
            'filename' => '9.jpg',
            'created_at' => Carbon::now()
          ],
          [
            'product_variant_id' => 2,
            'filename' => '10.jpg',
            'created_at' => Carbon::now()
          ],
          [
            'product_variant_id' => 2,
            'filename' => '12.jpg',
            'created_at' => Carbon::now()
          ],
          [
            'product_variant_id' => 2,
            'filename' => '13.jpg',
            'created_at' => Carbon::now()
          ],
          [
            'product_variant_id' => 2,
            'filename' => '14.jpg',
            'created_at' => Carbon::now()
          ],
          [
            'product_variant_id' => 2,
            'filename' => '15.jpg',
            'created_at' => Carbon::now()
          ],
          [
            'product_variant_id' => 2,
            'filename' => '16.jpg',
            'created_at' => Carbon::now()
          ],
          [
            'product_variant_id' => 2,
            'filename' => '17.jpg',
            'created_at' => Carbon::now()
          ],
          [
            'product_variant_id' => 2,
            'filename' => '18.jpg',
            'created_at' => Carbon::now()
          ],
          [
            'product_variant_id' => 2,
            'filename' => '19.jpg',
            'created_at' => Carbon::now()
          ],
          [
            'product_variant_id' => 2,
            'filename' => '20.jpg',
            'created_at' => Carbon::now()
          ],
          [
            'product_variant_id' => 2,
            'filename' => '21.jpg',
            'created_at' => Carbon::now()
          ],
          [
            'product_variant_id' => 2,
            'filename' => '22.jpg',
            'created_at' => Carbon::now()
          ],
          [
            'product_variant_id' => 3,
            'filename' => '1.jpg',
            'created_at' => Carbon::now()
          ],
          [
            'product_variant_id' => 3,
            'filename' => '2.jpg',
            'created_at' => Carbon::now()
          ],
          [
            'product_variant_id' => 3,
            'filename' => '3.jpg',
            'created_at' => Carbon::now()
          ],
          [
            'product_variant_id' => 3,
            'filename' => '4.jpg',
            'created_at' => Carbon::now()
          ],
          [
            'product_variant_id' => 3,
            'filename' => '5.jpg',
            'created_at' => Carbon::now()
          ],
          [
            'product_variant_id' => 3,
            'filename' => '6.jpg',
            'created_at' => Carbon::now()
          ],
          [
            'product_variant_id' => 3,
            'filename' => '7.jpg',
            'created_at' => Carbon::now()
          ],
          [
            'product_variant_id' => 3,
            'filename' => '8.jpg',
            'created_at' => Carbon::now()
          ],
          [
            'product_variant_id' => 3,
            'filename' => '9.jpg',
            'created_at' => Carbon::now()
          ],
          [
            'product_variant_id' => 3,
            'filename' => '10.jpg',
            'created_at' => Carbon::now()
          ],
          [
            'product_variant_id' => 3,
            'filename' => '11.jpg',
            'created_at' => Carbon::now()
          ],
          [
            'product_variant_id' => 3,
            'filename' => '12.jpg',
            'created_at' => Carbon::now()
          ],
          [
            'product_variant_id' => 3,
            'filename' => '13.jpg',
            'created_at' => Carbon::now()
          ],
          [
            'product_variant_id' => 3,
            'filename' => '14.jpg',
            'created_at' => Carbon::now()
          ],
          [
            'product_variant_id' => 3,
            'filename' => '15.jpg',
            'created_at' => Carbon::now()
          ]
        ]);
    }
}
