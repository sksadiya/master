@extends('layouts.master')

@section('title')
Invoices
@endsection

@section('css')
<link href="{{ URL::asset('build/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('build/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title mb-0">Invoices</h4>
      </div>

      <div class="card-body">
        <div class="listjs-table" id="invoiceList">
          <div class="row g-4 mb-3">
            <div class="col-sm-auto">
              <div>
                <a href="{{ route('invoice.add') }}" type="button" class="btn btn-primary add-btn"><i
                    class="bx bx-plus-circle me-2"></i>Add Invoice</a>
                <button type="button" class="btn btn-primary add-btn" data-bs-toggle="modal" id="create-btn"
                  data-bs-target="#addPaymentModal"><i class="bx bx-plus-circle me-2"></i>Add Payments</button>
              </div>
            </div>
            <div class="col-sm">
                <div class="d-flex justify-content-sm-end">
                <a href="{{ route('exportInvoices') }}" type="button" class="btn btn-outline-success btn-border me-2">PDF Export</a>
                <a href="{{ route('export-invoices') }}" type="button" class="btn btn-outline-success btn-border">Excel Export</a>
                </div>
            </div>
          </div>

          <div class="table-responsive table-card mt-3 mb-1">
            <table class="table align-middle table-nowrap" id="invoiceTable">
              <thead class="table-light">
                <tr>
                  <th>Invoice</th>
                  <th>Client</th>
                  <th>Total Amount</th>
                  <th>Due Amount</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody class="list form-check-all">
              
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade zoomIn" id="invoiceDeleteModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="btn-close"></button>
      </div>
      <div class="modal-body">
        <div class="mt-2 text-center">
          <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop"
            colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon>
          <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
            <h4>Are you sure?</h4>
            <p class="text-muted mx-4 mb-0">Are you sure you want to remove this invoice?</p>
          </div>
        </div>
        <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
          <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn w-sm btn-danger" id="delete-record">Yes, Delete It!</button>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- add Payment Modal -->
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
            <label for="invoice" class="form-label">Select Invoice</label>
            <select class="form-select mb-3" id="invoice" name="invoice">
              @foreach ($invoices as $invoice)
          <option value="{{ $invoice->id }}">{{ $invoice->invoice_number }}</option>
        @endforeach
            </select>
            <div class="invalid-feedback"></div>
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

@endsection

@section('script')
<script src="{{ URL::asset('build/libs/prismjs/prism.js') }}"></script>
<script src="{{ URL::asset('build/select2/js/select2.min.js') }}"></script>
<script src="{{ URL::asset('build/libs/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ URL::asset('build/js/app.js') }}"></script>
<script>
  @if(Session::has('success'))
    Swal.fire({
    title: 'Success!',
    text: '{{ Session::get('success') }}',
    icon: 'success',
    showCancelButton: false,
    customClass: {
      confirmButton: 'btn btn-primary w-xs me-2 mt-2',
    },
    buttonsStyling: false,
    showCloseButton: true
    });
  @endif

  @if(Session::has('error'))
    Swal.fire({
    title: 'Error!',
    text: "{{ Session::get('error') }}",
    icon: 'error',
    showCancelButton: false,
    customClass: {
      confirmButton: 'btn btn-danger w-xs mt-2',
    },
    buttonsStyling: false,
    showCloseButton: true
    });
  @endif

  $(document).ready(function () {

    $('#invoiceTable').DataTable({
    processing: true,
    serverSide: true,
    ajax: {
        url: '{{ route('invoices.data') }}',
        type: 'GET',
        dataSrc: function (json) {
            console.log('Data received:', json);
            return json.data;
        },
        error: function(xhr, textStatus, errorThrown) {
            console.error('AJAX error:', textStatus, errorThrown);
        }
    },
    columns: [
        { data: 'invoice', name: 'invoice_number' },
        { data: 'client', name: 'client' },
        { data: 'total', name: 'total' },
        { data: 'due', name: 'due_amount' },
        { data: 'status', name: 'invoice_status' },
        { data: 'action', name: 'action', orderable: false, searchable: false }
    ],
    order: [[0, 'desc']],
    pageLength: 10
});

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

    $('#invoiceTable').on('click', '.remove-item-btn', function () {
      var invoiceID = $(this).data('id');
      $('#delete-record').data('id', invoiceID);
    });

    $('#delete-record').on('click', function () {
      var invoiceID = $(this).data('id');
      console.log(invoiceID);
      const delRoute = "{{ route('invoice.delete', 'ID') }}";
      const newdelRoute = delRoute.replace('ID', invoiceID);

      $.ajax({
        type: 'DELETE',
        url: newdelRoute,
        data: {
          _token: '{{ csrf_token() }}'
        },
        success: function (response) {
          if (response.status) {
            $('#invoiceDeleteModal').hide();
            console.log(response.status);
            location.reload();
          }
        },
        error: function (response) {
          $('#invoiceDeleteModal').hide();
          location.reload();
          Swal.fire({
            icon: 'error',
            title: 'Error',
            text: response.responseJSON.error,
          });
        }
      });
    });
  });
</script>
@endsection