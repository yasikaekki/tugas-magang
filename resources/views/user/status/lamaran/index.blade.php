<!doctype html>
<html lang="en">
    <head>
        @include('user.layouts.top')
    </head>
    <body class="bg-light">
        @include('user.layouts.navigation')
        <section class="p-5">
            <div class="container p-5">
                <div class="row d-flex justify-content-center">
                    <div class="mb-3">
                        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="/" class="text-decoration-none">Beranda</a></li>
                              <li class="breadcrumb-item"><a href="/home" class="text-decoration-none">Lowongan</a></li>
                              <li class="breadcrumb-item active" aria-current="page">Status</li>
                            </ol>
                        </nav>
                    </div>
                    @if($keywoard != null)
                    <p class="ft16">Hasil penelusuran <b>{{$keywoard}}</b></p>
                    @endif

                    <div class="col-lg-12">
                        @if($fitur_cari->count() == 0 && $keywoard != null)
                        <div class="alert alert-danger mb-1 text-center" role="alert">
                            Maaf hasil cari <b>"{{$keywoard}}"</b> tidak ditemukan <i class="bi bi-emoji-frown"></i>
                        </div>
                        @endif
                        <div class="card">
                            <div class="nav card-header p-0 border-bottom-0">
                                <div class="col-md-6 bg-white rounded-top">
                                    <a class="text18 p-4 nav-link active disabled">Lamaran Magang Anda</a>
                                </div>
                                <div class="card-header col-md-6 p-0">
                                    <!-- <a class="text18 nav-link text-decoration-none" href="/home/status/favorite">Lowongan Magang Favorite Anda</a>                                    -->
                                    <a class="text18 nav-link text-decoration-none p-4" href="{{route('favorite.index')}}">Lowongan Magang Favorite Anda</a>                                   
                                </div>
                            </div>

                            @if($data->count() == 0)
                            <div class="card-body p-5">
                                <div class="text-center text-warning mb-4">
                                    <i class="bi bi-emoji-frown display-1"></i>
                
                                </div>
                                <p class="small text-center">Mohon maaf<br>Sepertinya anda belum melamar magang <br> dari perusahaan manapun</p>
                            </div>
                            @else
                            <div class="card-body p-4 pt-0">
                                <div class="row mb-4">
                                    <div class="d-grid d-md-flex justify-content-md-end">
                                        
                                        <!-- <select class="col-md-2 me-2 ms-5" name="filter" id="filter">
                                            <option value="1">Lamaran ditolak</option>
                                            <option value="2">Lamaran diproses</option>
                                            <option value="2">Lamaran diterima</option>
                                        </select>
                                        <button class="btn btn-primary col-md-1" id="submit-filter">Filter</button> -->
                                    </div>
                                </div>
                                @if($fitur_cari->count() == 0)
                                
                                <div class="row">
                                    @foreach($data as $lamarans)
                                    <div class="col-md-4">
                                        
                                        <div class="shadow p-3 mb-5 bg-body rounded" style="width: 20rem;">
                                            <div class="card-body">
                                                <h5 class="card-title text18"><strong>{{$lamarans->nama_lowongan}}</strong></h5>
                                                <h6 class="card-subtitle medium mb-3">{{$lamarans->post->bidang_pekerjaan->bidang_pekerjaan}}</h6>
                                                <p class="text14">Lamaran ditutup {{$lamarans->waktu_berakhir}} <br> Telah dilamar pada 1 hari yang lalu</p>        
                                                @if($lamarans->status_lamaran == 'diterima')
                                                <span class="badge bg-success mb-3">{{$lamarans->status_lamaran}}</span>
                                                @elseif($lamarans->status_lamaran == 'diproses')
                                                <span class="badge bg-primary mb-3">{{$lamarans->status_lamaran}}</span>
                                                @else
                                                <span class="badge bg-danger mb-3">{{$lamarans->status_lamaran}}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                @else
                                <div class="row">
                                    @foreach($fitur_cari as $lamarans)
                                    <div class="col-md-4">
                                        
                                        <div class="shadow p-3 mb-5 bg-body rounded" style="width: 20rem;">
                                            <div class="card-body">
                                                <h5 class="card-title text18"><strong>{{$lamarans->nama_lowongan}}</strong></h5>
                                                <h6 class="card-subtitle medium mb-3">Pt...</h6>
                                                <p class="text14">Lamaran ditutup {{$lamarans->waktu_berakhir}} <br> Telah dilamar pada 1 hari yang lalu</p>        
                                                @if($lamarans->status_lamaran == 'diterima')
                                                <span class="badge bg-success mb-3">{{$lamarans->status_lamaran}}</span>
                                                @elseif($lamarans->status_lamaran == 'diproses')
                                                <span class="badge bg-primary mb-3">{{$lamarans->status_lamaran}}</span>
                                                @else
                                                <span class="badge bg-danger mb-3">{{$lamarans->status_lamaran}}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                @endif
                            </div>
                            @endif
                        </div>
                        {{$fitur_cari->links('layouts.pagination')}}
                    </div>
                </div>
            </div>
        </section>
        
        @include('user.layouts.footer')
        @include('user.layouts.bottom')
    </body>
</html>