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
              <h1 class="m-0">Daftar Pengunjung</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/home">Beranda</a></li>
                <li class="breadcrumb-item active">Pengunjung</li>
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
          @if(Auth::user()->role == 'super admin')
          <div class="row d-flex justify-content-center">
          @else
          <div class="row d-flex justify-content-center">

            @if(!Auth::user()->email_verified_at)                                                          
                <div class="col-lg-12">
                    @if (session('resent'))
                    <div class="text-center alert alert-success" role="alert">
                        {{ __('Link verifikasi sudah terkirim pada email anda.') }}
                    </div>
                    @endif
                    <div class="alert alert-danger mb-1 text-center" role="alert">
                        Anda belum verifikasi email, silahkan cek email anda <br> Jika belum mendapatkan email
                        <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                            @csrf
                            <button type="submit" class="btn btn-link p-0 m-0 text-decoration-none">{{ __('klik disini') }}</button>.
                        </form>
                    </div>
                </div>
            @else
                @if($profil == null)
                    <div class="col-lg-12">
                        <div class="alert alert-success mb-1 text-center" role="alert">
                            Email anda sudah terverifikasi <br> Silahkan lengkapi profil anda
                            <a href="{{route('profil.edit',$useradmin->admin->id)}}" class="btn btn-link p-0 m-0 text-decoration-none">klik disini</a>
                        </div>
                    </div>
                @endif
            @endif
            
          @endif
            @if($user->count() == 0)
            <div class="col-lg-7">
              <div class="card mt-5 p-5">
                <div class="card-body p-4">
                  <div class="text-center mb-4">
                    <h1 class="text-warning"><i class="bi bi-emoji-frown"></i></h1>
  
                  </div>
                  <p class="ft16 text-center">Mohon maaf<br>Sepertinya belum ada pengunjung</p>
                </div>
                  
              </div>
            </div>
            @else
  
            <div class="col-md-12">

              @if($fitur_cari->count() == 0)
              <div class="alert alert-danger mb-1 text-center" role="alert">
                Maaf hasil cari <b>"{{$keywoard}}"</b> tidak ditemukan <i class="bi bi-emoji-frown"></i>
              </div>
              @endif

              @if($keywoard != null)
              <p class="ft16">Hasil penelusuran <b>{{$keywoard}}</b></p>
              @endif
              <div class="card p-4">

                <table class="table table-bordered">
                  <thead>
                    <tr class="table-secondary text-center">
                      <th>No.</th>
                      <th>Nama</th>
                      <th>Role</th>
                      <th>Tanggal Registrasi</th>
                    </tr>
                  </thead>

                  @if($fitur_cari->count() == 0)
                  <tbody>
                    @foreach($user as $i => $users)
                  <tr>
                      <td class="text-center">{{$no++}}.</td>
                      <td class="text-center">{{$users->name}}</td>
                      <td class="text-center">
                          @if($users->role == 'user')
                          <span class="badge bg-info">{{$users->role}}</span>
                          @else
                          <span class="badge bg-success">{{$users->role}}</span>
                          @endif
                      </td>
                      <td class="text-center">{{$users->created_at}}</td>
                    </tr>
                    @endforeach
                  </tbody>
                  @else
                  <tbody>
                      @foreach($fitur_cari as $i => $users)
                      <tr>
                          <td class="text-center">{{$no++}}.</td>
                          <td class="text-center">{{$users->name}}</td>
                          <td class="text-center">
                              @if($users->role == 'user')
                              <span class="badge bg-info">{{$users->role}}</span>
                              @else
                              <span class="badge bg-success">{{$users->role}}</span>
                              @endif
                          </td>
                          <td class="text-center">{{$users->created_at}}</td>                           
                      </tr>
                      @endforeach
                    </tbody>
                  @endif

                </table>
              </div>

              {{$fitur_cari->links('layouts.pagination')}}
            </div>
            @endif
          </div>

        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- modal -->
      <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
        Launch static backdrop modal
      </button> -->

      <!-- Modal -->
      <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="p-3">
              <div class="d-flex justify-content-center h1">
                <i class="bi bi-exclamation-triangle"></i>
              </div>
              <div class="d-flex justify-content-center">
                <h3 class="px-5">Apakah kamu yakin ingin menghapus akun admin?</h3>
              </div>
              <div class="d-flex justify-content-evenly p-3">
                <button class="btn btn-primary py-3 px-4" data-bs-dismiss="modal" aria-label="Close">Batal</button>
                <button type="submit" class="btn btn-danger py-3 px-4">Hapus</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    <!-- /.modal -->
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
