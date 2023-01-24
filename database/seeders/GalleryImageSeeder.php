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
          'image_location' => 'modulis-lund/1.jpg',
          'gallery_content_id' => 1,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'modulis-lund/2.jpg',
         'gallery_content_id' => 1,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'modulis-lund/3.jpg',
         'gallery_content_id' => 1,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'modulis-lund/4.jpg',
         'gallery_content_id' => 1,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'modulis-lund/5.jpg',
         'gallery_content_id' => 1,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'modulis-lund/6.jpg',
         'gallery_content_id' => 1,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'modulis-lund/7.jpg',
         'gallery_content_id' => 1,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'modulis-malmo/1.jpg',
         'gallery_content_id' => 2,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'modulis-malmo/2.jpg',
         'gallery_content_id' => 2,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'modulis-malmo/3.jpg',
         'gallery_content_id' => 2,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'modulis-malmo/4.jpg',
         'gallery_content_id' => 2,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'modulis-malmo/5.jpg',
         'gallery_content_id' => 2,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'modulis-malmo/6.jpg',
         'gallery_content_id' => 2,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'modulis-malmo/7.jpg',
         'gallery_content_id' => 2,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'modulis-visby/1.jpg',
         'gallery_content_id' => 3,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'modulis-visby/2.jpg',
         'gallery_content_id' => 3,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'modulis-visby/3.jpg',
         'gallery_content_id' => 3,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'modulis-visby/4.jpg',
         'gallery_content_id' => 3,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'modulis-visby/5.jpg',
         'gallery_content_id' => 3,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'modulis-visby/6.jpg',
         'gallery_content_id' => 3,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'modulis-visby/7.jpg',
         'gallery_content_id' => 3,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'vitolu-ielas-projekts/1.jpg',
         'gallery_content_id' => 4,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'vitolu-ielas-projekts/2.jpg',
         'gallery_content_id' => 4,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'vitolu-ielas-projekts/3.jpg',
         'gallery_content_id' => 4,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'vitolu-ielas-projekts/4.jpg',
         'gallery_content_id' => 4,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'vitolu-ielas-projekts/5.jpg',
         'gallery_content_id' => 4,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'vitolu-ielas-projekts/6.jpg',
         'gallery_content_id' => 4,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'vitolu-ielas-projekts/7.jpg',
         'gallery_content_id' => 4,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'vitolu-ielas-projekts/8.jpg',
         'gallery_content_id' => 4,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'vitolu-ielas-projekts/9.jpg',
         'gallery_content_id' => 4,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'vitolu-ielas-projekts/10.jpg',
         'gallery_content_id' => 4,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'vitolu-ielas-projekts/11.jpg',
         'gallery_content_id' => 4,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'vitolu-ielas-projekts/12.jpg',
         'gallery_content_id' => 4,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'vitolu-ielas-projekts/13.jpg',
         'gallery_content_id' => 4,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'vitolu-ielas-dvinu-maja/1.jpg',
         'gallery_content_id' => 5,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'vitolu-ielas-dvinu-maja/2.jpg',
         'gallery_content_id' => 5,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'vitolu-ielas-dvinu-maja/3.jpg',
         'gallery_content_id' => 5,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'vitolu-ielas-dvinu-maja/4.jpg',
         'gallery_content_id' => 5,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'vitolu-ielas-dvinu-maja/5.jpg',
         'gallery_content_id' => 5,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'vitolu-ielas-dvinu-maja/6.jpg',
         'gallery_content_id' => 5,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'vitolu-ielas-dvinu-maja/7.jpg',
         'gallery_content_id' => 5,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'atbrivotaju-ielas-kvartals/0.jpg',
          'gallery_content_id' => 6,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'atbrivotaju-ielas-kvartals/1.jpg',
         'gallery_content_id' => 6,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'atbrivotaju-ielas-kvartals/2.jpg',
         'gallery_content_id' => 6,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'atbrivotaju-ielas-kvartals/3.jpg',
         'gallery_content_id' => 6,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'atbrivotaju-ielas-kvartals/4.jpg',
         'gallery_content_id' => 6,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'atbrivotaju-ielas-kvartals/5.jpg',
         'gallery_content_id' => 6,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'atbrivotaju-ielas-kvartals/6.jpg',
         'gallery_content_id' => 6,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'atbrivotaju-ielas-kvartals/7.jpg',
         'gallery_content_id' => 6,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'atbrivotaju-ielas-kvartals/8.jpg',
         'gallery_content_id' => 6,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'atbrivotaju-ielas-kvartals/9.jpg',
         'gallery_content_id' => 6,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'atbrivotaju-ielas-kvartals/10.jpg',
         'gallery_content_id' => 6,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'atbrivotaju-ielas-kvartals/11.jpg',
         'gallery_content_id' => 6,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'atbrivotaju-ielas-kvartals/12.jpg',
         'gallery_content_id' => 6,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'atbrivotaju-ielas-kvartals/13.jpg',
         'gallery_content_id' => 6,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'atbrivotaju-ielas-kvartals/14.jpg',
         'gallery_content_id' => 6,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'atbrivotaju-ielas-kvartals/15.jpg',
         'gallery_content_id' => 6,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'atbrivotaju-ielas-kvartals/16.jpg',
         'gallery_content_id' => 6,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'atbrivotaju-ielas-kvartals/17.jpg',
         'gallery_content_id' => 6,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'atbrivotaju-ielas-kvartals/18.jpg',
         'gallery_content_id' => 6,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'vitolu-ielas-interjers/1.jpeg',
         'gallery_content_id' => 7,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'vitolu-ielas-interjers/2.jpeg',
         'gallery_content_id' => 7,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'vitolu-ielas-interjers/3.jpeg',
         'gallery_content_id' => 7,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'vitolu-ielas-interjers/4.jpeg',
         'gallery_content_id' => 7,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'vitolu-ielas-interjers/5.jpeg',
         'gallery_content_id' => 7,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'vitolu-ielas-interjers/6.jpeg',
         'gallery_content_id' => 7,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'vitolu-ielas-interjers/7.jpeg',
         'gallery_content_id' => 7,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'vitolu-ielas-interjers/8.jpeg',
         'gallery_content_id' => 7,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'vitolu-ielas-interjers/9.jpeg',
         'gallery_content_id' => 7,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'vitolu-ielas-interjers/10.jpeg',
         'gallery_content_id' => 7,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'vitolu-ielas-interjers/11.jpeg',
         'gallery_content_id' => 7,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'vitolu-ielas-interjers/12.jpeg',
         'gallery_content_id' => 7,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'vitolu-ielas-interjers/13.jpeg',
         'gallery_content_id' => 7,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'vitolu-ielas-interjers/14.jpeg',
         'gallery_content_id' => 7,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'vitolu-ielas-interjers/15.jpeg',
         'gallery_content_id' => 7,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'vitolu-ielas-interjers/16.jpeg',
         'gallery_content_id' => 7,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'vitolu-ielas-interjers/17.jpeg',
         'gallery_content_id' => 7,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'vitolu-ielas-interjers/18.jpeg',
         'gallery_content_id' => 7,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'vitolu-ielas-interjers/19.jpeg',
         'gallery_content_id' => 7,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'vitolu-ielas-interjers/20.jpeg',
         'gallery_content_id' => 7,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'vitolu-ielas-interjers/21.jpeg',
         'gallery_content_id' => 7,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'vitolu-ielas-interjers/22.jpeg',
         'gallery_content_id' => 7,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'vitolu-ielas-interjers/23.jpeg',
         'gallery_content_id' => 7,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'vitolu-ielas-interjers/24.jpeg',
         'gallery_content_id' => 7,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'vitolu-ielas-interjers/25.jpeg',
         'gallery_content_id' => 7,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'vitolu-ielas-interjers/26.jpeg',
         'gallery_content_id' => 7,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'vitolu-ielas-interjers/27.jpeg',
         'gallery_content_id' => 7,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'vitolu-ielas-interjers/28.jpeg',
         'gallery_content_id' => 7,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'vitolu-ielas-interjers/29.jpeg',
         'gallery_content_id' => 7,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'vitolu-ielas-interjers/30.jpeg',
         'gallery_content_id' => 7,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'vitolu-ielas-interjers/31.jpeg',
         'gallery_content_id' => 7,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'vitolu-ielas-interjers/32.jpeg',
         'gallery_content_id' => 7,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'vitolu-ielas-interjers/33.jpeg',
         'gallery_content_id' => 7,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'interjera-koncepta-vizualizacijas/1.jpeg',
         'gallery_content_id' => 8,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'interjera-koncepta-vizualizacijas/2.jpeg',
         'gallery_content_id' => 8,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'interjera-koncepta-vizualizacijas/3.jpeg',
         'gallery_content_id' => 8,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'interjera-koncepta-vizualizacijas/4.jpeg',
         'gallery_content_id' => 8,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'interjera-koncepta-vizualizacijas/5.jpeg',
         'gallery_content_id' => 8,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'interjera-koncepta-vizualizacijas/6.jpeg',
         'gallery_content_id' => 8,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'interjera-koncepta-vizualizacijas/7.jpeg',
         'gallery_content_id' => 8,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'interjera-koncepta-vizualizacijas/8.jpeg',
         'gallery_content_id' => 8,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'interjera-koncepta-vizualizacijas/9.jpeg',
         'gallery_content_id' => 8,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'interjera-koncepta-vizualizacijas/10.jpeg',
         'gallery_content_id' => 8,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'interjera-koncepta-vizualizacijas/11.jpeg',
         'gallery_content_id' => 8,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'interjera-koncepta-vizualizacijas/12.jpeg',
         'gallery_content_id' => 8,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'interjera-koncepta-vizualizacijas/13.jpeg',
         'gallery_content_id' => 8,
          'created_at' => Carbon::now(),
        ],
      ]);
    }
}
