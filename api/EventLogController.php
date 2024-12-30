<?php

namespace App\Http\Controllers;

use App\Models\EventLog;
use Illuminate\Http\Request;

class EventLogController extends Controller
{
    public function logEvent(Request $request)
    {
        // Validate input
        $validated = $request->validate([
            'event_name' => 'required|string',
            'event_label' => 'nullable|string',
            'metadata' => 'nullable|array',
        ]);

        // Save event log
        EventLog::create([
            'user_id' => auth()->id() ?? null, // For logged-in users, or null for guests
            'event_name' => $validated['event_name'],
            'event_label' => $validated['event_label'],
            'metadata' => json_encode($validated['metadata']),
        ]);

        return response()->json(['message' => 'Event logged successfully'], 200);
    }
}
