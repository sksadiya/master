<?php $__env->startSection('title'); ?>
Roles
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
<link href="<?php echo e(URL::asset('build/libs/sweetalert2/sweetalert2.min.css')); ?>" rel="stylesheet" type="text/css" />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
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
              <div>
                <a href="<?php echo e(route('role.add')); ?>" type="button" class="btn btn-primary add-btn"><i class="bx bx-plus-circle me-2"></i> Add Role</a>
              </div>
            </div>
            <div class="col-sm">
              <form method="GET" action="<?php echo e(route('roles')); ?>" id="searchForm">
                <div class="d-flex justify-content-sm-end">
                  <div class="search-box ms-2 me-2">
                    <input type="text" class="form-control search" name="search" id="searchInput" value="<?php echo e(request()->get('search')); ?>" placeholder="Search...">
                    <i class="ri-search-line search-icon"></i>
                  </div>
                  <a href="<?php echo e(route('roles')); ?>" type="button" class="btn bg-primary text-light">Reset</a>
                </div>
              </form>
            </div>
          </div>

          <div class="table-responsive table-card mt-3 mb-1">
            <table class="table align-middle table-nowrap" id="roleTable">
              <thead class="table-light">
                <tr>
                  <th class="sort" data-sort="role-name">Role Name</th>
                  <th class="sort" data-sort="action">Action</th>
                </tr>
              </thead>
              <tbody class="list form-check-all">
                <?php if($roles): ?>
                  <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                      <td class="role-name"><?php echo e($role->name); ?></td>
                      <td class="">
                        <div class="justify-content-end d-flex gap-2">
                          <div class="edit">
                            <a href="<?php echo e(route('role.edit',$role->id)); ?>" class="btn btn-sm btn-success edit-item-btn"><i class="bx bxs-pencil"></i> Edit</a>
                          </div>
                          <div class="remove">
                            <button type="button" class="btn btn-sm btn-danger remove-item-btn" data-bs-toggle="modal" data-bs-target="#roleDeleteModal" data-id="<?php echo e($role->id); ?>"><i class="bx bx-trash"></i> Delete</button>
                          </div>
                        </div>
                      </td>
                    </tr>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                  <tr>
                    <td colspan="2" class="text-center">Result Not Found</td>
                  </tr>
                <?php endif; ?>
              </tbody>
            </table>
          </div>
          <div class="row">
            <div class="col-md-6 justify-content-start">
              <div class="pagination-wrap hstack gap-2">
                <?php echo e($roles->links()); ?>

              </div>
            </div>
            <div class="col-md-6 justify-content-end d-flex">
              <div class="dropdown">
                <button class="btn bg-primary btn-secondary dropdown-toggle" type="button" id="perPageDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                  Per Page
                </button>
                <ul class="dropdown-menu" aria-labelledby="perPageDropdown">
                  <li><a class="dropdown-item role-per-page-item" href="#" data-per-page="20">20</a></li>
                  <li><a class="dropdown-item role-per-page-item" href="#" data-per-page="30">30</a></li>
                  <li><a class="dropdown-item role-per-page-item" href="#" data-per-page="50">50</a></li>
                  <li><a class="dropdown-item role-per-page-item" href="#" data-per-page="100">100</a></li>
                </ul>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>

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
    $('.dropdown-item.role-per-page-item').on('click', function (e) {
      e.preventDefault();
      var perPage = $(this).data('per-page');
      var url = '<?php echo e($roles->url($roles->currentPage())); ?>' + '&perPage=' + perPage;
      window.location.href = url;
    });

    var rolesList = new List('rolesList', {
      valueNames: ['role-name','action'],
    });

    $('.remove-item-btn').on('click', function () {
        var roleId = $(this).data('id');
        $('#delete-record').data('id', roleId);
    });

    $('#delete-record').on('click', function () {
        var roleId = $(this).data('id');
        const delRoute = "<?php echo e(route('role.delete', ':id')); ?>";
        const newdelRoute = delRoute.replace(':id', roleId);

        $.ajax({
            type: 'DELETE',
            url: newdelRoute,
            data: {
                _token: '<?php echo e(csrf_token()); ?>'
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\master\resources\views/roles/index.blade.php ENDPATH**/ ?>