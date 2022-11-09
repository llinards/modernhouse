<nav class="navbar border-bottom">
  <div class="nav-item modern-house-logo">
    <a href="/admin">
      <img src="{{ asset('storage/logo-black.svg') }}" class="modern-house-logo w-75" alt="Modern House logo">
    </a>
  </div>
  <div class="nav-item flex-grow-1">
    <a href="/admin/create" class="nav-link">Jauna māja/modulis</a>
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
