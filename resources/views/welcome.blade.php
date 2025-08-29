<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BIGWAY</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito:400,600,700" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f8f9fa;
            min-height: 100vh;
            font-family: 'Nunito', sans-serif;
        }
        .welcome-container {
            max-width: 500px;
            margin: 80px auto;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 2px 16px rgba(0,0,0,0.07);
            padding: 2.5rem 2rem;
            text-align: center;
        }
        .welcome-title {
            font-size: 2.2rem;
            font-weight: 700;
            color: #0d6efd;
            margin-bottom: 1rem;
        }
        .welcome-desc {
            color: #555;
            margin-bottom: 2rem;
        }
        .welcome-btns .btn {
            min-width: 120px;
            margin: 0 0.5rem;
        }
    </style>
</head>
<body>
    <div class="welcome-container">
        <div class="welcome-title">Welcome to BIGWAY</div>
        <div class="welcome-desc">
            Manage students, schools, guardians, vehicles, and more with ease.<br>
            Please login or register to continue.
        </div>
        <div class="welcome-btns mb-4">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/home') }}" class="btn btn-primary">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline-primary">Login</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn btn-outline-secondary">Register</a>
                    @endif
                @endauth
            @endif
        </div>
        <div class="mt-4">
            <small class="text-muted">Powered by Laravel</small>
        </div>
    </div>
</body>
</html>
