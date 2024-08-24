
<?php $__env->startSection('title'); ?>
<?php echo e($employee->user->name); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
<link href="<?php echo e(URL::asset('build/select2/css/select2.min.css')); ?>" rel="stylesheet" type="text/css" />
<!-- <link rel="stylesheet" href="<?php echo e(URL::asset('build/libs/glightbox/css/glightbox.min.css')); ?>"> -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-xxl-12">
        <div class="card ">
            <div class="card-header">
                <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-bs-toggle="tab" href="#employeeDetails" role="tab">
                            <i class="fas fa-user"></i> Employee Details
                        </a>
                    </li>
                    <?php if($employee->passbook || $employee->pan_file || $employee->adhar_file): ?>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#documents" role="tab">
                            <i class="far fa-file"></i> Documents
                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if($expenses->isNotEmpty()): ?>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#bills" role="tab">
                            <i class="fas fa-file-pdf"></i> Bills
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
            <div class="card-body p-4">
                <div class="tab-content">
                    <div class="tab-pane active" id="employeeDetails" role="tabpanel">
                        <div class="row">
                            <div class="col-sm-6 d-flex flex-column mb-md-10 mb-3">
                                <label for="name" class=" ">Full Name</label>
                                <input type="text" name="name" id="name" readonly class="form-control"
                                    value="<?php echo e($employee->user->name); ?>">
                            </div>
                            <div class="col-sm-6 d-flex flex-column mb-md-10 mb-3">
                                <label for="name" class="">Email</label>
                                <input type="text" name="email" id="email" readonly class="form-control"
                                    value="<?php echo e($employee->user->email); ?>">
                            </div>
                            <div class="col-sm-6 d-flex flex-column mb-md-10 mb-3">
                                <label for="name" class="">Department</label>
                                <input type="text" name="department" id="department" readonly class="form-control"
                                    value="<?php echo e($employee->department->name); ?>">
                            </div>
                            <div class="col-sm-6 d-flex flex-column mb-md-10 mb-3">
                                <label for="name" class=" ">Contact</label>
                                <input type="text" name="contact" id="contact" readonly class="form-control"
                                    value="<?php echo e($employee->contact); ?>">
                            </div>
                            <div class="col-sm-6 d-flex flex-column mb-md-10 mb-3">
                                <label for="name" class=" ">Phone No.</label>
                                <input type="text" name="phone" id="phone" readonly class="form-control"
                                    value="<?php echo e($employee->alt_contact); ?>">
                            </div>
                            <div class="col-sm-6 d-flex flex-column mb-md-10 mb-3">
                                <label for="name" class="">Country</label>
                                <input type="text" name="country" id="country" readonly class="form-control"
                                    value="<?php echo e($country->name ?? ''); ?>">
                            </div>
                            <div class="col-sm-6 d-flex flex-column mb-md-10 mb-3">
                                <label for="name" class="">State</label>
                                <input type="text" name="state" id="state" readonly class="form-control"
                                    value="<?php echo e($state->name ?? ''); ?>">
                            </div>
                            <div class="col-sm-6 d-flex flex-column mb-md-10 mb-3">
                                <label for="name" class="">City</label>
                                <input type="text" name="city" id="city" readonly class="form-control"
                                    value="<?php echo e($city->name ?? ''); ?>">
                            </div>
                            <div class="col-sm-6 d-flex flex-column mb-md-10 mb-3">
                                <label for="name" class="">Address</label>
                                <textarea readonly class="form-control" name="address"
                                    id="address"><?php echo e($employee->address); ?></textarea>
                            </div>
                            <div class="col-sm-6 d-flex flex-column mb-md-10 mb-3">
                                <label for="name" class="">Note</label>
                                <input type="text" name="pincode" id="pincode" readonly class="form-control"
                                    value="<?php echo e($employee->pincode); ?>">
                            </div>
                            <div class="col-sm-6 d-flex flex-column mb-md-10 mb-3">
                                <label for="name" class="">PAN</label>
                                <input type="text" name="pan" id="pan" readonly class="form-control"
                                    value="<?php echo e($employee->pan); ?>">
                            </div>
                            <div class="col-sm-6 d-flex flex-column mb-md-10 mb-3">
                                <label for="name" class="">Adhar</label>
                                <input type="text" name="pan" id="pan" readonly class="form-control"
                                    value="<?php echo e($employee->adhar); ?>">
                            </div>
                            <div class="col-sm-6 d-flex flex-column mb-md-10 mb-3">
                                <label for="name" class="">Account Holder Name</label>
                                <input type="text" name="pan" id="pan" readonly class="form-control"
                                    value="<?php echo e($employee->acc_holder_name); ?>">
                            </div>
                            <div class="col-sm-6 d-flex flex-column mb-md-10 mb-3">
                                <label for="name" class="">Account Number</label>
                                <input type="text" name="pan" id="pan" readonly class="form-control"
                                    value="<?php echo e($employee->acc_number); ?>">
                            </div>
                            <div class="col-sm-6 d-flex flex-column mb-md-10 mb-3">
                                <label for="name" class="">IFSC Code</label>
                                <input type="text" name="pan" id="pan" readonly class="form-control"
                                    value="<?php echo e($employee->ifsc); ?>">
                            </div>
                            <div class="col-sm-6 d-flex flex-column mb-md-10 mb-3">
                                <label for="name" class="">Bank Name</label>
                                <input type="text" name="pan" id="pan" readonly class="form-control"
                                    value="<?php echo e($employee->bank_name); ?>">
                            </div>
                            <!--end col-->
                        </div>
                        <!--end row-->
                        </form>
                    </div>
                    <!--end tab-pane-->
                    <div class="tab-pane" id="documents" role="tabpanel">
                        <div class="row">
                            <?php if($employee->pan_file): ?>
                                <div class="card me-3" style="width: 18rem;">
                                    <a class="image-popup" target="_blank"
                                        href="<?php echo e(URL::asset('public/images/uploads/documents/' . $employee->pan_file)); ?>" title="">
                                        <?php if(pathinfo($employee->pan_file, PATHINFO_EXTENSION) == 'pdf'): ?>
                                            <img class="gallery-img img-fluid mx-auto card-img-top"
                                                src="<?php echo e(URL::asset('build/images/pdf-icon.png')); ?>" alt="PDF Document" />
                                        <?php else: ?>
                                            <img class="gallery-img img-fluid mx-auto card-img-top"
                                                src="<?php echo e(URL::asset('public/images/uploads/documents/' . $employee->pan_file)); ?>"
                                                alt="PAN Document" />
                                        <?php endif; ?>
                                        <div class="gallery-overlay mt-3">
                                            <h5 class="overlay-caption">PAN Card</h5>
                                        </div>
                                    </a>
                                    <div class="card-body">
                                        <div class="d-flex align-items-center mt-1">
                                            <?php if(pathinfo($employee->pan_file, PATHINFO_EXTENSION) !== 'pdf'): ?>
                                                <div class="flex-grow-1 text-muted">
                                                    <a href="<?php echo e(URL::asset('public/images/uploads/documents/' . $employee->pan_file)); ?>"
                                                        target="_blank" download class="download-button">
                                                        <i class="bx bx-cloud-download"></i>
                                                    </a>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php if($employee->adhar_file): ?>
                                <div class="card me-3" style="width: 18rem;">
                                    <a class="image-popup" target="_blank"
                                        href="<?php echo e(URL::asset('public/images/uploads/documents/' . $employee->adhar_file)); ?>"
                                        title="">
                                        <?php if(pathinfo($employee->adhar_file, PATHINFO_EXTENSION) == 'pdf'): ?>
                                            <img class="gallery-img img-fluid mx-auto card-img-top"
                                                src="<?php echo e(URL::asset('build/images/pdf-icon.png')); ?>" alt="PDF Document" />
                                        <?php else: ?>
                                            <img class="gallery-img img-fluid mx-auto card-img-top"
                                                src="<?php echo e(URL::asset('public/images/uploads/documents/' . $employee->adhar_file)); ?>"
                                                alt="PAN Document" />
                                        <?php endif; ?>
                                        <div class="gallery-overlay mt-3">
                                            <h5 class="overlay-caption">Aadhar Card</h5>
                                        </div>
                                    </a>
                                    <div class="card-body">
                                        <div class="d-flex align-items-center mt-1">
                                            <?php if(pathinfo($employee->adhar_file, PATHINFO_EXTENSION) !== 'pdf'): ?>
                                                <div class="flex-grow-1 text-muted">
                                                    <a href="<?php echo e(URL::asset('public/images/uploads/documents/' . $employee->adhar_file)); ?>"
                                                        target="_blank" download class="download-button">
                                                        <i class="bx bx-cloud-download"></i>
                                                    </a>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php if($employee->passbook): ?>
                                <div class="card me-3" style="width: 18rem;">
                                    <a class="image-popup" target="_blank"
                                        href="<?php echo e(URL::asset('public/images/uploads/documents/' . $employee->passbook)); ?>" title="">
                                        <?php if(pathinfo($employee->passbook, PATHINFO_EXTENSION) == 'pdf'): ?>
                                            <img class="gallery-img img-fluid mx-auto card-img-top"
                                                src="<?php echo e(URL::asset('build/images/pdf-icon.png')); ?>" alt="PDF Document" />
                                        <?php else: ?>
                                            <img class="gallery-img img-fluid mx-auto card-img-top"
                                                src="<?php echo e(URL::asset('public/images/uploads/documents/' . $employee->passbook)); ?>"
                                                alt="PAN Document" />
                                        <?php endif; ?>
                                        <div class="gallery-overlay mt-3 ">
                                            <h5 class="overlay-caption">Passbook</h5>
                                        </div>
                                    </a>
                                    <div class="card-body">
                                        <div class="d-flex align-items-center mt-1">
                                            <?php if(pathinfo($employee->passbook, PATHINFO_EXTENSION) !== 'pdf'): ?>
                                                <div class="flex-grow-1 text-muted">
                                                    <a href="<?php echo e(URL::asset('public/images/uploads/documents/' . $employee->passbook)); ?>"
                                                        target="_blank" download class="download-button">
                                                        <i class="fas fa-download"></i>
                                                    </a>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <!--end tab-pane-->

                    <div class="tab-pane" id="bills" role="tabpanel">
                        <div class="row">
                            <?php $__currentLoopData = $expenses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $expense): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($expense->bill_file): ?>
                                    <div class="card me-3" style="width: 18rem;">
                                        <a class="image-popup" target="_blank"
                                            href="<?php echo e(URL::asset('public/images/uploads/bills/' . $expense->bill_file)); ?>" title="">
                                            <?php if(pathinfo($expense->bill_file, PATHINFO_EXTENSION) == 'pdf'): ?>
                                                <img class="gallery-img img-fluid mx-auto card-img-top"
                                                    src="<?php echo e(URL::asset('build/images/pdf-icon.png')); ?>" alt="PDF Document" />
                                            <?php else: ?>
                                                <img class="gallery-img img-fluid mx-auto card-img-top"
                                                    src="<?php echo e(URL::asset('public/images/uploads/bills/' . $expense->bill_file)); ?>"
                                                    alt="PAN Document" />
                                            <?php endif; ?>
                                            <div class="gallery-overlay mt-3 ">
                                                <h5 class="overlay-caption"><?php echo e(\Carbon\Carbon::parse($expense->created_at)->format('d/m/Y')); ?></h5>
                                            </div>
                                        </a>
                                        <div class="card-body">
                                            <div class="d-flex align-items-center mt-1">
                                                <?php if(pathinfo($expense->bill_file, PATHINFO_EXTENSION) !== 'pdf'): ?>
                                                    <div class="flex-grow-1 text-muted">
                                                        <a href="<?php echo e(URL::asset('public/images/uploads/bills/' . $expense->bill_file)); ?>"
                                                            target="_blank" download class="download-button">
                                                            <i class="bx bx-cloud-download"></i>
                                                        </a>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
<!-- <script src="<?php echo e(URL::asset('build/libs/glightbox/js/glightbox.min.js')); ?>"></script> -->
<!-- <script src="<?php echo e(URL::asset('build/libs/isotope-layout/isotope.pkgd.min.js')); ?>"></script> -->
<!-- <script src="<?php echo e(URL::asset('build/js/pages/gallery.init.js')); ?>"></script> -->
<script src="<?php echo e(URL::asset('build/libs/list.pagination.js/list.pagination.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('build/libs/sweetalert2/sweetalert2.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('build/js/app.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\master\resources\views/employee/show.blade.php ENDPATH**/ ?>