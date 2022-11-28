<nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top shadow">
    <div class="container-fluid mx-4">
        <a class="navbar-brand" href="/home"><img class="imgw200px" src="{{asset('bagus/images/logo.png')}}"  alt="" srcset=""></a>
        <form class="d-flex align-items-center col-md-9 px-0">
            <input class="form-control me-2" type="search" placeholder="Mencari Lowowngan Kerja Kantor" aria-label="Search">
            <button class="btn bg-light" type="submit"><i class="bi bi-search"></i></button>
        </form>
        <div class="collapse navbar-collapse flexcolum flexwrapp aligncontentend" id="navbarSupportedContent">
            <ul class="navbar-nav align-items-center">
                <div class="btn-group">
                    <button class="bg-transparent border-0 text-decoration-none" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-bell text-white icon-i"></i>
                    </button>
                    <ul class="collapse dropdown-menu dropdown-menu-end">
                        <li><p class="dropdown-item ft16 fw-bold">Notifikasi</p></li>
                        <!-- menambahkan foreach -->
                        <li><p class="dropdown-item small">membuat postingan baru asjkdakdkj</p></li>
                        <li><p class="dropdown-item small">mengubah postingan lama</p></li>
                        <li><p class="dropdown-item small">menghapus postingan baru</p></li>
                        <li><p class="dropdown-item d-flex justify-content-center"><a href="home/notifikasi" class="text-decoration-none">semua notifikasi</a></p></li>
                        <!-- endforeach -->
                    </ul>
                </div>
                <div class="btn-group">
                    <button class="bg-transparent border-0 text-decoration-none" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{ asset('eki/images/company.jpg') }}" class="rounded-circle border border-2" style="width: 40px;" alt="" srcset="">
                    </button>
                    
                    <ul class="collapse dropdown-menu dropdown-menu-end">
                        <!-- <li><a class="dropdown-item disabled" href="#profil"><img id="profil" class="rounded-circle border border-2" style="width: 40px;" src="{{ asset('eki/images/company.jpg') }}"  alt="" srcset=""></a></li> -->
                        <li><a class="dropdown-item" href="{{route('profil.index')}}"><i class="bi bi-person-fill"></i> Akun</a></li>
                        <li><a class="dropdown-item" href="/home/status/lamaran"><i class="bi bi-check-square-fill"></i> Status</a></li>
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