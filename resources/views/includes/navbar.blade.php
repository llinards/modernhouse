<nav class="mobile-navbar {{ $index ? 'position-fixed' : '' }} w-100">
  <div class="container-fluid d-flex justify-content-between">
    <div class="logo">
      <a class="navbar-brand" href="/">
        <img src="{{ asset('storage/logo-black.svg') }}" class="modern-house-logo" alt="Modern House logo">
      </a>
    </div>
    <button type="button" class="navbar-toggler px-3">
      <div class="bar1"></div>
      <div class="bar2"></div>
      <div class="bar3"></div>
    </button>
  </div>

  <div id="mobile-navbar-modal" class="h-100">
    <div id="modal-content" class="d-flex h-100 flex-column justify-content-around align-items-center">
      <div class="logo">
        <a class="navbar-brand" href="/">
          <img src="{{ asset('storage/logo-black.svg') }}" class="modern-house-logo" alt="Modern House logo">
        </a>
      </div>
      <div class="nav-items">
        <ul class="navbar-nav">
          @foreach($allProducts as $product)
            <li class="nav-item">
              <a class="nav-link text-center {{ request()->is($product->slug) ? 'nav-link-active' : '' }}" href="/{{ $product->slug }}">{{ $product->name }}</a>
            </li>
          @endforeach
        </ul>
      </div>
      <div class="nav-items">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link text-center {{ request()->is('about-us') ? 'nav-link-active' : '' }}" href="#">@lang('news')</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-center {{ request()->is('about-us') ? 'nav-link-active' : '' }}" href="#">@lang('gallery')</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-center {{ request()->is('about-us') ? 'nav-link-active' : '' }}" href="#">@lang('about')</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-center {{ request()->is('contact-us') ? 'nav-link-active' : '' }}" href="/contact-us">@lang('contact')</a>
          </li>
  {{--        @if (count(config('app.languages')) > 1)--}}
  {{--          <li class="nav-item language-select d-flex justify-content-between">--}}
  {{--            @foreach (config('app.languages') as $langLocale => $langName)--}}
  {{--              <a class="nav-link {{ $langLocale == strtoupper(app()->getLocale()) ? 'nav-link-active' : '' }}"--}}
  {{--                href="{{ url()->current() }}?language={{ $langLocale }}">{{ strtoupper($langLocale) }}</a>--}}
  {{--            @endforeach--}}
  {{--          </li>--}}
  {{--        @endif--}}
        </ul>
      </div>
      <div class="d-flex social-network-icons-menu">
        <div class="p-1">
          <a href="" class="nav-link" target="_blank"><i class="bi bi-instagram"></i></a>
        </div>
        <div class="p-1 social-network-icon-dividers">|</div>
        <div class="p-1">
          <a href="" class="nav-link" target="_blank"><i class="bi bi-facebook"></i></a>
        </div>
        <div class="p-1 social-network-icon-dividers">|</div>
        <div class="p-1">
          <a href="mailto:info@modern-house.lv" class="nav-link" target="_blank"><i class="bi bi-envelope-fill"></i></a>
        </div>
      </div>
      <div class="footer-info d-flex flex-column align-items-center">
        <p>Lauku iela 1, Sigulda, Siguldas nov., LV-2150</p>
        <p>@lang('modern house registration number'): 40203251766</p>
        <p class="mt-4">&copy; {{ date('Y') }} "Modern House" SIA</p>
      </div>
    </div>
  </div>
</nav>

<script>
  const menu = document.querySelector(".navbar-toggler");
  const menuLinks = document.querySelectorAll("#mobile-navbar-modal .nav-link");

  function closeMenu() {
    menu.classList.remove('open');
    document.getElementById('mobile-navbar-modal').style.width = '0';
    document.getElementById('modal-content').style.opacity = '0';
    document.querySelector('.content').classList.remove('backdrop');
    document.querySelector('.mobile-navbar .logo .modern-house-logo').classList.remove('backdrop');
    document.body.style.overflowY = 'scroll';
  }

  function openMenu() {
    menu.classList.add('open');
    if (window.screen.width <= 990) {
      document.getElementById('mobile-navbar-modal').style.width = '100%';
    } else {
      document.getElementById('mobile-navbar-modal').style.width = '40%';
    }
    document.getElementById('modal-content').style.opacity = '1';
    document.querySelector('.content').classList.add('backdrop');
    document.querySelector('.mobile-navbar .logo .modern-house-logo').classList.add('backdrop');
    document.body.style.overflowY = 'hidden';
  }

  menuLinks.forEach((link) => {
    link.addEventListener('click', () => {
      if (menu.classList.contains('open')) {
        closeMenu();
      } else {
        openMenu();
        document.querySelector('.content.backdrop').addEventListener('click', () => {
          closeMenu();
          for (let item of menu.children) {
            item.classList.remove("change");
          }
        })
      }
      for (let item of menu.children) {
        item.classList.toggle("change");
      }
    });
  });

  menu.addEventListener("click", () => {
    if (menu.classList.contains('open')) {
      closeMenu();
    } else {
      openMenu();
      document.querySelector('.content.backdrop').addEventListener('click', () => {
        closeMenu();
        for (let item of menu.children) {
          item.classList.remove("change");
        }
      })
    }
    for (let item of menu.children) {
      item.classList.toggle("change");
    }
  });
</script>
