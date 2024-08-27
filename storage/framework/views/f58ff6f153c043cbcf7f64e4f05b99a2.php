<header id="page-topbar">
    <div class="layout-width">
        <div class="navbar-header">
            <div class="d-flex">
                <!-- LOGO -->
                <div class="navbar-brand-box horizontal-logo">
                    <a href="index" class="logo logo-dark">
                        <span class="logo-sm">
                            <img src="<?php echo e(URL::asset('build/images/logo-sm.png')); ?>" alt="" height="22">
                        </span>
                        <span class="logo-lg">
                            <img src="<?php echo e(URL::asset('build/images/logo-dark.png')); ?>" alt="" height="17">
                        </span>
                    </a>

                    <a href="index" class="logo logo-light">
                        <span class="logo-sm">
                            <img src="<?php echo e(URL::asset('build/images/logo-sm.png')); ?>" alt="" height="22">
                        </span>
                        <span class="logo-lg">
                            <img src="<?php echo e(URL::asset('build/images/logo-light.png')); ?>" alt="" height="17">
                        </span>
                    </a>
                </div>

                <button type="button"
                    class="btn btn-sm px-3 fs-16 header-item vertical-menu-btn topnav-hamburger material-shadow-none"
                    id="topnav-hamburger-icon">
                    <span class="hamburger-icon">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                </button>
            </div>


          
           
            <div class="d-flex align-items-center">
                  <!-- notifications -->
            <?php
                $notifyCount = Auth::user()->notifications()->count();
                $notifications = Auth::user()->notifications;
                $unreadNotifications = Auth::user()->unreadNotifications;
            ?>
                <div class="dropdown topbar-head-dropdown ms-1 header-item">
                    <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle" id="page-header-cart-dropdown" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-haspopup="true" aria-expanded="false">
                        <i class='fas fa-bell'></i>
                        <span class="position-absolute topbar-badge cartitem-badge fs-10 translate-middle badge rounded-pill bg-info">5</span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-xl dropdown-menu-end p-0 dropdown-menu-cart" aria-labelledby="page-header-cart-dropdown">
                        <div class="p-3 border-top-0 border-start-0 border-end-0 border-dashed border">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h6 class="m-0 fs-16 fw-semibold">Notifications</h6>
                                </div>
                            </div>
                        </div>
                        <div data-simplebar style="max-height: 300px;">
                            <div class="p-2">
                                <div class="text-center empty-cart <?php echo e(($notifyCount == 0) ?'d-block':'d-none'); ?>" id="empty-cart">
                                    <div class="avatar-md mx-auto my-3">
                                        <div class="avatar-title bg-transparent text-info fs-36">
                                        <img src="<?php echo e(URL::asset('build/images/svg/bell.svg')); ?>" class="img-fluid" alt="user-pic">
                                        </div>
                                    </div>
                                    <h5 class="mb-3">Hey! You have no any notifications</h5>
                                    <a href="#" class="btn btn-success w-md mb-3">Shop Now</a>
                                </div>
                                <?php $__currentLoopData = $notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="d-block dropdown-item dropdown-item-cart text-wrap px-3 py-2">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-bell me-3 rounded-circle bg-info-subtle p-3"></i>
                                        <div class="flex-grow-1">
                                            <h6 class="mt-0 mb-1 fs-14">
                                                <a href="<?php echo e(route('task.show' ,$notification->data['task_id'])); ?>" class="text-reset"> <?php echo e($notification->data['message']); ?></a>
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                        <!-- <div class="p-3 border-bottom-0 border-start-0 border-end-0 border-dashed border" id="checkout-elem">
                            <a href="apps-ecommerce-checkout" class="btn btn-success text-center w-100">
                                View All Notifications
                            </a>
                        </div> -->
                    </div>
                </div>
            <?php
            $notesCount = Auth::user()->notes()->count();
            $unreadNotifications = Auth::user()->unreadNotifications;
            $allNotes = Auth::user()->notes()->get();
            $starredNotes = Auth::user()->notes()->where('is_starred', true)->get();
            ?>
                <div class="dropdown topbar-head-dropdown ms-1 header-item" id="notificationDropdown">
                    <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle"
                        id="page-header-notifications-dropdown" data-bs-toggle="dropdown" data-bs-auto-close="outside"
                        aria-haspopup="true" aria-expanded="false">
                        <i class="far fa-sticky-note"></i>
                        <span
                            class="position-absolute topbar-badge fs-10 translate-middle badge rounded-pill bg-danger"><?php echo e($notesCount); ?><span
                                class="visually-hidden">unread messages</span></span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                        aria-labelledby="page-header-notifications-dropdown">
                        <div class="dropdown-head bg-secondary bg-pattern rounded-top">
                            <div class="p-3">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h6 class="m-0 fs-16 fw-semibold text-white"> Notes </h6>
                                    </div>
                                    <div class="col-auto dropdown-tabs">
                                        <span class="badge bg-light-subtle text-body fs-13"> <?php echo e($notesCount); ?>

                                            New</span>
                                    </div>
                                </div>
                            </div>

                            <div class="px-2 pt-2">
                                <ul class="nav nav-tabs dropdown-tabs nav-tabs-custom" data-dropdown-tabs="true"
                                    id="notificationItemsTab" role="tablist">
                                    <li class="nav-item waves-effect waves-light">
                                        <a class="nav-link active" data-bs-toggle="tab" href="#all-noti-tab" role="tab"
                                            aria-selected="true">
                                            All (<?php echo e($notesCount); ?>)
                                        </a>
                                    </li>
                                    <li class="nav-item waves-effect waves-light">
                                        <a class="nav-link" data-bs-toggle="tab" href="#alerts-tab" role="tab"
                                            aria-selected="false">
                                            Starred
                                        </a>
                                    </li>
                                </ul>
                            </div>

                        </div>

                        <div class="tab-content position-relative" id="notificationItemsTabContent">
                            <div class="tab-pane fade show active py-2 ps-2" id="all-noti-tab" role="tabpanel">
                                <div data-simplebar style="max-height: 300px;" class="pe-2">


                                    <?php $__currentLoopData = $allNotes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $note): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="text-reset notification-item d-block dropdown-item position-relative">
                                            <div class="d-flex">
                                                <div class="avatar-xs me-3 flex-shrink-0">
                                                    <span
                                                        class="avatar-title bg-info-subtle text-info rounded-circle fs-16">
                                                        <i class="fas fa-pen"></i> <!-- You can change the icon -->
                                                    </span>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <a href="#!" class="stretched-link">
                                                        <h6 class="mt-0 mb-2 lh-base"><?php echo e($note->title); ?></h6>
                                                    </a>
                                                    <p class="mb-0 fs-11 fw-medium text-uppercase text-muted">
                                                        <span><i class="mdi mdi-clock-outline"></i>
                                                            <?php echo e($note->created_at->diffForHumans()); ?></span>
                                                    </p>
                                                </div>
                                                <!-- <div class="px-2 fs-15">
                                                    <div class="form-check notification-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="note-check-<?php echo e($note->id); ?>">
                                                        <label class="form-check-label"
                                                            for="note-check-<?php echo e($note->id); ?>"></label>
                                                    </div>
                                                </div> -->
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <div class="my-3 text-center view-all">
                                        <a href="<?php echo e(route('notes')); ?>"
                                            class="btn btn-soft-success waves-effect waves-light">View
                                            All Notes <i class="ri-arrow-right-line align-middle"></i></a>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade p-2" id="alerts-tab" role="tabpanel" aria-labelledby="alerts-tab">
                                <div data-simplebar style="max-height: 300px;" class="pe-2">
                                    <?php $__currentLoopData = $starredNotes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $note): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="text-reset notification-item d-block dropdown-item position-relative">
                                            <div class="d-flex">
                                                <div class="avatar-xs me-3 flex-shrink-0">
                                                    <span
                                                        class="avatar-title bg-warning-subtle text-warning rounded-circle fs-16">
                                                        <i class="fas fa-star"></i> <!-- Starred icon -->
                                                    </span>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <a href="#!" class="stretched-link">
                                                        <h6 class="mt-0 mb-2 lh-base"><?php echo e($note->title); ?></h6>
                                                    </a>
                                                    <p class="mb-0 fs-11 fw-medium text-uppercase text-muted">
                                                        <span><i class="mdi mdi-clock-outline"></i>
                                                            <?php echo e($note->created_at->diffForHumans()); ?></span>
                                                    </p>
                                                </div>
                                                <!-- <div class="px-2 fs-15">
                                                    <div class="form-check notification-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="starred-note-check-<?php echo e($note->id); ?>">
                                                        <label class="form-check-label"
                                                            for="starred-note-check-<?php echo e($note->id); ?>"></label>
                                                    </div>
                                                </div> -->
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="dropdown ms-sm-3 header-item topbar-user ">
                    <button type="button" class="btn material-shadow-none" id="page-header-user-dropdown"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="d-flex align-items-center">
                            <img class="rounded-circle header-profile-user"
                                src="<?php if(Auth::user()->avatar != ''): ?><?php echo e(URL::asset('public/images/' . Auth::user()->avatar)); ?><?php else: ?><?php echo e(URL::asset('build/images/users/avatar-1.jpg')); ?><?php endif; ?>"
                                alt="Header Avatar">
                            <span class="text-start ms-xl-2">
                                <span
                                    class="d-none d-xl-inline-block ms-1 fw-medium user-name-text"><?php echo e(Auth::user()->name); ?></span>
                            </span>
                        </span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <!-- item-->
                        <h6 class="dropdown-header">Welcome <?php echo e(Auth::user()->name); ?>!</h6>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?php echo e(route('settings')); ?>"><i class="fas fa-user me-2"></i> <span
                                class="align-middle">Profile</span></a>
                        <a class="dropdown-item " href="javascript:void();"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                                class="fas fa-power-off me-2"></i> <span
                                key="t-logout"><?php echo app('translator')->get('translation.logout'); ?></span></a>
                        <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                            <?php echo csrf_field(); ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header><?php /**PATH C:\xampp\htdocs\master\resources\views/layouts/topbar.blade.php ENDPATH**/ ?>