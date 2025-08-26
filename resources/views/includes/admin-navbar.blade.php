<nav class="navbar border-bottom flex-column flex-lg-row">
  <div class="nav-item modern-house-logo">
    <a href="/admin">
      <img src="{{ asset('storage/logo/logo-black.png') }}" class="modern-house-logo w-75" alt="Modern House logo">
    </a>
  </div>
  @if(app()->getLocale() === 'lv')
    <div class="nav-item">
      <a href="/admin/create" class="nav-link">Jauna kategorija</a>
    </div>
    <div class="nav-item">
      <a href="/admin/product-variant/create" class="nav-link">Jauns modulis/māja</a>
    </div>
  @endif
  <div class="nav-item">
    <a href="/admin/open-days-submissions" class="nav-link">Pieteikumi atvērto durvju dienām</a>
  </div>
  <div class="nav-item">
    <a href="/admin/gallery" class="nav-link">Galerijas</a>
  </div>
  <div class="nav-item">
    <a href="/admin/news" class="nav-link">Aktualitātes</a>
  </div>
  <div>|</div>
  @if (count(config('app.languages')) > 1)
    <div class="nav-item d-flex justify-content-between">
      @foreach (config('app.languages') as $langLocale => $langName)
        <a class="nav-link mx-2 {{ $langLocale == app()->getLocale() ? 'nav-link-active' : '' }}"
           href="{{ url()->current() }}?language={{ $langLocale }}">{{ strtoupper($langLocale) }}</a>
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
