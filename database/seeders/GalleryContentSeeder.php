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
          'content' => '<p>Modulī LUND paredzētas divas guļamistabas, viesistaba ar virtuves zonu, vannas istaba, sauna un terase. Interjera dizaina pamatā ir funkcionalitāte, vienkāršība un estētika.</p>',
          'created_at' => Carbon::now(),
        ],
        [
          'title' => 'Modulis Malmö',
          'content' => '<p>Augstas kvalitātes koka karkasa moduļu māja - pilnībā pabeigta māja ar kopējo izmantojamo platību 44,2 m2.  Moduļu mājas ir gatavas transportēšanai uz Jūsu zemes gabala.</p>',
          'created_at' => Carbon::now(),
        ],
        [
          'title' => 'Modulis Visby',
          'content' => '<p>Pārvietojama koka karkasa moduļu māja. Šāda veida māju būvniecība ir salīdzinoši ātra un neaizņem ilgu projekta saskaņošanas laiku.</p>',
          'created_at' => Carbon::now(),
        ],
        [
          'title' => 'Modulis Örebro',
          'content' => '<p>Mūsu komandā ir pārliecinoši un savas jomas zinoši profesionāļi, kuri izvēlēsies labākos risinājumus un materiālus.</p>',
          'created_at' => Carbon::now(),
        ],
        [
          'title' => 'Modulis Idre',
          'content' => '<p>Šāda tipa mājās ir patīkami dzīvot jebkurā sezonā un laikapstākļos. Moduļu mājas ir ilgtspējīgas un energoefektīvas.</p>',
          'created_at' => Carbon::now(),
        ],
        [
          'title' => 'Vītolu ielas projekts',
          'content' => '<p>Projektējot un būvējot mājas mēs domājam ilgtermiņā par klienta vēlmēm, kas atspoguļojas vizuālajā risinājumā un augstas kvalitātes koka karkasa tehnoloģijas izmantošanā. Uzticies kvalitātei - izvēlies Modern House un radīsim māju sajūtu kopā!</p>',
          'created_at' => Carbon::now(),
        ],
        [
          'title' => 'Vītolu ielas dvīņu māja',
          'content' => '<p>Mūsu interjera dizainam raksturīgs ir dabiskums, kas iekļauj koksni un dabīgu gaismu. Kopējais mājokļa iekārtojums ir elegants un mūsdienīgs, kas rada patīkamu un mājīgu atmosfēru.</p>',
          'created_at' => Carbon::now(),
        ],
        [
          'title' => 'Atbrīvotāju ielas projekts',
          'content' => '<p>Atbrīvotāju ielas projektā tiks realizētas četras dzīvojamās mājas cilvēkiem, kuri vēlas piedzīvot māju sajūtu pilsētā! Katra māja ir jauns stāsts, sāc savu stāstu ar mums!</p>',
          'created_at' => Carbon::now(),
        ],
        [
          'title' => 'Vītolu ielas interjers',
          'content' => '<p>MODERN HOUSE realizē projektus, kuri ir veidoti ar kvalitāti, estētiku, komfortu un ilgtspējību.</p>',
          'created_at' => Carbon::now(),
        ],
        [
          'title' => 'Sauna Östersund',
          'content' => '<p>Gatava saunas māja, kura ir viegli uzstādāma jebkurā mājas pagalmā. Kontrolējam kvalitāti katrā celtniecības posmā un tieši tāpēc nodrošinām katram klietnam iespēju iepazīties ar ražošanas procesu Siguldā.</p>',
          'created_at' => Carbon::now(),
        ],
        [
          'title' => 'Sauna Åre',
          'content' => '<p>Gatava saunas māja, kura ir viegli uzstādāma jebkurā mājas pagalmā. Kontrolējam kvalitāti katrā celtniecības posmā un tieši tāpēc nodrošinām katram klietnam iespēju iepazīties ar ražošanas procesu Siguldā.</p>',
          'created_at' => Carbon::now(),
        ],
        [
          'title' => 'Interjera koncepta vizualizācijas',
          'content' => '<p>MODERN HOUSE Interjera dizaina pamatā ir funkcionalitāte, vienkāršība un estētika. Kopējais mājokļa iekārtojums ir elegants un mūsdienīgs, kas rada patīkamu un ļoti mājīgu atmosfēru. Mūsu dizainam raksturīgs ir dabiskums, kas iekļauj koksni un dabīgu gaismu. Tieši tāpēc mūsu mājas ir ar lieliem logiem, kas visas dienas garumā nodrošina labu apgaismojumu.</p>',
          'created_at' => Carbon::now(),
        ],
        [
          'title' => 'Individuālie projekti',
          'content' => 'Individuāli projekti - MODERN HOUSE ir atvērti jebkuram investīciju un sadarbības piedāvājumam.',
          'created_at' => Carbon::now(),
        ],
      ]);
    }
}
