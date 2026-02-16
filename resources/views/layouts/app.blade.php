<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>@yield('title', 'Academic Portal')</title>
        @if (file_exists(public_path('build/manifest.json')))
            @vite(['resources/css/app.css','resources/js/app.js'])
        @else
            <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        @endif
</head>
<body>
    <div class="app-container">
        <header class="app-header">
            <div class="app-title">Academic Portal</div>
            <nav class="nav-links">
                <a href="/">Home</a>
                <a href="/students">Students</a>
                <a href="/courses">Courses</a>
                @if(session('student_id'))
                    <a href="/dashboard">Dashboard</a>
                    <div class="user-info">
                        {{ session('student_name') }}
                        <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                            @csrf
                            <button type="submit" class="logout-btn">Logout</button>
                        </form>
                    </div>
                @else
                    <a href="/login" class="btn secondary" style="padding: 8px 12px;">Login</a>
                @endif
            </nav>
        </header>

        <main>
            @yield('content')
        </main>
    </div>
</body>
</html>
