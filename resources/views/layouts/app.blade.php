<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        .nav-link{
            color: white !important
        }
        .nav-link.active{
            color: #1d68a7 !important;
            background-color: rgb(253, 113, 113)
        }
    </style>
    <!-- Custom styles for this template -->
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-dark sticky-top bg-danger flex-md-nowrap p-0 navbar-expand-md">
        <a class="navbar-brand col-sm-3 col-md-2 mr-0 {{ Auth::check() ? '' : 'bg-danger' }}" href="#">
            {{ config('app.name', 'Laravel') }}
        </a>
        <ul class="navbar-nav px-3" style="right: 15px !important; position: fixed;">
            @guest
            <li class="nav-item text-nowrap">
                <a class="nav-link" href="{{ route('login') }}">{{ __('Admin') }}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('mahasiswa.login') }}">{{ __('Mahasiswa') }}</a>
            </li>
            @else
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{ Auth::user()->nama }} <span class="caret"></span>
                </a>
                <div class="dropdown-menu" aria-labelledby="profileDropdown">
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
            @endguest
        </ul>
    </nav>

    <div class="container-fluid">
        <div class="row">
            @if (Auth::check())
            <nav class="col-md-2 d-none d-md-block bg-light sidebar">
                <div class="sidebar-sticky col-md-2 px-1 bg-dark position-fixed">
                    @if (Auth::guard('web')->user())
                    <ul class="nav flex-column">
                        <li class="nav-item">
                        <a class="nav-link {{ Request::is('*/dashboard') ? 'active' : '' }}" href="{{ route('app.dashboard')}}">
                                <i class="fa fa-home"></i>
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('*mahasiswa*') ? 'active' : '' }}" href="{{ route('app.mahasiswa')}}">
                                <i class="fa fa-users"></i>
                                Mahasiswa
                            </a>
                        </li>
                    </ul>
                    <h6
                        class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                        <span>Saved reports</span>
                        <a class="d-flex align-items-center text-muted" href="#">
                            <i class="fa fa-plus-circle"></i>
                        </a>
                    </h6>
                    <ul class="nav flex-column mb-2">
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fa fa-file"></i>
                                Current month
                            </a>
                        </li>
                    </ul>
                    @endif
                    @if(Auth::guard('mahasiswa')->user())
                    <ul class="nav flex-column">
                        <li class="nav-item">
                        <a class="nav-link {{ Request::is('m') ? 'active' : '' }}" href="{{ route('mahasiswa.app') }}">
                                <i class="fa fa-home"></i>
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('m/kendaraan*') ? 'active' : '' }}" href="{{ route('mahasiswa.kendaraan') }}">
                                <i class="fa fa-motorcycle"></i>
                                Kendaraan
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('m/simulator*') ? 'active' : '' }}" href="{{ route('mahasiswa.simulator') }}">
                                <i class="fab fa-simplybuilt"></i>
                                Simulator
                            </a>
                        </li>
                    </ul>
                    @endif
                </div>
            </nav>
            @endif

            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
                @yield('content')
            </main>
            
            <!-- Icons -->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" integrity="sha512-F5QTlBqZlvuBEs9LQPqc1iZv2UMxcVXezbHzomzS6Df4MZMClge/8+gXrKw2fl5ysdk4rWjR0vKS7NNkfymaBQ==" crossorigin="anonymous"></script>
            
            {{-- Script --}}
            <script src="{{ asset('js/jquery/jquery.min.js') }}"></script>
            @yield('scripts')
        </div>
    </div>
</body>

</html>