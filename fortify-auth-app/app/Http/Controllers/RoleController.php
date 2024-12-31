<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        
    if ($request->ajax()) {
        $roles = Role::query();
        return DataTables::eloquent($roles)
            ->addColumn('action', function ($role) {
                return '
                    <button data-id="' . $role->id . '" class="btn btn-sm btn-success edit-role">Edit</button>
                    <button data-id="' . $role->id . '" class="btn btn-sm btn-danger delete-role">Delete</button>
                ';
            })
            ->rawColumns(['action'])
            ->make(true);
    }
    $roles = Role::all();
    return view('managerole', compact('roles')); // For non-AJAX calls

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('addrole');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'status' => 'required|in:Active,Inactive',
        ]);

        Role::create([
            'title' => $request->title,
            'status' => $request->status,
        ]);

        return redirect()->route('roles.index')
        ->with('success', "role sucessfully added");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $role = Role::findOrFail($id);
        // dd($role);
        return view('editrole',compact('role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        try {
            $request->validate([
                'id' => 'required|exists:roles,id',
                'title' => 'required|string|max:255',
                'status' => 'required|in:Active,Inactive',
            ]);
    
            $role = Role::findOrFail($request->id);
            $role->update($request->only(['title', 'status']));
            return redirect()->route('roles.index')->with('success', 'User updated successfully.');
            return response()->json(['status' => 'success', 'message' => 'role Updated Successfully']);
        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Unable to update role - ' . $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
{
    $role = Role::findOrFail($id);  // Find the role by ID or fail

    if ($role) {
        $role->delete();  // Delete the role
        return response()->json([
            'status' => 'success',
            'message' => 'Role deleted successfully'
        ]);
    }

    return response()->json(['status' => 'error', 'message' => 'Role not found'], 404);
}

    // public function allRole() {
    //     $role = Role::count(); 
    //     return view('dashboard', compact('role')); // Pass the variable without the $ sign
    // }
}   
