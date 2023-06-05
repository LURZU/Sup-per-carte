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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/f5a11d8b0c.js" crossorigin="anonymous"></script>
    <!-- Scripts -->
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
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
    <div class="d-flex h-100" id="wrapper">
        @include('layouts.navigation')
   
        <!-- Page Heading -->
        <div id="page-content-wrapper" class="w-100">
            @if (isset($header))
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif
            <div class="px-5 w-100">
                <div class="d-flex align-items-center my-5 ml-4">
                    <i class="fa-solid fa-table-cells-large fa-2xl mr-3"></i>
                    <h2 class="fs-3 mb-0 ms-2">@yield('title')</h2>
                </div>
                
                <!-- Page Content -->
                <main class="container-fluid">
                    {{ $slot }}
                </main>
            </div>
        </div>
    </div>
    @livewireScripts
</body>
</html>
