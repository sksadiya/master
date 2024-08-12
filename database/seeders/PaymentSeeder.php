<?php

namespace Database\Seeders;

use App\Models\Invoice;
use App\Models\Payment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Carbon\Carbon;
class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $invoiceIds = Invoice::pluck('id')->toArray();

        foreach (range(1, 15) as $index) {
            // Randomly select an invoice
            $invoiceId = $faker->randomElement($invoiceIds);
            $invoice = Invoice::find($invoiceId);

            if (!$invoice) {
                continue; // Skip if invoice not found
            }

            // Calculate the due amount before creating the new payment
            $previousPayments = $invoice->payments()->sum('amount');
            $dueAmountBeforePayment = max($invoice->total - $previousPayments, 0);

            // Ensure payment amount is less than or equal to due amount
            $paymentAmount = $faker->numberBetween(1, $dueAmountBeforePayment);

            // Create and save the payment
            $payment = new Payment();
            $payment->invoice_id = $invoiceId;
            $payment->payment_mode = 'bank_transfer'; // Fixed payment mode
            $payment->payment_date = now(); // Set payment date to today
            $payment->amount = $paymentAmount;
            $payment->due_payment = $dueAmountBeforePayment - $paymentAmount;
            $payment->save();

            // Update the invoice's due amount
            $invoice->due_amount = $invoice->due_amount - $paymentAmount;

            // Update the invoice status based on the new due amount
            if ($invoice->due_amount == 0) {
                $invoice->invoice_status = 'Paid';
            } elseif ($invoice->due_amount > 0 && $invoice->due_amount < $invoice->total) {
                $invoice->invoice_status = 'Partially_Paid';
            } else {
                $invoice->invoice_status = 'Unpaid'; // This line might not be needed if invoice is always partially paid
            }

            $invoice->save();
        }
    }
}
