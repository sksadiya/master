<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <title>Invoice <?php echo e($invoice->invoice_number); ?></title>
</head>

<body>
  <div class="container py-3">
    <div class="row">
    <div class="row">
        <div class="d-flex justify-content-between bd-highlight mb-3">
          <div class="p-2 bd-highlight">
          <h2 class="text-uppercase mb-2 ps-2 bg-dark text-light mb-sm-0 d-inline-block">Invoice
              <?php echo e($invoice->invoice_number); ?>

            </h2><br>
            <strong class="text-muted fs-5">Bill date :
              <small><?php echo e(\Carbon\Carbon::parse($invoice->invoice_date)->format('d/m/Y')); ?></small></strong><br>
            <strong class="text-muted fs-5">Due date :
              <small><?php echo e(\Carbon\Carbon::parse($invoice->due_date)->format('d/m/Y')); ?></small></strong>
          </div>
          <div class="p-2 bd-highlight">
          <img src="data:image/png;base64,<?php echo e(base64_encode(file_get_contents(public_path('images/uploads/' . $settings['app-logo'])))); ?>" class="img-fluid" alt="Logo" style="max-width: 200px;">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="d-flex justify-content-between bd-highlight mb-3">
          <div class="p-2 bd-highlight">
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
          <div class="p-2 bd-highlight">
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
      </div>
      <div class="col-md-12">
        <table class="table table-striped">
          <thead class="bg-dark text-light">
            <tr>
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
      <div class="row mt-2">
        <div class="col-md-6">
          <h4><?php echo e($settings['company-name']); ?></h4>
          <strong>Company Name: </strong><?php echo e($settings['company-name']); ?> <br>
          <strong>Account Number: </strong><?php echo e($settings['company-name']); ?><br>
          <strong>IFSC: </strong><?php echo e($settings['company-name']); ?><br>
          <strong>SWIFT code: </strong><?php echo e($settings['company-name']); ?><br>
          <strong>Bank name: </strong><?php echo e($settings['company-name']); ?><br>
          <strong>Branch: </strong><?php echo e($settings['company-name']); ?><br>
        </div>
      </div>
      <div class="row mt-4">
        <div class="col-12">
          <b>Terms & Conditions :-</b>
            <ul class="text-muted">
                <li>Payment should be made within 30 days from the invoice date.</li>
                <li>Please mention the invoice number while making the payment.</li>
                <li>Late payments may incur additional charges.</li>
                <li>For any queries regarding this invoice, please contact us at info@company.com.</li>
            </ul>
        </div>
      </div>
    </div>
  </div>
</body>

</html><?php /**PATH C:\xampp\htdocs\master\resources\views/invoices/invoice.blade.php ENDPATH**/ ?>