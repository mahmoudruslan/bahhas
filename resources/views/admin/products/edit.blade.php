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
    <div class="p-5  col-lg-6">
        <a style="margin-left: 20px" href="{{ route('admin.products.index') }}" class="btn btn-secondary btn-icon-split">
            <span class="icon text-white-50">
                <i class="fas fa-arrow-right"></i>
            </span>
            <span class="text">{{ __('Products') }}</span>
        </a><br><br>
        @if (Session::has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ __(Session::get('success')) }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="text-center">
            <h1 class="h4 text-gray-900 mb-4">{{ __('Edit Data') }}</h1>
        </div>
        <form class="user" method="POST" action="{{ route('admin.products.update', $product->id) }}"
            enctype="multipart/form-data">
            @csrf
            @method('patch')
            <input name="edit" type="hidden" value="true">

            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <label style="font-size: 12px;margin-right: 13px">{{ __('Enter Name_ar') }}</label>
                    <input value="{{ $product->name_ar }}" type="text" class="form-control form-control-user"
                        id="exampleFirstName" placeholder="{{ __('Enter Name_ar') }}" name="name_ar">
                    @error('name_ar')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-sm-6">
                    <label style="font-size: 12px;margin-right: 13px">{{ __('Enter Name_en') }}</label>
                    <input value="{{ $product->name_en }}" type="text" class="form-control form-control-user"
                        id="name_en" placeholder="{{ __('Enter Name_en') }}" name="name_en">
                    @error('name_en')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label style="font-size: 12px;margin-right: 13px">{{ __('Enter Details_ar') }}</label>
                <input value="{{ $product->details_ar }}" type="text" class="form-control form-control-user"
                    id="exampleinput" placeholder="{{ __('Enter Details_ar') }}" name="details_ar">
                @error('details_ar')
                    <span class="text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group row">
                <div class="col md 6">
                    <label style="font-size: 12px;margin-right: 13px">{{ __('Enter Details_en') }}</label>
                    <input value="{{ $product->details_en }}" type="text" class="form-control form-control-user"
                        id="exampleFirstName" placeholder="{{ __('Enter Details_en') }}" name="details_en">
                    @error('details_en')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                {{-- <div class="col md 6">

                    <label style="font-size: 12px;margin-right: 13px">{{ __('Unit') }}</label>
                    <input value="{{ $product->unit }}" type="text" class="form-control form-control-user"
                        id="exampleFirstName" placeholder="ربطة" name="unit">
                    @error('unit')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div> --}}

            </div>
            {{-- <div class="form-group">

                <label style="font-size: 12px;margin-right: 13px">{{ __('Enter Discount Rate') }}</label>
                <input value="{{ $product->discount_rate == 100 . '%' ? null : $product->discount_rate }}"
                    type="number" class="form-control form-control-user" id="discount_price"
                    placeholder="{{ __('Enter Discount Rate') }} (%)" name="discount_price">
                @error('discount_price')
                    <span class="text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div> --}}
            {{-- <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <label style="font-size: 12px;margin-right: 13px">{{ __('Enter Amount') }}</label>
                    <input value="{{ $product->amount }}" type="text" class="form-control form-control-user"
                        id="exampleinput" placeholder="{{ __('Enter Amount') }}" name="amount">
                    @error('amount')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-sm-6">
                    <label style="font-size: 12px;margin-right: 13px">{{ __('Enter Price') }}</label>
                    <input value="{{ $product->price }}" type="text" class="form-control form-control-user"
                        id="price" placeholder="{{ __('Enter Price') }}" name="price">
                    @error('price')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div> --}}
            {{-- <div class="form-group">
                <label style="font-size: 12px;margin-right: 13px">{{ __('Enter who appears first') }}</label>
                <input value="{{ $product->price }}" type="number" class="form-control form-control-user"
                    id="first_appearing" placeholder="{{ __('Enter who appears first') }}" name="first_appearing">
            </div> --}}
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <label
                        style="font-size: 12px;margin-right: 13px">{{ __('Inner Category') }}</label>

                    <select name="inner_category_id"
                        class="custom-select form-control @error('inner_category_id') is-invalid @enderror">
                        <option value="{{ $product->category->id }}" selected>
                            {{ __($product->category['name_' . app()->getLocale()]) }}
                        </option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ __($category['name_' . app()->getLocale()]) }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-6">
                    <label style="font-size: 12px;margin-right: 13px">{{ __('Photo') }}</label>

                    <input type="file" class="form-control @error('photo') is-invalid @enderror" name="photo">
                </div>
            </div>
            <button type="submit" class="btn btn-primary btn-user btn-block">
                {{ __('Submit') }}
            </button>
        </form>
        <hr>
        @if ($product->product_id == null)
        <form class="insubmit" method="GET" action="{{ route('admin.product_types.create') }}">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <button type="submit" class="btn btn-primary btn-user btn-block">
                <span class="icon text-white-50">
                    <i class="fas fa-check"></i>
                </span>
                <span class="text">{{ __('Add Product Types') }}</span>
            </button>
        </form><br>
        
        @if (count($product->products) > 0)
            <a href="{{ route('admin.product_types.all', $product->id) }}"

                class="btn btn-primary btn-user btn-block">
                {{ __('Product Types') }}
            </a>
        @endif
        @endif
    </div>
    <div class="col-lg-6 d-none d-lg-block pt-10"><img style="width: 90%; max-height: 100%;"
            src="{{ asset('images/products/' . $product->photo) }}"></div>
</div>
@endsection
