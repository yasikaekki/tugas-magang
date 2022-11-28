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
              <h1 class="m-0">Dashboard User</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/home">Beranda</a></li>
                <li class="breadcrumb-item active">Dashboard User</li>
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
          <div class="row">
          @else
          <div class="row">

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
            <div class="col-lg-4 col-6">
              <!-- small box -->
              <div class="small-box bg-info">
                <div class="inner">
                  <h3>{{$jumlahuser}}</h3>

                  <p>Data User</p>
                </div>
                <div class="icon">
                  <i class="ion bi-person-fill"></i>
                  {{-- <i class="ion ion-bag"></i> --}}
                </div>
                <a href="{{route('data_user.index')}}" class="small-box-footer">selengkapnya  <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-4 col-6">
              <!-- small box -->
              <div class="small-box bg-warning">
                <div class="inner">
                  <h3>{{$jumlahbiodata}}</h3>

                  <p>Biodata User</p>
                </div>
                <div class="icon">
                  <i class="far fa-id-card"></i>
                </div>
                <a href="{{route('user_registrasi.index')}}" class="small-box-footer">selengkapnya  <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-4 col-6">
              <!-- small box -->
              <div class="small-box bg-dark">
                <div class="inner">
                  <h3>{{$jumlahaktivitas}}</h3>

                  <p>Aktivitas User</p>
                </div>
                <div class="icon">
                  <i class="fas fa-project-diagram"></i>
                  {{-- <i class="ion ion-person-add"></i> --}}
                </div>
                <a href="{{route('aktivitas_user.index')}}" class="small-box-footer">selengkapnya  <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
          </div>

        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
      <div id="grafik"></div>
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

<script src="https://code.highcharts.com/highcharts.js"></script>
<script type="text/javascript">
    var users =  <?php echo json_encode($chart) ?>;
    var activity =  <?php echo json_encode($chartactivity) ?>;
   
    Highcharts.chart('grafik', {
        title: {
            text: 'Grafik User'
        },
        subtitle: {
            text: ''
        },
         xAxis: {
            // categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
            // categories: ['senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu', 'minggu']
            categories: ['januari', 'februari', 'maret', 'april', 'mei', 'juni', 'juli', 'agustus', 'september', 'oktober', 'november', 'desember']
        },
        yAxis: {
            title: {
                text: 'Grafik User'
            }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle'
        },
        plotOptions: {
            series: {
                allowPointSelect: true
            }
        },
        series: [{
            name: 'User Baru',
            data: [0, 0, 0, 0, 0, 0, 0, 0, users]
        },{
            name: 'User Activity',
            data: [0, 0, 0, 0, 0, 0, 0, 0, activity]
        }],
        responsive: {
            rules: [{
                condition: {
                    maxWidth: 200
                },
                chartOptions: {
                    legend: {
                        layout: 'horizontal',
                        align: 'center',
                        verticalAlign: 'bottom'
                    }
                }
            }]
        }
});
</script>

</html>
