<?php

namespace App\Http\Controllers;

use App\Models\EventLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EventLogController extends Controller
{
    public function logEvent(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'event_name' => 'required|string',
            'event_label' => 'nullable|string',
            'metadata' => 'nullable|array',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $validated = $validator->validated();

        $eventLog = EventLog::create([
            'user_id' => auth()->id() ?? null, // For logged-in users, or null for guests
            'event_name' => $validated['event_name'],
            'event_label' => $validated['event_label'],
            'metadata' => json_encode($validated['metadata']),
        ]);

        return response()->json(['message' => 'Event logged successfully', 'data' => $eventLog], 201); // Include logged data
    }
}