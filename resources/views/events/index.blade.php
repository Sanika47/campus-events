@extends('layouts.app')

@section('content')

<div class="container">

    <div class="text-center py-5">

        <!-- System Title -->
        <h1 class="display-4 mb-3">
            Campus Events Platform
        </h1>

        <!-- System Description -->
        <p class="lead mb-4">
            Discover workshops, conferences,
            sports events, career fairs and
            student activities across campus.
        </p>

        <!-- Navigation Buttons -->
        <div class="d-flex justify-content-center gap-3 flex-wrap">

            <a href="/login"
               class="btn btn-primary">
                Login
            </a>

            <a href="/register"
               class="btn btn-success">
                New User
            </a>

            <a href="#"
                class="btn btn-secondary"
                onclick="enterAsGuest()">
                    Guest
            </a>

            <script>
                function enterAsGuest()
            {
                localStorage.setItem('role', 'Guest');
                localStorage.setItem('user_name', 'Guest');

                window.location.href = '/dashboard';
            }
            </script>

        </div>

    </div>

</div>

@endsection