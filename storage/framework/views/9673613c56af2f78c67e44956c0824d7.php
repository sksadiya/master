
<?php $__env->startSection('title'); ?>
Add Client
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
        <h4 class="card-title mb-0">Add Client</h4>
      </div>
      <div class="card-body p-4">
        <form action="<?php echo e(route('client.store')); ?>" method="post" id="client-create-form" name="client-create-form"
          enctype="multipart/form-data">
          <?php echo csrf_field(); ?>
          <div class="row">
            <div class="col-md-6">
              <div class="mb-3">
                <label for="first_name" class="form-label">First Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control <?php $__errorArgs = ['first_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="first_name"
                  placeholder="First name" name="first_name">
                <?php if($errors->has('first_name')): ?>
                  <div class="invalid-feedback">
                    <?php echo e($errors->first('first_name')); ?>

                  </div>
                <?php endif; ?>
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label for="last_name" class="form-label">Last Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control <?php $__errorArgs = ['last_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="last_name"
                  placeholder="Last name" name="last_name">
                <?php if($errors->has('last_name')): ?>
                  <div class="invalid-feedback">
                    <?php echo e($errors->first('last_name')); ?>

                  </div>
                <?php endif; ?>
              </div>
            </div>
           
            <div class="col-md-6">
              <div class="mb-3">
                <label for="business" class="form-label">Business<span class="text-danger">*</span></label>
                <input type="text" class="form-control <?php $__errorArgs = ['business'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="business"
                  placeholder="Business Name"  name="business">
                        <?php if($errors->has('business')): ?>
                  <div class="invalid-feedback">
                    <?php echo e($errors->first('business')); ?>

                  </div>
                <?php endif; ?>
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label for="contact" class="form-label">Contact <span class="text-danger">*</span></label>
                <input type="tel" class="form-control <?php $__errorArgs = ['contact'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="contact"
                  placeholder="contact" name="contact">
                        <?php if($errors->has('contact')): ?>
                  <div class="invalid-feedback">
                    <?php echo e($errors->first('contact')); ?>

                  </div>
                <?php endif; ?>
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label for="alter_contact" class="form-label">Alternate Phone no.</label>
                <input type="text" class="form-control <?php $__errorArgs = ['alter_contact'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="alter_contact"
                  placeholder="Phone no." name="alter_contact">
                <?php if($errors->has('alter_contact')): ?>
                  <div class="invalid-feedback">
                    <?php echo e($errors->first('alter_contact')); ?>

                  </div>
                <?php endif; ?>
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="email"
                  placeholder="email Name"  name="email">
                        <?php if($errors->has('email')): ?>
                  <div class="invalid-feedback">
                    <?php echo e($errors->first('email')); ?>

                  </div>
                <?php endif; ?>
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label for="website" class="form-label">website</label>
                <input type="text" class="form-control <?php $__errorArgs = ['website'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="website"
                  placeholder="Website" name="website">
                <?php if($errors->has('website')): ?>
                  <div class="invalid-feedback">
                    <?php echo e($errors->first('website')); ?>

                  </div>
                <?php endif; ?>
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label for="service_categories" class="form-label">Service Categories</label>
                <select class="form-control select2" id="service_categories" name="service_categories[]" multiple="multiple">
                  <?php $__currentLoopData = $serviceCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="mb-3">
                <label for="country" class="form-label">Country</label>
                <div class="mb-3">
                  <select class="form-control" name="country" id="country-name">
                    <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <option value="<?php echo e($country->id); ?>"><?php echo e($country->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </select>
                </div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="mb-3">
                <label for="state-code" class="form-label">State</label>
                <div class="mb-3">
                  <select class="form-control" name="state" id="state-code">
                  </select>
                </div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="mb-3">
                <label for="city" class="form-label">City</label>
                <div class="mb-3">
                  <select class="form-control" name="city" id="city">
                  </select>
                </div>
              </div>
            </div>

            <div class="col-md-6">
              <div class="mb-3">
                <label for="postal_code" class="form-label">Postal Code</label>
                <input type="text" class="form-control <?php $__errorArgs = ['postal_code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="postal_code"
                  placeholder="Zip Code"  name="postal_code">
                <?php if($errors->has('postal_code')): ?>
                  <div class="invalid-feedback">
                    <?php echo e($errors->first('postal_code')); ?>

                  </div>
                <?php endif; ?>
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label for="GST" class="form-label">GST NO</label>
                <input type="text" class="form-control <?php $__errorArgs = ['GST'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="GST"
                  placeholder="GSTIN" name="GST">
                <?php if($errors->has('GST')): ?>
                  <div class="invalid-feedback">
                    <?php echo e($errors->first('GST')); ?>

                  </div>
                <?php endif; ?>
              </div>
            </div>

            <div class="col-md-6">
              <div class="mb-3">
                <label for="Address" class="form-label">Address</label>
                <textarea class="form-control <?php $__errorArgs = ['Address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" cols="5" rows="5" id="Address"
                  placeholder="Address" name="Address"></textarea>
                <?php if($errors->has('Address')): ?>
                <div class="invalid-feedback">
                  <?php echo e($errors->first('Address')); ?>

                </div>
              <?php endif; ?>
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                  <label for="notes" class="form-label">Notes</label>
                  <textarea class="form-control <?php $__errorArgs = ['notes'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" cols="5" rows="5" id="notes"
                      placeholder="Add Notes Here" name="notes"></textarea>
                  <?php $__errorArgs = ['notes'];
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

    $('#state-code').select2();
    $('#city').select2();
    $('#country-name').select2();
    $('#service_categories').select2();

    $('#country-name').change(function () {
            var countryId = $(this).val();
            console.log('Selected Country ID:', countryId); // Debugging statement
            $('#state-code').empty().append('<option value="">Select State</option>');
            $('#city').empty().append('<option value="">Select City</option>');

            if (countryId) {
                $.ajax({
                    url: '<?php echo e(route('fetch.states', ':id')); ?>'.replace(':id', countryId),
                    type: 'GET',
                    success: function (data) {
                        console.log('States Data:', data); // Debugging statement
                        $('#state-code').empty().append('<option value="">Select State</option>');
                        $.each(data.states, function (key, state) {
                            $('#state-code').append('<option value="' + key + '">' + state + '</option>');
                        });
                    },
                    error: function (xhr) {
                        console.error('AJAX Error:', xhr.responseText); // Debugging statement
                    }
                });
            }
        });

        $('#state-code').change(function () {
            var stateId = $(this).val();
            console.log('Selected State ID:', stateId); // Debugging statement
            $('#city').empty().append('<option value="">Select City</option>');

            if (stateId) {
                $.ajax({
                    url: '<?php echo e(route('fetch.cities', ':id')); ?>'.replace(':id', stateId),
                    type: 'GET',
                    success: function (data) {
                        console.log('Cities Data:', data); // Debugging statement
                        $('#city').empty().append('<option value="">Select City</option>');
                        $.each(data.cities, function (key, city) {
                            $('#city').append('<option value="' + key + '">' + city + '</option>');
                        });
                    },
                    error: function (xhr) {
                        console.error('AJAX Error:', xhr.responseText); // Debugging statement
                    }
                });
            }
        });
  });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\master\resources\views/client/create.blade.php ENDPATH**/ ?>