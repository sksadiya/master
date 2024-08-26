
<?php $__env->startSection('title'); ?> Show <?php echo e($invoice->invoice_number); ?> <?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
<link href="<?php echo e(URL::asset('build/libs/sweetalert2/sweetalert2.min.css')); ?>" rel="stylesheet">
<link href="<?php echo e(URL::asset('build/select2/css/select2.min.css')); ?>" rel="stylesheet" type="text/css" />
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
            <h4 class="mb-sm-0 font-size-18">Invoice <?php echo e($invoice->invoice_number); ?></h4>
            <div class="page-title-right">
              <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Add Payments')): ?>
            <button type="button" class="btn btn-primary add-btn" data-bs-toggle="modal" id="create-btn"
            data-bs-target="#addPaymentModal"><i class="fas fa-plus-circle me-2"></i>Add Payments</button>
            <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<!-- Invoice 1 - Bootstrap Brain Component -->
<section class="py-3 invoice-container">
  <div class="container">
    <div class="card py-5">
      <div class="row justify-content-center px-lg-5 px-sm-1">
        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mb-5 pb-4 px-4">
          <div class="col-md-4 mb-3">
            <h2 class="text-uppercase mb-2 ps-2 bg-dark text-light mb-sm-0 d-inline-block">Invoice
              <?php echo e($invoice->invoice_number); ?>

            </h2><br>
            <strong class="text-muted fs-5">Bill date :
              <small><?php echo e(\Carbon\Carbon::parse($invoice->invoice_date)->format('d/m/Y')); ?></small></strong><br>
            <strong class="text-muted fs-5">Due date :
              <small><?php echo e(\Carbon\Carbon::parse($invoice->due_date)->format('d/m/Y')); ?></small></strong>
          </div>
          <div class="text-center">
            <img src="<?php echo e(URL::asset('public/images/uploads/' . $settings['app-logo'])); ?>" class="img-fluid" alt="Logo"
              style="max-width: 200px;">
          </div>
        </div>
        <div class="row d-inline-flex">
          <div class="row mb-5">
            <div class="col-12 col-sm-6 col-md-8">
              <h4>Bill To</h4>
              <address>
                <strong><?php echo e($invoice->client->first_name); ?> <?php echo e($invoice->client->last_name); ?></strong><br>
                <?php echo e($invoice->client->Address); ?><br>
                <?php echo e(optional($invoice->client->city)->name); ?>, <?php echo e(optional($invoice->client->state)->name); ?>,
                <?php echo e($invoice->client->postal_code); ?><br>
                <?php echo e(optional($invoice->client->country)->name); ?><br>
                Phone: <?php echo e($invoice->client->contact); ?><br>
                Email: <?php echo e($invoice->client->email); ?><br>
                <b>GST Number:</b> <?php echo e($invoice->client->GST); ?>

              </address>
            </div>
            <div class="col-12 col-sm-6 col-md-4">
              <h4>SAS Associates</h4>
              <address>
                <strong><?php echo e($settings['company-name']); ?></strong><br>
                <?php echo e($settings['Address']); ?><br>
                <?php echo e($settings['city']); ?>, <?php echo e($settings['state']); ?>, <?php echo e($settings['zip-code']); ?><br>
                <?php echo e($settings['country']); ?><br>
                Phone: + <?php echo e($settings['country-code']); ?> <?php echo e($settings['company-phone']); ?><br>
                Email: <?php echo e($settings['company-email']); ?><br>
                <b>GST Number:</b> <?php echo e($settings['GST-NO']); ?>

              </address>

            </div>
          </div>
          <div class="row mb-3">
            <div class="col-12">
              <div class="table-responsive">
                <table class="table table-striped">
                  <thead class="bg-dark">
                    <tr class="text-light">
                      <th scope="col">#</th>
                      <th scope="col">Item</th>
                      <th scope="col">Quantity</th>
                      <th scope="col">Rate</th>
                      <th scope="col">Total</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $__currentLoopData = $invoice->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
              <th scope="row"><?php echo e($loop->iteration); ?></th>
              <td><?php echo e($item->product_name); ?></td>
              <td><?php echo e($item->quantity); ?></td>
              <td><?php echo e($item->unit_price); ?></td>
              <td><?php echo e($item->total); ?></td>
            </tr>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <th>Subtotal (₹)</th>
                      <td>₹ <?php echo e($invoice->subtotal); ?></td>
                    </tr>
                    <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <th>Discount (₹)</th>
                      <td>₹ <?php echo e($invoice->discount_total); ?></td>
                    </tr>
                    <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <?php
            $invoice->tax = rtrim(rtrim($invoice->tax, '0'), '.');
          ?>
                      <th>Tax (<?php echo e($invoice->tax); ?>%)</th>
                      <td>₹ <?php echo e($invoice->tax_total); ?></td>
                    </tr>
                    <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <th>Total (₹)</th>
                      <td>₹ <?php echo e($invoice->total); ?></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-12 col-sm-6 col-md-8">
              <h4><?php echo e($settings['company-name']); ?></h4>
              <strong>Company Name: </strong><?php echo e($settings['company-name']); ?> <br>
              <strong>Account Number: </strong><?php echo e($settings['company-name']); ?><br>
              <strong>IFSC: </strong><?php echo e($settings['company-name']); ?><br>
              <strong>SWIFT code: </strong><?php echo e($settings['company-name']); ?><br>
              <strong>Bank name: </strong><?php echo e($settings['company-name']); ?><br>
              <strong>Branch: </strong><?php echo e($settings['company-name']); ?><br>
            </div>
          </div>
          <div class="row">
            <div class="col-12 text-end">
              <a href="#" onclick="window.print()" class="btn btn-primary">Print</a>
              <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Download Invoices')): ?>
              <a href="<?php echo e(route('generate',$invoice->id )); ?>"  class="btn btn-primary">Download</a>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Add Payments')): ?>
<div class="modal fade" id="addPaymentModal" tabindex="-1" aria-labelledby="addPaymentModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-light p-3">
        <h5 class="modal-title" id="addPaymentModalLabel">Add Payments</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
          id="close-add-modal"></button>
      </div>
      <form id="addPaymentForm" name="addPaymentForm" method="post">
        <?php echo csrf_field(); ?>
        <div class="modal-body">
          <div class="mb-3">
           <input type="hidden" name="invoice" value="<?php echo e($invoice->id); ?>" >
          </div>
          <div class="mb-3">
            <label for="Payment_method" class="form-label">Payment Method</label>
            <select class="form-select mb-3" id="Payment_method" name="Payment_method">
              <option value="bank_transfer">Bank Transfer</option>
              <option value="phone_pe">PhonePe</option>
              <option value="google_pay">Google Pay</option>
            </select>
            <div class="invalid-feedback"></div>
          </div>
          <div class="mb-3">
            <label for="payment_date" class="form-label">Payment Date</label>
            <input type="date" class="form-control" id="payment_date"
              value="<?php echo e(\Carbon\Carbon::today()->toDateString()); ?>" name="payment_date" />
            <div class="invalid-feedback"></div>
          </div>
          <div class="mb-3">
            <label for="payment_amount" class="form-label">Payment Amount</label>
            <input type="number" class="form-control" id="payment_amount" step="0.01" min="0" placeholder="Enter Amount"
              name="payment_amount" />
            <div class="invalid-feedback"></div>
          </div>
          <div class="mb-3">
            <label for="payment_note" class="form-label">Payment Note</label>
            <textarea class="form-control" cols="5" rows="5" name="payment_note" placeholder="Enter Note"
              id="payment_note"></textarea>
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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script src="<?php echo e(URL::asset('build/libs/prismjs/prism.js')); ?>"></script>
<script src="<?php echo e(URL::asset('build/select2/js/select2.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('build/libs/sweetalert2/sweetalert2.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('build/js/app.js')); ?>"></script>
<script>
   $(document).ready(function () {
    $('#addPaymentModal').on('shown.bs.modal', function () {
      $('#invoice').select2({
        dropdownParent: $('#addPaymentModal') // Ensure dropdown is appended to modal
      });
      $('#Payment_method').select2({
        dropdownParent: $('#addPaymentModal') // Ensure dropdown is appended to modal
      });
    });

    $('#addPaymentForm').on('submit', function (e) {
      e.preventDefault();

      $.ajax({
        type: 'POST',
        url: '<?php echo e(route("payment.store")); ?>',
        data: $(this).serialize(),
        success: function (response) {
          if (response.status) {
            $('#addPaymentModal').modal('hide');
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
              $('#' + key).siblings('.invalid-feedback').text(value[0]);
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

    $('#addPaymentModal').on('hidden.bs.modal', function () {
      $('#addPaymentForm')[0].reset();
      $('.form-control').removeClass('is-invalid');
      $('.invalid-feedback').text('');
    });

    $('#close-add-modal, .btn-light').on('click', function () {
      $('#addPaymentForm')[0].reset();
      $('.form-control').removeClass('is-invalid');
      $('.invalid-feedback').text('');
    });
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\master\resources\views/invoices/show.blade.php ENDPATH**/ ?>