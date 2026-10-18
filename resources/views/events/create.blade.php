@extends('layouts.app')

@section('content')

<div class="container">

    <!-- Page Title -->
    <h2 class="mb-4">Create Event</h2>

    <!-- Create Event Form -->
    <form id="eventForm">

        <!-- Event Title -->
        <div class="mb-3">
            <label class="form-label">Title</label>

            <input type="text"
                   id="title"
                   class="form-control"
                   required>
        </div>

        <!-- Event Description -->
        <div class="mb-3">
            <label class="form-label">Description</label>

            <textarea id="description"
                      class="form-control"
                      rows="4"
                      required></textarea>
        </div>

        <!-- Category -->
        <div class="mb-3">

            <label class="form-label">Category</label>

            <select id="category_id"
                        class="form-control"
                        required>

                <option value="">Select Category</option>

                <option value="1">Academic</option>
                <option value="2">Sport</option>
                <option value="3">Career</option>
                <option value="4">Workshop</option>
                <option value="5">Entertainment</option>

            </select>

        </div>
        
        <!-- Event Venue -->
        <div class="mb-3">
            <label class="form-label">Venue</label>

            <input type="text"
                   id="venue"
                   class="form-control"
                   required>
        </div>

        <!-- Event Date -->
        <div class="mb-3">
            <label class="form-label">Event Date</label>

            <input type="date"
                   id="event_date"
                   class="form-control"
                   required>
        </div>

        <!--Start Time-->
        <div class="mb-3">
            <label class="form-label">Start Time</label>

            <input type="time"
                    id="start_time"
                    class="form-control"
                    required>
        </div>

        <!-- End Tme -->
        <div class="mb-3">
            <label class="form-label">End Time</label>

            <input type="time"
                    id="end_time"
                    class="form-control"
                    required>
        </div>

        <!-- Organizer -->
        <div class="mb-3">
            <label class="form-label">Organizer</label>

            <input type="text"
                    id="organizer"
                    class="form-control"
                    required>
            </div>

         <!--Maximum Capacity-->   
        <div class="mb-3">
            <label class="form-label">Maximum Capacity</label>

            <input type="number"
                    id="max_capacity"
                    class="form-control"
                    required>
        </div>

        <!--Status-->
        <div class="mb-3">
            <label class="form-label">Status</label>

        <select id="status"
                    class="form-control">

            <option value="Upcoming">
                Upcoming
            </option>

            <option value="Ongoing">
                Ongoing
            </option>

            <option value="Completed">
                Completed
            </option>

            <option value="Cancelled">
                Cancelled
            </option>

        </select>

    </div>

        <!-- Submit Button -->
        <button type="submit"
                class="btn btn-success">
            Save Event
        </button>

    </form>

    <!-- Display Messages -->
    <div id="message" class="mt-3"></div>

</div>

<script>

// Handle event creation
document.getElementById('eventForm')
.addEventListener('submit', async function(e){

    e.preventDefault();

    const title =
    document.getElementById('title').value;

    const description =
    document.getElementById('description').value;

    const venue =
    document.getElementById('venue').value;

    const category_id =
    document.getElementById('category_id').value;

    const event_date =
    document.getElementById('event_date').value;

    const start_time =
    document.getElementById('start_time').value;

    const end_time =
    document.getElementById('end_time').value;

    const organizer =
    document.getElementById('organizer').value;

    const max_capacity =
    document.getElementById('max_capacity').value;

    const status =
    document.getElementById('status').value;

    try {

        const response =
        await fetch('/api/v1/events', {

            method: 'POST',

            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'Authorization':
                'Bearer ' + localStorage.getItem('token')
            },

            body: JSON.stringify({

                title,
                description,
                category_id,
                venue,
                event_date,
                start_time,
                end_time,
                organizer,
                max_capacity,
                status

            })

        });

        if(!response.ok){
            const errorData = await response.json();

            console.log(errorData);

            throw new Error(JSON.stringify(errorData));
        }

        document.getElementById('message').innerHTML = `
            <div class="alert alert-success">
                Event Created Successfully
            </div>
        `;

        document.getElementById('eventForm').reset();

    }
    catch(error){

        console.error(error);
        alert(error);

        document.getElementById('message').innerHTML = `
            <div class="alert alert-danger">
                Could Not Create Event
            </div>
        `;

    }

});

</script>

@endsection