@extends('app', ['title' => Lang::get('privacy-policy'), 'index' => false, 'allProducts' => $allProducts])
@section('content')
  <div class="container-xxl mb-4">
    <div class="row">
      <h1 class="fw-bold text-center text-uppercase title">@lang('privacy-policy')</h1>
      <div class="mt-4">
        <div class="row">
          <div class="col-lg-12 d-flex justify-content-center align-items-start flex-column">
            <p>Šī privātuma politika informē par privātuma praksi un personas datu apstrādes principiem saistībā ar
              "Modern House SIA" mājas lapu un pakalpojumiem. Lai sazinātos saistībā ar datu apstrādes jautājumiem,
              lūdzu rakstiet e-pastu uz info@modern-house.lv.</p>
            <h3 class="fw-bold title mb-1 mt-3">Kādu informāciju mēs iegūstam?</h3>
            <p>Mēs iegūstam tādus personas datus, ko jūs mums brīvprātīgi sniedzat ar e-pasta starpniecību, aizpildot
              tīmeklī bāzētās anketas un citā tiešā saziņā ar jums. Iesniedzot pasūtījumu, jums jānorāda vārds, uzvārds,
              kontaktinformācija un cita informācija kuru jūs vēlaties sniegt.</p>
            <h3 class="fw-bold title mb-1 mt-3">Kā mēs izmantojam iegūtos personas datus?</h3>
            <p>Mēs varam izmantot iegūtos personas datus, lai sniegtu jums jūsu pieprasītos pakalpojumus un informāciju.</p>
            <h3 class="fw-bold title mb-1 mt-3">Kā mēs aizsargājam personas datus?</h3>
            <p>Jūsu personas datu aizsardzībai mēs izmantojam dažādus tehniskus un organizatoriskus drošības pasākumus. Jūsu personas dati ir pieejami ierobežotam cilvēku skaitam, tikai pilnvarotām personām.</p>
            <h3 class="fw-bold title mb-1 mt-3">Cik ilgi mēs glabājam personas datus?</h3>
            <p>Mēs glabājam jūsu personas datus tik ilgi, cik ilgi tie ir mums nepieciešami atbilstoši to ieguves mērķim un kā to pieļauj vai nosaka normatīvo aktu prasības.</p>
            <h3 class="fw-bold title mb-1 mt-3">Kā mēs izmantojam sīkdatnes?</h3>
            <p>Sīkdatnes ir nelielas teksta datnes, ko jūsu apmeklētās mājas lapas saglabā jūsu datorā. Tās tiek izmantotas, lai nodrošinātu mājas lapas darbību, kā arī lai sniegtu informāciju vietnes īpašniekiem.</p>
            <p>Šī mājas lapa var iestatīt sekojošas sīkdatnes:</p>
            <ul>
              <li><strong>Funkcionālās sīkdatnes.</strong> Šīs sīkdatnes ir nepieciešamas, lai jūs spētu pārvietoties mājas lapā un lietot tās funkcijas. Bez šim sīkdatnēm mēs nevaram nodrošināt jūsu pieprasītos pakalpojumus, piemēram, preču groza funkcionalitāti.</li>
              <li><strong>Google Analytics sīkdatnes.</strong> Šīs sīkdatnes lieto, lai iegūtu mūsu mājas lapas apmeklējuma statistiku. Mēs lietojam šo informāciju, lai uzlabotu vietnes darbību un reklāmas pasākumus.</li>
              <li><strong>Mērķētas reklāmas rīku sīkdatnes.</strong> Šīs sīkdatnes lieto, lai paaugstinātu reklāmas efektivitāti un rādītu reklāmas, kas, visticamāk, jūs interesēs visvairāk.</li>
              <li><strong>Trešās puses pakalpojumu sniedzēja sīkdatnes.</strong> Sīkdatnes var iestatīt šādi šajā mājas lapā lietotie trešo pušu pakalpojumi: Facebook poga "Patīk", YouTube video, Instagram poga "Patīk". Dažas no šīm sīkdatnēm var tikt izmantotas, lai sekotu līdzi jūsu darbībām citās mājas lapās, un mēs tās nevaram kontrolēt, jo šīs sīkdatnes nav iestatījusi mūsu mājas lapa.</li>
            </ul>
            <h3 class="fw-bold title mb-2 mt-3">Kā atteikties no sīkdatnēm?</h3>
            <p>Lai atteiktos no sīkdatņu saņemšanas, jūs varat izmantojot privātās pārlūkošanas režīmu, kuru nodrošina lielākā daļa pārlūkprogrammu (privāts logs, inkognito logs vai InPrivate logs). Jebkādas sīkdatnes, kas tiek izveidotas, darbojoties privātās pārlūkošanas režīmā, tiek dzēstas, tiklīdz jūs aizverat visus pārlūka logus.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  @include('includes.footer')
@endsection
