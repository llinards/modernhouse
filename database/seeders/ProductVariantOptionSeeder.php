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
            'options' => '
    <li>Vertikāls fasādes dēlis / Dabīgā šīfera loksnes CUPA H2</li>
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
            'option_title' => 'Iekšējās sienas',
            'option_category' => 'Basic',
            'options' => '
<li>Reģipsis GKB (12,5mm)</li>
<li>OSB 3 (10mm)</li>
<li>Statņi koka karkasam C24 (45x95mm)</li>
<li>Izolācija Isover KL 35 (100 mm) </li>
<li>OSB 3 (10mm) – materiāls piegādāts</li>
<li>Saplāksnis (15 mm) vannas istabā – materiāls piegādāts</li>
<li>Reģipsis GKB (12,5mm) – materiāls piegādāts</li>
<li>Reģipsis mitrām telpām GKBI (12,5 mm) vannas istabā – materiāls piegādāts</li>'
          ],
          [
            'product_variant_id' => 1,
            'option_title' => 'Grīdas panelis',
            'option_category' => 'Basic',
            'options' => '
<li>OSB ar spundi (22mm)</li>
<li>Koka karkass C24 (195x45mm)</li>
<li>Izolācija Isover KL 35 (200mm) </li>
<li>Cembrit Windstopper extreme (9 mm)</li>
<li>Latojums, imprignēts (25x100mm)</li>'
          ],
          [
            'product_variant_id' => 1,
            'option_title' => 'Jumta panelis',
            'option_category' => 'Basic',
            'options' => '
<li>Bitumena ruļļu materiāls 2 kārtas</li>
<li>Dēļu klājs ar spundi</li>
<li>Latojums (45x45mm)</li>
<li>Difūzijas membrāna (Siga Majvest 200)</li>
<li>Koka karkass C24 (45x195mm)</li>
<li>Izolācija Isover KL35 (200mm)</li>
<li>Tvaika barjera (Siga Majpell 5)</li>
<li>Latojums  (45x45)</li>
<li>Izolācija Isover KL35 (50mm) – materiāls piegādāts</li>
<li>Huntonit Antikk krāsoti kokšķiedru paneļi (11x300x1220mm) – materiāls piegādāts</li>'
          ],
          [
            'product_variant_id' => 1,
            'option_title' => 'Logi un durvis',
            'option_category' => 'Basic',
            'options' => '
<li>PVC 3 stiklu pakešu logi </li>
<li>-	A+ klase, </li>
<li>-	6 kameru 82 mm vācu profils (Salamander bluEnergy) </li>
<li>-	48 mm stikla pakete ar Termix rāmi</li>
<li>-	Roto NT furnitūra.</li>
<li>Āra palodzes</li>'
          ],
          [
            'product_variant_id' => 1,
            'option_title' => 'Elektroinstalācija',
            'option_category' => 'Basic',
            'options' => '
<li>Sagatavots pievads elektrības pievilkšanai</li>'
          ],
          [
            'product_variant_id' => 1,
            'option_title' => 'Santehnika',
            'option_category' => 'Basic',
            'options' => '
<li>Kanalizācijas iebūvēšana grīdā un pievada izbūve</li>
<li>Ūdens pievada izbūve</li>'
          ],
          [
            'product_variant_id' => 1,
            'option_title' => 'Cenā nav iekļauts',
            'option_category' => 'Basic',
            'options' => '
<li>Pamatu izbūve (Stabveida pamati)</li>
<li>Moduļa transportēšana</li>'
          ],
          [
            'product_variant_id' => 1,
            'option_title' => 'Ārsienas',
            'option_category' => 'Full',
            'options' => '
<li>Vertikāls fasādes dēlis / Dabīgā šīfera loksnes CUPA H2</li>
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
<li>Reģipsis GKB (12,5mm)</li>
<li>Reģipsis mitrām telpām GKBI (12,5 mm)</li>'
          ],
          [
            'product_variant_id' => 1,
            'option_title' => 'Iekšējās sienas',
            'option_category' => 'Full',
            'options' => '
<li>Reģipsis GKB (12,5mm)</li>
<li>OSB 3 (10mm)</li>
<li>Statņi koka karkasam C24 (45x95mm)</li>
<li>Izolācija Isover KL 35 (100 mm) </li>
<li>OSB 3 (10mm)</li>
<li>Saplāksnis (15 mm) vannas istabā</li>
<li>Reģipsis GKB (12,5mm)</li>
<li>Reģipsis mitrām telpām GKBI (12,5 mm) vannas istabā</li>'
          ],
          [
            'product_variant_id' => 1,
            'option_title' => 'Grīdas panelis',
            'option_category' => 'Full',
            'options' => '
<li>OSB ar spundi (22mm)</li>
<li>Koka karkass C24 (195x45mm)</li>
<li>Izolācija Isover KL 35 (200mm) </li>
<li>Cembrit Windstopper extreme (9 mm)</li>
<li>Latojums, imprignēts (25x100mm)</li>'
          ],
          [
            'product_variant_id' => 1,
            'option_title' => 'Jumta panelis',
            'option_category' => 'Full',
            'options' => '
<li>Bitumena ruļļu materiāls 2 kārtas</li>
<li>Dēļu klājs ar spundi</li>
<li>Latojums (45x45mm)</li>
<li>Difūzijas membrāna (Siga Majvest 200)</li>
<li>Koka karkass C24 (45x195mm)</li>
<li>Izolācija Isover KL35 (200mm)</li>
<li>Tvaika barjera (Siga Majpell 5)</li>
<li>Latojums  (45x45)</li>
<li>Izolācija Isover KL35 (50mm)</li>
<li>Huntonit Antikk krāsoti kokšķiedru paneļi (11x300x1220mm)</li>'
          ],
          [
            'product_variant_id' => 1,
            'option_title' => 'Logi un durvis',
            'option_category' => 'Full',
            'options' => '
<li>PVC 3 stiklu pakešu logi </li>
<li>-	A+ klase, </li>
<li>-	6 kameru 82 mm vācu profils (Salamander bluEnergy) </li>
<li>-	48 mm stikla pakete ar Termix rāmi</li>
<li>-	Roto NT furnitūra.</li>
<li>Āra palodzes</li>
<li>Iekšējās palodzes</li>
<li>Masīvkoka iekšdurvis</li>'
          ],
          [
            'product_variant_id' => 1,
            'option_title' => 'Pirts',
            'option_category' => 'Full',
            'options' => '
<li>Saunas apdares dēlis (apse)</li>
<li>Latojums (25x50mm)</li>
<li>Saunas izolācija ar folliju</li>
<li>Saunas sēdvietas (apse)</li>
<li>Saunas elektriskā krāsns</li>'
          ],
          [
            'product_variant_id' => 1,
            'option_title' => 'Vannasistaba',
            'option_category' => 'Full',
            'options' => '
<li>WC pods </li>
<li>Izlietne ar maisītāju un kumodi </li>
<li>Dušas maisītājs </li>
<li>Dušas sienas</li>
<li>Elektriskais ūdens sildītājs</li>'
          ],
          [
            'product_variant_id' => 1,
            'option_title' => 'Virtuve',
            'option_category' => 'Full',
            'options' => '
<li>Virtuves iekārta – laminētas kokšķiedras plātes korpuss, laminēta kokskaidu plātne ar HPL pārklājumu, krāsotas MDF fasādes, BLUM furnitūra ar softclose mehānismiem</li>
<li>Indukcijas plīts virsma (Electrolux)</li>
<li>Tvaika nosūcējs (Faber) </li>
<li>Iebūvējamais ledusskapis (Electrolux)</li>
<li>Iebūvējama mikroviļņu krāsns (Electrolux)</li>
<li>Izlietne</li>
<li>Jaucējkrāns </li>'
          ],
          [
            'product_variant_id' => 1,
            'option_title' => 'Elektroinstalācija',
            'option_category' => 'Full',
            'options' => '
<li>Elektroinstalācija veikta pēc Skandināvijas standartiem.</li>
<li>Sienās iemontētas rozetes un kontaktslēdži (Jung LS 990 sērija)</li>'
          ],
          [
            'product_variant_id' => 1,
            'option_title' => 'Santehnika',
            'option_category' => 'Full',
            'options' => '
<li>Konstrukcijās iestrādāti un pievienoti kanalizācijas un ūdens izvadi</li>'
          ],
          [
            'product_variant_id' => 1,
            'option_title' => 'Iekšējā apdare',
            'option_category' => 'Full',
            'options' => '
<li>Krāsotas reģipša sienas vai krāsoti apdares dēļi</li>
<li>Vinila grīdas segums ar apakšklāju</li>
<li>Krāsotas grīdlīstes</li>
<li>Flīzes vannas istabā</li>
<li>Hidroizolācija vannas istabā</li>
<li>Vannas istabas grīdas betonēšana krituma izveidei</li>'
          ],
          [
            'product_variant_id' => 1,
            'option_title' => 'Cenā nav iekļauts',
            'option_category' => 'Full',
            'options' => '
<li>Pamatu izbūve (Stabveida pamati)</li>
<li>Moduļa transportēšana</li>'
          ],
          [
            'product_variant_id' => 2,
            'option_title' => 'Ārsienas',
            'option_category' => 'Basic',
            'options' => '
  <li>Vertikāls fasādes dēlis / Dabīgā šīfera loksnes CUPA H2</li>
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
            'product_variant_id' => 2,
            'option_title' => 'Iekšējās sienas',
            'option_category' => 'Basic',
            'options' => '
<li>Reģipsis GKB (12,5mm)</li>
<li>OSB 3 (10mm)</li>
<li>Statņi koka karkasam C24 (45x95mm)</li>
<li>Izolācija Isover KL 35 (100 mm) </li>
<li>OSB 3 (10mm) – materiāls piegādāts</li>
<li>Saplāksnis (15 mm) vannas istabā – materiāls piegādāts</li>
<li>Reģipsis GKB (12,5mm) – materiāls piegādāts</li>
<li>Reģipsis mitrām telpām GKBI (12,5 mm) vannas istabā – materiāls piegādāts</li>'
          ],
          [
            'product_variant_id' => 2,
            'option_title' => 'Grīdas panelis',
            'option_category' => 'Basic',
            'options' => '
<li>OSB ar spundi (22mm)</li>
<li>Koka karkass C24 (195x45mm)</li>
<li>Izolācija Isover KL 35 (200mm) </li>
<li>Cembrit Windstopper extreme (9 mm)</li>
<li>Latojums, imprignēts (25x100mm)</li>'
          ],

          [
            'product_variant_id' => 2,
            'option_title' => 'Pārseguma panelis',
            'option_category' => 'Basic',
            'options' => '
<li>OSB ar spundi (22mm)</li>
<li>Koka karkass C24 (145x45mm)</li>
<li>Izolācija Isover KL 35 (100mm) </li>
<li>Latojums (28x70mm)</li>
<li>Reģipsis GKB (12,5mm) – materiāls piegādāts</li>'
          ],

          [
            'product_variant_id' => 2,
            'option_title' => 'Jumta panelis',
            'option_category' => 'Basic',
            'options' => '
<li>Valcprofils</li>
<li>ICOPAL apakšklājs</li>
<li>Dēļu klājs ar spundi</li>
<li>Latojums (45x45mm)</li>
<li>Difūzijas membrāna (Siga Majvest 200)</li>
<li>Koka karkass C24 (45x195mm)</li>
<li>Izolācija Isover KL35 (200mm)</li>
<li>Tvaika barjera (Siga Majpell 5)</li>
<li>Latojums  (45x45)</li>
<li>Izolācija Isover KL35 (50mm) – materiāls piegādāts</li>
<li>Reģipsis GKB (12,5mm) – materiāls piegādāts</li>'
          ],

          [
            'product_variant_id' => 2,
            'option_title' => 'Logi un durvis',
            'option_category' => 'Basic',
            'options' => '
<li>PVC 3 stiklu pakešu logi </li>
<li>-	A+ klase, </li>
<li>-	6 kameru 82 mm vācu profils (Salamander bluEnergy) </li>
<li>-	48 mm stikla pakete ar Termix rāmi</li>
<li>-	Roto NT furnitūra.</li>
<li>Āra palodzes</li>'
          ],

          [
            'product_variant_id' => 2,
            'option_title' => 'Elektroinstalācija',
            'option_category' => 'Basic',
            'options' => '
<li>Sagatavots pievads elektrības pievilkšanai</li>'
          ],

          [
            'product_variant_id' => 2,
            'option_title' => 'Santehnika',
            'option_category' => 'Basic',
            'options' => '
<li>Kanalizācijas iebūvēšana grīdā un pievada izbūve</li>
<li>Ūdens pievada izbūve</li>'
          ],

          [
            'product_variant_id' => 2,
            'option_title' => 'Cenā nav iekļauts',
            'option_category' => 'Basic',
            'options' => '
<li>Pamatu izbūve (Stabveida pamati)</li>
<li>Moduļa transportēšana</li>'
          ],

          [
            'product_variant_id' => 3,
            'option_title' => 'Ārsienas',
            'option_category' => 'Basic',
            'options' => '
<li>Vertikāls fasādes dēlis / Dabīgā šīfera loksnes CUPA H2</li>
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
            'product_variant_id' => 3,
            'option_title' => 'Iekšējās sienas',
            'option_category' => 'Basic',
            'options' => '
<li>Reģipsis GKB (12,5mm)</li>
<li>OSB 3 (10mm)</li>
<li>Statņi koka karkasam C24 (45x95mm)</li>
<li>Izolācija Isover KL 35 (100 mm) </li>
<li>OSB 3 (10mm) – materiāls piegādāts</li>
<li>Saplāksnis (15 mm) vannas istabā – materiāls piegādāts</li>
<li>Reģipsis GKB (12,5mm) – materiāls piegādāts</li>
<li>Reģipsis mitrām telpām GKBI (12,5 mm) vannas istabā – materiāls piegādāts</li>'
          ],
          [
            'product_variant_id' => 3,
            'option_title' => 'Grīdas panelis',
            'option_category' => 'Basic',
            'options' => '
<li>OSB ar spundi (22mm)</li>
<li>Koka karkass C24 (195x45mm)</li>
<li>Izolācija Isover KL 35 (200mm) </li>
<li>Cembrit Windstopper extreme (9 mm)</li>
<li>Latojums, imprignēts (25x100mm)</li>'
          ],

          [
            'product_variant_id' => 3,
            'option_title' => 'Pārseguma panelis',
            'option_category' => 'Basic',
            'options' => '
<li>OSB ar spundi (22mm)</li>
<li>Koka karkass C24 (145x45mm)</li>
<li>Izolācija Isover KL 35 (100mm) </li>
<li>Latojums (28x70mm)</li>
<li>Reģipsis GKB (12,5mm) – materiāls piegādāts</li>'
          ],

          [
            'product_variant_id' => 3,
            'option_title' => 'Jumta panelis',
            'option_category' => 'Basic',
            'options' => '
<li>Valcprofils</li>
<li>ICOPAL apakšklājs</li>
<li>Dēļu klājs ar spundi</li>
<li>Latojums (45x45mm)</li>
<li>Difūzijas membrāna (Siga Majvest 200)</li>
<li>Koka karkass C24 (45x195mm)</li>
<li>Izolācija Isover KL35 (200mm)</li>
<li>Tvaika barjera (Siga Majpell 5)</li>
<li>Latojums  (45x45)</li>
<li>Izolācija Isover KL35 (50mm) – materiāls piegādāts</li>
<li>Reģipsis GKB (12,5mm) – materiāls piegādāts</li>'
          ],

          [
            'product_variant_id' => 3,
            'option_title' => 'Logi un durvis',
            'option_category' => 'Basic',
            'options' => '
<li>PVC 3 stiklu pakešu logi </li>
<li>-	A+ klase, </li>
<li>-	6 kameru 82 mm vācu profils (Salamander bluEnergy) </li>
<li>-	48 mm stikla pakete ar Termix rāmi</li>
<li>-	Roto NT furnitūra.</li>
<li>Āra palodzes</li>'
          ],

          [
            'product_variant_id' => 3,
            'option_title' => 'Elektroinstalācija',
            'option_category' => 'Basic',
            'options' => '
<li>Sagatavots pievads elektrības pievilkšanai</li>'
          ],

          [
            'product_variant_id' => 3,
            'option_title' => 'Santehnika',
            'option_category' => 'Basic',
            'options' => '
<li>Kanalizācijas iebūvēšana grīdā un pievada izbūve</li>
<li>Ūdens pievada izbūve</li>'
          ],

          [
            'product_variant_id' => 3,
            'option_title' => 'Cenā nav iekļauts',
            'option_category' => 'Basic',
            'options' => '
<li>Pamatu izbūve (Stabveida pamati)</li>
<li>Moduļa transportēšana</li>'
          ],

          [
            'product_variant_id' => 2,
            'option_title' => 'Ārsienas',
            'option_category' => 'Full',
            'options' => '
<li>Vertikāls fasādes dēlis / Dabīgā šīfera loksnes CUPA H2</li>
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
<li>Reģipsis GKB (12,5mm)</li>
<li>Reģipsis mitrām telpām GKBI (12,5 mm)</li>'
          ],
          [
            'product_variant_id' => 2,
            'option_title' => 'Iekšējās sienas',
            'option_category' => 'Full',
            'options' => '
<li>Reģipsis GKB (12,5mm)</li>
<li>OSB 3 (10mm)</li>
<li>Statņi koka karkasam C24 (45x95mm)</li>
<li>Izolācija Isover KL 35 (100 mm) </li>
<li>OSB 3 (10mm)</li>
<li>Saplāksnis (15 mm) vannas istabā</li>
<li>Reģipsis GKB (12,5mm)</li>
<li>Reģipsis mitrām telpām GKBI (12,5 mm) vannas istabā</li>'
          ],
          [
            'product_variant_id' => 2,
            'option_title' => 'Grīdas panelis',
            'option_category' => 'Full',
            'options' => '
<li>OSB ar spundi (22mm)</li>
<li>Koka karkass C24 (195x45mm)</li>
<li>Izolācija Isover KL 35 (200mm) </li>
<li>Cembrit Windstopper extreme (9 mm)</li>
<li>Latojums, imprignēts (25x100mm)</li>'
          ],
          [
            'product_variant_id' => 2,
            'option_title' => 'Pārseguma panelis',
            'option_category' => 'Full',
            'options' => '
<li>OSB ar spundi (22mm)</li>
<li>Koka karkass C24 (145x45mm)</li>
<li>Izolācija Isover KL 35 (100mm) </li>
<li>Latojums (28x70mm)</li>
<li>Reģipsis GKB (12,5mm)</li>'
          ],
          [
            'product_variant_id' => 2,
            'option_title' => 'Jumta panelis',
            'option_category' => 'Full',
            'options' => '
<li>Valcprofils</li>
<li>ICOPAL apakšklājs</li>
<li>Dēļu klājs ar spundi</li>
<li>Latojums  (45x45mm)</li>
<li>Difūzijas membrāna (Siga Majvest 200)</li>
<li>Koka karkass C24 (45x195mm)</li>
<li>Izolācija Isover KL35 (200mm)</li>
<li>Tvaika barjera (Siga Majpell 5)</li>
<li>Latojums  (45x45)</li>
<li>Izolācija Isover KL35 (50mm)</li>
<li>Reģipsis GKB (12,5mm)</li>'
          ],
          [
            'product_variant_id' => 2,
            'option_title' => 'Logi un durvis',
            'option_category' => 'Full',
            'options' => '
<li>PVC 3 stiklu pakešu logi </li>
<li>-	A+ klase, </li>
<li>-	6 kameru 82 mm vācu profils (Salamander bluEnergy) </li>
<li>-	48 mm stikla pakete ar Termix rāmi</li>
<li>-	Roto NT furnitūra.</li>
<li>Āra palodzes</li>
<li>Iekšējās palodzes</li>
<li>Masīvkoka iekšdurvis</li>'
          ],
          [
            'product_variant_id' => 2,
            'option_title' => 'Vannasistaba',
            'option_category' => 'Full',
            'options' => '
<li>WC pods </li>
<li>Izlietne ar maisītāju un kumodi </li>
<li>Dušas maisītājs </li>
<li>Dušas sienas</li>
<li>Elektriskais ūdens sildītājs</li>'
          ],
          [
            'product_variant_id' => 2,
            'option_title' => 'Virtuve',
            'option_category' => 'Full',
            'options' => '
<li>Virtuves iekārta – laminētas kokšķiedras plātes korpuss, laminēta kokskaidu plātne ar HPL pārklājumu, krāsotas MDF fasādes, BLUM furnitūra ar softclose mehānismiem</li>
<li>Indukcijas plīts virsma (Electrolux)</li>
<li>Tvaika nosūcējs (Faber) </li>
<li>Iebūvējamais ledusskapis (Electrolux)</li>
<li>Iebūvējama mikroviļņu krāsns (Electrolux)</li>
<li>Izlietne</li>
<li>Jaucējkrāns </li>'
          ],
          [
            'product_variant_id' => 2,
            'option_title' => 'Elektroinstalācija',
            'option_category' => 'Full',
            'options' => '
<li>Elektroinstalācija veikta pēc Skandināvijas standartiem.</li>
<li>Sienās iemontētas rozetes un kontaktslēdži (Jung LS 990 sērija)</li>'
          ],
          [
            'product_variant_id' => 2,
            'option_title' => 'Santehnika',
            'option_category' => 'Full',
            'options' => '
<li>Konstrukcijās iestrādāti un pievienoti kanalizācijas un ūdens izvadi</li>'
          ],
          [
            'product_variant_id' => 2,
            'option_title' => 'Iekšējā apdare',
            'option_category' => 'Full',
            'options' => '
<li>Krāsotas reģipša sienas un griesti vai krāsoti apdares dēļi</li>
<li>Vinila grīdas segums ar apakšklāju</li>
<li>Krāsotas grīdlīstes</li>
<li>Flīzes vannas istabā</li>
<li>Hidroizolācija vannas istabā</li>
<li>Vannas istabas grīdas betonēšana krituma izveidei</li>'
          ],
          [
            'product_variant_id' => 2,
            'option_title' => 'Cenā nav iekļauts',
            'option_category' => 'Full',
            'options' => '
<li>Pamatu izbūve (Stabveida pamati)</li>
<li>Moduļa transportēšana</li>'
          ],
          [
            'product_variant_id' => 3,
            'option_title' => 'Ārsienas',
            'option_category' => 'Full',
            'options' => '
<li>Vertikāls fasādes dēlis / Dabīgā šīfera loksnes CUPA H2</li>
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
<li>Reģipsis GKB (12,5mm)</li>
<li>Reģipsis mitrām telpām GKBI (12,5 mm)</li>'
          ],
          [
            'product_variant_id' => 3,
            'option_title' => 'Iekšējās sienas',
            'option_category' => 'Full',
            'options' => '
<li>Reģipsis GKB (12,5mm)</li>
<li>OSB 3 (10mm)</li>
<li>Statņi koka karkasam C24 (45x95mm)</li>
<li>Izolācija Isover KL 35 (100 mm) </li>
<li>OSB 3 (10mm)</li>
<li>Saplāksnis (15 mm) vannas istabā</li>
<li>Reģipsis GKB (12,5mm)</li>
<li>Reģipsis mitrām telpām GKBI (12,5 mm) vannas istabā</li>'
          ],
          [
            'product_variant_id' => 3,
            'option_title' => 'Grīdas panelis',
            'option_category' => 'Full',
            'options' => '
<li>OSB ar spundi (22mm)</li>
<li>Koka karkass C24 (195x45mm)</li>
<li>Izolācija Isover KL 35 (200mm) </li>
<li>Cembrit Windstopper extreme (9 mm)</li>
<li>Latojums, imprignēts (25x100mm)</li>'
          ],
          [
            'product_variant_id' => 3,
            'option_title' => 'Pārseguma panelis',
            'option_category' => 'Full',
            'options' => '
<li>OSB ar spundi (22mm)</li>
<li>Koka karkass C24 (145x45mm)</li>
<li>Izolācija Isover KL 35 (100mm) </li>
<li>Latojums (28x70mm)</li>
<li>Reģipsis GKB (12,5mm)</li>'
          ],
          [
            'product_variant_id' => 3,
            'option_title' => 'Jumta panelis',
            'option_category' => 'Full',
            'options' => '
<li>Valcprofils</li>
<li>ICOPAL apakšklājs</li>
<li>Dēļu klājs ar spundi</li>
<li>Latojums  (45x45mm)</li>
<li>Difūzijas membrāna (Siga Majvest 200)</li>
<li>Koka karkass C24 (45x195mm)</li>
<li>Izolācija Isover KL35 (200mm)</li>
<li>Tvaika barjera (Siga Majpell 5)</li>
<li>Latojums  (45x45)</li>
<li>Izolācija Isover KL35 (50mm)</li>
<li>Reģipsis GKB (12,5mm)</li>'
          ],
          [
            'product_variant_id' => 3,
            'option_title' => 'Logi un durvis',
            'option_category' => 'Full',
            'options' => '
<li>PVC 3 stiklu pakešu logi </li>
<li>-	A+ klase, </li>
<li>-	6 kameru 82 mm vācu profils (Salamander bluEnergy) </li>
<li>-	48 mm stikla pakete ar Termix rāmi</li>
<li>-	Roto NT furnitūra.</li>
<li>Āra palodzes</li>
<li>Iekšējās palodzes</li>
<li>Masīvkoka iekšdurvis</li>'
          ],
          [
            'product_variant_id' => 3,
            'option_title' => 'Vannasistaba',
            'option_category' => 'Full',
            'options' => '
<li>WC pods </li>
<li>Izlietne ar maisītāju un kumodi </li>
<li>Dušas maisītājs </li>
<li>Dušas sienas</li>
<li>Elektriskais ūdens sildītājs</li>'
          ],
          [
            'product_variant_id' => 3,
            'option_title' => 'Virtuve',
            'option_category' => 'Full',
            'options' => '
<li>Virtuves iekārta – laminētas kokšķiedras plātes korpuss, laminēta kokskaidu plātne ar HPL pārklājumu, krāsotas MDF fasādes, BLUM furnitūra ar softclose mehānismiem</li>
<li>Indukcijas plīts virsma (Electrolux)</li>
<li>Tvaika nosūcējs (Faber) </li>
<li>Iebūvējamais ledusskapis (Electrolux)</li>
<li>Iebūvējama mikroviļņu krāsns (Electrolux)</li>
<li>Izlietne</li>
<li>Jaucējkrāns </li>'
          ],
          [
            'product_variant_id' => 3,
            'option_title' => 'Elektroinstalācija',
            'option_category' => 'Full',
            'options' => '
<li>Elektroinstalācija veikta pēc Skandināvijas standartiem.</li>
<li>Sienās iemontētas rozetes un kontaktslēdži (Jung LS 990 sērija)</li>'
          ],
          [
            'product_variant_id' => 3,
            'option_title' => 'Santehnika',
            'option_category' => 'Full',
            'options' => '
<li>Konstrukcijās iestrādāti un pievienoti kanalizācijas un ūdens izvadi</li>'
          ],
          [
            'product_variant_id' => 3,
            'option_title' => 'Iekšējā apdare',
            'option_category' => 'Full',
            'options' => '
<li>Krāsotas reģipša sienas un griesti vai krāsoti apdares dēļi</li>
<li>Vinila grīdas segums ar apakšklāju</li>
<li>Krāsotas grīdlīstes</li>
<li>Flīzes vannas istabā</li>
<li>Hidroizolācija vannas istabā</li>
<li>Vannas istabas grīdas betonēšana krituma izveidei</li>'
          ],
          [
            'product_variant_id' => 3,
            'option_title' => 'Cenā nav iekļauts',
            'option_category' => 'Full',
            'options' => '
<li>Pamatu izbūve (Stabveida pamati)</li>
<li>Moduļa transportēšana</li>'
          ],
        ]);
      DB::table('product_variant_options')->insert([
        [
          'product_variant_id' => 4,
          'option_title' => 'Ārsienas',
          'option_category' => 'Basic',
          'options' => '
<li>Vertikāls fasādes dēlis (UYV 21x120) </li>
<li>Horizontālais latojums (25x100 mm)</li>
<li>Vertikālais Latojums (28x45 mm)</li>
<li>Peļu siets pa mājas perimetru</li>
<li>Difūzijas membrāna (Siga Majvest 200)</li>
<li>Vēja reģipsis Norgips GU (9,5mm)</li>
<li>Statņi koka karkasam C24 (45x195 mm)</li>
<li>Izolācija Isover KL 35 (200 mm) </li>
<li>Tvaika barjeras plēve (Siga Majpell 5)</li>
<li>Latojums (45x45 mm)</li>
<li>Izolācija Isover KL 35 (50 mm) – piegādāts materiāls</li>
<li>OSB 3 (10 mm) – piegādāts materiāls</li>
<li>Saplāksnis (15 mm) vannas istabās – piegādāts materiāls</li>
<li>Reģipsis GKB (12,5 mm) – piegādāts materiāls</li>
<li>Reģipsis mitrām telpām GKBI (12,5 mm) vannas istabās un tehniskajā telpā – piegādāts materiāls</li>'
        ],
        [
          'product_variant_id' => 4,
          'option_title' => 'Nesošās iekšējās sienas',
          'option_category' => 'Basic',
          'options' => '
<li>Reģipsis GKB (12,5 mm)</li>
<li>OSB 3 (10 mm)</li>
<li>Statņi koka karkasam C24 (45x145 mm)</li>
<li>Izolācija Isover KL 35 (150 mm) </li>
<li>OSB 3 (10 mm) – piegādāts materiāls</li>
<li>Saplāksnis (15 mm) vannas istabās – piegādāts materiāls</li>
<li>Reģipsis GKB (12,5 mm) – piegādāts materiāls</li>
<li>Reģipsis mitrām telpām GKBI (12,5 mm) vannas istabās un tehniskajā telpā – piegādāts materiāls</li>'
        ],
        [
          'product_variant_id' => 4,
          'option_title' => 'Nenesošās iekšējās sienas',
          'option_category' => 'Basic',
          'options' => '
<li>Reģipsis GKB (12,5 mm)</li>
<li>OSB 3 (10 mm)</li>
<li>Statņi koka karkasam C24 (45x95 mm)</li>
<li>Izolācija Isover KL 35 (100 mm) </li>
<li>OSB 3 (10 mm) – piegādāts materiāls</li>
<li>Saplāksnis (15 mm) vannas istabās – piegādāts materiāls</li>
<li>Reģipsis GKB (12,5 mm) – piegādāts materiāls</li>
<li>Reģipsis mitrām telpām GKBI (12,5 mm) vannas istabās un tehniskajā telpā – piegādāts materiāls</li>'
        ],
        [
          'product_variant_id' => 4,
          'option_title' => 'Pārseguma panelis',
          'option_category' => 'Basic',
          'options' => '
<li>OSB ar spundi (22 mm)</li>
<li>Koka karkass C24 (220x45 mm)</li>
<li>Izolācija Isover KL 35 (100 mm) </li>
<li>Latojums (28x70 mm)</li>
<li>Reģipsis GKB (12,5 mm) – piegādāts materiāls</li>
<li>Reģipsis mitrām telpām GKBI (12,5 mm) – piegādāts materiāls</li>'
        ],
        [
          'product_variant_id' => 4,
          'option_title' => 'Jumts',
          'option_category' => 'Basic',
          'options' => '
<li>Betona dakstiņš</li>
<li>Latojums  (45x45 mm)</li>
<li>Latojums  (45x45 mm)</li>
<li>Difūzijas membrāna (Siga Majcoat 150)</li>
<li>Koka karkass C24 (45x245 mm)</li>
<li>Izolācija Isover KL35 (250 mm)</li>
<li>Koka karkass C24 (45x120 mm)</li>
<li>Izolācija Isover KL35 (120 mm)</li>
<li>Tvaika barjera (Siga Majpell 5)</li>
<li>Latojums  (28x70 mm)</li>
<li>Huntonit Antikk krāsoti kokšķiedru paneļi (11x300x1220 mm) – piegādāts materiāls</li>
<li>Vējkastu apdare (SH 21x120 mm)</li>'
        ],
        [
          'product_variant_id' => 4,
          'option_title' => 'Logi un durvis',
          'option_category' => 'Basic',
          'options' => '
<li>PVC 3 stiklu pakešu logi </li>
<li>-	A+ klase, </li>
<li>-	6 kameru 82 mm vācu profils (Salamander bluEnergy) </li>
<li>-	48 mm stikla pakete ar Termix rāmi</li>
<li>-	Roto NT furnitūra.</li>
<li>Āra palodzes</li>'
        ],
        [
          'product_variant_id' => 5,
          'option_title' => 'Ārsienas',
          'option_category' => 'Basic',
          'options' => '
<li>Vertikāls fasādes dēlis (UYV 21x120) </li>
<li>Horizontālais latojums (25x100 mm)</li>
<li>Vertikālais Latojums (28x45 mm)</li>
<li>Peļu siets pa mājas perimetru</li>
<li>Difūzijas membrāna (Siga Majvest 200)</li>
<li>Vēja reģipsis Norgips GU (9,5mm)</li>
<li>Statņi koka karkasam C24 (45x195 mm)</li>
<li>Izolācija Isover KL 35 (200 mm) </li>
<li>Tvaika barjeras plēve (Siga Majpell 5)</li>
<li>Latojums (45x45 mm)</li>
<li>Izolācija Isover KL 35 (50 mm) – piegādāts materiāls</li>
<li>OSB 3 (10 mm) – piegādāts materiāls</li>
<li>Saplāksnis (15 mm) vannas istabās – piegādāts materiāls</li>
<li>Reģipsis GKB (12,5 mm) – piegādāts materiāls</li>
<li>Reģipsis mitrām telpām GKBI (12,5 mm) vannas istabās un tehniskajā telpā – piegādāts materiāls</li>'
        ],
        [
          'product_variant_id' => 5,
          'option_title' => 'Nesošās iekšējās sienas',
          'option_category' => 'Basic',
          'options' => '
<li>Reģipsis GKB (12,5 mm)</li>
<li>OSB 3 (10 mm)</li>
<li>Statņi koka karkasam C24 (45x145 mm)</li>
<li>Izolācija Isover KL 35 (150 mm) </li>
<li>OSB 3 (10 mm) – piegādāts materiāls</li>
<li>Saplāksnis (15 mm) vannas istabās – piegādāts materiāls</li>
<li>Reģipsis GKB (12,5 mm) – piegādāts materiāls</li>
<li>Reģipsis mitrām telpām GKBI (12,5 mm) vannas istabās un tehniskajā telpā – piegādāts materiāls</li>'
        ],
        [
          'product_variant_id' => 5,
          'option_title' => 'Nenesošās iekšējās sienas',
          'option_category' => 'Basic',
          'options' => '
<li>Reģipsis GKB (12,5 mm)</li>
<li>OSB 3 (10 mm)</li>
<li>Statņi koka karkasam C24 (45x95 mm)</li>
<li>Izolācija Isover KL 35 (100 mm) </li>
<li>OSB 3 (10 mm) – piegādāts materiāls</li>
<li>Saplāksnis (15 mm) vannas istabās – piegādāts materiāls</li>
<li>Reģipsis GKB (12,5 mm) – piegādāts materiāls</li>
<li>Reģipsis mitrām telpām GKBI (12,5 mm) vannas istabās un tehniskajā telpā – piegādāts materiāls</li>'
        ],
        [
          'product_variant_id' => 5,
          'option_title' => 'Pārseguma panelis',
          'option_category' => 'Basic',
          'options' => '
<li>OSB ar spundi (22 mm)</li>
<li>Koka karkass C24 (220x45 mm)</li>
<li>Izolācija Isover KL 35 (100 mm) </li>
<li>Latojums (28x70 mm)</li>
<li>Reģipsis GKB (12,5 mm) – piegādāts materiāls</li>
<li>Reģipsis mitrām telpām GKBI (12,5 mm) – piegādāts materiāls</li>'
        ],
        [
          'product_variant_id' => 5,
          'option_title' => 'Jumts',
          'option_category' => 'Basic',
          'options' => '
<li>Betona dakstiņš</li>
<li>Latojums  (45x45 mm)</li>
<li>Latojums  (45x45 mm)</li>
<li>Difūzijas membrāna (Siga Majcoat 150)</li>
<li>Koka karkass C24 (45x245 mm)</li>
<li>Izolācija Isover KL35 (250 mm)</li>
<li>Koka karkass C24 (45x120 mm)</li>
<li>Izolācija Isover KL35 (120 mm)</li>
<li>Tvaika barjera (Siga Majpell 5)</li>
<li>Latojums  (28x70 mm)</li>
<li>Huntonit Antikk krāsoti kokšķiedru paneļi (11x300x1220 mm) – piegādāts materiāls</li>
<li>Vējkastu apdare (SH 21x120 mm)</li>'
        ],
        [
          'product_variant_id' => 5,
          'option_title' => 'Logi un durvis',
          'option_category' => 'Basic',
          'options' => '
<li>PVC 3 stiklu pakešu logi </li>
<li>-	A+ klase, </li>
<li>-	6 kameru 82 mm vācu profils (Salamander bluEnergy) </li>
<li>-	48 mm stikla pakete ar Termix rāmi</li>
<li>-	Roto NT furnitūra.</li>
<li>Āra palodzes</li>'
        ],
        [
          'product_variant_id' => 4,
          'option_title' => 'Pamatu izbūve un zemes darbi',
          'option_category' => 'Full',
          'options' => '
<li>Būvbedres izrakšana</li>
<li>Šķembu kārtas izveide</li>
<li>Putuplasta veidņu izveide</li>
<li>Stiegrojuma ieklāšana</li>
<li>Pamatu plātnes betonēšana</li>
<li>Santehnika un siltā grīda</li>
<li>Terases pamatu izveide</li>'
        ],
        [
          'product_variant_id' => 4,
          'option_title' => 'Ārsienas',
          'option_category' => 'Full',
          'options' => '
<li>Vertikāls fasādes dēlis (UYV 21x120) </li>
<li>Horizontālais latojums (25x100 mm)</li>
<li>Vertikālais Latojums (28x45 mm)</li>
<li>Peļu siets pa mājas perimetru</li>
<li>Difūzijas membrāna (Siga Majvest 200)</li>
<li>Vēja reģipsis Norgips GU (9,5mm)</li>
<li>Statņi koka karkasam C24 (45x195 mm)</li>
<li>Izolācija Isover KL 35 (200 mm) </li>
<li>Tvaika barjeras plēve (Siga Majpell 5)</li>
<li>Latojums (45x45 mm)</li>
<li>Izolācija Isover KL 35 (50 mm) </li>
<li>OSB 3 (10 mm)</li>
<li>Saplāksnis (15 mm) vannas istabās</li>
<li>Reģipsis GKB (12,5 mm)</li>
<li>Reģipsis mitrām telpām GKBI (12,5 mm) vannas istabās un tehniskajā telpā</li>'
        ],
        [
          'product_variant_id' => 4,
          'option_title' => 'Nesošās iekšējās sienas',
          'option_category' => 'Full',
          'options' => '
<li>Reģipsis GKB (12,5 mm)</li>
<li>OSB 3 (10 mm)</li>
<li>Statņi koka karkasam C24 (45x145 mm)</li>
<li>Izolācija Isover KL 35 (150 mm) </li>
<li>OSB 3 (10 mm)</li>
<li>Saplāksnis (15 mm) vannas istabās</li>
<li>Reģipsis GKB (12,5 mm)</li>
<li>Reģipsis mitrām telpām GKBI (12,5 mm) vannas istabās un tehniskajā telpā</li>'
        ],
        [
          'product_variant_id' => 4,
          'option_title' => 'Nenesošās iekšējās sienas',
          'option_category' => 'Full',
          'options' => '
<li>Reģipsis GKB (12,5 mm)</li>
<li>OSB 3 (10 mm)</li>
<li>Statņi koka karkasam C24 (45x95 mm)</li>
<li>Izolācija Isover KL 35 (100 mm) </li>
<li>OSB 3 (10 mm)</li>
<li>Saplāksnis (15 mm) vannas istabās</li>
<li>Reģipsis GKB (12,5 mm)</li>
<li>Reģipsis mitrām telpām GKBI (12,5 mm) vannas istabās un tehniskajā telpā</li>'
        ],
        [
          'product_variant_id' => 4,
          'option_title' => 'Pārseguma panelis',
          'option_category' => 'Full',
          'options' => '
<li>OSB ar spundi (22 mm)</li>
<li>Koka karkass C24 (220x45 mm)</li>
<li>Izolācija Isover KL 35 (100 mm) </li>
<li>Latojums (28x70 mm)</li>
<li>Reģipsis GKB (12,5 mm)</li>
<li>Reģipsis mitrām telpām GKBI (12,5 mm)</li>'
        ],
        [
          'product_variant_id' => 4,
          'option_title' => 'Jumts',
          'option_category' => 'Full',
          'options' => '
<li>Betona dakstiņš</li>
<li>Latojums  (45x45 mm)</li>
<li>Latojums  (45x45 mm)</li>
<li>Difūzijas membrāna (Siga Majcoat 150)</li>
<li>Koka karkass C24 (45x245 mm)</li>
<li>Izolācija Isover KL35 (250 mm)</li>
<li>Koka karkass C24 (45x120 mm)</li>
<li>Izolācija Isover KL35 (120 mm)</li>
<li>Tvaika barjera (Siga Majpell 5)</li>
<li>Latojums  (28x70 mm)</li>
<li>Huntonit Antikk krāsoti kokšķiedru paneļi (11x300x1220 mm)</li>
<li>Vējkastu apdare (SH 21x120 mm)</li>'
        ],
        [
          'product_variant_id' => 4,
          'option_title' => 'Terase',
          'option_category' => 'Full',
          'options' => '
<li>Terases dēlis – priede (28x120mm)</li>
<li>Koka karkass, imprignēts (145x45mm)</li>'
        ],
        [
          'product_variant_id' => 4,
          'option_title' => 'Logi un durvis',
          'option_category' => 'Full',
          'options' => '
<li>PVC 3 stiklu pakešu logi </li>
<li>-	A+ klase, </li>
<li>-	6 kameru 82 mm vācu profils (Salamander bluEnergy) </li>
<li>-	48 mm stikla pakete ar Termix rāmi</li>
<li>-	Roto NT furnitūra.</li>
<li>Āra palodzes</li>
<li>Iekšējās palodzes</li>
<li>Masīvkoka iekšdurvis</li>'
        ],
        [
          'product_variant_id' => 4,
          'option_title' => 'Vannasistaba',
          'option_category' => 'Full',
          'options' => '
<li>WC pods </li>
<li>Izlietne ar kumodi un spoguli</li>
<li>Dušas/vannas maisītājs </li>
<li>Dušas sienas/vanna</li>
<li>Dvieļu žāvētājs</li>'
        ],
        [
          'product_variant_id' => 4,
          'option_title' => 'Virtuve',
          'option_category' => 'Full',
          'options' => '
<li>Virtuves iekārta – laminētas kokšķiedras plātes korpuss, laminēta kokskaidu plātne ar HPL pārklājumu, krāsotas MDF fasādes, BLUM furnitūra ar softclose mehānismiem</li>
<li>Cepeškrāsns (Electrolux)</li>
<li>Indukcijas plīts virsma (Electrolux)</li>
<li>Tvaika nosūcējs (Faber) </li>
<li>Trauku mazgājamā mašina (Electrolux)</li>
<li>Ledusskapis (Electrolux)</li>
<li>Saldētava (Electrolux)</li>
<li>Mikroviļņu krāsns (Electrolux)</li>
<li>Izlietne</li>
<li>Jaucējkrāns </li>'
        ],
        [
          'product_variant_id' => 4,
          'option_title' => 'Tehniskā telpa',
          'option_category' => 'Full',
          'options' => '
<li>Veļas mašīna (Electrolux)</li>
<li>Veļas žāvētājs (Electrolux)</li>
<li>Stiprinājuma komplekts ar plauktu</li>'
        ],
        [
          'product_variant_id' => 4,
          'option_title' => 'Iekšējā apdare',
          'option_category' => 'Full',
          'options' => '
<li>Krāsotas reģipša sienas un griesti</li>
<li>Parkets Boen, trīsstrīpu</li>
<li>Krāsotas grīdlīstes (12x100 mm)</li>
<li>Flīzes vannas istabās un tehniskajā telpā</li>
<li>Hidroizolācija vannas isabās</li>
<li>Vannas istabas grīdas betonēšana krituma izveidei</li>'
        ],
        [
          'product_variant_id' => 4,
          'option_title' => 'Elektrība',
          'option_category' => 'Full',
          'options' => '
<li>Elektroinstalācija veikta pēc Skandināvijas standartiem.</li>
<li>Sienās iemontētas rozetes un kontaktslēdži (Jung LS 990 sērija)</li>'
        ],
        [
          'product_variant_id' => 4,
          'option_title' => 'Santehnika',
          'option_category' => 'Full',
          'options' => '
<li>Konstrukcijās iestrādāti un pievienoti kanalizācijas un ūdens izvadi</li>
<li>Siltumsūknis NIBE (ūdens-gaiss)</li>'
        ],
        [
          'product_variant_id' => 5,
          'option_title' => 'Pamatu izbūve un zemes darbi',
          'option_category' => 'Full',
          'options' => '
<li>Būvbedres izrakšana</li>
<li>Šķembu kārtas izveide</li>
<li>Putuplasta veidņu izveide</li>
<li>Stiegrojuma ieklāšana</li>
<li>Pamatu plātnes betonēšana</li>
<li>Santehnika un siltā grīda</li>
<li>Terases pamatu izveide</li>'
        ],
        [
          'product_variant_id' => 5,
          'option_title' => 'Ārsienas',
          'option_category' => 'Full',
          'options' => '
<li>Vertikāls fasādes dēlis (UYV 21x120) </li>
<li>Horizontālais latojums (25x100 mm)</li>
<li>Vertikālais Latojums (28x45 mm)</li>
<li>Peļu siets pa mājas perimetru</li>
<li>Difūzijas membrāna (Siga Majvest 200)</li>
<li>Vēja reģipsis Norgips GU (9,5mm)</li>
<li>Statņi koka karkasam C24 (45x195 mm)</li>
<li>Izolācija Isover KL 35 (200 mm) </li>
<li>Tvaika barjeras plēve (Siga Majpell 5)</li>
<li>Latojums (45x45 mm)</li>
<li>Izolācija Isover KL 35 (50 mm) </li>
<li>OSB 3 (10 mm)</li>
<li>Saplāksnis (15 mm) vannas istabās</li>
<li>Reģipsis GKB (12,5 mm)</li>
<li>Reģipsis mitrām telpām GKBI (12,5 mm) vannas istabās un tehniskajā telpā</li>'
        ],
        [
          'product_variant_id' => 5,
          'option_title' => 'Nesošās iekšējās sienas',
          'option_category' => 'Full',
          'options' => '
<li>Reģipsis GKB (12,5 mm)</li>
<li>OSB 3 (10 mm)</li>
<li>Statņi koka karkasam C24 (45x145 mm)</li>
<li>Izolācija Isover KL 35 (150 mm) </li>
<li>OSB 3 (10 mm)</li>
<li>Saplāksnis (15 mm) vannas istabās</li>
<li>Reģipsis GKB (12,5 mm)</li>
<li>Reģipsis mitrām telpām GKBI (12,5 mm) vannas istabās un tehniskajā telpā</li>'
        ],
        [
          'product_variant_id' => 5,
          'option_title' => 'Nenesošās iekšējās sienas',
          'option_category' => 'Full',
          'options' => '
<li>Reģipsis GKB (12,5 mm)</li>
<li>OSB 3 (10 mm)</li>
<li>Statņi koka karkasam C24 (45x95 mm)</li>
<li>Izolācija Isover KL 35 (100 mm) </li>
<li>OSB 3 (10 mm)</li>
<li>Saplāksnis (15 mm) vannas istabās</li>
<li>Reģipsis GKB (12,5 mm)</li>
<li>Reģipsis mitrām telpām GKBI (12,5 mm) vannas istabās un tehniskajā telpā</li>'
        ],
        [
          'product_variant_id' => 5,
          'option_title' => 'Pārseguma panelis',
          'option_category' => 'Full',
          'options' => '
<li>OSB ar spundi (22 mm)</li>
<li>Koka karkass C24 (220x45 mm)</li>
<li>Izolācija Isover KL 35 (100 mm) </li>
<li>Latojums (28x70 mm)</li>
<li>Reģipsis GKB (12,5 mm)</li>
<li>Reģipsis mitrām telpām GKBI (12,5 mm)</li>'
        ],
        [
          'product_variant_id' => 5,
          'option_title' => 'Jumts',
          'option_category' => 'Full',
          'options' => '
<li>Betona dakstiņš</li>
<li>Latojums  (45x45 mm)</li>
<li>Latojums  (45x45 mm)</li>
<li>Difūzijas membrāna (Siga Majcoat 150)</li>
<li>Koka karkass C24 (45x245 mm)</li>
<li>Izolācija Isover KL35 (250 mm)</li>
<li>Koka karkass C24 (45x120 mm)</li>
<li>Izolācija Isover KL35 (120 mm)</li>
<li>Tvaika barjera (Siga Majpell 5)</li>
<li>Latojums  (28x70 mm)</li>
<li>Huntonit Antikk krāsoti kokšķiedru paneļi (11x300x1220 mm)</li>
<li>Vējkastu apdare (SH 21x120 mm)</li>'
        ],
        [
          'product_variant_id' => 5,
          'option_title' => 'Terase',
          'option_category' => 'Full',
          'options' => '
<li>Terases dēlis – priede (28x120mm)</li>
<li>Koka karkass, imprignēts (145x45mm)</li>'
        ],
        [
          'product_variant_id' => 5,
          'option_title' => 'Logi un durvis',
          'option_category' => 'Full',
          'options' => '
<li>PVC 3 stiklu pakešu logi </li>
<li>-	A+ klase, </li>
<li>-	6 kameru 82 mm vācu profils (Salamander bluEnergy) </li>
<li>-	48 mm stikla pakete ar Termix rāmi</li>
<li>-	Roto NT furnitūra.</li>
<li>Āra palodzes</li>
<li>Iekšējās palodzes</li>
<li>Masīvkoka iekšdurvis</li>'
        ],
        [
          'product_variant_id' => 5,
          'option_title' => 'Vannasistaba',
          'option_category' => 'Full',
          'options' => '
<li>WC pods </li>
<li>Izlietne ar kumodi un spoguli</li>
<li>Dušas/vannas maisītājs </li>
<li>Dušas sienas/vanna</li>
<li>Dvieļu žāvētājs</li>'
        ],
        [
          'product_variant_id' => 5,
          'option_title' => 'Virtuve',
          'option_category' => 'Full',
          'options' => '
<li>Virtuves iekārta – laminētas kokšķiedras plātes korpuss, laminēta kokskaidu plātne ar HPL pārklājumu, krāsotas MDF fasādes, BLUM furnitūra ar softclose mehānismiem</li>
<li>Cepeškrāsns (Electrolux)</li>
<li>Indukcijas plīts virsma (Electrolux)</li>
<li>Tvaika nosūcējs (Faber) </li>
<li>Trauku mazgājamā mašina (Electrolux)</li>
<li>Ledusskapis (Electrolux)</li>
<li>Saldētava (Electrolux)</li>
<li>Mikroviļņu krāsns (Electrolux)</li>
<li>Izlietne</li>
<li>Jaucējkrāns </li>'
        ],
        [
          'product_variant_id' => 5,
          'option_title' => 'Tehniskā telpa',
          'option_category' => 'Full',
          'options' => '
<li>Veļas mašīna (Electrolux)</li>
<li>Veļas žāvētājs (Electrolux)</li>
<li>Stiprinājuma komplekts ar plauktu</li>'
        ],
        [
          'product_variant_id' => 5,
          'option_title' => 'Iekšējā apdare',
          'option_category' => 'Full',
          'options' => '
<li>Krāsotas reģipša sienas un griesti</li>
<li>Parkets Boen, trīsstrīpu</li>
<li>Krāsotas grīdlīstes (12x100 mm)</li>
<li>Flīzes vannas istabās un tehniskajā telpā</li>
<li>Hidroizolācija vannas isabās</li>
<li>Vannas istabas grīdas betonēšana krituma izveidei</li>'
        ],
        [
          'product_variant_id' => 5,
          'option_title' => 'Elektrība',
          'option_category' => 'Full',
          'options' => '
<li>Elektroinstalācija veikta pēc Skandināvijas standartiem.</li>
<li>Sienās iemontētas rozetes un kontaktslēdži (Jung LS 990 sērija)</li>'
        ],
        [
          'product_variant_id' => 5,
          'option_title' => 'Santehnika',
          'option_category' => 'Full',
          'options' => '
<li>Konstrukcijās iestrādāti un pievienoti kanalizācijas un ūdens izvadi</li>
<li>Siltumsūknis NIBE (ūdens-gaiss)</li>'
        ],
        [
          'product_variant_id' => 6,
          'option_title' => 'Ārsienas',
          'option_category' => 'Basic',
          'options' => '
<li>Vertikāls fasādes dēlis / Dabīgā šīfera loksnes CUPA H2</li>
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
          'product_variant_id' => 6,
          'option_title' => 'Iekšējās sienas',
          'option_category' => 'Basic',
          'options' => '
<li>Reģipsis GKB (12,5mm)</li>
<li>OSB 3 (10mm)</li>
<li>Statņi koka karkasam C24 (45x95mm) </li>
<li>Izolācija Isover KL 35 (100 mm)</li>
<li>OSB 3 (10mm) – materiāls piegādāts</li>
<li>Saplāksnis (15 mm) vannas istabā – materiāls piegādāts</li>
<li>Reģipsis GKB (12,5mm) – materiāls piegādāts</li>
<li>Reģipsis mitrām telpām GKBI (12,5 mm) vannas istabā – materiāls piegādāts</li>'
        ],
        [
          'product_variant_id' => 6,
          'option_title' => 'Grīdas panelis',
          'option_category' => 'Basic',
          'options' => '
<li>OSB ar spundi (22mm)</li>
<li>Koka karkass C24 (195x45mm)</li>
<li>Izolācija Isover KL 35 (200mm) </li>
<li>Cembrit Windstopper extreme (9 mm)</li>
<li>Latojums, imprignēts (25x100mm)</li>'
        ],
        [
          'product_variant_id' => 6,
          'option_title' => 'Jumta panelis',
          'option_category' => 'Basic',
          'options' => '
<li>Bitumena ruļļu materiāls 2 kārtas</li>
<li>Dēļu klājs ar spundi</li>
<li>Latojums (45x45mm)</li>
<li>Difūzijas membrāna (Siga Majvest 200)</li>
<li>Koka karkass C24 (45x195mm)</li>
<li>Izolācija Isover KL35 (200mm)</li>
<li>Tvaika barjera (Siga Majpell 5)</li>
<li>Latojums  (45x45)</li>
<li>Izolācija Isover KL35 (50mm) – materiāls piegādāts</li>
<li>Huntonit Antikk krāsoti kokšķiedru paneļi (11x300x1220mm) – materiāls piegādāts</li>'
        ],
        [
          'product_variant_id' => 6,
          'option_title' => 'Logi un durvis',
          'option_category' => 'Basic',
          'options' => '
<li>PVC 3 stiklu pakešu logi </li>
<li>-	A+ klase, </li>
<li>-	6 kameru 82 mm vācu profils (Salamander bluEnergy) </li>
<li>-	48 mm stikla pakete ar Termix rāmi</li>
<li>-	Roto NT furnitūra.</li>
<li>Āra palodzes</li>'
        ],
        [
          'product_variant_id' => 6,
          'option_title' => 'Elektroinstalācija',
          'option_category' => 'Basic',
          'options' => '
<li>Sagatavots pievads elektrības pievilkšanai</li>'
        ],
        [
          'product_variant_id' => 6,
          'option_title' => 'Santehnika',
          'option_category' => 'Basic',
          'options' => '
<li>Kanalizācijas iebūvēšana grīdā un pievada izbūve</li>
<li>Ūdens pievada izbūve</li>'
        ],
        [
          'product_variant_id' => 6,
          'option_title' => 'Cenā nav iekļauts',
          'option_category' => 'Basic',
          'options' => '
<li>Pamatu izbūve (Stabveida pamati)</li>
<li>Moduļa transportēšana</li>'
        ],
        [
          'product_variant_id' => 7,
          'option_title' => 'Ārsienas',
          'option_category' => 'Basic',
          'options' => '
<li>āls fasādes dēlis / Dabīgā šīfera loksnes CUPA H2</li>
<li>Horizontālais latojums (25x100mm)</li>
<li>ālais Latojums (25x50mm)</li>
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
          'product_variant_id' => 7,
          'option_title' => 'Iekšējās sienas',
          'option_category' => 'Basic',
          'options' => '
<li>Reģipsis GKB (12,5mm)</li>
<li>OSB 3 (10mm)</li>
<li>Statņi koka karkasam C24 (45x95mm) </li>
<li>Izolācija Isover KL 35 (100 mm) </li>
<li>OSB 3 (10mm) – materiāls piegādāts</li>
<li>Saplāksnis (15 mm) vannas istabā – materiāls piegādāts</li>
<li>Reģipsis GKB (12,5mm) – materiāls piegādāts</li>
<li>Reģipsis mitrām telpām GKBI (12,5 mm) vannas istabā – materiāls piegādāts</li>'
        ],
        [
          'product_variant_id' => 7,
          'option_title' => 'Grīdas panelis',
          'option_category' => 'Basic',
          'options' => '
<li>OSB ar spundi (22mm)</li>
<li>Koka karkass C24 (195x45mm)</li>
<li>Izolācija Isover KL 35 (200mm) </li>
<li>Cembrit Windstopper extreme (9 mm)</li>
<li>Latojums, imprignēts (25x100mm)</li>'
        ],
        [
          'product_variant_id' => 7,
          'option_title' => 'Jumta panelis',
          'option_category' => 'Basic',
          'options' => '
<li>Valcprofils</li>
<li>ICOPAL apakšklājs</li>
<li>Dēļu klājs ar spundi</li>
<li>Latojums (45x45mm)</li>
<li>Difūzijas membrāna (Siga Majvest 200)</li>
<li>Koka karkass C24 (45x195mm)</li>
<li>Izolācija Isover KL35 (200mm)</li>
<li>Tvaika barjera (Siga Majpell 5)</li>
<li>Latojums  (45x45)</li>
<li>Izolācija Isover KL35 (50mm) – materiāls piegādāts</li>
<li>Reģipsis GKB (12,5mm) – materiāls piegādāts</li>'
        ],
        [
          'product_variant_id' => 7,
          'option_title' => 'Logi un durvis',
          'option_category' => 'Basic',
          'options' => '
<li>PVC 3 stiklu pakešu logi </li>
<li>-	A+ klase, </li>
<li>-	6 kameru 82 mm vācu profils (Salamander bluEnergy) </li>
<li>-	48 mm stikla pakete ar Termix rāmi</li>
<li>-	Roto NT furnitūra.</li>
<li>Āra palodzes</li>'
        ],
        [
          'product_variant_id' => 7,
          'option_title' => 'Elektroinstalācija',
          'option_category' => 'Basic',
          'options' => '
<li>Sagatavots pievads elektrības pievilkšanai</li>'
        ],
        [
          'product_variant_id' => 7,
          'option_title' => 'Santehnika',
          'option_category' => 'Basic',
          'options' => '
<li>Kanalizācijas iebūvēšana grīdā un pievada izbūve</li>
<li>Ūdens pievada izbūve</li>'
        ],
        [
          'product_variant_id' => 7,
          'option_title' => 'Cenā nav iekļauts',
          'option_category' => 'Basic',
          'options' => '
<li>Pamatu izbūve (Stabveida pamati)</li>
<li>Moduļa transportēšana</li>'
        ],
        [
          'product_variant_id' => 6,
          'option_title' => 'Ārsienas',
          'option_category' => 'Full',
          'options' => '
<li>Vertikāls fasādes dēlis / Dabīgā šīfera loksnes CUPA H2</li>
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
<li>Reģipsis GKB (12,5mm)</li>
<li>Reģipsis mitrām telpām GKBI (12,5 mm)</li>'
        ],
        [
          'product_variant_id' => 6,
          'option_title' => 'Iekšējās sienas',
          'option_category' => 'Full',
          'options' => '
<li>Reģipsis GKB (12,5mm)</li>
<li>OSB 3 (10mm)</li>
<li>Statņi koka karkasam C24 (45x95mm)</li>
<li>Izolācija Isover KL 35 (100 mm) </li>
<li>OSB 3 (10mm)</li>
<li>Saplāksnis (15 mm) vannas istabā</li>
<li>Reģipsis GKB (12,5mm)</li>
<li>Reģipsis mitrām telpām GKBI (12,5 mm) vannas istabā</li>
'
        ],
        [
          'product_variant_id' => 6,
          'option_title' => 'Grīdas panelis',
          'option_category' => 'Full',
          'options' => '
<li>OSB ar spundi (22mm)</li>
<li>Koka karkass C24 (195x45mm)</li>
<li>Izolācija Isover KL 35 (200mm) </li>
<li>Cembrit Windstopper extreme (9 mm)</li>
<li>Latojums, imprignēts (25x100mm)</li>'
        ],
        [
          'product_variant_id' => 6,
          'option_title' => 'Jumta panelis',
          'option_category' => 'Full',
          'options' => '
<li>Bitumena ruļļu materiāls 2 kārtas</li>
<li>Dēļu klājs ar spundi</li>
<li>Latojums  (45x45mm)</li>
<li>Difūzijas membrāna (Siga Majvest 200)</li>
<li>Koka karkass C24 (45x195mm)</li>
<li>Izolācija Isover KL35 (200mm)</li>
<li>Tvaika barjera (Siga Majpell 5)</li>
<li>Latojums  (45x45)</li>
<li>Izolācija Isover KL35 (50mm)</li>
<li>Huntonit Antikk krāsoti kokšķiedru paneļi (11x300x1220mm)</li>'
        ],
        [
          'product_variant_id' => 6,
          'option_title' => 'Logi un durvis',
          'option_category' => 'Full',
          'options' => '
<li>PVC 3 stiklu pakešu logi </li>
<li>-	A+ klase, </li>
<li>-	6 kameru 82 mm vācu profils (Salamander bluEnergy) </li>
<li>-	48 mm stikla pakete ar Termix rāmi</li>
<li>-	Roto NT furnitūra.</li>
<li>Āra palodzes</li>
<li>Iekšējās palodzes</li>
<li>Masīvkoka iekšdurvis</li>'
        ],
        [
          'product_variant_id' => 6,
          'option_title' => 'Vannasistaba',
          'option_category' => 'Full',
          'options' => '
<li>WC pods </li>
<li>Izlietne ar maisītāju un kumodi </li>
<li>Dušas maisītājs </li>
<li>Dušas sienas</li>
<li>Elektriskais ūdens sildītājs</li>'
        ],
        [
          'product_variant_id' => 6,
          'option_title' => 'Virtuve',
          'option_category' => 'Full',
          'options' => '
<li>Virtuves iekārta – laminētas kokšķiedras plātes korpuss, laminēta kokskaidu plātne ar HPL pārklājumu, krāsotas MDF fasādes, BLUM furnitūra ar softclose mehānismiem</li>
<li>Indukcijas plīts virsma (Electrolux)</li>
<li>Tvaika nosūcējs (Faber) </li>
<li>Iebūvējamais ledusskapis (Electrolux)</li>
<li>Iebūvējama mikroviļņu krāsns (Electrolux)</li>
<li>Izlietne</li>
<li>Jaucējkrāns </li>'
        ],
        [
          'product_variant_id' => 6,
          'option_title' => 'Elektroinstalācija',
          'option_category' => 'Full',
          'options' => '
<li>Elektroinstalācija veikta pēc Skandināvijas standartiem.</li>
<li>Sienās iemontētas rozetes un kontaktslēdži (Jung LS 990 sērija)</li>'
        ],
        [
          'product_variant_id' => 6,
          'option_title' => 'Santehnika',
          'option_category' => 'Full',
          'options' => '
<li>Konstrukcijās iestrādāti un pievienoti kanalizācijas un ūdens izvadi</li>'
        ],
        [
          'product_variant_id' => 6,
          'option_title' => 'Iekšējā apdare',
          'option_category' => 'Full',
          'options' => '
<li>Krāsotas reģipša sienas vai krāsoti apdares dēļi</li>
<li>Vinila grīdas segums ar apakšklāju</li>
<li>Krāsotas grīdlīstes</li>
<li>Flīzes vannas istabā</li>
<li>Hidroizolācija vannas istabā</li>
<li>Vannas istabas grīdas betonēšana krituma izveidei</li>'
        ],
        [
          'product_variant_id' => 6,
          'option_title' => 'Cenā nav iekļauts',
          'option_category' => 'Full',
          'options' => '
<li>Pamatu izbūve (Stabveida pamati)</li>
<li>Moduļa transportēšana</li>'
        ],
        [
          'product_variant_id' => 7,
          'option_title' => 'Ārsienas',
          'option_category' => 'Full',
          'options' => '
<li>Vertikāls fasādes dēlis / Dabīgā šīfera loksnes CUPA H2</li>
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
<li>Reģipsis GKB (12,5mm)</li>
<li>Reģipsis mitrām telpām GKBI (12,5 mm)</li>'
        ],
        [
          'product_variant_id' => 7,
          'option_title' => 'Iekšējās sienas',
          'option_category' => 'Full',
          'options' => '
<li>Reģipsis GKB (12,5mm)</li>
<li>OSB 3 (10mm)</li>
<li>Statņi koka karkasam C24 (45x95mm)</li>
<li>Izolācija Isover KL 35 (100 mm) </li>
<li>OSB 3 (10mm)</li>
<li>Saplāksnis (15 mm) vannas istabā</li>
<li>Reģipsis GKB (12,5mm)</li>
<li>Reģipsis mitrām telpām GKBI (12,5 mm) vannas istabā</li>'
        ],
        [
          'product_variant_id' => 7,
          'option_title' => 'Grīdas panelis',
          'option_category' => 'Full',
          'options' => '
<li>OSB ar spundi (22mm)</li>
<li>Koka karkass C24 (195x45mm)</li>
<li>Izolācija Isover KL 35 (200mm) </li>
<li>Cembrit Windstopper extreme (9 mm)</li>
<li>Latojums, imprignēts (25x100mm)</li>'
        ],
        [
          'product_variant_id' => 7,
          'option_title' => 'Jumta panelis',
          'option_category' => 'Full',
          'options' => '
<li>Valcprofils</li>
<li>ICOPAL apakšklājs</li>
<li>Dēļu klājs ar spundi</li>
<li>Latojums  (45x45mm)</li>
<li>Difūzijas membrāna (Siga Majvest 200)</li>
<li>Koka karkass C24 (45x195mm)</li>
<li>Izolācija Isover KL35 (200mm)</li>
<li>Tvaika barjera (Siga Majpell 5)</li>
<li>Latojums  (45x45)</li>
<li>Izolācija Isover KL35 (50mm)</li>
<li>Reģipsis GKB (12,5mm)</li>
'
        ],
        [
          'product_variant_id' => 7,
          'option_title' => 'Logi un durvis',
          'option_category' => 'Full',
          'options' => '
<li>PVC 3 stiklu pakešu logi </li>
<li>-	A+ klase, </li>
<li>-	6 kameru 82 mm vācu profils (Salamander bluEnergy) </li>
<li>-	48 mm stikla pakete ar Termix rāmi</li>
<li>-	Roto NT furnitūra.</li>
<li>Āra palodzes</li>
<li>Iekšējās palodzes</li>
<li>Masīvkoka iekšdurvis</li>'
        ],
        [
          'product_variant_id' => 7,
          'option_title' => 'Vannasistaba',
          'option_category' => 'Full',
          'options' => '
<li>WC pods </li>
<li>Izlietne ar maisītāju un kumodi </li>
<li>Dušas maisītājs </li>
<li>Dušas sienas</li>
<li>Elektriskais ūdens sildītājs</li>'
        ],
        [
          'product_variant_id' => 7,
          'option_title' => 'Virtuve',
          'option_category' => 'Full',
          'options' => '
<li>Virtuves iekārta – laminētas kokšķiedras plātes korpuss, laminēta kokskaidu plātne ar HPL pārklājumu, krāsotas MDF fasādes, BLUM furnitūra ar softclose mehānismiem</li>
<li>Indukcijas plīts virsma (Electrolux)</li>
<li>Tvaika nosūcējs (Faber) </li>
<li>Iebūvējamais ledusskapis (Electrolux)</li>
<li>Iebūvējama mikroviļņu krāsns (Electrolux)</li>
<li>Izlietne</li>
<li>Jaucējkrāns </li>'
        ],
        [
          'product_variant_id' => 7,
          'option_title' => 'Elektroinstalācija',
          'option_category' => 'Full',
          'options' => '
<li>Elektroinstalācija veikta pēc Skandināvijas standartiem.</li>
<li>Sienās iemontētas rozetes un kontaktslēdži (Jung LS 990 sērija)</li>'
        ],
        [
          'product_variant_id' => 7,
          'option_title' => 'Santehnika',
          'option_category' => 'Full',
          'options' => '
<li>Konstrukcijās iestrādāti un pievienoti kanalizācijas un ūdens izvadi</li>'
        ],
        [
          'product_variant_id' => 7,
          'option_title' => 'Iekšējā apdare',
          'option_category' => 'Full',
          'options' => '
<li>Krāsotas reģipša sienas vai krāsoti apdares dēļi</li>
<li>Vinila grīdas segums ar apakšklāju</li>
<li>Krāsotas grīdlīstes</li>
<li>Flīzes vannas istabā</li>
<li>Hidroizolācija vannas istabā</li>
<li>Vannas istabas grīdas betonēšana krituma izveidei</li>'
        ],
        [
          'product_variant_id' => 7,
          'option_title' => 'Cenā nav iekļauts',
          'option_category' => 'Full',
          'options' => '
<li>Pamatu izbūve (Stabveida pamati)</li>
<li>Moduļa transportēšana</li>'
        ],
      ]);
    }
}
