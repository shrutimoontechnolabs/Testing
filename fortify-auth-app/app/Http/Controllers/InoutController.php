<?php
namespace App\Http\Controllers;

use App\Models\Inout;
use Illuminate\Http\Request;
use Carbon\Carbon;

class InoutController extends Controller
{
  
//     public function create()
//     {
//         // Get all the inout records for the logged-in user
//         $inouts = Inout::where('user_id', auth()->user()->id)
//                        ->get()
//                        ->map(function($inout) {
//                            // Format in_time and out_time in 12-hour format with AM/PM
//                            $inout->in_time = $inout->in_time ? Carbon::parse($inout->in_time)->format('h:i:s A') : null;
//                            $inout->out_time = $inout->out_time ? Carbon::parse($inout->out_time)->format('h:i:s A') : null;
    
//                            // Calculate the hours worked (if clocked out)
//                            if ($inout->in_time && $inout->out_time) {
//                                 $inTime = Carbon::parse($inout->in_time);
//                                 $outTime = Carbon::parse($inout->out_time);
//                                 $totalDuration = $outTime->diff($inTime);
        
//                                 $hours = str_pad($totalDuration->h, 2, '0', STR_PAD_LEFT);
//                                 $minutes = str_pad($totalDuration->i, 2, '0', STR_PAD_LEFT);
//                                 $seconds = str_pad($totalDuration->s, 2, '0', STR_PAD_LEFT);
        
//                                $inout->hours = "$hours:$minutes:$seconds";
//                            }
//                            return $inout;
//                        });
    
//         return view('user.InOut', compact('inouts'));
//     }
    
//    public function clockIn(Request $request)
//     {
//         $user = auth()->user();

//         // Check if the user has already clocked in and out today
//         $existingClockInOut = Inout::where('user_id', $user->id)
//                                     ->where('date', $request->date)
//                                     ->whereNotNull('in_time')
//                                     ->whereNotNull('out_time') // Ensure both in_time and out_time exist
//                                     ->first();

//         if ($existingClockInOut) {
//             return response()->json(['message' => 'You have already clocked in and out today.'], 400);
//         }

//         // Check if the user has already clocked in today but not clocked out
//         $existingClockIn = Inout::where('user_id', $user->id)
//                                 ->where('date', $request->date)
//                                 ->whereNull('out_time') // Ensure there is no out_time
//                                 ->first();

//         if ($existingClockIn) {
//             return response()->json(['message' => 'You have already clocked in today.'], 400);
//         }

//         // Otherwise, allow clock-in
//         Inout::create([
//             'user_id' => $user->id,
//             'date' => $request->date,
//             'day' => $request->day,
//             'in_time' => Carbon::parse($request->in_time)->format('Y-m-d H:i:s'), // Correct format
//             'hours' => $request->hours,
//         ]);

//         return response()->json(['message' => 'Clocked in successfully.']);
//     }

    
// public function clockOut(Request $request)
// {
//     $user = auth()->user();

//     // Check if the user has already clocked in today
//     $inout = Inout::where('user_id', $user->id)
//                   ->where('date', $request->date)
//                   ->whereNotNull('in_time') // Ensure there is an in_time
//                   ->whereNull('out_time')  // Ensure there's no out_time
//                   ->first();

//     if (!$inout) {
//         return response()->json(['message' => 'You have not clocked in today or already clocked out.'], 400);
//     }

//     // Otherwise, allow clock-out
//     $inout->update([
//         'out_time' => Carbon::parse($request->out_time)->format('Y-m-d H:i:s')
//     ]);

//     return response()->json(['message' => 'Clocked out successfully.']);
// }

//     //-----------------------finmd current week logs---------------------------

//     public function userDashboard()
//     {       
//         $user = auth()->user();

//         // Get the start and end dates for the current week
//         $startOfWeek = Carbon::now()->startOfWeek(); // e.g., Monday
//         $endOfWeek = Carbon::now()->endOfWeek(); // e.g., Sunday

//         // Fetch records for the current week
//         $inouts = Inout::where('user_id', $user->id)
//                     ->whereBetween('date', [$startOfWeek->toDateString(), $endOfWeek->toDateString()])
//                     ->get()
//                     ->map(function ($inout) {
//                         // Format in_time and out_time to 12-hour format with AM/PM
//                         $inout->in_time = $inout->in_time ? Carbon::parse($inout->in_time)->format('h:i:s A') : null;
//                         $inout->out_time = $inout->out_time ? Carbon::parse($inout->out_time)->format('h:i:s A') : null;

//                         // Calculate total hours worked (if clocked out)
//                         if ($inout->in_time && $inout->out_time) {
//                             $inTime = Carbon::parse($inout->in_time);
//                             $outTime = Carbon::parse($inout->out_time);
//                             $totalDuration = $outTime->diff($inTime);

//                             $hours = str_pad($totalDuration->h, 2, '0', STR_PAD_LEFT);
//                             $minutes = str_pad($totalDuration->i, 2, '0', STR_PAD_LEFT);
//                             $seconds = str_pad($totalDuration->s, 2, '0', STR_PAD_LEFT);

//                             $inout->hours = "$hours:$minutes:$seconds";
//                         }
//                         return $inout;
//                     });

//         // Pass the $inouts variable to the view
//         return view('user.userdashboard', compact('inouts'));
//     }





    public function create()
    {
        $config = config('const');

        // Get all the in/out records for the logged-in user
        $inouts = Inout::where('user_id', auth()->user()->id)
            ->get()
            ->map(function ($inout) use ($config) {
                $inout->in_time = $inout->in_time ? Carbon::parse($inout->in_time)->format($config['displayTime']) : null;
                $inout->out_time = $inout->out_time ? Carbon::parse($inout->out_time)->format($config['displayTime']) : null;

                if ($inout->in_time && $inout->out_time) {
                    $inTime = Carbon::parse($inout->in_time);
                    $outTime = Carbon::parse($inout->out_time);
                    $totalDuration = $outTime->diff($inTime);

                    $hours = str_pad($totalDuration->h, 2, '0', STR_PAD_LEFT);
                    $minutes = str_pad($totalDuration->i, 2, '0', STR_PAD_LEFT);
                    $seconds = str_pad($totalDuration->s, 2, '0', STR_PAD_LEFT);

                    $inout->hours = "$hours:$minutes";
                }

                return $inout;
            });

        return view('user.InOut', compact('inouts'));
    }

    public function clockIn(Request $request)
    {
        $user = auth()->user();
    
        try {
            // Convert the date from d/m/Y to Y-m-d
            $date = Carbon::createFromFormat('d/m/Y', $request->date)->format('Y-m-d');
    
            // Validate the request data
            $request->validate([
                'date' => 'required|date_format:d/m/Y', // Validate the original format
                'day' => 'required|string',
                'in_time' => 'required|date_format:H:i:s', // Expect time in H:i:s format
            ]);
    
            // Check if the user has already clocked in and out today
            $existingClockInOut = Inout::where('user_id', $user->id)
                ->where('date', $date)
                ->whereNotNull('in_time')
                ->whereNotNull('out_time')
                ->first();
    
            if ($existingClockInOut) {
                return response()->json(['message' => 'You have already clocked in and out today.'], 400);
            }
    
            // Check if the user has already clocked in today but not clocked out
            $existingClockIn = Inout::where('user_id', $user->id)
                ->where('date', $date)
                ->whereNull('out_time')
                ->first();
    
            if ($existingClockIn) {
                return response()->json(['message' => 'You have already clocked in today.'], 400);
            }
    
            // Allow clock-in
            Inout::create([
                'user_id' => $user->id,
                'date' => $date,
                'day' => $request->day,
                'in_time' => Carbon::createFromFormat('H:i:s', $request->in_time)->format('H:i:s'),
            ]);
    
            return response()->json(['message' => 'Clocked in successfully.']);
        } catch (\Exception $e) {
            \Log::error('Clock-In Error: ' . $e->getMessage());
            return response()->json(['message' => 'An error occurred during clock-in.'], 500);
        }
    }
    
    

    public function clockOut(Request $request)
    {
        $config = config('const');
        $user = auth()->user();
    
        try {
            // Convert the date from d/m/Y to Y-m-d
            $date = Carbon::createFromFormat('d/m/Y', $request->date)->format('Y-m-d');
    
            // Validate the request data
            $request->validate([
                'date' => 'required|date_format:d/m/Y', // Validate the original format
                'out_time' => 'required|date_format:H:i:s', // Expect time in H:i:s format
            ]);
    
            // Check if the user has already clocked in today
            $inout = Inout::where('user_id', $user->id)
                ->where('date', $date)
                ->whereNotNull('in_time')
                ->whereNull('out_time')
                ->first();
    
            if (!$inout) {
                return response()->json(['message' => 'You have not clocked in today or already clocked out.'], 400);
            }
    
            // Calculate the total hours worked
            $inTime = Carbon::parse($inout->in_time);
            $outTime = Carbon::parse($request->out_time);
            $totalDuration = $outTime->diff($inTime);
    
            // Format the duration as HH:mm:ss
            $hoursWorked = str_pad($totalDuration->h, 2, '0', STR_PAD_LEFT) . ':' .
                          str_pad($totalDuration->i, 2, '0', STR_PAD_LEFT) . ':' .
                          str_pad($totalDuration->s, 2, '0', STR_PAD_LEFT);
    
            // Allow clock-out and store the hours worked
            $inout->update([
                'out_time' => Carbon::parse($request->out_time)->format($config['databaseStoredDateTimeFormat']),
                'hours' => $hoursWorked,  // Store the calculated hours worked in the database
            ]);
    
            return response()->json(['message' => 'Clocked out successfully.']);
        } catch (\Exception $e) {
            \Log::error('Clock-Out Error: ' . $e->getMessage());
            return response()->json(['message' => 'An error occurred during clock-out.'], 500);
        }
    }
    

    public function userDashboard()
    {
        $config = config('const');
        $user = auth()->user();

        // Get the start and end dates for the current week
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();

        // Fetch records for the current week
        $inouts = Inout::where('user_id', $user->id)
            ->whereBetween('date', [$startOfWeek->toDateString(), $endOfWeek->toDateString()])
            ->get()
            ->map(function ($inout) use ($config) {
                $inout->in_time = $inout->in_time ? Carbon::parse($inout->in_time)->format($config['displayTime']) : null;
                $inout->out_time = $inout->out_time ? Carbon::parse($inout->out_time)->format($config['displayTime']) : null;

                if ($inout->in_time && $inout->out_time) {
                    $inTime = Carbon::parse($inout->in_time);
                    $outTime = Carbon::parse($inout->out_time);
                    $totalDuration = $outTime->diff($inTime);

                    $hours = str_pad($totalDuration->h, 2, '0', STR_PAD_LEFT);
                    $minutes = str_pad($totalDuration->i, 2, '0', STR_PAD_LEFT);
                    $seconds = str_pad($totalDuration->s, 2, '0', STR_PAD_LEFT);

                    $inout->hours = "$hours:$minutes";
                }

                return $inout;
            });

        return view('user.userdashboard', compact('inouts'));
    }


    
}
