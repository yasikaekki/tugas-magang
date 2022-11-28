@extends('layouts.halamanKosong')

@section('content')
<section class="auth">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-lg-12">
                <div class="card p-4">
                    <div class="card-body">
                        <h1 class="text-danger text-center mb-4 p-4">404 | Halaman Tidak Ditemukan</h1>
                        <p class="text18 text-center">Maaf Halaman yang Anda Tuju Tidak Ditemukan</p>
                        <p class="text18 text-center"><b>Silahkan Kembali dengan Menekan Tombol Dibawah ini</b></p>
                        {{-- @auth --}}
                        <div class="d-grid d-md-flex justify-content-center">
                            <a href="/home" class="btn btn-primary text-end">
                                <i class="bi bi-house-fill"></i>
                                Halaman Utama
                            </a>
                        </div>
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
