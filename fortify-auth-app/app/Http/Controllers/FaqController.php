<?php

namespace App\Http\Controllers;


use App\Models\Faq;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $faqs = Faq::query();
            return DataTables::eloquent($faqs)
                ->addColumn('action', function ($faq) {
                    return '
                        <button data-id="' . $faq->id . '" class="btn btn-sm btn-success edit-faq">Edit</button>
                        <button data-id="' . $faq->id . '" class="btn btn-sm btn-danger delete-faq">Delete</button>
                    ';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $faqs = Faq::all();
        return view('managefaq', compact('faqs')); // For non-AJAX calls
    
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('addfaq');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'question'=>'required',
            'answer'=>'required',
        ],
        // [
        //     "question.required"=>'This is required',
        // ]
            
    );

        Faq::create([
            'question' => $request->question,
            'answer' => $request->answer,
            'added_by' => auth()->id(),
        ]);

       
        return redirect()->route('faqs.index')
        ->with('success', "faq sucessfully added");
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
        $faq = Faq::findOrFail($id);
        // dd($faq);
        return view('editfaq',compact('faq'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //
        try {
            $request->validate([
                'id' => 'required',
                'question'=>'required',
                'answer'=>'required',
            ]);

            $faq = Faq::findOrFail($request->id);
            $faq->update($request->only(['question', 'answer']));
            return redirect()->route('faqs.index')->with('success', 'User updated successfully.');
            return response()->json(['status' => 'success', 'message' => 'faq Updated Successfully']);
        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Unable to update faq - ' . $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $faq = Faq::findOrFail($id);  // Find the faq by ID or fail

        if ($faq) {
            $faq->delete();  // Delete the faq
            return response()->json([
                'status' => 'success',
                'message' => 'faq deleted successfully'
            ]);
        }

        return response()->json(['status' => 'error', 'message' => 'faq not found'], 404);
    }

    public function showFaqs()
{
    $faqs = Faq::with('user')->get();
    return view('faq', compact('faqs'));
}

}
