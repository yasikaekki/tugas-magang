<!doctype html>
<html lang="en">
    <head>
        @include('company.layouts.top')
    </head>
    <body class="bg-light">
        @include('company.layouts.navigation')
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

                    @if (session('resent'))
                    <div class="text-center alert alert-success" role="alert">
                        {{ __('Link verifikasi sudah terkirim pada email anda.') }}
                    </div>
                    @endif
                    
                    @if(session()->get('gagal'))
                        <div class="col-lg-12">
                            <div class="alert alert-danger">
                                {{session()->get('gagal')}}
                            </div>
                        </div>
                    @endif

                    @if (session('resent'))
                    <div class="text-center alert alert-success" role="alert">
                        {{ __('Link verifikasi sudah terkirim pada email anda.') }}
                    </div>
                    @endif
                    
                    @if(!Auth::user()->email_verified_at)
                    <div class="col-lg-7">
                        <div class="card p-4">
                            <div class="card-body">
                                <div class="text-center text-warning mb-4">
                                    <i class="bi bi-emoji-frown display-1"></i>
                                </div>
                                <p class="ft16 text-center">Anda belum verifikasi email<br>Silahkan verifikasi email dulu</p>
                                
                                <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                                    @csrf
                                    <div class="d-grid col-4 mx-auto">
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
                                <h3 class="mb-5">Ubah Profil Perusahaan</h2>
                                <form action="{{route('profil.update', $profiledit)}}" method="post" enctype="multipart/form-data">
                                    @method('PATCH')
                                    @csrf
                                    <div class="mb-3 form-group">
                                        <div class="row">
                                            @foreach($usercompany as $perusahaan)
                                            <div class="col-md-5">

                                                @if($perusahaan->ubah_foto == null)
                                                <img src="{{asset ('eki/images/company.jpg')}}" id="logo-image" class="mb-2 img-responsive logo-profile-company" alt="Logo">
                                                @else
                                                <img src="{{asset ('imagesPerusahaan/'.$perusahaan->ubah_foto)}}" id="logo-image" class="mb-2 img-responsive logo-profile-company" alt="Logo">
                                                @endif

                                                <label>Ubah Foto</label>
                                                <!-- <input type="file" name="upload_foto" class="form-control"> -->
                                                <input value="{{asset ('imagesPerusahaan/'.$perusahaan->ubah_foto)}}" type="file" accept="image/png, image/jpeg" name="upload_foto" id="preview" class="form-control {{ $errors->first('upload_foto', 'is-invalid') }}">
                                                @error('upload_foto')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
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
    
                                            <div class="col-md-7">
                                                <!-- 1@foreach($usercompany as $perusahaan) -->
                                                <div class="form-group">
                                                    <label>Nama Perusahaan</label>
                                                    <input name="nama_perusahaan" type="name" class="mb-3 form-control @error('nama_perusahaan') is-invalid @enderror" id="exampleInputName1" aria-describedby="nameHelp" placeholder="Nama Perusahaan" value="{{$perusahaan->nama_perusahaan}}">
                                                    @error('nama_perusahaan')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>

                                                
                                                <div class="form-group">
                                                    <label>Tentang Perusahaan</label>
                                                    <input name="tentang_perusahaan" placeholder="Tentang Perusahaan" class="mb-3 form-control @error('tentang_perusahaan') is-invalid @enderror" value="{{$perusahaan->tentang_perusahaan}}">
                                                    @error('tentang_perusahaan')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label>No. NPWP Perusahaan</label>
                                                    <input name="no_npwp" type="text" placeholder="No. NPWP Perusahaan" class="mb-3 form-control @error('no_npwp') is-invalid @enderror" value="{{$perusahaan->no_npwp}}">
                                                    @error('no_npwp')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label>Telepon Perusahaan</label>
                                                    <input name="telepon" type="text" placeholder="Telepon Perusahaan" class="mb-3 form-control @error('telepon') is-invalid @enderror" value="{{$perusahaan->telepon}}">
                                                    @error('telepon')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
    
                                                <div class="form-group">
                                                    <label>Jumlah Karyawan</label>
                                                    <input name="jumlah_karyawan" type="text" placeholder="Jumlah Karyawan" class="mb-3 form-control @error('jumlah_karyawan') is-invalid @enderror" value="{{$perusahaan->jumlah_karyawan}}">
                                                    @error('jumlah_karyawan')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div> 
                                                
                                                <div class="form-group">
                                                    <label for="exampleFormControlSelect1">Industri Perusahaan</label>
                                                    <select name="industri" class="form-control mb-3 @error('industri') is-invalid @enderror" id="exampleFormControlSelect1">
                                                        @if($perusahaan->industri == null)
                                                        <option value="null" selected hidden disabled>Pilih</option>
                                                        <option value="Teknologi & Layanan Informasi">Teknologi & Layanan Informasi</option>
                                                        <option value="Sumber Daya Manusia">Sumber Daya Manusia</option>
                                                        @else
                                                        <option value="Teknologi & Layanan Informasi">Teknologi & Layanan Informasi</option>
                                                        <option value="Sumber Daya Manusia">Sumber Daya Manusia</option>
                                                        @endif
                                                    </select>
                                                    @error('industri')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>  
                                                
                                                <div class="form-group">
                                                    <label>Alamat Perusahaan</label>
                                                    <input name="alamat_perusahaan" type="text" placeholder="Alamat Perusahaan" class="mb-3 form-control @error('alamat_perusahaan') is-invalid @enderror" value="{{$perusahaan->alamat_perusahaan}}">
                                                    @error('alamat_perusahaan')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label>Upload NIB Anda</label>
                                                    <input type="file" accept="application/pdf" class="mb-3 form-control @error('upload_nib') is-invalid @enderror" name="upload_nib">
                                                    @error('upload_nib')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label>SIUP</label>
                                                    <input type="file" accept="application/pdf" class="mb-3 form-control @error('upload_siup') is-invalid @enderror" name="upload_siup">
                                                    @error('upload_siup')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>Upload Akta Perusahaan Anda</label>
                                                    <input type="file" accept="application/pdf" class="mb-3 form-control @error('upload_akta') is-invalid @enderror" name="upload_akta">
                                                    @error('upload_akta')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <!-- 1@endforeach -->
                                                
                                                <button type="submit" class="btn btn-primary form-control">Submit</button>
                                            </div>
                                            @endforeach
    
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

        @include('company.layouts.footer')
        @include('company.layouts.bottom')
    </body>
</html>