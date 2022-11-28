

<!doctype html>
<html lang="en">
    <head>
        @include('admin.layouts.top')
    </head>
    <body class="hold-transition sidebar-mini layout-fixed">
        <div class="wrapper">
            @include('admin.layouts.navigation')
            <div class="content-wrapper p-5">
                <section class="content mt-5">
                    <div class="container-fluid">
                        <div class="row justify-content-center">
                            @if($notifikasi->count() == 0)
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
                            @else
                            <div class="col-lg-7">
                            @if($keywoard != null)
                            <p class="ft16">Hasil penelusuran <b>{{$keywoard}}</b></p>
                            @endif

                            @if($fitur_cari->count() == 0)
                            <div class="alert alert-danger mb-1 text-center" role="alert">
                                Maaf hasil cari <b>"{{$keywoard}}"</b> tidak ditemukan <i class="bi bi-emoji-frown"></i>
                            </div>
                            <div class="card p-3">
                                <h3 class="fw-bold text-start mb-4">Notifikasi</h3>
                                @foreach($notifikasi as $i => $notif)
                                <div class="dropdown-divider"></div>
                                <div class="card-body">
                                    <div class="row">
                                        <!-- <div class="col-md-1">
                                        <p class="ft16">{{$i++}}</p>
                                        </div> -->
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
                                <h3 class="fw-bold text-start mb-4">Notifikasi</h3>
                                @foreach($fitur_cari as $i => $notif)
                                <div class="dropdown-divider"></div>
                                <div class="card-body">
                                    <div class="row">
                                        <!-- <div class="col-md-1">
                                        <p class="ft16">{{$i++}}</p>
                                        </div> -->
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
                            {{$fitur_cari->links('layouts.pagination')}}
                            </div>
                            
                            @endif
                        </div>
                    </div>
                </section>
            </div>
        
        @include('admin.layouts.footer')
        @include('admin.layouts.bottom')
    </body>
</html>