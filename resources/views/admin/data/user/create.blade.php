<!DOCTYPE html>
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
              <h1 class="m-0">Membuat Akun</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/home">Beranda</a></li>
                <li class="breadcrumb-item"><a href="{{route('user.index')}}">Dashboard User</a></li>
                <li class="breadcrumb-item"><a href="{{route('data_user.index')}}">Data User</a></li>
                <li class="breadcrumb-item active">Membuat Akun</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
          <!-- /.row -->
          <!-- table -->
          @if(Auth::user()->role == 'super admin')
          <div class="row">
            <div class="col-md-12">
              <div class="card p-4">
                <div class="card-body">
                    <h3 class="mb-5">Buat akun user</h2>
                    <form action="{{route('data_user.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3 form-group">                 
                            <div class="d-flex justify-content-center">

                                <div class="col-md-7">
                                    <div class="form-group">
                                      <label>Nama</label>
                                      <input name="nama_user" type="text" class="mb-3 form-control @error('nama_user') is-invalid @enderror" id="exampleInputName1" aria-describedby="nameHelp" placeholder="Nama">
                                      @error('nama_user')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                      @enderror
                                    </div>
                                    
                                    <div class="form-group">
                                      <label>Email</label>
                                      <input name="email_user" type="email" placeholder="Email" class="mb-3 form-control @error('email_user') is-invalid @enderror">
                                      @error('email_user')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                      @enderror
                                    </div>

                                    <div class="form-group">
                                      <label>Password</label>
                                      <input name="password" type="password" placeholder="Password" class="mb-3 form-control @error('password') is-invalid @enderror">
                                      @error('password')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                      @enderror
                                    </div>

                                    <div class="form-group">
                                      <label>Konfirmasi Password</label>
                                      <input name="passwordkonfirmasi" type="password" placeholder="Konfirmasi Password" class="mb-3 form-control @error('passwordkonfirmasi') is-invalid @enderror">
                                      @error('passwordkonfirmasi')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                      @enderror
                                    </div>
                                    
                                    <button type="submit" class="btn btn-primary form-control">Buat akun</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
              </div>
            </div>
          </div>
          @else
          <div class="row d-flex justify-content-center my-4">
            <!-- 1@if($useradmin->admin->nama_lengkap == null) -->
            @if($userrole == 'admin' && $useradmin->admin->nama_lengkap == null)
            <div class="col-lg-7">
              <div class="card mt-5 p-5">
                <div class="card-body p-4">
                  <div class="text-center text-warning mb-4">
                    <i class="bi bi-emoji-frown display-1"></i>
                  </div>
                  <p class="ft16 text-center">Profil anda belum lengkap<br>Silahkan lengkapi dulu profilnya</p>
                      
                      <div class="d-grid col-4 mx-auto">
                          <a class="btn btn-primary" href="{{route('profil.edit',$useradmin->admin->id)}}"><i class="bi bi-person-fill"></i> Klik di sini</a>
                      </div>
                </div>
                  
              </div>
            </div>
            @else
            <div class="col-md-12">
                <div class="card p-4">
                  <div class="card-body">
                      <h3 class="mb-5">Buat akun user</h2>
                      <form action="{{route('data_user.store')}}" method="post" enctype="multipart/form-data">
                          @csrf
                          <div class="mb-3 form-group">                 
                              <div class="d-flex justify-content-center">

                                  <div class="col-md-7">
                                      <div class="form-group">
                                          <label>Nama</label>
                                          <input name="nama_user" type="text" class="mb-3 form-control @error('nama_user') is-invalid @enderror" id="exampleInputName1" aria-describedby="nameHelp" placeholder="Nama">
                                          @error('nama_user')
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                          @enderror
                                      </div>
                                      
                                      <div class="form-group">
                                          <label>Email</label>
                                          <input name="email_user" type="email" placeholder="Email" class="mb-3 form-control @error('emai_user') is-invalid @enderror">
                                          @error('email_user')
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                          @enderror
                                      </div>

                                      <div class="form-group">
                                          <label>Password</label>
                                          <input name="password" type="password" placeholder="Passowrd" class="mb-3 form-control @error('password') is-invalid @enderror">
                                          @error('password')
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                          @enderror
                                      </div>

                                      <div class="form-group">
                                          <label>Konfirmasi Password</label>
                                          <input name="passwordkonfirmasi" type="password" placeholder="Konfirmasi Password" class="mb-3 form-control @error('passwordkonfirmasi') is-invalid @enderror">
                                          @error('passwordkonfirmasi')
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                          @enderror
                                      </div>
                                      
                                      <button type="submit" class="btn btn-primary form-control">Buat akun</button>
                                  </div>
                              </div>
                          </div>
                      </form>
                  </div>
              </div>
            </div>
            @endif
          </div>
          @endif
          <!-- .table -->
          <!-- /.row (main row) -->
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
