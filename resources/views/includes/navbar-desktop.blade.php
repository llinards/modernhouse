<nav class="navbar navbar-expand-lg sticky-top navbar-light">
  <div class="container-fluid justify-content-evenly">
    <div class="logo">
      <a class="navbar-brand" href="#">
        <img src="{{ asset('storage/logo-black.svg') }}" width="125" alt="">
      </a>
    </div>
    <div class="nav-items">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" href="#">Model 1</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="#">Model 2</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="#">Model 3</a>
        </li>
      </ul>
    </div>
    <div class="nav-items">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" href="#">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="#">Contact</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            ENG
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="#">LAT</a></li>
            <li><a class="dropdown-item" href="#">SWE</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>