<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Task_Note;
use App\Models\User;
use App\Notifications\TaskAssignedNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class taskController extends Controller
{
    public function index()
    {
        return view('task.index');
    }
    public function create()
    {
        $users = User::where('role', 2)->get();
        return view('task.create', compact('users'));
    }

    public function getTasks(Request $request)
{
    $user = Auth::user(); // Get the logged-in user
    $query = Task::latest();

    // If the user is not a Super Admin, restrict the query to tasks assigned to or created by the user
    if (!$user->hasRole('Super Admin')) {
        $query->where(function ($query) use ($user) {
            $query->where('assigned_by', $user->id)
                ->orWhereHas('assignees', function ($query) use ($user) {
                    $query->where('user_id', $user->id);
                });
        });
    }

    // Filtering
    if ($request->has('search') && !empty($request->get('search')['value'])) {
        $searchValue = $request->get('search')['value'];
        $query->where(function($q) use ($searchValue) {
            $q->where('title', 'like', "%{$searchValue}%")
              ->orWhere('status', 'like', "%{$searchValue}%")
              ->orWhere('due_date', 'like', "%{$searchValue}%");
        });
    }

    // Sorting
    if ($request->has('order')) {
        $columnIndex = $request->get('order')[0]['column'];
        $columnName = $request->get('columns')[$columnIndex]['data'];
        $direction = $request->get('order')[0]['dir'];

        // Map DataTable columns to database columns
        $columnMap = [
            'title' => 'title',
            'status' => 'status',
            'due_date' => 'due_date',
        ];

        if (array_key_exists($columnName, $columnMap)) {
            $query->orderBy($columnMap[$columnName], $direction);
        }
    }

    // Pagination
    $perPage = $request->get('length', 10); // Number of records per page
    $page = $request->get('start', 0) / $perPage; // Offset
    $totalRecords = $query->count(); // Total records count

    $tasks = $query->skip($page * $perPage)->take($perPage)->get(); // Fetch records

    return response()->json([
        'draw' => intval($request->get('draw')),
        'recordsTotal' => $totalRecords,
        'recordsFiltered' => $totalRecords, // Assuming no additional filtering beyond search
        'data' => $tasks->map(function ($task) {
            return [
                'title' => '<a href="' . route('task.show', $task->id) . '">' . $task->title . '</a>',
                'status' => $task->status,
                'due_date' => \Carbon\Carbon::parse($task->due_date)->format('d/m/Y'),
                'action' => $this->generateTaskActions($task),
            ];
        })
    ]);
}
    private function generateTaskActions($task)
    {
        $actions = '';

        if (Auth::user()->can('Edit Tasks')) {
            $actions .= '<a href="' . route('task.edit', $task->id) . '"
                    class="btn btn-sm btn-success edit-item-btn"><i class="fas fa-pen"></i> Edit</a>';
        }

        if (Auth::user()->can('Delete Tasks')) {
            $actions .= '<button type="button" class="btn btn-sm btn-danger remove-item-btn" data-bs-toggle="modal"
                    data-bs-target="#confirmationModal" data-id="' . $task->id . '"><i class="fas fa-trash"></i> Delete</button>';
        }

        return $actions ? '<div class="justify-content-end d-flex gap-2">' . $actions . '</div>' : '';
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'status' => 'required|string',
            'priority' => 'required|string',
            'assign_to' => 'required|array',
            'due_date' => 'required|date',
            'description' => 'nullable|string|min:6',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $success = false;
        $task = new Task();
        $task->title = $request->title;
        $task->status = $request->status;
        $task->priority = $request->priority;
        $task->due_date = $request->due_date;
        $task->description = $request->description;
        $task->assigned_by = Auth::user()->id;
        $task->save();

        $task->assignees()->sync($request->assign_to);
         // Notify assigned users
    foreach ($request->assign_to as $userId) {
        $user = User::find($userId);
        $user->notify(new TaskAssignedNotification($task));
    }
        $success = true;
        if ($success == true) {
            return redirect()->route('tasks')->with('success', 'Task Created Successfully.');
        } else {
            return redirect()->route('tasks')->with('error', 'Failed to Creat Task.');
        }
    }

    public function edit($id)
    {
        $task = Task::findOrFail($id);
        $user = Auth::user();

        // Allow super admins to edit any task
        if ($user->hasRole('Super Admin')) {
            $users = User::where('role', 2)->get(); // Fetch users for super admin view
            return view('task.edit', compact('task', 'users'));
        }
    
        // Check if the user has permission to edit the task and is either the assigner or an assignee
        if (!$user->can('Edit Tasks') || ($user->id !== $task->assigned_by && !$task->assignees->contains($user->id))) {
            abort(403, 'User does not have the right permissions.');
        }
        $users = User::where('role', 2)->get();
        return view('task.edit', compact('task', 'users'));
    }
    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'status' => 'required|string',
            'priority' => 'required|string',
            'assign_to' => 'required|array',
            'due_date' => 'required|date',
            'description' => 'nullable|string|min:6',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $success = false;
        $task->title = $request->title;
        $task->status = $request->status;
        $task->priority = $request->priority;
        $task->due_date = $request->due_date;
        $task->description = $request->description;
        $task->assigned_by = Auth::id();
        $task->save();
        $task->assignees()->sync($request->assign_to);

        $success = true;
        if ($success == true) {
            return redirect()->route('tasks')->with('success', 'Task Updated Successfully.');
        } else {
            return redirect()->route('tasks')->with('error', 'Failed to Update Task.');
        }
    }

    public function destroy($id)
    {
        $task = Task::find($id);
        $user = Auth::user();
        if (empty($task)) {
            Session::flash('error', 'No Task found!');
            return redirect()->route('tasks');
        }
        if (!$user->hasRole('Super Admin')) {
            // Check if the user has permission to delete the task or if they are assigned to it
            if (!$user->can('Delete Tasks') || ($user->id !== $task->assigned_by && !$task->assignees->contains($user->id))) {
                abort(403, 'Unauthorized action.');
            }
        }
        $success = false;
        $task->assignees()->detach();
        $task->delete();
        $success = true;
        if ($success) {
            Session::flash('success', 'Task deleted successfully!');
        } else {
            Session::flash('error', 'Failed to delete task!');
        }
        return redirect()->route('tasks');
    }

    public function show($id, Request $request)
    {
        $task = Task::with('comments')->findOrFail($id);
        $user = Auth::user();

    // Check if the user is a Super Admin
        if (!$user->hasRole('Super Admin')) {
            // Check if the task is either assigned to the user or the user is an assignee
            if ($user->id !== $task->assigned_by && !$task->assignees->contains($user->id)) {
                abort(403, 'User does not have the right permissions.');
            }
        }
       
        $dueDate = $task->due_date; // Assuming `due_date` is in 'Y-m-d H:i:s' format
        $currentDateTime = now();

        if ($currentDateTime->greaterThan($dueDate)) {
            $remainingSeconds = 0;
        } else {
            $remainingSeconds = $currentDateTime->diffInSeconds($dueDate);
        }
        return view('task.show', compact('task', 'remainingSeconds'));
    }
    public function updateStatus(Request $request, $id)
    {
        $task = Task::findOrFail($id);
        $request->validate([
            'status' => 'required|in:pending,in_progress,completed',
        ]);
        $task->status = $request->input('status');
        $task->save();

        // Redirect or return a response
        return redirect()->route('tasks')->with('success', 'Task status updated successfully.');
    }

    public function createNotes(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'task' => 'required',
            'user' => 'required',
            'comment' => 'required|min:10',
            'attachment' => 'nullable|file',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }
        $success = false;
        $comment = new Task_Note();
        $comment->task_id = $request->task;
        $comment->user_id = $request->user;
        $comment->comment = $request->comment;
        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $filePath = public_path('/images/');
            $file->move($filePath, $filename);
            $comment->attachment = $filename;
        }
        $comment->save();
        $success = true;
        if ($success) {
            return redirect()->route('tasks')->with('success', 'Task Note Added Successfully');
        } else {
            return redirect()->route('tasks')->with('error', 'Failed to Add Task Notes');
        }
    }
}
