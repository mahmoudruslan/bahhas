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
                    {{-- <img style="width: 70px;" src="{{ asset('images/logo/white-lolooo.png') }}"> --}}
                </div>
                <div class="sidebar-brand-text mx-3">{{ __('Dashboard') }}</div>
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
            @can('admins')
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseadmin"
                        aria-expanded="true" aria-controls="collapseTwo">
                        <i class="fas fa-fw fa-cog"></i>
                        <span>{{ __('Admins') }}</span>
                    </a>
                    <div id="collapseadmin" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" href="{{ route('admin.admins.index') }}">{{ __('Admins') }}</a>
                            <a class="collapse-item" href="{{ route('admin.admins.create') }}">{{ __('Add admins') }}</a>
                        </div>
                    </div>
                </li>
            @endcan

            <!-- experts -->
            @can('experts')
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse"
                        data-target="#collapseparentcategory" aria-expanded="true" aria-controls="collapseTwo">
                        <i class="fas fa-fw fa-folder"></i>
                        <span>{{ __('Experts') }}</span>
                    </a>
                    <div id="collapseparentcategory" class="collapse" aria-labelledby="headingTwo"
                        data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item"
                                href="{{ route('admin.experts.index') }}">{{ __('Experts') }}</a>
                        </div>
                    </div>
                </li>
            @endcan

            <!-- categories -->
            @can('categories')
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
                                href="{{ route('admin.categories.create') }}">{{ __('Add category') }}</a>
                        </div>
                    </div>
                </li>
            @endcan

            <!-- sub categories -->
            @can('sub-categories')
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
            @endcan

            <!-- Products -->
            @can('products')
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
                                href="{{ route('admin.products.create') }}">{{ __('Add products') }}</a>
                        </div>
                    </div>
                </li>
            @endcan
            <!-- services -->
            @can('services')
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseService"
                        aria-expanded="true" aria-controls="collapseTwo">
                        <i class="fas fa-fw fa-table"></i>
                        <span>{{ __('Services') }}</span>
                    </a>
                    <div id="collapseService" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" href="{{ route('admin.services.index') }}">{{ __('Services') }}</a>
                            <a class="collapse-item"
                                href="{{ route('admin.services.create') }}">{{ __('Add services') }}</a>
                        </div>
                    </div>
                </li>
            @endcan
            <!-- revoews -->
            @can('reviews')
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
                            {{-- <a class="collapse-item"
                                href="{{ route('admin.reviews.create') }}">{{ __('Add reviews') }}</a> --}}
                        </div>
                    </div>
                </li>
            @endcan
            <!-- coupons -->
            @can('coupons')
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
            @endcan
            <!-- orders -->
            @can('orders')
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
            @endcan
            <!-- ads -->
            @can('ads')
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
            @endcan
            <!-- cities -->
            @can('cities')
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
                                href="{{ route('admin.cities.create') }}">{{ __('Add cities') }}</a>
                        </div>
                    </div>
                </li>
            @endcan
            {{-- <!-- customers -->
            @can(['customers', 'store-customers', 'update-customers', 'show-customers', 'delete-customers'])
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
            @endcan --}}

            <!-- blogs -->
            @can('blogs')
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
                                href="{{ route('admin.blogs.create') }}">{{ __('Add to blog') }}</a>
                        </div>
                    </div>
                </li>
            @endcan
            <!-- Divider -->
            <hr class="sidebar-divider">
            <!-- Heading -->
            <div class="sidebar-heading">
                {{ __('Settings') }}
            </div>

            <!-- roles and permissions -->
            @can('roles')
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
                                href="{{ route('admin.permission-roles.create') }}">{{ __('Add roles') }}</a>
                        </div>
                    </div>
                </li>
            @endcan
            @can('contact-me')
                <li class="nav-item">
                    <a class="nav-link collapsed" href="{{route('admin.contact-me.edit')}}">
                        <i class="fas fa-fw fa-wrench"></i>
                        <span>{{ __('Contact me') }}</span>
                    </a>
                </li>
            @endcan
            @can('bhhath')
                <li class="nav-item">
                    <a class="nav-link collapsed" href="{{route('admin.bhhath.edit')}}">
                        <i class="fas fa-fw fa-wrench"></i>
                        <span>{{ __('Bhhath') }}</span>
                    </a>
                </li>
            @endcan


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
