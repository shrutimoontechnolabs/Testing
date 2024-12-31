<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class YajraController extends Controller
{
    public function index(Request $request)
{
    if ($request->ajax()) {
        $users = User::query();

        // Filter users by role if provided
        if ($request->has('role') && $request->role != '') {
            $users->where('role', $request->role); // Filter by role name (string)
        }

        return DataTables::eloquent($users)
            ->addColumn('action', function ($user) {
                return '
                    <button data-id="' . $user->id . '" class="btn btn-sm btn-success edit-user">Edit</button>
                    <button data-id="' . $user->id . '" class="btn btn-sm btn-danger delete-user">Delete</button>
                ';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    // Fetch roles for the role filter dropdown
    $roles = User::select('role')->distinct()->get(); // Get unique roles from the users table

    return view('layouts.edituser-form', compact('roles')); // Pass roles to the view
}


public function edit($id)
{

    $user = User::findOrFail($id);
     $roles = Role::pluck('title', 'id'); // Fetch roles from the database, adjust according to your role structure

    return view('edit', compact('user', 'roles'));
}

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        if ($user) {
            $user->delete();
            return response()->json(['status' => 'success', 'message' => 'User deleted successfully']);
        }
        return response()->json(['status' => 'error', 'message' => 'User not found'], 404);
    }


    public function update(Request $request)
    {
        
        try {
            // Validate the request data
            $request->validate([
                'id' => 'required|exists:users,id',
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255|unique:users,email,' . $request->id,
                'phone' => 'nullable|numeric',
                'city' => 'nullable|string|max:255',
                'gender' => 'nullable|string|max:10',
                'role' => 'required', 
            ]);

            // Find the user
            $user = User::findOrFail($request->id);
            
            // Update the user
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'city' => $request->city,   
                'gender' => $request->gender,
                'role' => $request->role, // Ensure the column is 'role_id'
            ]);

            // Redirect to users index with success message
            return redirect()->route('users.index')->with('success', 'User updated successfully.');
        } catch (\Exception $e) {
            // Return a JSON response with the error
            return response()->json([
                'status' => 'error',
                'message' => 'Unable to update User - ' . $e->getMessage()
            ]);
        }
    }
    
}
