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
          'price_basic' => 28000,
          'price_full' => 46900,
          'description' => '<p>Pārvietojama koka karkasa moduļu māja. &Scaron;āda veida māju būvniecība ir salīdzino&scaron;i ātra un neaizņem ilgu projekta saskaņo&scaron;anas laiku.</p>
                            <p>&Scaron;im projektam nav nepiecie&scaron;ama būvatļauja (līdz apbūves platībai 60m&sup2;) un ir iespējams dzīvot uzreiz.</p>
                            <p>Projektos ir iespējami dažādi iek&scaron;ējās un ārējās apdares risinājumi, kā arī ir iespējams veikt izmaiņas telpu plānojumos.</p>',
          'created_at' => Carbon::now(),
        ],
        [
          'product_id' => 1,
          'name' => 'Modulis Visby',
          'price_basic' => 26500,
          'price_full' => 43200,
          'description' => '<p>Pārvietojama koka karkasa moduļu māja. &Scaron;āda veida māju būvniecība ir salīdzino&scaron;i ātra un neaizņem ilgu projekta saskaņo&scaron;anas laiku.</p>
                            <p>&Scaron;im projektam nav nepiecie&scaron;ama būvatļauja (līdz apbūves platībai 60m&sup2;) un ir iespējams dzīvot uzreiz.</p>
                            <p>Projektos ir iespējami dažādi iek&scaron;ējās un ārējās apdares risinājumi, kā arī ir iespējams veikt izmaiņas telpu plānojumos.</p>',
          'created_at' => Carbon::now(),
        ]
      ]);
      DB::table('product_variants')->insert([
        [
          'product_id' => 2,
          'name' => 'Dvīņu māja',
          'price_basic' => 0,
          'price_full' => 0,
          'description' => '<p>Projekts ir veidots ar praktisku, pārdomātu plānojumu un modernu vizuālo risinājumu. Māju koncepts izstrādāts atbilstoši tam, lai ēkas iegūtu A+ energoefektivitātes pakāpi, kas pozitīvi atsauksies uz zemām ikmēneša komunālajām izmaksām.</p>
                            <p>Projektējot un būvējot mājas mēs domājam ilgtermiņā par klienta vēlmēm, kas atspoguļojas vizuālajā risinājumā un augstas kvalitātes koka karkasa tehnoloģijas izmantošanā.</p>',
          'created_at' => Carbon::now(),
        ],
      ]);
      DB::table('product_variants')->insert([
        [
          'product_id' => 3,
          'name' => 'Privātmāja',
          'price_basic' => 0,
          'price_full' => 0,
          'description' => '<p>Projekts ir veidots ar praktisku, pārdomātu plānojumu un modernu vizuālo risinājumu. Mājas koncepts izstrādāts atbilstoši tam, lai ēka iegūtu A+ energoefektivitātes pakāpi, kas pozitīvi atsauksies uz zemām ikmēneša komunālajām izmaksām.</p>
                            <p>Ēkas būvniecībai tiks izmantota vērienīgi uzkrātā pieredze būvējot un eksportējot mājas uz Zviedriju un ikviena mūsu klienta atsauksme kalpo par apliecinājumu kvalitātes garantam.</p>
                            <p>Projektējot un būvējot mājas mēs domājam ilgtermiņā par klienta vēlmēm, kas atspoguļojas vizuālajā risinājumā un augstas kvalitātes koka karkasa tehnoloģijas izmantošanā.</p>',
          'created_at' => Carbon::now(),
        ],
      ]);
      DB::table('product_variants')->insert([
        [
          'product_id' => 1,
          'name' => 'Modulis Örebro',
          'price_basic' => 43300,
          'price_full' => 64000,
          'description' => '<p>Pārvietojama koka karkasa moduļu māja. &Scaron;āda veida māju būvniecība ir salīdzino&scaron;i ātra un neaizņem ilgu projekta saskaņo&scaron;anas laiku.</p>
                            <p>&Scaron;im projektam nav nepiecie&scaron;ama būvatļauja (līdz apbūves platībai 60m&sup2;) un ir iespējams dzīvot uzreiz.</p>
                            <p>Projektos ir iespējami dažādi iek&scaron;ējās un ārējās apdares risinājumi, kā arī ir iespējams veikt izmaiņas telpu plānojumos.</p>',
          'created_at' => Carbon::now(),
        ],
        [
          'product_id' => 1,
          'name' => 'Modulis Idre',
          'price_basic' => 45000,
          'price_full' => 66400,
          'description' => '<p>Pārvietojama koka karkasa moduļu māja. &Scaron;āda veida māju būvniecība ir salīdzino&scaron;i ātra un neaizņem ilgu projekta saskaņo&scaron;anas laiku.</p>
                            <p>&Scaron;im projektam nav nepiecie&scaron;ama būvatļauja (līdz apbūves platībai 60m&sup2;) un ir iespējams dzīvot uzreiz.</p>
                            <p>Projektos ir iespējami dažādi iek&scaron;ējās un ārējās apdares risinājumi, kā arī ir iespējams veikt izmaiņas telpu plānojumos.</p>',
          'created_at' => Carbon::now(),
        ],
      ]);
    }
}
