@extends('layouts.admin.master')
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Content Row -->
        <div class="row">
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-4 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">

                            <div class="col mr-2">
                                <a class="text-decoration-none" href="{{ route('admin.admins.index') }}">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        <h6 class="font-weight-bold">{{ __('Users Count') }}</h6>
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ App\Models\Customer::count() }}
                                    </div>
                                </a>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-users fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <a class="text-decoration-none" href="{{ route('admin.products.index') }}">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        <h6 class="font-weight-bold">{{ __('Product Count') }}</h6>
                                    </div>
                                </a>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ App\Models\Product::count() }}</div>
                            </div>
                            <div class="col-auto">
                                <h2><i class="fas fa-fw fa-wrench  text-gray-300"></i></h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">

                            <div class="col mr-2">
                                <a class="text-decoration-none" href="{{ route('admin.orders.index') }}">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                        <h6 class="font-weight-bold">{{ __('Orders Count') }}</h6>
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ App\Models\Order::count() }}
                                    </div>
                                </a>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-users fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="col-xl-3 col-md-6 mb-4"></div> --}}
        </div>
        <div class="row">
            <!-- Content Column -->
            <div class="col-lg-12 mb-4">
                <!-- Project Card Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">{{ __('Orders Status') }}</h6>
                    </div>
                    <div class="card-body">
                        <h4 class="small font-weight-bold">{{ __('Accepted Orders') }} <span
                                class="float-left">{{ $data['percentage_of_acceptance'] }}</span>
                            ({{ __('Number') . ' : ' . $data['acceptance_count'] }}) </h4>
                        <div class="progress">
                            <div class="progress-bar bg-primary" role="progressbar"
                                style="width: {{ $data['percentage_of_acceptance'] }}" aria-valuenow="100"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div><br>
                        <h4 class="small font-weight-bold">{{ __('Pending review') }} <span
                                class="float-left">{{ $data['rejection_percentage'] }}</span>
                            ({{ __('Number') . ' : ' . $data['rejection_count'] }}) </h4>
                        <div class="progress mb-4">
                            <div class="progress-bar bg-dark" role="progressbar"
                                style="width: {{ $data['rejection_percentage'] }}" aria-valuenow="40" aria-valuemin="0"
                                aria-valuemax="100"></div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
