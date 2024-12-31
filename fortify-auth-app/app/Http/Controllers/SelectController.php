<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SelectController extends Controller
{
    public function findName(Request $req)
{
    $req->validate([
        'name' => 'nullable|string|max:255',
    ]);

    $tags = [];
    $s = $req->name;

    if ($s) {
        try {
            $tags = DB::table('users')
                ->where('name', 'LIKE', "%$s%")
                ->select('id', 'name as text')  // Map 'name' to 'text' for Select2
                ->limit(10)
                ->get();
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while fetching data.'], 500);
        }
    }

    return response()->json($tags);
}

    
}
