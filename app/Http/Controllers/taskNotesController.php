<?php

namespace App\Http\Controllers;

use App\Models\Task_Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class taskNotesController extends Controller
{
   public function store(Request $request) {
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
    if($success) {
        return redirect()->route('tasks')->with('success', 'Task Note Added Successfully');
    } else {
        return redirect()->route('tasks')->with('error', 'Failed to Add Task Notes');
    }
   }
}
