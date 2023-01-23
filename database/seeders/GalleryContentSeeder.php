<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GalleryContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('gallery_contents')->insert([
        [
          'title' => 'Modulis Lund',
          'content' => '<p>MODERN HOUSE realizē projektus, kuri ir veidoti ar kvalitāti, estētiku, komfortu un ilgtspējību.</p>',
          'created_at' => Carbon::now(),
        ],
        [
          'title' => 'Modulis Malmö',
          'content' => '<p>MODERN HOUSE realizē projektus, kuri ir veidoti ar kvalitāti, estētiku, komfortu un ilgtspējību.</p>',
          'created_at' => Carbon::now(),
        ],
        [
          'title' => 'Modulis Visby',
          'content' => '<p>MODERN HOUSE realizē projektus, kuri ir veidoti ar kvalitāti, estētiku, komfortu un ilgtspējību.</p>',
          'created_at' => Carbon::now(),
        ],
        [
          'title' => 'Vītolu ielas projekts',
          'content' => '<p>MODERN HOUSE realizē projektus, kuri ir veidoti ar kvalitāti, estētiku, komfortu un ilgtspējību.</p>',
          'created_at' => Carbon::now(),
        ],
        [
          'title' => 'Vītolu ielas dvīņu māja',
          'content' => '<p>MODERN HOUSE realizē projektus, kuri ir veidoti ar kvalitāti, estētiku, komfortu un ilgtspējību.</p>',
          'created_at' => Carbon::now(),
        ],
        [
          'title' => 'Atbrīvotāju ielas kvartāls',
          'content' => '<p>MODERN HOUSE realizē projektus, kuri ir veidoti ar kvalitāti, estētiku, komfortu un ilgtspējību.</p>',
          'created_at' => Carbon::now(),
        ],
        [
          'title' => 'Vītolu ielas interjers',
          'content' => '<p>MODERN HOUSE realizē projektus, kuri ir veidoti ar kvalitāti, estētiku, komfortu un ilgtspējību.</p>',
          'created_at' => Carbon::now(),
        ],
        [
          'title' => 'Interjera koncepta vizualizācijas',
          'content' => '<p>MODERN HOUSE realizē projektus, kuri ir veidoti ar kvalitāti, estētiku, komfortu un ilgtspējību.</p>',
          'created_at' => Carbon::now(),
        ],
      ]);
    }
}
