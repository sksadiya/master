@extends('layouts.master')

@section('title')
Expense Categories
@endsection


@section('css')
<link href="{{ URL::asset('build/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title mb-0">Expense Categories</h4>
      </div>

      <div class="card-body">
        <div class="listjs-table" id="expenseCategoriesList">
          <div class="row g-4 mb-3">
            <div class="col-sm-auto">
              <div>
                <button type="button" class="btn btn-primary add-btn" data-bs-toggle="modal" id="create-btn"
                  data-bs-target="#addExpenseCategorModal"><i class="fas fa-plus-circle me-2"></i> Add Expense Category</button>
              </div>
            </div>
          </div>

          <div class="table-responsive table-card mt-3 mb-1">
            <table class="table align-middle table-nowrap display" id="expenseCategoriesTable">
              <thead class="table-light">
                <tr>
                  <th>Expense Category</th>
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

<!-- Add Category Modal -->
<div class="modal fade" id="addExpenseCategorModal" tabindex="-1" aria-labelledby="addExpenseCategorModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-light p-3">
        <h5 class="modal-title" id="addExpenseCategorModalLabel">Add Expense Category</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
          id="close-add-modal"></button>
      </div>
      <form id="addExpenseCategory" name="addExpenseCategory" method="post">
        @csrf
        <div class="modal-body">
          <div class="mb-3">
            <label for="addCatName" class="form-label">Expense Category Name</label>
            <input type="text" id="name" name="name" class="form-control" placeholder="Enter Category Name"  />
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

<!-- Edit Category Modal -->
<div class="modal fade" id="editExpenseCategoryModal" tabindex="-1" aria-labelledby="editExpenseCategoryModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-light p-3">
        <h5 class="modal-title" id="editExpenseCategoryModalLabel">Edit Expense Category</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
          id="close-edit-modal"></button>
      </div>
      <form id="editExpenseCategoryForm" name="editExpenseCategoryForm">
        @csrf
        @method('PUT')
        <input type="hidden" id="editCatId" name="id">
        <div class="modal-body">
          <div class="mb-3">
            <label for="editExpenseCat" class="form-label">Expense Category Name</label>
            <input type="text" id="editExpenseCat" name="name" class="form-control" placeholder="Enter Category Name" required />
            <div class="invalid-feedback">Please enter a category name.</div>
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

<!-- Delete Confirmation Modal -->
<div class="modal fade zoomIn" id="deleteRecordModal" tabindex="-1" aria-hidden="true">
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
            <p class="text-muted mx-4 mb-0">Are you sure you want to remove this category?</p>
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

@endsection

@section('script')
<script src="{{ URL::asset('build/libs/prismjs/prism.js') }}"></script>
<script src="{{ URL::asset('build/libs/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ URL::asset('build/js/app.js') }}"></script>
<script>
  $(document).ready(function () {
    $('#expenseCategoriesTable').DataTable({
    processing: true,
    serverSide: true,
    ajax: {
        url: '{{ route('expenseCategories.data') }}',
        type: 'GET',
    },
    columns: [
        { data: 'name', name: 'name' },
        { data: 'action', name: 'action', orderable: false, searchable: false }
    ],
    order: [[0, 'asc'], [1, 'desc']], // Example of default multi-column ordering
    pageLength: 10
});
   
    $('#addExpenseCategory').on('submit', function (e) {
      e.preventDefault();

      $.ajax({
        type: 'POST',
        url: '{{ route("expenseCategory.add") }}',
        data: $(this).serialize(),
        success: function (response) {
          if (response.status) {
            $('#addExpenseCategorModal').hide();
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
              $('#' + key).next('.invalid-feedback').text(value[0]);
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

    $('#addExpenseCategorModal').on('hidden.bs.modal', function () {
      $('#addExpenseCategory')[0].reset();
      $('.form-control').removeClass('is-invalid');
      $('.invalid-feedback').text('');
    });

    // Handle modal close button click to reset the form
    $('#close-add-modal, .btn-light').on('click', function () {
      $('#addExpenseCategory')[0].reset();
      $('.form-control').removeClass('is-invalid');
      $('.invalid-feedback').text('');
    });
    $('#expenseCategoriesTable').on('click','.edit-item-btn', function () {
      var categoryId = $(this).data('id');
      var categoryName = $(this).data('name');

      // Populate the edit modal with the category data
      $('#editCatId').val(categoryId);
      $('#editExpenseCat').val(categoryName);

      // Show the edit modal
      $('#editExpenseCategoryModal').modal('show');
    });
    $('#editExpenseCategoryForm').on('submit', function (e) {
      e.preventDefault();

      var categoryId = $('#editCatId').val();
      const catRoute = "{{ route('expenseCategory.update', 'ID') }}";
      const newcatRoute = catRoute.replace("ID", categoryId)
      $.ajax({
        type: 'PUT',
        url: newcatRoute,  // Adjust this URL to match your route
        data: $(this).serialize(),
        success: function (response) {
          if (response.status) {
            $('#editExpenseCategoryModal').hide();
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
              $('#editExpenseCat').addClass('is-invalid');
              $('#editExpenseCat').next('.invalid-feedback').text(value[0]);
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
    $('#editExpenseCategoryModal').on('hidden.bs.modal', function () {
      $('#editExpenseCategoryForm')[0].reset();
      $('.form-control').removeClass('is-invalid');
      $('.invalid-feedback').text('');
    });

    // Handle modal close button click to reset the edit form
    $('#close-edit-modal, .btn-light').on('click', function () {
      $('#editExpenseCategoryForm')[0].reset();
      $('.form-control').removeClass('is-invalid');
      $('.invalid-feedback').text('');
    });

    $('#expenseCategoriesTable').on('click', '.remove-item-btn',function () {
      var categoryId = $(this).data('id');
      $('#delete-record').data('id', categoryId);
      $('#deleteRecordModal').modal('show');
    });

    $('#delete-record').on('click', function () {
      var categoryId = $(this).data('id');
      const delRoute = "{{ route('expenseCategory.delete', 'ID') }}";
      const newdelRoute = delRoute.replace('ID', categoryId);

      $.ajax({
        type: 'DELETE',
        url: newdelRoute,
        data: {
          _token: '{{ csrf_token() }}'
        },
        success: function (response) {
          if (response.status) {
            $('#deleteRecordModal').hide();
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
          $('#deleteRecordModal').hide();
          Swal.fire({
            icon: 'error',
            title: 'Error',
            text: response.responseJSON.message,
          });
        }
      });
    });
  });
</script>
@endsection