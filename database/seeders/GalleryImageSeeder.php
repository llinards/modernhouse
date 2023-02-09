<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GalleryImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('gallery_images')->insert([
        [
          'filename' => '1.jpg',
          'gallery_content_id' => 1,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '2.jpg',
         'gallery_content_id' => 1,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '3.jpg',
         'gallery_content_id' => 1,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '4.jpg',
         'gallery_content_id' => 1,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '5.jpg',
         'gallery_content_id' => 1,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '6.jpg',
         'gallery_content_id' => 1,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '7.jpg',
         'gallery_content_id' => 1,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '1.jpg',
         'gallery_content_id' => 2,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '2.jpg',
         'gallery_content_id' => 2,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '3.jpg',
         'gallery_content_id' => 2,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '4.jpg',
         'gallery_content_id' => 2,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '5.jpg',
         'gallery_content_id' => 2,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '6.jpg',
         'gallery_content_id' => 2,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '7.jpg',
         'gallery_content_id' => 2,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '1.jpg',
         'gallery_content_id' => 3,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '2.jpg',
         'gallery_content_id' => 3,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '3.jpg',
         'gallery_content_id' => 3,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '4.jpg',
         'gallery_content_id' => 3,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '5.jpg',
         'gallery_content_id' => 3,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '6.jpg',
         'gallery_content_id' => 3,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '7.jpg',
         'gallery_content_id' => 3,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '1.jpg',
          'gallery_content_id' => 4,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '2.jpg',
          'gallery_content_id' => 4,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '3.jpg',
          'gallery_content_id' => 4,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '4.jpg',
          'gallery_content_id' => 4,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '5.jpg',
          'gallery_content_id' => 4,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '6.jpg',
          'gallery_content_id' => 4,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '7.jpg',
          'gallery_content_id' => 4,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '8.jpg',
          'gallery_content_id' => 4,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '9.jpg',
          'gallery_content_id' => 4,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '10.jpg',
          'gallery_content_id' => 4,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '1.jpg',
          'gallery_content_id' => 5,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '2.jpg',
          'gallery_content_id' => 5,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '3.jpg',
          'gallery_content_id' => 5,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '4.jpg',
          'gallery_content_id' => 5,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '5.jpg',
          'gallery_content_id' => 5,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '6.jpg',
          'gallery_content_id' => 5,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '7.jpg',
          'gallery_content_id' => 5,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '8.jpg',
          'gallery_content_id' => 5,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '9.jpg',
          'gallery_content_id' => 5,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '10.jpg',
          'gallery_content_id' => 5,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '11.jpg',
          'gallery_content_id' => 5,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '1.jpg',
         'gallery_content_id' => 6,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '2.jpg',
         'gallery_content_id' => 6,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '3.jpg',
         'gallery_content_id' => 6,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '4.jpg',
         'gallery_content_id' => 6,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '5.jpg',
         'gallery_content_id' => 6,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '6.jpg',
         'gallery_content_id' => 6,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '7.jpg',
         'gallery_content_id' => 6,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '8.jpg',
         'gallery_content_id' => 6,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '9.jpg',
         'gallery_content_id' => 6,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '10.jpg',
         'gallery_content_id' => 6,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '11.jpg',
         'gallery_content_id' => 6,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '12.jpg',
         'gallery_content_id' => 6,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '13.jpg',
         'gallery_content_id' => 6,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '1.jpg',
         'gallery_content_id' => 7,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '2.jpg',
         'gallery_content_id' => 7,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '3.jpg',
         'gallery_content_id' => 7,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '4.jpg',
         'gallery_content_id' => 7,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '5.jpg',
         'gallery_content_id' => 7,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '6.jpg',
         'gallery_content_id' => 7,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '7.jpg',
         'gallery_content_id' => 7,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '0.jpg',
          'gallery_content_id' => 8,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '1.jpg',
         'gallery_content_id' => 8,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '2.jpg',
         'gallery_content_id' => 8,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '3.jpg',
         'gallery_content_id' => 8,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '4.jpg',
         'gallery_content_id' => 8,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '5.jpg',
         'gallery_content_id' => 8,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '6.jpg',
         'gallery_content_id' => 8,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '7.jpg',
         'gallery_content_id' => 8,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '8.jpg',
         'gallery_content_id' => 8,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '9.jpg',
         'gallery_content_id' => 8,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '10.jpg',
         'gallery_content_id' => 8,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '11.jpg',
         'gallery_content_id' => 8,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '12.jpg',
         'gallery_content_id' => 8,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '13.jpg',
         'gallery_content_id' => 8,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '14.jpg',
         'gallery_content_id' => 8,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '15.jpg',
         'gallery_content_id' => 8,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '16.jpg',
         'gallery_content_id' => 8,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '17.jpg',
         'gallery_content_id' => 8,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '18.jpg',
         'gallery_content_id' => 8,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '19.jpg',
          'gallery_content_id' => 8,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '1.jpeg',
         'gallery_content_id' => 9,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '3.jpeg',
         'gallery_content_id' => 9,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '4.jpeg',
         'gallery_content_id' => 9,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '5.jpeg',
         'gallery_content_id' => 9,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '6.jpeg',
         'gallery_content_id' => 9,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '7.jpeg',
         'gallery_content_id' => 9,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '8.jpeg',
         'gallery_content_id' => 9,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '9.jpeg',
         'gallery_content_id' => 9,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '10.jpeg',
         'gallery_content_id' => 9,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '11.jpeg',
         'gallery_content_id' => 9,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '12.jpeg',
         'gallery_content_id' => 9,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '13.jpeg',
         'gallery_content_id' => 9,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '14.jpeg',
         'gallery_content_id' => 9,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '15.jpeg',
         'gallery_content_id' => 9,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '16.jpeg',
         'gallery_content_id' => 9,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '17.jpeg',
         'gallery_content_id' => 9,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '18.jpeg',
         'gallery_content_id' => 9,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '19.jpeg',
         'gallery_content_id' => 9,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '20.jpeg',
         'gallery_content_id' => 9,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '21.jpeg',
         'gallery_content_id' => 9,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '22.jpeg',
         'gallery_content_id' => 9,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '23.jpeg',
         'gallery_content_id' => 9,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '24.jpeg',
         'gallery_content_id' => 9,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '25.jpeg',
         'gallery_content_id' => 9,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '26.jpeg',
         'gallery_content_id' => 9,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '27.jpeg',
         'gallery_content_id' => 9,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '28.jpeg',
         'gallery_content_id' => 9,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '29.jpeg',
         'gallery_content_id' => 9,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '30.jpeg',
         'gallery_content_id' => 9,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '31.jpeg',
         'gallery_content_id' => 9,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '32.jpeg',
         'gallery_content_id' => 9,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '33.jpeg',
         'gallery_content_id' => 9,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '1.jpg',
          'gallery_content_id' => 10,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '2.jpg',
          'gallery_content_id' => 10,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '3.jpg',
          'gallery_content_id' => 10,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '1.jpg',
          'gallery_content_id' => 11,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '2.jpg',
          'gallery_content_id' => 11,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '3.jpg',
          'gallery_content_id' => 11,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '4.jpg',
          'gallery_content_id' => 11,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '5.jpg',
          'gallery_content_id' => 11,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '1.jpeg',
         'gallery_content_id' => 12,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '2.jpeg',
         'gallery_content_id' => 12,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '3.jpeg',
         'gallery_content_id' => 12,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '4.jpeg',
         'gallery_content_id' => 12,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '5.jpeg',
         'gallery_content_id' => 12,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '6.jpeg',
         'gallery_content_id' => 12,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '7.jpeg',
         'gallery_content_id' => 12,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '8.jpeg',
         'gallery_content_id' => 12,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '9.jpeg',
         'gallery_content_id' => 12,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '10.jpeg',
         'gallery_content_id' => 12,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '11.jpeg',
         'gallery_content_id' => 12,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '12.jpeg',
         'gallery_content_id' => 12,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '13.jpeg',
         'gallery_content_id' => 12,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '1.jpg',
          'gallery_content_id' => 13,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '2.jpg',
          'gallery_content_id' => 13,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '3.jpg',
          'gallery_content_id' => 13,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '4.jpg',
          'gallery_content_id' => 13,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '5.jpg',
          'gallery_content_id' => 13,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '6.jpg',
          'gallery_content_id' => 13,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '7.jpg',
          'gallery_content_id' => 13,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '8.jpg',
          'gallery_content_id' => 13,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '9.jpg',
          'gallery_content_id' => 13,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '10.jpg',
          'gallery_content_id' => 13,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '11.jpg',
          'gallery_content_id' => 13,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '12.jpg',
          'gallery_content_id' => 13,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '13.jpg',
          'gallery_content_id' => 13,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '14.jpg',
          'gallery_content_id' => 13,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '15.jpg',
          'gallery_content_id' => 13,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '16.jpg',
          'gallery_content_id' => 13,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '17.jpg',
          'gallery_content_id' => 13,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '18.jpg',
          'gallery_content_id' => 13,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '19.jpg',
          'gallery_content_id' => 13,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '20.jpg',
          'gallery_content_id' => 13,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '21.jpg',
          'gallery_content_id' => 13,
          'created_at' => Carbon::now(),
        ],
        [
          'filename' => '22.jpg',
          'gallery_content_id' => 13,
          'created_at' => Carbon::now(),
        ],
      ]);
    }
}
