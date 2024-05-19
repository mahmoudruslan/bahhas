@extends('layouts.admin.master')
@section('title')
    {{ __('Edit Data') }}
@endsection
@section('content')
@section('style')
    <style>
        .pt-10 {
            padding-top: 5rem;
        }
    </style>
@endsection
<!-- Nested Row within Card Body -->
<div class="row">
    <div class="p-5  col-lg-12">
        @if (Session::has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ __(Session::get('success')) }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <a style="margin-left: 20px" href="{{ route('admin.orders.show', $order->id) }}"
            class="btn btn-secondary btn-icon-split mb-4">
            <span class="icon text-white-50">
                <i class="fas fa-arrow-right"></i>
            </span>
            <span class="text">{{ __('Order') }}</span>
        </a>
        <div class="text-center">
            <h1 class="h4 text-gray-900 mb-4">{{ __('Edit Order') }}</h1>
        </div>

        <form class="insubmit" method="POST" action="{{route('admin.orders.update', $order->id)}}">
        @csrf
        @method('patch')
        <select name="status" class="custom-select form-control mb-4 @error('status') is-invalid @enderror">
            <option disabled selected>{{ $order->status }}</option>
            <option value="0">{{ __('Acceptance') }}</option>
            <option value="1">{{ __('Rejection') }}</option>
            <option value="2">{{ __('To fail') }}</option>
            <option value="3">{{ __('Pending') }}</option>
            <option value="4">{{ __('Delivery') }}</option>
            <option value="5">{{ __('Successfully delivered') }}</option>
        </select>
        <button type="submit" class="btn btn-primary btn-user btn-block">
            {{ __('Submit') }}
        </button>
        </form>
        

    </div>
</div>
@endsection
