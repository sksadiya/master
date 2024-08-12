<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="<?php echo e(route('root')); ?>" class="logo logo-dark">
            <span class="logo-sm">
                <img src="<?php echo e(URL::asset('build/images/logo-sm.png')); ?>" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="<?php echo e(URL::asset('build/images/logo-dark.png')); ?>" alt="" height="17">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="<?php echo e(route('root')); ?>" class="logo logo-light">
            <span class="logo-sm">
                <img src="<?php echo e(URL::asset('images/uploads/'.$settings['app-fevicon'])); ?>" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="<?php echo e(URL::asset('images/uploads/'.$settings['app-logo'])); ?>" alt="" width="200px"  height="36">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
            id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>



    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span><?php echo app('translator')->get('translation.menu'); ?></span></li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="<?php echo e(route('root')); ?>" >
                    <i class="fas fa-circle-notch"></i> <span>Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="<?php echo e(route('clients')); ?>" >
                    <i class="fas fa-users"></i> <span>Clients</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="<?php echo e(route('serviceCategories')); ?>" >
                    <i class="fas fa-layer-group"></i> <span>Service Categories</span>
                    </a>
                </li>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('View Departments')): ?>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="<?php echo e(route('departments')); ?>" >
                    <i class="fas fa-grip-vertical"></i> <span>Departments</span>
                    </a>
                </li>
                <?php endif; ?>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="<?php echo e(route('employees')); ?>" >
                    <i class="fas fa-user-tie"></i> <span>Employees</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="<?php echo e(route('invoices')); ?>" >
                    <i class="fas fa-file-invoice"></i> <span>Invoices</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="<?php echo e(route('payments')); ?>" >
                    <i class="fas fa-dollar-sign"></i> <span>Payments</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="<?php echo e(route('categories')); ?>" >
                    <i class="fas fa-sitemap"></i> <span>Categories</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="<?php echo e(route('taxes')); ?>" >
                    <i class="fas fa-coins"></i> <span>Taxes</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="<?php echo e(route('products')); ?>" >
                    <i class="fas fa-tag"></i> <span>Products</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="<?php echo e(route('expenseCategories')); ?>" >
                    <i class="fas fa-network-wired"></i> <span>Expense Categories</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="<?php echo e(route('expenses')); ?>" >
                    <i class="fas fa-list"></i> <span>Expenses</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="<?php echo e(route('app-settings')); ?>" >
                    <i class="fas fa-wrench"></i> <span>Settings</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="<?php echo e(route('roles')); ?>" >
                    <i class="fas fa-key"></i> <span>Roles & Permissions</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
    <div class="sidebar-background"></div>
</div>
<!-- Left Sidebar End -->
<!-- Vertical Overlay-->
<div class="vertical-overlay"></div><?php /**PATH C:\xampp\htdocs\master\resources\views/layouts/sidebar.blade.php ENDPATH**/ ?>