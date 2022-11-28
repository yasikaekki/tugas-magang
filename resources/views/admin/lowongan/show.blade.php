<!DOCTYPE html>
<html lang="en">
<head>
  @include('admin.layouts.toppost')
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
              <h1 class="m-0">Lowongan Perusahaan</h1>
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
            <div class="col-lg-8">
                <div class="card p-4">
                    <div class="card-body">
                        <h3 class="mb-4"><b>{{$postingan->judul_pekerjaan}}</b></h3>
                        <div class="d-grid d-md-block mb-3">
                            <!-- <small>Diposting Pada Tanggal 02 Mei 2021</small> -->
                            <p class="ft16">Diposting Pada Tanggal {{$postingan->created_at}}</p>
                        </div>
                        <hr>
                        <div class="mb-4 form-group">
                            <p class="text18">Bidang Pekerjaan: {{$postingan->bidang_pekerjaan->bidang_pekerjaan}}</p>
                        </div>
                        <hr>

                        <h4 class="mb-3">
                            <i class="bi bi-people"></i>
                            <b>Dibutuhkan</b>
                        </h4>
                        <ul class="text18">
                            <li>{{$postingan->employee}}</li>
                        </ul>

                        <h4 class="mb-3">
                            <i class="bi bi-briefcase"></i>
                            <b>Deskripsi Pekerjaan</b>
                        </h4>
                        <ul class="text18" style="list-style: ;">
                            <li>
                            {{$postingan->deskripsi_pekerjaan}}
                            </li>
                        </ul>

                        <h4 class="mb-3">
                            <i class="bi bi-file-earmark-text"></i>
                            <b>Persyaratan</b>
                        </h4>
                        <ul class="text18">
                            <li>{{$postingan->persyaratan}}</li>
                            
                        </ul class="text18">
                        <div class="d-grid d-md-flex justify-content-md-end">
                            <p class="ft16">Berakhir Pada Tanggal {{$postingan->masa_berakhir}}</p>
                        </div>
                    </div>
                </div>

            </div>
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
