<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Notification;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $tasks = Task::with('assignedUser');
            
            return DataTables::eloquent($tasks)
                ->addColumn('assigned_to', function ($task) {
                    $assignedUserIds = explode(',', $task->assigned_to);
                    $assignedUsers = User::whereIn('id', $assignedUserIds)->pluck('name')->toArray();
                    return implode(', ', $assignedUsers) ?: 'N/A';
                })
                ->addColumn('action', function ($task) {
                    return '
                        <button data-id="' . $task->id . '" class="btn btn-sm btn-primary view-task">View</button>
                        <button data-id="' . $task->id . '" class="btn btn-sm btn-success edit-task">Edit</button>
                        <button data-id="' . $task->id . '" class="btn btn-sm btn-danger delete-task">Delete</button>
                    ';
                })

                
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('managetask'); // For non-AJAX calls
    }

    /**
     * Show the form for creating a new resource.
    */
    public function create()
    {
        $users = User::all(); // Fetch all users for the assignee dropdown
        return view('addtask', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'title' => 'required|string|max:255',
    //         'description' => 'nullable|string',
    //         'status' => 'required|in:Pending,In Progress,Completed',
    //         'due_date' => 'required|date',
    //         // 'assigned_to' => 'nullable|exists:users,id',
    //         'assigned_to' => 'required|array', // Expect an array of user IDs
    //     ]);

    //         // Convert array of user IDs to a comma-separated string
    //     $assignedTo = implode(',', $request['assigned_to']);

    //     Task::create([
    //         'title' => $request->title,
    //         'description' => $request->description,
    //         'status' => $request->status,
    //         'due_date' => $request->due_date,
    //         'assigned_to' => $assignedTo, // Store the comma-separated string
    //     ]);
    

    //     return redirect()->route('tasks.index')
    //         ->with('success', 'Task successfully added.');
    // }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:Pending,In Progress,Completed',
            'due_date' => 'required|date',
            'assigned_to' => 'required|array', // Expect an array of user IDs
        ]);

        // Create the task
        $task = Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
            'due_date' => $request->due_date,
            'assigned_to' => implode(',', $request->assigned_to),
        ]);

        // Send notifications to each assigned user
        foreach ($request->assigned_to as $userId) {
            $this->sendNotification(auth()->id(), $userId, 'New Task Assigned', 'A new task has been assigned to you. Please check.', 'Task: ' . $request->title);
        }

        return redirect()->route('tasks.index')->with('success', 'Task successfully added.');
    }

    // Send Notification
    protected function sendNotification($fromId, $toId, $title, $message, $description = null)
    {
        Notification::create([
            'from_id' => $fromId,
            'to_id' => $toId,
            'title' => $title,
            'message' => $message,
            'description' => $description,
        ]);
    }





    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $task = Task::findOrFail($id);
        $users = User::all(); // Fetch all users for the assignee dropdown
        return view('edittask', compact('task', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, $id)
    // {
    //     $request->validate([
    //         'title' => 'required|string|max:255',
    //         'description' => 'nullable|string',
    //         'status' => 'required|in:Pending,In Progress,Completed',
    //         'due_date' => 'required|date',
    //         // 'assigned_to' => 'nullable|exists:users,id',
    //         'assigned_to' => 'required|array', // Expect an array of user IDs
    //     ]);

    //     $task = Task::findOrFail($id);

    //        $task->update([
    //         'title' => $request->title,
    //         'description' => $request->description,
    //         'status' => $request->status,
    //         'due_date' => $request->due_date,
    //         'assigned_to' => $assignedTo, // Store the comma-separated string
    //     ]);
    //     return redirect()->route('tasks.index')
    //         ->with('success', 'Task updated successfully.');
    // }

    // public function update(Request $request, $id)
    // {
        
    //     // Validate the incoming request
    //     $request->validate([
    //         'title' => 'required|string|max:255',
    //         'description' => 'nullable|string',
    //         'status' => 'required|in:Pending,In Progress,Completed',
    //         'due_date' => 'required|date',
    //         'assigned_to' => 'required|array', // Expecting an array of user IDs
    //     ]);
    
    //     // Find the task by ID
    //     $task = Task::findOrFail($id);
    
    //     // Convert the assigned_to array to a comma-separated string
    //     $assignedTo = implode(',', $request->assigned_to);
    
    //     // Update the task
    //     $task->update([
    //         'title' => $request->title,
    //         'description' => $request->description,
    //         'status' => $request->status,
    //         'due_date' => $request->due_date,
    //         'assigned_to' => $assignedTo,
    //     ]);
        
    
    //     // Redirect back to the tasks list with success message
    //     return redirect()->route('tasks.index')
    //         ->with('success', 'Task updated successfully.');
    // }
    
    public function update(Request $request, $id)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'status' => 'required|in:Pending,In Progress,Completed',
        'due_date' => 'required|date',
        'assigned_to' => 'required|array', // Expecting an array of user IDs
    ]);

    $task = Task::findOrFail($id);

    // Convert the assigned_to array to a comma-separated string
    $assignedTo = implode(',', $request->assigned_to);

    // Update the task
    $task->update([
        'title' => $request->title,
        'description' => $request->description,
        'status' => $request->status,
        'due_date' => $request->due_date,
        'assigned_to' => $assignedTo,
    ]);

    // Send notifications to the updated list of assigned users
    foreach ($request['assigned_to'] as $userId) {
        $this->sendNotification(
            auth()->user()->id, // Admin's ID (sender)
            $userId, // Assigned user's ID (receiver)
            'Task Updated',
            "The task titled '{$task->title}' has been updated.",
            $task->description
        );
    }

    return redirect()->route('tasks.index')
        ->with('success', 'Task updated and notifications sent.');
}



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $task = Task::findOrFail($id);

        if ($task) {
            $task->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Task deleted successfully',
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Task not found',
        ], 404);
    }

    // public function userTasks()
    // {
    //     // Fetch tasks assigned to the logged-in user
    //     $tasks = Task::all();
    //     $arr = [];
    //     foreach($tasks as $task) {
            
    //         if(Str::contains($task->assigned_to, auth()->user()->id)){

    //         $arr[] = ['task_id'=>$task->id,'assigned_to'=> $task->assigned_to];
    //         }
    //     }
    //     $data = [];
    //     foreach($arr as $task) {
    //         $t = Task::where('id', $task['task_id']);
    //         $data[] = $t->first();
    //     }
    //     // return view('user.usertask', compact('tasks'));
    // }

    public function userTasks()
{
    // Fetch tasks assigned to the logged-in user using optimized query
    $userId = auth()->user()->id;
    $tasks = Task::where('assigned_to', 'LIKE', "%{$userId}%")->get();

    return view('user.usertask', compact('tasks'));
}

    public function show($taskId)
    {
        $task = Task::findOrFail($taskId); // Fetch the task by ID

        return view('user.usertaskshow', compact('task')); // Return the view with the task details
    }
 
    public function updateStatus(Request $request, Task $task)
    {
        // Validate the request
        $validated = $request->validate([
            'status' => 'required|in:Pending,In Progress,Completed',
        ]);
        
        // Update the task status
        $task->status = $validated['status'];
        $task->save();

        // Redirect back to the tasks page with a success message
        return redirect()->route('user.usertasks')->with('success', 'Task status updated successfully.');
    }


    public function showadmin($id)
    {
        $task = Task::findOrFail($id);

         // Convert the comma-separated 'assigned_to' string to an array of user IDs
         $assignedUserIds = explode(',', $task->assigned_to);

         // Retrieve users based on the IDs in the 'assigned_to' column
         $assignedUsers = User::whereIn('id', $assignedUserIds)->get();

        return view('viewtask', compact('task')); // Return the view with the task details
    }

    // -----------------------------------Comments-------------------------------------------------------------------

    public function storeComment(Request $request, $taskId){
        
        $request->validate([
            'comment' => 'required|string|max:500',
        ]);

        Comment::create([
            'task_id' => $taskId,
            'user_id' => auth()->id(), 
            'comment' => $request->comment,
        ]);

        return redirect()->back()->with('success', 'Comment added successfully.');
    }


    public function fetch($taskId)
    {
        $comments = Comment::with('user')->where('task_id', $taskId)->latest()->get();
        return response()->json($comments);
    }



    //-----------------------------------NOTIFICATION   ----------------------------------------------------------
    
    // public function __construct()
    // {
    //     $this->middleware(function ($request, $next) {
    //         view()->share('unreadNotificationsCount', Notification::where('to_id', auth()->id())
    //             ->whereNull('read_at')  // Only unread notifications
    //             ->count());
    //         return $next($request);
    //     });
    // }

}


