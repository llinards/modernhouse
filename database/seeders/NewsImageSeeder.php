<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NewsImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('news_images')->insert([
        [
          'image_location' => 'atbrivotaju-ielas-projekts/1.jpg',
          'news_content_id' => 1,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'atbrivotaju-ielas-projekts/2.jpg',
          'news_content_id' => 1,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'atbrivotaju-ielas-projekts/3.jpg',
          'news_content_id' => 1,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'atbrivotaju-ielas-projekts/4.jpg',
          'news_content_id' => 1,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'atbrivotaju-ielas-projekts/5.jpg',
          'news_content_id' => 1,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'atbrivotaju-ielas-projekts/6.jpg',
          'news_content_id' => 1,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'atbrivotaju-ielas-projekts/7.jpg',
          'news_content_id' => 1,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'atbrivotaju-ielas-projekts/8.jpg',
          'news_content_id' => 1,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'atbrivotaju-ielas-projekts/9.jpg',
          'news_content_id' => 1,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'atbrivotaju-ielas-projekts/10.jpg',
          'news_content_id' => 1,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'atbrivotaju-ielas-projekts/11.jpg',
          'news_content_id' => 1,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'atbrivotaju-ielas-projekts/12.jpg',
          'news_content_id' => 1,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'atbrivotaju-ielas-projekts/13.jpg',
          'news_content_id' => 1,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'atbrivotaju-ielas-projekts/14.jpg',
          'news_content_id' => 1,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'atbrivotaju-ielas-projekts/15.jpg',
          'news_content_id' => 1,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'atbrivotaju-ielas-projekts/16.jpg',
          'news_content_id' => 1,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'atbrivotaju-ielas-projekts/17.jpg',
          'news_content_id' => 1,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'atbrivotaju-ielas-projekts/18.jpg',
          'news_content_id' => 1,
          'created_at' => Carbon::now(),
        ],
        [
          'image_location' => 'atbrivotaju-ielas-projekts/19.jpg',
          'news_content_id' => 1,
          'created_at' => Carbon::now(),
        ],
      ]);
    }
}
