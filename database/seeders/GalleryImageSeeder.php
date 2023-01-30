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
          'image_location' => 'modulis-orebro/1.jpg',
          'gallery_content_id' => 4,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'modulis-orebro/2.jpg',
          'gallery_content_id' => 4,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'modulis-orebro/3.jpg',
          'gallery_content_id' => 4,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'modulis-orebro/4.jpg',
          'gallery_content_id' => 4,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'modulis-orebro/5.jpg',
          'gallery_content_id' => 4,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'modulis-orebro/6.jpg',
          'gallery_content_id' => 4,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'modulis-orebro/7.jpg',
          'gallery_content_id' => 4,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'modulis-orebro/8.jpg',
          'gallery_content_id' => 4,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'modulis-orebro/9.jpg',
          'gallery_content_id' => 4,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'modulis-orebro/10.jpg',
          'gallery_content_id' => 4,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'modulis-idre/1.jpg',
          'gallery_content_id' => 5,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'modulis-idre/2.jpg',
          'gallery_content_id' => 5,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'modulis-idre/3.jpg',
          'gallery_content_id' => 5,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'modulis-idre/4.jpg',
          'gallery_content_id' => 5,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'modulis-idre/5.jpg',
          'gallery_content_id' => 5,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'modulis-idre/6.jpg',
          'gallery_content_id' => 5,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'modulis-idre/7.jpg',
          'gallery_content_id' => 5,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'modulis-idre/8.jpg',
          'gallery_content_id' => 5,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'modulis-idre/9.jpg',
          'gallery_content_id' => 5,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'modulis-idre/10.jpg',
          'gallery_content_id' => 5,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'modulis-idre/11.jpg',
          'gallery_content_id' => 5,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'vitolu-ielas-projekts/1.jpg',
         'gallery_content_id' => 6,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'vitolu-ielas-projekts/2.jpg',
         'gallery_content_id' => 6,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'vitolu-ielas-projekts/3.jpg',
         'gallery_content_id' => 6,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'vitolu-ielas-projekts/4.jpg',
         'gallery_content_id' => 6,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'vitolu-ielas-projekts/5.jpg',
         'gallery_content_id' => 6,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'vitolu-ielas-projekts/6.jpg',
         'gallery_content_id' => 6,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'vitolu-ielas-projekts/7.jpg',
         'gallery_content_id' => 6,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'vitolu-ielas-projekts/8.jpg',
         'gallery_content_id' => 6,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'vitolu-ielas-projekts/9.jpg',
         'gallery_content_id' => 6,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'vitolu-ielas-projekts/10.jpg',
         'gallery_content_id' => 6,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'vitolu-ielas-projekts/11.jpg',
         'gallery_content_id' => 6,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'vitolu-ielas-projekts/12.jpg',
         'gallery_content_id' => 6,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'vitolu-ielas-projekts/13.jpg',
         'gallery_content_id' => 6,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'vitolu-ielas-dvinu-maja/1.jpg',
         'gallery_content_id' => 7,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'vitolu-ielas-dvinu-maja/2.jpg',
         'gallery_content_id' => 7,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'vitolu-ielas-dvinu-maja/3.jpg',
         'gallery_content_id' => 7,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'vitolu-ielas-dvinu-maja/4.jpg',
         'gallery_content_id' => 7,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'vitolu-ielas-dvinu-maja/5.jpg',
         'gallery_content_id' => 7,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'vitolu-ielas-dvinu-maja/6.jpg',
         'gallery_content_id' => 7,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'vitolu-ielas-dvinu-maja/7.jpg',
         'gallery_content_id' => 7,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'atbrivotaju-ielas-projekts/0.jpg',
          'gallery_content_id' => 8,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'atbrivotaju-ielas-projekts/1.jpg',
         'gallery_content_id' => 8,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'atbrivotaju-ielas-projekts/2.jpg',
         'gallery_content_id' => 8,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'atbrivotaju-ielas-projekts/3.jpg',
         'gallery_content_id' => 8,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'atbrivotaju-ielas-projekts/4.jpg',
         'gallery_content_id' => 8,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'atbrivotaju-ielas-projekts/5.jpg',
         'gallery_content_id' => 8,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'atbrivotaju-ielas-projekts/6.jpg',
         'gallery_content_id' => 8,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'atbrivotaju-ielas-projekts/7.jpg',
         'gallery_content_id' => 8,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'atbrivotaju-ielas-projekts/8.jpg',
         'gallery_content_id' => 8,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'atbrivotaju-ielas-projekts/9.jpg',
         'gallery_content_id' => 8,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'atbrivotaju-ielas-projekts/10.jpg',
         'gallery_content_id' => 8,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'atbrivotaju-ielas-projekts/11.jpg',
         'gallery_content_id' => 8,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'atbrivotaju-ielas-projekts/12.jpg',
         'gallery_content_id' => 8,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'atbrivotaju-ielas-projekts/13.jpg',
         'gallery_content_id' => 8,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'atbrivotaju-ielas-projekts/14.jpg',
         'gallery_content_id' => 8,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'atbrivotaju-ielas-projekts/15.jpg',
         'gallery_content_id' => 8,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'atbrivotaju-ielas-projekts/16.jpg',
         'gallery_content_id' => 8,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'atbrivotaju-ielas-projekts/17.jpg',
         'gallery_content_id' => 8,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'atbrivotaju-ielas-projekts/18.jpg',
         'gallery_content_id' => 8,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'atbrivotaju-ielas-projekts/19.jpg',
          'gallery_content_id' => 8,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'vitolu-ielas-interjers/1.jpeg',
         'gallery_content_id' => 9,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'vitolu-ielas-interjers/3.jpeg',
         'gallery_content_id' => 9,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'vitolu-ielas-interjers/4.jpeg',
         'gallery_content_id' => 9,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'vitolu-ielas-interjers/5.jpeg',
         'gallery_content_id' => 9,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'vitolu-ielas-interjers/6.jpeg',
         'gallery_content_id' => 9,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'vitolu-ielas-interjers/7.jpeg',
         'gallery_content_id' => 9,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'vitolu-ielas-interjers/8.jpeg',
         'gallery_content_id' => 9,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'vitolu-ielas-interjers/9.jpeg',
         'gallery_content_id' => 9,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'vitolu-ielas-interjers/10.jpeg',
         'gallery_content_id' => 9,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'vitolu-ielas-interjers/11.jpeg',
         'gallery_content_id' => 9,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'vitolu-ielas-interjers/12.jpeg',
         'gallery_content_id' => 9,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'vitolu-ielas-interjers/13.jpeg',
         'gallery_content_id' => 9,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'vitolu-ielas-interjers/14.jpeg',
         'gallery_content_id' => 9,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'vitolu-ielas-interjers/15.jpeg',
         'gallery_content_id' => 9,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'vitolu-ielas-interjers/16.jpeg',
         'gallery_content_id' => 9,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'vitolu-ielas-interjers/17.jpeg',
         'gallery_content_id' => 9,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'vitolu-ielas-interjers/18.jpeg',
         'gallery_content_id' => 9,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'vitolu-ielas-interjers/19.jpeg',
         'gallery_content_id' => 9,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'vitolu-ielas-interjers/20.jpeg',
         'gallery_content_id' => 9,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'vitolu-ielas-interjers/21.jpeg',
         'gallery_content_id' => 9,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'vitolu-ielas-interjers/22.jpeg',
         'gallery_content_id' => 9,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'vitolu-ielas-interjers/23.jpeg',
         'gallery_content_id' => 9,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'vitolu-ielas-interjers/24.jpeg',
         'gallery_content_id' => 9,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'vitolu-ielas-interjers/25.jpeg',
         'gallery_content_id' => 9,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'vitolu-ielas-interjers/26.jpeg',
         'gallery_content_id' => 9,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'vitolu-ielas-interjers/27.jpeg',
         'gallery_content_id' => 9,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'vitolu-ielas-interjers/28.jpeg',
         'gallery_content_id' => 9,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'vitolu-ielas-interjers/29.jpeg',
         'gallery_content_id' => 9,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'vitolu-ielas-interjers/30.jpeg',
         'gallery_content_id' => 9,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'vitolu-ielas-interjers/31.jpeg',
         'gallery_content_id' => 9,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'vitolu-ielas-interjers/32.jpeg',
         'gallery_content_id' => 9,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'vitolu-ielas-interjers/33.jpeg',
         'gallery_content_id' => 9,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'sauna-ostersund/1.jpg',
          'gallery_content_id' => 10,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'sauna-ostersund/2.jpg',
          'gallery_content_id' => 10,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'sauna-ostersund/3.jpg',
          'gallery_content_id' => 10,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'sauna-are/1.jpg',
          'gallery_content_id' => 11,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'sauna-are/2.jpg',
          'gallery_content_id' => 11,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'sauna-are/3.jpg',
          'gallery_content_id' => 11,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'sauna-are/4.jpg',
          'gallery_content_id' => 11,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'sauna-are/5.jpg',
          'gallery_content_id' => 11,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'interjera-koncepta-vizualizacijas/1.jpeg',
         'gallery_content_id' => 12,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'interjera-koncepta-vizualizacijas/2.jpeg',
         'gallery_content_id' => 12,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'interjera-koncepta-vizualizacijas/3.jpeg',
         'gallery_content_id' => 12,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'interjera-koncepta-vizualizacijas/4.jpeg',
         'gallery_content_id' => 12,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'interjera-koncepta-vizualizacijas/5.jpeg',
         'gallery_content_id' => 12,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'interjera-koncepta-vizualizacijas/6.jpeg',
         'gallery_content_id' => 12,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'interjera-koncepta-vizualizacijas/7.jpeg',
         'gallery_content_id' => 12,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'interjera-koncepta-vizualizacijas/8.jpeg',
         'gallery_content_id' => 12,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'interjera-koncepta-vizualizacijas/9.jpeg',
         'gallery_content_id' => 12,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'interjera-koncepta-vizualizacijas/10.jpeg',
         'gallery_content_id' => 12,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'interjera-koncepta-vizualizacijas/11.jpeg',
         'gallery_content_id' => 12,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'interjera-koncepta-vizualizacijas/12.jpeg',
         'gallery_content_id' => 12,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'interjera-koncepta-vizualizacijas/13.jpeg',
         'gallery_content_id' => 12,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'individualie-projekti/1.jpg',
          'gallery_content_id' => 13,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'individualie-projekti/2.jpg',
          'gallery_content_id' => 13,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'individualie-projekti/3.jpg',
          'gallery_content_id' => 13,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'individualie-projekti/4.jpg',
          'gallery_content_id' => 13,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'individualie-projekti/5.jpg',
          'gallery_content_id' => 13,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'individualie-projekti/6.jpg',
          'gallery_content_id' => 13,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'individualie-projekti/7.jpg',
          'gallery_content_id' => 13,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'individualie-projekti/8.jpg',
          'gallery_content_id' => 13,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'individualie-projekti/9.jpg',
          'gallery_content_id' => 13,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'individualie-projekti/10.jpg',
          'gallery_content_id' => 13,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'individualie-projekti/11.jpg',
          'gallery_content_id' => 13,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'individualie-projekti/12.jpg',
          'gallery_content_id' => 13,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'individualie-projekti/13.jpg',
          'gallery_content_id' => 13,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'individualie-projekti/14.jpg',
          'gallery_content_id' => 13,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'individualie-projekti/15.jpg',
          'gallery_content_id' => 13,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'individualie-projekti/16.jpg',
          'gallery_content_id' => 13,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'individualie-projekti/17.jpg',
          'gallery_content_id' => 13,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'individualie-projekti/18.jpg',
          'gallery_content_id' => 13,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'individualie-projekti/19.jpg',
          'gallery_content_id' => 13,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'individualie-projekti/20.jpg',
          'gallery_content_id' => 13,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'individualie-projekti/21.jpg',
          'gallery_content_id' => 13,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'individualie-projekti/22.jpg',
          'gallery_content_id' => 13,
          'created_at' => Carbon::now(),
        ],
      ]);
    }
}
