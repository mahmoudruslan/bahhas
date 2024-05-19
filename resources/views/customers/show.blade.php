@extends('layouts.admin.master')
@section('title')
    {{ __('Orders') }}
@endsection
@section('style')
    <style>
        .pt-10 {
            padding-top: 3rem;
        }
    </style>
@endsection
@section('content')
    <!-- Nested Row within Card Body -->
    <div class="row">
        {{-- <div class="p-5  col-lg-7"> --}}
        <div class="p-5  col-lg-12">
            @if (Session::has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ __(Session::get('success')) }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <a style="margin-left: 20px" href="{{ route('admin.orders.index') }}" class="btn btn-secondary btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-arrow-right"></i>
                </span>
                <span class="text">{{ __('Orders') }}</span>
            </a>
            <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">{{ __('Details Order') }}</h1>
            </div>
            <div class="table-responsive">
                @foreach ($orders as $order)
                    <table class="table table-bordered text-center yajra-datatable" id="dataTable" width="100%"
                        cellspacing="0">
                        <thead>
                            <tr>
                                <th colspan="5" class="text-center alert-secondary">{{ __('Order') }} ({{ $loop->index + 1 }})</th>
                            </tr>
                            <tr>
                                <th class="text-center">{{ __('#') }}</th>
                                <th class="text-center">{{ __('Price') }}</th>
                                <th class="text-center">{{ __('Status') }}</th>
                                <th class="text-center">{{ __('Order Date') }}</th>
                                <th class="text-center">{{ __('Notes') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $order->price }}</td>
                                <td>{{ $order->status }}</td>
                                <td>{{ $order->created_at }}</td>
                                <td>{{ $order->notes }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table table-bordered text-center yajra-datatable" id="dataTable" width="100%"
                        cellspacing="0">
                        <thead>
                            <tr>
                                <th colspan="7" class="text-center alert-success">{{ __('Order Products') }}</th>
                            </tr>
                            <tr>
                                <th class="text-center">{{ __('#') }}</th>
                                <th class="text-center">{{ __('Name') }}</th>
                                <th class="text-center">{{ __('Quantity') }}</th>
                                <th class="text-center">{{ __('Price') }}</th>
                                {{-- <th class="text-center">{{ __('Discount Price') }}</th> --}}
                                <th class="text-center w-25">{{ __('Details') }}</th>
                                <th class="text-center">{{ __('Amount') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->products as $key => $product)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $order->productDetails[$key]->quantity }}</td>
                                    <td>{{ $product->price }}</td>
                                    {{-- <td>{{ $product->discount_price }}</td> --}}
                                    <td>{{ $product->details }}</td>
                                    <td>{{ $product->amount }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endforeach
            </div>
        </div>
    </div>
@endsection
