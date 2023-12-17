<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
      <a class="sidebar-brand brand-logo" href="index.html"><img src="images/logo.png" alt="logo" /></a>
      <a class="sidebar-brand brand-logo-mini" href="index.html"><img src="images/logo-mini.png" alt="logo" /></a>
    </div>
    <ul class="nav">

      <li class="nav-item menu-items">
        <a class="nav-link" href="{{ route('location.index') }}">
          <span class="menu-icon">
            <i class="mdi mdi-speedometer"></i>
          </span>
          <span class="menu-title">Locations</span>
        </a>
      </li>
      <li class="nav-item menu-items ">
        <a class="nav-link" data-bs-toggle="collapse" href="#showm_anagement" aria-expanded="false" aria-controls="icons">
          <span class="menu-icon">
            <i class="mdi mdi-contacts"></i>
          </span>
          <span class="menu-title">Show Management </span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse " id="showm_anagement">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{ route('spls.get_spl_with_filter') }}">Show Playlists</a></li>
            <li class="nav-item"> <a class="nav-link " href="{{ route('cpls.get_cpl_with_filter') }}">CPLS</a></li>
          </ul>
        </div>
      </li>
    </ul>
  </nav>
