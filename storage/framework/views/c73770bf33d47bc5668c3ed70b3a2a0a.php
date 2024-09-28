
<?php $__env->startSection('title'); ?>
App Settings
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
        <h4 class="card-title mb-0">App Settings</h4>
      </div>
      <div class="card-body p-4">
        <form action="<?php echo e(route('updateSettings')); ?>" method="post" id="app_settings-form" name="app_settings-form"
          enctype="multipart/form-data">
          <?php echo csrf_field(); ?>
          <div class="row">
            <div class="col-md-6">
              <div class="mb-3">
                <label for="app-name" class="form-label">App Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control <?php $__errorArgs = ['app-name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="app-name"
                  placeholder="app name" value="<?php echo e($settings['app-name']); ?>" name="app-name">
                <?php if($errors->has('app-name')): ?>
          <div class="invalid-feedback">
            <?php echo e($errors->first('app-name')); ?>

          </div>
        <?php endif; ?>
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label for="company-name" class="form-label">Company Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control <?php $__errorArgs = ['company-name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="company-name"
                  placeholder="company name" value="<?php echo e($settings['company-name']); ?>" name="company-name">
                <?php if($errors->has('company-name')): ?>
          <div class="invalid-feedback">
            <?php echo e($errors->first('company-name')); ?>

          </div>
        <?php endif; ?>
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label for="company-email" class="form-label">Company Email <span class="text-danger">*</span></label>
                <input type="email" class="form-control <?php $__errorArgs = ['company-email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="company-email"
                  placeholder="Company Email" value="<?php echo e($settings['company-email']); ?>" name="company-email">
                <?php if($errors->has('company-email')): ?>
          <div class="invalid-feedback">
            <?php echo e($errors->first('company-email')); ?>

          </div>
        <?php endif; ?>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="mb-3">
                <label for="country-code" class="form-label">Country Code <span class="text-danger">*</span></label>
                <div class="mb-3">
                  <select class="form-control" name="country-code" id="country-code">
                    <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option <?php echo e(($settings['country-code'] && $settings['country-code'] == $country->phone_code) ? 'selected' : ''); ?> value="<?php echo e($country->phone_code); ?>">+(<?php echo e($country->phone_code); ?>)
              <?php echo e($country->name); ?>

            </option>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </select>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label for="company-phone" class="form-label">Company Phone <span class="text-danger">*</span></label>
                <input type="tel" class="form-control <?php $__errorArgs = ['company-phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="company-phone"
                  placeholder="company phone" value="<?php echo e($settings['company-phone']); ?>" name="company-phone">
                <?php if($errors->has('company-phone')): ?>
          <div class="invalid-feedback">
            <?php echo e($errors->first('company-phone')); ?>

          </div>
        <?php endif; ?>
              </div>
            </div>

            <div class="col-lg-6">
              <div class="mb-3">
                <label for="country-name" class="form-label">Country</label>
                <div class="mb-3">
                  <select class="form-control <?php $__errorArgs = ['country-name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="country-name" id="country-name">
                    <option value="">Select Country</option>
                    <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($country->id); ?>" <?php echo e(($settings['country-name'] && $settings['country-name'] == $country->id) ? 'selected' : ''); ?>>
              <?php echo e($country->name); ?>

            </option>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </select>
                  <?php if($errors->has('country-name')): ?>
          <div class="invalid-feedback">
            <?php echo e($errors->first('country-name')); ?>

          </div>
        <?php endif; ?>
                </div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="mb-3">
                <label for="state-code" class="form-label">State</label>
                <div class="mb-3">
                  <select class="form-control <?php $__errorArgs = ['state-code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="state-code" id="state-code">
                    <?php $__currentLoopData = $states; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $state): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($state->id); ?>" <?php echo e(($settings['state-code'] && $settings['state-code'] == $state->id) ? 'selected' : ''); ?>>
              <?php echo e($state->name); ?>

            </option>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </select>
                  <?php if($errors->has('state-code')): ?>
          <div class="invalid-feedback">
            <?php echo e($errors->first('state-code')); ?>

          </div>
        <?php endif; ?>
                </div>
              </div>
            </div>

            <div class="col-lg-6">
              <div class="mb-3">
                <label for="city" class="form-label">City</label>
                <div class="mb-3">
                  <select class="form-control <?php $__errorArgs = ['city'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="city" id="city-code">
                  <?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($city->id); ?>" <?php echo e(($settings['city'] && $settings['city'] == $city->id) ? 'selected' : ''); ?>>
              <?php echo e($city->name); ?>

            </option>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </select>
                  <?php if($errors->has('city')): ?>
          <div class="invalid-feedback">
            <?php echo e($errors->first('city')); ?>

          </div>
        <?php endif; ?>
                </div>
              </div>
            </div>

            <div class="col-md-6">
              <div class="mb-3">
                <label for="zip-code" class="form-label">Zip Code</label>
                <input type="text" class="form-control <?php $__errorArgs = ['zip-code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="zip-code"
                  placeholder="Zip Code" value="<?php echo e($settings['zip-code']); ?>" name="zip-code">
                <?php if($errors->has('zip-code')): ?>
          <div class="invalid-feedback">
            <?php echo e($errors->first('zip-code')); ?>

          </div>
        <?php endif; ?>
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label for="GST-NO" class="form-label">GST NO</label>
                <input type="text" class="form-control <?php $__errorArgs = ['GST-NO'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="GST-NO"
                  placeholder="GSTIN" value="<?php echo e($settings['GST-NO']); ?>" name="GST-NO">
                <?php if($errors->has('GST-NO')): ?>
          <div class="invalid-feedback">
            <?php echo e($errors->first('GST-NO')); ?>

          </div>
        <?php endif; ?>
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label for="invoice-prefix" class="form-label">Invoice Prefix <span class="text-danger">*</span></label>
                <input type="text" class="form-control <?php $__errorArgs = ['invoice-prefix'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                  id="invoice-prefix" placeholder="Invoice prefix" value="<?php echo e($settings['invoice-prefix']); ?>"
                  name="invoice-prefix">
                <?php if($errors->has('invoice-prefix')): ?>
          <div class="invalid-feedback">
            <?php echo e($errors->first('invoice-prefix')); ?>

          </div>
        <?php endif; ?>
              </div>
            </div>

            <div class="col-md-6">
              <div class="mb-3">
                <label for="Address" class="form-label">Address <span class="text-danger">*</span></label>
                <textarea class="form-control <?php $__errorArgs = ['Address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" cols="5" rows="5" id="Address"
                  placeholder="Address" name="Address"><?php echo e($settings['Address']); ?> </textarea>
                <?php if($errors->has('Address')): ?>
          <div class="invalid-feedback">
            <?php echo e($errors->first('Address')); ?>

          </div>
        <?php endif; ?>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-3 col-md-6">
                <div class="d-flex flex-column align-items-center">
                  <div class="mb-2">
                    <span>App Logo <span class="text-danger">*</span></span>
                  </div>
                  <div class="profile-user position-relative d-inline-block mx-auto mb-4">
                    <img src="<?php echo e(URL::asset('public/images/uploads/' . $settings['app-logo'])); ?>"
                      class="rounded-circle avatar-xl img-thumbnail app-logo-image material-shadow"
                      alt="app-logo-image">
                    <div class="avatar-xs p-0 rounded-circle profile-photo-edit">
                      <input id="app-logo-input" type="file" name="app-logo" class="app-logo-input">
                      <label for="app-logo-input" class="profile-photo-edit avatar-xs">
                        <span class="avatar-title rounded-circle bg-light text-body material-shadow">
                          <i class="fas fa-camera"></i>
                        </span>
                      </label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-3 col-md-6">
                <div class="d-flex flex-column align-items-center">
                  <div class="mb-2">
                    <span>App Fevicon <span class="text-danger">*</span></span>
                  </div>
                  <div class="profile-user position-relative d-inline-block mx-auto mb-4">
                    <img src="<?php echo e(URL::asset('public/images/uploads/' . $settings['app-fevicon'])); ?>"
                      class="rounded-circle avatar-xl img-thumbnail app-fevicon-image material-shadow"
                      alt="app-fevicon-image">
                    <div class="avatar-xs p-0 rounded-circle profile-photo-edit">
                      <input id="app-fevicon-input" type="file" name="app-fevicon" class="app-fevicon-input">
                      <label for="app-fevicon-input" class="profile-photo-edit avatar-xs">
                        <span class="avatar-title rounded-circle bg-light text-body material-shadow">
                          <i class="fas fa-camera"></i>
                        </span>
                      </label>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6 d-none">
              <div class="mb-3">
                <label for="Copyright" class="form-label">Copyright</label>
                <input type="text" class="form-control <?php $__errorArgs = ['Copyright'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="Copyright"
                  placeholder="Copyright" value="<?php echo e($settings['Copyright']); ?>" name="Copyright">
                <?php if($errors->has('Copyright')): ?>
          <div class="invalid-feedback">
            <?php echo e($errors->first('Copyright')); ?>

          </div>
        <?php endif; ?>
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
    $('#city-code').select2();
    $('#country-name').select2();
    $('#country-code').select2();

    $('#country-name').change(function () {
      var countryId = $(this).val();
      console.log('Selected Country ID:', countryId); // Debugging statement
      $('#state-code').empty().append('<option value="">Select State</option>');
      $('#city-code').empty().append('<option value="">Select City</option>');

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
      $('#city-code').empty().append('<option value="">Select City</option>');

      if (stateId) {
        $.ajax({
          url: '<?php echo e(route('fetch.cities', ':id')); ?>'.replace(':id', stateId),
          type: 'GET',
          success: function (data) {
            console.log('Cities Data:', data); // Debugging statement
            $('#city-code').empty().append('<option value="">Select City</option>');
            $.each(data.cities, function (key, city) {
              $('#city-code').append('<option value="' + key + '">' + city + '</option>');
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
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\master\resources\views/settings/index.blade.php ENDPATH**/ ?>