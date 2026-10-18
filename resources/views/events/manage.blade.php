@extends('layouts.app')

@section('content')

<div class="container">

    {{-- Page Title --}}
    <h2 class="mb-4">Manage Events</h2>

    {{-- Success Message Area --}}
<div class="d-flex justify-content-between mb-2">

    <h2>Manage Events</h2>

    <a href="/create"
       class="btn btn-success">
        Create Event
    </a>

</div>

    {{-- Events Table --}}
    <table class="table table-bordered table-striped">

        <thead class="table-dark">
            <tr>
                <th>Title</th>
                <th>Venue</th>
                <th>Date</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Status</th>
                <th width="220">Actions</th>
            </tr>
        </thead>

        <tbody id="eventsTable">

            {{-- Events loaded from API will appear here --}}

        </tbody>

    </table>

</div>

<script>

    // Load events when page opens
    loadEvents();

    function loadEvents()
    {
        fetch('/api/v1/events')

        .then(response => response.json())

        .then(events => {

            let html = '';

            events.forEach(event => {

                html += `
                <tr>

                    <td>${event.title}</td>

                    <td>${event.venue}</td>

                    <td>${event.event_date}</td>

                    <td>${event.start_time}</td>

                    <td>${event.end_time}</td>

                    <td>${event.status}</td>

                    <td>

                        <!-- Edit / Reschedule Event -->
                        <button
                            class="btn btn-warning btn-sm"
                            onclick="editEvent(${event.id})">
                            Edit
                        </button>

                        <!-- Delete Event -->
                        <button
                            class="btn btn-danger btn-sm"
                            onclick="deleteEvent(${event.id})">
                            Delete
                        </button>

                    </td>

                </tr>
                `;
            });

            document.getElementById('eventsTable').innerHTML = html;
        })

        .catch(error => {

            console.error(error);

            alert('Failed to load events.');

        });
    }


    // Edit Event
    function editEvent(id)
    {
        window.location.href = '/edit/' + id;
    }


    // Delete Event
    function deleteEvent(id)
    {
        let confirmDelete =
        confirm('Are you sure you want to delete this event?');

        if(!confirmDelete)
        {
            return;
        }

        fetch('/api/v1/events/' + id, {

            method: 'DELETE',

            headers: {

                'Accept': 'application/json',

                'Authorization':
                'Bearer ' + localStorage.getItem('token')

            }

        })

        .then(response => response.json())

        .then(data => {

            document.getElementById('messageArea').innerHTML =
            `
            <div class="alert alert-success">
                Event deleted successfully.
            </div>
            `;

            loadEvents();

        })

        .catch(error => {

            console.error(error);

            alert('Failed to delete event.');

        });
    }

</script>

@endsection