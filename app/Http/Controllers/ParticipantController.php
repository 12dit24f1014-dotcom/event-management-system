<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use App\Models\Event;
use Illuminate\Http\Request;
use App\Imports\ParticipantsImport;
use Maatwebsite\Excel\Facades\Excel;

class ParticipantController extends Controller
{
    // Display participants
    public function index()
    {
        $participants = Participant::with('event')
            ->latest()
            ->get();

        return view('participants.index', compact('participants'));
    }

    // Show bulk participation page
    public function create()
    {
        $events = Event::all();

        return view('participants.create', compact('events'));
    }

    // Import participants from CSV / Excel
    public function import(Request $request)
    {
        $request->validate([
            'event_id' => 'required|exists:events,id',
            'file' => 'required|mimes:csv,xlsx|max:2048',
        ]);

        Excel::import(
            new ParticipantsImport($request->event_id),
            $request->file('file')
        );

        return redirect()
            ->route('participants.index')
            ->with('success', 'Participants imported successfully!');
    }
}