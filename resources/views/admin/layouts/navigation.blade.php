<nav class="main-header navbar navbar-expand navbar-dark bg-primary fixed-top shadow">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link text-white" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a class="navbar-brand" href="/home"><img class="imgw100px" src="{{asset('bagus/images/logo.png')}}"  alt="" srcset=""></a>
        
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      @if($judul == 'Data User' || $judul == 'Data Admin' || $judul == 'Data Perusahaan' || $judul == 'Biodata User' || $judul == 'Biodata Admin' || $judul == 'Biodata Perusahaan' || $judul == 'Aktivitas User' || $judul == 'Aktivitas Admin' || $judul == 'Aktivitas Perusahaan' || $judul == 'Postingan Lowongan Magang' || $judul == 'Pengunjung' || $judul == 'Sampah' || $judul == 'Notifikasi')
      <li class="nav-item">
        <a class="nav-link text-white" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          @if($judul == 'Data User')
          <form action="{{route('data_user.index')}}" method="GET" class="form-inline">
            <div class="input-group input-group-sm">
              <input name="hasil_cari" class="form-control form-control-navbar bg-white" id="keywoard" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar bg-white" type="submit">
                  <i class="fas fa-search text-dark"></i>
                </button>
                <button class="btn btn-navbar bg-white" type="button" data-widget="navbar-search">
                  <i class="fas fa-times text-dark"></i>
                </button>
              </div>
            </div>
          </form>
          @elseif($judul == 'Data Admin')
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input name="hasil_cari" class="form-control form-control-navbar bg-white" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar bg-white" type="submit">
                  <i class="fas fa-search text-dark"></i>
                </button>
                <button class="btn btn-navbar bg-white" type="button" data-widget="navbar-search">
                  <i class="fas fa-times text-dark"></i>
                </button>
              </div>
            </div>
          </form>
          @elseif($judul == 'Data Perusahaan')
          <form action="{{route('data_perusahaan.index')}}" method="GET" class="form-inline">
            <div class="input-group input-group-sm">
              <input name="hasil_cari" class="form-control form-control-navbar bg-white" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar bg-white" type="submit">
                  <i class="fas fa-search text-dark"></i>
                </button>
                <button class="btn btn-navbar bg-white" type="button" data-widget="navbar-search">
                  <i class="fas fa-times text-dark"></i>
                </button>
              </div>
            </div>
          </form>
          @elseif($judul == 'Biodata User')
          <form action="{{route('user_registrasi.index')}}" method="GET" class="form-inline">
            <div class="input-group input-group-sm">
              <input name="hasil_cari" class="form-control form-control-navbar bg-white" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar bg-white" type="submit">
                  <i class="fas fa-search text-dark"></i>
                </button>
                <button class="btn btn-navbar bg-white" type="button" data-widget="navbar-search">
                  <i class="fas fa-times text-dark"></i>
                </button>
              </div>
            </div>
          </form>
          @elseif($judul == 'Biodata Admin')
          <form action="{{route('admin_registrasi.index')}}" method="GET" class="form-inline">
            <div class="input-group input-group-sm">
              <input name="hasil_cari" class="form-control form-control-navbar bg-white" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar bg-white" type="submit">
                  <i class="fas fa-search text-dark"></i>
                </button>
                <button class="btn btn-navbar bg-white" type="button" data-widget="navbar-search">
                  <i class="fas fa-times text-dark"></i>
                </button>
              </div>
            </div>
          </form>
          @elseif($judul == 'Biodata Perusahaan')
          <form action="{{route('perusahaan_registrasi.index')}}" method="GET" class="form-inline">
            <div class="input-group input-group-sm">
              <input name="hasil_cari" class="form-control form-control-navbar bg-white" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar bg-white" type="submit">
                  <i class="fas fa-search text-dark"></i>
                </button>
                <button class="btn btn-navbar bg-white" type="button" data-widget="navbar-search">
                  <i class="fas fa-times text-dark"></i>
                </button>
              </div>
            </div>
          </form>
          @elseif($judul == 'Aktivitas User')
          <form action="{{route('aktivitas_user.index')}}" method="GET" class="form-inline">
            <div class="input-group input-group-sm">
              <input name="hasil_cari" class="form-control form-control-navbar bg-white" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar bg-white" type="submit">
                  <i class="fas fa-search text-dark"></i>
                </button>
                <button class="btn btn-navbar bg-white" type="button" data-widget="navbar-search">
                  <i class="fas fa-times text-dark"></i>
                </button>
              </div>
            </div>
          </form>
          @elseif($judul == 'Aktivitas Admin')
          <form action="{{route('aktivitas_admin.index')}}" method="GET" class="form-inline">
            <div class="input-group input-group-sm">
              <input name="hasil_cari" class="form-control form-control-navbar bg-white" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar bg-white" type="submit">
                  <i class="fas fa-search text-dark"></i>
                </button>
                <button class="btn btn-navbar bg-white" type="button" data-widget="navbar-search">
                  <i class="fas fa-times text-dark"></i>
                </button>
              </div>
            </div>
          </form>
          @elseif($judul == 'Aktivitas Perusahaan')
          <form action="{{route('aktivitas_perusahaan.index')}}" method="GET" class="form-inline">
            <div class="input-group input-group-sm">
              <input name="hasil_cari" class="form-control form-control-navbar bg-white" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar bg-white" type="submit">
                  <i class="fas fa-search text-dark"></i>
                </button>
                <button class="btn btn-navbar bg-white" type="button" data-widget="navbar-search">
                  <i class="fas fa-times text-dark"></i>
                </button>
              </div>
            </div>
          </form>
          @elseif($judul == 'Postingan Lowongan Magang')
          <form action="{{route('lowongan.index')}}" method="GET" class="form-inline">
            <div class="input-group input-group-sm">
              <input name="hasil_cari" class="form-control form-control-navbar bg-white" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar bg-white" type="submit">
                  <i class="fas fa-search text-dark"></i>
                </button>
                <button class="btn btn-navbar bg-white" type="button" data-widget="navbar-search">
                  <i class="fas fa-times text-dark"></i>
                </button>
              </div>
            </div>
          </form>
          @elseif($judul == 'Pengunjung')
          <form action="{{route('pengunjung.index')}}" method="GET" class="form-inline">
            <div class="input-group input-group-sm">
              <input name="hasil_cari" class="form-control form-control-navbar bg-white" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar bg-white" type="submit">
                  <i class="fas fa-search text-dark"></i>
                </button>
                <button class="btn btn-navbar bg-white" type="button" data-widget="navbar-search">
                  <i class="fas fa-times text-dark"></i>
                </button>
              </div>
            </div>
          </form>
          @elseif($judul == 'Sampah')
          <form action="{{route('trash.index')}}" method="GET" class="form-inline">
            <div class="input-group input-group-sm">
              <input name="hasil_cari" class="form-control form-control-navbar bg-white" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar bg-white" type="submit">
                  <i class="fas fa-search text-dark"></i>
                </button>
                <button class="btn btn-navbar bg-white" type="button" data-widget="navbar-search">
                  <i class="fas fa-times text-dark"></i>
                </button>
              </div>
            </div>
          </form>
          @elseif($judul == 'Notifikasi')
          <form action="{{route('notifikasi.index')}}" method="GET" class="form-inline">
            <div class="input-group input-group-sm">
              <input name="hasil_cari" class="form-control form-control-navbar bg-white" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar bg-white" type="submit">
                  <i class="fas fa-search text-dark"></i>
                </button>
                <button class="btn btn-navbar bg-white" type="button" data-widget="navbar-search">
                  <i class="fas fa-times text-dark"></i>
                </button>
              </div>
            </div>
          </form>
          @endif
        </div>
      </li>
      @endif
      <li class="nav-item dropdown" style="right: 10px;">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell text-white"></i>
          @if(count($notifikasi) > 0)
          {{-- <span class="position-absolute translate-middle badge rounded-pill bg-danger">
            {{$nomor}}
          </span> --}}
          <span class="position-absolute translate-middle badge rounded-pill badge-danger navbar-badge">{{$nomor}}</span>
          @endif
        </a>
        <div class="collapse dropdown-menu dropdown-menu-end">
          <span class="dropdown-item ft16 fw-bold">Notifikasi</span>
          <div class="dropdown-divider"></div>
          @if(count($notifikasi) > 0)
            @foreach($notifikasi as $notif)
            <p class="dropdown-item">
              {{$notif->description}}
            </p>
            @endforeach
            <div class="dropdown-divider"></div>
            <a href="{{route('notifikasi.index')}}" class="dropdown-item dropdown-footer">Semua Notifikasi</a>
          @else
          <p class="dropdown-item">
            Belum ada notifikasi
          </p>
          @endif
        </div>
      </li>

      
    </ul>
    
</nav>

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    @if(Auth::user()->role == 'super admin')
    <p class="brand-link">
      <img src="{{asset('bagus/images/title.png')}}" alt="AdminLTE Logo" class="brand-image elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">{{$useradmin->name}}</span>
    </p>
    @else
    <a href="{{route('profil.index')}}" class="brand-link">
      @if($useradmin->admin->nama_lengkap == null)
      <img src="{{asset('eki/images/user.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">{{$useradmin->name}}</span>
      @else
      <img src="{{asset ('imagesadmin/'.$useradmin->admin->ubah_foto)}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8; width:40px; height:40px">
      <span class="brand-text font-weight-light">{{$useradmin->admin->nama_lengkap}}</span>
      @endif
    </a>
    @endif

    <!-- Sidebar -->
    <div class="sidebar">

      <!-- Sidebar Menu -->
      <nav>
        <ul class="d-flex nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
              with font-awesome or any other icon font library -->
          <li class="nav-item">
            @if($judul == 'Dashboard')
            <a href="" class=" disabled nav-link active disabled">
            @else
            <a href="/home" class="nav-link">
            @endif
              <i class="nav-icon bi bi-house-fill"></i>
              <p>Beranda</p>
            </a>
          </li>
          @if($judul == 'Dashboard User' || $judul == 'Dashboard Admin' || $judul == 'Dashboard Perusahaan' || $judul == 'Data User' || $judul == 'Data Admin' || $judul == 'Data Perusahaan' || $judul == 'Membuat akun user' || $judul == 'Membuat akun admin' || $judul == 'Aktivitas User' || $judul == 'Aktivitas Admin' || $judul == 'Aktivitas Perusahaan' || $judul == 'Biodata User' || $judul == 'Biodata Admin' || $judul == 'Biodata Perusahaan' || $judul == 'Postingan Lowongan Magang' || $judul == 'Pengunjung')
          <li class="nav-item menu-open">
          @else
          <li class="nav-item">
          @endif
            @if($judul == 'Dashboard User' || $judul == 'Dashboard Admin' || $judul == 'Dashboard Perusahaan' || $judul == 'Data User' || $judul == 'Data Admin' || $judul == 'Data Perusahaan' || $judul == 'Membuat akun user' || $judul == 'Membuat akun admin' || $judul == 'Aktivitas User' || $judul == 'Aktivitas Admin' || $judul == 'Aktivitas Perusahaan' || $judul == 'Biodata User' || $judul == 'Biodata Admin' || $judul == 'Biodata Perusahaan' || $judul == 'Postingan Lowongan Magang' || $judul == 'Pengunjung')
            <a href="" class="nav-link active disabled">
              <i class="nav-icon bi bi-speedometer2"></i>
              <p>
                Dashboard
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            @else
            <a href="#" class="nav-link">
              <i class="nav-icon bi bi-speedometer2"></i>
              <p>
                Dashboard
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            @endif
            <ul class="nav nav-treeview">
              @if($judul == 'Dashboard User' || $judul == 'Membuat akun user')
              <li class="nav-item">
                <a href="" class="nav-link active disabled">
                  <i class="bi bi-person-fill"></i>
                  <p>
                    User
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
              </li>
              @else
              @if($judul == 'Data User' || $judul == 'Data User' || $judul == 'Aktivitas User' || $judul == 'Biodata User')
              <li class="nav-item menu-open">
                <a href="" class="nav-link active disabled">
              @else
              <li class="nav-item">
                <a href="" class="nav-link">
              @endif
                  <i class="bi bi-person-fill"></i>
                  <p>
                    User
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    @if($judul == 'Data User')
                    <a href="" class="disabled nav-link active bg-info disabled">
                    @else
                    <a href="{{route('data_user.index')}}" class="nav-link">
                    @endif
                      <i class="bi bi-person-plus-fill"></i>
                      <p>Data User</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    @if($judul == 'Biodata User')
                    <a href="" class="disabled nav-link active bg-info disabled">
                    @else
                    <a href="{{route('user_registrasi.index')}}" class="nav-link">
                    @endif
                      <i class="far fa-id-card"></i>
                      <p>Biodata</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    @if($judul == 'Aktivitas User')
                    <a href="" class="disabled nav-link active bg-info disabled">
                    @else
                    <a href="{{route('aktivitas_user.index')}}" class="nav-link">
                    @endif
                      <i class="fas fa-project-diagram"></i>
                      <p>Aktivitas</p>
                    </a>
                  </li>
                </ul>
              </li>
              @endif
              @if($judul == 'Dashboard Admin' || $judul == 'Membuat akun admin')
              <li class="nav-item">
                <a href="" class="nav-link active disabled">
                  <i class="fas fa-user-tie"></i>
                  <p>
                    Admin
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="" class="nav-link">
                      <i class="far fa-id-card"></i>
                      <p>Biodata</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="" class="nav-link">
                      <i class="fas fa-project-diagram"></i>
                      <p>Aktivitas</p>
                    </a>
                  </li>
                </ul>
              </li>
              @elseif($userrole == 'super admin')
              @if($judul == 'Data Admin' || $judul == 'Aktivitas Admin' || $judul == 'Biodata Admin')
              <li class="nav-item menu-open">
                <a href="" class="nav-link active disabled">
              @else
              <li class="nav-item">
                <a href="" class="nav-link">
              @endif
                  <i class="fas fa-user-tie"></i>
                  <p> 
                    Admin
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    @if($judul == 'Data Admin')
                    <a href="" class="disabled nav-link active bg-info disabled">
                    @else
                    <a href="{{route('data_admin.index')}}" class="nav-link">
                    @endif
                      <i class="bi bi-person-plus-fill"></i>
                      <p>Data Admin</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    @if($judul == 'Biodata Admin')
                    <a href="" class="disabled nav-link active bg-info disabled">
                    @else
                    <a href="{{route('admin_registrasi.index')}}" class="nav-link">
                    @endif
                      <i class="far fa-id-card"></i>
                      <p>Biodata</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    @if($judul == 'Aktivitas Admin')
                    <a href="" class="disabled nav-link active bg-info disabled">
                    @else
                    <a href="{{route('aktivitas_admin.index')}}" class="nav-link">
                    @endif
                      <i class="fas fa-project-diagram"></i>
                      <p>Aktivitas</p>
                    </a>
                  </li>
                </ul>
              </li>
              @endif
              @if($judul == 'Dashboard Perusahaan')
              <li class="nav-item">
                <a href="" class="nav-link active">
                  <i class="bi bi-building"></i>
                  <p>
                    Perusahaan
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
              </li>
              @else
              @if($judul == 'Data Perusahaan' || $judul == 'Aktivitas Perusahaan' || $judul == 'Biodata Perusahaan' || $judul == 'Postingan Lowongan Magang')
              <li class="nav-item menu-open">
                <a href="" class="nav-link active disabled">
              @else
              <li class="nav-item">
                <a href="" class="nav-link">
              @endif
                  <i class="bi bi-building"></i>
                  <p>
                    Perusahaan
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    @if($judul == 'Data Perusahaan')
                    <a href="" class="disabled nav-link active bg-info disabled">
                    @else
                    <a href="{{route('data_perusahaan.index')}}" class="nav-link">
                    @endif
                      <i class="bi bi-person-plus-fill"></i>
                      <p>Data Perusahaan</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    @if($judul == 'Biodata Perusahaan')
                    <a href="" class="disabled nav-link active bg-info disabled">
                    @else
                    <a href="{{route('perusahaan_registrasi.index')}}" class="nav-link">
                    @endif
                      <i class="far fa-id-card"></i>
                      <p>Biodata</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    @if($judul == 'Aktivitas Perusahaan')
                    <a href="" class="disabled nav-link active bg-info disabled">
                    @else
                    <a href="{{route('aktivitas_perusahaan.index')}}" class="nav-link">
                    @endif
                      <i class="fas fa-project-diagram"></i>
                      <p>Aktivitas</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    @if($judul == 'Postingan Lowongan Magang')
                    <a href="" class="disabled nav-link active bg-info disabled">
                    @else
                    <a href="{{route('lowongan.index')}}" class="nav-link">
                    @endif
                      <i class="bi bi-layout-text-window"></i>
                      <p>Lowongan</p>
                    </a>
                  </li>
                </ul>
              </li>
              @endif
              @if($judul == 'Pengunjung')
              <li class="nav-item">
                <a href="" class="disabled nav-link active disabled">
              @else
              <li class="nav-item">
                <a href="{{route('pengunjung.index')}}" class="nav-link">
              @endif
                  <i class="bi bi-people-fill"></i>
                  <p> Pengunjung</p>
                </a>
              </li>
            </ul>
          </li>
        @if(Auth::user()->role == 'super admin')
          <li class="nav-item mt-auto user-panel">
        @else
        <li class="nav-item mt-auto">
        @endif
            @if($judul == 'Sampah')
            <a href="" class="disabled nav-link active">
            @else
            <a href="{{route('trash.index')}}" class="nav-link">
            @endif
              <i class="bi bi-trash-fill"></i>
              <p>Sampah</p>
            </a>
          </li>
        @if(Auth::user()->role != 'super admin')  
          @if($judul == 'Pengaturan')
          <li class="nav-item menu-open mt-auto user-panel">
            <a href="#" class="nav-link active disabled">
          @else
          <li class="nav-item mt-auto user-panel">
            <a href="#" class="nav-link">
          @endif
              <i class="nav-icon bi bi-gear-fill"></i>
              <p>
                Pengaturan
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                @if($pagename == 'Email')
                <a href="{{route('email.edit', $useradmin)}}" class="nav-link active disabled">
                @else
                <a href="{{route('email.edit', $useradmin)}}" class="nav-link">
                @endif
                  <i class="bi bi-envelope-fill nav-icon"></i>
                  <p>Email</p>
                </a>
              </li>
              <li class="nav-item">
                @if($pagename == 'Password')
                <a href="{{route('kata_sandi.edit', $useradmin)}}" class="nav-link active disabled">
                @else
                <a href="{{route('kata_sandi.edit', $useradmin)}}" class="nav-link">
                @endif
                  <i class="bi bi-lock-fill nav-icon"></i>
                  <p>Kata Sandi</p>
                </a>
              </li>
            </ul>
          </li>
        @endif 
          <li class="nav-item mt-auto">
            <a  class="nav-link" href="{{ route('logout')}}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="bi bi-power nav-icon"></i>
              <p>Keluar</p>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>