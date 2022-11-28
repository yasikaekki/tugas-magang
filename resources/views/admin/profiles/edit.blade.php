
<!doctype html>
<html lang="en">
    <head>
        @include('admin.layouts.top')
    </head>
    <body class="hold-transition sidebar-mini layout-fixed">
        <div class="wrapper">
            @include('admin.layouts.navigation')
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
              <!-- Content Header (Page header) -->
              <div class="content-header mt-5">
                <div class="container-fluid mt-4">
                  <div class="row mb-2">
                    <div class="col-sm-6">
                      <h1>Akun</h1>
                    </div>
                    <div class="col-sm-6">
                      <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Beranda</a></li>
                        <li class="breadcrumb-item"><a href="/home">Dashboard</a></li>
                        <li class="breadcrumb-item active">Akun</li>
                      </ol>
                    </div>
                  </div>
                </div><!-- /.container-fluid -->
              </div>
        
              <!-- Main content -->
              <section class="content">
                <div class="container-fluid">
                    
                    <div class="row d-flex justify-content-center">
                        
                        @if(session()->get('gagal'))
                        <div class="alert alert-danger">
                            {{session()->get('gagal')}}
                        </div>
                        @endif

                        @if (session('resent'))
                        <div class="text-center alert alert-success" role="alert">
                            {{ __('Link verifikasi sudah terkirim pada email anda.') }}
                        </div>
                        @endif

                        @if(!Auth::user()->email_verified_at)
                        <div class="col-lg-7">
                            <div class="card mt-5 p-5">
                                <div class="card-body p-4">
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
                                    <form action="{{route('profil.update',$akun->id)}}" method="post" enctype="multipart/form-data">
                                        @method('PATCH')
                                        @csrf
                                        <div class="mb-3 form-group">
                                            <div class="row">
                                                <div class="col-md-5">

                                                    @if($akun->ubah_foto == null)
                                                    <img class="logo-profile-user img-circle" id="logo-image" src="{{asset('eki/images/user.png')}}" alt="logo">
                                                    @else
                                                    <img src="{{asset ('imagesadmin/'.$akun->ubah_foto)}}" id="logo-image" class="mb-4 img-responsive logo-profile-user img-circle" alt="Logo">
                                                    @endif

                                                    <label>Ubah Foto</label>
                                                    <input value="{{asset ('images/admin/'.$akun->ubah_foto)}}" type="file" accept="image/png, image/jpeg" name="upload_foto" id="preview" class="form-control @error('upload_foto') is-invalid @enderror">
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
                                                    <!-- 1@foreach($akuncompany as $perusahaan) -->
                                                    <div class="form-group">
                                                        <label>Nama Lengkap</label>
                                                        <input name="nama_lengkap" type="name" class="mb-3 form-control @error('nama_lengkap') is-invalid @enderror" id="exampleInputName1" aria-describedby="nameHelp" placeholder="Nama Lengkap" value="{{$akun->nama_lengkap}}">
                                                        @error('nama_lengkap')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>

                                                    
                                                    <div class="form-group">
                                                        <label>Tentang Saya</label>
                                                        <input name="tentang_saya" placeholder="Tentang Saya" class="mb-3 form-control" value="{{$akun->tentang_saya}}">
                                                    </div> 
                                                    <div class="form-group">
                                                        <label for="exampleFormControlSelect1">Pendidikan</label>
                                                        <select name="pendidikan_user" id="select" class="form-control mb-3" required autocomplete="pendidikan">                                                       
                                                            @if($akun->pendidikan_user == null)
                                                            <option value="null" selected hidden disabled>Pilih</option>
                                                            <option value="SMA/SMK Sederajat">SMA/SMK Sederajat</option>
                                                            <option value="D3">D3</option>
                                                            <option value="S1">S1</option>
                                                            <option value="S2">S2</option>
                                                            @else
                                                            <option value="SMA/SMK Sederajat">SMA/SMK Sederajat</option>
                                                            <option value="D3">D3</option>
                                                            <option value="S1">S1</option>
                                                            <option value="S2">S2</option>
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
                                                                <input type="text"  value="{{$akun->tempat_lahir}}" class="mb-3 form-control @error('tempat_lahir') is-invalid @enderror" name="tempat_lahir" placeholder="Tempat Lahir">
                                                                @error('tempat_lahir')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                            <div class="col-md-6">
                                                                <input type="date" value="{{$akun->tanggal_lahir}}" class="mb-3 form-control @error('tanggal_lahir') is-invalid @enderror" name="tanggal_lahir">
                                                                @error('tanggal_lahir')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Pekerjaan</label>
                                                        <input name="pekerjaan" placeholder="Pekerjaan" class="mb-3 form-control @error('pekerjaan') is-invalid @enderror" value="{{$akun->pekerjaan}}">
                                                        @error('pekerjaan')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div> 
                                                    <div class="form-group">
                                                        <label for="exampleFormControlSelect1">Jenis Kelamin</label>
                                                        <select name="jenis_kelamin" id="select" class="form-control @error('jenis_kelamin') is-invalid @enderror mb-3" required autocomplete="jenis_kelamin">
                                                            @if($akun->jenis_kelamin == null)
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
                                                        <label>Keahlian</label>
                                                        <input name="keahlian" placeholder="Tentang Saya" class="mb-3 form-control @error('keahlian') is-invalid @enderror" value="{{$akun->keahlian}}">
                                                        @error('keahlian')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Telepon</label>
                                                        <input type="text" value="{{$akun->telepon}}" class="mb-3 form-control @error('telepon') is-invalid @enderror" placeholder="Telepon" name="telepon">
                                                        @error('telepon')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    
                                                    <div class="form-group">
                                                        <label>Alamat Rumah</label>
                                                        <input type="text" value="{{$akun->alamat_rumah}}" class="mb-3 form-control @error('alamat_rumah') is-invalid @enderror" placeholder="Alamat Rumah" name="alamat_rumah">
                                                        @error('alamat_rumah')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <!-- 1@endforeach -->
                                                    
                                                    <button type="submit" class="btn btn-primary form-control">Submit</button>
                                                </div>
        
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endif
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
              </section>
              <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->
            @include('admin.layouts.footer')
        
            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
              <!-- Control sidebar content goes here -->
            </aside>
            <!-- /.control-sidebar -->
        </div>
     
        @include('admin.layouts.bottom')
    </body>
</html>