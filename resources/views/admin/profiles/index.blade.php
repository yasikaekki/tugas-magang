
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
              <div class="row d-flex">
                {{-- <div class="col-md-3">
                </div> --}}
                <!-- /.col -->
                @if(session()->get('sukses'))
                    <div class="alert alert-success">
                        {{session()->get('sukses')}}
                    </div>
                @endif
                <div class="col-lg-12">
                    <div class="card p-5">
                        <div class="card-body box-profile">
                            @foreach($user as $users)
                            <div class="text-center">
                              @if($users->ubah_foto == null)
                                <img class="profile-user img-circle" src="{{asset('eki/images/user.png')}}" alt="User profile picture">
                              @else  
                              <img class="profile-user img-circle" src="{{asset ('imagesadmin/'.$users->ubah_foto)}}" alt="User profile picture">
                              @endif
                              <h3>{{$users->nama_lengkap}}</h3>
                            </div>  
        
                            <p class="text-muted text18 text-center mb-4">{{$users->pekerjaan}}</p>
                            <div class="d-grid col-8 mx-auto">

                                <div class="card">
                                    <div class="card-header bg-light">
                                        <h3 class="card-title">Biodata Diri</h3>
                                    </div>
                                      <!-- /.card-header -->
                                    <div class="card-body">
                                      <i class="fas fa-book"></i>
                                      <medium class="text16 text-muted">Tentang Saya:</medium>
                                      <medium class="text16 mb-3">{{$users->tentang_saya}}</medium>
                                      <hr>
                                      <i class="fas fa-user-graduate"></i>
                                      <medium class="text16 text-muted">Pendidikan:</medium>
                                      <medium class="text16 mb-3">{{$users->pendidikan_user}}</medium>
                                      <hr>
                                      <i class="fas fa-calendar-alt"></i>
                                      <medium class="text16 text-muted">Tempat, Tanggal Lahir:</medium>
                                      <medium class="text16 mb-3">{{$users->tempat_lahir}}, {{$users->tanggal_lahir}}</medium>
                                      <hr>
                                      <i class="fa fa-cogs"></i>
                                      <medium class="text16 text-muted">Keahlian:</medium>
                                      <medium class="text16 mb-3">{{$users->keahlian}}</medium>
                                      <hr>
                                      <i class="fas fa-map-marker-alt"></i>
                                      <medium class="text16 text-muted">Alamat:</medium>
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
                            </div>
                            {{-- @if($uid != 1) --}}
                            <div class="d-grid gap-2 col-4 mx-auto">
                              @if(Auth::user()->email_verified_at != null)
                                <a href="{{route('profil.edit', $users->id)}}" class="btn btn-primary">Ubah Profil</a>
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
                            {{-- @endif --}}
                            @endforeach
                        </div>
                  <!-- /.card -->
                    </div>
                  <!-- /.card -->
                </div>
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
    <script>
      window.setTimeout(function() {
        $(".alert ").fadeTo(500, 0).slideUp(500, function(){
            $(this).remove(); 
        });
      }, 4000);
    </script>
</html>