<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductVariantOptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_variant_options')->insert([
          [
            'product_variant_id' => 1,
            'option_title' => 'Ārsienas',
            'option_category' => 'Basic',
            'options' => '<li>Vertikāls fasādes dēlis / Dabīgā šīfera loksnes CUPA H2</li>
              <li>Horizontālais latojums (25x100mm)</li>
              <li>Vertikālais Latojums (25x50mm)</li>
              <li>Peļu siets pa mājas perimetru</li>
              <li>Difūzijas membrāna (Siga Majvest 200)</li>
              <li>Vēja reģipsis Norgips GU (9,5mm)</li>
              <li>Statņi koka karkasam C24 (45x145mm)</li>
              <li>Izolācija Isover KL 35 (150mm) </li>
              <li>Tvaika barjeras plēve (Siga Majpell 5)</li>
              <li>Latojums (45x45mm)</li>
              <li>Izolācija Isover KL 35 (50mm) – materiāls piegādāts</li>
              <li>OSB 3 (10mm) – materiāls piegādāts </li>
              <li>Saplāksnis (15 mm) vannas istabā – materiāls piegādāts</li>
              <li>Reģipsis GKB (12,5mm) – materiāls piegādāts</li>
              <li>Reģipsis mitrām telpām GKBI (12,5 mm) – materiāls piegādāts</li>'
          ],
          [
            'product_variant_id' => 1,
            'option_title' => 'Ārsienas',
            'option_category' => 'Full',
            'options' => '<li>Vertikāls fasādes dēlis / Dabīgā šīfera loksnes CUPA H2</li>
              <li>Horizontālais latojums (25x100mm)</li>
              <li>Vertikālais Latojums (25x50mm)</li>
              <li>Peļu siets pa mājas perimetru</li>
              <li>Difūzijas membrāna (Siga Majvest 200)</li>
              <li>Vēja reģipsis Norgips GU (9,5mm)</li>
              <li>Statņi koka karkasam C24 (45x145mm)</li>
              <li>Izolācija Isover KL 35 (150mm) </li>
              <li>Tvaika barjeras plēve (Siga Majpell 5)</li>
              <li>Latojums (45x45mm)</li>
              <li>Izolācija Isover KL 35 (50mm) </li>
              <li>OSB 3 (10mm)</li>
              <li>Saplāksnis (15 mm) vannas istabā</li>
              <li>Hidroizolācija vannas istabā</li>
              <li>Reģipsis GKB (12,5mm)</li>
              <li>Reģipsis mitrām telpām GKBI (12,5 mm)</li>
              <li>Flīzes vannas istabā</li>'
          ],
          [
            'product_variant_id' => 1,
            'option_title' => 'Iekšējās sienas',
            'option_category' => 'Basic',
            'options' => '<li>Reģipsis GKB (12,5mm)</li>
              <li>OSB 3 (10mm)</li>
              <li>Statņi koka karkasam C24 (45x75mm)</li>
              <li>Izolācija Isover KL 35 (75 mm) </li>
              <li>OSB 3 (10mm) – materiāls piegādāts</li>
              <li>Saplāksnis (15 mm) vannas istabā – materiāls piegādāts</li>
              <li>Reģipsis GKB (12,5mm) – materiāls piegādāts</li>
              <li>Reģipsis mitrām telpām GKBI (12,5 mm) vannas istabā – materiāls piegādāts</li>'
          ],
          [
            'product_variant_id' => 1,
            'option_title' => 'Iekšējās sienas',
            'option_category' => 'Full',
            'options' => '<li>Reģipsis GKB (12,5mm)</li>
              <li>OSB 3 (10mm)</li>
              <li>Statņi koka karkasam C24 (45x75mm)</li>
              <li>Izolācija Isover KL 35 (75 mm) </li>
              <li>OSB 3 (10mm)</li>
              <li>Saplāksnis (15 mm) vannas istabā</li>
              <li>Hidroizolācija vannas istabā</li>
              <li>Reģipsis GKB (12,5mm)</li>
              <li>Reģipsis mitrām telpām GKBI (12,5 mm) vannas istabā</li>
              <li>Flīzes vannas istabā</li>'
          ]
        ]);
    }
}
