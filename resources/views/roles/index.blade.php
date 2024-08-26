@extends('layouts.master')

@section('title')
Roles
@endsection

@section('css')
<link href="{{ URL::asset('build/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title mb-0">Roles</h4>
      </div>

      <div class="card-body">
        <div class="listjs-table" id="rolesList">
          <div class="row g-4 mb-3">
            <div class="col-sm-auto">
              @can('Add Roles')
              <div>
                <a href="{{ route('role.add') }}" type="button" class="btn btn-primary add-btn"><i class="fas fa-plus-circle me-2"></i> Add Role</a>
              </div>
              @endcan
            </div>
          </div>

          <div class="table-responsive table-card mt-3 mb-1">
            <table class="table align-middle table-nowrap" id="roleTable">
              <thead class="table-light">
                <tr>
                  <th>Role Name</th>
                  @if(Auth::user()->can('Edit Roles') || Auth::user()->can('Delete Roles'))
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
@can('Delete Roles')
<!-- Delete Confirmation Modal -->
<div class="modal fade zoomIn" id="roleDeleteModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="btn-close"></button>
      </div>
      <div class="modal-body">
        <div class="mt-2 text-center">
          <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop" colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon>
          <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
            <h4>Are you sure?</h4>
            <p class="text-muted mx-4 mb-0">Are you sure you want to remove this role?</p>
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
<script src="{{ URL::asset('build/libs/list.js/list.min.js') }}"></script>
<script src="{{ URL::asset('build/libs/list.pagination.js/list.pagination.min.js') }}"></script>
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

  $(document).ready(function() {
    $('#roleTable').DataTable({
    processing: true,
    serverSide: true,
    ajax: {
        url: '{{ route('roles.data') }}',
        type: 'GET',
        
    },
    columns: [
        { data: 'name', name: 'name' },
        { data: 'action', name: 'action', orderable: false, searchable: false }
    ],
    order: [[0, 'asc'], [1, 'desc']], // Example of default multi-column ordering
    pageLength: 10
});

    $('#roleTable').on('click', '.remove-item-btn',function () {
        var roleId = $(this).data('id');
        $('#delete-record').data('id', roleId);
    });

    $('#delete-record').on('click', function () {
        var roleId = $(this).data('id');
        const delRoute = "{{ route('role.delete', ':id') }}";
        const newdelRoute = delRoute.replace(':id', roleId);

        $.ajax({
            type: 'DELETE',
            url: newdelRoute,
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function (response) {
                if (response.status) {
                    $('#roleDeleteModal').modal('hide');
                    location.reload();
                }
            },
            error: function (response) {
                $('#roleDeleteModal').modal('hide');
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
