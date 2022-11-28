<!doctype html>
<html lang="en">
    <head>
        @include('layouts.top')
    </head>
    <body class="bg-light">
        @include('layouts.navigation')

        <div id="carouselExampleIndicators" class="carousel slide jarak bg-secondary" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active bg-dark" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" class="bg-dark" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" class="bg-dark" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="{{ asset('bagus/images/banner.png') }}" style="width:95%; height: 360px" class="d-block img-center" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('bagus/images/banner.png') }}" style="width:95%; height: 360px" class="d-block img-center" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('bagus/images/banner.png') }}" style="width:95%; height: 360px" class="d-block img-center" alt="...">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                <span class="carousel-control-prev-icon bg-dark" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                <span class="carousel-control-next-icon bg-dark" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-11">
                    <div class="card p-3 mb-6">
                        <div class="card-body gap-5">
                            <form action="{{route('dashboard.index')}}" method="GET" class="d-flex align-items-center col-md-12 px-0 mb-4">
                                <input class="form-control me-2" type="search" placeholder="{{$mencari}}" aria-label="Search" name="hasil_cari">
                                
                                <div class="d-grid col-2 mx-auto">
                                    <button class="btn btn-primary" type="submit"><i class="bi bi-search"></i> Cari</button>
                                </div>
                            </form>
                            <h5 class="text-center title fs-4 mb-5">Bidang Pekerjaan</h5>
                            @auth
                            <div class="row">
                                @foreach ($bidangpekerjaan as $allbidang)    
                                    <div class="col-md-3">
                                        <div class="card shadow p-2 mb-3 btn btn-outline-primary rounded">
                                            <a href="{{url('/home?hasil_cari='. $allbidang->bidang_pekerjaan)}}" class="btn btn-color" id="dashboard">{{$allbidang->bidang_pekerjaan}}</a>
                                        </div>
                                    </div>
                                @endforeach
                                    <div class="col-md-3">
                                        <div class="card shadow p-2 mb-3 btn btn-outline-primary rounded">
                                            <a href="{{url('/home?hasil_cari='. $bidangpekerjaanlainnya->bidang_pekerjaan)}}" class="btn btn-color" id="dashboard">{{$bidangpekerjaanlainnya->bidang_pekerjaan}}</a>
                                        </div>
                                    </div>
                                {{-- @foreach ($bidangpekerjaan as $allbidang)    
                                    <div class="col-md-3">
                                        <div class="card shadow p-2 mb-3 btn btn-outline-primary rounded">
                                            <a href="{{url('/home?hasil_cari=$allbidang->bidang_pekerjaan->bidang->pekerjaan')}}" class="btn btn-color" id="dashboard">{{$allbidang->bidang_pekerjaan->bidang->pekerjaan}}</a>
                                        </div>
                                    </div>
                                @endforeach --}}

                                {{-- <div class="col-md-3">
                                    <div class="card shadow p-2 mb-3 btn btn-outline-primary rounded">
                                        <a href="{{url('/home?hasil_cari=analisis+data')}}" class="btn btn-color">Analisis Data</a>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card shadow p-2 mb-3 btn btn-outline-primary rounded">
                                        <a href="{{url('/home?hasil_cari=cyber+security')}}" class="btn btn-color">Cyber Security</a>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="card shadow p-2 mb-3 btn btn-outline-primary rounded">
                                        <a href="{{url('/home?hasil_cari=lainnya')}}" class="btn btn-color">Lainnya</a>
                                    </div>
                                </div> --}}
                                
                            </div>
                            @else
                            <div class="row d-flex justify-content-center">
                                @foreach ($bidangpekerjaan as $allbidang)    
                                    <div class="col-md-3">
                                        <div class="card shadow p-2 mb-3 btn btn-outline-primary rounded">
                                            <a href="{{url('/home?hasil_cari=$allbidang->bidang_pekerjaan')}}" class="btn btn-color" id="dashboard">{{$allbidang->bidang_pekerjaan}}</a>
                                        </div>
                                    </div>
                                @endforeach
                                    <div class="col-md-3">
                                        <div class="card shadow p-2 mb-3 btn btn-outline-primary rounded">
                                            <a href="{{url('/home?hasil_cari=$bidangpekerjaanlainnya->bidang_pekerjaan')}}" class="btn btn-color" id="dashboard">{{$bidangpekerjaanlainnya->bidang_pekerjaan}}</a>
                                        </div>
                                    </div>
                                {{-- <div class="col-md-3">
                                    <div class="card shadow p-2 mb-3 btn btn-outline-primary rounded">
                                        <a href="{{url('/dashboard?hasil_cari=it+development')}}" class="btn btn-color" id="dashboard">IT Development</a>                                                     
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card shadow p-2 mb-3 btn btn-outline-primary rounded">
                                        <a href="{{url('/dashboard?hasil_cari=analisis+data')}}" class="btn btn-color">Analisis Data</a>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card shadow p-2 mb-3 btn btn-outline-primary rounded">
                                        <a href="{{url('/dashboard?hasil_cari=cyber+security')}}" class="btn btn-color">Cyber Security</a>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card shadow p-2 mb-3 btn btn-outline-primary rounded">
                                        <a href="{{url('/dashboard?hasil_cari=lainnya')}}" class="btn btn-color">Lainnya</a>
                                    </div>
                                </div> --}}
                            </div>
                            @endauth
                            
                        </div>
                    </div>

                    <h5 class="text-center title2 fs-4 mb-5">Faq</h5>
                    <div class="row d-flex justify-content-center">

                        <div class="col-md-5">
                            <div class="mb-3">
                                <div class="card btn btn-outline-primary p-2">
                                    <button class="text-start btn btn-color" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample1" aria-expanded="false" aria-controls="collapseExample">
                                        Info Magang Banyuwangi Itu Apa ? <i class="bi bi-chevron-down pull-right"></i>
                                    </button>
        
                                    
                                </div>   
                                <div class="collapse" id="collapseExample1">
                                    <div class="card card-body">
                                        Info Magang Banyuwangi adalah situs yang memungkinkan kamu mendapatkan informasi seputar lowongan magang yang berada di wilayah kabupaten banyuwangi.
                                    </div>
                                </div>                   
                            </div>
                            <div class="mb-3">
                                <div class="card btn btn-outline-primary p-2">

                                    <button class="text-start btn btn-color" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample3" aria-expanded="false" aria-controls="collapseExample">
                                        Apakah Ada Tanggungan Biaya ? <i class="bi bi-chevron-down pull-right"></i>
                                    </button>                                   
        
                                    
                                </div>   
                                <div class="collapse" id="collapseExample3">
                                    <div class="card card-body">
                                        Tidak ada pungutan biaya apapun yang digunakan untuk melamar lowongan magang.
                                    </div>
                                </div>                   
                            </div>
                            <div class="mb-3">
                                <div class="card btn btn-outline-primary p-2">
                                    <button class="text-start btn btn-color" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample5" aria-expanded="false" aria-controls="collapseExample">
                                        Bagaimana Tahapnya ? <i class="bi bi-chevron-down pull-right"></i>
                                    </button>
        
                                    
                                </div>   
                                <div class="collapse" id="collapseExample5">
                                    <div class="card card-body">
                                        Cukup daftarkan diri kamu pada situs kami, kemudian isi biodata serta upload berkas yang diperlukan dan lamar lowongan magang yang kamu inginkan.
                                    </div>
                                </div>                   
                            </div>
                            <div class="mb-3">
                                <div class="card btn btn-outline-primary p-2">
                                    <button class="text-start btn btn-color" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample7" aria-expanded="false" aria-controls="collapseExample">
                                        Apakah untuk Umum ? <i class="bi bi-chevron-down pull-right"></i>
                                    </button>
        
                                    
                                </div>   
                                <div class="collapse" id="collapseExample7">
                                    <div class="card card-body">
                                        Tidak, hanya dikhususkan bagi pelajar dan mahasiswa.
                                    </div>
                                </div>                   
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="mb-3">
                                <div class="card btn btn-outline-primary p-2">
                                    <button class="text-start btn btn-color" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample2" aria-expanded="false" aria-controls="collapseExample">
                                        Bagaimana Proses Seleksinya ? <i class="bi bi-chevron-down pull-right"></i>
                                    </button>
        
                                    
                                </div>   
                                <div class="collapse" id="collapseExample2">
                                    <div class="card card-body">
                                        Dengan mengirim berkas yang sudah ditentukan, lalu cukup tunggu info lanjut dari perusahaan.
                                    </div>
                                </div>                   
                            </div>
                            <div class="mb-3">
                                <div class="card btn btn-outline-primary p-2">
                                    <button class="text-start btn btn-color" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample4" aria-expanded="false" aria-controls="collapseExample">
                                        Apa Saja Persyaratannya ? <i class="bi bi-chevron-down pull-right"></i>
                                    </button>
        
                                    
                                </div>   
                                <div class="collapse" id="collapseExample4">
                                    <div class="card card-body">
                                        Cukup melengkapi biodata diri serta upload CV, Portfolio dan Surat Keterangan Magang.
                                    </div>
                                </div>                   
                            </div>
                            <div class="mb-3">
                                <div class="card btn btn-outline-primary p-2">
                                    <button class="text-start btn btn-color" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample6" aria-expanded="false" aria-controls="collapseExample">
                                        Cara Mendaftar ? <i class="bi bi-chevron-down pull-right"></i>
                                    </button>
        
                                    
                                </div>   
                                <div class="collapse" id="collapseExample6">
                                    <div class="card card-body">
                                        Kamu hanya perlu mendaftar di website dengan fasilitas yang sudah disediakan, bisa menggunakan akun gmail atau akun email biasa.
                                    </div>
                                </div>                   
                            </div>
                            <div class="mb-5">
                                <div class="card btn btn-outline-primary p-2">
                                    <button class="text-start btn btn-color" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample8" aria-expanded="false" aria-controls="collapseExample">
                                        Apa Bisa Kerja Saat Lolos Seleksi Magang ? <i class="bi bi-chevron-down pull-right"></i>
                                    </button>
        
                                    
                                </div>   
                                <div class="collapse" id="collapseExample8">
                                    <div class="card card-body">
                                        Tergantung dari pihak perusahaan yang anda lamar, jika pihak perusahaan tertarik maka bisa langsung kerja.
                                    </div>
                                </div>                   
                            </div>
                        </div>
                        
                    </div>

                </div>
            </div>
        </div>

        @include('layouts.footer')
        @include('layouts.bottom')
    </body>
</html>