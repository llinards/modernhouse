<nav class="navbar border-bottom">
  <div class="nav-item modern-house-logo">
    <a href="/admin">
      <img src="{{ asset('storage/logo/logo-black.png') }}" class="modern-house-logo w-75" alt="Modern House logo">
    </a>
  </div>
  <div class="nav-item">
    <a href="/admin/create" class="nav-link">Jauna kategorija</a>
  </div>
  <div class="nav-item">
    <a href="/admin/product-variant/create" class="nav-link">Jauns modulis/māja</a>
  </div>
  <div class="nav-item">
    <a href="/admin/gallery" class="nav-link">Galerijas</a>
  </div>
  <div class="nav-item">
    <a href="/admin/news" class="nav-link">Aktualitātes</a>
  </div>
  <div class="nav-item px-2">
    <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
      Iziet
    </a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
      @csrf
    </form>
  </div>
</nav>
