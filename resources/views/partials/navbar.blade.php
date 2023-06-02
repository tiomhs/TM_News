<nav class="sb-topnav navbar navbar-expand navbar-dark bg-primary">
  <!-- Navbar Brand-->
  <div class="container">
    <a class="navbar-brand ps-3" href="/homepage">TM News</a>
    <!-- Navbar Search-->
    <form action="{{ route('search') }}" class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
        <div class="input-group">
            <input class="form-control" type="text" placeholder="Search for..." name="search" aria-label="Search for..." aria-describedby="btnNavbarSearch" />
            <button type="submit" name="submit" class="btn btn-success" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
        </div>
    </form>
    <!-- Navbar-->
    @if (!Auth::guest())
    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}" alt="" class="rounded-circle w-50"></a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
              @if (Auth::user()->is_admin == true)
                <li>
                  <a class="dropdown-item" href="/admin">Admin</a>
                </li>
              @endif
              <li>
                <a class="dropdown-item" href="/homepage">Dashboard</a>
              </li>
              <li><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                  {{ __('Logout') }}
              </a></li>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
              </form>
            </ul>
        </li>
    </ul>
    @else
      <div class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
        <a class="dropdown-item btn btn-success text-white fw-bold p-2" href="{{ route('login') }}">Login<i class="fa fa-sign-in ms-1" aria-hidden="true"></i></a>
      </div>
    @endif
  </div>
</nav>

<div class="section d-sm-none" id="search">
  <div class="row justify-content-center">
    <div class="col-8">
      <form action="{{ route('search') }}" class="d-sm-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
        <div class="input-group">
            <input class="form-control" type="text" placeholder="Search for..." name="search" aria-label="Search for..." aria-describedby="btnNavbarSearch" />
            <button type="submit" name="submit" class="btn btn-danger" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
        </div>
      </form>
    </div>
  </div>
</div>
