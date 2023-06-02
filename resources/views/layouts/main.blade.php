<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>TM News</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <link href= "{{ asset('css/styles.css') }}" rel="stylesheet" />

    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    
    @include('partials.navbar')
    
    <div class="main">
        @yield('main')
    </div>

    <section id="footer" class="bg-primary text-white p-3">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-4">
                    <h4 class="fw-bold">TM_News</h4>
                    <p>TM_News merupakan portal berita yang dibuat untuk menjadi project pribadi selama si owner magang. Website ini dibuat dengan Laravel 9, Bootstrap 5, Jquery, SweetAlert dan lain-lain. Semoga dengan dibuatnya website ini bisa membuat skill sang owner bisa terasah dengan baik</p>
                </div>
                <div class="col-3">
                    <h4 class="fw-bold">Menu</h4>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item  bg-transparent px-0"><a href="/" class="text-decoration-none text-white">Homepage</a></li>
                        
                        <li class="list-group-item  bg-transparent px-0"><a href="/categories" class="text-decoration-none text-white ">Categories</a></li>
                        
                        <li class="list-group-item  bg-transparent px-0"><a href="https://github.com/tiomhs" class="text-decoration-none text-white ">About</a></li>  
                      </ul>
                </div>
                <div class="col-3">
                    <h4 class="text-center fw-bold">Social Media</h4>
                    <div class="sosmed d-flex justify-content-center gap-4">
                        <a href="https://facebook.com/Tio-Mahesa"><i class="fa-brands fa-facebook fa-2x text-white"></i></a>
                        <a href="https://instagram.com/tiomhz"><i class="fa-brands fa-instagram fa-2x text-white"></i></a>
                        <a href="https://github.com/tiomhs"><i class="fa-brands fa-github fa-2x text-white"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>
