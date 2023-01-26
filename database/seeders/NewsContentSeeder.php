<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NewsContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('news_contents')->insert([
        [
          'title' => 'Atbrīvotāju ielas projekts',
          'content' => '',
          'created_at' => Carbon::now(),
        ],
      ]);
    }
}
