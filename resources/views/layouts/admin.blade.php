<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Enigma Car Hire</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                
                <img class="nav-logo" src="{{ asset('/public/adminPics/EnigmaLogo.png') }}"  width="220" height="70" alt="Enigmatic Rides">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">


        

        <!--icons---> 
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <!--SIDEBAR-->


        <link rel="stylesheet" type="text/css" href="/admin.css">
            <div class="sidebar">
            <a class="active" href="{{route('dashboard')}}"><i class="bi bi-house-fill"></i> Dashboard</a>
            <a href="{{route('vehicles')}}"><i class="bi bi-car-front-fill"></i> Vehicles</a>
            <a href="{{route('reservations')}}"><i class="bi bi-calendar-check-fill"></i> Reservations</a>
            <a href="{{route('payments')}}"><i class="bi bi-credit-card-2-back-fill"></i> Payments</a>
            <a href="{{route('maintenances')}}"><i class="bi bi-tools"></i> Maintenance</a>
            <a href="{{route('insurances')}}"><i class="bi bi-shield-shaded"></i>Insurance</a>

            <div class="dropdown">
            <a href="#about"> <i class="bi bi-people-fill"></i> Users</a>

            <div class="dropdown-content">
                <a href="{{route('customers')}}"><i class="bi bi-arrow-return-right"></i> Customers</a>
                <a href="{{route('additionalDrivers')}}"> <i class="bi bi-arrow-return-right"></i> Additional Drivers</a>
                <a href="#"><i class="bi bi-arrow-return-right"></i> Admin</a>
                </div>

            </div> </div>
            
                  <div class="content">
                        @yield('content')
                  </div>
                    </main>
                </div>
            </body>
            </html>
