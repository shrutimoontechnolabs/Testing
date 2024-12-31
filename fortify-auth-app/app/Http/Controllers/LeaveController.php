<?php

namespace App\Http\Controllers;

use App\Models\Leave;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class LeaveController extends Controller
{
    
    public function index(Request $request)
{
    if ($request->ajax()) {
        // Filter leaves by authenticated user
        $leaves = Leave::where('user_id', Auth::id())->get();
        
        // Return leaves data for DataTable
        return DataTables::of($leaves)
            ->addColumn('action', function ($leave) {
                return '
                    <button data-id="' . $leave->id . '" class="btn btn-sm btn-success edit-leave">Edit</button>
                    <button data-id="' . $leave->id . '" class="btn btn-sm btn-danger delete-leave">Delete</button>
                ';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    // For regular page load, we are passing all leaves of the current user
    $userLeaves = Leave::where('user_id', Auth::id())->get();
    return view('user.userleave', compact('userLeaves'));
}


    public function create()
    {
        return view('user.addleave');
    }

    public function store(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'startDateOptions' => 'required|string|in:fullDay,1half,2half',
            'end_date' => 'required|date|after_or_equal:start_date',
            'endDateOptions' => 'nullable|string|in:fullDay,1half,2half',
            'reason' => 'string',
        ]);

        Leave::create([
            'user_id' => Auth::id(),
            'start_date' => $request->start_date,
            'start_date_type' => $request->startDateOptions,
            'end_date' => $request->end_date,
            'end_date_type' => $request->endDateOptions,
            'reason' => $request->reason,
        ]);

        return redirect()->route('leaves.index')->with('success', 'Leave request submitted successfully.');
    }

    public function edit(string $id)
    {
        $leave = Leave::findOrFail($id);
        // dd($leave);
        return view('user.editleave',compact('leave'));
    }

    public function update(Request $request)
    {
        try {
            $request->validate([
                'id' => 'required|exists:leaves,id',
                'start_date' => 'required|date',
                'start_date_type' => 'required|string|in:fullDay,1half,2half',
                'end_date' => 'required|date|after_or_equal:start_date',
                'end_date_type' => 'nullable|string|in:fullDay,1half,2half',
                'reason' => 'required|string|max:500',
            ]);
    
            $leave = Leave::findOrFail($request->id);
            $leave->update($request->only(['start_date', 'start_date_type' ,'end_date', 'end_date_type' ,'reason']));
            return redirect()->route('leaves.index')->with('success', 'Leave updated successfully.');
            
        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Unable to update leave - ' . $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
{
    $leave = Leave::findOrFail($id);  // Find the leave by ID or fail

    if ($leave) {
        $leave->delete();  // Delete the leave
        return response()->json([
            'status' => 'success',
            'message' => 'leave deleted successfully'
        ]);
    }

    return response()->json(['status' => 'error', 'message' => 'leave not found'], 404);
}

public function generateCsv(){
    $data = Leave::latest()->get();
    $filename = "leave.csv";
    $fp = fopen($filename, "w+");
    fputcsv($fp, array('start_date', 'start_date_type', 'end_Date', 'end_Date_type', 'Reason', 'Status'));

    foreach($data as $row){
        fputcsv($fp, array($row->start_date, $row->start_date_type, $row->end_date_type , $row->end_date_type, $row->Reason, $row->Status));
    }

    fclose($fp);
    $headers = array('Content-Type' => 'text/csv');

    return response()->download($filename, 'leave.csv', $headers);
}

//-----------------------------------------admin----------------------------------------

public function adminIndex(Request $request)
{
    if ($request->ajax()) {
        // Admin sees all leaves
        $leaves = Leave::query();

        return DataTables::of($leaves)

        ->addColumn('user_name', function ($leave) {
            return $leave->user->name; 
        })
            ->addColumn('action', function ($leave) {
                $approveButton = '<button data-id="' . $leave->id . '" class="btn btn-sm btn-success approve-leave">Approve</button>';
                $rejectButton = '<button data-id="' . $leave->id . '" class="btn btn-sm btn-danger reject-leave">Reject</button>';

                return $approveButton . ' ' . $rejectButton;
            })
            ->editColumn('status', function ($leave) {
                return ucfirst($leave->status); // Capitalize the status
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    // Render the admin manage leave view
    return view('adminmanageleave');
}


    public function approve($id)
    {
        $leave = Leave::findOrFail($id);
        $leave->status = 'approved';
        $leave->save();

        return response()->json(['status' => 'success', 'message' => 'Leave approved successfully!']);
    }

    public function reject($id)
    {
        $leave = Leave::findOrFail($id);
        $leave->status = 'rejected';
        $leave->save();

        return response()->json(['status' => 'success', 'message' => 'Leave rejected successfully!']);
    }


}
