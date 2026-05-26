@php($locale = app()->getLocale())
<nav class="mobile-navbar {{ isset($home) ? 'position-fixed navbar-index' : 'navbar-product-page' }} w-100">
    <div class="container-xxl d-flex justify-content-between">
        <div class="logo py-4">
            <a class="navbar-brand" href="{{ route('home', ['language' => $locale]) }}">
                <img src="{{ isset($home) ? asset('storage/logo/logo-white.png') : asset('storage/logo/logo-black.png') }}"
                    class="modern-house-logo" alt="Modern House logo">
            </a>
        </div>

        <div class="navbar-links-desktop d-flex justify-content-center align-items-center">
            @if (count($allActiveProducts) > 1)
                @foreach ($allActiveProducts as $product)
                    <a class="nav-link {{ isset($home) ? 'nav-link-index' : 'nav-link-product-page' }} text-center p-3 {{ Request::routeIs('products.show') && Request::route('product')?->slug === $product->slug ? 'nav-link-active' : '' }}"
                        href="{{ route('products.show', ['language' => $locale, 'product' => $product->slug]) }}">{{ $product->translations[0]->name }}</a>
                @endforeach
            @endif
            <a class="nav-link {{ isset($home) ? 'nav-link-index' : 'nav-link-product-page' }} text-center p-3 {{ Request::routeIs('modern-house-furniture') ? 'nav-link-active' : '' }}"
                href="{{ route('modern-house-furniture', ['language' => $locale]) }}">@lang('MH galdniecība')</a>
            @if (isset($projectCatalogs) && $projectCatalogs->isNotEmpty())
                <div class="nav-item dropdown">
                    <a class="nav-link {{ isset($home) ? 'nav-link-index' : 'nav-link-product-page' }} text-center p-3 dropdown-toggle"
                        href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">@lang('Projektu katalogi')</a>
                    <ul class="dropdown-menu">
                        @foreach ($projectCatalogs as $catalog)
                            @php($catalogTranslation = $catalog->translations[0])
                            <li>
                                <a class="dropdown-item" target="_blank" rel="noopener noreferrer"
                                    href="{{ asset('storage/project-catalogs/' . $catalog->id . '/' . $catalogTranslation->language . '/' . $catalogTranslation->pdf_filename) }}">
                                    {{ $catalogTranslation->menu_name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
        <button type="button" name="menu" class="navbar-toggler py-4">
            <div class="bar1 {{ isset($home) ? 'bar-index' : '' }}"></div>
            <div class="bar2 {{ isset($home) ? 'bar-index' : '' }}"></div>
            <div class="bar3 {{ isset($home) ? 'bar-index' : '' }}"></div>
        </button>
    </div>

    <div id="navbar-modal" class="h-100">
        <div id="modal-content" class="d-flex h-100 flex-column justify-content-between py-4 align-items-center">
            <div class="logo p-0">
                <a class="navbar-brand" href="{{ route('home', ['language' => $locale]) }}">
                    <img src="{{ asset('storage/logo/logo-black.png') }}" class="modern-house-logo"
                        alt="Modern House logo">
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
                    @foreach ($allActiveProducts as $product)
                        <li class="nav-item">
                            <a class="nav-link text-center {{ Request::routeIs('products.show') && Request::route('product')?->slug === $product->slug ? 'nav-link-active' : '' }}"
                                href="{{ route('products.show', ['language' => $locale, 'product' => $product->slug]) }}">{{ $product->translations[0]->name }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
            @if (isset($projectCatalogs) && $projectCatalogs->isNotEmpty())
                <div class="nav-items">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <p class="nav-link text-center mb-0 fw-bold">@lang('Projektu katalogi')</p>
                        </li>
                        @foreach ($projectCatalogs as $catalog)
                            @php($catalogTranslation = $catalog->translations[0])
                            <li class="nav-item">
                                <a class="nav-link text-center" target="_blank" rel="noopener noreferrer"
                                    href="{{ asset('storage/project-catalogs/' . $catalog->id . '/' . $catalogTranslation->language . '/' . $catalogTranslation->pdf_filename) }}">
                                    {{ $catalogTranslation->menu_name }}
                                </a>
                            </li>
                        @endforeach

                    </ul>
                </div>
            @endif
            <div class="nav-items">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link text-center {{ Request::routeIs('modern-house-furniture') ? 'nav-link-active' : '' }}"
                            href="{{ route('modern-house-furniture', ['language' => $locale]) }}">MODERN HOUSE
                            FURNITURE</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-center {{ Request::routeIs('news.*') ? 'nav-link-active' : '' }}"
                            href="{{ route('news.index', ['language' => $locale]) }}">@lang('news')</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-center {{ Request::routeIs('gallery') ? 'nav-link-active' : '' }}"
                            href="{{ route('gallery', ['language' => $locale]) }}">@lang('gallery')</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-center {{ Request::routeIs('faq') ? 'nav-link-active' : '' }}"
                            href="{{ route('faq', ['language' => $locale]) }}">@lang('faq')</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-center {{ Request::routeIs('about-us') ? 'nav-link-active' : '' }}"
                            href="{{ route('about-us', ['language' => $locale]) }}">@lang('about')</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-center {{ Request::routeIs('contact-us') ? 'nav-link-active' : '' }}"
                            href="{{ route('contact-us', ['language' => $locale]) }}">@lang('contact')</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-center {{ Request::routeIs('privacy-policy') ? 'nav-link-active' : '' }}"
                            href="{{ route('privacy-policy', ['language' => $locale]) }}">@lang('privacy policy')</a>
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
                    <a href="mailto:info@modern-house.lv" class="nav-link" target="_blank"><i
                            class="bi bi-envelope-fill"></i></a>
                </div>
            </div>
        </div>
    </div>
</nav>

<script type="module">
    const menu = document.querySelector(".navbar-toggler");
    const menuLinks = document.querySelectorAll("#navbar-modal .nav-link");

    function closeMenu() {
        menu.classList.remove('open');
        document.getElementById('navbar-modal').style.width = '0';
        document.getElementById('modal-content').style.opacity = '0';
        document.querySelector('.content').classList.remove('backdrop');
        const navbarLinksDesktop = document.querySelector('.navbar-links-desktop');
        (navbarLinksDesktop) ? navbarLinksDesktop.classList.remove('visually-hidden'): '';
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
        (navbarLinksDesktop) ? navbarLinksDesktop.classList.add('visually-hidden'): '';
        document.querySelector('.mobile-navbar .logo .modern-house-logo').classList.add('backdrop');

    }

    function toggleOpenCloseMenu() {
        if (menu.classList.contains('open')) {
            closeMenu();
            document.documentElement.classList.remove('overflow-hidden-height-100');
        } else {
            openMenu();
            document.documentElement.classList.add('overflow-hidden-height-100');
            document.querySelector('.content.backdrop').addEventListener('click', () => {
                closeMenu();
                document.documentElement.classList.remove('overflow-hidden-height-100');
                for (let item of menu.children) {
                    item.classList.remove("change");
                }
            })
        }
        for (let item of menu.children) {
            item.classList.toggle("change");
        }
    }

    menuLinks.forEach((link) => {
        link.addEventListener('click', () => {
            toggleOpenCloseMenu()
        });
    });

    menu.addEventListener("click", () => {
        toggleOpenCloseMenu();
    });
</script>
