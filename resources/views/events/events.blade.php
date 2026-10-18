@extends('layouts.app')

@section('content')

<div class="container mt-4">

    <div class="text-center mb-4">

        <h2>Upcoming Campus Events</h2>

        <p>
            Browse all upcoming events planned by event organizers.
        </p>

    </div>

    <div id="messageArea"></div>

    <div class="row" id="events"></div>

</div>

<script>

// Logged in role
let role = localStorage.getItem('role');

if(!role)
{
    role = 'Guest';
}

// Load Events
fetch('/api/v1/events')

.then(response => response.json())

.then(events => {

    let html = '';

    events.forEach(event => {

        let actionButton = '';

        // Student can register
        if(role === 'Student')
        {
            actionButton = `
                <button
                    class="btn btn-success mt-2"
                    onclick="registerEvent(${event.id})">
                    Register For Event
                </button>
            `;
        }
        else
        {
            actionButton = `
                <a
                    href="/register"
                    class="btn btn-warning mt-2">
                    Register As Student
                </a>
            `;
        }

        html += `

        <div class="col-md-4 mb-4">

            <div class="card shadow h-100">

                <div class="card-body">

                    <h4>${event.title}</h4>

                    <p>
                        ${event.description ?? ''}
                    </p>

                    <hr>

                    <p>
                        <strong>Venue:</strong>
                        ${event.venue ?? 'N/A'}
                    </p>

                    <p>
                        <strong>Date:</strong>
                        ${event.event_date ?? 'N/A'}
                    </p>

                    <p>
                        <strong>Start Time:</strong>
                        ${event.start_time ?? 'N/A'}
                    </p>

                    <p>
                        <strong>End Time:</strong>
                        ${event.end_time ?? 'N/A'}
                    </p>

                    <p>
                        <strong>Status:</strong>
                        ${event.status ?? 'Scheduled'}
                    </p>

                    ${actionButton}

                </div>

            </div>

        </div>

        `;

    });

    document.getElementById('events').innerHTML = html;

})

.catch(error => {

    console.error(error);

});


// Register Event
function registerEvent(eventId)
{
    fetch('/api/v1/register-event', {

        method: 'POST',

        headers: {

            'Content-Type': 'application/json',

            'Accept': 'application/json',

            'Authorization':
            'Bearer ' + localStorage.getItem('token')

        },

        body: JSON.stringify({

            event_id: eventId

        })

    })

    .then(response => response.json())

    .then(data => {

        document.getElementById('messageArea').innerHTML =

        `
        <div class="alert alert-success">
            Successfully registered for event.
        </div>
        `;

    })

    .catch(error => {

        console.error(error);

        document.getElementById('messageArea').innerHTML =

        `
        <div class="alert alert-danger">
            Registration failed.
        </div>
        `;

    });
}

</script>

@endsection