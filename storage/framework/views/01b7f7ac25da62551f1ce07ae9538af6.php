<?php $__env->startSection('title'); ?>
Edit Project
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
        <h4 class="card-title mb-0">Edit Project</h4>
      </div>
      <div class="card-body p-4">
        <form action="<?php echo e(route('project.update' ,$project->id)); ?>" method="post" id="expense-create-form" name="expense-create-form"
          enctype="multipart/form-data">
          <?php echo csrf_field(); ?>
          <div class="row">
          <div class="col-md-6">
                <div class="mb-3">
                    <label for="name">Name <span class="text-danger">*</span></label>
                    <input type="text" placeholder="Name" value="<?php echo e($project->name); ?>" class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="name" id="name">
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
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="client">Client <span class="text-danger">*</span></label>
                    <select class="form-control <?php $__errorArgs = ['client'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" aria-placeholder="Client" id="client" name="client">
                        <?php $__currentLoopData = $clients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option <?php echo e($project->client_id == $client->id ? 'selected' : ''); ?> value="<?php echo e($client->id); ?>"><?php echo e($client->first_name); ?> <?php echo e($client->last_name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <?php $__errorArgs = ['client'];
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
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="description">Description</label>
                    <textarea rows="4" class="form-control <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="description" id="description" placeholder="Description">
                        <?php echo e($project->description); ?>

                    </textarea> 
                    <?php $__errorArgs = ['description'];
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
            <div class="col-lg-12">
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
<script>
  $(document).ready(function () {
    $('#client').select2();
   });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\master\resources\views/project/edit.blade.php ENDPATH**/ ?>