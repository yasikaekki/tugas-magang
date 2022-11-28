
<!doctype html>
<html lang="en">
    <head>
        @include('user.layouts.top')
    </head>
    <body class="bg-light">
        @include('user.layouts.navigation')
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
                                    @foreach($user as $users)
                                    <div class="row justify-content-center">
                                        @if($users->ubah_foto == null)
                                        <img src="{{asset('eki/images/user.png')}}" class="img-responsive profile-user img-circle" alt="Logo">
                                        @else
                                        <img src="/images/{{$users->ubah_foto}}" class="img-responsive rounded-circle profile-user img-circle" alt="Logo">
                                        @endif

                                        <h4 class="text-center fs-3">{{$users->nama_lengkap}}</h4>
                                        <p class="text-center text18 text-muted mb-4">{{$users->pendidikan_user}}</p>

                                    </div>
                                            
                                    <div class="d-grid col-8 mx-auto">
                                        <div class="card-header">
                                            <div class="card-body">
                                                <medium class="text16"><b>Biodata Diri</b></medium>
                                            </div>
                                        </div>
                                        <div class="card p-4 mb-4">
                                            <div class="card-body">
                                                <i class="fas fa-book"></i>
                                                <medium class="text16 text-muted">Tentang Saya:</medium>
                                                <medium class="text16 mb-3">{{$users->tentang_saya}}</medium>
                                                <hr>
                                                <i class="fas fa-calendar-alt"></i>
                                                <medium class="text16 text-muted">Tempat, Tanggal Lahir:</medium>
                                                <medium class="text16 mb-3">{{$users->tempat_lahir}}, {{$users->tanggal_lahir}}</medium>
                                                <hr>
                                                <i class="fas fa-map-marker-alt"></i>
                                                <medium class="text16 text-muted">Alamat Rumah:</medium>
                                                <medium class="text16 mb-3">{{$users->alamat_rumah}}</medium>
                                                <hr>
                                                <i class="fas fa-transgender"></i>
                                                <medium class="text16 text-muted">Jenis Kelamin:</medium>
                                                <medium class="text16 mb-3">{{$users->jenis_kelamin}}</medium>
                                                <hr>
                                                <i class="bi bi-telephone-fill"></i>
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
                                                <p class="text18 mb-3"><a class="text-decoration-none" href="{{asset ('surat_keterangan/'.$users->surat_keterangan)}}" target="surat_keterangan">Surat Keterangan</a></medium>
                                                <p class="text18 mb-3"><a class="text-decoration-none" href="{{asset ('cv/'.$users->cv)}}" target="surat_keterangan">CV</a></p>
                                                <p class="text18 mb-3"><a class="text-decoration-none" href="{{asset ('portofolio/'.$users->portofolio)}}" target="surat_keterangan">Portofolio</a></p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    @if($users->nama_lengkap == null || $users->ubah_foto == null || $users->surat_keterangan == null || $users->cv == null || $users->portofolio == null)
                                    <div class="d-grid gap-2 col-4 mx-auto">
                                        @if(Auth::user()->email_verified_at != null)
                                        <a href="{{route('profil.edit', $users->id)}}" class="btn btn-primary">Lengkapi Profil</a>
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
                                        <a href="{{route('profil.edit', $users->id)}}" class="btn btn-primary">Ubah Profile</a>
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

        @include('user.layouts.footer')
        @include('user.layouts.bottom')
    </body>
    <script>
        window.setTimeout(function() {
            $(".alert ").fadeTo(500, 0).slideUp(500, function(){
                $(this).remove(); 
            });
        }, 4000);
    </script>
</html>