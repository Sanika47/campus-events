<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Event::with('category')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required',
            'description'=>'required',
            'category_id'=>'required',
        ]);
        return Event::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function update(Request $request, $id)
    {
        $event = Event::findOrFail($id);

        $event->update([
            'title' => $request->title,
            'venue' => $request->venue,
            'event_date' => $request->event_date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'status' => $request->status
        ]);

        return response()->json([
            'message' => 'Event updated successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Event::destroy($id);

        return response()->json([
            'message'=>'Deleted'
        ]);
    }
}
