
<?php $__env->startSection('title'); ?>
<?php echo e($expense->title); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
<link href="<?php echo e(URL::asset('build/select2/css/select2.min.css')); ?>" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="<?php echo e(URL::asset('build/libs/glightbox/css/glightbox.min.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="content">
    <div class="container">
        <div class="row py-3">
            <div class="card">
                <div class="card-header mb-3">Bills</div>
                <div class="col-md-12">
                    <?php if($expense->bill_file): ?>
                        <div class="card p-2" style="width: 18rem;">
                            <a class="image-popup" target="_blank"
                                href="<?php echo e(URL::asset('images/uploads/bills/' . $expense->bill_file)); ?>" title="">
                                <?php if(pathinfo($expense->bill_file, PATHINFO_EXTENSION) == 'pdf'): ?>
                                    <img class="gallery-img img-fluid mx-auto card-img-top"
                                        src="<?php echo e(URL::asset('build/images/pdf-icon.png')); ?>" alt="PDF Document" />
                                <?php else: ?>
                                    <img class="gallery-img img-fluid mx-auto card-img-top"
                                        src="<?php echo e(URL::asset('images/uploads/bills/' . $expense->bill_file)); ?>"
                                        alt="PAN Document" />
                                <?php endif; ?>
                                <div class="gallery-overlay mt-3">
                                    <h5 class="overlay-caption">
                                        <?php echo e(\Carbon\Carbon::parse($expense->created_at)->format('d/m/Y')); ?>

                                    </h5>
                                </div>
                            </a>
                            <div class="card-body">
                                <div class="d-flex align-items-center mt-1">
                                    <?php if(pathinfo($expense->bill_file, PATHINFO_EXTENSION) !== 'pdf'): ?>
                                        <div class="flex-grow-1 text-muted">
                                            <a href="<?php echo e(URL::asset('images/uploads/bills/' . $expense->bill_file)); ?>"
                                                target="_blank" download class="download-button">
                                                <i class="bx bx-cloud-download"></i>
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="text-center mb-3">
                            <h5> No Bills Available</h5>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end row-->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script src="<?php echo e(URL::asset('build/libs/prismjs/prism.js')); ?>"></script>
<script src="<?php echo e(URL::asset('build/libs/list.js/list.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('build/libs/glightbox/js/glightbox.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('build/libs/isotope-layout/isotope.pkgd.min.js')); ?>"></script>
<!-- <script src="<?php echo e(URL::asset('build/js/pages/gallery.init.js')); ?>"></script> -->
<script src="<?php echo e(URL::asset('build/libs/list.pagination.js/list.pagination.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('build/libs/sweetalert2/sweetalert2.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('build/js/app.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\master\resources\views/expenses/show.blade.php ENDPATH**/ ?>