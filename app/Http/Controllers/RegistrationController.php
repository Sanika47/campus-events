<?php

namespace App\Http\Controllers;
use App\Models\EventRegistration;
use App\Models\User;

class RegistrationController extends Controller
{
    public function index()
    {
        $registrations = EventRegistration::with([
            'user',
            'event'
    ])->get();

    return view('events.registrations',
        compact('registrations')
        );
    }

    public function store(Request $request)
    {
        EventRegistration::create([

            'event_id' => $request->event_id,

            'user_id' => auth()->id()

        ]);

        return response()->json([

            'message' => 'Registration successful'

    ]);
}
}
