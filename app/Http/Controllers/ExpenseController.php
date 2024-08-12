<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\expense_category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ExpenseController extends Controller
{
    public function index(Request $request)
    {
        return view('expenses.index');
    }
    public function getExpenses(Request $request)
    {
        $query = Expense::with(['category', 'member'])->latest();
        // Filtering
        if ($request->has('search') && !empty($request->get('search')['value'])) {
            $searchValue = $request->get('search')['value'];
            $query->where('title', 'like', "%{$searchValue}%")
                    ->orWhere('amount', 'like',"%{$searchValue}%")
                    ->orWhere('date', 'like',"%{$searchValue}%")
                    ->orWhereHas('category', function($q) use ($searchValue) {
                        $q->where('name', 'like', "%{$searchValue}%");
                    })
                    ->orWhereHas('member', function($q) use ($searchValue) {
                        $q->where('name', 'like', "%{$searchValue}%");
                    });
        }
    
        // Sorting
        if ($request->has('order')) {
            $columnIndex = $request->get('order')[0]['column'];
            $columnName = $request->get('columns')[$columnIndex]['data'];
            $direction = $request->get('order')[0]['dir'];
            // Map DataTable columns to database columns
            $columnMap = [
                'title' => 'title',
                'amount' => 'amount',
                'date' => 'date',
                'category' => 'expense_category_id',
                'member' => 'team_member_id',
            ];

            if (array_key_exists($columnName, $columnMap)) {
                $query->orderBy($columnMap[$columnName], $direction);
            }
        }
        // Pagination
        $perPage = $request->get('length', 10); // Number of records per page
        $page = $request->get('start', 0) / $perPage; // Offset
        $totalRecords = $query->count(); // Total records count
    
        $expenses = $query->skip($page * $perPage)->take($perPage)->get(); // Fetch records
    
        return response()->json([
            'draw' => intval($request->get('draw')),
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $totalRecords, // Assuming no additional filtering beyond search
            'data' => $expenses->map(function ($expense) {
                return [
                    'title' => '<a href="'. route('expense.show',$expense->id).'">'.$expense->title.'</a>',
                    'date' =>  \Carbon\Carbon::parse($expense->date)->format('d/m/Y') ,
                    'category' => $expense->category->name,
                    'amount' => $expense->amount,
                    'member' => $expense->member->name,
                    'action' =>'<div class="justify-content-end d-flex gap-2">
          <div class="edit">
          <a href="'. route('expense.edit', $expense->id).'"
          class="btn btn-sm btn-success edit-item-btn"><i class="bx bxs-pencil"></i> Edit</a>
          </div>
          <div class="remove">
          <button type="button" class="btn btn-sm btn-danger remove-item-btn" data-bs-toggle="modal"
          data-bs-target="#confirmationModal" data-id="'. $expense->id .'"><i class="bx bx-trash"></i>
          Delete</button>
          </div>
        </div>',
                ];
            })
        ]);
    }
    public function create()
    {
        $categories = expense_category::all();
        $members = User::all();
        return view('expenses.create', compact('categories', 'members'));
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'date' => 'required|date',
            'category' => 'required|exists:expense_categories,id',
            'member' => 'required|exists:users,id',
            'amount' => 'required|numeric|min:0',
            'title' => 'required|min:3',
            'description' => 'nullable',
            'bill' => 'nullable|file',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $success = false;

        $expense = new Expense();
        $expense->title = $request->title;
        $expense->date = $request->date;
        $expense->expense_category_id = $request->category;
        $expense->team_member_id = $request->member;
        $expense->amount = $request->amount;
        $expense->description = $request->description;
        if ($request->file('bill')) {
            $bill = $request->file('bill');
            $billName = time() . '_' . uniqid() . '.' . $bill->getClientOriginalExtension();
            $billPath = public_path('/images/uploads/bills/');
            $bill->move($billPath, $billName);
            $expense->bill_file = $billName;
        }
        $expense->save();
        $success = true;
        if ($success) {
            return redirect()->route('expenses')
                ->with('success', 'Expense Created Successfully');
        } else {
            return redirect()->route('expenses')
                ->with('error', 'Failed to add Expense');
        }
    }
    public function edit($id)
    {
        $expense = Expense::find($id);
        if (empty($expense)) {
            Session::flash('error', 'No Expense found!');
            return redirect()->route('expenses');
        }
        $categories = expense_category::all();
        $members = User::all();
        return view('expenses.edit', compact('expense', 'categories', 'members'));
    }
    public function update(Request $request, $id)
    {
        $expense = Expense::find($id);
        if (empty($expense)) {
            Session::flash('error', 'No Expense found!');
            return redirect()->route('expenses');
        }
        $validator = Validator::make($request->all(), [
            'date' => 'required|date',
            'category' => 'required|exists:expense_categories,id',
            'member' => 'required|exists:users,id',
            'amount' => 'required|numeric|min:0',
            'title' => 'required|min:3',
            'description' => 'nullable',
            'bill' => 'nullable|file',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $success = false;
        $expense->title = $request->title;
        $expense->date = $request->date;
        $expense->expense_category_id = $request->category;
        $expense->team_member_id = $request->member;
        $expense->amount = $request->amount;
        $expense->description = $request->description;
        $fileBasePath = public_path('images/uploads/bills/');

        // Delete files from the specific directory
        if ($request->hasFile('bill')) {
            // Handle file upload
            $bill = $request->file('bill');
            $billName = time() . '_' . uniqid() . '.' . $bill->getClientOriginalExtension();
            $billPath = public_path('/images/uploads/bills/');

            // Move the new file to the destination
            if ($bill->move($billPath, $billName)) {
                // Delete the old file if it exists
                if ($expense->bill_file) {
                    $filePath = $fileBasePath . $expense->bill_file;
                    if (File::exists($filePath)) {
                        File::delete($filePath);
                    }
                }
                // Update the expense record with the new file name
                $expense->bill_file = $billName;
            } else {
                // Handle the error (e.g., log it, set an error message, etc.)
                Session::flash('error', 'Failed to upload the new bill file.');
                return redirect()->back()->withInput();
            }
        }
        $expense->save();
        $success = true;
        if ($success) {
            Session::flash('success', 'Expense updated successfully!');
        } else {
            Session::flash('error', 'Failed to update expense!');
        }
        return redirect()->route('expenses');
    }
    public function destroy($id) {
        $expense = Expense::find($id);
        
        if (empty($expense)) {
            Session::flash('error', 'No Expense found!');
            return redirect()->route('expenses');
        }
        $success = false;
        $fileBasePath = public_path('images/uploads/documents/');
        if ($expense->bill_file) {
            $filePath = $fileBasePath . $expense->bill_file;
            if (File::exists($filePath)) {
                File::delete($filePath);
            }
        }
        $expense->delete();
        $success = true;
        if ($success) {
            Session::flash('success', 'Expense deleted successfully!');
        } else {
            Session::flash('error', 'Failed to delete expense!');
        }
        return redirect()->route('expenses');
    }

    public function show($id, Request $request)
    {
        $expense = Expense::find($id);
        if (empty($expense)) {
            Session::flash('error', 'No Client Found!');
            return redirect()->back();
        }
        return view('expenses.show', compact('expense'));
    }
}
