<nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top shadow">
    <div class="container-fluid mx-4">
        <a class="navbar-brand" href="/dashboard"><img class="imgw200px" src="{{asset('bagus/images/logo.png')}}"  alt="" srcset=""></a>
        
        @if($judul == "Situs Penyedia Jasa Informasi Magang Terpercaya dan Terlengkap di Kabupaten Banyuwangi")
        
        @auth
        <form action="/home" method="GET" id="search" class="d-flex align-items-center col-md-9 px-0">
            
            <input class="form-control me-2" name="hasil_cari" type="search" placeholder="{{$mencari}}" aria-label="Search">
            <button class="btn bg-light" type="submit"><i class="bi bi-search"></i></button>

        </form>
        @else
        <form action="{{route('dashboard.index')}}" method="GET" id="search" class="d-flex align-items-center col-md-8 px-0">
            
            <input class="form-control me-2" name="hasil_cari" type="search" placeholder="{{$mencari}}" aria-label="Search">
            <button class="btn bg-light" type="submit"><i class="bi bi-search"></i></button>

        </form>
        @endif 
        
        @endif
        <div class="collapse navbar-collapse flexcolum flexwrapp aligncontentend" id="navbarSupportedContent">
            <ul class="navbar-nav align-items-center">
            @if (Route::has('login'))
                
                <div class="text-center">
                @auth
                <a href="{{ url('/home') }}" class="text-decoration-none text-white text18">Home</a>
                    
                @else    
                    <div class="row">
                        <div class="col-md-6">
                            <a href="{{ route('login') }}" class="text-decoration-none text-white text18">Masuk</a>
                        </div>
                    @if (Route::has('register'))
                        <div class="col-md-6">
                            <a href="{{ route('register') }}" class="text-decoration-none text-white text18">Daftar</a>   
                        </div>
                    @endif
                    </div>
                @endauth
                </div>
            @endif
            </ul>
        </div>
    </div>
</nav>

