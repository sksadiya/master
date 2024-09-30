<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProjectController extends Controller
{
    public function index() {
        return view('project.index');
    }

    public function getprojects(Request $request) {
        $query = Project::with('client')->latest();
    
        // Filtering
        if ($request->has('search') && !empty($request->get('search')['value'])) {
            $searchValue = $request->get('search')['value'];
            $query->where('name', 'like', "%{$searchValue}%")
                    ->orWhere('description', 'like',"%{$searchValue}%");
        }
    
        // Sorting
        if ($request->has('order')) {
            $columnIndex = $request->get('order')[0]['column'];
            $columnName = $request->get('columns')[$columnIndex]['data'];
            $direction = $request->get('order')[0]['dir'];

            // Map DataTable columns to database columns
            $columnMap = [
                'name' => 'name',
                'description' => 'description',
            ];

            if (array_key_exists($columnName, $columnMap)) {
                $query->orderBy($columnMap[$columnName], $direction);
            }
        }
        // Pagination
        $perPage = $request->get('length', 10); // Number of records per page
        $page = $request->get('start', 0) / $perPage; // Offset
        $totalRecords = $query->count(); // Total records count
    
        $projects = $query->skip($page * $perPage)->take($perPage)->get(); // Fetch records
    
        return response()->json([
            'draw' => intval($request->get('draw')),
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $totalRecords, // Assuming no additional filtering beyond search
            'data' => $projects->map(function ($project) {
                return [
                    'name' => $project->name,
                    'client' => $project->client->first_name . ' ' . $project->client->last_name,
                    'action' => $this->generateActions($project)
                ];
            })
        ]);
    }

    private function generateActions($project)
    {
        $actions = '';

        if (Auth::user()->can('Edit project')) {
            $actions .= '<div class="edit">
                            <a href="' . route('project.edit', $project->id) . '" class="btn btn-sm btn-success edit-item-btn">
                                <i class="fas fa-pen"></i> Edit
                            </a>
                        </div>';
        }

        if (Auth::user()->can('Delete project')) {
            $actions .= '<div class="remove">
          <button type="button" class="btn btn-sm btn-danger remove-item-btn" data-bs-toggle="modal"
          data-bs-target="#deleteRecordModal" data-id="'. $project->id .'"><i class="fas fa-trash"></i> Delete</button>
          </div>';
        }

        return $actions ? '<div class="justify-content-end d-flex gap-2">' . $actions . '</div>' : '';
    }

    public function create() {
        $clients = Client::all();
        return view('project.create',compact('clients'));
    }

    public function store(Request $request) {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'client' => 'required|exists:clients,id',
            'description' => 'nullable'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }
        $project = new Project();
        $project->name = $request->input('name');
        $project->client_id = $request->input('client');
        $project->description = $request->input('description');
        $project->save();
        $success = true;
        if($success) {
            return redirect()->route('projects')->with('success', 'Project created successfully');
        } else {
            return redirect()->route('projects')->with('error', 'Failed to create project');
        }
    }

    public function edit($id) {
        $project = Project::find($id);
        if(!$project) {
            return redirect()->route('projects')->with('error', 'Project not found');
        }
        $clients = Client::all();
        return view('project.edit',compact('clients','project'));
    }

    public function update(Request $request , $id) {
        $project = Project::find($id);
        if(!$project) {
            return redirect()->route('projects')->with('error', 'Project not found');
        }
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'client' => 'required|exists:clients,id',
            'description' => 'nullable'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }
        $project->name = $request->input('name');
        $project->client_id = $request->input('client');
        $project->description = $request->input('description');
        $project->save();
        $success = true;
        if($success) {
            return redirect()->route('projects')->with('success', 'Project updated successfully');
        } else {
            return redirect()->route('projects')->with('error', 'Failed to update project');
        }
    }

    public function destroy($id)
    {
        try {
            $project = Project::findOrFail($id);
            $project->delete();

            return response()->json([
                'status' => true,
                'message' => 'Project deleted successfully',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to delete Project. Please try again.',
            ], 500);
        }
    }
}
