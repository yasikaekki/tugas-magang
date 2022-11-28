

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
                    
                    <div class="col-lg-8">

                        @if($notifikasi->count() == 0)
                        <div class="row d-flex justify-content-center">
                            <div class="col-lg-7">
                                <div class="card p-4">
                                    <div class="card-body">
                                        <div class="text-center text-warning mb-4">
                                            <i class="bi bi-emoji-frown display-1"></i>
                        
                                        </div>
                                        <p class="small text-center">Mohon maaf<br>Sepertinya belum ada notifikasi</p>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        @else
                        @if($keywoard != null)
                        <p class="ft16">Hasil penelusuran <b>{{$keywoard}}</b></p>
                        @endif

                        @if($fitur_cari->count() == 0)
                        <div class="alert alert-danger mb-1 text-center" role="alert">
                            Maaf hasil cari <b>"{{$keywoard}}"</b> tidak ditemukan <i class="bi bi-emoji-frown"></i>
                        </div>
                        
                        <div class="card p-3">
                            <h3 class="fw-bold text-dark text-start mb-4">Notifikasi</h3>
                            @foreach($notifikasi as $i => $notif)
                            <hr>
                            <div class="card-body">
                                <div class="row overflow-auto">
                                    <div class="col-md-8">
                                        <p class="ft16">{{$notif->description}}</p>
                                    </div>
                                    <div class="col-md-4">
                                        <p class="ft16 text-center">{{$notif->updated_at}}</p>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        @else
                        <div class="card p-3">
                            <h3 class="fw-bold text-dark text-start mb-4">Notifikasi</h3>
                            @foreach($fitur_cari as $i => $notif)
                            <hr>
                            <div class="card-body">
                                <div class="row overflow-auto">
                                    <div class="col-md-8">
                                        <p class="ft16">{{$notif->description}}</p>
                                    </div>
                                    <div class="col-md-4">
                                        <p class="ft16 text-center">{{$notif->updated_at}}</p>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @endif

                        @endif
                        {{$fitur_cari->links('layouts.pagination')}}
                    </div>
                </div>
            </div>
        </section>
        
        @include('user.layouts.footer')
        @include('user.layouts.bottom')
    </body>
</html>