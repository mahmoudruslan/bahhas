@extends('layouts.admin.master')
@section('title')
    {{ __('Product Types') }}
@endsection
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">{{ __('Product Types') }}</h1>
        <p class="mb-4"></p>
        <a style="margin-left: 20px" href="{{ route('admin.products.index') }}" class="btn btn-secondary btn-icon-split">
            <span class="icon text-white-50">
                <i class="fas fa-arrow-right"></i>
            </span>
            <span class="text">{{ __('Products') }}</span>
        </a><br><br>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            @if (Session::has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ __(Session::get('success')) }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @if (Session::has('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ __(Session::get('error')) }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <div class="card-body">
                <input type="hidden" id="lang" value="{{ app()->getLocale() }}">
                <div class="table-responsive">
                    <table class="table table-bordered text-center yajra-datatable" id="dataTable" width="100%"
                        cellspacing="0">
                        <div class="my-2"></div>
                        <form method="GET" action="{{ route('admin.product_types.create') }}">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <button type="submit" class="btn btn-success btn-icon-split">
                                <span class="icon text-white-50">
                                    <i class="fas fa-check"></i>
                                </span>
                                <span class="text">{{ __('Add Product Types') }}</span>
                            </button>
                        </form>
                        <br>
                        <div class="my-4"></div>
                        <thead>
                            <tr>
                                <th class="text-center">{{ __('#') }}</th>
                                <th class="text-center">{{ __('Name') }}</th>
                                <th class="text-center">{{ __('Category') }}</th>
                                <th class="text-center">{{ __('Price') }}</th>
                                {{-- <th class="text-center">{{ __('Discount Price') }}</th> --}}
                                <th class="text-center w-25">{{ __('Details') }}</th>
                                <th class="text-center">{{ __('Amount') }}</th>
                                <th class="text-center">{{ __('Unit') }}</th>
                                <th class="text-center">{{ __('First Appearing') }}</th>
                                <th class="text-center">{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($product_types as $product_type)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $product_type['name_' . app()->getLocale()] }}</td>
                                    <td>{{ $product_type->category['name_' . app()->getLocale()] }}</td>
                                    <td>{{ $product_type->price }}</td>
                                    {{-- <td>{{ $product_type->discount_price ?? __('without discount') }}</td> --}}
                                    <td>{{ $product_type['details_' . app()->getLocale()] }}</td>
                                    <td>{{ $product_type->amount }}</td>
                                    <td>{{ $product_type->unit }}</td>
                                    <td>{{ $product_type->first_appearing }}</td>
                                    <td>

                                        <a class="btn btn-info btn-circle"
                                            href="{{ route('admin.product_types.edit', $product_type->id) }}">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a class="btn btn-warning btn-circle"
                                            href="{{ route('admin.product_types.show', $product_type->id) }}">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a class="btn btn-danger btn-circle" href="#"
                                            data-toggle="modal"data-target="#deletemodel{{ $product_type->id }}">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                        
                                        {{-- <a class="btn btn-secondary"
                                            href="{{ route('admin.product_types.show', $product_type->id) }}">
                                            {{ __('Types') }}
                                        </a> --}}
                                    </td>
                                </tr>
                                @include('admin.product_types.delete')
                            @endforeach
                        </tbody>
                    </table>
                    {{ $product_types->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
