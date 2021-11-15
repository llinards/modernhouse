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

  function closeMenu() {
    menu.classList.remove('open');
    document.getElementById('mobile-navbar-modal').style.width = '0';
    document.querySelector('.home').classList.remove('backdrop');
    document.querySelector('.home').style.overflowY = 'scroll';
  }

  function openMenu() {
    menu.classList.add('open');
    document.getElementById('mobile-navbar-modal').style.width = '60%';
    document.querySelector('.home').classList.add('backdrop');
    document.querySelector('.home').style.overflowY = 'hidden';
  }

  menu.addEventListener("click", () => {
    if (menu.classList.contains('open')) {
      closeMenu();
    } else {
      openMenu();
      document.querySelector('.home.backdrop').addEventListener('click', () => {
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
