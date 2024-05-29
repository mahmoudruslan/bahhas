@extends('layouts.admin.master')
@section('title')
    {{ __('Add coupons') }}
@endsection
@section('content')
    <div class="row">
        <div class="p-5 col-lg-12">
            <div class="text-center">
            </div>
            <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">{{ __('Add coupons') }}</h1>
            </div>
            <form class="user insubmit" method="POST" action="{{ route('admin.coupons.store') }}"
                enctype="multipart/form-data">
                @csrf
                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <input value="{{ old('code') }}" type="text" class="form-control form-control-user"
                            id="exampleFirstName" placeholder="{{ __('Code') }}" name="code">
                        @error('code')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-sm-6">
                        <input value="{{ old('value') }}" type="text" class="form-control form-control-user"
                            placeholder="{{ __('Value') }}" name="value">
                        @error('value')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <input value="{{ old('start_date') }}" type="date" class="form-control form-control-user"
                            id="exampleinput" placeholder="{{ __('Start date') }}" name="start_date">
                        @error('start_date')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <input value="{{ old('expire_date') }}" type="date" class="form-control form-control-user"
                            placeholder="{{ __('Expire date') }}" name="expire_date">
                        @error('expire_date')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <input value="{{ old('description_ar') }}" type="text" class="form-control form-control-user"
                            id="description_ar" placeholder="{{ __('Description in arabic') }}" name="description_ar">
                        @error('description_ar')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-sm-6">
                        <input value="{{ old('description_en') }}" type="text" class="form-control form-control-user"
                            placeholder="{{ __('Description in english') }}" name="description_en">
                        @error('description_en')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <input value="{{ old('use_times') }}" type="text" class="form-control form-control-user"
                            placeholder="{{ __('Use times') }}" name="use_times">
                        @error('use_times')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-sm-6">
                        <input value="{{ old('greater_than') }}" type="text" class="form-control form-control-user"
                            placeholder="{{ __('Greater than') }}" name="greater_than">
                        @error('greater_than')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                
                <div class="form-group row">
                    <div class="col-sm-6">
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
                <button type="submit" class="btn btn-primary btn-user btn-block">
                    {{ __('Submit') }}
                </button>
                <hr>
            </form>
        </div>
    </div>
@endsection
