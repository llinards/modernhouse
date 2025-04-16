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
          <a class="nav-link index text-center p-3 submenu-trigger"
             data-submenu-id="submenu-{{ $product->id }}"
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

  @if(isset($home))
    <div class="submenu-container" aria-hidden="true">
      <div class="container-xxl">
        <hr>
        @foreach($allActiveProducts as $product)
          <div id="submenu-{{ $product->id }}" class="submenu-content my-5">
            <div class="swiper submenu-swiper">
              <div class="swiper-wrapper">
                @foreach($product->productVariants as $productVariant)
                  <div class="swiper-slide">
                    <div class="submenu-item">
                      <a href="{{app()->getLocale()}}/{{$product->slug}}/{{$productVariant->slug}}">
                        <img class="submenu-item-image" src="{{asset('storage/product-images/demo_module.png')}}"/>
                        <h4 class="submenu-title">{{$productVariant->translations[0]->name}}</h4>
                      </a>
                    </div>
                  </div>
                @endforeach
              </div>
              <!-- Add navigation -->
              <div class="swiper-button-next"></div>
              <div class="swiper-button-prev"></div>
            </div>
          </div>
        @endforeach

        <!-- Removed the submenu-projects div as it won't be needed -->
      </div>
    </div>
  @endif
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
  const domElements = {
    menu: document.querySelector(".navbar-toggler"),
    menuLinks: document.querySelectorAll("#navbar-modal .nav-link"),
    navbarIndex: document.querySelector(".navbar-index"),
    indexLinks: document.querySelectorAll(".nav-link.index"),
    logoToggle: document.querySelector(".logo-toggle"),
    barIndexElements: document.querySelectorAll(".bar-index"),
    navbarModal: document.getElementById('navbar-modal'),
    contentElement: document.querySelector('.content'),
    modalContent: document.getElementById('modal-content'),
    navbarLinksDesktop: document.querySelector('.navbar-links-desktop'),
    navbarLogo: document.querySelector('.mobile-navbar .logo .modern-house-logo'),
    submenuContainer: document.querySelector('.submenu-container'),
    submenuTriggers: document.querySelectorAll('.submenu-trigger'),
    submenuContents: document.querySelectorAll('.submenu-content'),
    projectsLink: document.querySelector('a.nav-link.index[href*="svires-ielas-projekts"]')
  };

  // Configuration constants
  const config = {
    blackLogoSrc: "{{ asset('storage/logo/logo-black.png') }}",
    whiteLogoSrc: "{{ asset('storage/logo/logo-white.png') }}",
    primaryColorHover: "#919191",
    defaultBgColor: "rgba(63, 63, 63, .5)",
    hoverBgColor: "white",
    defaultLinkColor: "white",
    hoverLinkColor: "#333",
    animationDuration: 300, // in milliseconds, matches CSS transition times
    breakpoint: 990, // mobile breakpoint in pixels
  };

  // State variables
  let state = {
    activeSubmenu: null,
    submenuTimeout: null,
    swipers: {} // Store initialized swipers by submenu ID
  };

  // Utility functions
  const isSmallScreen = () => window.innerWidth <= config.breakpoint;

  // Menu functions
  const menuFunctions = {
    open: () => {
      domElements.menu.classList.add('open');
      domElements.menu.setAttribute('aria-expanded', 'true');
      domElements.navbarModal.style.width = isSmallScreen() ? '100%' : '40%';
      domElements.navbarModal.setAttribute('aria-hidden', 'false');
      domElements.modalContent.style.opacity = '1';

      domElements.contentElement?.classList.add('backdrop');
      domElements.navbarLinksDesktop?.classList.add('visually-hidden');
      domElements.navbarLogo?.classList.add('backdrop');

      document.documentElement.classList.add('overflow-hidden-height-100');

      // Animate menu bars
      Array.from(domElements.menu.children).forEach(item => item.classList.add("change"));
    },

    close: () => {
      domElements.menu.classList.remove('open');
      domElements.menu.setAttribute('aria-expanded', 'false');
      domElements.navbarModal.style.width = '0';
      domElements.navbarModal.setAttribute('aria-hidden', 'true');
      domElements.modalContent.style.opacity = '0';

      domElements.contentElement?.classList.remove('backdrop');
      domElements.navbarLinksDesktop?.classList.remove('visually-hidden');
      domElements.navbarLogo?.classList.remove('backdrop');

      document.documentElement.classList.remove('overflow-hidden-height-100');

      // Reset menu bars
      Array.from(domElements.menu.children).forEach(item => item.classList.remove("change"));
    },

    toggle: () => {
      // First reset any active submenu and navbar state
      navbarFunctions.resetState();

      // Then toggle the menu
      if (domElements.menu.classList.contains('open')) {
        menuFunctions.close();
      } else {
        menuFunctions.open();
      }
    }
  };

  // Navbar functions
  const navbarFunctions = {
    setHoverState: () => {
      // Set navbar to hover state
      domElements.navbarIndex.style.backgroundColor = config.hoverBgColor;

      // Update link colors
      domElements.indexLinks.forEach(link => {
        link.style.color = config.hoverLinkColor;
      });

      // Update bars color
      domElements.barIndexElements.forEach(bar => {
        bar.style.backgroundColor = config.hoverLinkColor;
      });

      // Update logo
      if (domElements.logoToggle) {
        domElements.logoToggle.src = config.blackLogoSrc;
      }
    },

    setDefaultState: () => {
      // Set navbar to default state
      domElements.navbarIndex.style.backgroundColor = config.defaultBgColor;

      // Update link colors
      domElements.indexLinks.forEach(link => {
        link.style.color = config.defaultLinkColor;
      });

      // Update bars color
      domElements.barIndexElements.forEach(bar => {
        bar.style.backgroundColor = config.defaultLinkColor;
      });

      // Update logo
      if (domElements.logoToggle) {
        domElements.logoToggle.src = config.whiteLogoSrc;
      }
    },

    resetState: () => {
      // Reset active submenu
      if (domElements.submenuContainer) {
        domElements.submenuContainer.classList.remove('active');
        domElements.submenuContents.forEach(content => {
          content.classList.remove('active');
        });
        state.activeSubmenu = null;
        domElements.submenuContainer.setAttribute('aria-hidden', 'true');
      }

      // Reset navbar colors and styles to default
      if (domElements.navbarIndex) {
        navbarFunctions.setDefaultState();
      }
    }
  };

  // Swiper initialization function - Modified for centered slides and to fix jerking
  const initSwiper = (submenuId) => {
    const submenu = document.getElementById(submenuId);
    if (!submenu) return null;

    const swiperElement = submenu.querySelector('.submenu-swiper');
    if (!swiperElement) return null;

    // Return existing swiper if already initialized
    if (state.swipers[submenuId]) return state.swipers[submenuId];

    // Common config options
    const commonOptions = {
      modules: [Navigation],
      initialSlide: 0,
      loop: false,
      preloadImages: true,
      updateOnImagesReady: true,
      watchSlidesProgress: true,
      watchSlidesVisibility: true,
      navigation: {
        nextEl: swiperElement.querySelector('.swiper-button-next'),
        prevEl: swiperElement.querySelector('.swiper-button-prev'),
      }
    };

    // Create a new Swiper instance
    try {
      const swiper = new Swiper(swiperElement, {
        ...commonOptions,
        slidesPerView: 4,
        speed: 400, // Smooth animation speed
        init: false, // Prevent auto initialization to avoid layout shifts
      });

      // Initialize swiper only when everything is ready
      swiper.on('init', () => {
        // Force layout recalculation
        swiper.update();
      });

      // Initialize and store the swiper instance
      swiper.init();
      state.swipers[submenuId] = swiper;

      return swiper;
    } catch (e) {
      console.error("Error initializing Swiper:", e);
      return null;
    }
  };

  // Submenu functions
  const submenuFunctions = {
    show: (submenuId) => {
      clearTimeout(state.submenuTimeout);

      // Hide all submenus first
      domElements.submenuContents.forEach(content => {
        content.classList.remove('active');
      });

      // Show the selected submenu
      const targetSubmenu = document.getElementById(submenuId);
      if (targetSubmenu) {
        // Initialize swiper before making the submenu visible
        const swiper = initSwiper(submenuId);

        // Then make submenu visible
        targetSubmenu.classList.add('active');
        domElements.submenuContainer.classList.add('active');
        state.activeSubmenu = submenuId;
        domElements.submenuContainer.setAttribute('aria-hidden', 'false');

        // Update swiper after submenu is visible
        if (swiper) {
          // Use requestAnimationFrame for smoother updates
          requestAnimationFrame(() => {
            swiper.update();
          });
        }
      }
    },

    hide: (callback) => {
      clearTimeout(state.submenuTimeout);

      // Start hiding the submenu
      domElements.submenuContainer.classList.remove('active');

      // Wait for submenu to finish closing animation
      state.submenuTimeout = setTimeout(() => {
        if (!domElements.submenuContainer.classList.contains('active')) {
          domElements.submenuContents.forEach(content => {
            content.classList.remove('active');
          });
          state.activeSubmenu = null;
          domElements.submenuContainer.setAttribute('aria-hidden', 'true');

          // Execute callback after submenu is closed, if provided
          if (typeof callback === 'function') {
            callback();
          }
        }
      }, config.animationDuration);
    }
  };

  // Initialize navbar interactions
  const initNavbarInteractions = () => {
    if (!domElements.navbarIndex || domElements.indexLinks.length === 0) return;

    const setNavbarState = (isHovered, targetElement = null) => {
      // If not hovering, trigger the staged animation
      if (!isHovered) {
        // First hide submenu, then reset navbar
        submenuFunctions.hide(() => {
          // This callback runs after the submenu is hidden
          navbarFunctions.setDefaultState();
        });
        return; // Exit early since we're handling this in a staged way
      }

      // Set navbar to hover state
      navbarFunctions.setHoverState();

      // If hovering a specific link, highlight it
      if (targetElement) {
        targetElement.style.color = config.primaryColorHover;

        // Show submenu if the target is a submenu trigger, hide otherwise
        if (targetElement.classList.contains('submenu-trigger')) {
          const submenuId = targetElement.getAttribute('data-submenu-id');
          if (submenuId) {
            submenuFunctions.show(submenuId);
          }
        } else {
          // If it's the projects link or any non-submenu link, hide any active submenu
          submenuFunctions.hide();
        }
      }
    };

    // Add hover events to individual links
    domElements.indexLinks.forEach(link => {
      link.addEventListener("mouseenter", (event) => setNavbarState(true, event.target));
    });

    // Reset when mouse leaves navbar area
    domElements.navbarIndex.addEventListener("mouseleave", () => {
      setNavbarState(false);
    });

    // Handle submenu container events
    if (domElements.submenuContainer) {
      domElements.submenuContainer.addEventListener('mouseenter', () => {
        // Keep navbar in hovered state when hovering submenu
        navbarFunctions.setHoverState();
      });

      domElements.submenuContainer.addEventListener('mouseleave', () => {
        setNavbarState(false);
      });
    }

    // Add specific behavior for the projects link
    if (domElements.projectsLink) {
      domElements.projectsLink.addEventListener('mouseenter', () => {
        // Hide any active submenu when hovering the projects link
        submenuFunctions.hide();
      });
    }
  };

  // Initialize event listeners
  const initEventListeners = () => {
    // Menu toggle
    domElements.menu.addEventListener("click", menuFunctions.toggle);

    // Close menu when clicking links
    domElements.menuLinks.forEach(link => {
      link.addEventListener('click', menuFunctions.close);
    });

    // Close menu when clicking outside
    domElements.contentElement?.addEventListener('click', () => {
      if (domElements.menu.classList.contains('open')) {
        menuFunctions.close();
      }
    });

    // Handle resize events
    window.addEventListener('resize', () => {
      if (domElements.menu.classList.contains('open')) {
        domElements.navbarModal.style.width = isSmallScreen() ? '100%' : '40%';
      }

      // Update all active swipers on resize
      if (state.activeSubmenu) {
        const swiper = state.swipers[state.activeSubmenu];
        if (swiper) {
          swiper.update();
        }
      }
    });

    // Support keyboard navigation
    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape' && domElements.menu.classList.contains('open')) {
        menuFunctions.close();
      }
    });
  };

  // Initialize the application
  const init = () => {
    initNavbarInteractions();
    initEventListeners();
  };

  // Start the application
  init();
</script>
