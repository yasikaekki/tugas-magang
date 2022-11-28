<!doctype html>
<html lang="en">
    <head>
        @include('guest.layouts.toppost')
    </head>
    <body class="bg-light">
        @include('guest.layouts.navigation')
        <section class="p-5">
            <div class="container p-5">
                <div class="row d-flex justify-content-center">
                    <div class="mb-3">
                        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="/" class="text-decoration-none">Beranda</a></li>
                              <li class="breadcrumb-item"><a href="/dashboard" class="text-decoration-none">Lowongan</a></li>
                              <li class="breadcrumb-item active" aria-current="page">{{$postingan->judul_pekerjaan}}</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-lg-8">
                        @if(session()->get('sukses'))
                            <div class="alert alert-success">
                                {{session()->get('sukses')}}
                            </div>
                        @endif
                            <div class="card p-4">
                                <div class="card-body">
                                    <h3 class="mb-4"><b>{{$postingan->judul_pekerjaan}}</b></h3>
                                    <div class="d-grid d-md-block mb-3">
                                        <!-- <small>Diposting Pada Tanggal 02 Mei 2021</small> -->
                                        <small>Diposting Pada Tanggal {{$postingan->created_at}}</small>
                                    </div>
                                    <hr>
                                    <div class="mb-4 form-group">
                                        <p class="ft16">Bidang Pekerjaan: {{$postingan->bidang_pekerjaan->bidang_pekerjaan}}</p>
                                    </div>
                                    <hr>

                                    <h5 class="h5 mb-3">
                                        <i class="bi bi-people"></i>
                                        <b>Dibutuhkan</b>
                                    </h5>
                                    <ul class="ft16">
                                        <li>{{$postingan->employee}}</li>
                                    </ul>

                                    <h5 class="h5 mb-3">
                                        <i class="bi bi-briefcase"></i>
                                        <b>Deskripsi Pekerjaan</b>
                                    </h5>
                                    <ul class="ft16" style="list-style: ;">
                                        <li>
                                        {{$postingan->deskripsi_pekerjaan}}
                                        </li>
                                    </ul>

                                    <h5 class="h5 mb-3">
                                        <i class="bi bi-file-earmark-text"></i>
                                        <b>Persyaratan</b>
                                    </h5>
                                    <ul class="ft16">
                                        <li>{{$postingan->persyaratan}}</li>
                                        
                                    </ul class="ft16">
                                    <div class="d-grid d-md-flex justify-content-md-end">
                                        <small>Berakhir Pada Tanggal {{$postingan->masa_berakhir}}</small>
                                    </div>
                                </div>
                            </div>
                            <div class="card p-4 mb-4">
                                <div class="col-lg-5">
                                    <!-- Button trigger modal -->
                                    <a href="{{route('lowongan.show',$postingan->id)}}" class="btn btn-primary">
                                        Kirim Lamaran
                                    </a>
                                    
                                </div>
                            </div>
                            
                    
                        <div class="card-header p-3">
                            <h5 class="text18"><b>Lowongan Lain</b></h5>
                        </div>
    
                        @if ($jumlahdata < 3)
                            @foreach($randompost as $randompost)
                            <div class="card p-4">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            @auth
                                            <a href="{{route('lowongan.show',$randomposts->id)}}" class="text-decoration-none text18"><b>{{$randompostposts->judul_pekerjaan}}</b></a>
                                            @else
                                            <a href="{{route('dashboard.show',$randomposts->id)}}" class="text-decoration-none text18"><b>{{$randomposts->judul_pekerjaan}}</b></a>
                                            @endauth
                                        </div>                                    
                                        <div class="col-md-4">
                                            <p class="ft16">{{$randomposts->nama_perusahaan}}</p>
                                        </div>
                                        <div class="col-md-4">
                                            <p class="text-muted ft16">{{$randomposts->alamat_perusahaan}}</p>
                                        </div>
                                    </div>                               
                                </div>
                                {{-- <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p><a href="#" class="text-decoration-none text18"><b>CV. iSengsoft</b></a></p>
                                        </div>
                                        <div class="col-md-3">
                                            <small class="text-muted ft16">Glagah, Banyuwangi</small>
                                        </div>
                                        <div class="col-md-3">
                                            <small class="ft16">Software Development</small>
                                        </div>
                                    </div>
                                    <hr>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p><a href="#" class="text-decoration-none text18"><b>CV. CetroiD</b></a></p>
                                        </div>
                                        <div class="col-md-3">
                                            <small class="text-muted ft16">Kebalenan, Banyuwangi</small>
                                        </div>
                                        <div class="col-md-3">
                                            <small class="ft16">Software Development</small>
                                        </div>
                                    </div>
                                </div> --}}
                            </div>
                            @endforeach
                        @else
                            @foreach($randompost as $randomposts)
                            <div class="card p-4">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            @auth
                                            <a href="{{route('lowongan.show',$randomposts->id)}}" class="text-decoration-none text18"><b>{{$randomposts->judul_pekerjaan}}</b></a>
                                            @else
                                            <a href="{{route('dashboard.show',$randomposts->id)}}" class="text-decoration-none text18"><b>{{$randomposts->judul_pekerjaan}}</b></a>
                                            @endif
                                        </div>                                    
                                        <div class="col-md-4">
                                            <p class="ft16">{{$randomposts->nama_perusahaan}}</p>
                                        </div>
                                        <div class="col-md-4">
                                            <p class="text-muted ft16">{{$randomposts->alamat_perusahaan}}</p>
                                        </div>
                                    </div>                               
                                </div>
                                {{-- <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p><a href="#" class="text-decoration-none text18"><b>CV. iSengsoft</b></a></p>
                                        </div>
                                        <div class="col-md-3">
                                            <small class="text-muted ft16">Glagah, Banyuwangi</small>
                                        </div>
                                        <div class="col-md-3">
                                            <small class="ft16">Software Development</small>
                                        </div>
                                    </div>
                                    <hr>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p><a href="#" class="text-decoration-none text18"><b>CV. CetroiD</b></a></p>
                                        </div>
                                        <div class="col-md-3">
                                            <small class="text-muted ft16">Kebalenan, Banyuwangi</small>
                                        </div>
                                        <div class="col-md-3">
                                            <small class="ft16">Software Development</small>
                                        </div>
                                    </div>
                                </div> --}}
                            </div>
                            @endforeach
                        @endif
    
                    </div>
                    <div class="col-lg-4">
                        <div class="card-header p-3">
                            <h5 class="text-center text18"><b>Profil Perusahaan</b></h5>
                        </div>
                        @foreach($perusahaan as $perusahaans)
                        <div class="card p-4">
                            <div class="card-body">
                                <div class="mb-4 form-group">
                                    <img src="/imagesPerusahaan/{{$perusahaans->ubah_foto}}" class="img-responsive imghw100 mw-100 mb-4" alt="Logo">
                                    
                                    <h5 class="text18 text-center mb-4"><b>{{$perusahaans->nama_perusahaan}}</b></h5>
                                    <hr>
                                    
                                    <medium class="text-muted">Tentang:</medium>
                                    <p class="ft16 mb-3">{{$perusahaans->tentang_perusahaan}}</p>
                                    <hr>
    
                                    <medium class="text-muted">No. NPWP Perusahaan:</medium>
                                    <p class="ft16 mb-3">{{$perusahaans->no_npwp}}</p>
    
                                    <medium class="text-muted">Telepon Perusahaan:</medium>
                                    <p class="ft16 mb-3">{{$perusahaans->telepon}}</p>
    
                                    <p class="ft16 text-muted mb-3">Industri:<br>{{$perusahaans->industri}}</p>                                
                                    <p class="ft16 text-muted mb-3">Jumlah Karyawan:<br>{{$perusahaans->jumlah_karyawan}}</p>
                                
                                    <hr>
                                    
                                    <div class="row">       
                                        <medium class="text-muted mb-2">Lokasi:</medium>
                                        <p class="text14">{{$perusahaans->alamat_perusahaan}}</p>
                                        <iframe width="100%" height="250" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.google.com/maps?q={{$perusahaans->nama_perusahaan}}&hl=es;z=14&output=embed"></iframe>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        @endforeach
                        
                    </div>
                </div>
            </div>
        </section>
        
        @include('guest.layouts.footer')
        @include('guest.layouts.bottom')
    </body>
</html>