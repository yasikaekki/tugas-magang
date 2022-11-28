

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
                @elseif(session()->get('gagal'))
                    <div class="alert alert-danger">
                        {{session()->get('gagal')}}
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
                                    <ul class="nav flex-column mb-7">
                                        <h5 class="text18"><b>Pengaturan</b></h5>
                                        <hr>
                                        <li class="nav-item mb-5">
                                            <a class="text18 nav-link nav-tabs" href="{{route('email.index')}}">Email <i class="bi bi-chevron-compact-right pull-right"></i></a> 
                                            <a class="text18 nav-link nav-tabs mb-6 disabled text-dark" role="button" aria-disabled="true" href="#">Kata Sandi <i class="bi bi-chevron-compact-right pull-right"></i></a> 
                                        </li>
                                    </ul>
                                </div>                    
                            </div>
                        </div>
                        
                        <div class="col-lg-7">              
                            <div class="card p-4">
                                <div class="card-body">
                                    <h3 class="mb-5">Ubah kata sandi</h2>
                                    <form action="{{route('kata_sandi.update', $user)}}" method="post">
                                        @method('PATCH')
                                        @csrf
                                    <form>
                                        <div class="mb-3 form-group">
                                            <div class="row">
                                                <div class="mb-3 form-group">
                                                    <label>Kata sandi lama</label>
                                                    <div class="input-group" id="show_hide_password">
                                                        <input type="password" class="form-control @error('password_lama') is-invalid @enderror" name="password_lama" id="password_lama" placeholder="Kata sandi Lama" required autocomplete="old-password">
                                                        <div class="input-group-append">
                                                            <button class="input-group-text" type="button" onclick="passtotext()">
                                                                <i class="bi bi-eye-slash" id="showpass" aria-hidden="true"></i>
                                                            </button>
                                                        </div>
                                                        
                                                    @error('password_lama')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                    </div>
                                                </div>
        
                                                <div class="mb-3 form-group">
                                                    <label>kata sandi baru</label>
                                                    <div class="input-group" id="show_hide_password">
                                                        <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Kata sandi baru">
                                                
                                                        <div class="input-group-append">
                                                            <button class="input-group-text" type="button" onclick="passtotext()">
                                                                <i class="bi bi-eye-slash" id="showpass" aria-hidden="true"></i>
                                                            </button>
                                                        </div>
                                                        @error('password')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
        
                                                <div class="mb-3 form-group">
                                                    <label>Konfirmasi kata sandi baru</label>
                                                    <div class="input-group" id="show_hide_password">
                                                        
                                                        <input id="password-confirm" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="Konfirmasi kata sandi baru" name="password_confirmation" required autocomplete="new-password">
                                                        <div class="input-group-append">
                                                            <button class="input-group-text" type="button" onclick="passtotext()">
                                                                <i class="bi bi-eye-slash" id="showpass" aria-hidden="true"></i>
                                                            </button>
                                                        </div>
                                                        @error('password_confirmation')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>        
                                                
                                                <div class="mb-3 form-group">
                                                    @if(Auth::user()->email_verified_at != null)
                                                    <button type="submit" class="btn btn-primary form-control">Ubah Kata Sandi</button>
                                                    @else
                                                    <button type="button" class="btn btn-primary form-control" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                        Ubah Kata Sandi
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
                                    </form>
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