<nav class="navbar border-bottom flex-column flex-lg-row">
  <div class="nav-item modern-house-logo">
    <a href="/admin/{{ app()->getLocale() }}">
      <img src="{{ asset('storage/logo/logo-black.png') }}" class="modern-house-logo w-75" alt="Modern House logo">
    </a>
  </div>
  <div class="nav-item">
    <a href="/admin/{{ app()->getLocale() }}" class="nav-link">Sākums</a>
  </div>
  <div class="nav-item">
    <a href="/admin/{{ app()->getLocale() }}/open-days-submissions" class="nav-link">Pieteikumi atvērto durvju
      dienām</a>
  </div>
  <div class="nav-item">
    <a href="/admin/{{ app()->getLocale() }}/gallery" class="nav-link">Galerijas</a>
  </div>
  <div class="nav-item">
    <a href="/admin/{{ app()->getLocale() }}/news" class="nav-link">Aktualitātes</a>
  </div>
  <div>|</div>
  @if (count(config('app.languages')) > 1)
    <div class="nav-item d-flex justify-content-between">
      @foreach (config('app.languages') as $langLocale => $langName)
        <a class="nav-link mx-2 {{ $langLocale == app()->getLocale() ? 'nav-link-active' : '' }}"
           href="{{ str_replace('/admin/' . app()->getLocale(), '/admin/' . $langLocale, url()->current()) }}">{{ strtoupper($langLocale) }}</a>
      @endforeach
    </div>
  @endif
  <div>|</div>
  <div class="nav-item px-2">
    <a class="nav-link" href="{{ route('logout') }}"
       onclick="event.preventDefault();document.getElementById('logout-form').submit();">
      Iziet
    </a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
      @csrf
    </form>
  </div>
</nav>
