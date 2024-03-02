<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
      <a class="sidebar-brand brand-logo" href="{{ route('snmp.get_snmp_with_map') }}"><img src="{{asset('/assets/images/logo.png')}}" alt="logo" /></a>
      <a class="sidebar-brand brand-logo-mini" href="{{ route('snmp.get_snmp_with_map') }}"><img src="{{asset('/assets/images/logo-mini.png')}}" alt="logo" /></a>
    </div>
    <ul class="nav">
        <li class="nav-item menu-items">
            <a class="nav-link" href="{{ route('snmp.get_snmp_with_map') }}">
                <span class="menu-icon icon-box-danger">
                <i class="mdi mdi-speedometer"></i>
                </span>
                <span class="menu-title"> Dashboard</span>
            </a>
        </li>
      <li class="nav-item menu-items">
        <a class="nav-link" href="{{ route('location.index') }}">
          <span class="menu-icon icon-box-danger">
            <i class="mdi mdi-map-marker"></i>
          </span>
          <span class="menu-title">Locations</span>
        </a>
      </li>
      <li class="nav-item menu-items ">
        <a class="nav-link" data-bs-toggle="collapse" href="#showm_anagement" aria-expanded="false" aria-controls="icons">
          <span class="menu-icon icon-box-playlistbuilder">
            <i class="mdi mdi-contacts"></i>
          </span>
          <span class="menu-title">Content Management</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse " id="showm_anagement">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link active_playlistbuilder " href="{{ route('spls.get_spl_with_filter') }}"> <i class="mdi mdi-checkbox-blank-circle me-1"></i> Playlists</a></li>
            <li class="nav-item"> <a class="nav-link active_playlistbuilder " href="{{ route('cpls.get_cpl_with_filter') }}"> <i class="mdi mdi-checkbox-blank-circle me-1"></i> CPLS</a></li>
            <li class="nav-item"> <a class="nav-link active_playlistbuilder " href="{{ route('kdms.get_Kdm_with_filter') }}"> <i class="mdi mdi-checkbox-blank-circle  me-1"></i> KDMs</a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item menu-items">
        <a class="nav-link" href="{{ route('schedules.get_schedules_with_filter') }}">
          <span class="menu-icon icon-box-blue">
            <i class="mdi mdi-calendar-today "></i>
          </span>
          <span class="menu-title">Schedule Management</span>
        </a>
      </li>
      <li class="nav-item menu-items">
        <a class="nav-link" href="{{ route('snmp.get_snmp_with_filter') }}">
          <span class="menu-icon icon-box-danger">
            <i class="mdi mdi-alert-octagon "></i>
          </span>
          <span class="menu-title">SNMP Errors</span>
        </a>
      </li>


      <li class="nav-item menu-items">
        <a class="nav-link" href="{{ route('playback.index') }}">
          <span class="menu-icon icon-box-warning">
            <i class="mdi mdi-calendar-today "></i>
          </span>
          <span class="menu-title">Playback</span>
        </a>
      </li>

      <li class="nav-item menu-items">
        <a class="nav-link" href="{{ route('spls.spl_builder') }}">
          <span class="menu-icon icon-box-danger">
            <i class="mdi mdi-calendar-today "></i>
          </span>
          <span class="menu-title">Playlist Builder</span>
        </a>
      </li>

      <li class="nav-item menu-items">
        <a class="nav-link" href="{{ route('spls.upload_spl') }}">
          <span class="menu-icon icon-box-success">
            <i class="mdi mdi-upload "></i>
          </span>
          <span class="menu-title">Upload </span>
        </a>
      </li>

      <li class="nav-item menu-items">
        <a class="nav-link" href="{{ route('logs.get_performance_log') }}">
          <span class="menu-icon icon-box-performance">
            <i class="mdi mdi-bookmark-check "></i>
          </span>
          <span class="menu-title">Performance Logs</span>
        </a>
      </li>
      @if (Auth::user()->role == 1 )
      <li class="nav-item menu-items">
        <a class="nav-link" href="{{ route('users.index') }}">
          <span class="menu-icon icon-user-performance">
            <i class="mdi mdi-account-multiple-outline"></i>
          </span>
          <span class="menu-title">Users Management </span>
        </a>
      </li>
      @endif
      <li>
        <br />
        <br /><br /><br /><br /><br /> <br /><br /><br /><br /><br />
      </li>
    </ul>
  </nav>
