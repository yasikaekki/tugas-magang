
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
                    @if(!Auth::user()->email_verified_at)
                    <div class="col-lg-7">
                        <div class="card p-4">
                            <div class="card-body">
                                <div class="text-center mb-4">
                                    <h1 class="text-warning"><i class="bi bi-emoji-frown"></i></h1>
                                </div>
                                <p class="small text-center">Anda belum verifikasi email<br>Silahkan verifikasi email dulu</p>
                                
                                <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                                    @csrf
                                    <div class="d-grid col-3 mx-auto">
                                        <button type="submit" class="btn btn-primary"><i class="text18 bi bi-check-circle-fill"></i> {{ __('klik disini') }}</button>.
                                        
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @else
                    <form action="" method="post">
                        <div class="col-lg-12">
                            <div class="card p-4">
                                <div class="card-body">
                                    <div class="mb-3 form-group  p-5">
                                        <div class="row justify-content-center">
                                            @if($users->ubah_foto == null)
                                            <img src="{{asset('eki/images/user.png')}}" class="mb-2 img-responsive profile-user img-circle" alt="Logo">
                                            @else
                                            <img src="/images/{{$users->ubah_foto}}" class="mb-2 img-responsive rounded-circle profile-user img-circle" alt="Logo">
                                            @endif
                                            <h4 class="text-center mb-3">{{$users->nama_lengkap}}</h4>
                                            <medium class="text-center text18 text-muted mb-4">{{$users->pendidikan_user}}</medium>
                                        </div>
                                                
                                        <div class="d-grid col-8 mx-auto">
                                            <div class="card-header">
                                                <div class="card-body">
                                                    <medium class="text16"><b>Biodata Diri</b></medium>
                                                </div>
                                            </div>
                                            <div class="card p-4 mb-4">
                                                <div class="card-body">
                                                    <medium class="text16 text-muted">Tentang Saya:</medium>
                                                    <medium class="text16 mb-3">{{$users->tentang_saya}}</medium>
                                                    <hr>
                                                    <medium class="text16 text-muted">Tempat, Tanggal Lahir:</medium>
                                                    <medium class="text16 mb-3">{{$users->tempat_lahir}}, {{$users->tanggal_lahir}}</medium>
                                                    <hr>
                                                    <medium class="text16 text-muted">Alamat Rumah:</medium>
                                                    <medium class="text16 mb-3">{{$users->alamat_rumah}}</medium>
                                                    <hr>
                                                    <medium class="text16 text-muted">Jenis Kelamin:</medium>
                                                    <medium class="text16 mb-3">{{$users->jenis_kelamin}}</medium>
                                                    <hr>
                                                    <medium class="text16 text-muted">Telepon:</medium>
                                                    <medium class="text16 mb-3">{{$users->telepon}}</medium>
                                                </div>
                                                
                                            </div>
                                            
                                            <div class="card-header">
                                                <div class="card-body">
                                                    <medium class="text16"><b>Berkas</b></medium>
                                                </div>
                                            </div>
                                            
                                            <div class="card p-4 mb-4">
                                                <div class="card-body">
                                                    @if($users->surat_keterangan != null && $users->cv != null && $users->portofolio != null)
                                                    <p class="text18 mb-3"><a class="text-decoration-none" href="{{asset ('surat_keterangan/'.$users->surat_keterangan)}}" target="surat_keterangan">Surat Keterangan Magang</a></medium>
                                                    <p class="text18 mb-3"><a class="text-decoration-none" href="{{asset ('cv/'.$users->cv)}}" target="surat_keterangan">CV</a></p>
                                                    <p class="text18 mb-3"><a class="text-decoration-none" href="{{asset ('portofolio/'.$users->portofolio)}}" target="surat_keterangan">Portfolio</a></p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    @endif
                </div>
            </div>
        </section>

        @include('company.layouts.footer')
        @include('company.layouts.bottom')
    </body>
</html>