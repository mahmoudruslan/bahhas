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
                <h1 class="h4 text-gray-900 mb-4">{{ __('Order details') }}</h1>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered text-center yajra-datatable" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-center">{{ __('Order number') }}</th>
                            <th class="text-center">{{ __('Customer Name') }}</th>
                            <th class="text-center">{{ __('Status') }}</th>
                            <th class="text-center">{{ __('Price') }}</th>
                            <th class="text-center">{{ __('Paid') }}</th>
                            <th class="text-center">{{ __('Coupon') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$order->order_nr}}</td>
                            <td>{{$order->customer['fullName']}}</td>
                            <td>{{$order->status}}</td>
                            <td>{{$order->price}}</td>
                            <td>{{$order->paid}}</td>
                            <td>{{$order->coupne ?? '-'}}</td>
                        </tr>
                    </tbody>
                </table>
                <table class="table table-bordered text-center yajra-datatable" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th colspan="7" class="text-center">{{__('required products')}}</th>
                        </tr>
                    </thead>
                    <thead>
                        <tr>
                            <th class="text-center">{{ __('#') }}</th>
                            <th class="text-center">{{ __('Product') }}</th>
                            <th class="text-center">{{ __('Price') }}</th>
                            <th class="text-center">{{ __('Quantity') }}</th>
                            <th class="text-center">{{ __('Total') }}</th>
                            <th class="text-center">{{ __('Attach') }}</th>
                            <th class="text-center">{{ __('Notes') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->products as $key => $product)
                        <tr>
                            <td>{{$loop->index + 1}}</td>
                            <td>{{$product['name_' . app()->getLocale()]}}</td>
                            <td>{{$product->price}}</td>
                            <td>{{$product->quantity}}</td>
                            <td>{{$product->total}}</td>
                            <td>
                                @if ($product->attach)
                                <a href="{{route('admin.orders.download.attach', $product->id)}}">{{__('Download the pdf!') }}</a>
                                @else
                                {{__('No attach')}}
                                @endif
                            </td>
                            <td>{{$product->notes ?? '-'}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
