<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::get();
        return view('adduser',compact('users'));
    }

    
    public function store(Request $request)
{

    $request->validate([
        'file' => 'required|file|mimes:jpeg,png,jpg,gif|max:2048', // Single file validation
    ]);

    
    if ($request->hasFile('file')) {
        $file = $request->file('file');
        $path = $file->store('image', 'public'); // Save the file in 'storage/app/public/image'

        
        User::create([
            'file_name' => $path,
        ]);
    } else {
        return back()->withErrors(['file' => 'No file was uploaded.']); // Handle case where no file is uploaded
    }

    // Step 4: Redirect with a success message
    return redirect()->route('user.index')->with('status', 'File uploaded successfully');
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
        $user = User::find($id);
        return view('file-update', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::find($id);

        if($request->hasFile('file')){

            $image_path = public_path("storage/"). $user->file_name;
        
            if(file_exists($image_path)){
                @unlink($image_path);
            }

        $path = $request-> file('file')->store('image', 'public');

        $user->file_name = $path;
        $user->save();

        return redirect()->route ('user.index')->with('status', 'File Updated successfully');

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);

        $user->delete();

        $image_path = public_path("storage/"). $user->file_name;
        
        if(file_exists($image_path)){
            @unlink($image_path);
        }

        return redirect()->route ('user.index')->with('status', 'File Deleted successfully');

    }
}
