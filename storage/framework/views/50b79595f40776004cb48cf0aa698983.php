
<?php $__env->startSection('title'); ?> Create Invoice <?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
<!-- Sweet Alert css-->
<link href="<?php echo e(URL::asset('build/libs/sweetalert2/sweetalert2.min.css')); ?>" rel="stylesheet">
<link href="<?php echo e(URL::asset('build/select2/css/select2.min.css')); ?>" rel="stylesheet" type="text/css" />

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="row justify-content-center">
  <div class="col-xxl-9">
    <div class="card">
      <form action="<?php echo e(route('invoice.store')); ?>" method="post" id="invoice_form" name="invoice_form">
        <?php echo csrf_field(); ?>
        <div class="card-body border-bottom border-bottom-dashed p-4">
          <div class="row">
            <div class="col-lg-4">
              <div class="profile-user mx-auto  mb-3">
                <span
                  class="overflow-hidden border border-dashed d-flex align-items-center justify-content-center rounded"
                  style="height: 60px; width: 256px;">
                  <img src="<?php echo e(URL::asset('images/uploads/' . $settings['app-logo'])); ?>"
                    class="card-logo card-logo-dark user-profile-image img-fluid" alt="logo dark">
                  <img src="<?php echo e(URL::asset('images/uploads/' . $settings['app-logo'])); ?>"
                    class="card-logo card-logo-light user-profile-image img-fluid" alt="logo light">
                </span>
              </div>
              <div>
                <div>
                  <label for="companyAddress">Address</label>
                </div>
                <div class="mb-2">
                  <textarea class="form-control bg-light border-0 <?php $__errorArgs = ['companyAddress'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                    id="companyAddress" rows="3" placeholder="Company Address"
                    name="companyAddress"><?php echo e($settings['Address']); ?></textarea>
                  <?php $__errorArgs = ['companyAddress'];
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
                <div>
                  <input type="text"
                    class="form-control bg-light border-0 <?php $__errorArgs = ['company_postal_code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                    value="<?php echo e($settings['zip-code']); ?>" name="company_postal_code" id="companyaddpostalcode"
                    minlength="5" maxlength="6" placeholder="Enter Postal Code" />
                  <?php $__errorArgs = ['company_postal_code'];
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
            </div><!--end col-->
            <div class="col-lg-4 ms-auto">
              <div class="mb-2">
                <input type="text" class="form-control bg-light border-0 <?php $__errorArgs = ['gst_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                  value="<?php echo e($settings['GST-NO']); ?>" name="gst_number" id="GSTNumber" placeholder="GST No." />
                <?php $__errorArgs = ['gst_number'];
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
              <div class="mb-2">
                <input type="email" class="form-control bg-light border-0 <?php $__errorArgs = ['company_email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                  name="company_email" value="<?php echo e($settings['company-email']); ?>" id="companyEmail"
                  placeholder="Email Address" />
                <?php $__errorArgs = ['company_email'];
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

              <div class="mb-2">
                <input type="text" class="form-control bg-light border-0 <?php $__errorArgs = ['companyPhone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                  name="companyPhone" value="<?php echo e($settings['company-phone']); ?>" id="compnayContactno"
                  placeholder="Contact No" />
                <?php $__errorArgs = ['companyPhone'];
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
              <div>
                <input type="text" class="form-control bg-light border-0 <?php $__errorArgs = ['invoicenoInput'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> "
                  id="invoicenoInput" name="invoicenoInput" placeholder="Invoice Number" value="<?php echo e($invoiceNumber); ?>"
                  readonly="readonly" />
                <?php $__errorArgs = ['invoicenoInput'];
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
          </div><!--end row-->
        </div>
        <div class="card-body p-4">
          <div class="row g-3">
            <div class="col-lg-3 col-sm-6">
              <label for="client">Client</label>
              <div class="input-light">
                <select class="form-control bg-light border-0 <?php $__errorArgs = ['client'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="clientName"
                  name="client">
                  <?php if($clients): ?>
            <?php $__currentLoopData = $clients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <option value="<?php echo e($client->id); ?>"><?php echo e($client->first_name); ?></option>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          <?php endif; ?>
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
            </div><!--end col-->
            <div class="col-lg-3 col-sm-6">
              <div>
                <label for="date-field">Date</label>
                <input type="date" value="<?php echo e($invoiceDate); ?>" name="invoice_date"
                  class="form-control bg-light border-0 <?php $__errorArgs = ['invoice_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="date-field"
                  data-time="true" placeholder="Select Date-time">
                <?php $__errorArgs = ['invoice_date'];
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
            </div><!--end col-->
            <div class="col-lg-3 col-sm-6">
              <div>
                <label for="totalamountInput">Due Date</label>
                <input type="date" class="form-control bg-light border-0 <?php $__errorArgs = ['due_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                  id="due_date" value="<?php echo e($dueDate); ?>" name="due_date" />
                <?php $__errorArgs = ['due_date'];
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
            </div><!--end col-->
            <div class="col-lg-3 col-sm-6">
              <label for="select-payment-status">Status <span class="text-danger">*</span></label>
              <div class="input-light">
                <select class="form-control bg-light border-0 <?php $__errorArgs = ['invoice_status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                  name="invoice_status" id="select-payment-status">
                  <option value="Unpaid">Unpaid</option>
                  <option value="Paid">Paid</option>
                  <option value="Partially_Paid">Partially Paid</option>
                  <option value="Overdue">Overdue</option>
                  <option value="Processing">Processing</option>
                  <option value="Draft">Draft</option>
                </select>
                <?php $__errorArgs = ['invoice_status'];
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
            </div><!--end col-->
            <div class="col-lg-3 col-sm-6">
              <label for="select-project">Project <span class="text-danger">*</span></label>
              <div class="input-light">
                <select class="form-control bg-light border-0 <?php $__errorArgs = ['project'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                  name="project" id="select-project">
                  
                </select>
                <?php $__errorArgs = ['project'];
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
            </div><!--end col-->

          </div><!--end row-->
        </div>
        <div class="card-body p-4 border-top border-top-dashed">
          <div class="row">
            <div class="col-lg-12 col-sm-12">
              <div>
                <label for="billingName" class="text-muted text-uppercase fw-semibold">Address</label>
              </div>
              <div class="row">
                <div class="col-lg-6 col-sm-12">
                  <div class="mb-2">
                    <input type="text" class="form-control bg-light border-0 <?php $__errorArgs = ['fullname'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> "
                      name="fullname" id="billingName" placeholder="Full Name" />
                    <?php $__errorArgs = ['fullname'];
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
                <div class="col-lg-6 col-sm-12">

                  <div class="mb-2">
                    <input type="text"
                      class="form-control bg-light border-0 <?php $__errorArgs = ['clientContact'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                      name="clientContact" id="billingPhoneno" placeholder="(123)456-7890" />
                    <?php $__errorArgs = ['clientContact'];
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
              <div class="row">
                <div class="col-lg-6 col-sm-12">
                  <div class="mb-3">
                    <input type="text" class="form-control bg-light border-0 <?php $__errorArgs = ['clientGST'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                      name="clientGST" id="billingTaxno" placeholder="Tax Number" />
                    <?php $__errorArgs = ['clientGST'];
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
                <div class="col-lg-6 col-sm-12">

                  <div class="mb-2">
                    <input type="email"
                      class="form-control bg-light border-0 <?php $__errorArgs = ['clientEmail'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                      name="clientEmail" id="billingEmail" placeholder="abc@example.com" />
                    <?php $__errorArgs = ['clientEmail'];
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
              <div class="row">
                <div class="col-lg-6 col-sm-12">
                  <div class="mb-2">
                    <textarea class="form-control bg-light border-0 <?php $__errorArgs = ['clientAddress'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                      id="billingAddress" name="clientAddress" rows="3" placeholder="Address"></textarea>
                    <?php $__errorArgs = ['clientAddress'];
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
            </div><!--end col-->
          </div><!--end row-->
        </div>
        <div class="card-body p-4">
          <div class="table-responsive">
            <table class="invoice-table table table-borderless table-nowrap mb-0">
              <thead class="align-middle">
                <tr class="table-active">
                  <th scope="col" style="width: 50px;">#</th>
                  <th scope="col">
                    Product Details
                  </th>
                  <th scope="col" style="width: 120px;">
                    <div class="d-flex currency-select input-light align-items-center">
                      Rate(₹)
                    </div>
                  </th>
                  <th scope="col" style="width: 120px;">Quantity</th>
                  <th scope="col" class="text-end" style="width: 150px;">Amount</th>
                  <th scope="col" class="text-end" style="width: 105px;"></th>
                </tr>
              </thead>
              <tbody id="newlink">
                <tr class="product-row">
                  <th scope="row" class="product-item-id">1</th>
                  <td class="text-start">
                    <div class="mb-2">
                      <div class="input-light">
                        <select
                          class="form-control bg-light border-0 select-product-item <?php $__errorArgs = ['product_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                          name="product_id[]">
                          <?php if($products): ?>
                          <option value="">Select Product</option>
                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <option value="<?php echo e($product->id); ?>" data-product-id="<?php echo e($product->id); ?>"
          data-product-price="<?php echo e($product->unit_price); ?>" data-product-name="<?php echo e($product->name); ?>">
          <?php echo e($product->name); ?>

          </option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              <?php endif; ?>
                        </select>
                        <?php $__errorArgs = ['product_id'];
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
                  </td>
                  <td>
                    <input type="number" 
                      class="form-control product-price bg-light border-0 productRate <?php $__errorArgs = ['product_rate'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                      id="productRate" name="product_rate[]" step="0.01" placeholder="₹0.00" />
                    <?php $__errorArgs = ['product_rate'];
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
                  </td>
                  <td>
                    <div class="input-step">
                      <button type="button" class='minus'>–</button>
                      <input type="number"
                        class="product-quantity product-qty <?php $__errorArgs = ['product_qty'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                        name="product_qty[]" id="product-qty" min="1" max="10" value="1" readonly>
                      <button type="button" class='plus'>+</button>
                    </div>
                  </td>
                  <td class="text-end">
                    <div>
                      <input type="text"
                        class="form-control bg-light border-0 product-line-price productPrice <?php $__errorArgs = ['product_item_total'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                        id="productPrice" placeholder="₹0.00" name="product_item_total[]" readonly />
                      <?php $__errorArgs = ['product_item_total'];
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
                  </td>
                  <td class="product-removal">
                    <a href="javascript:void(0)" class="btn btn-success delete-row">Delete</a>
                  </td>
                </tr>
              </tbody>
              <tbody>
                <!-- <tr id="newForm" style="display: none;">
                  <td class="d-none" colspan="5">
                    <p>Add New Form</p>
                  </td>
                </tr> -->
                <tr>
                  <td colspan="5">
                    <a href="javascript:void(0)" id="add-item" class="btn btn-soft-secondary fw-medium"><i
                        class="ri-add-fill me-1 align-bottom"></i> Add Item</a>
                  </td>
                </tr>
                <tr class="border-top border-top-dashed mt-2">
                  <td colspan="3">
                    <table class="table table-borderless table-sm table-nowrap align-middle mb-0">
                      <tbody>
                        <tr class="mb-3">
                          <th scope="row">Discount Type</th>
                          <td>
                            <div class="mb-3">
                              <div class="input-group">
                                <div class="input-group-prepend">
                                  <select class="js-example-basic-single <?php $__errorArgs = ['discount_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    id="discount_type" name="discount_type">
                                    <option value="Fixed">₹</option>
                                    <option value="Percentage">%</option>
                                  </select>
                                </div>
                                <input type="number" class="form-control <?php $__errorArgs = ['discount'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                  id="discount" value="" name="discount" placeholder="0">
                                <?php $__errorArgs = ['discount'];
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

                          </td>
                        </tr>
                        <tr>
                          <th scope="row">Tax</th>
                          <td>
                            <div class="mb-3">
                              <select class="form-control" name="taxes" id="taxes">
                                <?php if($taxes): ?>
                                  <?php
                  $defaultTax = $taxes->firstWhere('is_default', 1);
                ?>
                                  <option value="0" data-tax-value="0" <?php echo e(!$defaultTax ? 'selected' : ''); ?>>No Tax
                                  </option>
                                  <?php $__currentLoopData = $taxes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tax): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option <?php echo e(($tax->is_default == 1) ? 'selected' : ''); ?> value="<?php echo e($tax->id); ?>"
                    data-tax-value="<?php echo e($tax->value); ?>"><?php echo e($tax->name); ?></option>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
                              </select>
                            </div>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </td>
                  <td colspan="2" class="p-0">
                    <table class="table table-borderless table-sm table-nowrap align-end mb-0">
                      <tbody>
                        <tr>
                          <th scope="row">Sub Total</th>
                          <td style="width:150px;">
                            <input type="text"
                              class="form-control bg-light border-0 <?php $__errorArgs = ['invoice_subtotal'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                              name="invoice_subtotal" id="invoice_subtotal" placeholder="₹0.00" readonly />
                            <?php $__errorArgs = ['invoice_subtotal'];
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
                          </td>
                        </tr>

                        <tr>
                          <th scope="row">Discount</th>
                          <td>
                            <input type="text"
                              class="form-control bg-light border-0 <?php $__errorArgs = ['cart_discount'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                              name="cart_discount" id="cart_discount" placeholder="₹0.00" readonly />
                            <?php $__errorArgs = ['cart_discount'];
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
                          </td>
                        </tr>
                        <tr>
                          <th scope="row" id="tax-table-head">Tax</th>
                          <td>
                            <input type="text"
                              class="form-control bg-light border-0  <?php $__errorArgs = ['cart_tax'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                              name="cart_tax" id="cart_tax" placeholder="₹0.00" readonly />
                            <?php $__errorArgs = ['cart_tax'];
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
                          </td>
                        </tr>
                        <tr class="border-top border-top-dashed">
                          <th scope="row">Total Amount</th>
                          <td>
                            <input type="text"
                              class="form-control bg-light border-0 <?php $__errorArgs = ['final_amount'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                              name="final_amount" id="cart-total" placeholder="₹0.00" readonly />
                            <?php $__errorArgs = ['final_amount'];
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
                          </td>
                        </tr>
                      </tbody>
                    </table>
                    <!--end table-->
                  </td>
                </tr>
              </tbody>
            </table><!--end table-->
          </div>
          <div class="row mt-3">
            <div class="col-lg-4">
              <div class="mb-2">
                <label for="select-payment-type" class="form-label text-muted text-uppercase fw-semibold">Payment
                  Method</label>
                <div class="input-light">
                  <select class="form-control bg-light border-0 <?php $__errorArgs = ['payment_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                    id="select-payment-type" name="payment_type">
                    <option value="bank_transfer">Bank Transfer</option>
                    <option value="phone_pe">PhonePe</option>
                    <option value="google_pay">Google Pay</option>
                  </select>
                  <?php $__errorArgs = ['payment_type'];
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
            </div><!--end col-->
          </div><!--end row-->
          <div class="mt-4">
            <div class="form-group">
              <label for="exampleFormControlTextarea1">Notes</label>
              <textarea class="form-control <?php $__errorArgs = ['notes'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="notes" id="notes"
                rows="3"></textarea>
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
          <input type="hidden" name="itemArray[]" id="invoiceItemsInput">
          <input type="hidden" name="tax_id" id="default_tax_id">
          <input type="hidden" name="tax_name" id="default_tax_name">
          <div class="hstack gap-2 justify-content-end d-print-none mt-4">
            <button type="submit" class="btn btn-success"><i class="ri-printer-line align-bottom me-1"></i>
              Save</button>
          </div>
        </div>
      </form>
    </div>
  </div><!--end col-->
</div><!--end row-->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script src="<?php echo e(URL::asset('build/libs/cleave.js/cleave.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('build/js/pages/profile-setting.init.js')); ?>"></script>
<!-- <script src="<?php echo e(URL::asset('build/js/pages/invoicecreate.init.js')); ?>"></script> -->
<script src="<?php echo e(URL::asset('build/libs/sweetalert2/sweetalert2.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('build/select2/js/select2.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('build/js/app.js')); ?>"></script>
<script>
   $(document).ready(function () {
    $('select').select2();
    var count = 0;
    function new_link() {
      count++; 
      var tr1 = document.createElement("tr");
      tr1.id = "product-" + count; 
      tr1.className = "product-row";
      var productId = '<span class="product-id">' + count + '</span>';
      var delLink =
        '<th scope="row" class="product-item-id">' + count + '</th>' +
        '<td class="text-start">' +
        '<div class="mb-2">' +
        '<div class="input-light">' +
        '<select class="form-control bg-light border-0 select-product-item" name="product_id[]">' +
        '<?php if($products): ?>' +
      '<?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>' +
      '<option value="<?php echo e($product->id); ?>" data-product-id="<?php echo e($product->id); ?>" data-product-price="<?php echo e($product->unit_price); ?>" data-product-name="<?php echo e($product->name); ?>" ><?php echo e($product->name); ?></option>' +
    '<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>' +
    '<?php endif; ?>' +
        '</select>' +
        '</div>' +
        '</div>' +
        '</td>' +
        '<td>' +
        '<input class="form-control bg-light border-0 product-price productRate" name="product_rate[]"  type="number" id="productRate-' + count + '" step="0.01" placeholder="₹0.00">' +
        '</td>' +
        '<td>' +
        '<div class="input-step">' +
        '<button type="button" class="minus">–</button>' +
        '<input type="number" name="product_qty[]" class="product-quantity product-qty" id="product-qty-' + count + '" value="1" readonly>' +
        '<button type="button" class="plus">+</button>' +
        '</div>' +
        '</td>' +
        '<td class="text-end">' +
        '<div>' +
        '<input type="text" name="product_item_total[]" readonly class="form-control bg-light border-0 product-line-price" id="productPrice-' + count + '"  placeholder="₹0.00" />' +
        '</div>' +
        '</td>' +
        '<td class="product-removal">' +
        '<a class="btn btn-success delete-row">Delete</a>' +
        '</td>';

      // Set the inner HTML of the new row
      tr1.innerHTML = delLink;

      // Append the new row to the target container with id 'newlink'
      document.getElementById("newlink").appendChild(tr1);

      // Initialize Select2 on the newly added select element
      $('.select-product-item').select2(); // Ensure Select2 is properly included and initialized
      var selectedPrice = $('#newlink').find('.select-product-item:last option:selected').data('product-price');
      $('#productRate-' + count).val(selectedPrice.toFixed(2));
      updateRate();
      // Optional: Attach event handlers or perform other actions as needed
    }

    function updateRate() {
      $('.product-row').each(function () {
        var $row = $(this); // Current product row
        // Find the select element within the current row
        var selectedProductPrice = $row.find('.productRate').val();
        // var selectedProductPrice = $row.find('.select-product-item').find(':selected').data('product-price');
        var selectedProductID = $row.find('.select-product-item').find(':selected').data('product-id');

        // Update elements within the current row
        $row.find('.productRate').val(selectedProductPrice);
        $row.find('.product-item-id').text(selectedProductID);

        var quantity = parseInt($row.find('.product-qty').val());
        var linePrice = selectedProductPrice * quantity;
        $row.find('.product-line-price').val(linePrice.toFixed(2));
      });
    }

    function updateSubtotal() {
      var subtotal = 0;
      var invoiceItems = [];

      $('.product-row').each(function () {
        var $row = $(this);
        var productName = $row.find('.select-product-item').find(':selected').data('product-name');
        var quantity = parseInt($row.find('.product-qty').val());
        var linePrice = parseFloat($row.find('.product-line-price').val());
        var productID = $row.find('.product-item-id').text();
        var productPrice = $row.find('.productRate').val();
        invoiceItems.push({
          product_id: productID,
          product_name: productName,
          quantity: quantity,
          price: productPrice,
          total: linePrice
        });
      });
      var invoiceItemsJSON = JSON.stringify(invoiceItems);
      $('#invoiceItemsInput').val(invoiceItemsJSON);
      console.log($('#invoiceItemsInput').val());
      // Calculate subtotal
      $('.product-line-price').each(function () {
        var linePrice = parseFloat($(this).val());
        if (!isNaN(linePrice)) {
          subtotal += linePrice;
        }
      });

      $('#invoice_subtotal').val(subtotal.toFixed(2));

      // Calculate discount
      var discountValue = parseFloat($('#discount').val());
      var discountType = $('#discount_type').val();
      var discountAmount = 0;
      if (discountType === 'Fixed' && discountValue) {
        discountAmount = discountValue;
      } else if (discountType === 'Percentage' && discountValue) {
        if (discountValue < 0 || discountValue > 100) {
          $('#discount').addClass('is-invalid');
          $('#discount').next('.invalid-feedback').text('Discount percentage must be between 0 and 100.');
        } else {
          $('#discount').removeClass('is-invalid');
          $('#discount').next('.invalid-feedback').text('');
          discountAmount = subtotal * (discountValue / 100);
        }
      }

      $('#cart_discount').val(discountAmount.toFixed(2));

      // Calculate tax based on subtotal after discount
      var discountedSubtotal = subtotal - discountAmount;
      var selectedTaxRate = $('#taxes').find(':selected').data('tax-value');
      var selectedTaxId = $('#taxes').val();
      $('#default_tax_name').val(selectedTaxRate);
      $('#default_tax_id').val(selectedTaxId);
      $('#tax-table-head').text('Tax (' + selectedTaxRate + '%)');
      var taxAmount = discountedSubtotal * (selectedTaxRate / 100);
      $('#cart_tax').val(taxAmount.toFixed(2));

      // Calculate total after tax and discount
      var totalAmount = discountedSubtotal + taxAmount;
      $('#cart-total').val(totalAmount.toFixed(2));
    }

    updateRate();
    updateSubtotal();
    $('select').select2();
    $('#add-item').click(function () {
      new_link(); // Call the function to add a new row
      updateRate();
      updateSubtotal();
    });

    $('#newlink').on('click', '.plus', function () {
      var qtyInput = $(this).siblings('.product-qty');
      var currentVal = parseInt(qtyInput.val());
      if (currentVal < 10) {
        qtyInput.val(currentVal + 1);
      }
      updateRate();
      updateSubtotal();

    });

    // Handle the minus button click
    $('#newlink').on('click', '.minus', function () {
      var qtyInput = $(this).siblings('.product-qty');
      var currentVal = parseInt(qtyInput.val());
      if (currentVal > 1) {
        qtyInput.val(currentVal - 1);
      }
      updateRate();
      updateSubtotal();

    });

    $('#newlink').on('click', '.delete-row', function () {
      $(this).closest('tr').remove(); // Remove the closest <tr> element
      updateSubtotal();
    });
    $(document).on('change', '.select-product-item', function () {
      var $row = $(this).closest('.product-row'); // Get the current row
      var selectedProductPrice = $(this).find(':selected').data('product-price'); // Get the selected product price
      $row.find('.productRate').val(selectedProductPrice); // Update the product rate input field
      updateRate();
      updateSubtotal();
    });
    $(document).on('change', '#taxes', function () {
      updateRate();
      updateSubtotal();

    });
    $(document).on('change', '.productRate', function () {
      updateRate();
      updateSubtotal();

    });
    $('#discount, #discount_type').change(function () {
      updateSubtotal();
    });
    <?php echo $__env->make('invoices.updateClientInfo', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
   });
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\master\resources\views/invoices/create.blade.php ENDPATH**/ ?>