<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class NotesController extends Controller
{
    public function index()
    {
        return view('notes.index');
    }
    public function getNotes(Request $request)
    {
        $userId = Auth::id();
        $query = Note::with('user')->where('user_id', $userId)->latest();

        // Filtering
        if ($request->has('search') && !empty($request->get('search')['value'])) {
            $searchValue = $request->get('search')['value'];
            $query->where('title', 'like', "%{$searchValue}%");
        }

        // Sorting
        if ($request->has('order')) {
            $columnIndex = $request->get('order')[0]['column'];
            $columnName = $request->get('columns')[$columnIndex]['data'];
            $direction = $request->get('order')[0]['dir'];

            // Map DataTable columns to database columns
            $columnMap = [
                'title' => 'title',
                // 'value' => 'value',
            ];

            if (array_key_exists($columnName, $columnMap)) {
                $query->orderBy($columnMap[$columnName], $direction);
            }
        }
        // Pagination
        $perPage = $request->get('length', 10); // Number of records per page
        $page = $request->get('start', 0) / $perPage; // Offset
        $totalRecords = $query->count(); // Total records count

        $notes = $query->skip($page * $perPage)->take($perPage)->get(); // Fetch records

        return response()->json([
            'draw' => intval($request->get('draw')),
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $totalRecords, // Assuming no additional filtering beyond search
            'data' => $notes->map(function ($note) {
                return [
                    'title' => $note->title,
                   'starred' => '<button type="button" class="btn btn-icon btn-sm material-shadow-none favourite-btn ' . ($note->is_starred ? 'active' : '') . '" data-id="' . $note->id . '">
    <i class="fas fa-star fs-13 align-bottom"></i>
</button>',
                    'action' => '<div class="justify-content-end d-flex gap-2">
          <div class="edit">
          <button type="button" class="btn btn-sm btn-success edit-item-btn" data-bs-toggle="modal"
          data-bs-target="#editNoteModel" data-id="' . $note->id . '" data-title="' . $note->title . '"
          data-content="' . $note->content . '" data-star="' . $note->is_starred . '"><i class="fas fa-pen"></i> Edit</button>
          </div>
          <div class="remove">
          <button type="button" class="btn btn-sm btn-danger remove-item-btn" data-bs-toggle="modal"
          data-bs-target="#deleteNoteModal" data-id="' . $note->id . '"><i class="fas fa-trash"></i>
          Delete</button>
          </div>
        </div>'
                ];
            })
        ]);
    }

    public function updateStarred(Request $request,$id)
{
    $note = Note::findOrFail($id);
    $isStarred = $request->is_starred; // Expecting 1 or 0

    // Find the note and update the is_starred value
    if ($note) {
        $note->is_starred = $isStarred;
        $note->save();
    }

    return response()->json(['success' => true]);
}
    public function store(Request $request)
{
    $validator = Validator::make($request->all(), [
        'title' => 'required|unique:notes,title',
        'content' => 'nullable',
        'is_starred' => 'required'
    ]);

    if ($validator->fails()) {
        return response()->json([
            'status' => false,
            'errors' => $validator->errors()
        ], 422);
    }

    try {
        $note = new Note();
        $note->title = $request->title;
        $note->user_id = Auth::user()->id;
        $note->content = $request->content;
        $note->is_starred = $request->is_starred;
        $note->save();
        Session::flash('success','Note created successfully');
        return response()->json([
            'status' => true,
            'message' => 'Note created successfully',
        ]);

    } catch (\Exception $e) {

        return response()->json([
            'status' => false,
            'message' => 'Failed to add Note. Please try again.',
            'error' => $e
        ], 500);
    }
}

public function update(Request $request, $id)
{
   
    $validator = Validator::make($request->all(), [
        'title' => 'required|unique:notes,title,'.$id,
         'content' => 'nullable',
        'is_starred' => 'required'
    ]);

    if ($validator->fails()) {
        return response()->json([
            'status' => false,
            'errors' => $validator->errors()
        ], 422);
    }

    try {
        $note = Note::findOrFail($id);
        $note->title = $request->title;
        $note->content = $request->content;
        $note->is_starred = $request->is_starred;
        $note->save();

        return response()->json([
            'status' => true,
            'message' => 'Note updated successfully',
        ]);

    } catch (\Exception $e) {
        return response()->json([
            'status' => false,
            'message' => 'Failed to update note. Please try again.',
        ], 500);
    }
}

public function destroy($id)
    {
        try {
            $note = Note::findOrFail($id);
            $note->delete();

            return response()->json([
                'status' => true,
                'message' => 'Note deleted successfully',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to delete note. Please try again.',
                'error' => $e,
            ], 500);
        }
    }
}
