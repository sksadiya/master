

<?php $__env->startSection('title'); ?>
Categories
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
<link href="<?php echo e(URL::asset('build/libs/sweetalert2/sweetalert2.min.css')); ?>" rel="stylesheet" type="text/css" />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title mb-0">Product Categories</h4>
      </div>

      <div class="card-body">
        <div class="listjs-table" id="categoryList">
          <div class="row g-4 mb-3">
            <div class="col-sm-auto">
              <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Add Categories')): ?>
              <div>
                <button type="button" class="btn btn-primary add-btn" data-bs-toggle="modal" id="create-btn"
                  data-bs-target="#addCategoryModal"><i class="fas fa-plus-circle me-2"></i> Add Category</button>
              </div>
              <?php endif; ?>
            </div>
          </div>
          <div class="table-responsive table-card mt-3 mb-1">
            <table class="table align-middle table-nowrap display" id="categoryTable">
              <thead class="table-light">
                <tr>
                  <th>Category</th>
                  <th>Product</th>
                  <?php if(Auth::user()->can('Edit Categories') || Auth::user()->can('Delete Categories')): ?>
                  <th>Action</th>
                  <?php endif; ?>
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
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Add Categories')): ?>
<!-- Add Category Modal -->
<div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-light p-3">
        <h5 class="modal-title" id="addCategoryModalLabel">Add Category</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
          id="close-add-modal"></button>
      </div>
      <form id="addCategoryForm" name="addCategoryForm">
        <?php echo csrf_field(); ?>
        <div class="modal-body">
          <div class="mb-3">
            <label for="addCatName" class="form-label">Category Name</label>
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
<?php endif; ?>
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Edit Categories')): ?>
<!-- Edit Category Modal -->
<div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="editCategoryModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-light p-3">
        <h5 class="modal-title" id="editCategoryModalLabel">Edit Category</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
          id="close-edit-modal"></button>
      </div>
      <form id="editCategoryForm" name="editCategoryForm">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>
        <input type="hidden" id="editCatId" name="id">
        <div class="modal-body">
          <div class="mb-3">
            <label for="editCatName" class="form-label">Category Name</label>
            <input type="text" id="editCatName" name="name" class="form-control" placeholder="Enter Category Name" required />
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
<?php endif; ?>
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Delete Categories')): ?>
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
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script src="<?php echo e(URL::asset('build/libs/prismjs/prism.js')); ?>"></script>
<script src="<?php echo e(URL::asset('build/libs/sweetalert2/sweetalert2.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('build/js/app.js')); ?>"></script>
<script>
  $(document).ready(function () {

    $('#categoryTable').DataTable({
    processing: true,
    serverSide: true,
    ajax: {
        url: '<?php echo e(route('categories.data')); ?>',
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
        { data: 'products_count', name: 'products_count' },
        { data: 'action', name: 'action', orderable: false, searchable: false }
    ],
    order: [[0, 'asc'], [1, 'desc']], // Example of default multi-column ordering
    pageLength: 10
});
    $('#addCategoryForm').on('submit', function (e) {
      e.preventDefault();

      $.ajax({
        type: 'POST',
        url: '<?php echo e(route("category.add")); ?>',
        data: $(this).serialize(),
        success: function (response) {
          if (response.status) {
            $('#addCategoryModal').hide();
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

    $('#addCategoryModal').on('hidden.bs.modal', function () {
      $('#addCategoryForm')[0].reset();
      $('.form-control').removeClass('is-invalid');
      $('.invalid-feedback').text('');
    });

    // Handle modal close button click to reset the form
    $('#close-add-modal, .btn-light').on('click', function () {
      $('#addCategoryForm')[0].reset();
      $('.form-control').removeClass('is-invalid');
      $('.invalid-feedback').text('');
    });
    $('#categoryTable').on('click','.edit-item-btn', function () {
      var categoryId = $(this).data('id');
      var categoryName = $(this).data('name');

      // Populate the edit modal with the category data
      $('#editCatId').val(categoryId);
      $('#editCatName').val(categoryName);

      // Show the edit modal
      $('#editCategoryModal').modal('show');
    });
    $('#editCategoryForm').on('submit', function (e) {
      e.preventDefault();

      var categoryId = $('#editCatId').val();
      const catRoute = "<?php echo e(route('category.update', 'ID')); ?>";
      const newcatRoute = catRoute.replace("ID", categoryId)
      $.ajax({
        type: 'PUT',
        url: newcatRoute,  // Adjust this URL to match your route
        data: $(this).serialize(),
        success: function (response) {
          if (response.status) {
            $('#editCategoryModal').hide();
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
              $('#editCatName').addClass('is-invalid');
              $('#editCatName').next('.invalid-feedback').text(value[0]);
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
    $('#editCategoryModal').on('hidden.bs.modal', function () {
      $('#editCategoryForm')[0].reset();
      $('.form-control').removeClass('is-invalid');
      $('.invalid-feedback').text('');
    });

    // Handle modal close button click to reset the edit form
    $('#close-edit-modal, .btn-light').on('click', function () {
      $('#editCategoryForm')[0].reset();
      $('.form-control').removeClass('is-invalid');
      $('.invalid-feedback').text('');
    });

    $('#categoryTable').on('click', '.remove-item-btn',function () {
      var categoryId = $(this).data('id');
      $('#delete-record').data('id', categoryId);
      $('#deleteRecordModal').modal('show');
    });

    $('#delete-record').on('click', function () {
      var categoryId = $(this).data('id');
      const delRoute = "<?php echo e(route('category.delete', 'ID')); ?>";
      const newdelRoute = delRoute.replace('ID', categoryId);

      $.ajax({
        type: 'DELETE',
        url: newdelRoute,
        data: {
          _token: '<?php echo e(csrf_token()); ?>'
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\master\resources\views/category/index.blade.php ENDPATH**/ ?>