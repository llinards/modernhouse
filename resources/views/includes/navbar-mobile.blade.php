<nav class="mobile-navbar {{ $index ? 'position-fixed' : '' }} w-100">
  <div class="container-fluid d-flex justify-content-between">
    <div class="logo">
      <a class="navbar-brand" href="/">
        <img src="{{ asset('storage/logo-black.svg') }}" width="85" alt="Modern House logo">
      </a>
    </div>
    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#nav">
      <div class="bar1"></div>
      <div class="bar2"></div>
      <div class="bar3"></div>
    </button>
  </div>

  <div id="mobile-navbar-modal" class="d-flex h-100 flex-column justify-content-around align-items-center">
    @if ($index)
      <div class="nav-items">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="#">Model 1</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Model 2</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Model 3</a>
          </li>
        </ul>
      </div>
    @endif
    <div class="nav-items">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="#">@lang('about')</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">@lang('contact')</a>
        </li>
        @if (count(config('app.languages')) > 1)
          <li class="nav-item language-select d-flex justify-content-between">
            @foreach (config('app.languages') as $langLocale => $langName)
              <a class="nav-link {{ $langLocale == strtoupper(app()->getLocale()) ? 'nav-link-active' : '' }}"
                href="{{ url()->current() }}?language={{ $langLocale }}">{{ strtoupper($langLocale) }}</a>
            @endforeach
          </li>
        @endif
      </ul>
    </div>
  </div>
</nav>

<script>
  const menu = document.querySelector(".navbar-toggler");

  function closeMenu() {
    menu.classList.remove('open');
    document.getElementById('mobile-navbar-modal').style.width = '0';
    document.querySelector('.content').classList.remove('backdrop');
    document.querySelector('.content').style.overflowY = 'scroll';
  }

  function openMenu() {
    menu.classList.add('open');
    document.getElementById('mobile-navbar-modal').style.width = '60%';
    document.querySelector('.content').classList.add('backdrop');
    document.querySelector('.content').style.overflowY = 'hidden';
  }

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
