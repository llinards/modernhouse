<nav class="navbar navbar-expand-lg {{ $index ? 'position-fixed' : '' }} desktop-navbar w-100">
  <div class="container-xxl justify-content-between">
    <div class="logo">
      <a class="navbar-brand me-0" href="/">
        <img src="{{ asset('storage/logo-black.svg') }}" width="125" alt="Modern House logo">
      </a>
    </div>
    <div class="nav-items flex-grow-1">
      <ul class="navbar-nav" id="middle-links">
        @if ($index)
          <li class="nav-item push-right">
            <a class="nav-link p-3" href="#">Model 1</a>
          </li>
          <li class="nav-item">
            <a class="nav-link p-3" href="#">Model 2</a>
          </li>
          <li class="nav-item">
            <a class="nav-link p-3" href="#">Model 3</a>
          </li>
        @endif
        <li class="nav-item push-right">
          <a class="nav-link p-3" href="#">@lang('about')</a>
        </li>
        <li class="nav-item">
          <a class="nav-link p-3" href="#">@lang('contact')</a>
        </li>

        @if (count(config('app.languages')) > 1)
          <li class="nav-item dropdown">
            <a class="nav-link p-3 dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              {{ strtoupper(app()->getLocale()) }}
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              @foreach (config('app.languages') as $langLocale => $langName)
                @if ($langLocale != strtoupper(app()->getLocale()))
                  <li><a class="dropdown-item" href="{{ url()->current() }}?language={{ $langLocale }}">{{ strtoupper($langLocale) }}</a></li>
                @endif
              @endforeach
            </ul>
          </li>
        @endif
      </ul>
    </div>
  </div>
</nav>
