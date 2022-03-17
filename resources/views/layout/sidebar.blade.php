    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ url('dashboard') }}" class="nav-link">Dashboard</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ url('masuk') }}" class="nav-link">Kotak Masuk</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ url('keluar') }}" class="nav-link">Kotak Keluar</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ url('pin') }}" class="nav-link" onclick="cekPin()">PIN</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link" onclick="logout()">Logout</a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{ asset('dist/img/logo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">SI-Surat</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">
          <a id="menuName"></a>
        </div>
      </div>
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="{{ url('dashboard') }}" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('masuk') }}" class="nav-link">
              <i class="nav-icon far fa-envelope"></i>
              <p>
                Kotak Masuk
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('keluar') }}" class="nav-link">
              <i class="nav-icon far fa-envelope-open"></i>
              <p>
                Kotak Keluar
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#pin" class="nav-link" onclick="cekPin()">
              <i class="nav-icon fas fa-key"></i>
              <p>
                PIN
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" id="logout" class="nav-link" onclick="logout()">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
                Logout
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>  