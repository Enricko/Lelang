<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{ asset('admin-lte') }}/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ Auth::user()->image == null ? asset('image/defultProfile.jpeg') : asset("profile/").Auth::user()->level.'/'.Auth::user()->image }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->name }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item">
                <a href="/admin" class="nav-link {{ $sidebar == 'dashboard' ? 'active' : '' }}">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li class="nav-header">USERS</li>
            <li class="nav-item menu-open">
                <a href="#" class="nav-link {{ $sidebar == 'user_masyarakat' ? 'active' : ($sidebar == 'user_petugas' ? 'active' : '') }}">
                  <i class="nav-icon fas fa-users"></i>
                  <p>
                    User
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="/admin/user" class="nav-link {{ $sidebar == 'user_masyarakat' ? 'active' : '' }}">
                            <i class="nav-icon fas fa-user"></i>
                            <p>User Masyarakat</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/admin/user_petugas" class="nav-link {{ $sidebar == 'user_petugas' ? 'active' : '' }}">
                            <i class="nav-icon fas fa-user-tie"></i>
                            <p>User Petugas</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-header">LELANG</li>
            <li class="nav-item menu-open">
                <a href="#" class="nav-link {{ $sidebar == 'lelang_dibuka' ? 'active' : ($sidebar == 'lelang_ditutup' ? 'active' : '') }}">
                  <i class="nav-icon fas fa-university"></i>
                  <p>
                    Lelang
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="/admin/lelang_dibuka" class="nav-link {{ $sidebar == 'lelang_dibuka' ? 'active' : '' }}">
                            <i class="nav-icon fas fa-university"></i>
                            <p>Lelang Dibuka</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/admin/lelang_ditutup" class="nav-link {{ $sidebar == 'lelang_ditutup' ? 'active' : '' }}">
                            <i class="nav-icon fas fa-university"></i>
                            <p>Lelang Ditutup</p>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
