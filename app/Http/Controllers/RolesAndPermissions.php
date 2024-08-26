<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;

class RolesAndPermissions extends Controller
{
    public function index(Request $request)
    {
        return view('roles.index');
    }
    public function getRoles(Request $request)
    {
        $query = Role::latest();
    
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

            // Map DataTable columns to database columns
            $columnMap = [
                'name' => 'name',
            ];

            if (array_key_exists($columnName, $columnMap)) {
                $query->orderBy($columnMap[$columnName], $direction);
            }
        }
        // Pagination
        $perPage = $request->get('length', 10); // Number of records per page
        $page = $request->get('start', 0) / $perPage; // Offset
        $totalRecords = $query->count(); // Total records count
    
        $roles = $query->skip($page * $perPage)->take($perPage)->get(); // Fetch records
    
        return response()->json([
            'draw' => intval($request->get('draw')),
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $totalRecords, // Assuming no additional filtering beyond search
            'data' => $roles->map(function ($role) {
                return [
                    'name' => $role->name,
                    'action' => $this->generateRolesActions($role),
                ];
            })
        ]);
    }
    private function generateRolesActions($role)
    {
        $actions = '';
        if (Auth::user()->can('Edit Roles')) {
            $actions .= '<div class="edit">
                            <a href="'. route('role.edit',$role->id) .'" class="btn btn-sm btn-success edit-item-btn"><i class="fas fa-pen"></i> Edit</a>
                          </div>';
        }
        if (Auth::user()->can('Delete Roles')) {
            $actions .= '<div class="remove">
                            <button type="button" class="btn btn-sm btn-danger remove-item-btn" data-bs-toggle="modal" data-bs-target="#roleDeleteModal" data-id="'. $role->id .'"><i class="fas fa-trash"></i> Delete</button>
                          </div>';
        }
        return $actions ? '<div class="justify-content-end d-flex gap-2">' . $actions . '</div>' : '';
    }

    public function create()
    {
        $allPermissions = Permission::all();
    
    // Organize permissions into categories
    $permissions = [
        'departments' => $allPermissions->filter(function ($permission) {
            return str_contains($permission->name, 'Departments');
        }),
        'employees' => $allPermissions->filter(function ($permission) {
            return str_contains($permission->name, 'Employees');
        }),
        'clients' => $allPermissions->filter(function ($permission) {
            return str_contains($permission->name, 'Clients');
        }),
        'invoices' => $allPermissions->filter(function ($permission) {
            return str_contains($permission->name, 'Invoices');
        }),
        'payments' => $allPermissions->filter(function ($permission) {
            return str_contains($permission->name, 'Payments');
        }),
        'categories' => $allPermissions->filter(function ($permission) {
            return str_contains($permission->name, 'Categories');
        }),
        'products' => $allPermissions->filter(function ($permission) {
            return str_contains($permission->name, 'Products');
        }),
        'roles' => $allPermissions->filter(function ($permission) {
            return str_contains($permission->name, 'Roles');
        }),
        'settings' => $allPermissions->filter(function ($permission) {
            return str_contains($permission->name, 'Settings') || str_contains($permission->name, 'Dashboard');
        }),
        'Tasks' => $allPermissions->filter(function ($permission) {
            return str_contains($permission->name, 'Tasks');
        }),
        'Tasks Notes' => $allPermissions->filter(function ($permission) {
            return str_contains($permission->name, 'Task Notes');
        }),
        'expenseCategories' => $allPermissions->filter(function ($permission) {
            return str_contains($permission->name, 'expenseCategories');
        }),
        'serviceCategories' => $allPermissions->filter(function ($permission) {
            return str_contains($permission->name, 'serviceCategories');
        }),
        'Notes' => $allPermissions->filter(function ($permission) {
            return str_contains($permission->name, 'Notes');
        }),
        'Taxes' => $allPermissions->filter(function ($permission) {
            return str_contains($permission->name, 'Taxes');
        }),
        'Expenses' => $allPermissions->filter(function ($permission) {
            return str_contains($permission->name, 'Expenses');
        }),
      
    ];
        // $permissions = Permission::all();
        return view('roles.create', compact('permissions'));
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'permissions' => 'array|nullable',
            'permissions.*' => 'exists:permissions,id',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }
        $role = Role::create(['name' => $request->name]);
        if ($request->has('permissions')) {
            $permissions = $request->input('permissions');
            $validPermissions = Permission::whereIn('id', $permissions)->pluck('id');
            $role->syncPermissions($validPermissions);
        }

        return redirect()->route('roles')->with('success', 'Role Created Succcessfully.');
    }
    public function edit($id)
    {
        $role = Role::find($id);
        if (empty($role)) {
            Session::flash('error', 'No role Found!');
            return redirect()->back();
        }
        $allPermissions = Permission::all();
    
    // Organize permissions into categories
    $permissions = [
        'departments' => $allPermissions->filter(function ($permission) {
            return str_contains($permission->name, 'Departments');
        }),
        'employees' => $allPermissions->filter(function ($permission) {
            return str_contains($permission->name, 'Employees');
        }),
        'clients' => $allPermissions->filter(function ($permission) {
            return str_contains($permission->name, 'Clients');
        }),
        'invoices' => $allPermissions->filter(function ($permission) {
            return str_contains($permission->name, 'Invoices');
        }),
        'payments' => $allPermissions->filter(function ($permission) {
            return str_contains($permission->name, 'Payments');
        }),
        'categories' => $allPermissions->filter(function ($permission) {
            return str_contains($permission->name, 'Categories') &&
           !str_contains($permission->name, 'expenseCategories') &&
            !str_contains($permission->name, 'serviceCategories');
        }),
        'products' => $allPermissions->filter(function ($permission) {
            return str_contains($permission->name, 'Products');
        }),
        'roles' => $allPermissions->filter(function ($permission) {
            return str_contains($permission->name, 'Roles');
        }),
        'settings' => $allPermissions->filter(function ($permission) {
            return str_contains($permission->name, 'Settings') || str_contains($permission->name, 'Dashboard');
        }),
       'Tasks' => $allPermissions->filter(function ($permission) {
            return str_contains($permission->name, 'Tasks');
        }),
        'Tasks Notes' => $allPermissions->filter(function ($permission) {
            return str_contains($permission->name, 'Task Notes');
        }),
        'expenseCategories' => $allPermissions->filter(function ($permission) {
            return str_contains($permission->name, 'expenseCategories');
        }),
        'serviceCategories' => $allPermissions->filter(function ($permission) {
            return str_contains($permission->name, 'serviceCategories');
        }),
        'Note' => $allPermissions->filter(function ($permission) {
            return str_contains($permission->name, 'Note') &&
            !str_contains($permission->name, 'Task Notes');
        }),
        'Taxes' => $allPermissions->filter(function ($permission) {
            return str_contains($permission->name, 'Taxes');
        }),
        'Expenses' => $allPermissions->filter(function ($permission) {
            return str_contains($permission->name, 'Expenses');
        }),
    ];
        return view('roles.edit', compact('permissions', 'role'));
    }
    public function update($id, Request $request)
    {
        $role = Role::find($id);
        if (empty($role)) {
            Session::flash('error', 'No role Found!');
            return redirect()->back();
        }
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'permissions' => 'array|nullable',
            'permissions.*' => 'exists:permissions,id',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $role->name = $request->name;
        $role->save();
        if ($request->has('permissions')) {
            $permissions = $request->input('permissions');
            $validPermissions = Permission::whereIn('id', $permissions)->pluck('id');
            $role->syncPermissions($validPermissions);
        } else {
            $role->syncPermissions([]); // Remove all permissions if none are selected
        }

        return redirect()->route('roles')->with('success', 'Role Updated Successfully.');
    }
    public function destroy($id)
    {
        $role = Role::find($id);
        if (empty($role)) {
           return response()->json([
            'status' => 'error',
            'message' => 'No role Found!',
           ],422);
        }
        $role->delete();
        Session::flash('success', 'Role Deleted Successfully');
        return response()->json([
            'status' => true,
            'message' => 'Role Deleted Successfully'
        ]);
    }
}
