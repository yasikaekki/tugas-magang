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
              <h1 class="m-0">Daftar Biodata Perusahaan</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/home">Beranda</a></li>
                <li class="breadcrumb-item"><a href="{{route('perusahaan.index')}}">Dashboard Perusahaan</a></li>
                <li class="breadcrumb-item active">Biodata Perusahaan</li>
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
          <div class="row d-flex justify-content-center">
            @if($user->count() == 0)
            <div class="col-lg-7">
              <div class="card mt-5 p-5">
                <div class="card-body p-4">
                  <div class="text-center text-warning mb-4">
                    ><i class="bi bi-emoji-frown display-1"></i>
  
                  </div>
                  <p class="ft16 text-center">Mohon maaf<br>Sepertinya belum ada data apapun</p>
                </div>
                  
              </div>
            </div>
            @else
            
            <div class="col-md-12">
              @if($keywoard != null)
              <p class="ft16">Hasil penelusuran <b>{{$keywoard}}</b></p>
              @endif
              @if($fitur_cari->count() == 0)
              <div class="alert alert-danger mb-1 text-center" role="alert">
                Maaf nama pekerjaan <b>"{{$keywoard}}"</b> tidak ditemukan <i class="bi bi-emoji-frown"></i>
              </div>
              @endif
                <div class="card p-4">

                    <table class="table table-bordered">
                      <thead>
                          <tr class="table-secondary">
                              <th>No.</th>
                              <th>Nama Perusahaan</th>
                              <th>Tentang</th>
                              <th>Industri</th>
                              <th>NPWP</th>
                              <th>Jumlah Karyawan</th>
                              <th>Telepon</th>
                              <th>Alamat Perusahaan</th>
                          </tr>
                      </thead>
                      @if($fitur_cari->count() == 0)
                      <tbody>
                            @foreach($user as $i => $users)
                            <tr>
                                <td>{{$no++}}</td>
                                @if($users->nama_perusahaan == null)
                                <td>Belum dilengkapi</td>
                                <td>Belum dilengkapi</td>
                                <td>Belum dilengkapi</td>
                                <td>Belum dilengkapi</td>
                                <td>Belum dilengkapi</td>
                                <td>Belum dilengkapi</td>
                                <td>Belum dilengkapi</td>
                                @else
                                <td>{{$users->nama_perusahaan}}</td>
                                <td>{{$users->tentang_perusahaan}}</td>
                                <td>{{$users->industri}}</td>
                                <td>{{$users->no_npwp}}</td>
                                <td>{{$users->jumlah_karyawan}}</td>
                                <td>{{$users->telepon}}</td>
                                <td>{{$users->alamat_perusahaan}}</td>
                                @endif
                            </tr>
                            @endforeach
                      </tbody>
                      @else
                      <tbody>
                        @foreach($fitur_cari as $i => $users)
                        <tr>
                            <td>{{$no++}}</td>
                            @if($users->nama_perusahaan == null)
                            <td>Belum dilengkapi</td>
                            <td>Belum dilengkapi</td>
                            <td>Belum dilengkapi</td>
                            <td>Belum dilengkapi</td>
                            <td>Belum dilengkapi</td>
                            <td>Belum dilengkapi</td>
                            <td>Belum dilengkapi</td>
                            @else
                            <td>{{$users->nama_perusahaan}}</td>
                            <td>{{$users->tentang_perusahaan}}</td>
                            <td>{{$users->industri}}</td>
                            <td>{{$users->no_npwp}}</td>
                            <td>{{$users->jumlah_karyawan}}</td>
                            <td>{{$users->telepon}}</td>
                            <td>{{$users->alamat_perusahaan}}</td>
                            @endif
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
