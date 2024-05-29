@extends('layouts.admin.master')
@section('title')
    {{ __('Add Products') }}
@endsection
@section('content')
    <div class="row">
        <div class="p-5 col-lg-12">
            <div class="text-center">
            </div>
            <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">{{ __('Add products') }}</h1>
            </div>
            <form class="user insubmit" method="POST" action="{{ route('admin.products.store') }}"
                enctype="multipart/form-data">
                @csrf
                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <input  value="{{old('name_ar')}}"  type="text" class="form-control form-control-user" id="exampleFirstName"
                            placeholder="{{ __('Name in arabic') }}" name="name_ar">
                        @error('name_ar')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-sm-6">
                        <input  value="{{old('name_en')}}" type="text" class="form-control form-control-user" id="name_en"
                            placeholder="{{ __('Name in english') }}" name="name_en">
                        @error('name_en')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">

                    <div class="col-sm-6">
                        <input  value="{{old('details_ar')}}" type="text" class="form-control form-control-user" id="exampleinput"
                            placeholder="{{ __('Description in arabic') }}" name="details_ar">
                        @error('details_ar')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <input  value="{{old('details_en')}}" type="text" class="form-control form-control-user" id="details_en"
                            placeholder="{{ __('Description in english') }}" name="details_en">
                        @error('details_en')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <input  value="{{old('quantity')}}" type="text" class="form-control form-control-user" id="quantity"
                            placeholder="{{ __('Quantity') }}" name="quantity">
                        @error('quantity')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-sm-6">
                        <input  value="{{old('price')}}" type="text" class="form-control form-control-user" id="price"
                            placeholder="{{ __('Price') }}" name="price">
                        @error('price')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                @livewire('cascading-dropdown', ['categories'=> $categories, null])
                <div class="form-group row">
                    <div class="col-sm-6">
                        <input  type="file" class="form-control @error('image') is-invalid @enderror" name="image">
                    </div>
                    <div class="col-sm-6">
                        <input  value="{{old('first_appearing')}}" type="number"
                            class="form-control 
                        @error('first_appearing') is-invalid @enderror"
                            name="first_appearing" placeholder="{{ __('First appearing') }}">
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
