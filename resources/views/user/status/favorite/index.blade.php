<!doctype html>
<html lang="en">
    <head>
        @include('user.layouts.top')
    </head>
    <body class="bg-light">
        @include('user.layouts.navigation')
        <section class="p-5">
            <div class="container p-5">
                <div class="row d-flex justify-content-center">
                    <div class="mb-3">
                        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="/" class="text-decoration-none">Beranda</a></li>
                              <li class="breadcrumb-item"><a href="/home" class="text-decoration-none">Lowongan</a></li>
                              <li class="breadcrumb-item active" aria-current="page">Status</li>
                            </ol>
                        </nav>
                    </div>
                    @if($keywoard != null)
                    <p class="ft16">Hasil penelusuran <b>{{$keywoard}}</b></p>
                    @endif
                    <div class="col-lg-12">
                        @if($fitur_cari->count() == 0 && $keywoard != null)
                        <div class="alert alert-danger mb-1 text-center" role="alert">
                            Maaf hasil cari <b>"{{$keywoard}}"</b> tidak ditemukan <i class="bi bi-emoji-frown"></i>
                        </div>
                        @endif
                        <div class="card">
                            <div class="nav card-header p-0 border-bottom-0">
                                <div class="card-header col-md-6 p-0">
                                    <a class="text18 nav-link text-decoration-none p-4" href="{{route('lamaran.index')}}">Lamaran Magang Anda</a>
                                </div>

                                <div class="col-md-6 bg-white rounded-top">
                                    <a class="text18 p-4 nav-link active disabled">Lowongan Magang Favorite Anda</a>                                   
                                </div>
                            </div>

                            @if($favorite->count() == 0)
                            <div class="card-body p-5">
                                <div class="text-center text-warning mb-4">
                                    <i class="bi bi-emoji-frown display-1"></i>
                
                                </div>
                                <p class="small text-center">Mohon maaf<br>Sepertinya belum ada lowongan dari <br> perusahaan yang di favoritkan</p>
                            </div>
                            @else
                            <div class="card-body p-4">
                                @if($fitur_cari->count() == 0)
                                <div class="row">
                                    @foreach($favorite as $favorites)
                                    <div class="col-md-4">
                                        <div class="shadow p-3 mb-5 bg-body rounded" style="width: 20rem;">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-10">
                                                        <h5 class="card-title text18"><strong><a href="{{route('lowongan.show', $favorites->post->id)}}" class="text-decoration-none">{{$favorites->post->judul_pekerjaan}}</a></strong></h5>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <form action="{{route('favorite.destroy', $favorites->id)}}" method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="pull-right small btn-close" aria-label="Close"></button>
                                                        </form>
                                                    </div>
                                                </div>
                                                <h6 class="card-subtitle medium mb-3">{{$favorites->post->nama_perusahaan}}</h6>
                                                <p class="text14">Lamaran ditutup {{$favorites->post->masa_berakhir}} <br> Telah tersimpan pada {{$favorites->created_at}}</p>

                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                @else
                                <div class="row">
                                    @foreach($fitur_cari as $favorites)
                                    <div class="col-md-4">
                                        <div class="shadow p-3 mb-5 bg-body rounded" style="width: 20rem;">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-10">
                                                        <h5 class="card-title text18"><strong><a href="{{route('lowongan.show', $favorites->post->id)}}" class="text-decoration-none">{{$favorites->post->judul_pekerjaan}}</a></strong></h5>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <form action="{{route('favorite.destroy', $favorites->id)}}" method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="pull-right small btn-close" aria-label="Close"></button>
                                                        </form>
                                                    </div>
                                                </div>
                                                <h6 class="card-subtitle medium mb-3">{{$favorites->post->nama_perusahaan}}</h6>
                                                <p class="text14">Lamaran ditutup {{$favorites->post->masa_berakhir}} <br> Telah tersimpan pada {{$favorites->created_at}}</p>

                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                @endif
                            </div>
                            @endif
                        </div>
                    </div>
                    {{$page->links('layouts.pagination')}}
                </div>
            </div>
        </section>
        
        @include('user.layouts.footer')
        @include('user.layouts.bottom')
    </body>
</html>