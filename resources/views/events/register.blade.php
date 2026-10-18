@extends('layouts.app')

@section('content')

<div class="container">

    <!-- Page Title -->
    <h2 class="mb-4">Register For Event</h2>

    <!-- Event Registration Form -->
    <form id="registrationForm">

        <!-- Participant Name -->
        <div class="mb-3">
            <label class="form-label">Full Name</label>

            <input type="text"
                   id="full_name"
                   class="form-control"
                   required>
        </div>

        <!-- Participant Email -->
        <div class="mb-3">
            <label class="form-label">Email Address</label>

            <input type="email"
                   id="email"
                   class="form-control"
                   required>
        </div>

        <!-- Submit Button -->
        <button type="submit"
                class="btn btn-success">
            Register Event
        </button>

    </form>

    <!-- Success/Error Message -->
    <div id="message" class="mt-3"></div>

</div>

<script>

// Handle event registration form
document.getElementById('registrationForm')
.addEventListener('submit', function(e){

    // Prevent page reload
    e.preventDefault();

    // Get form values
    const fullName =
    document.getElementById('full_name').value;

    const email =
    document.getElementById('email').value;

    // Display success message
    document.getElementById('message').innerHTML = `
        <div class="alert alert-success">
            Event Registration Successful
        </div>
    `;

    // Log values for testing
    console.log('Name:', fullName);
    console.log('Email:', email);

    // Clear form
    document.getElementById('registrationForm').reset();

});

</script>

@endsection