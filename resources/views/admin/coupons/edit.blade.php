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
        <a style="margin-left: 20px" href="{{ route('admin.coupons.index') }}" class="btn btn-secondary btn-icon-split">
            <span class="icon text-white-50">
                <i class="fas fa-arrow-right"></i>
            </span>
            <span class="text">{{ __('Coupons') }}</span>
        </a><br><br>
        <div class="text-center">
            <h1 class="h4 text-gray-900 mb-4">{{ __('Edit Data') }}</h1>
        </div>
        <form class="user" method="POST" action="{{ route('admin.coupons.update', $coupon->id) }}">
            @csrf
            @method('patch')
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <input value="{{ $coupon->code }}" type="text" class="form-control form-control-user"
                        id="exampleFirstName" placeholder="{{ __('Code') }}" name="code">
                    @error('code')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-sm-6">
                    <input value="{{ $coupon->value }}" type="text" class="form-control form-control-user"
                        placeholder="{{ __('Value') }}-{{(__('Percentage'))}}" name="value">
                    @error('value')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-6">
                    <input value="{{ $coupon->start_date }}" type="date" class="form-control form-control-user"
                        id="exampleinput" placeholder="{{ __('Start date') }}" name="start_date">
                    @error('start_date')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <input value="{{ $coupon->expire_date }}" type="date" class="form-control form-control-user"
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
                    <input value="{{ $coupon->description_ar }}" type="text" class="form-control form-control-user"
                        id="description_ar" placeholder="{{ __('Description in arabic') }}" name="description_ar">
                    @error('description_ar')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-sm-6">
                    <input value="{{ $coupon->description_en }}" type="text" class="form-control form-control-user"
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
                    <input value="{{ $coupon->use_times }}" type="text" class="form-control form-control-user"
                        placeholder="{{ __('Use times') }}" name="use_times">
                    @error('use_times')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-sm-6">
                    <input value="{{ $coupon->greater_than }}" type="text" class="form-control form-control-user"
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
                        <option value="{{$coupon->status}}">{{__($coupon->status())}}</option>
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
