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
              <h1 class="m-0">Dashboard Perusahaan</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/home">Beranda</a></li>
                <li class="breadcrumb-item"><a href="{{route('perusahaan.index')}}">Dashboard Perusahaan</a></li>
                <li class="breadcrumb-item active">Data Perusahaan</li>
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
              <div class="card p-4 mt-5">
                  <div class="card-body">
                      <div class="text-center text-warning mb-4">
                          <i class="bi bi-emoji-frown display-1"></i>
                      </div>
                      <p class="ft16 text-center">Sepertinya belum ada user yang mendaftar<br>Silahkan daftarkan user anda</p>
                      
                      <div class="d-grid col-3 mx-auto">
                          <a class="btn btn-primary" href="{{route('data_perusahaan.create')}}"><i class="bi bi-person-plus-fill"></i> Klik di sini</a>
                      </div>
                  </div>
              </div>
            </div>
            @else
            
            <div class="col-md-12">
              @if(session()->get('sukses'))
              <div class="alert alert-success">
                  {{session()->get('sukses')}}
              </div>
              @elseif(session()->get('hapus'))
              <div class="alert alert-danger">
                  {{session()->get('hapus')}}
              </div>
              @endif

              @if($fitur_cari->count() == 0)
              <div class="alert alert-danger mb-1 text-center" role="alert">
                Maaf hasil cari <b>"{{$keywoard}}"</b> tidak ditemukan <i class="bi bi-emoji-frown"></i>
              </div>
              @endif

              @if($keywoard != null)
              <p class="ft16">Hasil penelusuran <b>{{$keywoard}}</b></p>
              @endif
              <div class="card p-4">

                <div class="d-flex justify-content-between">
                  <div class="col-md-5 p-0">
                    <a href="{{route('data_perusahaan.create')}}" class="btn btn-success mb-3"><i class="bi bi-plus-square-fill"></i> Tambah</a>
                  </div>
                  <div class="col-md-2">
                  </div>
                  <div class="col-md-5 p-0">
                    <div class="d-flex justify-content-end">
                      <form action="" method="get" class="col-md-12 p-0">
                      <!-- <form action="javascript:sort('desc')" method="get" class="col-md-3"> -->
                        <div class="d-flex justify-content-end">
                          <div class="col-md-6">
                            <select name="verified" id="verified"  class="form-control filter">
                              <option value="" disabled hidden selected>Pilih<i class="bi bi-caret-down-fill"></i></option>
                              <option value="=">Belum Verifikasi<i class="bi bi-caret-down-fill"></i></option>
                              <option value="!=">Telah Verifikasi<i class="bi bi-caret-down-fill"></i></option>
                            </select>
                          </div>
                          <div class="">
                            <button type="submit" class="btn btn-primary">filter</button>
                          </div>
                        </div>
                        <br>
                      </form>
                    </div>
                  </div>
                </div>

                <table class="table table-bordered">
                  <thead>
                    <tr class="table-secondary text-center">
                      <th>No.</th>
                      <th>Id</th>
                      <th>
                        <div class="d-flex justify-content-center">
                          <div class="col-md-10">Nama</div>
                          @if(Request::query('sortname') && Request::query('sortname') == 'asc')
                            <a href="javascript:sort('desc')"><i class="fa fa-sort-down text-dark"></i></a>
                          @elseif(Request::query('sortname') && Request::query('sortname') == 'desc')
                            <a href="javascript:sort('asc')"><i class="fa fa-sort-up text-dark"></i></a>
                          @else
                            <a href="javascript:sort('desc')"><i class="fa fa-sort text-dark"></i></a>
                          @endif
                        </div>
                      </th>
                      <th>Email</th>
                      <th>Verifikasi Email</th>
                      <th>Role</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>

                  @if($fitur_cari->count() == 0)
                  <tbody>
                    @foreach($user as $i => $users)
                    <tr>
                        <td class="text-center">{{$no++}}.</td>
                        <td class="text-center">{{$users->id}}</td>
                        <td class="text-center">{{$users->name}}</td>
                        <td class="text-center">{{$users->email}}</td>
                        <td class="text-center">
                            @if($users->email_verified_at == null)
                            Belum verifikasi
                            @else
                            {{$users->email_verified_at}}
                            @endif
                        </td>
                        <td class="text-center">
                            @if($users->role == 'super admin')
                            <span class="badge bg-danger">super admin</span>
                            @else
                            <span class="badge bg-success">{{$users->role}}</span>
                            @endif
                        </td>
                        <td>
                            @if($users->role == 'super admin')
                            <div class="d-grid mx-4 gap-2">
                              <a href="{{route('data_perusahaan.edit', $users->id)}}" class="btn btn-primary">Edit</a>
                            </div>
                            @else
                            <div class="d-flex justify-content-evenly">
                              <a href="{{route('data_perusahaan.edit', $users->id)}}" class="btn btn-primary px-4">Edit</a>
                              <button type="button" class="btn btn-danger px-3" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{$no}}">Hapus</button>
                              <div class="modal fade" id="staticBackdrop{{$no}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                  <div class="modal-content">
                                    <div class="p-3">
                                      <div class="d-flex justify-content-center h1 py-4">
                                        <i class="bi bi-exclamation-triangle text-warning"></i>
                                      </div>
                                      <div class="d-flex justify-content-center">
                                        <h3 class="px-5">Apakah kamu yakin ingin menghapus akun {{$users->name}}?</h3>
                                      </div>
                                      <div class="d-flex justify-content-evenly p-3">
                                        <button class="btn btn-primary py-3 px-4" data-bs-dismiss="modal" aria-label="Close">Batal</button>
                                        <form action="{{route('data_perusahaan.destroy', $users->id)}}" method="post">
                                          @csrf
                                          @method('DELETE')
                                          <button type="submit" class="btn btn-danger py-3 px-4">Hapus</button>
                                        </form>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                  </tbody>
                  @else
                  <tbody>
                    @foreach($fitur_cari as $i => $users)
                    <tr>
                        <td class="text-center">{{$no++}}.</td>
                        <td class="text-center">{{$users->id}}</td>
                        <td class="text-center">{{$users->name}}</td>
                        <td class="text-center">{{$users->email}}</td>
                        <td class="text-center">
                            @if($users->email_verified_at == null)
                            Belum verifikasi
                            @else
                            {{$users->email_verified_at}}
                            @endif
                        </td>
                        <td class="text-center">
                            @if($users->role == 'super admin')
                            <span class="badge bg-danger">super admin</span>
                            @else
                            <span class="badge bg-success">{{$users->role}}</span>
                            @endif
                        </td>
                        <td>
                            @if($users->role == 'super admin')
                            <div class="d-grid mx-4 gap-2">
                              <a href="{{route('data_perusahaan.edit', $users->id)}}" class="btn btn-primary">Edit</a>
                            </div>
                            @else
                            <div class="d-flex justify-content-evenly">
                              <a href="{{route('data_perusahaan.edit', $users->id)}}" class="btn btn-primary px-4">Edit</a>
                              <button type="button" class="btn btn-danger px-3" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{$no}}">Hapus</button>
                              <div class="modal fade" id="staticBackdrop{{$no}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                  <div class="modal-content">
                                    <div class="p-3">
                                      <div class="d-flex justify-content-center h1 py-4">
                                        <i class="bi bi-exclamation-triangle text-warning"></i>
                                      </div>
                                      <div class="d-flex justify-content-center">
                                        <h3 class="px-5">Apakah kamu yakin ingin menghapus akun {{$users->name}}?</h3>
                                      </div>
                                      <div class="d-flex justify-content-evenly p-3">
                                        <button class="btn btn-primary py-3 px-4" data-bs-dismiss="modal" aria-label="Close">Batal</button>
                                        <form action="{{route('data_perusahaan.destroy', $users->id)}}" method="post">
                                          @csrf
                                          @method('DELETE')
                                          <button type="submit" class="btn btn-danger py-3 px-4">Hapus</button>
                                        </form>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            @endif
                        </td>
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
<script>
  var query=<?php echo json_encode((object)Request::query()); ?>;
  window.setTimeout(function() {
      $(".alert").fadeTo(500, 0).slideUp(500, function(){
          $(this).remove(); 
      });
  }, 4000);

  function sort(value){
    Object.assign(query, {'sortname' : value});

    window.location.href = "{{route('data_perusahaan.index')}}?"+$.param(query);
  }

  let cekverif = $('#verified').val()
  // const table = $('#table').DataTable({
  //   "ajax" : {
  //     url: "{{route('data_user.index')}}",
  //     type: "POST",
  //     data: function(d){
  //       d.cekverif = cekverif;

  //       return d
  //     }
  //   }
  // });


  
  $(".filter").on('change', function(){
      cekverif = $('#verified').val()
      // table.ajax.reload(null,false)
      console.log([cekverif])
  })
</script>
</html>
