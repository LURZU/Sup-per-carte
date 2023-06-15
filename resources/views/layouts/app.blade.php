<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>
    @livewireStyles

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/f5a11d8b0c.js" crossorigin="anonymous"></script>
    <!-- Inclusion de jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Inclusion de Popper.js (nécessaire pour certains composants JavaScript de Bootstrap comme les tooltips et popovers) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.3/umd/popper.min.js"></script>

    <!-- Fonts  -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- Scripts -->
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('css/responsive.css') }}" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#menu-toggle").click(function(e) {
                e.preventDefault();
                $("#wrapper").toggleClass("toggled");
            });
        });
    </script>
    <style>
        #wrapper.toggled #sidebar-wrapper {
            margin-left: 0;
        }
    </style>
</head>
<body class="font-sans antialiased h-100" style="height: 100vh!important;">
    <div class="row mx-0 p-2 header shadow-sm d-flex justify-content-between align-content-center">
        <div class="col-2 burger-menu icon nav-icon-5">
            <span></span>
            <span></span>
            <span></span>
        </div>
        <div class="col-8 d-flex justify-content-center align-content-center">
            <img src="{{ asset('image/SuP-Perform-logo-dark.svg') }}" class="mx-auto disable-desktop w-75">
        </div>


{{--      <x-application-logo style="width: 200px" class="justify-content-center mt-3 disable-desktop" />--}}

        <div class="col-2 d-flex justify-content-center align-content-center">
            <button class="btn btn-secondary dropdown-toggle disablebg p-0" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="">
                <i class="fa-regular fa-user fa-2xl" style="color: #333333"></i>
            </button>
            <ul class="dropdown-menu">
                <li class="text-center mb-2">Bonjour <b>{{auth()->user()->name}}</b>,</li>
                <li> <a class="dropdown-item text-center py-2" href="{{ route('profile.edit')}}">Profile</a></li>
                <li> <a class="dropdown-item text-center" href="">
                    <form action="{{ route('logout') }}" method="POST" >
                    @csrf
                    @method('POST')
                        <button type="submit"  class="dropdown-item text-center" style="background-color: transparent;">Déconnexion</button>
                </form></a></li>
            </ul>
        </div>
        </div>

    <div class="d-flex h-100" id="wrapper">

        @include('layouts.navigation')
        <!-- Page Heading -->
        <div id="page-content-wrapper" class="w-100" style="overflow: auto;">
            @if (isset($header))
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif
            <div class="px-0 px-md-5 w-100">
                <div class="d-flex align-items-center my-5 px-3 ml-4 my-reduce-mobile @yield('display_title_h1')">
                    <i class="fa-solid fa-table-cells-large fa-2xl mr-3"></i>
                    <h2 class="fs-3 mb-0 ms-2">@yield('title')</h2>
                </div>

                <!-- Page Content -->
                <main class="">
                    {{ $slot }}
                </main>
            </div>
        </div>
    </div>
    @livewireScripts
</body>
</html>
