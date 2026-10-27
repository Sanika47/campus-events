<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Campus Events</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">
</head>
<body>

    <!-- User Role Banner -->
    @auth
        <div class="alert alert-info text-center mb-0">
            Logged in as: <strong>{{ Auth::user()->role->name }}</strong>
        </div>
    @endauth

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">

            <!-- Logo -->
            <a class="navbar-brand" href="{{ url('/') }}">
                Northrise University
            </a>

            <!-- Menu -->
            <div class="d-flex gap-3 align-items-center">

                <a href="{{ url('/') }}" class="text-white text-decoration-none">Feel the Thrill</a>
            <div class="mt">

                @if(!request()->is('login'))
                    @auth
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-warning btn-sm">
                                Logout
                            </button>
                        </form>
                    @endauth
                @endif

            </div>
                {{-- Show logout if user is authenticated --}}
                @auth
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-warning btn-sm">Logout</button>
                    </form>
                @endauth

            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mt-4">
        @yield('content')
    </div>

</body>
</html>
