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
            'option_type' => 'Ārsienas',
            'options_basic' => '<li>Vertikāls fasādes dēlis / Dabīgā šīfera loksnes CUPA H2</li>
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
              <li>Reģipsis mitrām telpām GKBI (12,5 mm) – materiāls piegādāts</li>',
            'options_full' => '<li>Vertikāls fasādes dēlis / Dabīgā šīfera loksnes CUPA H2</li>
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
              <li>Flīzes vannas istabā</li>
              '
          ],
          [
            'product_variant_id' => 1,
            'option_type' => 'Iekšējās sienas',
            'options_basic' => '<li>Reģipsis GKB (12,5mm)</li>
              <li>OSB 3 (10mm)</li>
              <li>Statņi koka karkasam C24 (45x75mm)</li>
              <li>Izolācija Isover KL 35 (75 mm) </li>
              <li>OSB 3 (10mm) – materiāls piegādāts</li>
              <li>Saplāksnis (15 mm) vannas istabā – materiāls piegādāts</li>
              <li>Reģipsis GKB (12,5mm) – materiāls piegādāts</li>
              <li>Reģipsis mitrām telpām GKBI (12,5 mm) vannas istabā – materiāls piegādāts</li>
              ',
            'options_full' => '<li>Reģipsis GKB (12,5mm)</li>
              <li>OSB 3 (10mm)</li>
              <li>Statņi koka karkasam C24 (45x75mm)</li>
              <li>Izolācija Isover KL 35 (75 mm) </li>
              <li>OSB 3 (10mm)</li>
              <li>Saplāksnis (15 mm) vannas istabā</li>
              <li>Hidroizolācija vannas istabā</li>
              <li>Reģipsis GKB (12,5mm)</li>
              <li>Reģipsis mitrām telpām GKBI (12,5 mm) vannas istabā</li>
              <li>Flīzes vannas istabā</li>
              '
          ],
          [
            'product_variant_id' => 1,
            'option_type' => 'Grīdas panelis',
            'options_basic' => '<li>OSB ar spundi (22mm)</li>
              <li>Koka karkass C24 (195x45mm)</li>
              <li>Izolācija Isover KL 35 (200mm) </li>
              <li>Cembrit Windstopper extreme (9 mm)</li>
              <li>Latojums, imprignēts (25x100mm)</li>
              ',
            'options_full' => '<li>Vinila grīdas segums ar apakšklāju</li>
              <li>Krāsotas grīdlīstes (12x95mm)</li>
              <li>Flīzes vannas istabā</li>
              <li>Hidroizolācija vannas istabā</li>
              <li>Vannas istabas grīdas betonēšana krituma izveidei</li>
              <li>OSB ar spundi (22mm)</li>
              <li>Koka karkass C24 (195x45mm)</li>
              <li>Izolācija Isover KL 35 (200mm) </li>
              <li>Cembrit Windstopper extreme (9 mm)</li>
              <li>Latojums, imprignēts (25x100mm)</li>
            '
          ],
          [
            'product_variant_id' => 1,
            'option_type' => 'Jumta panelis',
            'options_basic' => '<li>Bitumena ruļļu materiāls 2 kārtas</li>
              <li>Dēļu klājs ar spundi</li>
              <li>Latojums (45x45mm)</li>
              <li>Difūzijas membrāna (Siga Majvest 200)</li>
              <li>Koka karkass C24 (45x195mm)</li>
              <li>Izolācija Isover KL35 (200mm)</li>
              <li>Tvaika barjera (Siga Majpell 5)</li>
              <li>Latojums  (45x45)</li>
              <li>Izolācija Isover KL35 (50mm) – materiāls piegādāts</li>
              <li>Huntonit Antikk krāsoti kokšķiedru paneļi (11x300x1220mm) – materiāls piegādāts</li>
              ',
            'options_full' => '<li>Bitumena ruļļu materiāls 2 kārtas</li>
              <li>Dēļu klājs ar spundi</li>
              <li>Latojums  (45x45mm)</li>
              <li>Difūzijas membrāna (Siga Majvest 200)</li>
              <li>Koka karkass C24 (45x195mm)</li>
              <li>Izolācija Isover KL35 (200mm)</li>
              <li>Tvaika barjera (Siga Majpell 5)</li>
              <li>Latojums  (45x45)</li>
              <li>Izolācija Isover KL35 (50mm)</li>
              <li>Huntonit Antikk krāsoti kokšķiedru paneļi (11x300x1220mm)</li>
              '
          ],
          [
            'product_variant_id' => 1,
            'option_type' => 'Logi un durvis',
            'options_basic' => '<li>PVC 3 stiklu pakešu logi </li>
              <li>-	A+ klase, </li>
              <li>-	6 kameru 82 mm vācu profils (Salamander bluEnergy) </li>
              <li>-	48 mm stikla pakete ar Termix rāmi</li>
              <li>-	Roto NT furnitūra.</li>
              <li>Āra palodzes</li>
              ',
            'options_full' => '<li>PVC 3 stiklu pakešu logi </li>
              <li>-	A+ klase, </li>
              <li>-	6 kameru 82 mm vācu profils (Salamander bluEnergy) </li>
              <li>-	48 mm stikla pakete ar Termix rāmi</li>
              <li>-	Roto NT furnitūra.</li>
              <li>Āra palodzes</li>
              <li>Iekšējās palodzes</li>
              <li>Masīvkoka iekšdurvis</li>
              '
          ],
          [
            'product_variant_id' => 1,
            'option_type' => 'Pirts',
            'options_basic' => '-',
            'options_full' => '<li>Saunas apdares dēlis (apse)</li>
              <li>Latojums (25x50mm)</li>
              <li>Saunas izolācija ar folliju</li>
              <li>Saunas sēdvietas (apse)</li>
              <li>Saunas elektriskā krāsns</li>
            '
          ],
          [
            'product_variant_id' => 1,
            'option_type' => 'Vannasistaba',
            'options_basic' => '-',
            'options_full' => '<li>WC pods </li>
              <li>Izlietne ar maisītāju un kumodi </li>
              <li>Dušas maisītājs </li>
              <li>Dušas sienas</li>
              <li>Elektriskais ūdens sildītājs</li>
            '
          ],
          [
            'product_variant_id' => 1,
            'option_type' => 'Virtuve',
            'options_basic' => '-',
            'options_full' => '<li>Virtuves iekārta – laminētas kokšķiedras plātes korpuss, laminēta kokskaidu plātne ar HPL pārklājumu, krāsotas MDF fasādes, BLUM furnitūra ar softclose mehānismiem</li>
              <li>Indukcijas plīts virsma (Electrolux)</li>
              <li>Tvaika nosūcējs (Faber) </li>
              <li>Iebūvējamais ledusskapis (Electrolux)</li>
              <li>Iebūvējama mikroviļņu krāsns (Electrolux)</li>
              <li>Izlietne</li>
              <li>Jaucējkrāns </li>
            '
          ],
          [
            'product_variant_id' => 1,
            'option_type' => 'Elektrība',
            'options_basic' => '<li>Sagatavots pievads elektrības pievilkšanai</li>',
            'options_full' => '<li>Elektro instalācija veikta pēs Skandināvijas standartiem.</li>
            <li>Sienās iemontētas rozetes un kontaktslēdži (Jung LS 990 sērija)</li>
            '
          ],
          [
            'product_variant_id' => 1,
            'option_type' => 'Santehnika',
            'options_basic' => '<li>Sagatavots pievads santehnikas un elektrības pievilkšanai</li>',
            'options_full' => '<li>Konstrukcijās iestrādāti un pievienoti kanalizācijas un ūdens izvadi</li>'
          ],
          [
            'product_variant_id' => 1,
            'option_type' => 'Iekšējā apdare',
            'options_basic' => '-',
            'options_full' => '<li>Krāsotas reģipša sienas vai krāsoti apdares dēļi</li>'
          ],
          [
            'product_variant_id' => 1,
            'option_type' => 'Cenā nav iekļauts',
            'options_basic' => '<li>Pamatu izbūve (Stabveida pamati)</li>
                <li>Moduļa transportēšana</li>',
            'options_full' => '<li>Pamatu izbūve (Stabveida pamati)</li>
                <li>Moduļa transportēšana</li>'
          ],
        ]);
    }
}
