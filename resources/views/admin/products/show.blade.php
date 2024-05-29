@extends('layouts.admin.master')
@section('title')
    {{ __('Details Product') }}
@endsection

@section('content')
@php
    $lang = app()->getLocale();
@endphp
    <!-- Nested Row within Card Body -->
    <div class="row">
        <div class="p-5  col-lg-6">
            <div>
                <a style="margin-left: 20px" href="{{ route('admin.products.index') }}" class="btn btn-secondary btn-icon-split">
                    <span class="icon text-white-50">
                        <i class="fas fa-arrow-right"></i>
                    </span>
                    <span class="text">{{ __('Products') }}</span>
                </a>
            </div>
            <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">{{ __('Details product') }}</h1>
            </div>
            <table class="table table-striped">
                <tbody>
                    <tr>
                        <th scope="row">{{ __('First appearing') }}</th>
                        <td>{{ $product->first_appearing }}</td>
                    </tr>
                    <tr>
                        <th scope="row">{{ __('Name in arabic') }}</th>
                        <td>{{ $product->name_ar }}</td>
                    </tr>

                    <tr>
                        <th scope="row">{{ __('Name in english') }}</th>
                        <td>{{ $product->name_en }}</td>
                    </tr>
                    <tr>
                        <th scope="row">{{ __('Description in arabic') }}</th>
                        <td>{{$product->details_ar}}</td>
                    </tr>
                    <tr>
                        <th scope="row">{{ __('Description in english') }}</th>
                        <td>{{ $product->details_en }}</td>
                    </tr>
                    <tr>
                        <th scope="row">{{ __('Quantity') }}</th>
                        <td>{{ $product->quantity }}</td>
                    </tr>
                    <tr>
                        <th scope="row">{{ __('Price') }}</th>
                        <td>{{ $product->price }}</td>
                    </tr>
                    <tr>
                        <th scope="row">{{ __('Status') }}</th>
                        <td>{{ $product->status() }}</td>
                    </tr>
                    <tr>
                        <th scope="row">{{ __('Category') }}</th>
                        <td>{{ $product->category['name_' . $lang] }}</td>
                    </tr>
                    <tr>
                        <th scope="row">{{ __('Sub category') }}</th>
                        <td>{{ $product->subCategory['name_' . $lang] }}</td>
                    </tr>
                    <tr>
                        <th scope="row">{{ __('Created at') }}</th>
                        <td>{{ $product->created_at }}</td>
                    </tr>
                </tbody>
            </table>
            <div class="table-responsive">
            </div>
        </div>
        <div style="margin-top: 140px" class="col-lg-5">
            <img style="width: 90%;" src="{{ asset('storage/' . $product->image) }}"></div>
    </div>
@endsection
