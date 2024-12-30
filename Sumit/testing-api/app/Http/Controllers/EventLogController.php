<?php
namespace App\Http\Controllers;

use App\Models\EventLog;
use Illuminate\Http\Request;

class EventLogController extends Controller
{
    public function logEvent(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'event_name' => 'required|string|max:255',
            'event_label' => 'nullable|string|max:255',
            'metadata' => 'nullable|array',
        ]);

        // Save the event log to the database
        EventLog::create([
            'user_id' => auth()->id() ?? null, // Optional: If user is logged in
            'event_name' => $validated['event_name'],
            'event_label' => $validated['event_label'],
            'metadata' => json_encode($validated['metadata']),
        ]);

        // Respond with a success message
        return response()->json(['message' => 'Event logged successfully'], 200);
    }
}
