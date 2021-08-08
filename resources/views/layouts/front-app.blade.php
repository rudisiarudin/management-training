
<!doctype html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Language" content="en" />
    <meta name="msapplication-TileColor" content="#2d89ef">
    <meta name="theme-color" content="#4188c9">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"/>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">
    <link rel="icon" href="./favicon.ico" type="image/x-icon"/>
    <link rel="shortcut icon" type="image/x-icon" href="./favicon.ico" />
    <!-- Generated: 2018-04-16 09:29:05 +0200 -->
    <title>@section('page_title') Trainers Management Indonesia | Dashboard @show</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter&family=Poppins&display=swap');

        .file {
            visibility: hidden;
            position: absolute;
        }
    </style>
    <script src="{{ asset('assets/js/require.min.js') }}"></script>
    <script>
        requirejs.config({
            baseUrl: '{{ asset('') }}'
        });
    </script>
    <!-- Dashboard Core -->
    <link href="{{ asset('assets/css/dashboard.css') }}" rel="stylesheet" />
    <script src="{{ asset('assets/js/dashboard.js') }}"></script>
    <!-- c3.js Charts Plugin -->
    <link href="{{ asset('assets/plugins/charts-c3/plugin.css') }}" rel="stylesheet" />
    <script src="{{ asset('assets/plugins/charts-c3/plugin.js') }}"></script>
    <!-- Input Mask Plugin -->
    <script src="{{ asset('assets/plugins/input-mask/plugin.js') }}"></script>
    <link rel="icon" href="{{ asset('img/tmi-logo-white.png') }}">
</head>
<body class="">
<div class="page">
    <div class="page-main">
        <div class="header py-4">
            <div class="container">
                <div class="d-flex">
                    <a class="header-brand" href="{{ route('front-app-home') }}">
                        <img src="{{ asset('img/tmi-logo.png') }}" class="header-brand-img">
                    </a>
                    <div class="d-flex order-lg-2 ml-auto">
                        <div class="dropdown">
                            <a href="#" class="nav-link pr-0 leading-none" data-toggle="dropdown">
                                @if(auth()->user()->participant->profile_image)
                                    <span class="avatar" style="background-image: url({{ asset(auth()->user()->participant->profile_image) }})"></span>
                                @else
                                    <span class="avatar" style="background-image: url({{ asset('img/profile/default.png') }})"></span>
                                @endif
                                <span class="ml-2 d-none d-lg-block">
                                      <span class="text-default">{{ auth()->user()->email }}</span>
                                      <small class="text-muted d-block mt-1">Peserta Pelatihan</small>
                                </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                <a class="dropdown-item" href="{{ route('front-app-profile') }}">
                                    <i class="dropdown-icon fe fe-user"></i> Profil
                                </a>
                                <div class="dropdown-divider"></div>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    @method('POST')
                                    <button class="dropdown-item" href="#">
                                        <i class="dropdown-icon fe fe-log-out"></i> Keluar
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <a href="#" class="header-toggler d-lg-none ml-3 ml-lg-0" data-toggle="collapse" data-target="#headerMenuCollapse">
                        <span class="header-toggler-icon"></span>
                    </a>
                </div>
            </div>
        </div>
        <div class="header collapse d-lg-flex p-0" id="headerMenuCollapse">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg order-lg-first">
                        <ul class="nav nav-tabs border-0 flex-column flex-lg-row">
                            <li class="nav-item">
                                <a href="{{ route('front-app-home') }}" class="nav-link @if(\Request::segment(2) == '') active @endif"><i class="fe fe-home"></i> Beranda</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('front-app-training-list') }}" class="nav-link @if(\Request::segment(2) == 'training-list') active @endif"><i class="fe fe-list"></i> Daftar Pelatihan</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="my-3 my-md-5">
            <div class="container">
                @yield('content')
            </div>
        </div>

    </div>
    <footer class="footer bg-transparent border-0">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-12 mt-lg-0 text-center">
                    Copyright &copy; 2021 | Trainers Management Indonesia
                </div>
            </div>
        </div>
    </footer>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $(document).on("click", ".browse", function(e) {
        var self = $(this).attr('data-id')
        $(self).trigger("click");
    });
    $('input[type="file"]').change(function(e) {
        var fileName = e.target.files.name;
        var id = e.target.id
        $("#file").val(fileName);

        var reader = new FileReader();
        reader.onload = function(e) {
            // get loaded data and render thumbnail.
            document.getElementById("preview_" + id).src = e.target.result;
        };
        // read the image file as a data URL.
        reader.readAsDataURL(this.files[0]);
    });
</script>
</body>
</html>
