<!doctype html>
<html lang="en">
    <head>
        @include('company.layouts.top')
    </head>
    <body class="bg-light">
        @include('company.layouts.navigation')
        <section class="p-5">
            <div class="container p-5">
                @if(session()->get('sukses'))
                    <div class="alert alert-success">
                        {{session()->get('sukses')}}
                    </div>
                    <br>
                @elseif(session()->get('gagal'))
                    <div class="alert alert-danger">
                        {{session()->get('gagal')}}
                    </div>
                    <br>
                @endif
                
                <div class="row justify-content-center">
                    <div class="mb-3">
                        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="/" class="text-decoration-none">Beranda</a></li>
                              <li class="breadcrumb-item"><a href="/home" class="text-decoration-none">Lowongan</a></li>
                              <li class="breadcrumb-item active" aria-current="page">Status</li>
                            </ol>
                        </nav>
                    </div>
                    @if($post->count() == 0)
                    <div class="col-lg-7">
                        <div class="card p-4">
                            <div class="card-body">
                                <div class="text-center text-warning mb-4">
                                    <i class="bi bi-emoji-frown display-1"></i>
                                </div>
                                <p class="small text-center">Sepertinya anda belum membuat lowongan magang<br>Silahkan buat lowongan magang anda</p>
                                
                                <div class="d-grid col-3 mx-auto">
                                    <a class="btn btn-primary" href="{{route('lowongan.create')}}"><i class="bi bi-plus-square"></i> Klik di sini</a>
                                </div>
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
                        @endif
                        @if(session()->get('sukses'))
                        <div class="alert alert-success">
                            {{session()->get('sukses')}}
                        </div>
                        @endif
                        <div class="card p-4">
                            <div class="card-body">
                                <div class="row">
                                    <h3 class="text-center mb-4"><strong>STATUS LOWONGAN</strong></h3>
                                    <div class="col-md-12">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr class="table-secondary text-center">
                                                    <th>No</th>
                                                    <th>Nama Lowongan</th>
                                                    <th>Status</th>
                                                    <th>Masa Berakhir</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            @if($fitur_cari->count() == 0)
                                            <tbody>
                                                @foreach($post as $postingans)
                                                <tr class="text-center">
                                                    <td>{{$no++}}</td>
                                                    <td>{{$postingans->judul_pekerjaan}}</td>
                                                    @if($postingans->pelamar == null)
                                                    <td>0 orang</td>
                                                    @else
                                                    <td>{{$postingans->pelamar}}</td>
                                                    @endif
                                                    <td>{{$postingans->masa_berakhir}}</td>

                                                    <td>
                                                        <a class="btn btn-success" href="{{route('lamaran.show', $postingans->id)}}">View</a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                                
                                            </tbody>
                                            @else
                                            <tbody>
                                                @foreach($fitur_cari as $postingans)
                                                <tr class="text-center">
                                                    <td>{{$no++}}</td>
                                                    <td>{{$postingans->judul_pekerjaan}}</td>
                                                    @if($postingans->pelamar == null)
                                                    <td>0 orang</td>
                                                    @else
                                                    <td>{{$postingans->pelamar}}</td>
                                                    @endif
                                                    <td>{{$postingans->masa_berakhir}}</td>

                                                    <td>
                                                        <a class="btn btn-success" href="{{route('lamaran.show', $postingans->id)}}">View</a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                                
                                            </tbody>
                                            @endif
                                        </table>
                                        
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        {{$fitur_cari->links('layouts.pagination')}}
                    </div>
                    @endif
                </div>
            </div>
        </section>

        @include('company.layouts.footer')
        @include('company.layouts.bottom')
    </body>
</html>