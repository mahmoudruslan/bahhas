@extends('layouts.admin.master')
@section('title')
    {{ __('Details service') }}
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
        <div class="p-5  col-lg-6">
            <a style="margin-left: 20px" href="{{ route('admin.services.index') }}" class="btn btn-secondary btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-arrow-right"></i>
                </span>
                <span class="text">{{ __('Services') }}</span>
            </a>
            <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">{{ __('Details service') }}</h1>
            </div>
            <table class="table table-striped">
                <tbody>
                    <tr>
                        <th scope="row">{{ __('Name') }}</th>
                        <td>{{ $product['name_' . app()->getLocale()] }}</td>
                    </tr>
                    <tr>
                        <th scope="row">{{ __('Category') }}</th>
                        <td>{{ $product->category['name_' . app()->getLocale()] }}</td>
                    </tr>

                    {{-- <tr>
                        <th scope="row">{{ __('Price') }}</th>
                        <td>{{ $product->price }}</td>
                    </tr> --}}
                    {{-- <tr>
                        <th scope="row">{{ __('Discount Price') }}</th>
                        <td>{{$product->discount_price}}</td>
                    </tr> --}}
                    {{-- <tr>
                        <th scope="row">{{ __('Amount') }}</th>
                        <td>{{ $product->amount }}</td>
                    </tr> --}}
                    <tr>
                        <th style="vertical-align: inherit;" scope="row">{{ __('Details') }}</th>
                        <td>{{ $product['details_' . app()->getLocale()] }}</td>
                    </tr>
                </tbody>
            </table>
            <div class="table-responsive">
            </div>
        </div>
        <div class="col-lg-5 pt-10 p-4"><img style="width: 90%; max-height: 90%;"
                src="{{ asset('images/products/' . $product->photo) }}"></div>
    </div>
@endsection
