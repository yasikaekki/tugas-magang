

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
                              <li class="breadcrumb-item active" aria-current="page">Akun</li>
                            </ol>
                        </nav>
                    </div>
                    <div>
                        @if(session()->get('sukses'))
                            <div class="alert alert-danger">
                                {{session()->get('sukses')}}
                            </div>
                        @endif
                    </div>
                    @if (session('resent'))
                    <div class="text-center alert alert-success" role="alert">
                        {{ __('Link verifikasi sudah terkirim pada email anda.') }}
                    </div>
                    @endif

                    <?php
                    error_reporting(0);
                    print_r($_SESSION)?>
                    
                    @if(!Auth::user()->email_verified_at)
                    <div class="col-lg-7">
                        <div class="card p-4">
                            <div class="card-body">
                                <div class="text-center text-warning mb-4">
                                    <i class="bi bi-emoji-frown display-1"></i>
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
                    <div class="col-lg-12">
                        <div class="card p-4">
                            <div class="card-body">
                                <form action="{{route('profil.update', $user->id)}}" method="post"  enctype="multipart/form-data">
                                    @method('PATCH')
                                    @csrf
                                    <h3 class="mb-5">Ubah Biodata Diri</h2>
                                    <div class="mb-3 form-group">
                                        <div class="row">
                                            <div class="col-md-5">
                                                @if($user->ubah_foto == null)
                                                <img src="{{asset ('eki/images/user.png')}}" id="logo-image" class="mb-3 img-responsive rounded-circle logo-profile-user" alt="Logo">
                                                @else
                                                <!-- <img src="/images/{{$user->ubah_foto}}" id="logo-image" class="mb-4 img-responsive" alt="Logo"> -->
                                                <img src="{{asset ('images/'.$user->ubah_foto)}}" id="logo-image" class="mb-3 img-responsive rounded-circle logo-profile-user" alt="Logo">


                                                @endif
                                                <!-- <label for="preview" class="text-center custom-file-label">Ubah Foto</label> -->
                                                <label>Ubah Foto</label>
                                                <input value="{{asset ('images/'.$user->ubah_foto)}}" type="file" accept="image/png, image/jpeg" name="upload_foto" id="preview" class="form-control @error('upload_foto') is-invalid @enderror">
                                                @error('upload_foto')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

                                                <script>
                                                    $("#preview").change(function(event) {  
                                                        RecurFadeIn();
                                                        readURL(this);    
                                                    });
                                                    $("#preview").on('click',function(event){
                                                        RecurFadeIn();
                                                    });
                                                    function readURL(input) {    
                                                        if (input.files && input.files[0]) {   
                                                        var reader = new FileReader();
                                                        var filename = $("#preview").val();
                                                        filename = filename.substring(filename.lastIndexOf('\\')+1);
                                                        reader.onload = function(e) {
                                                            debugger;      
                                                            $('#logo-image').attr('src', e.target.result);
                                                            $('#logo-image').hide();
                                                            $('#logo-image').fadeIn(500);      
                                                            // $('.custom-file-label').text(filename);             
                                                        }
                                                        reader.readAsDataURL(input.files[0]);    
                                                        } 
                                                        $(".alert").removeClass("loading").hide();
                                                    }
                                                    function RecurFadeIn(){ 
                                                        // console.log('ran');
                                                        FadeInAlert();  
                                                    }
                                                    function FadeInAlert(){
                                                        $(".alert").show();
                                                        // $(".alert").text(text).addClass("loading");  
                                                    }
                                                </script>
                                            </div>
        
                                            <div class="col-md-7">
                                                
                                                <div class="form-group">
                                                    <label>Nama Lengkap</label>
                                                    <input type="text" value="{{$user->nama_lengkap}}" class="mb-3 form-control @error('nama_lengkap') is-invalid @enderror" id="exampleInputName1" aria-describedby="nameHelp" placeholder="Nama Lengkap" name="nama_lengkap">
                                                    @error('nama_lengkap')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label>Tentang Saya</label>
                                                    <input type="text" value="{{$user->tentang_saya}}" class="mb-3 form-control @error('tentang_saya') is-invalid @enderror" id="exampleInputName1" aria-describedby="nameHelp" placeholder="Tentang Saya" name="tentang_saya">
                                                    @error('tentang_saya')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label for="exampleFormControlSelect1">Pendidikan</label>
                                                    <select name="pendidikan_user" id="select" class="form-control  @error('pendidikan_user') is-invalid @enderror mb-3" required autocomplete="pendidikan_user">
                                                        @if($user->pendidikan_user == null)
                                                        <option value="null" selected hidden disabled>Pilih</option>
                                                        <option value="SMA/SMK Sederajat">SMA/SMK Sederajat</option>
                                                        <option value="Mahasiswa">Mahasiswa</option>
                                                        @else
                                                        <option value="SMA/SMK Sederajat">SMA/SMK Sederajat</option>
                                                        <option value="Mahasiswa">Mahasiswa</option>
                                                        @endif
                                                    </select>
                                                    @error('pendidikan_user')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
        
                                                <div class="form-group">
                                                    <div class="row">
                                                        <label>Tempat, Tanggal Lahir</label>
                                                        <div class="col-md-6">
                                                            <input type="text"  value="{{$user->tempat_lahir}}" class="mb-3 form-control @error('tempat_lahir') is-invalid @enderror" name="tempat_lahir" placeholder="Tempat Lahir">
                                                            @error('tempat_lahir')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input type="date" value="{{$user->tanggal_lahir}}" class="mb-3 form-control @error('tanggal_lahir') is-invalid @enderror" name="tanggal_lahir">
                                                            @error('tanggal_lahir')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
        
                                                <div class="form-group">
                                                    <label>Alamat Rumah</label>
                                                    <input type="text" value="{{$user->alamat_rumah}}" class="mb-3 form-control @error('alamat_rumah') is-invalid @enderror" placeholder="Alamat Rumah" name="alamat_rumah">
                                                    @error('alamat_rumah')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
        
                                                <div class="form-group">
                                                    <label for="exampleFormControlSelect1">Jenis Kelamin</label>
                                                    <select name="jenis_kelamin" id="select" class="form-control  @error('jenis_kelamin') is-invalid @enderror mb-3" required autocomplete="jenis_kelamin">
                                                        @if($user->jenis_kelamin == null)
                                                        <option value="null" selected hidden disabled>Pilih</option>
                                                        <option value="laki-laki">Laki-laki</option>
                                                        <option value="perempuan">Perempuan</option>
                                                        @else
                                                        <option value="laki-laki">Laki-laki</option>
                                                        <option value="perempuan">Perempuan</option>
                                                        @endif
                                                    </select>
                                                    @error('jenis_kelamin')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
        
                                                <div class="form-group">
                                                    <label>Telepon</label>
                                                    <input type="text" value="{{$user->telepon}}" class="mb-3 form-control @error('telepon') is-invalid @enderror" placeholder="Telepon" name="telepon">
                                                    @error('telepon')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            
                                                <div class="form-group">
                                                    <label>Upload Surat Keterangan Magang</label>
                                                    <input type="file" accept="application/pdf" class="mb-3 form-control @error('upload_sk') is-invalid @enderror" name="upload_sk">
                                                    @error('upload_sk')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label>Upload CV Anda</label>
                                                    <input type="file" accept="application/pdf" class="mb-3 form-control @error('upload_cv') is-invalid @enderror" name="upload_cv">
                                                    @error('upload_cv')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>                                         
        
                                                <div class="form-group">
                                                    <label>Upload Portfolio Anda</label>
                                                    <input type="file" accept="application/pdf" class="mb-3 form-control @error('upload_portofolio') is-invalid @enderror" name="upload_portofolio">
                                                    @error('upload_portofolio')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <button type="submit" class="btn btn-primary form-control">Ubah Profil</button>
                                                
                                            </div>
        
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </section>

        @include('user.layouts.footer')
        @include('user.layouts.bottom')
    </body>
</html>