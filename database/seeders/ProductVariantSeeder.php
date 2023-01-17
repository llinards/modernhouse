<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductVariantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('product_variants')->insert([
        [
          'product_id' => 1,
          'name' => 'Modulis Lund',
          'price_basic' => 44700,
          'price_full' => 66000,
          'description' => '<p>Pārvietojama koka karkasa moduļu māja. &Scaron;āda veida māju būvniecība ir salīdzino&scaron;i ātra un neaizņem ilgu projekta saskaņo&scaron;anas laiku.</p>
                            <p>&Scaron;im projektam nav nepiecie&scaron;ama būvatļauja (līdz apbūves platībai 60m&sup2;) un ir iespējams dzīvot uzreiz.</p>
                            <p>Projektos ir iespējami dažādi iek&scaron;ējās un ārējās apdares risinājumi, kā arī ir iespējams veikt izmaiņas telpu plānojumos.</p>',
          'created_at' => Carbon::now(),
        ],
        [
          'product_id' => 1,
          'name' => 'Modulis Malmö',
          'price_basic' => 26500,
          'price_full' => 43200,
          'description' => '<p>Pārvietojama koka karkasa moduļu māja. &Scaron;āda veida māju būvniecība ir salīdzino&scaron;i ātra un neaizņem ilgu projekta saskaņo&scaron;anas laiku.</p>
                            <p>&Scaron;im projektam nav nepiecie&scaron;ama būvatļauja (līdz apbūves platībai 60m&sup2;) un ir iespējams dzīvot uzreiz.</p>
                            <p>Projektos ir iespējami dažādi iek&scaron;ējās un ārējās apdares risinājumi, kā arī ir iespējams veikt izmaiņas telpu plānojumos.</p>',
          'created_at' => Carbon::now(),
        ],
        [
          'product_id' => 1,
          'name' => 'Modulis Visby',
          'price_basic' => 28000,
          'price_full' => 46900,
          'description' => '<p>Pārvietojama koka karkasa moduļu māja. &Scaron;āda veida māju būvniecība ir salīdzino&scaron;i ātra un neaizņem ilgu projekta saskaņo&scaron;anas laiku.</p>
                            <p>&Scaron;im projektam nav nepiecie&scaron;ama būvatļauja (līdz apbūves platībai 60m&sup2;) un ir iespējams dzīvot uzreiz.</p>
                            <p>Projektos ir iespējami dažādi iek&scaron;ējās un ārējās apdares risinājumi, kā arī ir iespējams veikt izmaiņas telpu plānojumos.</p>',
          'created_at' => Carbon::now(),
        ]
      ]);
    }
}
