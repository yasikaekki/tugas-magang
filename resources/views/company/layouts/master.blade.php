

<!doctype html>
<html lang="en">
    <head>
        @include('company.layouts.top')
    </head>
    <body class="bg-light">
        @include('company.layouts.navigation')
        <div class="p-4">
            <div class="container">
                <div class="mx-2 mb-2 jarak">
                    <div class="row d-flex justify-content-center">

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
                                       <a href="{{route('profil.edit',$userid)}}" class="btn btn-link p-0 m-0 text-decoration-none">klik disini</a>
                                    </div>
                                </div>
                            @endif
                        @endif

                    </div>
                    <div class="mt-4 mx-4">

                        @if($post->count() == 0)
                        <div class="row d-flex justify-content-center">
                            <div class="col-lg-7">
                                <div class="card p-4">
                                    <div class="card-body">
                                        <div class="text-center text-warning mb-4">
                                            <i class="bi bi-emoji-frown display-1"></i>
                                        </div>
                                        <p class="small text-center">Sepertinya anda belum membuat lowongan magang<br>Silahkan buat lowongan magang anda</p>
                                        
                                        <div class="d-grid col-3 mx-auto">
                                            <a class="btn btn-primary" href="{{route('lowongan.create')}}"><i class="bi bi-plus-square-fill"></i> Klik di sini</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @else

                        @if(session()->get('sukses'))
                        <div class="alert alert-success">
                            {{session()->get('sukses')}}
                        </div>
                        @endif

                        <div class="row">
                            <div class="mb-3">
                                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                      <li class="breadcrumb-item"><a href="/" class="text-decoration-none">Beranda</a></li>
                                      <li class="breadcrumb-item active" aria-current="page">Lowongan</li>
                                    </ol>
                                </nav>
                            </div>
                            @if($keywoard != null)
                            <p class="ft16">Hasil penelusuran <b>{{$keywoard}}</b></p>
                            @endif

                            <div class="col-md-8 me-4"></div>
                            <select class="col-md-2 me-2 ms-5" name="filter" id="filter">
                                <option value="1">Terbaru</option>
                                <option value="2">Terlama</option>
                            </select>
                            <button class="btn btn-primary col-md-1" id="submit-filter">Filter</button>
                            <div class="col-md-12 mt-5">
                                
                                @if($fitur_cari->count() == 0)
                                    <div class="alert alert-danger mb-1 text-center" role="alert">
                                        Maaf hasil cari <b>"{{$keywoard}}"</b> tidak ditemukan <i class="bi bi-emoji-frown"></i>
                                    </div>
                                    @foreach($post as $i => $posts)
                                    <div class="card">
                                        <div class="card-body">                                          
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="my-3 col-md-10">
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <img src="{{asset('imagesPerusahaan/'.$posts->foto)}}" class="rounded mx-auto d-block imghw100px" alt="" srcset="">
                                                                </div>
                                                                <div class="col-md-8">
                                                                    <a class="text-decoration-none" href="{{route('lowongan.show', $posts->id)}}">
                                                                        <h4>{{$posts->judul_pekerjaan}}</h4>
                                                                    </a>
                                                                    <p class="fw-bold">{{$posts->user->perusahaan->nama_perusahaan}}</p>
                                                                    <p>{{$posts->user->perusahaan->alamat_perusahaan}}</p>
                                                                    
                                                                    <p>{{$posts->deskripsi_pekerjaan}}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            {{-- <button class="btn border btn-sm col-xs-6 btn-primary border-primary" type="button" onclick="favoriteklik{{++$i}}()"><i class="bi bi-star-fill" id="bintang{{++$i -1}}" style="width: 100px; height: 100px;"><input hidden disabled id="putih{{++$i -2}}" type="text"></i></button> --}}
                                                            <button class="btn border btn-sm col-xs-6 btn-primary border-primary" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="bi bi-link"></i></button>
                                                        </div>

                                                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">

                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>

                                                                    <div class="modal-body">
                                                                    ...
                                                                    </div>

                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                        <button type="button" class="btn btn-primary">Salin link</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                                {{-- <script>
                                                    function favoriteklik{{++$i -3}}(){
                                                        var y = document.getElementById("bintang{{++$i -4}}");
                                                        var z = document.getElementById("putih{{++$i -5}}");
                                                        if (z.name == "hitam" | y.name == "terkirim") {
                                                            z.name = "putih";
                                                            y.classList.remove("text-warning");
                                                        } else{
                                                            z.name = "hitam";
                                                            y.classList.add("text-warning");
                                                        }
                                                    }
                                                </script> --}}
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach

                                @else

                                    @foreach($postingan as $posts)
                                    <div class="card">
                                        <div class="card-body">                                          
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="my-3 col-md-10">
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <img src="{{asset('imagesPerusahaan/'.$posts->foto)}}" class="rounded mx-auto d-block imghw100px" alt="" srcset="">
                                                                </div>
                                                                <div class="col-md-8">
                                                                    <a class="text-decoration-none" href="{{route('lowongan.show', $posts->id)}}">
                                                                        <h4>{{$posts->judul_pekerjaan}}</h4>
                                                                    </a>
                                                                    <p class="fw-bold">{{$posts->user->perusahaan->nama_perusahaan}}</p>
                                                                    <p>{{$posts->user->perusahaan->alamat_perusahaan}}</p>
                                                                    
                                                                    <p>{{$posts->deskripsi_pekerjaan}}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            {{-- <button class="btn border btn-sm col-xs-6 btn-primary border-primary" type="button" onclick="favoriteklik{{++$i}}()"><i class="bi bi-star-fill" id="bintang{{++$i -1}}" style="width: 100px; height: 100px;"><input hidden disabled id="putih{{++$i -2}}" type="text"></i></button> --}}
                                                            <button class="btn border btn-sm col-xs-6 btn-primary border-primary" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="bi bi-link"></i></button>
                                                        </div>

                                                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">

                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>

                                                                    <div class="modal-body">
                                                                    ...
                                                                    </div>

                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                        <button type="button" class="btn btn-primary">Salin link</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                                {{-- <script>
                                                    function favoriteklik{{++$i -3}}(){
                                                        var y = document.getElementById("bintang{{++$i -4}}");
                                                        var z = document.getElementById("putih{{++$i -5}}");
                                                        if (z.name == "hitam" | y.name == "terkirim") {
                                                            z.name = "putih";
                                                            // y.classList.remove("bi-star-fill");
                                                            y.classList.remove("text-warning");
                                                            // y.classList.add("bi-star");
                                                        } else{
                                                            z.name = "hitam";
                                                            // y.classList.remove("bi-star-fill");
                                                            // y.classList.add("bi-star-fill");
                                                            y.classList.add("text-warning");
                                                        }
                                                    }
                                                </script> --}}
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach

                                @endif
                                
                                {{$fitur_cari->links('layouts.pagination')}}
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        @include('company.layouts.footer')
        @include('company.layouts.bottom')
    </body>
    <script>
        window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function(){
                $(this).remove(); 
            });
        }, 4000);
    </script>
</html>