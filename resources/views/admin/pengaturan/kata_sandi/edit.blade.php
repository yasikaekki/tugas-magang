
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
              <section class="content-header mt-5">
                <div class="container-fluid mt-4">
                  @if(session()->get('sukses'))
                    <div class="alert alert-success">
                        {{session()->get('sukses')}}
                    </div>
                  @elseif(session()->get('gagal'))
                    <div class="alert alert-danger">
                        {{session()->get('gagal')}}
                    </div>
                  @endif
                  <div class="row mb-2">
                    <div class="col-sm-6">
                      <h1>Pengaturan</h1>
                    </div>
                    <div class="col-sm-6">
                      <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Beranda</a></li>
                        <li class="breadcrumb-item"><a href="/home">Dashboard</a></li>
                        <li class="breadcrumb-item active">Pengaturan</li>
                      </ol>
                    </div>
                  </div>
                </div><!-- /.container-fluid -->
              </section>
        
              <!-- Main content -->
              <section class="content">
                <div class="container-fluid">
                  <div class="row d-flex">
                    <div class="col-lg-12">
                      <div class="card">
                        <div class="nav card-header p-0 border-bottom-0">
                            <div class="card-header bg-secondary col-md-6 p-0">
                                <a class="text18 nav-link text-decoration-none p-4" href="{{route('email.edit', $useradmin)}}">Email</a>
                            </div>

                            <div class="col-md-6 bg-white rounded-top">
                                <a class="text18 p-4 nav-link active disabled">Kata Sandi</a>                                   
                            </div>
                        </div>

                        <div class="card-body p-4 pt-0">  
                          <form action="{{route('kata_sandi.update', $useradmin)}}" method="post">
                            @method('PATCH')
                            @csrf
                          <form>                        
                            <div class="row justify-content-center">  

                                <div class="col-md-6">                                    
                                  <div class="mb-3 form-group">
                                    <label>Kata sandi lama</label>
                                    <div class="input-group" id="show_hide_password">
                                        <input type="password" class="form-control @error('password_lama') is-invalid @enderror" name="password_lama" id="password_lama" placeholder="Kata sandi Lama" required autocomplete="old-password">
                                        <div class="input-group-append">
                                            <button class="input-group-text" type="button" onclick="passtotext()">
                                                <i class="bi bi-eye-slash" id="showpass" aria-hidden="true"></i>
                                            </button>
                                        </div>
                                        
                                    @error('password_lama')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    </div>
                                  </div>

                                  <div class="mb-3 form-group">
                                      <label>kata sandi baru</label>
                                      <div class="input-group" id="show_hide_password">
                                          <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Kata sandi baru">
                                  
                                          <div class="input-group-append">
                                              <button class="input-group-text" type="button" onclick="passtotext()">
                                                  <i class="bi bi-eye-slash" id="showpass" aria-hidden="true"></i>
                                              </button>
                                          </div>
                                          @error('password')
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                          @enderror
                                      </div>
                                  </div>

                                  <div class="mb-3 form-group">
                                      <label>Konfirmasi kata sandi baru</label>
                                      <div class="input-group" id="show_hide_password">
                                          
                                          <input id="password-confirm" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="Konfirmasi kata sandi baru" name="password_confirmation" required autocomplete="new-password">
                                          <div class="input-group-append">
                                              <button class="input-group-text" type="button" onclick="passtotext()">
                                                  <i class="bi bi-eye-slash" id="showpass" aria-hidden="true"></i>
                                              </button>
                                          </div>
                                      </div>
                                  </div>        
                                  
                                  <div class="mb-3 form-group">
                                    @if(Auth::user()->email_verified_at != null)
                                      <button type="submit" class="btn btn-primary form-control">Ubah kata sandi</button>
                                    @else
                                    <button type="button" class="btn btn-primary form-control" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                      Ubah Kata Sandi
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
                                </div>   

                            </div>
                        </div>

                      </div>
                  </div>

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