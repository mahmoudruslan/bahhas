<body id="page-top" @if (app()->getLocale() == 'ar') style="direction: rtl;" @endif>

    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center"
                href="{{ route('admin.dashboard') }}">
                <div class="sidebar-brand-icon">
                    {{-- <i class="fas fa-laugh-wink"></i> --}}
                    <img style="width: 70px;" src="{{ asset('images/logo/white-lolooo.png') }}">
                </div>
                <div class="sidebar-brand-text mx-3">{{ __('Ecommerce Dashboard') }}</div>
            </a>
            <!-- Divider -->
            <hr class="sidebar-divider">
            <!-- Heading -->
            <div class="sidebar-heading">
                {{ __('Pages') }}
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            @if (count(App\Models\Customer::where('status', 'not active')->get()) > 0)
                <li class="nav-item">
                    <a class="nav-link collapsed" href="{{ route('customers.documentation') }}">
                        <span
                            class="badge badge-danger badge-counter">{{ count(App\Models\Customer::where('status', 'not active')->get()) }}</span>
                        <i class="fas fa-bell fa-fw"></i>

                        <span>{{ __('Unverified accounts') }}</span>
                    </a>
                </li>
            @endif

            <!-- admins -->
            @canany(['admins', 'store-admins', 'update-admins', 'show-admins', 'delete-admins'])
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseadmin"
                        aria-expanded="true" aria-controls="collapseTwo">
                        <i class="fas fa-fw fa-cog"></i>
                        <span>{{ __('Admins') }}</span>
                    </a>
                    <div id="collapseadmin" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" href="{{ route('admin.admins.index') }}">{{ __('Admins') }}</a>
                            <a class="collapse-item" href="{{ route('admin.admins.create') }}">{{ __('Add Admins') }}</a>
                        </div>
                    </div>
                </li>
            @endcanany

            <!-- parent categories -->
            @canany(['parent-categories', 'store-parent-categories', 'update-parent-categories',
                'show-parent-categories', 'delete-parent-categories'])
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse"
                        data-target="#collapseparentcategory" aria-expanded="true" aria-controls="collapseTwo">
                        <i class="fas fa-fw fa-folder"></i>
                        <span>{{ __('Parent categories') }}</span>
                    </a>
                    <div id="collapseparentcategory" class="collapse" aria-labelledby="headingTwo"
                        data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item"
                                href="{{ route('admin.parent-categories.index') }}">{{ __('Parent categories') }}</a>
                            <a class="collapse-item"
                                href="{{ route('admin.parent-categories.create') }}">{{ __('Add Parent category') }}</a>
                        </div>
                    </div>
                </li>
            @endcanany

            <!-- categories -->
            @canany(['categories', 'store-categories', 'update-categories', 'show-categories', 'delete-categories'])
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsecategory"
                        aria-expanded="true" aria-controls="collapseTwo">
                        <i class="fas fa-fw fa-folder"></i>
                        <span>{{ __('Categories') }}</span>
                    </a>
                    <div id="collapsecategory" class="collapse" aria-labelledby="headingTwo"
                        data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item"
                                href="{{ route('admin.categories.index') }}">{{ __('Categories') }}</a>
                            <a class="collapse-item"
                                href="{{ route('admin.categories.create') }}">{{ __('Add Category') }}</a>
                        </div>
                    </div>
                </li>
            @endcanany

            <!-- sub categories -->
            @canany(['sub-categories', 'store-sub-categories', 'update-sub-categories', 'show-sub-categories',
                'delete-sub-categories'])
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsesubcategory"
                        aria-expanded="true" aria-controls="collapseTwo">
                        <i class="fas fa-fw fa-folder"></i>
                        <span>{{ __('Sub categories') }}</span>
                    </a>
                    <div id="collapsesubcategory" class="collapse" aria-labelledby="headingTwo"
                        data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item"
                                href="{{ route('admin.sub-categories.index') }}">{{ __('Sub categories') }}</a>
                            <a class="collapse-item"
                                href="{{ route('admin.sub-categories.create') }}">{{ __('Add sub category') }}</a>
                        </div>
                    </div>
                </li>
            @endcanany

            <!-- Products -->
            @canany(['products', 'store-products', 'update-products', 'show-products', 'delete-products'])
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseproduct"
                        aria-expanded="true" aria-controls="collapseTwo">
                        <i class="fas fa-fw fa-table"></i>
                        <span>{{ __('Products') }}</span>
                    </a>
                    <div id="collapseproduct" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" href="{{ route('admin.products.index') }}">{{ __('Products') }}</a>
                            <a class="collapse-item"
                                href="{{ route('admin.products.create') }}">{{ __('Add Products') }}</a>
                        </div>
                    </div>
                </li>
            @endcanany
            <!-- services -->
            @canany(['services', 'store-services', 'update-services', 'show-services', 'delete-services'])
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseService"
                        aria-expanded="true" aria-controls="collapseTwo">
                        <i class="fas fa-fw fa-table"></i>
                        <span>{{ __('Service') }}</span>
                    </a>
                    <div id="collapseService" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" href="{{ route('admin.services.index') }}">{{ __('Service') }}</a>
                            <a class="collapse-item"
                                href="{{ route('admin.services.create') }}">{{ __('Add services') }}</a>
                        </div>
                    </div>
                </li>
            @endcanany
            <!-- revoews -->
            @canany(['reviews', 'store-reviews', 'update-reviews', 'show-reviews', 'delete-reviews'])
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsereviews"
                        aria-expanded="true" aria-controls="collapseTwo">
                        <i class="fas fa-fw fa-table"></i>
                        <span>{{ __('Reviews') }}</span>
                    </a>
                    <div id="collapsereviews" class="collapse" aria-labelledby="headingTwo"
                        data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" href="{{ route('admin.reviews.index') }}">{{ __('Reviews') }}</a>
                            <a class="collapse-item"
                                href="{{ route('admin.reviews.create') }}">{{ __('Add reviews') }}</a>
                        </div>
                    </div>
                </li>
            @endcanany
            <!-- coupons -->
            @canany(['coupons', 'store-coupons', 'update-coupons', 'show-coupons', 'delete-coupons'])
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsecoupon"
                        aria-expanded="true" aria-controls="collapseTwo">
                        <i class="fas fa-fw fa-table"></i>
                        <span>{{ __('Coupons') }}</span>
                    </a>
                    <div id="collapsecoupon" class="collapse" aria-labelledby="headingTwo"
                        data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" href="{{ route('admin.coupons.index') }}">{{ __('Coupons') }}</a>
                            <a class="collapse-item"
                                href="{{ route('admin.coupons.create') }}">{{ __('Add coupons') }}</a>
                        </div>
                    </div>
                </li>
            @endcanany
            <!-- orders -->
            @canany(['orders', 'store-orders', 'update-orders', 'show-orders', 'delete-orders'])
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                        aria-expanded="true" aria-controls="collapseUtilities">
                        <i class="fas fa-fw fa-wrench"></i>
                        <span>{{ __('Orders') }}</span>
                    </a>
                    <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                        data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">{{ __('Orders') }}</h6>
                            <a class="collapse-item" href="{{ route('admin.orders.index') }}">{{ __('Orders') }}</a>
                        </div>
                    </div>
                </li>
            @endcanany
            <!-- ads -->
            @canany(['ads', 'store-ads', 'update-ads', 'show-ads', 'delete-ads'])
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePagesads"
                        aria-expanded="true" aria-controls="collapsePages">
                        <i class="fas fa-ad fa-fw"></i>
                        <span>{{ __('Ads') }}</span>
                    </a>
                    <div id="collapsePagesads" class="collapse" aria-labelledby="headingPages"
                        data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" href="{{ route('admin.ads.index') }}">{{ __('Ads') }}</a>
                            <a class="collapse-item" href="{{ route('admin.ads.create') }}">{{ __('Add ads') }}</a>
                        </div>
                    </div>
                </li>
            @endcanany
            <!-- cities -->
            @canany(['cities', 'store-cities', 'update-cities', 'show-cities', 'delete-cities'])
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse"
                        data-target="#collapsePagesCities" aria-expanded="true" aria-controls="collapsePages">
                        <i class="fas fa-ad fa-fw"></i>
                        <span>{{ __('Cities') }}</span>
                    </a>
                    <div id="collapsePagesCities" class="collapse" aria-labelledby="headingPages"
                        data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" href="{{ route('admin.cities.index') }}">{{ __('Cities') }}</a>
                            <a class="collapse-item"
                                href="{{ route('admin.cities.create') }}">{{ __('Add Cities') }}</a>
                        </div>
                    </div>
                </li>
            @endcanany
            <!-- customers -->
            @canany(['customers', 'store-customers', 'update-customers', 'show-customers', 'delete-customers'])
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCustomer"
                        aria-expanded="true" aria-controls="collapseCustomer">
                        <i class="fas fa-users fa-fw"></i>

                        <span>{{ __('Customers') }}</span>
                    </a>
                    <div id="collapseCustomer" class="collapse" aria-labelledby="headingPages"
                        data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item"
                                href="{{ route('admin.customers.index') }}">{{ __('Customers') }}</a>
                            <a class="collapse-item"
                                href="{{ route('admin.customers.create') }}">{{ __('Add customers') }}</a>
                        </div>
                    </div>
                </li>
            @endcanany

            <!-- blogs -->
            @canany(['customers', 'store-blogs', 'update-blogs', 'show-blogs', 'delete-blogs'])
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBlog"
                        aria-expanded="true" aria-controls="collapseBlog">
                        <i class="fas fa-users fa-fw"></i>

                        <span>{{ __('Blogs') }}</span>
                    </a>
                    <div id="collapseBlog" class="collapse" aria-labelledby="headingPages"
                        data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item"
                                href="{{ route('admin.blogs.index') }}">{{ __('Blogs') }}</a>
                            <a class="collapse-item"
                                href="{{ route('admin.blogs.create') }}">{{ __('Add blogs') }}</a>
                        </div>
                    </div>
                </li>
            @endcanany
            <!-- Divider -->
            <hr class="sidebar-divider">
            <!-- Heading -->
            <div class="sidebar-heading">
                {{ __('Settings') }}
            </div>

            <!-- roles and permissions -->
            @canany(['roles', 'store-roles', 'update-roles', 'show-roles', 'delete-roles'])
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseRols"
                        aria-expanded="true" aria-controls="collapseRols">
                        <i class="fas fa-fw fa-wrench"></i>
                        <span>{{ __('Roles') }}</span>
                    </a>
                    <div id="collapseRols" class="collapse" aria-labelledby="headingRols"
                        data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">{{ __('Roles') }}</h6>
                            <a class="collapse-item"
                                href="{{ route('admin.permission-roles.index') }}">{{ __('Roles') }}</a>
                            <a class="collapse-item"
                                href="{{ route('admin.permission-roles.create') }}">{{ __('Add Roles') }}</a>
                        </div>
                    </div>
                </li>
            @endcanany


            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
