<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="{{ route('root') }}" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ URL::asset('build/images/logo-sm.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ URL::asset('build/images/logo-dark.png') }}" alt="" height="17">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="{{ route('root') }}" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ URL::asset('public/images/uploads/'.$settings['app-fevicon']) }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ URL::asset('public/images/uploads/'.$settings['app-logo']) }}" alt="" width="200px"  height="36">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
            id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>



    <div id="scrollbar" data-simplebar="init" class="h-100 simplebar-scrollable-y">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span>@lang('translation.menu')</span></li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('root') }}" >
                    <i class="fas fa-circle-notch"></i> <span>Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('clients') }}" >
                    <i class="fas fa-users"></i> <span>Clients</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('serviceCategories') }}" >
                    <i class="fas fa-layer-group"></i> <span>Service Categories</span>
                    </a>
                </li>
                @can('View Departments')
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('departments') }}" >
                    <i class="fas fa-grip-vertical"></i> <span>Departments</span>
                    </a>
                </li>
                @endcan
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('employees') }}" >
                    <i class="fas fa-user-tie"></i> <span>Employees</span>
                    </a>
                </li>
                @can('View Tasks')
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('tasks') }}" >
                    <i class="fas fa-tasks"></i> <span>Tasks</span>
                    </a>
                </li>
                @endcan
                @can('View Task Notes')
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('taskNotes') }}" >
                    <i class="far fa-file"></i><span>Task Notes</span>
                    </a>
                </li>
                @endcan
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('invoices') }}" >
                    <i class="fas fa-file-invoice"></i> <span>Invoices</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('payments') }}" >
                    <i class="fas fa-dollar-sign"></i> <span>Payments</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('categories') }}" >
                    <i class="fas fa-sitemap"></i> <span>Categories</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('taxes') }}" >
                    <i class="fas fa-coins"></i> <span>Taxes</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('products') }}" >
                    <i class="fas fa-tag"></i> <span>Products</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('expenseCategories') }}" >
                    <i class="fas fa-network-wired"></i> <span>Expense Categories</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('expenses') }}" >
                    <i class="fas fa-list"></i> <span>Expenses</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('notes') }}" >
                    <i class="far fa-sticky-note"></i> <span>Notes</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('app-settings') }}" >
                    <i class="fas fa-wrench"></i> <span>Settings</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('roles') }}" >
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
<div class="vertical-overlay"></div>