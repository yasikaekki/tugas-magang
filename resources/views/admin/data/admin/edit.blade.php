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
              <h1 class="m-0">{{$pagename}}</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/home">Beranda</a></li>
                <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Dashboard Admin</a></li>
                <li class="breadcrumb-item"><a href="{{route('data_admin.index')}}">Data Admin</a></li>
                <li class="breadcrumb-item active">Mengubah Akun</li>
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
          <div class="row my-4">
              <div class="col-md-12">
                  <div class="card p-4">
                    <div class="card-body">
                        <h3 class="mb-5">Ubah akun admin</h2>
                        <form action="{{route('data_admin.update', $admin->id)}}" method="post" enctype="multipart/form-data">
                            @method('PATCH')
                            @csrf
                            <div class="mb-3 form-group">                 
                              <div class="d-flex justify-content-center">
                                <div class="col-md-7">
                                    <div class="form-group">
                                      <label>Nama</label>
                                      <input name="nama_admin" type="text" class="mb-3 form-control @error('nama_admin') is-invalid @enderror" id="exampleInputName1" aria-describedby="nameHelp" placeholder="Nama" value="{{$admin->name}}">
                                      @error('nama_admin')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                      @enderror
                                    </div>
                                    
                                    <div class="form-group">
                                      <label>Email</label>
                                      <input name="email_admin" type="email" placeholder="Email" class="mb-3 form-control @error('email_admin') is-invalid @enderror" value="{{$admin->email}}">
                                      @error('email_admin')
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
                                    
                                    <button type="submit" class="btn btn-primary form-control">Ubah akun</button>
                                </div>
                              </div>
                            </div>
                        </form>
                    </div>
                </div>
              </div>
          </div>
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
