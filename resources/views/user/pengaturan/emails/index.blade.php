

<!doctype html>
<html lang="en">
    <head>
        @include('user.layouts.top')
    </head>
    <body class="bg-light">
        @include('user.layouts.navigation')
        <section class="p-5">
            <div class="container p-5">
                @if(session()->get('sukses'))
                    <div class="alert alert-success">
                        {{session()->get('sukses')}}
                    </div>
                @endif

                <div class="row d-flex justify-content-center">
                    <div class="mb-3">
                        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="/" class="text-decoration-none">Beranda</a></li>
                              <li class="breadcrumb-item"><a href="/home" class="text-decoration-none">Lowongan</a></li>
                              <li class="breadcrumb-item active" aria-current="page">Pengaturan</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="card-group">
                        <div class="col-lg-5">
                            <div class="card-header p-4">
                                <div class="card-body mb-5">
                                    <ul class="nav flex-column mb-6">
                                        <h5 class="text18"><b>Pengaturan</b></h5>
                                        <hr>
                                        <li class="nav-item mb-5">
                                            <a class="text18 nav-link nav-tabs disabled text-dark" role="button" aria-disabled="true" href="#">Email <i class="bi bi-chevron-compact-right pull-right"></i></a>  
                                            <a class="text18 nav-link nav-tabs mb-6" href="{{route('kata_sandi.edit', $user)}}">Kata Sandi <i class="bi bi-chevron-compact-right pull-right"></i></a> 
                                        </li>
                                    </ul>
                                </div>                    
                            </div>
                        </div>    
                        
                        <div class="col-lg-7">              
                            <div class="card p-4" id="ubah_email">
                                <div class="card-body">
                                    <div class="mb-3 form-group">
                                        <h3 class="mb-5">Ubah Email</h3>

                                        <div class="card-header">
                                            <div class="card-body">
                                                <medium class="text18"><b>Email</b></medium>
                                            </div>
                                        </div>

                                        <div class="card p-4 mb-3">
                                            <div class="card-body">
                                            @foreach($email as $row)

                                            <medium class="text18">{{$row->email}} </medium>
                                            @if(!Auth::user()->email_verified_at)                                                                        
                                            <i class="text18 text-danger bi bi-x-circle-fill"></i>
                                            @else
                                            <i class="text18 text-success bi bi-check-circle-fill"></i>
                                            @endif

                                            @endforeach
                                            </div>
                                        </div>
                                        <div class="mb-3 form-group">
                                            <!-- Button trigger modal -->
                                            @if(Auth::user()->email_verified_at != null)
                                            <button type="button" class="btn btn-primary form-control" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                Ubah Email
                                            </button>
                                            
                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    
                                                    <form action="{{url('home/pengaturan/email', $row->id)}}" method="post" enctype="multipart/form-data">
                                                        @method('PATCH')
                                                        @csrf
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">{{$pagename1}}</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="mb-3 form-group">
                                                                    <input name="txtemail_user" type="email" class="form-control @error('email') is-invalid @enderror" required autocomplete="email" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Alamat Email">
                                                                    @error('email')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn btn-primary">Ubah</button>
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            @else
                                            <button type="button" class="btn btn-primary form-control" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                Ubah Email
                                              </button>
        
                                              <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-body">
                                                            <div class="form-group mb-3">
                                                              <div class="text-center text-warning mb-4">
                                                                <i class="bi bi-emoji-frown display-1"></i>
                                                            </div>
                                                            <p class="ft16 text-center">Mohon maaf<br>Anda belum melakukan verifikasi email</p>
                                                            
                                                            </div> 
                                                        </div>
                                                    </div>
                                                </div>
                                              </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>

                </div>
            </div>
        </section>

        @include('user.layouts.footer')
        @include('user.layouts.bottom')
    </body>
</html>