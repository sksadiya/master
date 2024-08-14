<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Payments</title>
</head>

<body>
    <div class="container py-3">
        <div class="row justify-content-center">
            <div class="mb-3 text-center">
            <h2>Payments Export Data</h2>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Payment Date</th>
                        <th scope="col">Invoice ID</th>
                        <th scope="col">Client Name</th>
                        <th scope="col">Payment Amount</th>
                        <th scope="col">Payment Method</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <th scope="row"><?php echo e($payment->payment_date); ?></th>
                            <th scope="row"><?php echo e($payment->invoice->invoice_number); ?></th>
                            <td><?php echo e($payment->invoice->client->first_name); ?> <?php echo e($payment->invoice->client->last_name); ?></td>
                            <td>₹ <?php echo e($payment->amount); ?></td>
                            <td><?php echo e($payment->payment_mode); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html><?php /**PATH C:\xampp\htdocs\master\resources\views/payments/exportPayments.blade.php ENDPATH**/ ?>