<nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top shadow">
    <div class="container-fluid mx-4">
        <a class="navbar-brand" href="/home"><img class="imgw200px" src="{{asset('bagus/images/logo.png')}}"  alt="" srcset=""></a>
        
        @if($judul == 'Situs Penyedia Jasa Informasi Magang Terpercaya dan Terlengkap di Kabupaten Banyuwangi')
        <form action="/home" method="GET" id="search" class="d-flex align-items-center col-md-9 px-0">
            <input class="form-control me-2" name="hasil_cari" type="search" placeholder="{{$mencari}}" aria-label="Search">
            <button class="btn bg-light" type="submit"><i class="bi bi-search"></i></button>
            
        </form>
        @elseif($judul == 'Notifikasi')
        <form action="{{route('notifikasi.index')}}" method="GET" id="search" class="d-flex align-items-center col-md-9 px-0">
            <input class="form-control me-2" name="hasil_cari" type="search" placeholder="{{$mencari}}" aria-label="Search">
            <button class="btn bg-light" type="submit"><i class="bi bi-search"></i></button>
            
        </form>
        @elseif($judul == 'Status Lowongan')
        <form action="{{route('lamaran.index')}}" method="GET" id="search" class="d-flex align-items-center col-md-9 px-0">
            <input class="form-control me-2" name="hasil_cari" type="search" placeholder="{{$mencari}}" aria-label="Search">
            <button class="btn bg-light" type="submit"><i class="bi bi-search"></i></button>
            
        </form>
        @endif
       
        <div class="collapse navbar-collapse flexcolum flexwrapp aligncontentend" id="navbarSupportedContent">
            <ul class="navbar-nav align-items-center">
                <div class="btn-group">
                    <button class="bg-transparent border-0 text-decoration-none" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-bell text-white icon-i"></i>
                        @if(count($notifikasi) > 0)
                        <span class="position-absolute translate-middle badge rounded-pill bg-danger">
                            {{$nomor}}
                        </span>
                        @endif
                    </button>
                    <ul class="collapse dropdown-menu dropdown-menu-end">
                        <li><p class="dropdown-item ft16 fw-bold">Notifikasi</p></li>
                        
                        @if(count($notifikasi) > 0)
                            @foreach($notifikasi as $notif)
                            <li><p class="dropdown-item small">{{$notif->description}}</p></li>
                            @endforeach
                            <li><p class="dropdown-item d-flex justify-content-center"><a href="{{route('notifikasi.index')}}" class="text-decoration-none">semua notifikasi</a></p></li>
                        @else
                        <li><p class="dropdown-item small">belum ada notifikasi</p></li>
                        @endif

                    </ul>
                </div>
                <div class="btn-group">

                    @if($userid->profil->ubah_foto == null)
                    <button class="bg-transparent border-0 text-decoration-none" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{ asset('eki/images/user.png') }}" class="rounded-circle border border-2" style="width: 40px;" alt="" srcset="">
                    </button>
                    @else
                    <button class="bg-transparent border-0 text-decoration-none" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="/images/{{$userid->profil->ubah_foto}}" class="rounded-circle border border-2 mw-25" style="width: 40px; height:40px;" alt="" srcset="">
                    </button>
                    @endif
                    
                    <ul class="collapse dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="{{route('profil.index')}}"><i class="bi bi-person-fill"></i> Akun</a></li>
                        <li><a class="dropdown-item" href="{{route('lamaran.index')}}"><i class="bi bi-check-square-fill"></i> Status</a></li>
                        <li><a class="dropdown-item" href="{{route('email.index')}}"><i class="bi bi-gear-fill"></i> Pengaturan</a></li>
                        <li><a  class="dropdown-item" href="{{ route('logout')}}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="bi bi-power"></i> Keluar</a></li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </ul>
                </div>
            </ul>
        </div>
    </div>
</nav>