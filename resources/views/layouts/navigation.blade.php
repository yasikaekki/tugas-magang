@if(Route::has('login'))
<nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top shadow">
    @auth
    <div class="container-fluid align-items-center flexcolum">
        <a class="navbar-brand" href="{{ url('/home') }}"><img class="imgw200px" src="{{ asset('bagus/images/logo.png') }}"  alt="" srcset=""></a>
        <div class="collapse navbar-collapse flexcolum flexwrapp aligncontentend" id="navbarSupportedContent">
        </div>
    </div>
    @else
    <div class="container-fluid mx-4">
        <a class="navbar-brand" href="{{ url('/dashboard') }}"><img class="imgw200px" src="{{ asset('bagus/images/logo.png') }}"  alt="" srcset=""></a>
        <div class="collapse navbar-collapse flexcolum flexwrapp aligncontentend" id="navbarSupportedContent">
            <ul class="navbar-nav align-items-center">
                <div class="text-center">
                    <div class="row">
                        <div class="col-md-6">
                            <a href="{{ route('login') }}" class="text-decoration-none text-white text18">Masuk</a>
                        </div>
                    @if (Route::has('register'))
                        <div class="col-md-6">
                            <a href="{{ route('register') }}" class="text-decoration-none text-white text18">Daftar</a>   
                        </div>
                    @endif
                    </div>
                </div>
            </ul>
        </div>
    </div>
    
    @endauth
</nav>
@endif