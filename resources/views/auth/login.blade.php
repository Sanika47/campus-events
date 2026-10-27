@extends('layouts.app')

@section('content')

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card shadow">
                <div class="card-body">

                    <h2 class="text-center mb-4">Login</h2>

                    <form id="loginForm">

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label">
                                Email
                            </label>
                            <input
                                type="email"
                                id="email"
                                class="form-control"
                                placeholder="Enter your email"
                                required>
                        </div>

                        <!-- Password -->
                        <div class="mb-3">
                            <label for="password" class="form-label">
                                Password
                            </label>
                            <input
                                type="password"
                                id="password"
                                class="form-control"
                                placeholder="Enter your password"
                                required>
                        </div>

                        <!-- Buttons -->
                        <div class="d-grid gap-2">

                            <button
                                type="submit"
                                class="btn btn-primary">
                                Login
                            </button>

                            <button
                                type="button"
                                class="btn btn-warning"
                                onclick="window.location.href='/reset_password'">
                                Forgot Password
                            </button>

                        </div>

                    </form>

                    <div id="message" class="mt-3"></div>

                </div>
            </div>

        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const loginForm = document.getElementById('loginForm');

    if (!loginForm) {
        console.error('Login form not found');
        return;
    }

    loginForm.addEventListener('submit', async function (e) {

        e.preventDefault();

        const messageDiv = document.getElementById('message');

        try {

            const response = await fetch('/api/v1/login', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    email: document.getElementById('email').value,
                    password: document.getElementById('password').value
                })
            });

            const data = await response.json();

            console.log('LOGIN RESPONSE:', data);

            if (response.ok && data.token) {

                localStorage.setItem('token', data.token);

                if (data.role) {
                    localStorage.setItem('role', data.role);
                }

                if (data.user && data.user.name) {
                    localStorage.setItem('user_name', data.user.name);
                }

                messageDiv.innerHTML = `
                    <div class="alert alert-success">
                        Login successful. Redirecting...
                    </div>
                `;

                setTimeout(() => {
                    window.location.href = '/dashboard';
                }, 1000);

            } else {

                messageDiv.innerHTML = `
                    <div class="alert alert-danger">
                        ${data.message || 'Login failed'}
                    </div>
                `;
            }

        } catch (error) {

            console.error(error);

            messageDiv.innerHTML = `
                <div class="alert alert-danger">
                    An error occurred. Please try again.
                </div>
            `;
        }
    });
});
</script>

@endsection
