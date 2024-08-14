<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DepartmentController extends Controller
{
    public function index(Request $request) {
        // $departments = Department::withCount('employees')->latest();

        // if (!empty($request->get('search'))) {
        //     $departments = $departments->where(function ($query) use ($request) {
        //         $query->where('name', 'like', '%' . $request->get('search') . '%')
        //             ->orWhere('value', 'like', '%' . $request->get('search') . '%');
        //     });
        // }
        // $perPage = $request->get('perPage', 20); 
        // $departments = $departments->paginate($perPage);
        return view('departments.index');
    }
    
    public function getDepartments(Request $request)
    {
        $query = Department::withCount('employees')->latest();
    
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
    
        $departments = $query->skip($page * $perPage)->take($perPage)->get(); // Fetch records
    
        return response()->json([
            'draw' => intval($request->get('draw')),
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $totalRecords, // Assuming no additional filtering beyond search
            'data' => $departments->map(function ($dept) {
                return [
                    'name' => $dept->name,
                    'employees_count' => $dept->employees_count,
                    'action' => ' <div class="justify-content-end d-flex gap-2">
          <div class="edit">
          <button type="button" class="btn btn-sm btn-success edit-item-btn" data-bs-toggle="modal"
          data-bs-target="#editDepartmentModel" data-id="'. $dept->id .'"
          data-name="'. $dept->name .'" data-description="'. $dept->description .'"><i class="fas fa-pen"></i> Edit</button>
          </div>
          <div class="remove">
          <button type="button" class="btn btn-sm btn-danger remove-item-btn" data-bs-toggle="modal"
          data-bs-target="#deleteRecordModal" data-id="'. $dept->id .'"><i class="fas fa-trash"></i> Delete</button>
          </div>
        </div>'
                ];
            })
        ]);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:departments,name',
            'description' => 'nullable|min:10'
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 422);
        }
    
        try {
            $department = new Department();
            $department->name = $request->name;
            $department->description = $request->description;
            $department->save();
    
            return response()->json([
                'status' => true,
                'message' => 'Department created successfully',
            ]);
    
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to add Department. Please try again.',
            ], 500);
        }
    }
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:departments,name,'.$id,
            'description' => 'nullable|min:10',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 422);
        }
    
        try {
            $department = Department::findOrFail($id);
            $department->name = $request->name;
            $department->description = $request->description;
            $department->save();
    
            return response()->json([
                'status' => true,
                'message' => 'Department updated successfully',
            ]);
    
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to update Department. Please try again.',
            ], 500);
        }
    }
    
    public function destroy($id)
        {
            try {
                $department = Department::findOrFail($id);
                $department->delete();
    
                return response()->json([
                    'status' => true,
                    'message' => 'Department deleted successfully',
                ]);
            } catch (\Exception $e) {
                return response()->json([
                    'status' => false,
                    'message' => 'Failed to delete department. Please try again.',
                ], 500);
            }
        }
}
