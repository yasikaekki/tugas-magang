
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
                  @if(session()->get('sukses'))
                    <div class="alert alert-success">
                        {{session()->get('sukses')}}
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
              </div>
        
              <!-- Main content -->
              <section class="content">
                <div class="container-fluid">
                  <div class="row d-flex">
                    <div class="col-lg-12">
                      <div class="card">
                          <div class="nav card-header p-0 border-bottom-0">
                              <div class="col-md-6 bg-white rounded-top">
                                  <a class="text18 p-4 nav-link active disabled">Email</a>
                              </div>
                              <div class="card-header bg-secondary col-md-6 p-0">
                                  <!-- <a class="text18 nav-link text-decoration-none" href="/home/status/favorite">Lowongan Magang Favorite Anda</a>                                    -->
                                  <a class="text18 nav-link text-decoration-none p-4" href="{{route('kata_sandi.edit', $useradmin)}}">Kata Sandi</a>                                   
                              </div>
                          </div>

                          <div class="card-body p-4 pt-0">                            
                            <div class="row">

                              <div class="col-md-6">                                    
                                  <div class="card-header bg-light">
                                    <h3 class="card-title"><b>Email</b></h3>
                                    
                                  </div>

                                  <div class="card p-4 mb-3">
                                    <div class="card-body">
                                    @foreach($email as $row)

                                    <medium class="text18">{{$row->email}} </medium>
                                    @if(!Auth::user()->email_verified_at)                                                                        
                                    <i class="text18 text-danger bi bi-x-circle-fill"></i>
                                    @else
                                    <i class="text18 text-success bi bi-check-circle-fill"></i>
                                    @endif

                                    @endforeach
                                    </div>
                                </div>
                              </div>  

                              <div class="col-md-6">                                    
                                  <div class="form-group p-4 mb-3">
                                    <form action="{{route('email.update',$useradmin)}}" method="post">
                                      @method('PATCH')
                                      @csrf
                                        <label>Email</label>
                                        <input name="txtemail_user" type="email" class="form-control mb-3 @error('email') is-invalid @enderror" required autocomplete="email" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Alamat Email">
                                      @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                      @enderror

                                      @if(Auth::user()->email_verified_at != null)
                                        <button type="submit" class="btn btn-primary form-control">Ubah Email</button>
                                      @else
                                      <button type="button" class="btn btn-primary form-control" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        Ubah Email
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
                                      </form>
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