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
              <h1 class="m-0">Dashboard Admin</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/home">Beranda</a></li>
                <li class="breadcrumb-item active">Dashboard Admin</li>
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

          @endif
            <div class="col-lg-4 col-6">
              <!-- small box -->
              <div class="small-box bg-danger">
                <div class="inner">
                  <h3>{{$jumlahadmin}}</h3>

                  <p>Data Admin</p>
                </div>
                <div class="icon">
                  <i class="fas fa-user-tie"></i>
                  {{-- <i class="ion ion-bag"></i> --}}
                </div>
                <a href="{{route('data_admin.index')}}" class="small-box-footer">selengkapnya  <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-4 col-6">
              <!-- small box -->
              <div class="small-box bg-warning">
                <div class="inner">
                  <h3>{{$jumlahbiodata}}</h3>

                  <p>Biodata Admin</p>
                </div>
                <div class="icon">
                  <i class="far fa-id-card"></i>
                </div>
                <a href="{{route('admin_registrasi.index')}}" class="small-box-footer">selengkapnya  <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-4 col-6">
              <!-- small box -->
              <div class="small-box bg-dark">
                <div class="inner">
                  <h3>{{$jumlahaktivitas}}</h3>

                  <p>Aktivitas Admin</p>
                </div>
                <div class="icon">
                  <i class="fas fa-project-diagram"></i>
                  {{-- <i class="ion ion-person-add"></i> --}}
                </div>
                <a href="{{route('aktivitas_admin.index')}}" class="small-box-footer">selengkapnya  <i class="fas fa-arrow-circle-right"></i></a>
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
    var activity =  <?php echo json_encode($jumlahaktivitas) ?>;
   
    Highcharts.chart('grafik', {
        title: {
            text: 'Grafik Admin'
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
                text: 'Grafik Admin'
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
            name: 'Admin Baru',
            data: [0, 0, 0, 0, 0, 0, 0, 0, users]
        },{
            name: 'Admin Activity',
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
