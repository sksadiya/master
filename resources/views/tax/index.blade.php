@extends('layouts.master')

@section('title')
Taxes
@endsection

@section('css')
<link href="{{ URL::asset('build/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title mb-0">Taxes</h4>
      </div>

      <div class="card-body">
        <div class="listjs-table" id="taxesList">
          <div class="row g-4 mb-3">
            <div class="col-sm-auto">
              <div>
                @can('Add Taxes')
                <button type="button" class="btn btn-primary add-btn" data-bs-toggle="modal" id="create-btn"
                  data-bs-target="#addTaxModal"><i class="fas fa-plus-circle me-2"></i> Add Tax</button>
                  @endcan
              </div>
            </div>
          </div>

          <div class="table-responsive table-card mt-3 mb-1">
            <table class="table align-middle table-nowrap" id="taxTable">
              <thead class="table-light">
                <tr>
                  <th>Tax Name</th>
                  <th>Tax Percentage</th>
                  <th>Default</th>
                  @if(Auth::user()->can('Edit Taxes') || Auth::user()->can('Delete Taxes'))
                  <th>Action</th>
                  @endif
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
@can('Add Taxes')
<!-- Add Tax Modal -->
<div class="modal fade" id="addTaxModal" tabindex="-1" aria-labelledby="addTaxModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-light p-3">
        <h5 class="modal-title" id="addTaxModalLabel">Add Taxes</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
          id="close-add-modal"></button>
      </div>
      <form id="addTaxForm" name="addTaxForm" method="post">
        @csrf
        <div class="modal-body">
          <div class="mb-3">
            <label for="addTaxname" class="form-label">Tax Name</label>
            <input type="text" id="name" name="name" class="form-control" placeholder="Enter Tax Name" />
            <div class="invalid-feedback"></div>
          </div>
          <div class="mb-3">
            <label for="addTaxvalue" class="form-label">Tax Percentage</label>
            <div class="input-group">
              <input type="text" class="form-control" id="value" name="value" placeholder="Enter Tax Percentage"
                aria-describedby="basic-addon2">
              <span class="input-group-text" id="basic-addon2">%</span>
              <div class="invalid-feedback"></div>
            </div>

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
@can('Edit Taxes')
<!-- Edit Tax Modal -->
<div class="modal fade" id="editTaxModal" tabindex="-1" aria-labelledby="editTaxModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-light p-3">
        <h5 class="modal-title" id="editTaxModalLabel">Edit Tax</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
          id="close-edit-modal"></button>
      </div>
      <form id="editTaxForm" name="editTaxForm">
        @csrf
        @method('PUT')
        <input type="hidden" id="editTaxId" name="id">
        <div class="modal-body">
          <div class="mb-3">
            <label for="editTaxName" class="form-label">Tax Name</label>
            <input type="text" id="editTaxName" name="name" class="form-control" placeholder="Enter Tax Name"
              required />
            <div class="invalid-feedback"></div>
          </div>
          <div class="mb-3">
            <label for="editTaxValue" class="form-label">Tax Percentage</label>
            <div class="input-group">
              <input type="text" class="form-control" id="editTaxValue" name="value" placeholder="Enter Tax Percentage"
                aria-describedby="basic-addon2">
              <span class="input-group-text" id="basic-addon2">%</span>
              <div class="invalid-feedback"></div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <div class="hstack gap-2 justify-content-end">
            <button type="button" class="btn btn-light" id="close-edit-modal" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" id="edit-btn">Save Changes</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
@endcan
@can('Delete Taxes')
<!-- Delete Confirmation Modal -->
<div class="modal fade zoomIn" id="deleteTaxModal" tabindex="-1" aria-hidden="true">
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
            <p class="text-muted mx-4 mb-0">Are you sure you want to remove this Tax?</p>
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
@endcan
@endsection

@section('script')
<script src="{{ URL::asset('build/libs/prismjs/prism.js') }}"></script>
<script src="{{ URL::asset('build/libs/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ URL::asset('build/js/app.js') }}"></script>
<script>
  $(document).ready(function () {

    window.setDefault = function (taxId) {
      const checkbox = document.querySelector(`.default-toggle-input[onclick="setDefault(${taxId})"]`);
      const isChecked = checkbox.checked ? 1 : 0;
      const route = "{{ route('setDefault', 'ID') }}";
      const newRoute = route.replace("ID", taxId);

      $.ajax({
        url: newRoute,
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        data: {
          is_default: isChecked
        },
        success: function (response) {
          if (response.success) {
            Swal.fire({
              icon: 'success',
              title: 'Success',
              text: 'Default tax updated successfully.'
            }).then(function () {
              location.reload();
            });
          } else {
            Swal.fire({
              icon: 'error',
              title: 'Error',
              text: 'An error occurred while updating the default tax.'
            });
          }
        },
        error: function (xhr) {
          Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'An error occurred while updating the default tax.'
          });
        }
      });
    }
    $('#taxTable').DataTable({
    processing: true,
    serverSide: true,
    ajax: {
        url: '{{ route('taxes.data') }}',
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
        { data: 'name', name: 'name' },
        { data: 'value', name: 'value' },
        { data: 'default', name: 'default' },
        { data: 'action', name: 'action', orderable: false, searchable: false }
    ],
    order: [[0, 'asc'], [1, 'desc']], // Example of default multi-column ordering
    pageLength: 10
});
    $('#addTaxForm').on('submit', function (e) {
      e.preventDefault();

      $.ajax({
        type: 'POST',
        url: '{{ route("tax.add") }}',
        data: $(this).serialize(),
        success: function (response) {
          if (response.status) {
            $('#addTaxModal').hide();
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

    $('#addTaxModal').on('hidden.bs.modal', function () {
      $('#addTaxForm')[0].reset();
      $('.form-control').removeClass('is-invalid');
      $('.invalid-feedback').text('');
    });

    // Handle modal close button click to reset the form
    $('#close-add-modal, .btn-light').on('click', function () {
      $('#addTaxForm')[0].reset();
      $('.form-control').removeClass('is-invalid');
      $('.invalid-feedback').text('');
    });
    $('#taxTable').on('click','.edit-item-btn', function () {
      var taxId = $(this).data('id');
      var taxName = $(this).data('name');
      var taxValue = $(this).data('value');

      // Populate the edit modal with the category data
      $('#editTaxId').val(taxId);
      $('#editTaxName').val(taxName);
      $('#editTaxValue').val(taxValue);

      // Show the edit modal
      $('#editTaxModal').modal('show');
    });
    $('#editTaxForm').on('submit', function (e) {
      e.preventDefault();

      var taxId = $('#editTaxId').val();
      const TaxRoute = "{{ route('tax.update', 'ID') }}";
      const newTaxRoute = TaxRoute.replace("ID", taxId)
      $.ajax({
        type: 'PUT',
        url: newTaxRoute,  // Adjust this URL to match your route
        data: $(this).serialize(),
        success: function (response) {
          if (response.status) {
            $('#editTaxModal').hide();
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
              if (key == 'name') {
                $('#editTaxName').addClass('is-invalid');
                $('#editTaxName').siblings('.invalid-feedback').text(value[0]);
              }
              if (key == 'value') {
                $('#editTaxValue').addClass('is-invalid');
                $('#editTaxValue').siblings('.invalid-feedback').text(value[0]);
              }
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

    // Reset edit form when the modal is hidden
    $('#editTaxModal').on('hidden.bs.modal', function () {
      $('#editTaxForm')[0].reset();
      $('.form-control').removeClass('is-invalid');
      $('.invalid-feedback').text('');
    });

    // Handle modal close button click to reset the edit form
    $('#close-edit-modal, .btn-light').on('click', function () {
      $('#editTaxForm')[0].reset();
      $('.form-control').removeClass('is-invalid');
      $('.invalid-feedback').text('');
    });

    $('#taxTable').on('click', '.remove-item-btn',function () {
      var taxId = $(this).data('id');
      $('#delete-record').data('id', taxId);
      $('#deleteTaxModal').modal('show');
    });

    $('#delete-record').on('click', function () {
      var taxId = $(this).data('id');
      console.log(taxId);
      const delRoute = "{{ route('tax.delete', 'ID') }}";
      const newdelRoute = delRoute.replace('ID', taxId);

      $.ajax({
        type: 'DELETE',
        url: newdelRoute,
        data: {
          _token: '{{ csrf_token() }}'
        },
        success: function (response) {
          if (response.status) {
            $('#deleteTaxModal').hide();
            Swal.fire({
              icon: 'success',
              title: 'Deleted!',
              text: response.message,
            }).then(function () {
              location.reload();
            });
          }
        },
        error: function (response) {
          $('#deleteTaxModal').hide();
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