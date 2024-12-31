<?php

namespace App\Http\Controllers;

use App\Models\Cms;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CmsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        
    if ($request->ajax()) {
        $cmss = Cms::query();
        return DataTables::eloquent($cmss)
            ->addColumn('action', function ($cms) {
                return '
                    <button data-id="' . $cms->id . '" class="btn btn-sm btn-success edit-cms">Edit</button>
                    <button data-id="' . $cms->id . '" class="btn btn-sm btn-danger delete-cms">Delete</button>
                ';
            })
            ->rawColumns(['action'])
            ->make(true);
    }
    $cmss = Cms::all();
    return view('managecms', compact('cmss')); // For non-AJAX calls

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('addcms'); 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'title'=>'required',
            'description'=>'required',
        ],
        );

        Cms::create([
            'title' => $request->title,
            'description' => $request->description,
        ]);

       
        return redirect()->route('cmss.index')
        ->with('success', "cms sucessfully added");
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
        $cms = Cms::findOrFail($id);
        // dd($cms);
        return view('editcms',compact('cms'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        try{
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);
    
        // Fetch the CMS entry
        $cms = Cms::findOrFail($request->id);
            $cms->update($request->only(['title', 'description']));
            return redirect()->route('cmss.index')->with('success', 'Cms updated successfully.');
            return response()->json(['status' => 'success', 'message' => 'cms Updated Successfully']);
        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Unable to update cms - ' . $e->getMessage()]);
        }    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $cms = Cms::findOrFail($id);  // Find the cms by ID or fail

        if ($cms) {
            $cms->delete();  // Delete the cms
            return response()->json([
                'status' => 'success',
                'message' => 'cms deleted successfully'
            ]);
        }

        return response()->json(['status' => 'error', 'message' => 'cms not found'], 404);
    }

}
