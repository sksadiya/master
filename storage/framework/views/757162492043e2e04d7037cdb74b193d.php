
<?php $__env->startSection('title'); ?>
<?php echo e($client->first_name); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
<link href="<?php echo e(URL::asset('build/select2/css/select2.min.css')); ?>" rel="stylesheet" type="text/css" />
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
  <div class="col-xxl-12">
    <div class="card ">
      <div id="alert-container">
        <?php if(Session::has('message')): ?>
      <div class="alert <?php echo e(Session::get('alert-class', 'alert-info')); ?> alert-dismissible fade show" role="alert">
        <?php echo e(Session::get('message')); ?>

        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    <?php endif; ?>
      </div>
      <div class="card-header">
        <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" data-bs-toggle="tab" href="#clientDetails" role="tab">
            <i class="far fa-user"></i> Client Details
            </a>
          </li>
          <?php if($client->invoices->count() > 0): ?>
        <li class="nav-item">
        <a class="nav-link" data-bs-toggle="tab" href="#invoices" role="tab">
        <i class="fas fa-file-invoice"></i> Invoices
        </a>
        </li>
      <?php endif; ?>
          <?php if($client->invoices->pluck('payments')->flatten()->isNotEmpty()): ?>
        <li class="nav-item">
        <a class="nav-link" data-bs-toggle="tab" href="#payments" role="tab">
        <i class="fas fa-money-check"></i> Payments
        </a>
        </li>
      <?php endif; ?>

        </ul>
      </div>
      <div class="card-body p-4">
        <div class="tab-content">
          <div class="tab-pane active" id="clientDetails" role="tabpanel">
            <div class="row">
              <div class="col-sm-6 d-flex flex-column mb-md-10 mb-3">
                <label for="name" class=" ">Full Name</label>
                <input type="text" name="name" id="name" readonly class="form-control"
                  value="<?php echo e($client->first_name); ?> <?php echo e($client->last_name); ?>">
              </div>
              <div class="col-sm-6 d-flex flex-column mb-md-10 mb-3">
                <label for="name" class="">Email</label>
                <input type="text" name="email" id="email" readonly class="form-control" value="<?php echo e($client->email); ?>">
              </div>
              <div class="col-sm-6 d-flex flex-column mb-md-10 mb-3">
                <label for="name" class=" ">Phone Number</label>
                <input type="text" name="contact" id="contact" readonly class="form-control"
                  value="<?php echo e($client->contact); ?>">
              </div>
              <div class="col-sm-6 d-flex flex-column mb-md-10 mb-3">
                <label for="name" class="">Country</label>
                <input type="text" name="country" id="country" readonly class="form-control"
                  value="<?php echo e($country->name); ?>">
              </div>
              <div class="col-sm-6 d-flex flex-column mb-md-10 mb-3">
                <label for="name" class="">State</label>
                <input type="text" name="state" id="state" readonly class="form-control" value="<?php echo e($state->name); ?>">
              </div>
              <div class="col-sm-6 d-flex flex-column mb-md-10 mb-3">
                <label for="name" class="">City</label>
                <input type="text" name="city" id="city" readonly class="form-control" value="<?php echo e($city->name); ?>">
              </div>
              <div class="col-sm-6 d-flex flex-column mb-md-10 mb-3">
                <label for="name" class="">Address</label>
                <textarea readonly class="form-control" name="address" id="address"><?php echo e($client->Address); ?></textarea>
              </div>
              <div class="col-sm-6 d-flex flex-column mb-md-10 mb-3">
                <label for="name" class="">Note</label>
                <input type="text" name="notes" id="notes" readonly class="form-control" value="<?php echo e($client->Notes); ?>">
              </div>
              <div class="col-sm-6 d-flex flex-column mb-md-10 mb-3">
                <label for="name" class="">GSTIN</label>
                <input type="text" name="gst" id="gst" readonly class="form-control" value="<?php echo e($client->GST); ?>">
              </div>
              <!--end col-->
            </div>
            <!--end row-->
            </form>
          </div>
          <!--end tab-pane-->
          <div class="tab-pane" id="invoices" role="tabpanel">
            <div class="row">
              <div class="col-lg-12">
                <div class="card">
                  <div class="card-body">
                    <div class="listjs-table" id="clientInvoicesList">
                      <div class="row g-4 mb-3">
                        <div class="col-sm">
                            <div class="d-flex justify-content-sm-end">
                              <a href="<?php echo e(route('exportClientInvoices', $client->id)); ?>" type="button"
                                class="btn btn-outline-success btn-border me-2">PDF Export</a>
                              <a href="<?php echo e(route('clients.export-with-invoices', $client->id)); ?>" type="button"
                                class="btn btn-outline-info btn-border me-2">Excel Export</a>
                            </div>
                        </div>
                      </div>
                      <div class="table-responsive table-card mt-3 mb-1">
                        <table class="table align-middle table-nowrap" id="clientInvoiceTable">
                          <thead class="table-light">
                            <tr>
                            <th>Invoice Number</th>
                            <th>Invoice Date</th>
                            <th>Due Date</th>
                            <th>Total Amount(₹)</th>
                            <th>Due Amount(₹)</th>
                            <th>Status</th>
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
          </div>
          <!--end tab-pane-->

          <div class="tab-pane" id="payments" role="tabpanel">
            <div class="row">
              <div class="col-lg-12">
                <div class="card">
                  <div class="card-body">
                    <div class="listjs-table" id="paymentList">
                      <div class="row g-4 mb-3">
                        <div class="col-sm">
                            <div class="d-flex justify-content-sm-end">
                              <a href="<?php echo e(route('exportClientPayments', $client->id)); ?>" type="button"
                                class="btn btn-outline-success btn-border me-2">PDF Export</a>
                              <a href="<?php echo e(route('clients.export-with-payments', $client->id)); ?>" type="button"
                                class="btn btn-outline-info btn-border me-2">Excel Export</a>
                            </div>
                        </div>
                      </div>
                      <div class="table-responsive table-card mt-3 mb-1">
                        <table class="table align-middle table-nowrap" id="clientPaymentTable">
                          <thead class="table-light">
                            <tr>
                            <th>Invoice</th>
                            <th>Payment Date</th>
                            <th>Payment Mode</th>
                            <th>Payment Amount</th>
                            <th>Due Amount</th>
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
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--end col-->
</div>
<!--end row-->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script src="<?php echo e(URL::asset('build/libs/prismjs/prism.js')); ?>"></script>
<script src="<?php echo e(URL::asset('build/libs/list.js/list.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('build/libs/list.pagination.js/list.pagination.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('build/libs/sweetalert2/sweetalert2.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('build/js/app.js')); ?>"></script>
<script>
  $(document).ready(function () {
    var clientId = "<?php echo e($client->id); ?>"; // Pass client ID from the Blade view
    $('#clientPaymentTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "<?php echo e(route('client.payments.get', ['clientId' => ':clientId'])); ?>".replace(':clientId', clientId),
            type: 'GET'
        },
        columns: [
            { data: 'invoice', name: 'invoice' },
            { data: 'payment_date', name: 'payment_date' },
            { data: 'payment_mode', name: 'payment_mode' },
            { data: 'amount', name: 'amount' },
            { data: 'due_payment', name: 'due_payment' },
        ]
    });
    $('#clientInvoiceTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "<?php echo e(route('client.invoices', ['clientId' => ':clientId'])); ?>".replace(':clientId', clientId),
            type: 'GET'
        },
        columns: [
            { data: 'invoice', name: 'invoice_number' },
            { data: 'invoice_date', name: 'invoice_date' },
            { data: 'due_date', name: 'due_date' },
            { data: 'total', name: 'total' },
            { data: 'due', name: 'due_amount' },
            { data: 'status', name: 'invoice_status' },
        ]
    });
  });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\master\resources\views/client/show.blade.php ENDPATH**/ ?>