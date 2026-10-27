<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Campus Events</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">
</head>
<body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">

            <a class="navbar-brand" href="{{ url('/') }}">
                Northrise University
            </a>

            <div class="d-flex gap-3 align-items-center">

                <a href="{{ url('/') }}"
                   class="text-white text-decoration-none">
                    Feel the Thrill
                </a>

                @if(!request()->is('login'))

                    <button
                        id="logoutBtn"
                        type="button"
                        class="btn btn-warning btn-sm"
                        style="display:none;"
                        onclick="logout()">
                        Logout
                    </button>

                @endif

            </div>

        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mt-4">
        @yield('content')
    </div>

    <script>

        document.addEventListener('DOMContentLoaded', function () {

            const logoutBtn =
                document.getElementById('logoutBtn');

            if (
                logoutBtn &&
                localStorage.getItem('token')
            ) {
                logoutBtn.style.display = 'inline-block';
            }

        });

        function logout()
        {
            localStorage.removeItem('token');
            localStorage.removeItem('role');
            localStorage.removeItem('user_name');

            window.location.href = '/login';
        }

    </script>

</body>
</html>
