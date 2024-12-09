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

        return DataTables::eloquent($users)
            ->addColumn('action', function ($user) {
                return '
                    <button data-id="' . $user->id . '" class="btn btn-sm btn-success edit-user ">Edit</button>
                    <button data-id="' . $user->id . '" class="btn btn-sm btn-danger delete-user">Delete</button>
                ';
            })
            ->rawColumns(['action'])
            ->make(true);
    }
    $users = User::all();  // Fetch all users for non-AJAX page load
    return view('layouts.edituser-form', compact('users')); // Pass $users to the view
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
        $request->validate([
            'id' => 'required|exists:users,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $request->id,
            'phone' => 'nullable|numeric',
            'city' => 'nullable|string|max:255',
            'gender' => 'nullable|string|max:10',
            'role' => 'required|exists:roles,id', // Ensure this validates the role ID
        ]);
        

        // Find the user and update
        $user = User::findOrFail($request->id);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'city' => $request->city,
            'gender' => $request->gender,
            'role_id' => $request->role, // Assign role ID
        ]);

        // Redirect after successful update
        return redirect()->route('users.index');
    } catch (\Exception $e) {
        // Catch and return the error message
        return response()->json(['status' => 'error', 'message' => 'Unable to update User - ' . $e->getMessage()]);
    }
}


    
}
