<?php

namespace App\Http\Controllers;


use App\Models\Role;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Display the Add User form
    public function create()
    {
        // Fetch active roles (title and id)
        $roles = Role::pluck('title', 'id');
        return view('adduser', [
            'roles' => $roles
        ]);
    }

    // Store the new user
    public function store(Request $request)
    {
        // return $request;
        // Validate incoming data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|digits:10',    
            'gender' => 'required|in:male,female,other',
            'city' => 'required|string|max:255',
            'password' => 'required|string|min:8',
            'role' => 'required', // Validate that the role_id exists in the roles table
        ]);
    
        // Handle profile image upload
        $filePath = null;
        if ($request->hasFile('profile_image')) {
            $filePath = $request->file('profile_image')->store('images', 'public');
        }
    
        // Save user to database
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->gender = $request->gender;
        $user->city = $request->city;
        $user->password = Hash::make($request->password);
        $user->file_name = $filePath;
        $user->role = $request->role;  // Save the role_id instead of role name
        $user->save();
    
        // Redirect with success message
        return redirect()->route('users.index')->with('success', 'User added successfully!');
    }
    
    

    // public function allUser()
    // {
    //     $user = User::count();
    //     return view('dashboard', compact('user'));
    // }
}
