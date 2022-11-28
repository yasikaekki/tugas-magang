@extends('layouts.appRegister')

@section('content')
<section class="auth">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-md-7 col-lg-5">
                <div class="card p-4">
                    <div class="card-body">
                        <h3 class="mb-5">Daftar Akun</h3>
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <p>Sudah punya akun? <a class="text-decoration-none" href="{{ route('login') }}">Masuk di sini</a></p>

                            <div class="mb-3 form-group">
                                <input type="username" placeholder="{{ __('Nama pengguna') }}" id="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}"  autocomplete="name">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3 form-group">
                                <input type="email" id="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  autocomplete="email" aria-describedby="emailHelp" placeholder="{{ __('Email') }}">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3 form-group">
                                <select name="selectrole" id="selectrole" placeholder="{{__('pilih')}}" class="form-control @error('selectrole') is-invalid @enderror"  autocomplete="selectrole">
                                    <option value="null" selected disabled hidden>Pilih jenis mendaftar</option>
                                    <option value="user">user</option>
                                    <option value="perusahaan">perusahaan</option>
                                </select>
                                @error('selectrole')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3 form-group">
                                <div class="input-group" id="show_hide_password">
                                    <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password"  autocomplete="new-password" placeholder="{{ __('Kata sandi') }}">
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
                                <div class="input-group" id="show_hide_password">
                                    <input id="password-confirm" type="password" class="form-control" placeholder="{{ __('Konfirmasi kata sandi') }}" name="password_confirmation"  autocomplete="new-password">
                                    <div class="input-group-append">
                                        <button class="input-group-text" type="button" onclick="passtotext()">
                                            <i class="bi bi-eye-slash" id="showpass" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                </div>
                            
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">{{ __('Daftar') }}</button>
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