@extends('layouts.admin.master')
@section('title')
{{ __('Add Products') }}
@endsection
@section('content')

    <div class="row">
        <div class="p-5 col-lg-12">
            @if (Session::has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ __(Session::get('success')) }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <div class="text-center">
            </div>
            <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">{{ __('Add Products') }}</h1>
            </div>
            <form class="user insubmit" method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
                @csrf
                @if(isset($product))
                <input type="hidden" name="product_id" value="{{$product->id}}">
                @endif
                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <input type="text" class="form-control form-control-user" id="exampleFirstName"
                            placeholder="{{ __('Enter Name_ar') }}" name="name_ar">
                        @error('name_ar')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-sm-6">
                        <input type="text" class="form-control form-control-user" id="name_en"
                            placeholder="{{ __('Enter Name_en') }}" name="name_en">
                        @error('name_en')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    
                    <div class="col-sm-6">
                        <input type="text" class="form-control form-control-user" id="exampleinput"
                        placeholder="{{ __('Enter Details_ar') }}" name="details_ar">
                    @error('details_ar')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>

                    {{-- <div class="col-sm-6">

                        <input type="text" class="form-control form-control-user" id="exampleinput"
                        placeholder="{{__('Unit')}}" name="unit">
                    @error('unit')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div> --}}
{{-- 

                </div>
                <div class="form-group row"> --}}
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <input type="text" class="form-control form-control-user" id="details_en"
                            placeholder="{{ __('Enter Details_en') }}" name="details_en">
                        @error('details_en')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                {{-- <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="number" class="form-control form-control-user" id="discount_price"
                        placeholder="{{ __('Enter Discount Rate') }} (%)" name="discount_price">
                    @error('discount_price')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div> --}}
            </div>
                {{-- <div class="form-group row">
                    <div class="col-sm-6">
                        <input type="text" class="form-control form-control-user" id="amount"
                            placeholder="{{ __('Enter Amount') }}" name="amount">
                        @error('amount')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-sm-6">
                        <input type="text" class="form-control form-control-user" id="price"
                            placeholder="{{ __('Enter Price') }}" name="price">
                        @error('price')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div> --}}

                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <select name="inner_category_id"
                            class="form-control @error('inner_category_id') is-invalid @enderror">
                            <option disabled selected>{{ __('Enter Category') }}</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ __($category['name_' . app()->getLocale()]) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-6">
                        <input type="file" class="form-control @error('photo') is-invalid @enderror"
                            name="photo">
                    </div>
                </div>

                <button type="submit" class="btn btn-primary btn-user btn-block">
                    {{ __('Submit') }}
                </button>
                <hr>
            </form>
        </div>
    </div>
@endsection

