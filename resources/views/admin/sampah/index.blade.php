<!DOCTYPE html>
<html lang="en">
<head>
  @include('admin.layouts.top')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">
    @include('admin.layouts.navigation')

    
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header mt-5">
        <div class="container-fluid mt-4">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Daftar Sampah</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/home">Beranda</a></li>
                <li class="breadcrumb-item active">Sampah</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          @if(session()->get('restore'))
          <div class="alert alert-success">
              {{session()->get('restore')}}
          </div>
          @elseif(session()->get('delete'))
          <div class="alert alert-danger">
              {{session()->get('delete')}}
          </div>
          @endif
          <!-- Small boxes (Stat box) -->
          <div class="row d-flex justify-content-center">
            @if($sampah->count() == 0)
            <div class="col-lg-7">
              <div class="card mt-5 p-5">
                <div class="card-body p-4">
                  <div class="text-center text-warning mb-4">
                    <i class="bi bi-emoji-frown display-1"></i>
  
                  </div>
                  <p class="ft16 text-center">Mohon maaf<br>Sepertinya belum ada yang terhapus</p>
                </div>
                  
              </div>
            </div>
            @else
            @php
                $no = 1;
            @endphp
            <div class="col-md-12">
              @if($keywoard != null)
                <p class="ft16">Hasil penelusuran <b>{{$keywoard}}</b></p>
              @endif

              @if($fitur_cari->count() == 0)
              <div class="alert alert-danger mb-1 text-center" role="alert">
                Maaf nama <b>"{{$keywoard}}"</b> tidak ditemukan <i class="bi bi-emoji-frown"></i>
              </div>
              @endif
              <div class="card p-4">
                <table class="table table-bordered">
                  <thead>
                    <tr class="table-secondary text-center">
                      <th>No.</th>
                      <th>Nama</th>
                      <th>Email</th>
                      <th>Role</th>
                      <th>Tanggal Terhapus</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  @if($fitur_cari->count() == 0)
                  <tbody>
                      @foreach($sampah as $allsampah)
                      <tr class="text-center">
                          <td>{{$no++}}</td>
                          <td>{{$allsampah->name}}</td>
                          <td>{{$allsampah->email}}</td>
                          <td>{{$allsampah->role}}</td>
                          <td>{{$allsampah->deleted_at}}</td>
                          <td>
                            <div class="d-flex justify-content-evenly">
                              <button type="button" class="btn btn-success px-3" data-bs-toggle="modal" data-bs-target="#restore{{$no}}">Pulihkan</button>
                              <button type="button" class="btn btn-danger px-3" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{$no}}">Hapus Permanen</button>
                              <div class="modal fade" id="restore{{$no}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                  <div class="modal-content">
                                    <div class="p-3">
                                      <div class="d-flex justify-content-center h1 py-4">
                                        <i class="bi bi-exclamation-triangle text-warning"></i>
                                      </div>
                                      <div class="d-flex justify-content-center">
                                        <h3 class="px-5">Apakah kamu yakin ingin menghapus akun {{$allsampah->name}}?</h3>
                                      </div>
                                      <div class="d-flex justify-content-evenly p-3">
                                        <button class="btn btn-primary py-3 px-4" data-bs-dismiss="modal" aria-label="Close">Batal</button>
                                        <form action="{{route('restore.store', $allsampah->id, $allsampah->name)}}" method="post">
                                          @csrf
                                          <button type="submit" class="btn btn-success py-3 px-4">Konfirmasi</button>
                                        </form>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="modal fade" id="staticBackdrop{{$no}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                  <div class="modal-content">
                                    <div class="p-3">
                                      <div class="d-flex justify-content-center h1 py-4">
                                        <i class="bi bi-exclamation-triangle text-warning"></i>
                                      </div>
                                      <div class="d-flex justify-content-center">
                                        <h3 class="px-5">Apakah kamu yakin ingin menghapus akun {{$allsampah->name}}?</h3>
                                      </div>
                                      <div class="d-flex justify-content-evenly p-3">
                                        <button class="btn btn-primary py-3 px-4" data-bs-dismiss="modal" aria-label="Close">Batal</button>
                                        <form action="{{route('forcedelete.destroy', $allsampah->id)}}" method="post">
                                          @csrf
                                          @method('DELETE')
                                          <button type="submit" class="btn btn-danger py-3 px-4">Konfirmasi</button>
                                        </form>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </td>
                      </tr>
                      @endforeach
                  </tbody>
                  @else
                  <tbody>
                    @foreach($fitur_cari as $allsampah)
                    <tr class="text-center">
                        <td>{{$no++}}</td>
                        <td>{{$allsampah->name}}</td>
                        <td>{{$allsampah->email}}</td>
                        <td>{{$allsampah->role}}</td>
                        <td>{{$allsampah->deleted_at}}</td>
                        <td>
                          <div class="d-flex justify-content-evenly">
                            <button type="button" class="btn btn-success px-3" data-bs-toggle="modal" data-bs-target="#restore{{$no}}">Pulihkan</button>
                            <button type="button" class="btn btn-danger px-3" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{$no}}">Hapus Permanen</button>
                            <div class="modal fade" id="restore{{$no}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                              <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                  <div class="p-3">
                                    <div class="d-flex justify-content-center h1 py-4">
                                      <i class="bi bi-exclamation-triangle text-warning"></i>
                                    </div>
                                    <div class="d-flex justify-content-center">
                                      <h3 class="px-5">Apakah kamu yakin ingin memulihkan akun {{$allsampah->name}}?</h3>
                                    </div>
                                    <div class="d-flex justify-content-evenly p-3">
                                      <button class="btn btn-primary py-3 px-4" data-bs-dismiss="modal" aria-label="Close">Batal</button>
                                      <form action="{{route('restore.store', $allsampah->id, $allsampah->name)}}" method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-success py-3 px-4">Konfirmasi</button>
                                      </form>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="modal fade" id="staticBackdrop{{$no}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                              <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                  <div class="p-3">
                                    <div class="d-flex justify-content-center h1 py-4">
                                      <i class="bi bi-exclamation-triangle text-warning"></i>
                                    </div>
                                    <div class="d-flex justify-content-center">
                                      <h3 class="px-5">Apakah kamu yakin ingin menghapus akun {{$allsampah->name}}?</h3>
                                    </div>
                                    <div class="d-flex justify-content-evenly p-3">
                                      <button class="btn btn-primary py-3 px-4" data-bs-dismiss="modal" aria-label="Close">Batal</button>
                                      <form action="{{route('forcedelete.destroy', $allsampah->id)}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger py-3 px-4">Konfirmasi</button>
                                      </form>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
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

    <!-- Modal -->
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
  window.setTimeout(function() {
      $(".alert").fadeTo(500, 0).slideUp(500, function(){
          $(this).remove(); 
      });
  }, 4000);
</script>
</html>