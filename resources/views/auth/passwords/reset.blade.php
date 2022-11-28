@extends('layouts.appReset')

@section('content')
<section class="auth">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-md-7 col-lg-5">
                <div class="card p-4">
                    <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        <h3 class="mb-5">Ubah Kata Sandi</h3>
                        <form method="POST" action="{{ route('password.update') }}">
                        @csrf
                            <input type="hidden" name="token" value="{{ $token }}">
                            
                            <div class="mb-3">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3 form-group">
                                <div class="input-group" id="show_hide_password">
                                    <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="{{ __('Kata sandi baru') }}">
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
                                    <input id="password-confirm" type="password" class="form-control" placeholder="{{ __('Konfirmasi kata sandi baru') }}" name="password_confirmation" required autocomplete="new-password">
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
                            <button type="submit" class="btn btn-primary btn-block my-4">{{ __('Ganti Kata Sandi') }}</button>
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
