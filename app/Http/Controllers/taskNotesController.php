<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Task_Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
class taskNotesController extends Controller
{
  public function index() {
    $user = Auth::user(); 
    $tasks = Task::where('assigned_by', $user->id) // Tasks created by the user
                 ->orWhereHas('assignees', function ($query) use ($user) {
                     $query->where('user_id', $user->id); // Tasks where the user is an assignee
                 })
                 ->get();
    return view('task_notes.index',compact('tasks'));
  }
  public function getTaskNotes(Request $request)
{
    $user = Auth::user(); // Get the logged-in user
    $query = Task_Note::whereHas('task', function ($taskQuery) use ($user) {
        $taskQuery->where('assigned_by', $user->id)
                  ->orWhereHas('assignees', function ($assigneeQuery) use ($user) {
                      $assigneeQuery->where('user_id', $user->id);
                  });
    })->latest();

    // Filtering
    if ($request->has('search') && !empty($request->get('search')['value'])) {
        $searchValue = $request->get('search')['value'];
        $query->where(function($q) use ($searchValue) {
            $q->where('comment', 'like', "%{$searchValue}%")
              ->orWhereHas('task', function ($q2) use ($searchValue) {
                  $q2->where('title', 'like', "%{$searchValue}%");
              });
        });
    }
    // Sorting
    if ($request->has('order')) {
        $columnIndex = $request->get('order')[0]['column'];
        $columnName = $request->get('columns')[$columnIndex]['data'];
        $direction = $request->get('order')[0]['dir'];

        $columnMap = [
            'title' => 'task_id',
            'comment' => 'comment',
        ];

        if (array_key_exists($columnName, $columnMap)) {
            $query->orderBy($columnMap[$columnName], $direction);
        }
    }

    // Pagination
    $perPage = $request->get('length', 10); // Number of records per page
    $page = $request->get('start', 0) / $perPage; // Offset
    $totalRecords = $query->count(); // Total records count

    $taskNotes = $query->skip($page * $perPage)->take($perPage)->get(); 
    return response()->json([
        'draw' => intval($request->get('draw')),
        'recordsTotal' => $totalRecords,
        'recordsFiltered' => $totalRecords, // Assuming no additional filtering beyond search
        'data' => $taskNotes->map(function ($note) {
            return [
                'title' => '<a href="' . route('task.show', $note->task->id) . '">' . $note->task->title . '</a>', // Assuming task title is to be displayed
                'comment' => Str::limit($note->comment, 50),
                'action' => $this->generateTaskNotesActions($note),
            ];
        })
    ]);
}
private function generateTaskNotesActions($note)
    {
        $actions = '';

        if (Auth::user()->can('Edit Task Notes')) {
            $actions .= '<div class="edit">
          <button type="button" class="btn btn-sm btn-success edit-item-btn" data-bs-toggle="modal"
          data-bs-target="#editTaskNotesModal" data-id="'. $note->id .'" data-task="'. $note->task_id .'"
          data-user="'. $note->user_id .'" data-comment="'. $note->comment .'" data-attachment="'. $note->attachment .'"><i class="fas fa-pen"></i> Edit</button>
          </div>';
        }
        if (Auth::user()->can('Delete Task Notes')) {
            $actions .= '<button type="button" class="btn btn-sm btn-danger remove-item-btn" data-bs-toggle="modal"
                    data-bs-target="#confirmationModal" data-id="' . $note->id . '"><i class="fas fa-trash"></i> Delete</button>';
        }

        return $actions ? '<div class="justify-content-end d-flex gap-2">' . $actions . '</div>' : '';
    }
public function store(Request $request)
{
    $validator = Validator::make($request->all(), [
        'task' => 'required',
        'user' => 'required',
        'comment' => 'required|min:10',
        'attachment' => 'nullable|file',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'status' => false,
            'errors' => $validator->errors()
        ], 422);
    }

    try {
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
        Session::flash('success','Task Note created successfully');
        return response()->json([
            'status' => true,
            'message' => 'Task Note created successfully',
        ]);

    } catch (\Exception $e) {

        return response()->json([
            'status' => false,
            'message' => 'Failed to add note. Please try again.',
            'error' => $e
        ], 500);
    }
}

public function update(Request $request, $id)
{
    $validator = Validator::make($request->all(), [
        'task' => 'required',
        'user' => 'required',
        'comment' => 'required|min:10',
        'attachment' => 'required|file',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'status' => false,
            'errors' => $validator->errors()
        ], 422);
    }

    try {
        $note = Task_Note::findOrFail($id);
        $note->task_id = $request->task;
        $note->user_id = $request->user;
        $note->comment = $request->comment;
        if ($request->hasFile('attachment')) {
            if ($note->attachment) {
                $oldFilePath = public_path('/images/') . $note->attachment;
                if (file_exists($oldFilePath)) {
                    unlink($oldFilePath);
                }
            }
            $file = $request->file('attachment');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $filePath = public_path('/images/');
            $file->move($filePath, $filename);
            $note->attachment = $filename;
        }
        $note->save();

        return response()->json([
            'status' => true,
            'message' => 'Task Note updated successfully',
        ]);

    } catch (\Exception $e) {
        return response()->json([
            'status' => false,
            'message' => 'Failed to update Task Note. Please try again.',
        ], 500);
    }
}
public function destroy($id)
    {
        $comment = Task_Note::find($id);
        $user = Auth::user();
        if (empty($comment)) {
            Session::flash('error', 'No Note found!');
            return redirect()->route('taskNotes');
        }
        $success = false;
        $comment->delete();
        $success = true;
        if ($success) {
            Session::flash('success', 'Task Note deleted successfully!');
        } else {
            Session::flash('error', 'Failed to delete task note!');
        }
        return redirect()->route('taskNotes');
    }
}
