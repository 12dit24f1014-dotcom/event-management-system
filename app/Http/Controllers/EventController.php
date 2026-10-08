<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::all();
        return view('events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('events.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
        'event_name' => 'required|string|max:150',
        'event_date' => 'required|date',
        'venue' => 'required|string|max:100',
        'target_audience' => 'required|string|max:100',
        'budget' => 'required|numeric|min:0',
        'status' => 'required'
    ]);

    Event::create([
        'event_name' => $request->event_name,
        'event_date' => $request->event_date,
        'venue' => $request->venue,
        'target_audience' => $request->target_audience,
        'budget' => $request->budget,
        'status' => $request->status
    ]);

    return redirect()->route('events.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $event = Event::findOrFail($id);
        return view('events.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    $request->validate([
        'event_name' => 'required|string|max:150',
        'event_date' => 'required|date',
        'venue' => 'required|string|max:100',
        'target_audience' => 'required|string|max:100',
        'budget' => 'required|numeric|min:0',
        'status' => 'required'
    ]);

    $event = Event::findOrFail($id);

    $event->update([
        'event_name' => $request->event_name,
        'event_date' => $request->event_date,
        'venue' => $request->venue,
        'target_audience' => $request->target_audience,
        'budget' => $request->budget,
        'status' => $request->status
    ]);

    return redirect()->route('events.index');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
    $event = Event::findOrFail($id);
    $event->delete();
    return redirect()->route('events.index');
    }
}
