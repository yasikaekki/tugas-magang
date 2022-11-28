<!doctype html>
<html lang="en">
    <head>
        @include('company.layouts.toppost')
    </head>
    <body class="bg-light">
        @include('company.layouts.navigation')
        <section class="p-5">
            <div class="container p-5">
                <div class="row d-flex justify-content-center">
                    <div class="mb-3">
                        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="/" class="text-decoration-none">Beranda</a></li>
                              <li class="breadcrumb-item"><a href="/home" class="text-decoration-none">Lowongan</a></li>
                              <li class="breadcrumb-item active" aria-current="page">{{$postingan->judul_pekerjaan}}</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-lg-8">

                        @if(session()->get('sukses'))
                        <div class="alert alert-success">
                            {{session()->get('sukses')}}
                        </div>
                        @endif

                        <div class="card p-4">
                            <div class="card-body">
                                <h3 class="mb-4"><b>{{$postingan->judul_pekerjaan}}</b></h3>
                                <div class="d-grid d-md-block mb-3">
                                    <small>Diposting Pada Tanggal {{$postingan->created_at}}</small>
                                </div>
                                <hr>
                                <div class="mb-4 form-group">
                                    <p class="ft16">Bidang Pekerjaan: {{$postingan->bidang_pekerjaan->bidang_pekerjaan}}</p>
                                </div>
                                <hr>

                                <h5 class="h5 mb-3">
                                    <i class="bi bi-people"></i>
                                    <b>Dibutuhkan</b>
                                </h5>
                                <ul class="ft16">
                                    <li>{{$postingan->employee}}</li>
                                </ul>

                                <h5 class="h5 mb-3">
                                    <i class="bi bi-briefcase"></i>
                                    <b>Deskripsi Pekerjaan</b>
                                </h5>
                                <ul class="ft16">
                                    <li>
                                    {{$postingan->deskripsi_pekerjaan}}
                                    </li>
                                </ul>

                                <h5 class="h5 mb-3">
                                    <i class="bi bi-file-earmark-text"></i>
                                    <b>Persyaratan</b>
                                </h5>
                                <ul class="ft16">
                                    <li>{{$postingan->persyaratan}}</li>
                                    
                                </ul class="ft16">
                                <div class="d-grid d-md-flex justify-content-md-end">
                                    <small>Berakhir Pada Tanggal {{$postingan->masa_berakhir}}</small>
                                </div>
                            </div>
                        </div>
                        <div class="card p-4 mb-4">
                            <div class="d-flex justify-content-start">
                                <div class="d-flex align-items-center me-2">
                                    <a href="{{route('lowongan.edit', $postingan->id)}}" class="btn btn-primary">Edit</a>
                                </div>
                                <div class="d-flex align-items-center">
                                    <button class="btn btn-danger" type="submit" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Hapus</button>
                                    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                          <div class="modal-content">
                                            <div class="p-3">
                                              <div class="d-flex justify-content-center py-4">
                                                <i class="bi bi-exclamation-triangle text-warning display-1"></i>
                                              </div>
                                              <div class="d-flex justify-content-center">
                                                <h4 class="text-dark text-center fw-bold px-5">Apakah kamu yakin ingin menghapus postingan ini ?</h4>
                                              </div>
                                              <div class="d-flex justify-content-evenly p-3">
                                                <button class="btn btn-primary py-3 px-4" data-bs-dismiss="modal" aria-label="Close">Batal</button>
                                                <form action="{{route('lowongan.destroy', $postingan->id)}}" method="post">
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
                            </div>
                        </div>                                         
                    </div>

                    <div class="col-lg-4">
                        <div class="card-header p-3">
                            <h5 class="text-center text18"><b>Profil Perusahaan</b></h5>
                        </div>
                        
                        @foreach($perusahaan as $perusahaans)
                        <div class="card p-4">
                            <div class="card-body">
                                <div class="mb-4 form-group">
                                    <img src="/imagesPerusahaan/{{$perusahaans->ubah_foto}}" class="img-responsive imghw100 mw-100 mb-4" alt="Logo">
                                    
                                    <h5 class="text18 text-center mb-4"><b>{{$perusahaans->nama_perusahaan}}</b></h5>
                                    <hr>
                                    
                                    <medium class="text-muted">Tentang:</medium>
                                    <p class="ft16 mb-3">{{$perusahaans->tentang_perusahaan}}</p>
                                    <hr>
    
                                    <medium class="text-muted">No. NPWP Perusahaan:</medium>
                                    <p class="ft16 mb-3">{{$perusahaans->no_npwp}}</p>
    
                                    <medium class="text-muted">Telepon Perusahaan:</medium>
                                    <p class="ft16 mb-3">{{$perusahaans->telepon}}</p>
    
                                    <p class="ft16 text-muted mb-3">Industri:<br>{{$perusahaans->industri}}</p>                                
                                    <p class="ft16 text-muted mb-3">Jumlah Karyawan:<br>{{$perusahaans->jumlah_karyawan}}</p>
                                
                                    <hr>
                                    
                                    <div class="row">       
                                        <medium class="text-muted mb-2">Lokasi:</medium>
                                        <p class="text14">{{$perusahaans->alamat_perusahaan}}</p>
                                        <iframe width="100%" height="250" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.google.com/maps?q={{$perusahaans->nama_perusahaan}}&hl=es;z=14&output=embed"></iframe>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        @endforeach
                        
                    </div>
                </div>
            </div>
        </section>
        
        @include('company.layouts.footer')
        @include('company.layouts.bottom')
    </body>
</html>