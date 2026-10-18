@extends('layouts.app')

@section('content')

<div class="container mt-4">

    <!-- Header -->
    <div class="card shadow-lg border-0 bg-primary text-white mb-4">

        <div class="card-body text-center">

            <h2>Campus Events Platform</h2>

            <h4 id="welcomeUser">
                Welcome User
            </h4>

            <span
                id="roleBadge"
                class="badge bg-light text-dark fs-6">
            </span>

        </div>

    </div>

    <!-- Dashboard Content -->
    <div class="row" id="dashboardContent">

    </div>

</div>

<script>

// =======================
// User Information
// =======================

let role = localStorage.getItem('role');
let userName = localStorage.getItem('user_name');

if(!role)
{
    role = 'Guest';
}

if(!userName)
{
    userName = 'Guest';
}

document.getElementById('welcomeUser').innerHTML =
    'Welcome, ' + userName;

document.getElementById('roleBadge').innerHTML = role;

// Events from Laravel
let weeklyEvents = @json($weeklyEvents);

let dashboardHTML = '';

// =======================
// STUDENT DASHBOARD
// =======================

function studentDashboard()
{
    let eventsHTML = '';

    if (weeklyEvents.length > 0)
    {
        weeklyEvents.forEach(event =>
        {
            eventsHTML += `
                <div class="card mb-2 border-primary">

                    <div class="card-body">

                        <h5>${event.title}</h5>

                        <p>
                            <strong>Date:</strong>
                            ${event.event_date}
                        </p>

                        <p>
                            <strong>Venue:</strong>
                            ${event.venue}
                        </p>

                    </div>

                </div>
            `;
        });
    }
    else
    {
        eventsHTML = `
            <div class="alert alert-info">
                No events scheduled this week.
            </div>
        `;
    }

    return `
        <div class="col-md-12 mb-4">

            <div class="card shadow h-100">

                <div class="card-body">

                    <h4>Upcoming Events</h4>

                    <p>
                        View upcoming campus events,
                        dates and venues.
                    </p>

                    ${eventsHTML}

                    <a href="/events"
                       class="btn btn-primary">

                        Browse Events

                    </a>

                </div>

            </div>

        </div>
    `;
}

    
// =======================
// EVENT ORGANISER
// =======================

function organiserDashboard()
{
    return `

    <div class="col-md-6 mb-4">

        <div class="card shadow h-100">

            <div class="card-body">

                <h4>Manage Events</h4>

                <p>
                    Edit event details,
                    venue and schedules.
                </p>

                <a href="/manage"
                   class="btn btn-warning">

                    Manage Events

                </a>

            </div>

        </div>

    </div>

    <div class="col-md-6 mb-4">

        <div class="card shadow h-100">

            <div class="card-body">

                <h4>Registered Students</h4>

                <p>
                    View students registered
                    for planned events.
                </p>

                <a href="/registrations"
                   class="btn btn-success">

                    View Students

                </a>

            </div>

        </div>

    </div>

    `;
}


// =======================
// ADMIN DASHBOARD
// =======================

function adminDashboard()
{
    return `

    <div class="col-md-3 mb-4">

        <div class="card shadow h-100">

            <div class="card-body">

                <h4>Users</h4>

                <p>
                    Manage system users.
                </p>

                <a href="/users"
                   class="btn btn-primary">

                    Users

                </a>

            </div>

        </div>

    </div>

    <div class="col-md-3 mb-4">

        <div class="card shadow h-100">

            <div class="card-body">

                <h4>Events</h4>

                <p>
                    Manage all events.
                </p>

                <a href="/events"
                   class="btn btn-success">

                    Events

                </a>

            </div>

        </div>

    </div>

    <div class="col-md-3 mb-4">

        <div class="card shadow h-100">

            <div class="card-body">

                <h4>Reports</h4>

                <p>
                    Generate reports.
                </p>

                <a href="/reports"
                   class="btn btn-warning">

                    Reports

                </a>

            </div>

        </div>

    </div>

    <div class="col-md-3 mb-4">

        <div class="card shadow h-100">

            <div class="card-body">

                <h4>Settings</h4>

                <p>
                    Configure the system.
                </p>

                <a href="/settings"
                   class="btn btn-danger">

                    Settings

                </a>

            </div>

        </div>

    </div>

    `;
}


// =======================
// GUEST DASHBOARD
// =======================

function guestDashboard()
{
    return `

    <div class="col-md-6 mb-4">

        <div class="card shadow h-100">

            <div class="card-body">

                <h4>Browse Events</h4>

                <p>
                    View events, dates
                    and venues.
                </p>

                <a href="/events"
                   class="btn btn-primary">

                    View Events

                </a>

            </div>

        </div>

    </div>

    <div class="col-md-6 mb-4">

        <div class="card shadow h-100">

            <div class="card-body">

                <h4>Create Account</h4>

                <p>
                    Register to participate
                    in campus activities.
                </p>

                <a href="/register"
                   class="btn btn-success">

                    Register

                </a>

            </div>

        </div>

    </div>

    `;
}


// =======================
// DISPLAY DASHBOARD
// =======================

if(role === 'Student')
{
    dashboardHTML = studentDashboard();
}
else if(role === 'Event Organizer')
{
    dashboardHTML = organiserDashboard();
}
else if(role === 'Administrator')
{
    dashboardHTML = adminDashboard();
}
else
{
    dashboardHTML = guestDashboard();
}

document.getElementById('dashboardContent').innerHTML =
    dashboardHTML;


// =======================
// LOGOUT
// =======================

function logout()
{
    localStorage.removeItem('role');
    localStorage.removeItem('user_name');
    localStorage.removeItem('token');

    window.location.href = '/login';
}

</script>

@endsection