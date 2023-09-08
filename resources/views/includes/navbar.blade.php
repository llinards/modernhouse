<nav class="mobile-navbar {{ $index ? 'position-fixed navbar-index' : 'navbar-product-page' }} w-100">
  <div class="container-xxl d-flex justify-content-between">
    <div class="logo py-4">
      <a class="navbar-brand" href="/{{app()->getLocale()}}">
        <img src="{{ $index ? asset('storage/logo/logo-white.png') : asset('storage/logo/logo-black.png') }}"
             class="modern-house-logo" alt="Modern House logo">
      </a>
    </div>
    @if($index && (count($allActiveProducts) > 1))
      <div class="navbar-links-desktop d-flex justify-content-center align-items-center">
        @foreach($allActiveProducts as $product)
          <a class="nav-link index text-center p-3"
             href="/{{app()->getLocale()}}/{{ $product->slug }}">{{ $product->{'name_'.app()->getLocale()} }}</a>
        @endforeach
      </div>
    @endif
    <button type="button" name="menu" class="navbar-toggler py-4">
      <div class="bar1 {{ $index ? 'bar-index' : '' }}"></div>
      <div class="bar2 {{ $index ? 'bar-index' : '' }}"></div>
      <div class="bar3 {{ $index ? 'bar-index' : '' }}"></div>
    </button>
  </div>

  <div id="navbar-modal" class="h-100">
    <div id="modal-content" class="d-flex h-100 flex-column justify-content-between py-4 align-items-center">
      <div class="logo p-0">
        <a class="navbar-brand" href="/">
          <img src="{{ asset('storage/logo/logo-black.png') }}" class="modern-house-logo" alt="Modern House logo">
        </a>
      </div>
      <div class="nav-items">
        <ul class="navbar-nav">
          @if (count(config('app.languages')) > 1)
            <li class="nav-item language-select d-flex justify-content-between">
              @foreach (config('app.languages') as $langLocale => $langName)
                <a class="nav-link mx-2 {{ $langLocale == app()->getLocale() ? 'nav-link-active' : '' }}"
                   href="{{ url()->current() }}?changeLanguage={{ $langLocale }}">{{ strtoupper($langLocale) }}</a>
              @endforeach
            </li>
          @endif
        </ul>
      </div>
      <div class="nav-items">
        <ul class="navbar-nav">
          @foreach($allActiveProducts as $product)
            <li class="nav-item">
              <a class="nav-link text-center {{ request()->is($product->slug) ? 'nav-link-active' : '' }}"
                 href="/{{app()->getLocale()}}/{{ $product->slug }}">{{ $product->{'name_'.app()->getLocale()} }}</a>
            </li>
          @endforeach
        </ul>
      </div>
      <div class="nav-items">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link text-center {{ request()->is('news') ? 'nav-link-active' : '' }}"
               href="/{{app()->getLocale()}}/news">@lang('news')</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-center {{ request()->is('gallery') ? 'nav-link-active' : '' }}"
               href="/{{app()->getLocale()}}/gallery">@lang('gallery')</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-center {{ request()->is('about-us') ? 'nav-link-active' : '' }}"
               href="/{{app()->getLocale()}}/about-us">@lang('about')</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-center {{ request()->is('contact-us') ? 'nav-link-active' : '' }}"
               href="/{{app()->getLocale()}}/contact-us">@lang('contact')</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-center {{ request()->is('privacy-policy') ? 'nav-link-active' : '' }}"
               href="/{{app()->getLocale()}}/privacy-policy">@lang('privacy-policy')</a>
          </li>
        </ul>
      </div>
      <div class="d-flex navbar-modal-social-network-icons">
        <div class="p-1">
          <a href="https://www.instagram.com/housemodern_2021/" class="nav-link" target="_blank"><i
              class="bi bi-instagram"></i></a>
        </div>
        <div class="p-1 navbar-modal-social-network-icon-dividers">|</div>
        <div class="p-1">
          <a href="https://www.facebook.com/ModernHouseLV" class="nav-link" target="_blank"><i
              class="bi bi-facebook"></i></a>
        </div>
        <div class="p-1 navbar-modal-social-network-icon-dividers">|</div>
        <div class="p-1">
          <a href="mailto:info@modern-house.lv" class="nav-link" target="_blank"><i class="bi bi-envelope-fill"></i></a>
        </div>
      </div>
      <div class="navbar-modal-footer d-flex flex-column align-items-center">
        <p class="text-center small">Lauku iela 1, Sigulda, Siguldas nov., LV-2150</p>
        <p class="small">@lang('modern house registration number'): 40203251766</p>
        <p class="mt-2 small">&copy; {{ date('Y') }} "Modern House" SIA</p>
      </div>
    </div>
  </div>
</nav>

<script>
  const menu = document.querySelector(".navbar-toggler");
  const menuLinks = document.querySelectorAll("#navbar-modal .nav-link");

  function closeMenu() {
    menu.classList.remove('open');
    document.getElementById('navbar-modal').style.width = '0';
    document.getElementById('modal-content').style.opacity = '0';
    document.querySelector('.content').classList.remove('backdrop');
    const navbarLinksDesktop = document.querySelector('.navbar-links-desktop');
    (navbarLinksDesktop) ? navbarLinksDesktop.classList.remove('visually-hidden') : '';
    document.querySelector('.mobile-navbar .logo .modern-house-logo').classList.remove('backdrop');

  }

  function openMenu() {
    menu.classList.add('open');
    if (window.screen.width <= 990) {
      document.getElementById('navbar-modal').style.width = '100%';
    } else {
      document.getElementById('navbar-modal').style.width = '40%';
    }
    document.getElementById('modal-content').style.opacity = '1';
    document.querySelector('.content').classList.add('backdrop');
    const navbarLinksDesktop = document.querySelector('.navbar-links-desktop');
    (navbarLinksDesktop) ? navbarLinksDesktop.classList.add('visually-hidden') : '';
    document.querySelector('.mobile-navbar .logo .modern-house-logo').classList.add('backdrop');

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
