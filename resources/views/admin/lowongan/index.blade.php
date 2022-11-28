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
              <h1 class="m-0">Daftar Lowongan Perusahaan</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/home">Beranda</a></li>
                <li class="breadcrumb-item active">Lowongan Perusahaan</li>
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
            @if($post->count() == 0)
            <div class="col-lg-7">
                <div class="card mt-5 p-5">
                    <div class="card-body p-4">
                        <div class="text-center text-warning mb-4">
                            <i class="bi bi-emoji-frown display-1"></i>
                        </div>
                        <p class="ft16 text-center">Mohon maaf <br> Sepertinya belum ada postingan lowongan magang</p>
                        
                    </div>
                </div>
            </div>
            
            @else

            @if($keywoard != null)
            <p class="ft16">Hasil penelusuran <b>{{$keywoard}}</b></p>
            @endif
            <div class="col-lg-12">
                @if($fitur_cari->count() == 0)
                <div class="alert alert-danger mb-1 text-center" role="alert">
                    Maaf hasil cari <b>"{{$keywoard}}"</b> tidak ditemukan <i class="bi bi-emoji-frown"></i>
                </div>
                @if(session()->get('sukses'))
                <div class="alert alert-success">
                    {{session()->get('sukses')}}
                </div>
                @endif
                <div class="card p-4">
                    <div class="card-body">
                        <div class="row d-flex justify-content-center">
                            @if($post->count() == 0)
                            <div class="col-lg-7">
                                <div class="card p-5">
                                    <div class="card-body p-4">
                                        <div class="text-center mb-4">
                                            <h1 class="text-warning"><i class="bi bi-emoji-frown"></i></h1>
                        
                                        </div>
                                        <p class="small text-center">Mohon maaf<br>Sepertinya belum ada postingan dari perusahaan</p>
                                    </div>
                                    
                                </div>
                            </div>
                            @else
                            {{-- <h3 class="text-center mb-4"><strong>STATUS LOWONGAN</strong></h3> --}}
                            <div class="col-md-12">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="table-secondary text-center">
                                            <th>No</th>
                                            <th>Nama Perusahaan</th>
                                            <th>Nama Lowongan</th>
                                            <th>Status</th>
                                            <th>Masa Berakhir</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($post as $postingans)
                                        <tr class="text-center">
                                            <td>{{$no++}}</td>
                                            <td>{{$postingans->nama_perusahaan}}</td>
                                            <td>{{$postingans->judul_pekerjaan}}</td>
                                            @if($postingans->pelamar == null)
                                            <td>0 orang</td>
                                            @else
                                            <td>{{$postingans->pelamar}}</td>
                                            @endif
                                            <td>{{$postingans->masa_berakhir}}</td>

                                            <td>
                                                <a class="btn btn-success" href="{{route('lowongan.show', $postingans->id)}}">View</a>
                                                
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                @else

                @if(session()->get('sukses'))
                <div class="alert alert-success">
                    {{session()->get('sukses')}}
                </div>
                @endif
                <div class="card p-4">
                    <div class="card-body">
                        <div class="row">
                            
                            <div class="col-md-12">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="table-secondary text-center">
                                            <th>No</th>
                                            <th>Nama Perusahaan</th>
                                            <th>Nama Lowongan</th>
                                            <th>Status</th>
                                            <th>Masa Berakhir</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($fitur_cari as $postingans)
                                        <tr class="text-center">
                                            <td>{{$no++}}</td>
                                            <td>{{$postingans->nama_perusahaan}}</td>
                                            <td>{{$postingans->judul_pekerjaan}}</td>
                                            @if($postingans->pelamar == null)
                                            <td>0 orang</td>
                                            @else
                                            <td>{{$postingans->pelamar}}</td>
                                            @endif
                                            <td>{{$postingans->masa_berakhir}}</td>

                                            <td>
                                                <a class="btn btn-success me-3" href="{{route('lowongan.show', $postingans->id)}}">View</a>
                                                            
                                            </td>
                                        </tr>
                                        @endforeach
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                {{$fitur_cari->links('layouts.pagination')}}
                @endif
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
