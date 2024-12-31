<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;


class FullCalenderController extends Controller
{
    public function full_calender(Request $request){

            if ($request->ajax()) {
                $events = Event::select('id', 'title', 'start', 'end')
                               ->whereDate('start', '>=', $request->start)
                               ->whereDate('end', '<=', $request->end)
                               ->get();
        
                // Return the data in a format FullCalendar expects
                return response()->json($events);
            }
            return view('full_calender');
    }
        
    

    public function action(Request $request)
    {
        if($request->ajax()){
            // Check for 'add', 'update', and 'delete' actions
            if($request->type == 'add'){
                $event = Event::create([
                    'title' => $request->title,
                    'start' => $request->start,
                    'end' => $request->end
                ]);
                return response()->json($event);
            }

            if($request->type == 'update'){
                $event = Event::find($request->id);
                if ($event) {
                    $event->update([
                        'title' => $request->title,
                        'start' => $request->start,
                        'end' => $request->end
                    ]);
                    return response()->json($event);
                }
                return response()->json(['error' => 'Event not found'], 404);
            }

            if($request->type == 'delete'){
                $event = Event::find($request->id);
                if ($event) {
                    $event->delete();
                    return response()->json(['success' => true, 'Event deleted successfully']);
                }
                return response()->json(['error' => 'Event not found'], 404);
            }
        }
    }

}
