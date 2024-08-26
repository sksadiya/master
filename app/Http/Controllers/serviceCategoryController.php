<?php

namespace App\Http\Controllers;

use App\Models\serviceCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class serviceCategoryController extends Controller
{

         public function index(Request $request) {
        return view('service_categories.index');
    }
    
    public function getServiceCategories(Request $request)
    {
        try {
            $query = serviceCategory::withCount('clients')->latest();
        
            if ($request->has('search') && !empty($request->get('search')['value'])) {
                $searchValue = $request->get('search')['value'];
                $query->where(function ($query) use ($searchValue) {
                    $query->where('name', 'like', "%{$searchValue}%");
                });
            }
        
            if ($request->has('order')) {
                $columnIndex = $request->get('order')[0]['column'];
                $columnName = $request->get('columns')[$columnIndex]['data'];
                $direction = $request->get('order')[0]['dir'];
    
                // Map DataTable columns to database columns
                $columnMap = [
                    'name' => 'name',
                    'clients_count' => 'clients_count',
                ];
    
                if (array_key_exists($columnName, $columnMap)) {
                    $query->orderBy($columnMap[$columnName], $direction);
                }
            }
        
            $perPage = $request->get('length', 10);
            $page = $request->get('start', 0) / $perPage;
            $totalRecords = $query->count();
        
            $serviceCategories = $query->skip($page * $perPage)->take($perPage)->get();
        
            return response()->json([
                'draw' => intval($request->get('draw')),
                'recordsTotal' => $totalRecords,
                'recordsFiltered' => $totalRecords,
                'data' => $serviceCategories->map(function ($category) {
                    return [
                        'name' => $category->name,
                        'clients_count' => $category->clients_count,
                        'action' => $this->generateServiceCategoriesActions($category
                        )
                    ];
                })
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred.'], 500);
        }
    }
    
    private function generateServiceCategoriesActions($category)
    {
        $actions = '';
        if (Auth::user()->can('Edit serviceCategories')) {
            $actions .= '<div class="edit">
                                    <button type="button" class="btn btn-sm btn-success edit-item-btn" data-bs-toggle="modal"
                                    data-bs-target="#editServiceCategoryModal" data-id="'. $category->id .'"
                                    data-name="'. $category->name .'"><i class="fas fa-pen"></i> Edit</button>
                                    </div>';
        }
        if (Auth::user()->can('Delete serviceCategories')) {
            $actions .= '<div class="remove">
                                    <button type="button" class="btn btn-sm btn-danger remove-item-btn" data-bs-toggle="modal"
                                    data-bs-target="#deleteRecordModal" data-id="'. $category->id .'"><i class="fas fa-trash"></i> Delete</button>
                                    </div>';
        }
        return $actions ? '<div class="justify-content-end d-flex gap-2">' . $actions . '</div>' : '';
    }
    public function store(Request $request)
{
    $validator = Validator::make($request->all(), [
        'name' => 'required|unique:service_categories,name'
    ]);

    if ($validator->fails()) {
        return response()->json([
            'status' => false,
            'errors' => $validator->errors()
        ], 422);
    }

    try {
        $category = new serviceCategory();
        $category->name = $request->name;
        $category->save();

        return response()->json([
            'status' => true,
            'message' => 'Service Category created successfully',
        ]);

    } catch (\Exception $e) {
        return response()->json([
            'status' => false,
            'message' => 'Failed to add category. Please try again.',
        ], 500);
    }
}
public function update(Request $request, $id)
{
    $validator = Validator::make($request->all(), [
        'name' => 'required|unique:service_categories,name,'.$id,
    ]);

    if ($validator->fails()) {
        return response()->json([
            'status' => false,
            'errors' => $validator->errors()
        ], 422);
    }

    try {
        $category = serviceCategory::findOrFail($id);
        $category->name = $request->name;
        $category->save();

        return response()->json([
            'status' => true,
            'message' => 'Service Category updated successfully',
        ]);

    } catch (\Exception $e) {
        return response()->json([
            'status' => false,
            'message' => 'Failed to update category. Please try again.',
        ], 500);
    }
}

public function destroy($id)
    {
        try {
            $category = serviceCategory::findOrFail($id);
            $category->delete();

            return response()->json([
                'status' => true,
                'message' => 'Service Category deleted successfully',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to delete category. Please try again.',
            ], 500);
        }
    }
}
