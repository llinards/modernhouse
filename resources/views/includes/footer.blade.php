<footer>
  <div class="container-xxl h-100 pb-2">
    <div class="row align-items-center h-100 text-md-start text-center">
      <div class="col-lg-7 col-md-5 col-12 pt-md-0 pt-2">
        <img class="modern-house-logo" src="{{ asset('storage/logo/logo-white.png') }} " alt="Modern House Logo">
      </div>
      <div class="col-lg-2 col-md-3 col-6">
        <h4 class="mb-2">@lang('address')</h4>
        <p class="small">Lauku iela 1, Sigulda,<br/> Siguldas nov., LV-2150</p>
        <p class="small">@lang('modern house registration number'): 40203251766</p>
      </div>
      <div class="col-lg-2 col-md-3 col-6">
        <h4 class="mb-2">@lang('contact us')</h4>
        <a href="mailto:info@modern-house.lv" class="text-white small">info@modern-house.lv</a>
        <br/>
        <a href="tel:+37125666622" class="text-white small">+371 25666622</a>
        <p class="small invisible">+371 25666622</p>
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
          <a href="mailto:info@modern-house.lv" class="nav-link" target="_blank"><i
              class="bi bi-envelope-fill text-white"></i></a>
        </div>
      </div>
      <hr class="m-0">
      <div class="d-md-flex justify-content-between align-items-center">
        <p class="small">&copy; SIA {{ config('app.name') }} {{  date ('Y') }} | @lang('all rights reserved')</p>
        <div>
          <p class="small">@lang('Designed by') <a href="https://simpledesign.lv" class="text-white" target="_blank">SIMPLE
              DESIGN</a></p>
          <p class="small">@lang('Developed by') <a href="https://slmedia.lv" class="text-white" target="_blank">S&L
              MEDIA</a></p>
        </div>
      </div>
    </div>
  </div>
</footer>
