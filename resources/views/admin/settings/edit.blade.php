@extends('layouts.admin.master')
@section('title')
    {{ __('Edit settings') }}
@endsection
@section('content')
    <div class="row">
        <div class="p-5 col-lg-12">
            <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">{{ __('Edit data') }} : {{ $setting->key }}</h1>
            </div>
            <form class="user insubmit" method="POST" action="{{ route('admin.settings.update', $setting->id) }}"
                enctype="multipart/form-data">
                @method('patch')
                @csrf
                <div class="form-group row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user" id="exampleFirstName"
                                placeholder="{{ __('Title in english') }}" name="value" value="{{ $setting->value }}">
                            @error('value')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <hr>
                        <button type="submit" class="btn btn-primary btn-user btn-block">
                            {{ __('Submit') }}
                        </button>
                    </div>
                    <div class="col-md-3"></div>
                </div>
            </form>
        </div>
    </div>
@endsection
