<!doctype html>
<html lang="en">
    <head>
        @include('company.layouts.top')
    </head>
    <body class="bg-light">
        @include('company.layouts.navigation')
        <section class="p-5">
            <div class="container p-5">
                <div class="row">
                    <div class="mb-3">
                        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="/" class="text-decoration-none">Beranda</a></li>
                              <li class="breadcrumb-item"><a href="/home" class="text-decoration-none">Lowongan</a></li>
                              <li class="breadcrumb-item"><a href="{{route('lamaran.index')}}" class="text-decoration-none">Status</a></li>
                              <li class="breadcrumb-item active" aria-current="page">{{$postingan->judul_pekerjaan}}</li>
                            </ol>
                        </nav>
                    </div>
                    <!-- <p class="ft16" id="hasilCari">Hasil penelusuran n</p> -->
                    <!-- <div class="col-md-8">
                        <h4>Status Lowongan</h4>
                    </div>
                    <div class="col-md-8">
                        <h4>Status Lowongan</h4>
                    </div> -->
                    <!-- <select class="col-md-2 me-2 ms-5" name="filter" id="filter">
                        <option value="1">Terbaru</option>
                        <option value="2">Terlama</option>
                        <option value="2">Aktif</option>
                        <option value="2">Tidak Aktif</option>
                    </select> -->
                    <!-- <a href="">Dashboard</a><a href="">s</a> -->
                    <!-- <button class="btn btn-primary col-md-1" id="submit-filter">Filter</button> -->
                    <div class="col-lg-12">
                        @if($keywoard != null)
                        <p class="ft16">Hasil penelusuran <b>{{$keywoard}}</b></p>
                        
                        @endif
                        
                        @if($fitur_cari->count()==0 && $keywoard != null)
                        <div class="alert alert-danger mb-1 text-center" role="alert">
                            Maaf nama pekerjaan <b>"{{$keywoard}}"</b> tidak ditemukan <i class="bi bi-emoji-frown"></i>
                        </div>
                        @endif
                        <div class="card p-4">
                            <div class="card-body">
                                <div class="row">
                                    <h3 class="text-center mb-2"><strong>{{$postingan->judul_pekerjaan}}</strong></h3>
                                    <h5 id="waktusisa" class="text-center mb-4"></h5>
                                    <script>
                                        var hari = 5;
                                        var tahun = 2021;
                                        var bulan = 10;

                                        var countDownDate = new Date("{{$setformat2}}").getTime();

                                        var x = setInterval(function() {

                                            var now = new Date().getTime();
                                                
                                            // Temukan jarak antara sekarang dan tanggal hitung mundur
                                            var distance = countDownDate - now;
                                            var terima = document.querySelectorAll(".btn-success");
                                            var tolak = document.querySelectorAll(".btn-danger");
                                                
                                            // Perhitungan waktu untuk hari, jam, menit dan detik
                                            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                                            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                                            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                                            var seconds = Math.floor((distance % (1000 * 60)) / 1000);
                                                
                                            // Keluarkan hasil dalam elemen dengan id = "demo"
                                            document.getElementById("waktusisa").innerHTML = days + "hari " + hours + "jam "
                                            + minutes + "menit " + seconds + "detik ";
                                                
                                            // Jika hitungan mundur selesai, tulis beberapa teks 
                                            if (distance < 0) {
                                                clearInterval(x);
                                                document.getElementById("waktusisa").innerHTML = "EXPIRED";
                                                for(i = 0; i < terima.length; i++ ){
                                                    terima[i].classList.add("disabled");
                                                    tolak[i].classList.add("disabled");
                                                }
                                            }
                                        }, 1000);
                                    </script>
                                    
                                    <div class="col-md-12">
                                        @if($pelamar != null)
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr class="table-secondary text-center">
                                                    <th>No</th>
                                                    <th>Nama</th>
                                                    <th>Email</th>
                                                    <th>Telepon</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            @if($fitur_cari->count() == 0)
                                            <tbody>
                                                @foreach($lamaran as $i => $lamarans)
                                                <tr>
                                                    <td class="text-center">{{$no++}}.</td>
                                                    <!-- <td><a class="text-decoration-none" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal{{$i}}">{{$lamarans->nama}}</a></td> -->
                                                    <td><a href="/home/status/lamaran/{{$lamarans->id}}/{{$linkpelamar}}/{{$lamarans->nama}}" id="showuser{{$no}}" class="text-decoration-none">{{$lamarans->nama}}</a></td>
                                                    <td>{{$lamarans->email}}</td>
                                                    <td>{{$lamarans->telepon}}</td>
                                                    <!-- telepon -->
                                                    <!-- email -->
                                                    <td>
                                                        @if($lamarans->status_lamaran == 'diterima')
                                                        <a class="btn btn-success disabled d-flex justify-content-center">diterima</a>
                                                        @elseif($lamarans->status_lamaran == 'ditolak')
                                                        <a class="btn btn-danger disabled d-flex justify-content-center">ditolak</a>
                                                        @else
                                                        <div class="d-flex justify-content-center">
                                                            <!-- <form action="{{route('lamaran.diterima', $lamarans->id)}}" method="post">
                                                                @csrf
                                                                @method('PATCH')
                                                                <button class="btn btn-success me-1" type="submit">Terima</button>
                                                            </form> -->
                                                            <button class="btn btn-success me-1" type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{$no}}">Terima</button>
                                                            <div class="modal fade" id="staticBackdrop{{$no}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered">
                                                                    <div class="modal-content">
                                                                        <div class="p-3">
                                                                            <div class="d-flex justify-content-center h1 py-4">
                                                                                <i class="bi bi-exclamation-triangle display-1 text-warning"></i>
                                                                            </div>
                                                                            <div class="d-flex justify-content-center">
                                                                                <h3 class="px-5 text-dark">Apakah kamu yakin ingin menerima lamaran {{$lamarans->nama}}?</h3>
                                                                            </div>
                                                                            <div class="d-flex justify-content-evenly p-3">
                                                                                <button class="btn btn-primary py-3 px-4" data-bs-dismiss="modal" aria-label="Close">Batal</button>
                                                                                <form action="{{route('lamaran.diterima', $lamarans->id)}}" method="post">
                                                                                    @csrf
                                                                                    @method('PATCH')
                                                                                    <button type="submit" class="btn btn-success py-3 px-4">Terima</button>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <button class="btn btn-danger me-1" type="button" data-bs-toggle="modal" data-bs-target="#tolak{{$no}}">Tolak</button>
                                                            <div class="modal fade" id="tolak{{$no}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered">
                                                                    <div class="modal-content">
                                                                        <div class="p-3">
                                                                            <div class="d-flex justify-content-center py-4">
                                                                                <i class="bi bi-exclamation-triangle display-1 text-warning"></i>
                                                                            </div>
                                                                            <div class="d-flex justify-content-center">
                                                                                <h4 class="px-5 fw-bold text-center text-dark">Apakah kamu yakin ingin menolak lamaran {{$lamarans->nama}}?</h4>
                                                                            </div>
                                                                            <div class="d-flex justify-content-evenly p-3">
                                                                                <button class="btn btn-primary py-3 px-4" data-bs-dismiss="modal" aria-label="Close">Batal</button>
                                                                                <form action="{{route('lamaran.ditolak', $lamarans->id)}}" method="post">
                                                                                    @csrf
                                                                                    @method('PATCH')
                                                                                    <button type="submit" class="btn btn-danger py-3 px-4">Tolak</button>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- <form action="{{route('lamaran.ditolak', $lamarans->id)}}" method="post">
                                                                @csrf
                                                                @method('PATCH')
                                                                <button class="btn btn-danger ms-1" type="submit">Tolak</button>
                                                            </form> -->
                                                        </div>
                                                        @endif
                                                        
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                            @else
                                            <tbody>
                                                @foreach($fitur_cari as $i => $lamarans)
                                                <tr>
                                                    <td class="text-center">{{$no++}}.</td>
                                                    <!-- <td><a class="text-decoration-none" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal{{$i}}">{{$lamarans->nama}}</a></td> -->
                                                    <td><a href="/home/status/lamaran/{{$lamarans->id}}/{{$linkpelamar}}/{{$lamarans->nama}}" id="showuser{{$no}}" class="text-decoration-none">{{$lamarans->nama}}</a></td>
                                                    <td>{{$lamarans->email}}</td>
                                                    <td>{{$lamarans->telepon}}</td>
                                                    <!-- telepon -->
                                                    <!-- email -->
                                                    <td>
                                                        @if($lamarans->status_lamaran == 'diterima')
                                                        <a class="btn btn-success disabled d-flex justify-content-center">diterima</a>
                                                        @elseif($lamarans->status_lamaran == 'ditolak')
                                                        <a class="btn btn-danger disabled d-flex justify-content-center">ditolak</a>
                                                        @else
                                                        <div class="d-flex justify-content-center">
                                                            <!-- <form action="{{route('lamaran.diterima', $lamarans->id)}}" method="post">
                                                                @csrf
                                                                @method('PATCH')
                                                                <button class="btn btn-success me-1" type="submit">Terima</button>
                                                            </form> -->
                                                            <button class="btn btn-success me-1" type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{$no}}">Terima</button>
                                                            <div class="modal fade" id="staticBackdrop{{$no}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered">
                                                                    <div class="modal-content">
                                                                        <div class="p-3">
                                                                            <div class="d-flex justify-content-center h1 py-4">
                                                                                <i class="bi bi-exclamation-triangle display-1 text-warning"></i>
                                                                            </div>
                                                                            <div class="d-flex justify-content-center">
                                                                                <h3 class="px-5 text-dark">Apakah kamu yakin ingin menerima lamaran {{$lamarans->nama}}?</h3>
                                                                            </div>
                                                                            <div class="d-flex justify-content-evenly p-3">
                                                                                <button class="btn btn-primary py-3 px-4" data-bs-dismiss="modal" aria-label="Close">Batal</button>
                                                                                <form action="{{route('lamaran.diterima', $lamarans->id)}}" method="post">
                                                                                    @csrf
                                                                                    @method('PATCH')
                                                                                    <button type="submit" class="btn btn-success py-3 px-4">Terima</button>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <button class="btn btn-danger me-1" type="button" data-bs-toggle="modal" data-bs-target="#tolak{{$no}}">Tolak</button>
                                                            <div class="modal fade" id="tolak{{$no}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered">
                                                                    <div class="modal-content">
                                                                        <div class="p-3">
                                                                            <div class="d-flex justify-content-center py-4">
                                                                                <i class="bi bi-exclamation-triangle display-1 text-warning"></i>
                                                                            </div>
                                                                            <div class="d-flex justify-content-center">
                                                                                <h4 class="px-5 fw-bold text-center text-dark">Apakah kamu yakin ingin menolak lamaran {{$lamarans->nama}}?</h4>
                                                                            </div>
                                                                            <div class="d-flex justify-content-evenly p-3">
                                                                                <button class="btn btn-primary py-3 px-4" data-bs-dismiss="modal" aria-label="Close">Batal</button>
                                                                                <form action="{{route('lamaran.ditolak', $lamarans->id)}}" method="post">
                                                                                    @csrf
                                                                                    @method('PATCH')
                                                                                    <button type="submit" class="btn btn-danger py-3 px-4">Tolak</button>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- <form action="{{route('lamaran.ditolak', $lamarans->id)}}" method="post">
                                                                @csrf
                                                                @method('PATCH')
                                                                <button class="btn btn-danger ms-1" type="submit">Tolak</button>
                                                            </form> -->
                                                        </div>
                                                        @endif
                                                        
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                            @endif
                                        </table>
                                        @else
                                        <div class="text-center mb-4">
                                            <h1 class="text-warning"><i class="bi bi-emoji-frown"></i></h1>
                                        </div>
                                        <p class="small text-center">Mohon maaf<br>Sepertinya belum ada user yang melamar postingan ini</p>
                                        
                                        @endif
                                        {{$fitur_cari->links('layouts.pagination')}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        @include('company.layouts.footer')
        @include('company.layouts.bottom')
    </body>
</html>