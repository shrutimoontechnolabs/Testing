<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $contacts = Contact::query();
            return DataTables::eloquent($contacts)
                ->addColumn('action', function ($contact) {
                    return '
                        <button data-id="' . $contact->id . '" class="btn btn-sm btn-success edit-contact">Edit</button>
                        <button data-id="' . $contact->id . '" class="btn btn-sm btn-danger delete-contact">Delete</button>
                    ';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $contacts = Contact::all();
        return view('managecontact', compact('contacts')); // For non-AJAX calls
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('addcontact');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'contact' => 'required|string|unique:contacts,contact|max:15',
            'secondary_contact' => 'nullable|string|max:15',
            'email' => 'required|email|unique:contacts,email',
            'dob' => 'required|date',
        ]);

        Contact::create([
            'fname' => $request->fname,
            'lname' => $request->lname,
            'contact' => $request->contact,
            'secondary_contact' => $request->secondary_contact,
            'email' => $request->email,
            'dob' => $request->dob,
        ]);

        return redirect()->route('contacts.index')
            ->with('success', "Contact successfully added");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Implement this method if you want to show the contact details.
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $contact = Contact::findOrFail($id);
        return view('editcontact', compact('contact'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        try {
            $request->validate([
                'id' => 'required|exists:contacts,id',
                'fname' => 'required|string|max:255',
                'lname' => 'required|string|max:255',
                'contact' => 'required|string|max:15|unique:contacts,contact,' . $request->id,
                'secondary_contact' => 'nullable|string|max:15',
                'email' => 'required|email|unique:contacts,email,' . $request->id,
                'dob' => 'required|date',
            ]);

            $contact = Contact::findOrFail($request->id);
            $contact->update($request->only(['fname', 'lname', 'contact', 'secondary_contact', 'email', 'dob']));
            return redirect()->route('contacts.index')->with('success', 'Contact updated successfully.');
        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Unable to update contact - ' . $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);  // Find the contact by ID or fail

        if ($contact) {
            $contact->delete();  // Delete the contact
            return response()->json([
                'status' => 'success',
                'message' => 'Contact deleted successfully'
            ]);
        }

        return response()->json(['status' => 'error', 'message' => 'Contact not found'], 404);
    }

    public function import(Request $request)
    {
        // Validate the uploaded file
        $request->validate([
            'csv_file' => 'required|mimes:csv,txt|max:2048', // Max file size 2MB
        ]);

        $file = $request->file('csv_file'); // Input field name 'csv_file'

        // Open the CSV file
        $handle = fopen($file, 'r');
        if ($handle === false) {
            return back()->withErrors('Error opening the file.');
        }
        
        fgetcsv($handle);

        // Read the file line by line
        while (($row = fgetcsv($handle)) !== false) {
            Contact::create([
                'fname' => $row[0],            // First Name
                'lname' => $row[1],            // Last Name
                'contact' => $row[2],          // Contact number
                'secondary_contact' => $row[3], // Secondary Contact number
                'email' => $row[4],            // Email address             
                'dob' => $row[5],              // Date of Birth
            ]);
        }

        fclose($handle);

        return back()->with('success', 'Contacts imported successfully');
    }
}
