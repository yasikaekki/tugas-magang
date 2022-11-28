@extends('layouts.appLogin')

@section('content')
<section class="auth">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-md-7 col-lg-5">
                <div class="card p-4">
                    <div class="card-body">
                        <h3 class="mb-5">Masuk</h3>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <p>Belum punya akun? <a class="text-decoration-none" href="{{ route('register') }}">Daftar di sini</a></p>

                            <div class="mb-3 form-group">
                                <input type="email" id="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" aria-describedby="emailHelp" placeholder="{{ __('Email') }}">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <div class="input-group" id="show_hide_password">
                                    <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="{{ __('Kata sandi') }}">
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
                            <!-- batas -->
                            <!-- <div class="input-group" id="show_hide_password">
                                <input class="form-control" type="password" placeholder="password">
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        <i class="bi bi-eye-slash" id="showpass" aria-hidden="true"></i>
                                    </span>
                                </div>
                            </div> -->
                            <!-- batas -->
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="remember">
                                            <label for="remember" class="form-check-label ml-2">Ingat Saya</label>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="d-grid d-md-flex justify-content-md-end">
                                            <a class="text-decoration-none" href="{{route('password.request')}}">Lupa kata sandi?</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <button type="submit" class="btn btn-primary btn-block">{{ __('Masuk') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="text-center">
    <p class="">&copy; imb.com</p>
</div>
@endsection

@extends('user.layouts.bottom')
