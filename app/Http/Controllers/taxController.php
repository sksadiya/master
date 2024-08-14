<?php

namespace App\Http\Controllers;

use App\Models\Tax;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class taxController extends Controller
{
    public function index(Request $request) {
        return view('tax.index');
    }
    public function getTaxes(Request $request)
    {
        $query = Tax::latest();
    
        // Filtering
        if ($request->has('search') && !empty($request->get('search')['value'])) {
            $searchValue = $request->get('search')['value'];
            $query->where('name', 'like', "%{$searchValue}%")
                    ->orWhere('value', 'like',"%{$searchValue}%");
        }
    
        // Sorting
        if ($request->has('order')) {
            $columnIndex = $request->get('order')[0]['column'];
            $columnName = $request->get('columns')[$columnIndex]['data'];
            $direction = $request->get('order')[0]['dir'];

            // Map DataTable columns to database columns
            $columnMap = [
                'name' => 'name',
                'value' => 'value',
            ];

            if (array_key_exists($columnName, $columnMap)) {
                $query->orderBy($columnMap[$columnName], $direction);
            }
        }
        // Pagination
        $perPage = $request->get('length', 10); // Number of records per page
        $page = $request->get('start', 0) / $perPage; // Offset
        $totalRecords = $query->count(); // Total records count
    
        $taxes = $query->skip($page * $perPage)->take($perPage)->get(); // Fetch records
    
        return response()->json([
            'draw' => intval($request->get('draw')),
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $totalRecords, // Assuming no additional filtering beyond search
            'data' => $taxes->map(function ($tax) {
                return [
                    'name' => $tax->name,
                    'value' => $tax->value,
                    'default' => '<div class="form-check form-switch">
                                <input class="form-check-input default-toggle-input" type="checkbox" role="switch"
                                    id="default-switch-' . $tax->id . '"
                                    onclick="setDefault(' . $tax->id . ')" ' . ($tax->is_default ? 'checked' : '') . '>
                                <label class="form-check-label" for="default-switch-' . $tax->id . '"></label>
                            </div>',
                    'action' => '<div class="justify-content-end d-flex gap-2">
          <div class="edit">
          <button type="button" class="btn btn-sm btn-success edit-item-btn" data-bs-toggle="modal"
          data-bs-target="#editTaxModal" data-id="'. $tax->id .'" data-name="'. $tax->name .'"
          data-value="'. $tax->value .'"><i class="fas fa-pen"></i> Edit</button>
          </div>
          <div class="remove">
          <button type="button" class="btn btn-sm btn-danger remove-item-btn" data-bs-toggle="modal"
          data-bs-target="#deleteTaxModal" data-id="'. $tax->id .'"><i class="fas fa-trash"></i>
          Delete</button>
          </div>
        </div>'
                ];
            })
        ]);
    }
    public function store(Request $request)
{
    $validator = Validator::make($request->all(), [
        'name' => 'required|unique:taxes,name',
        'value' => 'required|numeric|min:0|max:100'
    ]);

    if ($validator->fails()) {
        return response()->json([
            'status' => false,
            'errors' => $validator->errors()
        ], 422);
    }

    try {
        $tax = new Tax();
        $tax->name = $request->name;
        $tax->value = $request->value;
        $tax->is_default = $request->is_default;
        $tax->save();
        Session::flash('success','Tax created successfully');
        return response()->json([
            'status' => true,
            'message' => 'Tax created successfully',
        ]);

    } catch (\Exception $e) {

        return response()->json([
            'status' => false,
            'message' => 'Failed to add tax. Please try again.',
            'error' => $e
        ], 500);
    }
}
public function update(Request $request, $id)
{
    
    $validator = Validator::make($request->all(), [
        'name' => 'required|unique:taxes,name,'.$id,
        'value' => 'required|numeric|min:0|max:100',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'status' => false,
            'errors' => $validator->errors()
        ], 422);
    }

    try {
        $tax = Tax::findOrFail($id);
        $tax->name = $request->name;
        $tax->value = $request->value;
        $tax->is_default = $request->is_default;
        $tax->save();

        return response()->json([
            'status' => true,
            'message' => 'Tax updated successfully',
        ]);

    } catch (\Exception $e) {
        return response()->json([
            'status' => false,
            'message' => 'Failed to update tax. Please try again.',
        ], 500);
    }
}

public function destroy($id)
    {
        try {
            $tax = Tax::findOrFail($id);
            $tax->delete();

            return response()->json([
                'status' => true,
                'message' => 'Tax deleted successfully',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to delete tax. Please try again.',
                'error' => $e,
            ], 500);
        }
    }

    public function setDefaultTax(Request $request, $id)
    {
        try {
            // Set the current default tax to 0
            Tax::where('is_default', 1)->update(['is_default' => 0]);
    
            // Set the selected tax as the default
            $tax = Tax::findOrFail($id);
            $tax->is_default = $request->is_default;
            $tax->save();
    
            return response()->json(['success' => true, 'message' => 'Default tax updated successfully.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'An error occurred while updating the default tax.']);
        }
    }
    
}
