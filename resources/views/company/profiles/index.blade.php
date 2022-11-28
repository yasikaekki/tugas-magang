<!doctype html>
<html lang="en">
    <head>
        @include('company.layouts.top')
    </head>
    <body class="bg-light">
        @include('company.layouts.navigation')
        <section class="p-5">
            <div class="container p-5">
                @if(session()->get('sukses'))
                    <div class="alert alert-success">
                        {{session()->get('sukses')}}
                    </div>
                @endif

                <div class="row d-flex justify-content-center">
                    <div class="mb-3">
                        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="/" class="text-decoration-none">Beranda</a></li>
                              <li class="breadcrumb-item"><a href="/home" class="text-decoration-none">Lowongan</a></li>
                              <li class="breadcrumb-item active" aria-current="page">Akun</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-lg-12">
                        <div class="card p-4">
                            <div class="card-body">
                                <div class="mb-3 form-group p-5">
                                    <h3 class="mb-5">Akun</h2>
                                    @foreach($user as $perusahaan)
                                    <div class="row justify-content-center">
                                        @if($perusahaan->ubah_foto == null)
                                        <img src="{{asset('eki/images/company.jpg')}}" class="img-responsive profile-company" alt="Logo">
                                        @else
                                        <img src="{{asset('imagesPerusahaan/'.$perusahaan->ubah_foto)}}" class="img-responsive profile-company" alt="Logo">
                                        @endif
                                        <h4 class="text-center fs-3">{{$perusahaan->nama_perusahaan}}</h4>
                                        <p class="text-center text18 text-muted mb-4">{{$perusahaan->industri}}</p>
                                    </div>
                                            
                                    <div class="d-grid col-8 mx-auto">
                                        <div class="card-header">
                                            <div class="card-body">
                                                <medium class="text16"><b>Biodata Diri</b></medium>
                                            </div>
                                        </div>

                                        <div class="card p-4 mb-4">
                                            <div class="card-body">
                                                <!-- 1@foreach($usercompany as $perusahaan) -->
                                                <i class="fas fa-book"></i>
                                                <medium class="text16 text-muted">Tentang Perusahaan:</medium>
                                                <medium class="text16 mb-3">{{$perusahaan->tentang_perusahaan}}</medium>
                                                <hr>
                                                <i class="bi bi-pencil-fill"></i>
                                                <medium class="text16 text-muted">No. NPWP Perusahaan:</medium>
                                                <medium class="text16 mb-3">{{$perusahaan->no_npwp}}</medium>
                                                <hr>
                                                <i class="bi bi-telephone-fill"></i>
                                                <medium class="text16 text-muted">Telepon Perusahaan:</medium>
                                                <medium class="text16 mb-3">{{$perusahaan->telepon}}</medium>
                                                <hr>
                                                <i class="fas fa-users"></i>
                                                <medium class="text16 text-muted">Jumlah Karyawan:</medium>
                                                <medium class="text16 mb-3">{{$perusahaan->jumlah_karyawan}}</medium>
                                                <hr>
                                                <i class="fas fa-map-marker-alt"></i>
                                                <medium class="text16 text-muted">Alamat Perusahaan:</medium>
                                                <medium class="text16 mb-3">{{$perusahaan->alamat_perusahaan}}</medium>
                                                <!-- 1@endforeach -->
                                            </div>
                                            
                                        </div>

                                        <div class="card-header">
                                            <div class="card-body">
                                                <medium class="text16" id="kosong"><b>Berkas</b></medium>
                                            </div>
                                        </div>
                                        
                                        <div class="card p-4 mb-4">
                                            <div class="card-body">
                                                @if($perusahaan->nib != null && $perusahaan->akta_perusahaan != null && $perusahaan->siup != null)

                                                {{-- @if ($perusahaan->nib == null)
                                                <p class="text18 mb-3"><a class="text-decoration-none" href="#kosong">Belum upload NIB</a></p>
                                                @else --}}
                                                <p class="text18 mb-3"><a class="text-decoration-none" href="{{url('nib/'.$perusahaan->nib)}}" target="p">NIB</a></p>
                                                {{-- @endif
                                                @if ($perusahaan->akta_perusahaan == null)
                                                <p class="text18 mb-3"><a class="text-decoration-none" href="#kosong" target="">Belum upload Akte</a></p>
                                                @else --}}
                                                <p class="text18 mb-3"><a class="text-decoration-none" href="{{url('akta/'.$perusahaan->akta_perusahaan)}}" target="p">Akta Pendirian Perusahaan</a></p>
                                                {{-- @endif
                                                @if ($perusahaan->siup == null)
                                                <p class="text18 mb-3"><a class="text-decoration-none" href="#kosong" target="">Belum upload Akte</a></p>
                                                @else --}}
                                                <p class="text18 mb-3"><a class="text-decoration-none" href="{{url('siup/'.$perusahaan->siup)}}" target="p">SIUP</a></p>
                                                {{-- @endif --}}
                                                {{-- <p class="text18 mb-3"><a class="text-decoration-none" href="{{$perusahaan->akte_perusahaan}}" target="">Akte Perusahaan</a></p>
                                                <p class="text18 mb-3"><a class="text-decoration-none" href="{{url ('akte/'.$perusahaan->akte_perusahaan)}}" target="">Akte Perusahaan</a></p> --}}

                                                {{-- <p class="text18 mb-3"><a href="" class="text-decoration-none" target="surat_nib">NIB</a></p>
                                                <p class="text18 mb-3"><a href="" class="text-decoration-none" target="surat_keterangan">SIUP</a></p>
                                                <p class="text18 mb-3"><a href="" class="text-decoration-none" target="surat_keterangan">Akta Pendirian Perusahaan</a></p> --}}

                                                @endif
                                                
                                            </div>
                                        </div>
                                    </div>
                                    
                                    @if($lengkapi_profil == null)
                                    <div class="d-grid gap-2 col-4 mx-auto">
                                        @if(Auth::user()->email_verified_at != null)
                                        <a href="{{route('profil.edit', $profil)}}" class="btn btn-primary">Lengkapi Profil</a>
                                        @else
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                            Lengkapi Profil
                                        </button>
      
                                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-body">
                                                        <div class="form-group mb-3">
                                                            <div class="text-center text-warning mb-4">
                                                            <i class="bi bi-emoji-frown display-1"></i>
                                                        </div>
                                                        <p class="ft16 text-center">Mohon maaf<br>Anda belum melakukan verifikasi email</p>
                                                        
                                                        </div> 
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                    @else
                                    <div class="d-grid gap-2 col-4 mx-auto">
                                        <a href="{{route('profil.edit', $profil)}}" class="btn btn-primary">Ubah Profile</a>
                                    </div>
                                    @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        @include('company.layouts.footer')
        @include('company.layouts.bottom')
    </body>
</html>