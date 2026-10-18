@extends('layouts.app')

@section('content')

<div class="container">

    <h2 class="mb-4">Create Account</h2>

    <form id="registerForm">

        <div class="mb-3">
            <label class="form-label">Full Name</label>

            <input
                type="text"
                id="name"
                class="form-control"
                required>
        </div>

        <div class="mb-3">
            <label class="form-label">Email Address</label>

            <input
                type="email"
                id="email"
                class="form-control"
                required>
        </div>

        <div class="mb-3">
            <label class="form-label">Password</label>

            <input
                type="password"
                id="password"
                class="form-control"
                minlength="6"
                required>
        </div>

        <div class="mb-3">
            <label class="form-label">
                Confirm Password
            </label>

            <input
                type="password"
                id="confirm_password"
                class="form-control"
                minlength="6"
                required>
        </div>

        <div class="mb-3">

            <label class="form-label">
                Role
            </label>

            <select
                id="role_id"
                class="form-select"
                required>

                <option value="">
                    Select Role
                </option>

                <option value="1">
                    Student
                </option>

                <option value="2">
                    Event Organizer
                </option>

            </select>

        </div>

        <button
            type="submit"
            class="btn btn-primary">

            Register

        </button>

    </form>

    <div id="message" class="mt-3"></div>

</div>

<script>

document.getElementById('registerForm')
.addEventListener('submit', async function(e){

    e.preventDefault();

    const name =
    document.getElementById('name')
    .value.trim();

    const email =
    document.getElementById('email')
    .value.trim();

    const password =
    document.getElementById('password')
    .value;

    const confirmPassword =
    document.getElementById('confirm_password')
    .value;

    const roleId =
    document.getElementById('role_id')
    .value;

    const messageDiv =
    document.getElementById('message');

    const emailPattern =
    /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if(!emailPattern.test(email)){

        messageDiv.innerHTML = `
            <div class="alert alert-danger">
                Please enter a valid email address.
            </div>
        `;

        return;
    }

    if(password !== confirmPassword){

        messageDiv.innerHTML = `
            <div class="alert alert-danger">
                Passwords do not match.
            </div>
        `;

        return;
    }

    try{

        messageDiv.innerHTML = `
            <div class="alert alert-info">
                Processing registration...
            </div>
        `;

        const response =
        await fetch('/api/v1/register', {

            method: 'POST',

            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },

            body: JSON.stringify({

                name: name,
                email: email,
                password: password,
                role_id: roleId

            })

        });

        const data =
        await response.json();

        if(!response.ok){

            let errorMessage =
            data.message;

            if(data.errors){

                errorMessage =
                Object.values(data.errors)
                .flat()
                .join('<br>');
            }

            throw new Error(errorMessage);
        }

        messageDiv.innerHTML = `
            <div class="alert alert-success">
                ${data.message}
            </div>
        `;

        document.getElementById('registerForm')
        .reset();

        setTimeout(() => {

            window.location.href =
            '/login';

        }, 1500);

    } catch(error){

        console.error(error);

        messageDiv.innerHTML = `
            <div class="alert alert-danger">
                ${error.message}
            </div>
        `;

    }

});

</script>

@endsection