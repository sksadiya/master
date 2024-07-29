<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Spatie\LaravelPdf\Facades\Pdf;
class Payments extends Controller
{
    public function index(Request $request) {
    $payments = Payment::with('invoice');
        $invoices = Invoice::all();
        if (!empty($request->get('search'))) {
            $payments = $payments->where(function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->get('search') . '%')
                    ->orWhere('value', 'like', '%' . $request->get('search') . '%');
            });
        }

        $perPage = $request->get('perPage', 20);
        $payments = $payments->paginate($perPage);

        return view('payments.index', compact('payments','invoices'));
    }
    public function store(Request $request)
{
    // Validate the request data
    $validator = Validator::make($request->all(), [
        'invoice' => 'required|exists:invoices,id',
        'Payment_method' => 'required|string',
        'payment_date' => 'required|date',
        'payment_note' => 'nullable|string',
        'payment_amount' => [
            'required',
            'numeric',
            'min:0',
            'regex:/^\d+(\.\d{1,2})?$/', // Minimum value of 0
            function ($attribute, $value, $fail) use ($request) {
                // Find the invoice
                $invoice = Invoice::find($request->invoice);

                if (!$invoice) {
                    $fail('Invoice not found.');
                    return;
                }

                // Calculate the due amount before saving the new payment
                $previousPayments = $invoice->payments()->sum('amount');
                $dueAmountBeforePayment = max($invoice->total - $previousPayments, 0);

                // Ensure the payment amount does not exceed the due amount
                if ($value > $dueAmountBeforePayment) {
                    $fail('The payment amount exceeds the due amount.');
                }
            }
        ]
    ]);

    if ($validator->fails()) {
        return response()->json([
            'status' => false,
            'errors' => $validator->errors()
        ], 422);
    }

    // Find the invoice
    $invoice = Invoice::find($request->invoice);

    if (!$invoice) {
        return response()->json([
            'status' => false,
            'message' => 'Invoice not found'
        ], 404);
    }

    // Calculate the due amount before saving the new payment
    $previousPayments = $invoice->payments()->sum('amount');
    $dueAmountBeforePayment = max($invoice->total - $previousPayments, 0);

    // Check if due amount is zero
    if ($dueAmountBeforePayment <= 0) {
        return response()->json([
            'status' => false,
            'message' => 'The invoice is already fully paid. No additional payments can be made.'
        ], 400);
    }

    // Ensure the payment amount does not exceed the due amount
    $paymentAmount = min($request->payment_amount, $dueAmountBeforePayment);

    // Create and save the payment
    $payment = new Payment();
    $payment->invoice_id = $request->invoice;
    $payment->payment_mode = $request->Payment_method;
    $payment->payment_date = $request->payment_date;
    $payment->notes = $request->payment_note;
    $payment->amount = $paymentAmount;
    $payment->due_payment = $dueAmountBeforePayment - $paymentAmount;
    $payment->save();

    // Update the invoice's due amount
    $newDueAmount = $dueAmountBeforePayment - $paymentAmount;
    $invoice->due_amount = max($newDueAmount, 0);

    if ($invoice->due_amount == 0) {
        $invoice->invoice_status = 'Paid';
    } elseif ($invoice->due_amount > 0 && $invoice->due_amount < $invoice->total) {
        $invoice->invoice_status = 'Partially_Paid';
    } else {
        $invoice->invoice_status = 'Unpaid'; // You can also handle other statuses if needed
    }

    $invoice->save();

    return response()->json([
        'status' => true,
        'message' => 'Payment saved and invoice updated successfully!',
        'due_amount' => $invoice->due_amount
    ]);
}

public function update(Request $request, $id)
{
    $payment = Payment::with('invoice')->find($id);
    if (!$payment) {
        return response()->json([
            'status' => false,
            'message' => 'Payment Not Found'
        ], 422);
    }

    $validator = Validator::make($request->all(), [
        'edit_invoice_id' => 'required|exists:invoices,id',
        'edit_Payment_method' => 'required|string',
        'edit_payment_date' => 'required|date',
        'edit_payment_note' => 'nullable|string',
        'edit_payment_amount' => [
            'required',
            'numeric',
            'min:0',
            'regex:/^\d+(\.\d{1,2})?$/',
            function ($attribute, $value, $fail) use ($request, $payment) {
                $invoice = Invoice::find($request->edit_invoice_id);
                if (!$invoice) {
                    $fail('Invoice not found.');
                    return;
                }

                // Calculate the total previous payments excluding the current payment
                $previousPayments = $invoice->payments()->where('id', '!=', $payment->id)->sum('amount');
                // Calculate the due amount before applying the new payment
                $dueAmountBeforePayment = max($invoice->total - $previousPayments, 0);

                // Ensure the payment amount does not exceed the due amount
                if ($value > $dueAmountBeforePayment) {
                    $fail('The payment amount exceeds the due amount.');
                }
            }
        ]
    ]);

    if ($validator->fails()) {
        return response()->json([
            'status' => false,
            'errors' => $validator->errors()
        ], 422);
    }

    // Update the payment
    $payment->invoice_id = $request->edit_invoice_id;
    $payment->payment_mode = $request->edit_Payment_method;
    $payment->payment_date = $request->edit_payment_date;
    $payment->notes = $request->edit_payment_note;
    $payment->amount = $request->edit_payment_amount;
    $payment->save();

    // Recalculate the due amount after saving the payment
    $invoice = Invoice::find($request->edit_invoice_id);
    $previousPayments = $invoice->payments()->sum('amount');
    $dueAmountAfterPayment = max($invoice->total - $previousPayments, 0);

    // Update the payment with the new due amount
    $payment->due_payment = $dueAmountAfterPayment;
    $payment->save();

    // Update the invoice with the new due amount and status
    $invoice->due_amount = $dueAmountAfterPayment;
    if ($invoice->due_amount == 0) {
        $invoice->invoice_status = 'Paid';
    } elseif ($invoice->due_amount > 0 && $invoice->due_amount < $invoice->total) {
        $invoice->invoice_status = 'Partially_Paid';
    } else {
        $invoice->invoice_status = 'Unpaid'; // You can also handle other statuses if needed
    }
    $invoice->save();

    return response()->json([
        'status' => true,
        'message' => 'Payment updated successfully',
        'due_amount' => $dueAmountAfterPayment,
        'invoice_status' => $invoice->status
    ], 200);
}



public function destroy($id)
{
    $payment = payment::with('invoice')->find($id);
    if (empty($payment)) {
        Session::flash('error', 'No Payment found!');
        return redirect()->route('payments');
    }
    $invoice = $payment->invoice;
    $payment->delete();

    $previousPayments = $invoice->payments()->sum('amount');
    $dueAmountAfterDeletion = max($invoice->total - $previousPayments, 0);

    $invoice->due_amount = $dueAmountAfterDeletion;
    if ($invoice->due_amount == 0) {
        $invoice->invoice_status = 'Paid';
    } elseif ($invoice->due_amount > 0 && $invoice->due_amount < $invoice->total) {
        $invoice->invoice_status = 'Partially_Paid';
    } else {
        $invoice->invoice_status = 'Unpaid';
    }
    $invoice->save();
    Session::flash('success', 'Payment Deleted Successfully');
    return response()->json([
        'status' => true,
        'message' => 'Payment Deleted Successfully'
    ]);
}
public function exportPayments() {
    $payments = Payment::with('invoice.client')->latest()->get();
    $pdf = Pdf::view('payments.exportPayments', ['payments' => $payments])
            ->format('A4')
            ->download('invoices.pdf');

        return $pdf;
}
}
