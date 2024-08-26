<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        return view('product.index');
    }
    public function getProducts(Request $request)
    {
        $query = Product::with('category')->latest();
        // Filtering
        if ($request->has('search') && !empty($request->get('search')['value'])) {
            $searchValue = $request->get('search')['value'];
            $query->where('name', 'like', "%{$searchValue}%")
            ->orWhere('unit_price','like',"%{$searchValue}%")
            ->orWhereHas('category', function($q) use ($searchValue) {
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
                'name' => 'name',
                'category' => 'category_id',
                'price' => 'unit_price',
            ];

            if (array_key_exists($columnName, $columnMap)) {
                $query->orderBy($columnMap[$columnName], $direction);
            }
        }
        // Pagination
        $perPage = $request->get('length', 10); // Number of records per page
        $page = $request->get('start', 0) / $perPage; // Offset
        $totalRecords = $query->count(); // Total records count
    
        $products = $query->skip($page * $perPage)->take($perPage)->get(); // Fetch records
    
        return response()->json([
            'draw' => intval($request->get('draw')),
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $totalRecords, // Assuming no additional filtering beyond search
            'data' => $products->map(function ($product) {
                return [
                    'name' => $product->name,
                    'category' => $product->category->name,
                    'price' => $product->unit_price,
                    'action' =>$this->generateProductActions($product)
                ];
            })
        ]);
    }
    private function generateProductActions($product)
    {
        $actions = '';
        if (Auth::user()->can('Edit Products')) {
            $actions .= '<div class="edit">
          <a href="'. route('product.edit',$product->id) .'" class="btn btn-sm btn-success edit-item-btn" ><i class="fas fa-pen"></i> Edit</a>
          </div>';
        }
        if (Auth::user()->can('Delete Products')) {
            $actions .= '<div class="remove">
          <button type="button" class="btn btn-sm btn-danger remove-item-btn" data-bs-toggle="modal"
          data-bs-target="#productDeleteModal" data-id="'. $product->id .'"><i class="fas fa-trash"></i>
          Delete</button>
          </div>';
        }
        return $actions ? '<div class="justify-content-end d-flex gap-2">' . $actions . '</div>' : '';
    }
    public function create()
    {
        $categories = Category::all();
        return view('product.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:products,name|min:2',
            'category' => 'required',
            'description' => 'nullable|min:10',
            'unit_price' => 'required|numeric|min:0'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $product = new Product();
        $product->name = $request->name;
        $product->category_id = $request->category;
        $product->description = $request->description;
        $product->unit_price = $request->unit_price;
        $success = $product->save();
        if ($success) {
            Session::flash('success', 'Product Created Successfully');
        } else {
            Session::flash('error', 'Product Creation Failed');
        }
        return redirect()->route('products');
    }
    public function edit($id)
    {
        $product = Product::find($id);
        if (empty($product)) {
            Session::flash('error', 'No Product Found!');
            return redirect()->back();
        }
        $categories = Category::all();
        return view('product.edit', compact('categories', 'product'));
    }
    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        if (empty($product)) {
            Session::flash('error', 'No Product Found!');
            return redirect()->route('products');
        }
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:2|unique:products,name,' . $id,
            'category' => 'required|exists:categories,id',
            'description' => 'nullable|min:10',
            'unit_price' => 'required|numeric|min:0'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $product->name = $request->name;
        $product->category_id = $request->category;
        $product->description = $request->description;
        $product->unit_price = $request->unit_price;
        $success = $product->save();
        if ($success) {
            Session::flash('success', 'Product Updated Successfully');
        } else {
            Session::flash('error', 'Product Update Failed');
        }
        return redirect()->route('products');
    }
    public function destroy($id)
    {
        $product = Product::find($id);
        if (empty($product)) {
            Session::flash('error', 'No Product Found!');
            return redirect()->back();
        }
        $product->delete();
        Session::flash('success', 'Product Deleted Successfully');
        return response()->json([
            'status' => true,
            'message' => 'Product Deleted Successfully'
        ]);
    }
}
