<nav class="mobile-navbar {{ isset($home) ? 'position-fixed navbar-index' : 'navbar-product-page' }} w-100">
  <div class="container-xxl d-flex justify-content-between">
    <div class="logo py-4">
      <a class="navbar-brand" href="/{{app()->getLocale()}}">
        <img src="{{ isset($home) ? asset('storage/logo/logo-white.png') : asset('storage/logo/logo-black.png') }}"
             class="modern-house-logo {{ isset($home) ? 'logo-toggle' : '' }}" alt="Modern House logo">
      </a>
    </div>
    @if(isset($home) && (count($allActiveProducts) > 1))
      <div class="navbar-links-desktop d-flex justify-content-center align-items-center">
        @foreach($allActiveProducts as $product)
          <a class="nav-link index text-center p-3"
             href="/{{app()->getLocale()}}/{{ $product->slug }}">{{ $product->translations[0]->name }}</a>
        @endforeach
        @if(app()->getLocale() === 'lv')
          <a class="nav-link index text-center p-3"
             href="/lv/projekti/svires-ielas-projekts-sigulda" target="_blank">@lang('projects')</a>
        @endif
      </div>
    @endif
    <button type="button" name="menu" class="navbar-toggler py-4" aria-label="Toggle navigation" aria-expanded="false"
            aria-controls="navbar-modal">
      <div class="bar1 {{ isset($home) ? 'bar-index' : '' }}"></div>
      <div class="bar2 {{ isset($home) ? 'bar-index' : '' }}"></div>
      <div class="bar3 {{ isset($home) ? 'bar-index' : '' }}"></div>
    </button>
  </div>

  <div id="navbar-modal" class="h-100" aria-hidden="true">
    <div id="modal-content" class="d-flex h-100 flex-column justify-content-between py-4 align-items-center">
      <div class="logo p-0">
        <a class="navbar-brand" href="/">
          <img src="{{ asset('storage/logo/logo-black.png') }}" class="modern-house-logo" alt="Modern House logo">
        </a>
      </div>
      <div class="nav-items">
        <ul class="navbar-nav">
          @if (count(config('app.languages')) > 1)
            <li class="nav-item d-flex justify-content-between">
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
              <a class="nav-link text-center {{ Request::is('*/'.$product->slug.'*') ? 'nav-link-active' : '' }}"
                 href="/{{app()->getLocale()}}/{{ $product->slug }}">{{ $product->translations[0]->name }}</a>
            </li>
          @endforeach
          @if(app()->getLocale() === 'lv')
            <li class="nav-item">
              <a class="nav-link text-center"
                 href="/{{app()->getLocale()}}/projekti/svires-ielas-projekts-sigulda"
                 target="_blank">@lang('projects')</a>
            </li>
          @endif
        </ul>
      </div>
      <div class="nav-items">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link text-center {{ Request::is('*/news*') ? 'nav-link-active' : '' }}"
               href="/{{app()->getLocale()}}/news">@lang('news')</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-center {{ Request::is('*/gallery') ? 'nav-link-active' : '' }}"
               href="/{{app()->getLocale()}}/gallery">@lang('gallery')</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-center {{ Request::is('*/faq') ? 'nav-link-active' : '' }}"
               href="/{{app()->getLocale()}}/faq">@lang('faq')</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-center {{ Request::is('*/about-us') ? 'nav-link-active' : '' }}"
               href="/{{app()->getLocale()}}/about-us">@lang('about')</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-center {{ Request::is('*/contact-us') ? 'nav-link-active' : '' }}"
               href="/{{app()->getLocale()}}/contact-us">@lang('contact')</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-center {{ Request::is('*/privacy-policy') ? 'nav-link-active' : '' }}"
               href="/{{app()->getLocale()}}/privacy-policy">@lang('privacy policy')</a>
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
    </div>
  </div>
</nav>

<script type="module">
  // DOM elements
  const menu = document.querySelector(".navbar-toggler");
  const menuLinks = document.querySelectorAll("#navbar-modal .nav-link");
  const navbarIndex = document.querySelector(".navbar-index");
  const indexLinks = document.querySelectorAll(".nav-link.index");
  const logoToggle = document.querySelector(".logo-toggle");
  const barIndexElements = document.querySelectorAll(".bar-index");
  const navbarModal = document.getElementById('navbar-modal');
  const contentElement = document.querySelector('.content');
  const modalContent = document.getElementById('modal-content');
  const navbarLinksDesktop = document.querySelector('.navbar-links-desktop');
  const navbarLogo = document.querySelector('.mobile-navbar .logo .modern-house-logo');

  // Constants
  const blackLogoSrc = "{{ asset('storage/logo/logo-black.png') }}";
  const whiteLogoSrc = "{{ asset('storage/logo/logo-white.png') }}";
  const primaryColorHover = "#919191";
  const isSmallScreen = () => window.innerWidth <= 990;

  // Menu toggle functions
  function closeMenu() {
    menu.classList.remove('open');
    menu.setAttribute('aria-expanded', 'false');
    navbarModal.style.width = '0';
    navbarModal.setAttribute('aria-hidden', 'true');
    modalContent.style.opacity = '0';

    contentElement?.classList.remove('backdrop');
    navbarLinksDesktop?.classList.remove('visually-hidden');
    navbarLogo?.classList.remove('backdrop');

    document.documentElement.classList.remove('overflow-hidden-height-100');

    // Reset menu bars
    Array.from(menu.children).forEach(item => item.classList.remove("change"));
  }

  function openMenu() {
    menu.classList.add('open');
    menu.setAttribute('aria-expanded', 'true');
    navbarModal.style.width = isSmallScreen() ? '100%' : '40%';
    navbarModal.setAttribute('aria-hidden', 'false');
    modalContent.style.opacity = '1';

    contentElement?.classList.add('backdrop');
    navbarLinksDesktop?.classList.add('visually-hidden');
    navbarLogo?.classList.add('backdrop');

    document.documentElement.classList.add('overflow-hidden-height-100');

    // Animate menu bars
    Array.from(menu.children).forEach(item => item.classList.add("change"));
  }

  function toggleMenu() {
    if (menu.classList.contains('open')) {
      closeMenu();
    } else {
      openMenu();
    }
  }

  // Navbar index hover effects (consolidated)
  if (navbarIndex && indexLinks.length > 0) {
    const setNavbarState = (isHovered, targetElement = null) => {
      // Set link colors
      indexLinks.forEach(link => {
        link.style.color = isHovered ? "#333" : "white";
      });

      // If hovering a specific link, highlight it
      if (isHovered && targetElement) {
        targetElement.style.color = primaryColorHover;
      }

      // Update UI elements
      barIndexElements.forEach(bar => {
        bar.style.backgroundColor = isHovered ? "#333" : "white";
      });

      navbarIndex.style.backgroundColor = isHovered ? "white" : "rgba(63, 63, 63, .5)";

      if (logoToggle) {
        logoToggle.src = isHovered ? blackLogoSrc : whiteLogoSrc;
      }
    };

    // Add hover events to individual links
    indexLinks.forEach(link => {
      link.addEventListener("mouseenter", (event) => setNavbarState(true, event.target));
    });

    // Reset when mouse leaves navbar area
    navbarIndex.addEventListener("mouseleave", () => setNavbarState(false));
  }

  // Event listeners
  menu.addEventListener("click", toggleMenu);

  menuLinks.forEach(link => {
    link.addEventListener('click', closeMenu);
  });

  // Close menu when clicking outside
  contentElement?.addEventListener('click', (e) => {
    if (menu.classList.contains('open')) {
      closeMenu();
    }
  });

  // Handle resize events
  window.addEventListener('resize', () => {
    if (menu.classList.contains('open')) {
      navbarModal.style.width = isSmallScreen() ? '100%' : '40%';
    }
  });

  // Support keyboard navigation
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && menu.classList.contains('open')) {
      closeMenu();
    }
  });
</script>
