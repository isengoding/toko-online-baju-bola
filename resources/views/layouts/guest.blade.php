<!doctype html>
<!--
* Tabler - Premium and Open Source dashboard template with responsive and high quality UI.
* @version 1.0.0-beta20
* @link https://tabler.io
* Copyright 2018-2023 The Tabler Authors
* Copyright 2018-2023 codecalm.net Paweł Kuna
* Licensed under MIT (https://github.com/tabler/tabler/blob/master/LICENSE)
-->
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Jersey bola</title>
    <!-- CSS files -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">

    <link href="{{ asset('dist/css/tabler.min.css') }}" rel="stylesheet" />

    <link href="{{ asset('dist/css/demo.min.css') }}" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
    <style>
        @import url('https://rsms.me/inter/inter.css');

        :root {
            --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
        }

        body {
            font-feature-settings: "cv03", "cv04", "cv11";
            font-family: "Segoe UI", sans-serif;
        }
    </style>
</head>

<body>
    <script src="{{ asset('dist/js/demo-theme.min.js') }}"></script>
    <div class="page">
        <!-- Navbar -->
        <header class="navbar navbar-expand-md d-print-none">
            <div class="container-xl">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu"
                    aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <h1 class="navbar-brand d-none-navbar-horizontal pe-0 pe-md-3">
                    <a href="{{ route('home') }}">
                        <img src="{{ asset('dist/img/products/new-logo.png') }}" width="110" height="32"
                            alt="Tabler" class="navbar-brand-image">
                        {{-- Laravel --}}
                    </a>
                </h1>
                <div class="navbar-nav flex-row order-md-last">
                    <div class="d-flex ">
                        <div class="nav-item dropdown d-flex me-3">
                            <a href="#" class="nav-link px-0" data-bs-toggle="dropdown" tabindex="-1"
                                aria-label="Show notifications">
                                <i class="ti ti-shopping-cart icon"></i>
                                <span
                                    class="badge rounded rounded-circle bg-primary text-white">{{ \Cart::session(100)->getContent()->count() }}</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-end dropdown-menu-card">
                                <div class="card" style="width: 300px;">
                                    @if (\Cart::session(100)->getContent()->count() > 0)

                                        <div class="card-header">
                                            <h3 class="card-title">Keranjang Belanja</h3>
                                        </div>
                                        @forelse (\Cart::session(100)->getContent() as $item)
                                            <div class="list-group list-group-flush list-group-hoverable">


                                                <div class="list-group-item d-flex flex-row align-items-center">
                                                    <div class="">
                                                        <img src="{{ asset($item->attributes[0]['img_url']) }}"
                                                            width="45" height="60" alt="">
                                                    </div>
                                                    <div class="text-truncate ms-3">
                                                        <div>{{ $item->name }}</div>
                                                        <div>Rp. {{ number_format($item->price) }} <span
                                                                class="ms-3 text-muted">x {{ $item->quantity }}</span>
                                                        </div>
                                                        <div class="text-muted">
                                                            {{ $item->attributes[0]['type'] }} -
                                                            {{ $item->attributes[0]['brand'] }} -
                                                            {{ $item->attributes[0]['size'] }}
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                        @empty
                                        @endforelse
                                        <div class="card-footer text-center">
                                            <a href="{{ route('guest.cart.index') }}"
                                                class="text-decoration-none stretched-link">Lihat
                                                Keranjang</a>
                                        </div>
                                    @else
                                        <div class="list-group list-group-flush list-group-hoverable">
                                            <div
                                                class="list-group-item d-flex flex-row align-items-center justify-content-center">
                                                <div class="text-center">
                                                    <i class="ti ti-shopping-cart-question icon text-secondary"></i>

                                                    <div class="mt-2">
                                                        Cart Empty
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                </div>
                            </div>
                        </div>
                        <a href="?theme=dark" class="nav-link px-0 hide-theme-dark" title="Enable dark mode"
                            data-bs-toggle="tooltip" data-bs-placement="bottom">
                            <!-- Download SVG icon from http://tabler-icons.io/i/moon -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path
                                    d="M12 3c.132 0 .263 0 .393 0a7.5 7.5 0 0 0 7.92 12.446a9 9 0 1 1 -8.313 -12.454z" />
                            </svg>
                        </a>
                        <a href="?theme=light" class="nav-link px-0 hide-theme-light" title="Enable light mode"
                            data-bs-toggle="tooltip" data-bs-placement="bottom">
                            <!-- Download SVG icon from http://tabler-icons.io/i/sun -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 12m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                                <path
                                    d="M3 12h1m8 -9v1m8 8h1m-9 8v1m-6.4 -15.4l.7 .7m12.1 -.7l-.7 .7m0 11.4l.7 .7m-12.1 -.7l-.7 .7" />
                            </svg>
                        </a>
                        @auth
                            <div class="nav-item dropdown d-flex ms-3">
                                <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown"
                                    aria-label="Open user menu">
                                    <span class="avatar avatar-sm"
                                        style="background-image: url(./static/avatars/000m.jpg)"></span>
                                    <div class="d-none d-xl-block ps-2">
                                        <div>{{ auth()->user()->name }}</div>
                                        <div class="mt-1 small text-secondary">{{ auth()->user()->email }}</div>
                                    </div>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">

                                    <a href="{{ route('admin.dashboard') }}" class="dropdown-item">Dashboard</a>
                                    <a href="{{ route('user.profile.edit') }}" class="dropdown-item">Profile</a>
                                    <a href="{{ route('user.password.edit') }}" class="dropdown-item">Change Password</a>
                                    <a href="{{ route('user.addresses.index') }}" class="dropdown-item">Address</a>
                                    <a href="{{ route('user.orders.index') }}" class="dropdown-item">My Order</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                    </form>
                                    <a href="#" class="dropdown-item"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>
                                </div>
                            </div>
                        @else
                            <a href="{{ route('register') }}" class="nav-link px-3 d-none d-md-flex ">
                                Register
                            </a>
                            <a href="{{ route('login') }}" class="nav-link px-3 d-none d-md-flex">
                                Login
                            </a>

                        @endauth

                    </div>

                </div>
                <div class="collapse navbar-collapse" id="navbar-menu">
                    <div class="d-flex flex-column flex-md-row flex-fill align-items-stretch align-items-md-center">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('home') }}">
                                    <span
                                        class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->

                                    </span>
                                    <span class="nav-link-title">
                                        Home
                                    </span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('guest.products.index') }}">
                                    <span
                                        class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->

                                    </span>
                                    <span class="nav-link-title">
                                        Products
                                    </span>
                                </a>
                            </li>
                            @auth
                                <li class="nav-item d-flex d-md-none">
                                    <a class="nav-link" href="{{ route('login') }}">
                                        <span
                                            class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->

                                        </span>
                                        <span class="nav-link-title">
                                            Logout
                                        </span>
                                    </a>
                                </li>
                            @else
                                <li class="nav-item d-flex d-md-none">
                                    <a class="nav-link" href="{{ route('login') }}">
                                        <span
                                            class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->

                                        </span>
                                        <span class="nav-link-title">
                                            Login
                                        </span>
                                    </a>
                                </li>
                                <li class="nav-item d-flex d-md-none">
                                    <a class="nav-link" href="{{ route('register') }}">
                                        <span
                                            class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->

                                        </span>
                                        <span class="nav-link-title">
                                            Register
                                        </span>
                                    </a>
                                </li>
                            @endauth

                        </ul>
                    </div>
                </div>
            </div>
        </header>
        <div class="page-wrapper">
            @yield('content')

            {{-- <div class="page-body">
                <div class="container-xl">
                </div>
            </div> --}}
            @include('layouts.footer')
        </div>
    </div>

    <!-- Libs JS -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script>
        toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-center",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
    </script>

    <!-- Tabler Core -->
    <script src="{{ asset('dist/js/tabler.min.js') }}" defer></script>
    <script src="{{ asset('dist/js/demo.min.js') }}" defer></script>

    @stack('custom_script')

</body>

</html>
