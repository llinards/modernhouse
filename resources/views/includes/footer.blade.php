<footer>
  <div class="container-xxl h-100 pb-2">
    <div class="row align-items-center h-100 text-md-start text-center">
      <div class="col-md-7 col-12 pt-md-0 pt-2">
        <img class="modern-house-logo" src="{{ asset('storage/logo/logo-white.png') }} " alt="Modern House Logo">
      </div>
      <div class="col-md-2 col-6">
        <h4 class="mb-2">@lang('address')</h4>
        <p class="small">601 1st Floor Office, Edenderry Business Campus<br/>Edenderry, Co.Offaly, Ireland</p>
        {{--        <p class="small">@lang('modern house registration number'): 40203251766</p>--}}
      </div>
      <div class="col-md-2 col-6">
        <h4 class="mb-2">@lang('contact us')</h4>
        <p class="small">info@modern-house.ie</p>
        <p class="small">+353 83 369 1499</p>
        <p class="small">+353 85 877 0578</p>
      </div>
      <div class="col-md-1 col-12 d-flex flex-md-column justify-content-center align-items-md-end">
        <div class="p-2">
          <a href="https://www.instagram.com/housemodern_2021/" class="nav-link" target="_blank"><i
              class="bi bi-instagram text-white"></i></a>
        </div>
        <div class="p-2">
          <a href="https://www.facebook.com/ModernHouseLV" class="nav-link" target="_blank"><i
              class="bi bi-facebook text-white"></i></a>
        </div>
        <div class="p-2">
          <a href="mailto:info@modern-house.ie" class="nav-link" target="_blank"><i
              class="bi bi-envelope-fill text-white"></i></a>
        </div>
      </div>
      <hr class="m-0">
      <div class="d-flex justify-content-center justify-content-md-between flex-wrap flex-md-nowrap">
        <p class="small">&copy; SIA {{ config('app.name') }} {{  date ('Y') }} | @lang('all rights reserved')</p>
        <p class="small">@lang('Developed by') <a href="https://slmedia.lv" class="text-white" target="_blank">S&L Media
            SIA</a></p>
      </div>
    </div>
  </div>
</footer>
