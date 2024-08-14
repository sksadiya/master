<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
class categoryController extends Controller
{
    public function index(Request $request) {
        return view('category.index');
    }

    public function getData(Request $request)
    {
        $query = Category::withCount('products')->latest();
    
        // Filtering
        if ($request->has('search') && !empty($request->get('search')['value'])) {
            $searchValue = $request->get('search')['value'];
            $query->where('name', 'like', "%{$searchValue}%");
        }
    
        // Sorting
        if ($request->has('order')) {
            $columnIndex = $request->get('order')[0]['column'];
            $columnName = $request->get('columns')[$columnIndex]['data'];
            $direction = $request->get('order')[0]['dir'];
            $query->orderBy($columnName, $direction);
        }
        // Pagination
        $perPage = $request->get('length', 10); // Number of records per page
        $page = $request->get('start', 0) / $perPage; // Offset
        $totalRecords = $query->count(); // Total records count
    
        $categories = $query->skip($page * $perPage)->take($perPage)->get(); // Fetch records
    
        return response()->json([
            'draw' => intval($request->get('draw')),
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $totalRecords, // Assuming no additional filtering beyond search
            'data' => $categories->map(function ($category) {
                return [
                    'id' => $category->id,
                    'name' => $category->name,
                    'products_count' => $category->products_count,
                    'created_at' => $category->created_at->toDateString(),
                    'updated_at' => $category->updated_at->toDateString(),
                    'action' => '<div class="justify-content-end d-flex gap-2">
                    <div class="edit">
                        <button type="button" class="btn btn-sm btn-success edit-item-btn" data-bs-toggle="modal"
                        data-bs-target="#editCategoryModal" data-id="' . $category->id . '"
                        data-name="' . $category->name . '"><i class="fas fa-pen"></i> Edit</button>
                    </div>
                    <div class="remove">
                        <button type="button" class="btn btn-sm btn-danger remove-item-btn" data-bs-toggle="modal"
                        data-bs-target="#deleteRecordModal" data-id="' . $category->id . '"><i class="fas fa-trash"></i> Delete</button>
                    </div>
                </div>'
                ];
            })
        ]);
    }

    public function store(Request $request)
{
    $validator = Validator::make($request->all(), [
        'name' => 'required|unique:categories,name'
    ]);

    if ($validator->fails()) {
        return response()->json([
            'status' => false,
            'errors' => $validator->errors()
        ], 422);
    }

    try {
        $category = new Category();
        $category->name = $request->name;
        $category->save();

        return response()->json([
            'status' => true,
            'message' => 'Category created successfully',
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
        'name' => 'required|unique:categories,name,'.$id,
    ]);

    if ($validator->fails()) {
        return response()->json([
            'status' => false,
            'errors' => $validator->errors()
        ], 422);
    }

    try {
        $category = Category::findOrFail($id);
        $category->name = $request->name;
        $category->save();

        return response()->json([
            'status' => true,
            'message' => 'Category updated successfully',
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
            $category = Category::findOrFail($id);
            $category->delete();

            return response()->json([
                'status' => true,
                'message' => 'Category deleted successfully',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to delete category. Please try again.',
            ], 500);
        }
    }
}
