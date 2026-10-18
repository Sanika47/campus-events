@extends('layouts.app')

@section('content')

<div class="container mt-4">

    <h2 class="mb-4">Edit Event</h2>

    <!-- Success/Error Messages -->
    <div id="messageArea"></div>

    <!-- Hidden Event ID -->
    <input type="hidden" id="event_id" value="{{ $id }}">

    <form id="editForm">

        <!-- Event Title -->
        <div class="mb-3">
            <label class="form-label">Event Title</label>
            <input
                type="text"
                id="title"
                class="form-control"
                required>
        </div>

        <!-- Venue -->
        <div class="mb-3">
            <label class="form-label">Venue</label>
            <input
                type="text"
                id="venue"
                class="form-control"
                required>
        </div>

        <!-- Event Date -->
        <div class="mb-3">
            <label class="form-label">Event Date</label>
            <input
                type="date"
                id="event_date"
                class="form-control"
                required>
        </div>

        <!-- Start Time -->
        <div class="mb-3">
            <label class="form-label">Start Time</label>
            <input
                type="time"
                id="start_time"
                class="form-control"
                required>
        </div>

        <!-- End Time -->
        <div class="mb-3">
            <label class="form-label">End Time</label>
            <input
                type="time"
                id="end_time"
                class="form-control"
                required>
        </div>

        <!-- Status -->
        <div class="mb-3">
            <label class="form-label">Status</label>

            <select
                id="status"
                class="form-control">

                <option value="Scheduled">Scheduled</option>
                <option value="Cancelled">Cancelled</option>
                <option value="Completed">Completed</option>

            </select>
        </div>

        <!-- Buttons -->
        <button
            type="submit"
            class="btn btn-primary">
            Update Event
        </button>

        <a
            href="/manage"
            class="btn btn-secondary">
            Back
        </a>

    </form>

</div>

<script>

// Get event ID from hidden input
const eventId = document.getElementById('event_id').value;

// Load event details
loadEvent();

function loadEvent()
{
    fetch('/api/v1/events/' + eventId)

    .then(response => response.json())

    .then(event => {

        document.getElementById('title').value =
        event.title || '';

        document.getElementById('venue').value =
        event.venue || '';

        document.getElementById('event_date').value =
        event.event_date || '';

        document.getElementById('start_time').value =
        event.start_time || '';

        document.getElementById('end_time').value =
        event.end_time || '';

        document.getElementById('status').value =
        event.status || 'Scheduled';

    })

    .catch(error => {

        console.error(error);

        document.getElementById('messageArea').innerHTML =
        `
        <div class="alert alert-danger">
            Failed to load event details.
        </div>
        `;

    });
}


// Update event
document.getElementById('editForm')

.addEventListener('submit', function(e){

    e.preventDefault();

    fetch('/api/v1/events/' + eventId, {

        method: 'PUT',

        headers: {

            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'Authorization':
            'Bearer ' + localStorage.getItem('token')

        },

        body: JSON.stringify({

            title:
            document.getElementById('title').value,

            venue:
            document.getElementById('venue').value,

            event_date:
            document.getElementById('event_date').value,

            start_time:
            document.getElementById('start_time').value,

            end_time:
            document.getElementById('end_time').value,

            status:
            document.getElementById('status').value

        })

    })

    .then(response => response.json())

    .then(data => {

        document.getElementById('messageArea').innerHTML =
        `
        <div class="alert alert-success">
            Event updated successfully.
        </div>
        `;

        // Go back to Manage Events after 2 cation.href = '/manage';

        }, 2000);

    })

    .catch(error => {

        console.error(error);

        document.getElementById('messageArea').innerHTML =
        `
        <div class="alert alert-danger">
            Failed to update event.
        </div>
        `;

    });

});

</script>

@endsection