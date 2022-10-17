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
            'options_basic' => '<li>Vertikāls  fasādes dēlis  (UTV 21x120mm) / Dabīgā šīfera loksnes CUPA H2</li>
              <li>Peļu siets pa mājas perimetru</li>
              <li>Horizontālais latojums (25x100mm)</li>
              <li>Vertikālais Latojums (25x50mm)</li>
              <li>Difūzijas membrāna (Siga Majvest)</li>
              <li>Vēja riģipsis Norgips GU (9,5mm)</li>
              <li>Statņi koka karkasam (45x145mm)</li>
              <li>Isover SKC-20</li>
              <li>Izolācija Isover KL 35 (150mm) </li>
              <li>Tvaika barjeras plēve (Siga Majpel 5)</li>
              <li>Latojums (45x45mm)</li>
              <li>Izolācija Isover KL 35 (50mm) </li>
              <li>OSB 3 (10mm)</li>
              <li>Riģipsis (12,5mm)</li>',
            'options_full' => '<li>Vertikāls  fasādes dēlis  (UTV 21x120mm) / Dabīgā šīfera loksnes CUPA H2</li>
              <li>Peļu siets pa mājas perimetru</li>
              <li>Horizontālais latojums (25x100mm)</li>
              <li>Vertikālais Latojums (25x50mm)</li>
              <li>Difūzijas membrāna (Siga Majvest)</li>
              <li>Vēja riģipsis Norgips GU (9,5mm)</li>
              <li>Statņi koka karkasam (45x145mm)</li>
              <li>Isover SKC-20</li>
              <li>Izolācija Isover KL 35 (150mm) </li>
              <li>Tvaika barjeras plēve (Siga Majpel 5)</li>
              <li>Latojums (45x45mm)</li>
              <li>Izolācija Isover KL 35 (50mm) </li>
              <li>OSB 3 (10mm)</li>
              <li>Riģipsis (12,5mm)</li>
              <li>Premium</li>'
          ],
          [
            'product_variant_id' => 2,
            'option_type' => 'Ārsienas',
            'options_basic' => '<li>Vertikāls  fasādes dēlis  (UTV 21x120mm) / Dabīgā šīfera loksnes CUPA H2</li>
              <li>Peļu siets pa mājas perimetru</li>
              <li>Horizontālais latojums (25x100mm)</li>
              <li>Vertikālais Latojums (25x50mm)</li>
              <li>Difūzijas membrāna (Siga Majvest)</li>
              <li>Vēja riģipsis Norgips GU (9,5mm)</li>
              <li>Statņi koka karkasam (45x145mm)</li>
              <li>Isover SKC-20</li>
              <li>Izolācija Isover KL 35 (150mm) </li>
              <li>Tvaika barjeras plēve (Siga Majpel 5)</li>
              <li>Latojums (45x45mm)</li>
              <li>Izolācija Isover KL 35 (50mm) </li>
              <li>OSB 3 (10mm)</li>
              <li>Riģipsis (12,5mm)</li>',
            'options_full' => '<li>Vertikāls  fasādes dēlis  (UTV 21x120mm) / Dabīgā šīfera loksnes CUPA H2</li>
              <li>Peļu siets pa mājas perimetru</li>
              <li>Horizontālais latojums (25x100mm)</li>
              <li>Vertikālais Latojums (25x50mm)</li>
              <li>Difūzijas membrāna (Siga Majvest)</li>
              <li>Vēja riģipsis Norgips GU (9,5mm)</li>
              <li>Statņi koka karkasam (45x145mm)</li>
              <li>Isover SKC-20</li>
              <li>Izolācija Isover KL 35 (150mm) </li>
              <li>Tvaika barjeras plēve (Siga Majpel 5)</li>
              <li>Latojums (45x45mm)</li>
              <li>Izolācija Isover KL 35 (50mm) </li>
              <li>OSB 3 (10mm)</li>
              <li>Riģipsis (12,5mm)</li>
              <li>Premium</li>'
          ],
          [
            'product_variant_id' => 4,
            'option_type' => 'Ārsienas',
            'options_basic' => '<li>Vertikāls  fasādes dēlis  (UTV 21x120mm) / Dabīgā šīfera loksnes CUPA H2</li>
              <li>Peļu siets pa mājas perimetru</li>
              <li>Horizontālais latojums (25x100mm)</li>
              <li>Vertikālais Latojums (25x50mm)</li>
              <li>Difūzijas membrāna (Siga Majvest)</li>
              <li>Vēja riģipsis Norgips GU (9,5mm)</li>
              <li>Statņi koka karkasam (45x145mm)</li>
              <li>Isover SKC-20</li>
              <li>Izolācija Isover KL 35 (150mm) </li>
              <li>Tvaika barjeras plēve (Siga Majpel 5)</li>
              <li>Latojums (45x45mm)</li>
              <li>Izolācija Isover KL 35 (50mm) </li>
              <li>OSB 3 (10mm)</li>
              <li>Riģipsis (12,5mm)</li>',
            'options_full' => '<li>Vertikāls  fasādes dēlis  (UTV 21x120mm) / Dabīgā šīfera loksnes CUPA H2</li>
              <li>Peļu siets pa mājas perimetru</li>
              <li>Horizontālais latojums (25x100mm)</li>
              <li>Vertikālais Latojums (25x50mm)</li>
              <li>Difūzijas membrāna (Siga Majvest)</li>
              <li>Vēja riģipsis Norgips GU (9,5mm)</li>
              <li>Statņi koka karkasam (45x145mm)</li>
              <li>Isover SKC-20</li>
              <li>Izolācija Isover KL 35 (150mm) </li>
              <li>Tvaika barjeras plēve (Siga Majpel 5)</li>
              <li>Latojums (45x45mm)</li>
              <li>Izolācija Isover KL 35 (50mm) </li>
              <li>OSB 3 (10mm)</li>
              <li>Riģipsis (12,5mm)</li>
              <li>Premium</li>'
          ],
          [
            'product_variant_id' => 3,
            'option_type' => 'Ārsienas',
            'options_basic' => '<li>Vertikāls  fasādes dēlis  (UTV 21x120mm) / Dabīgā šīfera loksnes CUPA H2</li>
              <li>Peļu siets pa mājas perimetru</li>
              <li>Horizontālais latojums (25x100mm)</li>
              <li>Vertikālais Latojums (25x50mm)</li>
              <li>Difūzijas membrāna (Siga Majvest)</li>
              <li>Vēja riģipsis Norgips GU (9,5mm)</li>
              <li>Statņi koka karkasam (45x145mm)</li>
              <li>Isover SKC-20</li>
              <li>Izolācija Isover KL 35 (150mm) </li>
              <li>Tvaika barjeras plēve (Siga Majpel 5)</li>
              <li>Latojums (45x45mm)</li>
              <li>Izolācija Isover KL 35 (50mm) </li>
              <li>OSB 3 (10mm)</li>
              <li>Riģipsis (12,5mm)</li>',
            'options_full' => '<li>Vertikāls  fasādes dēlis  (UTV 21x120mm) / Dabīgā šīfera loksnes CUPA H2</li>
              <li>Peļu siets pa mājas perimetru</li>
              <li>Horizontālais latojums (25x100mm)</li>
              <li>Vertikālais Latojums (25x50mm)</li>
              <li>Difūzijas membrāna (Siga Majvest)</li>
              <li>Vēja riģipsis Norgips GU (9,5mm)</li>
              <li>Statņi koka karkasam (45x145mm)</li>
              <li>Isover SKC-20</li>
              <li>Izolācija Isover KL 35 (150mm) </li>
              <li>Tvaika barjeras plēve (Siga Majpel 5)</li>
              <li>Latojums (45x45mm)</li>
              <li>Izolācija Isover KL 35 (50mm) </li>
              <li>OSB 3 (10mm)</li>
              <li>Riģipsis (12,5mm)</li>
              <li>Premium</li>'
          ],
          [
            'product_variant_id' => 1,
            'option_type' => 'Iekšējās sienas',
            'options_basic' => '<li>Riģipsis (12,5mm)</li>
              <li>Riģipsim skrūves (3,9x35mm)</li>
              <li>OSB 3 (10mm)</li>
              <li>Koka karkass (45x95mm)</li>
              <li>Isover SKC-20</li>
              <li>Izolācija Isover KL 35 (100mm) </li>
              <li>OSB 3 (10mm)</li>',
            'options_full' => '<li>Riģipsis (12,5mm)</li>
              <li>Riģipsim skrūves (3,9x35mm)</li>
              <li>OSB 3 (10mm)</li>
              <li>Koka karkass (45x95mm)</li>
              <li>Isover SKC-20</li>
              <li>Izolācija Isover KL 35 (100mm) </li>
              <li>OSB 3 (10mm)</li>
              <li>Premium</li>'
          ],
          [
            'product_variant_id' => 2,
            'option_type' => 'Iekšējās sienas',
            'options_basic' => '<li>Riģipsis (12,5mm)</li>
              <li>Riģipsim skrūves (3,9x35mm)</li>
              <li>OSB 3 (10mm)</li>
              <li>Koka karkass (45x95mm)</li>
              <li>Isover SKC-20</li>
              <li>Izolācija Isover KL 35 (100mm) </li>
              <li>OSB 3 (10mm)</li>',
            'options_full' => '<li>Riģipsis (12,5mm)</li>
              <li>Riģipsim skrūves (3,9x35mm)</li>
              <li>OSB 3 (10mm)</li>
              <li>Koka karkass (45x95mm)</li>
              <li>Isover SKC-20</li>
              <li>Izolācija Isover KL 35 (100mm) </li>
              <li>OSB 3 (10mm)</li>
              <li>Premium</li>'
          ],
          [
            'product_variant_id' => 3,
            'option_type' => 'Iekšējās sienas',
            'options_basic' => '<li>Riģipsis (12,5mm)</li>
              <li>Riģipsim skrūves (3,9x35mm)</li>
              <li>OSB 3 (10mm)</li>
              <li>Koka karkass (45x95mm)</li>
              <li>Isover SKC-20</li>
              <li>Izolācija Isover KL 35 (100mm) </li>
              <li>OSB 3 (10mm)</li>',
            'options_full' => '<li>Riģipsis (12,5mm)</li>
              <li>Riģipsim skrūves (3,9x35mm)</li>
              <li>OSB 3 (10mm)</li>
              <li>Koka karkass (45x95mm)</li>
              <li>Isover SKC-20</li>
              <li>Izolācija Isover KL 35 (100mm) </li>
              <li>OSB 3 (10mm)</li>
              <li>Premium</li>'
          ],
          [
            'product_variant_id' => 4,
            'option_type' => 'Iekšējās sienas',
            'options_basic' => '<li>Riģipsis (12,5mm)</li>
              <li>Riģipsim skrūves (3,9x35mm)</li>
              <li>OSB 3 (10mm)</li>
              <li>Koka karkass (45x95mm)</li>
              <li>Isover SKC-20</li>
              <li>Izolācija Isover KL 35 (100mm) </li>
              <li>OSB 3 (10mm)</li>',
            'options_full' => '<li>Riģipsis (12,5mm)</li>
              <li>Riģipsim skrūves (3,9x35mm)</li>
              <li>OSB 3 (10mm)</li>
              <li>Koka karkass (45x95mm)</li>
              <li>Isover SKC-20</li>
              <li>Izolācija Isover KL 35 (100mm) </li>
              <li>OSB 3 (10mm)</li>
              <li>Premium</li>'
          ],
          [
            'product_variant_id' => 1,
            'option_type' => 'Grīdas panelis',
            'options_basic' => '
              <li>Vinila grīdas segums ar apakšklāju</li>
              <li>Krāsotas grīdlīstes (12x57mm)</li>
              <li>Durelis 22mm</li>
              <li>Koka karkas (220x45mm)</li>
              <li>Izolācija Isover KL 35 (200mm) </li>
              <li>Isover SKC-20 </li>
              <li>Latojums (25x100mm)</li>
              <li>Cembrit Windstopper extreme 4.5mm</li>
            ',
            'options_full' => '
              <li>Vinila grīdas segums ar apakšklāju</li>
              <li>Krāsotas grīdlīstes (12x57mm)</li>
              <li>Durelis 22mm</li>
              <li>Koka karkas (220x45mm)</li>
              <li>Izolācija Isover KL 35 (200mm) </li>
              <li>Isover SKC-20 </li>
              <li>Latojums (25x100mm)</li>
              <li>Cembrit Windstopper extreme 4.5mm</li>
            '
          ],
          [
            'product_variant_id' => 2,
            'option_type' => 'Grīdas panelis',
            'options_basic' => '
              <li>Vinila grīdas segums ar apakšklāju</li>
              <li>Krāsotas grīdlīstes (12x57mm)</li>
              <li>Durelis 22mm</li>
              <li>Koka karkas (220x45mm)</li>
              <li>Izolācija Isover KL 35 (200mm) </li>
              <li>Isover SKC-20 </li>
              <li>Latojums (25x100mm)</li>
              <li>Cembrit Windstopper extreme 4.5mm</li>
            ',
            'options_full' => '
              <li>Vinila grīdas segums ar apakšklāju</li>
              <li>Krāsotas grīdlīstes (12x57mm)</li>
              <li>Durelis 22mm</li>
              <li>Koka karkas (220x45mm)</li>
              <li>Izolācija Isover KL 35 (200mm) </li>
              <li>Isover SKC-20 </li>
              <li>Latojums (25x100mm)</li>
              <li>Cembrit Windstopper extreme 4.5mm</li>
            '
          ],
          [
            'product_variant_id' => 3,
            'option_type' => 'Grīdas panelis',
            'options_basic' => '
              <li>Vinila grīdas segums ar apakšklāju</li>
              <li>Krāsotas grīdlīstes (12x57mm)</li>
              <li>Durelis 22mm</li>
              <li>Koka karkas (220x45mm)</li>
              <li>Izolācija Isover KL 35 (200mm) </li>
              <li>Isover SKC-20 </li>
              <li>Latojums (25x100mm)</li>
              <li>Cembrit Windstopper extreme 4.5mm</li>
            ',
            'options_full' => '
              <li>Vinila grīdas segums ar apakšklāju</li>
              <li>Krāsotas grīdlīstes (12x57mm)</li>
              <li>Durelis 22mm</li>
              <li>Koka karkas (220x45mm)</li>
              <li>Izolācija Isover KL 35 (200mm) </li>
              <li>Isover SKC-20 </li>
              <li>Latojums (25x100mm)</li>
              <li>Cembrit Windstopper extreme 4.5mm</li>
            '
          ],
          [
            'product_variant_id' => 4,
            'option_type' => 'Grīdas panelis',
            'options_basic' => '
              <li>Vinila grīdas segums ar apakšklāju</li>
              <li>Krāsotas grīdlīstes (12x57mm)</li>
              <li>Durelis 22mm</li>
              <li>Koka karkas (220x45mm)</li>
              <li>Izolācija Isover KL 35 (200mm) </li>
              <li>Isover SKC-20 </li>
              <li>Latojums (25x100mm)</li>
              <li>Cembrit Windstopper extreme 4.5mm</li>
            ',
            'options_full' => '
              <li>Vinila grīdas segums ar apakšklāju</li>
              <li>Krāsotas grīdlīstes (12x57mm)</li>
              <li>Durelis 22mm</li>
              <li>Koka karkas (220x45mm)</li>
              <li>Izolācija Isover KL 35 (200mm) </li>
              <li>Isover SKC-20 </li>
              <li>Latojums (25x100mm)</li>
              <li>Cembrit Windstopper extreme 4.5mm</li>
            '
          ],
          [
            'product_variant_id' => 1,
            'option_type' => 'Pārseguma panelis',
            'options_basic' => '
              <li>Vinila grīdas segums ar apakšklāju</li>
              <li>Krāsotas grīdlīstes (12x57mm)</li>
              <li>Durelis (22mm)</li>
              <li>Koka karkas (145x45mm)</li>
              <li>Izolācija Isover KL 35 (100mm) </li>
              <li>Isover SKC-20</li>
              <li>Latojums (25x100mm)</li>
              <li>Riģipsis (12,5mm)</li>
            ',
            'options_full' => '
              <li>Vinila grīdas segums ar apakšklāju</li>
              <li>Krāsotas grīdlīstes (12x57mm)</li>
              <li>Durelis (22mm)</li>
              <li>Koka karkas (145x45mm)</li>
              <li>Izolācija Isover KL 35 (100mm) </li>
              <li>Isover SKC-20</li>
              <li>Latojums (25x100mm)</li>
              <li>Riģipsis (12,5mm)</li>
            '
          ],
          [
            'product_variant_id' => 1,
            'option_type' => 'Jumta panelis',
            'options_basic' => '
              <li>ICOPAL apakšklājs</li>
              <li>Dēļu klājs (SH 21x120)</li>
              <li>Latojums  (45x45mm)</li>
              <li>Difūzijas membrāna (Siga Majvest)</li>
              <li>Koka karkas (45x195mm)</li>
              <li>Izolācija Isover (200mm)</li>
              <li>Isover SKC-20</li>
              <li>Tvaika barjera (Siga Majpel 5)</li>
              <li>Latojums  (28x70)</li>
              <li>Izolācija Isover (50mm)</li>
              <li>Riģipsis (12,5mm)</li>
            ',
            'options_full' => '
              <li>ICOPAL apakšklājs</li>
              <li>Dēļu klājs (SH 21x120)</li>
              <li>Latojums  (45x45mm)</li>
              <li>Difūzijas membrāna (Siga Majvest)</li>
              <li>Koka karkas (45x195mm)</li>
              <li>Izolācija Isover (200mm)</li>
              <li>Isover SKC-20</li>
              <li>Tvaika barjera (Siga Majpel 5)</li>
              <li>Latojums  (28x70)</li>
              <li>Izolācija Isover (50mm)</li>
              <li>Riģipsis (12,5mm)</li>
            '
          ],
          [
            'product_variant_id' => 1,
            'option_type' => 'Logi un durvis',
            'options_basic' => '
              <li>PVC 2 stiklu pakešu logi</li>
              <li>Āra palodzes</li>
              <li>Iekšējās palodzes</li>
              <li>Masīvkoka iekšdurvis ar pildiņu</li>
            ',
            'options_full' => '
              <li>PVC 2 stiklu pakešu logi</li>
              <li>Āra palodzes</li>
              <li>Iekšējās palodzes</li>
              <li>Masīvkoka iekšdurvis ar pildiņu</li>
            '
          ],
          [
            'product_variant_id' => 1,
            'option_type' => 'Vannasistaba',
            'options_basic' => '
              <h5>Sienas:</h5>
              <li>Flīzes</li>
              <li>Hidroizolācija</li>
              <li>Riģipsis mitrām telpām GKBI (12,5 mm)</li>
              <li>Finieris (15 mm)</li>
              <h5>Grīda:</h5>
              <li>Flīzes</li>
              <li>Hidroizolācija</li>
              <li>Grīdas betoēšana kritumu izveidei</li>
              <h5>Aprīkojums:</h5>
              <li>WC pods</li>
              <li>Izlietne ar kumodi</li>
              <li>Dušas paliktnis??</li>
              <li>Dušas maisītājs</li>
              <li>Elektriskais ūdens sildītājs</li>
            ',
            'options_full' => '
              <h5>Sienas:</h5>
              <li>Flīzes</li>
              <li>Hidroizolācija</li>
              <li>Riģipsis mitrām telpām GKBI (12,5 mm)</li>
              <li>Finieris (15 mm)</li>
              <h5>Grīda:</h5>
              <li>Flīzes</li>
              <li>Hidroizolācija</li>
              <li>Grīdas betoēšana kritumu izveidei</li>
              <h5>Aprīkojums:</h5>
              <li>WC pods</li>
              <li>Izlietne ar kumodi</li>
              <li>Dušas paliktnis??</li>
              <li>Dušas maisītājs</li>
              <li>Elektriskais ūdens sildītājs</li>
            '
          ],
          [
            'product_variant_id' => 1,
            'option_type' => 'Virtuve',
            'options_basic' => '
              <li>Virtuves iekārta</li>
              <li>Cepeškrāsns (Electrolux LIR60433B)</li>
              <li>Indukcijas plīts virsma Electrolux LIT30230C</li>
              <li>Tvaika nosūcējsFaber INKA PLUS HCSBKA52</li>
              <li>Trauku mašīna (Electrolux EES69310L)</li>
              <li>Iebūvējamais ledusskapis Whirlpool ARG 585</li>
              <li>Iebūvējama mikroviļņu krāsns Bosch BFL524MB0</li>
              <li>Izlietne</li>
            ',
            'options_full' => '
              <li>Virtuves iekārta</li>
              <li>Cepeškrāsns (Electrolux LIR60433B)</li>
              <li>Indukcijas plīts virsma Electrolux LIT30230C</li>
              <li>Tvaika nosūcējsFaber INKA PLUS HCSBKA52</li>
              <li>Trauku mašīna (Electrolux EES69310L)</li>
              <li>Iebūvējamais ledusskapis Whirlpool ARG 585</li>
              <li>Iebūvējama mikroviļņu krāsns Bosch BFL524MB0</li>
              <li>Izlietne</li>
            '
          ],
          [
            'product_variant_id' => 1,
            'option_type' => 'Elektrība',
            'options_basic' => '
              <li>Sienās iemontētas rozetes un kontaktslēdži</li>
            ',
            'options_full' => '
              <li>Sienās iemontētas rozetes un kontaktslēdži</li>
            '
          ],
          [
            'product_variant_id' => 1,
            'option_type' => 'Santehnika',
            'options_basic' => '
              <li>Konstrukcijās iestrādāti kanalizācijas un ūdens izvadi</li>
            ',
            'options_full' => '
              <li>Konstrukcijās iestrādāti kanalizācijas un ūdens izvadi</li>
            '
          ],
          [
            'product_variant_id' => 1,
            'option_type' => 'Iekšējā apdare',
            'options_basic' => '
              <li>Krāsotas riģipša sienas vai</li>
            ',
            'options_full' => '
              <li>Krāsotas riģipša sienas vai</li>
            '
          ],
          [
            'product_variant_id' => 1,
            'option_type' => 'Cena nav iekļauts',
            'options_basic' => '
              <li>Pamatu izbūve (stabveida elementi)</li>
              <li>Moduļa transportēšana</li>
              <li>Izgatavošanas laiks</li>
            ',
            'options_full' => '
               <li>Pamatu izbūve (stabveida elementi)</li>
              <li>Moduļa transportēšana</li>
              <li>Izgatavošanas laiks</li>
            '
          ],

        ]);
    }
}
