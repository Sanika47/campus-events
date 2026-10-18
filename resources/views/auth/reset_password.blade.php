@extends('layouts.app')

@section('content')

<div class="container">

    <h2 class="mb-4">Reset Password</h2>

    @if(session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

          <div class="mb-3">
            <label class="form-label">Enter Registered Email Address</label>

            <input
                type="email"
                name="email"
                class="form-control"
                required>
       
    <div id="message"></div>

    <button
        type="button"
        class="btn btn-primary"
        onclick="sendResetLink()">

        Submit

    </button>

    <script>
    function sendResetLink() {

        document.getElementById('message').innerHTML =
            '<div class="alert alert-success">Reset link sent successfully.</div>';

            setTimeout(function () {
                window.location.href = '/login';
            }, 1000);

    }
    </script>

    </form>

</div>

@endsection