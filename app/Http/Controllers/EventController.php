<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Carbon\Carbon;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::when(request('start') && request('end'), function($query) {
            return $query->whereBetween('start_date', [
                request('start'), 
                request('end')
            ]);
        })->get();

        return response()->json($events);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date'
        ]);

        try {
            $event = Event::create([
                'title' => $validated['title'],
                'start_date' => Carbon::parse($validated['start_date'])->toDateString(),
                'end_date' => $validated['end_date'] 
                    ? Carbon::parse($validated['end_date'])->toDateString() 
                    : null
            ]);

            return response()->json($event, 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Event creation failed'], 500);
        }
    }

    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        $event->delete();

        return response()->json(null, 204);
    }
}
