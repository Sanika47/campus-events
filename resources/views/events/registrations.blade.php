@extends('layouts.app')

@section('content')

<div class="container">

    <h2 class="mb-4">Registered Students</h2>

    <table class="table table-bordered table-striped">

        <thead class="table-dark">

            <tr>
                <th>#</th>
                <th>Student Name</th>
                <th>Email Address</th>
                <th>Event</th>
                <th>Date Registered</th>
            </tr>

        </thead>

        <tbody>

            @forelse($registrations as $registration)

            <tr>

                <td>{{ $registration->id }}</td>

                <td>{{ $registration->user->name }}</td>

                <td>{{ $registration->user->email }}</td>

                <td>{{ $registration->event->title }}</td>

                <td>{{ $registration->created_at }}</td>

            </tr>

            @empty

            <tr>

                <td colspan="5" class="text-center">
                    No registrations found.
                </td>

            </tr>

            @endforelse

        </tbody>

    </table>

</div>

@endsection