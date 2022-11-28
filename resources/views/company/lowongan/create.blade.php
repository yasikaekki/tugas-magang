<!doctype html>
<html lang="en">
    <head>
        @include('company.layouts.top')
    </head>
    <body class="bg-light">
        @include('company.layouts.navigation')
        <section class="p-5">
            <div class="container p-5">
                @if($lengkapi == null)
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-7">
                        <div class="card p-4">
                            <div class="card-body">
                                <div class="text-center mb-4">
                                    <h1 class="text-warning"><i class="bi bi-emoji-frown"></i></h1>
                                </div>
                                <p class="small text-center">Profil anda belum lengkap<br>Silahkan lengkapi dulu profilnya</p>
                                
                                <div class="d-grid col-3 mx-auto">
                                    <a class="btn btn-primary" href="{{route('profil.edit',$userid)}}"><i class="bi bi-person-fill"></i> Klik di sini</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @else
                <div class="row d-flex justify-content-center">
                    
                    <div class="col-lg-7">
                        <div class="card p-4">
                            <div class="card-body">
                                <h3 class="mb-5">Buat Lowongan Magang</h3>
                                <form action="{{route('lowongan.store')}}" method="post">
                                    @csrf
                                    <div class="mb-3 form-group">

                                        <div class="form-group">
                                            <label>Judul Pekerjaan</label>
                                            <input type="text" placeholder="Judul Pekerjaan" class="mb-3 form-control @error('judul_pekerjaan') is-invalid @enderror" name="judul_pekerjaan">
                                            @error('judul_pekerjaan')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
    
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">Bidang Pekerjaan</label>
                                            <select class="form-control mb-3 @error('bidang_pekerjaan') is-invalid @enderror" id="exampleFormControlSelect1" name="bidang_pekerjaan">
                                               <option value="null" selected hidden disabled>Pilih</option>
                                               @foreach ($bidang as $allbidang)
                                                   <option value="{{$allbidang->id}}">{{$allbidang->bidang_pekerjaan}}</option>
                                               @endforeach
                                            </select>
                                            @error('bidang_pekerjaan')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>           
                                        
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">Dibutuhkan</label>
                                            <select class="form-control mb-3 @error('employee') is-invalid @enderror" id="exampleFormControlSelect1" name="employee">
                                               <option value="null" selected hidden disabled>Pilih</option>
                                               <option value="1-3 Orang">1-3 Orang</option>
                                               <option value="4-7 Orang">4-7 Orang</option>
                                               <option value="8-10 Orang">8-10 Orang</option>
                                            </select>
                                            @error('employee')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>                                       
    
                                        <div class="form-group">
                                            <label>Deskripsi Pekerjaan</label>
                                            <input type="text" placeholder="Deskripsi Pekerjaan" class="mb-3 form-control @error('deskripsi_pekerjaan') is-invalid @enderror" name="deskripsi_pekerjaan">
                                            @error('deskripsi_pekerjaan')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div> 
    
                                        <div class="form-group">
                                            <label>Persyaratan</label>
                                            <input type="text" placeholder="Persyaratan" class="mb-3 form-control @error('persyaratan') is-invalid @enderror" name="persyaratan">
                                            @error('persyaratan')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
    
                                        <div class="form-group">
                                            <label>Masa Berakhir Lowongan</label>
                                            <input type="date" class="mb-3 form-control @error('masa_berakhir') is-invalid @enderror" name="masa_berakhir">
                                            @error('masa_berakhir')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <button type="submit" class="btn btn-primary form-control">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </section>

        @include('company.layouts.footer')
        @include('company.layouts.bottom')
    </body>
</html>