<nav class="mobile-navbar position-fixed w-100">
  <div class="container-fluid d-flex justify-content-between">
    <div class="logo">
      <a class="navbar-brand" href="#">
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
    <div class="nav-items">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="#">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Contact</a>
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

<script>
  const menu = document.querySelector(".navbar-toggler");
  menu.addEventListener("click", () => {
    if (menu.classList.contains('open')) {
      menu.classList.remove('open');
      document.getElementById('mobile-navbar-modal').style.width = '0';
      document.querySelector('.scroller').classList.remove('backdrop');
    } else {
      menu.classList.add('open');
      document.getElementById('mobile-navbar-modal').style.width = '60%';
      document.querySelector('.scroller').classList.add('backdrop');
    }
    for (let item of menu.children) {
      item.classList.toggle("change");
    }
  });
</script>
