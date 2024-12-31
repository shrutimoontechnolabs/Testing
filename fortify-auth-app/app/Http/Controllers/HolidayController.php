<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Holiday;
use Illuminate\Http\Request;


class HolidayController extends Controller
{
    //
    public function store(Request $request)
    {
        // Validate the input
        $request->validate([
            'holiday_date' => 'required|date|unique:holidays,holiday_date',
            'description' => 'required|string|max:255',
        ]);
    
        // Create a new holiday record
        Holiday::create([
            'holiday_date' => $request->holiday_date,
            'description' => $request->description,
        ]);
    
        // Redirect back to the holidays index with a success message
        return redirect()->route('holidays.index')
            ->with('success', 'Holiday successfully added');
    }
    
    public function create(){
        return view('addholiday');
    }

    function getHolidaysForYear()
    {
        $year = Carbon::now()->year;
        // Fetch manually entered holidays from the database
        $customHolidays = Holiday::whereYear('holiday_date', $year)->get();
    
        // Generate weekends dynamically
        $weekends = [];
        $startDate = Carbon::createFromDate($year, 1, 1);
        $endDate = Carbon::createFromDate($year, 12, 31);
    
        while ($startDate->lte($endDate)) {
            if ($startDate->isSaturday() || $startDate->isSunday()) {
                $weekends[] = [
                    'description' => 'Weekend',
                    'holiday_date_raw' => $startDate->copy(), // Store raw date for sorting
                    'holiday_date' => $startDate->format('M d, Y'),
                    'day' => $startDate->format('l')
                ];
            }
            $startDate->addDay();
        }
    
        // Merge custom holidays with generated weekends
        $holidays = collect($customHolidays)
            ->map(function ($holiday) {
                $holidayDate = Carbon::parse($holiday->holiday_date);
                return [
                    'description' => $holiday->description,
                    'holiday_date_raw' => $holidayDate, // Store raw date for sorting
                    'holiday_date' => $holidayDate->format('M d, Y'),
                    'day' => $holidayDate->format('l')
                ];
            })
            ->merge($weekends)
            ->unique('holiday_date')
            ->sortBy('holiday_date_raw') // Sort using raw date
            ->map(function ($holiday) {
                unset($holiday['holiday_date_raw']); // Remove raw date after sorting
                return $holiday;
            })
            ->values();
    
        return view("manageholiday", compact("holidays"));
    }
}
