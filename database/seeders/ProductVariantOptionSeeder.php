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
<li>Statņi koka karkasam C24 (45x75mm)</li>
<li>Izolācija Isover KL 35 (75 mm) </li>
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
<li>Sagatavots pievads santehnikas un elektrības pievilkšanai</li>'
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
<li>Hidroizolācija vannas istabā</li>
<li>Reģipsis GKB (12,5mm)</li>
<li>Reģipsis mitrām telpām GKBI (12,5 mm)</li>
<li>Flīzes vannas istabā</li>'
          ],
          [
            'product_variant_id' => 1,
            'option_title' => 'Iekšējās sienas',
            'option_category' => 'Full',
            'options' => '
<li>Reģipsis GKB (12,5mm)</li>
<li>OSB 3 (10mm)</li>
<li>Statņi koka karkasam C24 (45x75mm)</li>
<li>Izolācija Isover KL 35 (75 mm) </li>
<li>OSB 3 (10mm)</li>
<li>Saplāksnis (15 mm) vannas istabā</li>
<li>Hidroizolācija vannas istabā</li>
<li>Reģipsis GKB (12,5mm)</li>
<li>Reģipsis mitrām telpām GKBI (12,5 mm) vannas istabā</li>
<li>Flīzes vannas istabā</li>'
          ],
          [
            'product_variant_id' => 1,
            'option_title' => 'Grīdas panelis',
            'option_category' => 'Full',
            'options' => '
<li>Vinila grīdas segums ar apakšklāju</li>
<li>Krāsotas grīdlīstes (12x95mm)</li>
<li>Flīzes vannas istabā</li>
<li>Hidroizolācija vannas istabā</li>
<li>Vannas istabas grīdas betonēšana krituma izveidei</li>
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
<li>Elektro instalācija veikta pēs Skandināvijas standartiem.</li>
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
<li>Krāsotas reģipša sienas vai krāsoti apdares dēļi</li>'
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
<li>Statņi koka karkasam C24 (45x75mm)</li>
<li>Izolācija Isover KL 35 (75 mm) </li>
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
<li>Sagatavots pievads santehnikas un elektrības pievilkšanai</li>'
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
<li>Statņi koka karkasam C24 (45x75mm)</li>
<li>Izolācija Isover KL 35 (75 mm) </li>
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
<li>Sagatavots pievads santehnikas un elektrības pievilkšanai</li>'
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
<li>Hidroizolācija vannas istabā</li>
<li>Reģipsis GKB (12,5mm)</li>
<li>Reģipsis mitrām telpām GKBI (12,5 mm)</li>
<li>Flīzes vannas istabā</li>'
          ],
          [
            'product_variant_id' => 2,
            'option_title' => 'Iekšējās sienas',
            'option_category' => 'Full',
            'options' => '
<li>Reģipsis GKB (12,5mm)</li>
<li>OSB 3 (10mm)</li>
<li>Statņi koka karkasam C24 (45x75mm)</li>
<li>Izolācija Isover KL 35 (75 mm) </li>
<li>OSB 3 (10mm)</li>
<li>Saplāksnis (15 mm) vannas istabā</li>
<li>Hidroizolācija vannas istabā</li>
<li>Reģipsis GKB (12,5mm)</li>
<li>Reģipsis mitrām telpām GKBI (12,5 mm) vannas istabā</li>
<li>Flīzes vannas istabā</li>'
          ],
          [
            'product_variant_id' => 2,
            'option_title' => 'Grīdas panelis',
            'option_category' => 'Full',
            'options' => '
<li>Vinila grīdas segums ar apakšklāju</li>
<li>Krāsotas grīdlīstes (12x95mm)</li>
<li>Flīzes vannas istabā</li>
<li>Hidroizolācija vannas istabā</li>
<li>Vannas istabas grīdas betonēšana krituma izveidei</li>
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
<li>Vinila grīdas segums ar apakšklāju</li>
<li>Krāsotas grīdlīstes (12x95mm)</li>
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
<li>Elektro instalācija veikta pēs Skandināvijas standartiem.</li>
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
<li>Krāsotas reģipša sienas vai krāsoti apdares dēļi</li>'
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
<li>Hidroizolācija vannas istabā</li>
<li>Reģipsis GKB (12,5mm)</li>
<li>Reģipsis mitrām telpām GKBI (12,5 mm)</li>
<li>Flīzes vannas istabā</li>'
          ],
          [
            'product_variant_id' => 3,
            'option_title' => 'Iekšējās sienas',
            'option_category' => 'Full',
            'options' => '
<li>Reģipsis GKB (12,5mm)</li>
<li>OSB 3 (10mm)</li>
<li>Statņi koka karkasam C24 (45x75mm)</li>
<li>Izolācija Isover KL 35 (75 mm) </li>
<li>OSB 3 (10mm)</li>
<li>Saplāksnis (15 mm) vannas istabā</li>
<li>Hidroizolācija vannas istabā</li>
<li>Reģipsis GKB (12,5mm)</li>
<li>Reģipsis mitrām telpām GKBI (12,5 mm) vannas istabā</li>
<li>Flīzes vannas istabā</li>'
          ],
          [
            'product_variant_id' => 3,
            'option_title' => 'Grīdas panelis',
            'option_category' => 'Full',
            'options' => '
<li>Vinila grīdas segums ar apakšklāju</li>
<li>Krāsotas grīdlīstes (12x95mm)</li>
<li>Flīzes vannas istabā</li>
<li>Hidroizolācija vannas istabā</li>
<li>Vannas istabas grīdas betonēšana krituma izveidei</li>
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
<li>Vinila grīdas segums ar apakšklāju</li>
<li>Krāsotas grīdlīstes (12x95mm)</li>
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
<li>Elektro instalācija veikta pēs Skandināvijas standartiem.</li>
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
<li>Krāsotas reģipša sienas vai krāsoti apdares dēļi</li>'
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
    }
}
