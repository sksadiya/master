<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Client;
use App\Models\clientService;
use App\Models\Country;
use App\Models\Invoice;
use App\Models\Payment;
use App\Models\serviceCategory;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use App\Rules\GstNumber;
use Spatie\LaravelPdf\Facades\Pdf;

class clientController extends Controller
{
    public function index(Request $request)
    {
        return view('client.index');
    }

    public function getClients(Request $request)
{
    try {
        $query = Client::withCount(['invoices', 'services'])->latest();
    
        if ($request->has('search') && !empty($request->get('search')['value'])) {
            $searchValue = $request->get('search')['value'];
            $query->where(function ($query) use ($searchValue) {
                $query->where('first_name', 'like', "%{$searchValue}%")
                      ->orWhere('business', 'like', "%{$searchValue}%")
                      ->orWhere('contact', 'like', "%{$searchValue}%");
            });
        }
    
        if ($request->has('order')) {
            $columnIndex = $request->get('order')[0]['column'];
            $columnName = $request->get('columns')[$columnIndex]['data'];
            $direction = $request->get('order')[0]['dir'];

            // Map DataTable columns to database columns
            $columnMap = [
                'name' => 'first_name',
                'business' => 'business',
                'contact' => 'contact',
                'invoices_count' => 'invoices_count',
                'services_count' => 'services_count'
            ];

            if (array_key_exists($columnName, $columnMap)) {
                $query->orderBy($columnMap[$columnName], $direction);
            }
        }
    
        $perPage = $request->get('length', 10);
        $page = $request->get('start', 0) / $perPage;
        $totalRecords = $query->count();
    
        $clients = $query->skip($page * $perPage)->take($perPage)->get();
    
        return response()->json([
            'draw' => intval($request->get('draw')),
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $totalRecords,
            'data' => $clients->map(function ($client) {
                return [
                    'name' => '<a href="'.route('client.show', $client->id).'">'.$client->first_name.'<a>', // Update to use first_name
                    'business' => $client->business,
                    'contact' => $client->contact,
                    'invoices_count' => $client->invoices_count,
                    'services_count' => $client->services_count,
                    'action' => '<div class="justify-content-end d-flex gap-2">
                        <div class="edit">
                            <a href="' . route('client.edit', $client->id) . '" class="btn btn-sm btn-success edit-item-btn">
                                <i class="fas fa-pen"></i> Edit
                            </a>
                        </div>
                        <div class="remove">
                            <button type="button" class="btn btn-sm btn-danger remove-item-btn" data-bs-toggle="modal"
                            data-bs-target="#confirmationModal" data-id="' . $client->id . '">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </div>
                    </div>'
                ];
            })
        ]);
    } catch (\Exception $e) {
        return response()->json(['error' => 'An error occurred.'], 500);
    }
}

    public function create()
    {
        $countries = Country::all();
        $serviceCategories = serviceCategory::all();
        return view('client.create', compact('countries','serviceCategories'));
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'first_name' => 'required|min:3',
            'last_name' => 'required|min:3',
            'business' => 'required',
            'contact' => 'required|numeric',
            'alter_contact' => 'nullable|numeric',
            'email' => 'nullable|email|max:255|string|unique:clients,email',
            'country' => 'nullable',
            'state' => 'nullable',
            'city' => 'nullable',
            'postal_code' => 'nullable',
            'GST' => ['nullable', new GstNumber],
            'Address' => 'nullable',
            'notes' => 'nullable',
            'website' => 'nullable|url',
            'service_categories' => 'nullable|array',
            'service_categories.*' => 'nullable|integer|exists:service_categories,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $client = new Client();
        $client->first_name = $request->first_name;
        $client->last_name = $request->last_name;
        $client->business = $request->business;
        $client->contact = $request->contact;
        $client->alter_contact = $request->alter_contact;
        $client->email = $request->email;
        $client->country_id = $request->country;
        $client->state_id = $request->state;
        $client->city_id = $request->city;
        $client->postal_code = $request->postal_code;
        $client->GST = $request->GST;
        $client->Notes = $request->notes;
        $client->Address = $request->Address;
        $client->website = $request->website;
        $success = $client->save();
        if ($success) {
            if ($request->has('service_categories')) {
                foreach ($request->service_categories as $categoryId) {
                    $service = new clientService();
                    $service->client_id = $client->id;
                    $service->service_category_id = $categoryId;
                   $service->save();
                }
            }
            Session::flash('success', 'Client Details Add Successfully!');
        } else {
            Session::flash('error', 'Client Details Add Failed!');
        }
        return redirect()->route('clients');
    }

    public function edit(Request $request, $id)
    {
        $client = Client::with('services')->findOrFail($id);

        if (empty($client)) {
            Session::flash('error', 'No CLient found!');
            return redirect()->route('clients');
        }
        $serviceCategories = serviceCategory::all();
        $selectedCategories = $client->services->pluck('id')->toArray();
        $countries = Country::all();
        return view('client.edit', compact('client', 'countries','serviceCategories','selectedCategories'));
    }

    public function update(Request $request, $id)
    {
        $client = Client::find($id);

        if (empty($client)) {
            $request->session()->flash('error', 'No CLient found!');
            return redirect()->route('clients');
        }
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|min:3',
            'last_name' => 'required|min:3',
            'business' => 'required',
            'contact' => 'required|numeric',
            'alter_contact' => 'nullable|numeric',
            'email' => 'nullable|email|max:255|string|unique:clients,email,' . $id,
            'country' => 'nullable',
            'state' => 'nullable',
            'city' => 'nullable',
            'postal_code' => 'nullable',
            'GST' => ['nullable', new GstNumber],
            'Address' => 'nullable',
            'notes' => 'nullable',
            'website' => 'nullable|url',
            'service_categories' => 'nullable|array',
            'service_categories.*' => 'nullable|integer|exists:service_categories,id',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $client->first_name = $request->first_name;
        $client->last_name = $request->last_name;
        $client->business = $request->business;
        $client->contact = $request->contact;
        $client->alter_contact = $request->alter_contact;
        $client->email = $request->email;
        $client->country_id = $request->country;
        $client->state_id = $request->state;
        $client->city_id = $request->city;
        $client->postal_code = $request->postal_code;
        $client->GST = $request->GST;
        $client->Notes = $request->notes;
        $client->Address = $request->Address;
        $client->website = $request->website;
        $success = $client->save();
        if ($success) {
            if ($request->has('service_categories')) {
                $client->services()->sync($request->service_categories);
            } else {
                $client->services()->sync([]);
            }
            Session::flash('success', 'Client Details Updated Successfully!');
        } else {
            Session::flash('error', 'Client Details Updated Successfully!');
        }
        return redirect()->route('clients');
    }

    public function destroy($id)
    {
        $client = Client::find($id);
        if (empty($client)) {
            Session::flash('error', 'No CLient found!');
            return redirect()->route('clients');
        }
        $client->delete();
        Session::flash('success', 'Client Deleted Successfully');
        return response()->json([
            'status' => true,
            'message' => 'Client Deleted Successfully'
        ]);
    }

    public function show($id, Request $request)
    {
        $client = Client::with('invoices.payments')->find($id);
        if (empty($client)) {
            Session::flash('error', 'No Client Found!');
            return redirect()->back();
        }
        $country = Country::find($client->country_id);
        $state = State::find($client->state_id);
        $city = City::find($client->city_id);
         // Collect all payments from the invoices
        return view('client.show', compact('client', 'country', 'state', 'city'));
    }

    public function getClientPayments(Request $request, $clientId)
{
    $client = Client::with('invoices.payments')->find($clientId);

    if (empty($client)) {
        return response()->json([
            'draw' => intval($request->get('draw')),
            'recordsTotal' => 0,
            'recordsFiltered' => 0,
            'data' => []
        ]);
    }

    // Build a query to get payments related to the client
    $query = Payment::whereIn('invoice_id', $client->invoices->pluck('id'));

    // Apply search filters
    if ($request->has('search') && !empty($request->get('search')['value'])) {
        $searchValue = $request->get('search')['value'];
        $query->where(function ($q) use ($searchValue) {
            $q->where('payment_date', 'like', "%{$searchValue}%")
              ->orWhere('payment_mode', 'like', "%{$searchValue}%")
              ->orWhere('due_payment', 'like', "%{$searchValue}%")
              ->orWhere('amount', 'like', "%{$searchValue}%")
              ->orWhereHas('invoice', function ($q) use ($searchValue) {
                  $q->where('invoice_number', 'like', "%{$searchValue}%");
              });
        });
    }

    // Apply sorting
    if ($request->has('order')) {
        $columnIndex = $request->get('order')[0]['column'];
        $columnName = $request->get('columns')[$columnIndex]['data'];
        $direction = $request->get('order')[0]['dir'];

        $columnMap = [
            'invoice' => 'invoice_id',
            'payment_date' => 'payment_date',
            'payment_mode' => 'payment_mode',
            'amount' => 'amount',
            'due_payment' => 'due_payment',
        ];

        if (array_key_exists($columnName, $columnMap)) {
            $query->orderBy($columnMap[$columnName], $direction);
        }
    }

    // Pagination
    $perPage = $request->get('length', 10);
    $page = $request->get('start', 0) / $perPage;
    $totalRecords = $query->count();

    $payments = $query->skip($page * $perPage)->take($perPage)->get();
    $invoiceController = new Invoices();
    // Return data in the required format
    return response()->json([
        'draw' => intval($request->get('draw')),
        'recordsTotal' => $totalRecords,
        'recordsFiltered' => $totalRecords,
        'data' => $payments->map(function ($payment) {
            return [
                'invoice' => '<a href="'.route('invoice.show', $payment->invoice->id).'">'.$payment->invoice->invoice_number.'</a>',
                'payment_date' => $payment->payment_date,
                'payment_mode' => $payment->payment_mode,
                'amount' => $payment->amount,
                'due_payment' => $payment->due_payment,
            ];
        })
    ]);
}

// In ClientController.php
public function getClientInvoices(Request $request, $clientId)
{
    $client = Client::with('invoices')->find($clientId);

    if (empty($client)) {
        return response()->json([
            'draw' => intval($request->get('draw')),
            'recordsTotal' => 0,
            'recordsFiltered' => 0,
            'data' => []
        ]);
    }

    $invoices = $client->invoices();

    // Filtering
     if ($request->has('search') && !empty($request->get('search')['value'])) {
        $searchValue = $request->get('search')['value'];
        $invoices->where(function ($query) use ($searchValue) {
            $query->where('invoice_number', 'like', "%{$searchValue}%")
                ->orWhere('total', 'like', "%{$searchValue}%")
                ->orWhere('due_amount', 'like', "%{$searchValue}%")
                ->orWhere('invoice_status', 'like', "%{$searchValue}%");
        });
    }

    // Sorting
    if ($request->has('order')) {
        $columnIndex = $request->get('order')[0]['column'];
        $columnName = $request->get('columns')[$columnIndex]['data'];
        $direction = $request->get('order')[0]['dir'];
        // Map DataTable columns to database columns
        $columnMap = [
            'invoice' => 'invoice_number',
            'invoice_date' => 'invoice_date',
            'due_date' => 'due_date',
            'total' => 'total',
            'due' => 'due_amount',
            'status' => 'invoice_status',
        ];

        if (array_key_exists($columnName, $columnMap)) {
            $invoices->orderBy($columnMap[$columnName], $direction);
        }
    }

    // Pagination
    $perPage = $request->get('length', 10); // Number of records per page
    $page = $request->get('start', 0) / $perPage; // Offset
    $totalRecords = $invoices->count(); // Total records count

    $invoices = $invoices->skip($page * $perPage)->take($perPage)->get(); // Fetch records

    // Create an instance of InvoiceController to call getStatusBadge method
    $invoiceController = new Invoices();

    return response()->json([
        'draw' => intval($request->get('draw')),
        'recordsTotal' => $totalRecords,
        'recordsFiltered' => $totalRecords, // Assuming no additional filtering beyond search
        'data' => $invoices->map(function ($invoice) use ($invoiceController) {
            return [
                'invoice' => '<a href="' . route('invoice.show', $invoice->id) . '">' . $invoice->invoice_number . '</a>',
                'invoice_date' => $invoice->invoice_date,
                'due_date' => $invoice->due_date,
                'total' => $invoice->total,
                'due' => $invoice->due_amount,
                'status' => $invoiceController->getStatusBadge($invoice->invoice_status),
            ];
        })
    ]);
}

    public function exportClientPayments($id) {
        $client = Client::with('invoices.payments')->find($id);
        if (empty($client)) {
            Session::flash('error', 'No Client Found!');
            return redirect()->back();
        }
        $payments = $client->invoices->flatMap(function($invoice) {
            return $invoice->payments;
        });
        $pdf = Pdf::view('client.exportPayments', ['payments' => $payments])
        ->format('A4')
        ->download('invoices.pdf');

    return $pdf;

    }
    public function exportClientInvoices($id) {
        $client = Client::with('invoices')->find($id);
        if (empty($client)) {
            Session::flash('error', 'No Client Found!');
            return redirect()->back();
        }
        $invoices = $client->invoices;
        $pdf = Pdf::view('client.exportInvoices', ['invoices' => $invoices])
        ->format('A4')
        ->download('invoices.pdf');

    return $pdf;
    }
    

}
