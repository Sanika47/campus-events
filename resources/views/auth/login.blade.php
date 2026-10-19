@extends('layouts.app')

@section('content')

<div class="container">

    <h2 class="mb-4">Login</h2>

    <!-- Login Form -->
    <form id="loginForm">

        <!-- Email -->
        <div class="mb-3">
            <label class="form-label">Email</label>

            <input
                type="email"
                id="email"
                class="form-control"
                required>
        </div>

        <!-- Password -->
        <div class="mb-3">
            <label class="form-label">Password</label>

            <input
                type="password"
                id="password"
                class="form-control"
                required>
        </div>

        <!-- Login Button -->
        <button
            type="submit"
            class="btn btn-primary"
            Login
        </button>

        <!-- Forgot Password -->
            <button
                type="button"
                class="btn btn-warning"
                onclick="window.location.href='/reset_password'">

                Forgot Password
            </button>

    </form>

    <!-- Success/Error Messages -->
    <div id="message" class="mt-3"></div>

</div>

<script>

document.getElementById('loginForm')
.addEventListener('submit', async function(e){

    e.preventDefault();

    const messageDiv =
    document.getElementById('message');

    try {

        const response = await fetch('/api/v1/login', {

            method: 'POST',

            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },

            body: JSON.stringify({

                email:
                document.getElementById('email').value,

                password:
                document.getElementById('password').value

            })

        });

        const data = await response.json();
        console.log("LOGIN RESPONSE:", data);

        if(response.ok && data.token){

            localStorage.setItem(
                'token',
                data.token
            );

            localStorage.setItem(
                'role',
                data.role
            );

            localStorage.setItem(
                'user_name',
                data.user.name
            );

            messageDiv.innerHTML = `
                <div class="alert alert-success">
                    Login Successful
                </div>
            `;

            setTimeout(() => {

                window.location.href =
                '/dashboard';

            }, 1000);

        }

        } else {

            messageDiv.innerHTML = `
                <div class="alert alert-danger">
                    ${data.message ?? 'Login Failed'}
                </div>
            `;

        }

    } catch(error){

        console.error(error);

        messageDiv.innerHTML = `
            <div class="alert alert-danger">
                An error occurred.
            </div>
        `;

    }

});

</script>

@endsection
