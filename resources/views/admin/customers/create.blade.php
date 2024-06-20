@extends('layouts.admin.master')
@section('title')
    {{ __('Add customer') }}
@endsection
@section('content')
    <div class="row">
        <div class="p-5 col-lg-12">
            <div class="text-center">
            </div>
            <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">{{ __('Add customer') }}</h1>
            </div>
            <form class="user insubmit" method="POST" action="{{ route('admin.customers.store') }}"
                enctype="multipart/form-data">
                @csrf
                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <input  value="{{old('first_name')}}"  type="text" class="form-control form-control-user" id="exampleFirstName"
                            placeholder="{{ __('First name') }}" name="first_name">
                        @error('first_name')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-sm-6">
                        <input  value="{{old('last_name')}}" type="text" class="form-control form-control-user"
                            placeholder="{{ __('Enter last name') }}" name="last_name">
                        @error('last_name')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <input  value="{{old('email')}}"  type="email" class="form-control form-control-user" id="exampleFirstName"
                            placeholder="{{ __('Email') }}" name="email">
                        @error('email')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">

                    <div class="col-sm-6">
                        <input  value="{{old('phone')}}" type="text" class="form-control form-control-user" id="exampleinput"
                            placeholder="{{ __('Enter phone') }}" name="phone">
                        @error('phone')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <select class="form-control" name="status">
                            <option selected disabled>{{__('Status')}}</option>
                            <option value="1">{{__('Active')}}</option>
                            <option value="0">{{__('Inactive')}}</option>
                        </select>
                        @error('status')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <input  type="file" class="form-control @error('image') is-invalid @enderror" name="image">
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
