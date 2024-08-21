<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class taskController extends Controller
{
   public function index() {
    return view('task.index');
   }
   public function create() {
      $users = User::where('role', 2)->get();
    return view('task.create',compact('users'));
   }

   public function getTasks(Request $request)
    {
        $query = Task::latest();
        // Filtering
        if ($request->has('search') && !empty($request->get('search')['value'])) {
            $searchValue = $request->get('search')['value'];
            $query->where('title', 'like', "%{$searchValue}%")
                    ->orWhere('status', 'like',"%{$searchValue}%")
                    ->orWhere('due_date', 'like',"%{$searchValue}%");
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
                    'title' => '<a href="'.route('task.show',$task->id).'">'.$task->title.'</a>',
                    'status' => $task->status,
                    'due_date' =>  \Carbon\Carbon::parse($task->date)->format('d/m/Y') ,
                    'action' =>'<div class="justify-content-end d-flex gap-2">
                        <div class="edit">
                        <a href="'. route('task.edit',$task->id).'"
                        class="btn btn-sm btn-success edit-item-btn"><i class="fas fa-pen"></i> Edit</a>
                        </div>
                        <div class="remove">
                        <button type="button" class="btn btn-sm btn-danger remove-item-btn" data-bs-toggle="modal"
                        data-bs-target="#confirmationModal" data-id="'. $task->id .'"><i class="fas fa-trash"></i>
                        Delete</button>
                        </div>
                     </div>',
                ];
            })
        ]);
    }
   public function store(Request $request) {
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
     $success = true;
     if($success== true) {
         return redirect()->route('tasks')->with('success','Task Created Successfully.');
     } else {
      return redirect()->route('tasks')->with('error','Failed to Creat Task.');
     }
   }

   public function edit($id)
    {
        $task = Task::findOrFail($id); 
        $users = User::where('role', 2)->get();
        return view('task.edit', compact('task', 'users'));
    }
   public function update(Request $request, $id) {
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
      if($success == true) {
         return redirect()->route('tasks')->with('success','Task Updated Successfully.');
      } else {
         return redirect()->route('tasks')->with('error','Failed to Update Task.');
      }
   }

   public function destroy($id) {
      $task = Task::find($id);
      
      if (empty($task)) {
          Session::flash('error', 'No Task found!');
          return redirect()->route('tasks');
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
        $task = Task::findOrFail($id);
        if (empty($task)) {
            Session::flash('error', 'No Task Found!');
            return redirect()->back();
        }
        return view('task.show', compact('task'));
    }
}
