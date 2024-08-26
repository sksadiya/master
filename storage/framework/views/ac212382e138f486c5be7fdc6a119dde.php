

<?php $__env->startSection('title'); ?>
products
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
<link href="<?php echo e(URL::asset('build/libs/sweetalert2/sweetalert2.min.css')); ?>" rel="stylesheet" type="text/css" />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title mb-0">Products</h4>
      </div>

      <div class="card-body">
        <div class="listjs-table" id="productsList">
          <div class="row g-4 mb-3">
            <div class="col-sm-auto">
              <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Add Products')): ?>
              <div>
                <a href="<?php echo e(route('product.add')); ?>" type="button" class="btn btn-primary add-btn" ><i class="fas fa-plus-circle me-2"></i> Add Product</a>
              </div>
              <?php endif; ?>
            </div>
          </div>

          <div class="table-responsive table-card mt-3 mb-1">
            <table class="table align-middle table-nowrap" id="productTable">
              <thead class="table-light">
                <tr>
                  <th>product Name</th>
                  <th>Product Category</th>
                  <th>Price</th>
                  <?php if(Auth::user()->can('Edit Products') || Auth::user()->can('Delete Products')): ?>
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
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Delete Products')): ?>
<!-- Delete Confirmation Modal -->
<div class="modal fade zoomIn" id="productDeleteModal" tabindex="-1" aria-hidden="true">
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
            <p class="text-muted mx-4 mb-0">Are you sure you want to remove this product?</p>
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
<script src="<?php echo e(URL::asset('build/libs/list.js/list.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('build/libs/list.pagination.js/list.pagination.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('build/libs/sweetalert2/sweetalert2.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('build/js/app.js')); ?>"></script>
<script>
   <?php if(Session::has('success')): ?>
    Swal.fire({
      title: 'Success!',
      text: '<?php echo e(Session::get('success')); ?>',
      icon: 'success',
      showCancelButton: false,
      customClass: {
      confirmButton: 'btn btn-primary w-xs me-2 mt-2',
      },
      buttonsStyling: false,
      showCloseButton: true
    });
  <?php endif; ?>

    <?php if(Session::has('error')): ?>
    Swal.fire({
      title: 'Error!',
      text: "<?php echo e(Session::get('error')); ?>",
      icon: 'error',
      showCancelButton: false,
      customClass: {
      confirmButton: 'btn btn-danger w-xs mt-2',
      },
      buttonsStyling: false,
      showCloseButton: true
    });
  <?php endif; ?>

  
  $(document).ready(function() {
    $('#productTable').DataTable({
    processing: true,
    serverSide: true,
    ajax: {
        url: '<?php echo e(route('products.data')); ?>',
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
        { data: 'category', name: 'category' },
        { data: 'price', name: 'unit_price' },
        { data: 'action', name: 'action', orderable: false, searchable: false }
    ],
    order: [[0, 'asc'], [1, 'desc']], // Example of default multi-column ordering
    pageLength: 10
});
    $('#productTable').on('click', '.remove-item-btn' ,function () {
      var productId = $(this).data('id');
      $('#delete-record').data('id', productId);
    });

    $('#delete-record').on('click', function () {
      var productId = $(this).data('id');
      console.log(productId);
      const delRoute = "<?php echo e(route('product.delete', 'ID')); ?>";
      const newdelRoute = delRoute.replace('ID', productId);

      $.ajax({
        type: 'DELETE',
        url: newdelRoute,
        data: {
          _token: '<?php echo e(csrf_token()); ?>'
        },
        success: function (response) {
          if (response.status) {
            $('#productDeleteModal').hide();
            
            console.log(response.status);
            location.reload();
          }
        },
        error: function (response) {
          $('#productDeleteModal').hide();
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\master\resources\views/product/index.blade.php ENDPATH**/ ?>