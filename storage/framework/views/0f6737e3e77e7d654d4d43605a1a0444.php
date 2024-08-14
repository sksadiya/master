<?php $__env->startSection('title'); ?>
Roles
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
<link href="<?php echo e(URL::asset('build/libs/sweetalert2/sweetalert2.min.css')); ?>" rel="stylesheet" type="text/css" />
<link href="<?php echo e(URL::asset('build/select2/css/select2.min.css')); ?>" rel="stylesheet" type="text/css" />
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-xxl-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Role Information</h4>
            </div>
            <div class="card-body p-4">
                <form action="<?php echo e(route('role.store')); ?>" method="post" id="role-create-form" name="role-create-form"
                    enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="row">
                        <div class="row mb-3">
                            <div class="form-group row">
                                <label class="col-md-3 col-from-label" for="name">Name</label>
                                <div class="col-md-9">
                                    <input type="text" placeholder="Name" id="name" name="name" class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                    <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="invalid-feedback">
                                        <?php echo e($message); ?>

                                    </div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>
                        </div>
                       
                        <div class="row mb-3">
                            <?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category => $categoryPermissions): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <ul class="list-group mb-4">
                                    <li class="list-group-item bg-light"><?php echo e(ucfirst($category)); ?></li>
                                    <li class="list-group-item">
                                        <div class="row">
                                            <?php $__currentLoopData = $categoryPermissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
                                                    <div class="card border">
                                                        <div class="card-body">
                                                            <div class="form-check form-switch form-switch-md">
                                                                <input class="form-check-input" type="checkbox" role="switch" 
                                                                    name="permissions[]" 
                                                                    value="<?php echo e($permission->id); ?>" 
                                                                    <?php echo e(old('permissions') && in_array($permission->id, old('permissions')) ? 'checked' : ''); ?>>
                                                                <label class="form-check-label"><?php echo e($permission->name); ?></label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                    </li>
                                </ul>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>

                        <div class="col-lg-12 mt-3">
                            <div class="hstack gap-2 justify-content-end">
                                <button type="submit" class="btn btn-primary">Save</button>
                                <button type="button" class="btn btn-soft-success">Cancel</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<!-- apexcharts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="<?php echo e(URL::asset('build/js/pages/profile-setting.init.js')); ?>"></script>
<script src="<?php echo e(URL::asset('build/libs/sweetalert2/sweetalert2.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('build/select2/js/select2.min.js')); ?>"></script>
<!-- Include jQuery -->
<!-- dashboard init -->
<script src="<?php echo e(URL::asset('build/js/app.js')); ?>"></script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\master\resources\views/roles/create.blade.php ENDPATH**/ ?>