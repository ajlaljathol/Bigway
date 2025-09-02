<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'BIGWAY') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
        :root {
            --navbar-height: 56px;
        }

        body {
            overflow-x: hidden;
        }

        .navbar {
            height: var(--navbar-height);
            min-height: var(--navbar-height);
            background: #fff;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1050;
        }

        .sidebar {
            height: calc(100vh - var(--navbar-height));
            position: fixed;
            left: 0;
            top: var(--navbar-height);
            width: 220px;
            background: #f8f9fa;
            border-right: 1px solid #e3e3e3;
            overflow-y: auto;
        }

        .sidebar .btn {
            width: 90%;
            margin: 10px auto;
            display: block;
            text-align: left;
        }

        .main-content {
            margin-left: 220px;
            margin-top: var(--navbar-height);
        }

        @media (max-width: 768px) {
            .sidebar {
                position: static;
                width: 100%;
                height: auto;
                top: 0;
            }

            .main-content {
                margin-left: 0;
                margin-top: var(--navbar-height);
            }
        }
    </style>
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'BIGWAY') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto"></ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
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
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
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

        <div class="sidebar">
            <a href="{{ route('home') }}" class="btn btn-outline-primary">Dashboard</a>
            <a href="{{ route('students.index') }}" class="btn btn-outline-primary">Students</a>
            <a href="{{ route('guardians.index') }}" class="btn btn-outline-primary">Guardians</a>
            <a href="{{ route('schools.index') }}" class="btn btn-outline-primary">Schools</a>
            <a href="{{ route('caretakers.index') }}" class="btn btn-outline-primary">Caretakers</a>
            <a href="{{ route('drivers.index') }}" class="btn btn-outline-primary">Drivers</a>
            <a href="{{ route('salaries.index') }}" class="btn btn-outline-primary">Salaries</a>
            <a href="{{ route('vehicles.index') }}" class="btn btn-outline-primary">Vehicles</a>
            <a href="{{ route('attendance.index') }}" class="btn btn-outline-primary">Attendances</a>
            <a href="{{ route('staff.index') }}" class="btn btn-outline-primary">Staff</a>
            <a href="{{ route('expenses.index') }}" class="btn btn-outline-primary">Expenses</a>
            <a href="{{ route('routes.index') }}" class="btn btn-outline-primary">Routes</a>
            <a href="{{ route('admin.users.create') }}" class="btn btn-outline-primary">Users</a>
        </div>

        <main class="py-4 main-content">
            @yield('content')
        </main>
    </div>
</body>

</html>
