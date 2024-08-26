@extends('layouts.master')
@section('title') Show {{ $invoice->invoice_number }} @endsection
@section('css')
<link href="{{ URL::asset('build/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('build/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
            <h4 class="mb-sm-0 font-size-18">Invoice {{ $invoice->invoice_number }}</h4>
            <div class="page-title-right">
              @can('Add Payments')
            <button type="button" class="btn btn-primary add-btn" data-bs-toggle="modal" id="create-btn"
            data-bs-target="#addPaymentModal"><i class="fas fa-plus-circle me-2"></i>Add Payments</button>
            @endcan
            </div>
        </div>
    </div>
</div>
<!-- Invoice 1 - Bootstrap Brain Component -->
<section class="py-3 invoice-container">
  <div class="container">
    <div class="card py-5">
      <div class="row justify-content-center px-lg-5 px-sm-1">
        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mb-5 pb-4 px-4">
          <div class="col-md-4 mb-3">
            <h2 class="text-uppercase mb-2 ps-2 bg-dark text-light mb-sm-0 d-inline-block">Invoice
              {{ $invoice->invoice_number }}
            </h2><br>
            <strong class="text-muted fs-5">Bill date :
              <small>{{ \Carbon\Carbon::parse($invoice->invoice_date)->format('d/m/Y') }}</small></strong><br>
            <strong class="text-muted fs-5">Due date :
              <small>{{ \Carbon\Carbon::parse($invoice->due_date)->format('d/m/Y') }}</small></strong>
          </div>
          <div class="text-center">
            <img src="{{ URL::asset('public/images/uploads/' . $settings['app-logo']) }}" class="img-fluid" alt="Logo"
              style="max-width: 200px;">
          </div>
        </div>
        <div class="row d-inline-flex">
          <div class="row mb-5">
            <div class="col-12 col-sm-6 col-md-8">
              <h4>Bill To</h4>
              <address>
                <strong>{{ $invoice->client->first_name }} {{ $invoice->client->last_name }}</strong><br>
                {{ $invoice->client->Address }}<br>
                {{ optional($invoice->client->city)->name }}, {{ optional($invoice->client->state)->name }},
                {{ $invoice->client->postal_code }}<br>
                {{ optional($invoice->client->country)->name }}<br>
                Phone: {{ $invoice->client->contact }}<br>
                Email: {{ $invoice->client->email }}<br>
                <b>GST Number:</b> {{ $invoice->client->GST }}
              </address>
            </div>
            <div class="col-12 col-sm-6 col-md-4">
              <h4>SAS Associates</h4>
              <address>
                <strong>{{ $settings['company-name'] }}</strong><br>
                {{ $settings['Address'] }}<br>
                {{ $settings['city'] }}, {{ $settings['state'] }}, {{ $settings['zip-code'] }}<br>
                {{ $settings['country'] }}<br>
                Phone: + {{ $settings['country-code'] }} {{ $settings['company-phone'] }}<br>
                Email: {{ $settings['company-email'] }}<br>
                <b>GST Number:</b> {{ $settings['GST-NO'] }}
              </address>

            </div>
          </div>
          <div class="row mb-3">
            <div class="col-12">
              <div class="table-responsive">
                <table class="table table-striped">
                  <thead class="bg-dark">
                    <tr class="text-light">
                      <th scope="col">#</th>
                      <th scope="col">Item</th>
                      <th scope="col">Quantity</th>
                      <th scope="col">Rate</th>
                      <th scope="col">Total</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($invoice->items as $item)
            <tr>
              <th scope="row">{{ $loop->iteration }}</th>
              <td>{{ $item->product_name }}</td>
              <td>{{ $item->quantity }}</td>
              <td>{{ $item->unit_price }}</td>
              <td>{{ $item->total }}</td>
            </tr>
          @endforeach
                    <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <th>Subtotal (₹)</th>
                      <td>₹ {{ $invoice->subtotal }}</td>
                    </tr>
                    <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <th>Discount (₹)</th>
                      <td>₹ {{ $invoice->discount_total }}</td>
                    </tr>
                    <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      @php
            $invoice->tax = rtrim(rtrim($invoice->tax, '0'), '.');
          @endphp
                      <th>Tax ({{ $invoice->tax }}%)</th>
                      <td>₹ {{ $invoice->tax_total }}</td>
                    </tr>
                    <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <th>Total (₹)</th>
                      <td>₹ {{ $invoice->total }}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-12 col-sm-6 col-md-8">
              <h4>{{ $settings['company-name'] }}</h4>
              <strong>Company Name: </strong>{{ $settings['company-name'] }} <br>
              <strong>Account Number: </strong>{{ $settings['company-name'] }}<br>
              <strong>IFSC: </strong>{{ $settings['company-name'] }}<br>
              <strong>SWIFT code: </strong>{{ $settings['company-name'] }}<br>
              <strong>Bank name: </strong>{{ $settings['company-name'] }}<br>
              <strong>Branch: </strong>{{ $settings['company-name'] }}<br>
            </div>
          </div>
          <div class="row">
            <div class="col-12 text-end">
              <a href="#" onclick="window.print()" class="btn btn-primary">Print</a>
              @can('Download Invoices')
              <a href="{{ route('generate',$invoice->id )}}"  class="btn btn-primary">Download</a>
              @endcan
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

@can('Add Payments')
<div class="modal fade" id="addPaymentModal" tabindex="-1" aria-labelledby="addPaymentModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-light p-3">
        <h5 class="modal-title" id="addPaymentModalLabel">Add Payments</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
          id="close-add-modal"></button>
      </div>
      <form id="addPaymentForm" name="addPaymentForm" method="post">
        @csrf
        <div class="modal-body">
          <div class="mb-3">
           <input type="hidden" name="invoice" value="{{ $invoice->id }}" >
          </div>
          <div class="mb-3">
            <label for="Payment_method" class="form-label">Payment Method</label>
            <select class="form-select mb-3" id="Payment_method" name="Payment_method">
              <option value="bank_transfer">Bank Transfer</option>
              <option value="phone_pe">PhonePe</option>
              <option value="google_pay">Google Pay</option>
            </select>
            <div class="invalid-feedback"></div>
          </div>
          <div class="mb-3">
            <label for="payment_date" class="form-label">Payment Date</label>
            <input type="date" class="form-control" id="payment_date"
              value="{{ \Carbon\Carbon::today()->toDateString() }}" name="payment_date" />
            <div class="invalid-feedback"></div>
          </div>
          <div class="mb-3">
            <label for="payment_amount" class="form-label">Payment Amount</label>
            <input type="number" class="form-control" id="payment_amount" step="0.01" min="0" placeholder="Enter Amount"
              name="payment_amount" />
            <div class="invalid-feedback"></div>
          </div>
          <div class="mb-3">
            <label for="payment_note" class="form-label">Payment Note</label>
            <textarea class="form-control" cols="5" rows="5" name="payment_note" placeholder="Enter Note"
              id="payment_note"></textarea>
            <div class="invalid-feedback"></div>
          </div>
        </div>
        <div class="modal-footer">
          <div class="hstack gap-2 justify-content-end">
            <button type="button" class="btn btn-light" id="close-add-modal" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" id="add-btn">Save</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
@endcan
@endsection

@section('script')
<script src="{{ URL::asset('build/libs/prismjs/prism.js') }}"></script>
<script src="{{ URL::asset('build/select2/js/select2.min.js') }}"></script>
<script src="{{ URL::asset('build/libs/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ URL::asset('build/js/app.js') }}"></script>
<script>
   $(document).ready(function () {
    $('#addPaymentModal').on('shown.bs.modal', function () {
      $('#invoice').select2({
        dropdownParent: $('#addPaymentModal') // Ensure dropdown is appended to modal
      });
      $('#Payment_method').select2({
        dropdownParent: $('#addPaymentModal') // Ensure dropdown is appended to modal
      });
    });

    $('#addPaymentForm').on('submit', function (e) {
      e.preventDefault();

      $.ajax({
        type: 'POST',
        url: '{{ route("payment.store") }}',
        data: $(this).serialize(),
        success: function (response) {
          if (response.status) {
            $('#addPaymentModal').modal('hide');
            Swal.fire({
              icon: 'success',
              title: 'Success',
              text: response.message,
            }).then(function () {
              location.reload();
            });
          }



        },
        error: function (response) {
          var errors = response.responseJSON.errors;
          if (errors) {
            $.each(errors, function (key, value) {
              $('#' + key).addClass('is-invalid');
              $('#' + key).siblings('.invalid-feedback').text(value[0]);
            });
          } else {
            Swal.fire({
              icon: 'error',
              title: 'Error',
              text: response.responseJSON.message,
            });
          }
        }
      });
    });

    $('#addPaymentModal').on('hidden.bs.modal', function () {
      $('#addPaymentForm')[0].reset();
      $('.form-control').removeClass('is-invalid');
      $('.invalid-feedback').text('');
    });

    $('#close-add-modal, .btn-light').on('click', function () {
      $('#addPaymentForm')[0].reset();
      $('.form-control').removeClass('is-invalid');
      $('.invalid-feedback').text('');
    });
    });
</script>
@endsection