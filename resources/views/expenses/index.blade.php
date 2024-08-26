@extends('layouts.master')

@section('title')
Expenses
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
        <h4 class="card-title mb-0">Expenses</h4>
      </div>

      <div class="card-body">
        <div class="listjs-table" id="expensesList">
          <div class="row g-4 mb-3">
            <div class="col-sm-auto">
              @can('Add Expenses')
              <div>
                <a href="{{ route('expense.add') }}" type="button" class="btn btn-primary add-btn"><i
                    class="fas fa-plus-circle me-2"></i> Add Expense</a>
              </div>
              @endcan
            </div>
          </div>

          <div class="table-responsive table-card mt-3 mb-1">
            <table class="table align-middle table-nowrap" id="expensesTable">
              <thead class="table-light">
                <tr>
                  <th>Title</th>
                  <th>Expense Date</th>
                  <th>Expense Category</th>
                  <th>Expense Amount</th>
                  <th>Team Member</th>
                  @if(Auth::user()->can('Edit Expenses') || Auth::user()->can('Delete Expenses'))
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


@can('Delete Expenses')
<!-- Delete Confirmation Modal -->
<div class="modal fade zoomIn" id="confirmationModal" tabindex="-1" aria-hidden="true">
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
            <p class="text-muted mx-4 mb-0">Are you sure you want to remove this expense?</p>
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
    $('#expensesTable').DataTable({
    processing: true,
    serverSide: true,
    ajax: {
        url: '{{ route('expenses.data') }}',
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
        { data: 'title', name: 'title' },
        { data: 'date', name: 'date' },
        { data: 'category', name: 'category' },
        { data: 'amount', name: 'amount' },
        { data: 'member', name: 'member' },
        { data: 'action', name: 'action', orderable: false, searchable: false }
    ],
    order: [[0, 'asc'], [1, 'desc']], // Example of default multi-column ordering
    pageLength: 10
});

    $('#expensesTable').on('click','.remove-item-btn' ,function () {
      var expenseId = $(this).data('id');
      $('#delete-record').data('id', expenseId);
    });

    $('#delete-record').on('click', function () {
      var expenseId = $(this).data('id');
      console.log(expenseId);
      const delRoute = "{{ route('expense.delete', 'ID')}}";
      const newdelRoute = delRoute.replace('ID', expenseId);

      $.ajax({
        type: 'DELETE',
        url: newdelRoute,
        data: {
          _token: '{{ csrf_token() }}'
        },
        success: function (response) {
          if (response.status) {
            $('#confirmationModal').hide();
            console.log(response.status);
            location.reload();
          }
        },
        error: function (response) {
          $('#confirmationModal').hide();
          location.reload();
        }
      });
    });
  });
</script>
@endsection