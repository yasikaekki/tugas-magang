@extends('layouts.app')

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
                        <h3 class="mb-5">Lupa Kata Sandi</h3>
                        <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                            <div class="mb-3 form-group">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary btn-block my-4">{{ __('Kirim') }}</button>
                            
                            <p class="text-center">Kembali ke halaman <a class="text-decoration-none" href="{{route('login')}}">login</a></p>
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