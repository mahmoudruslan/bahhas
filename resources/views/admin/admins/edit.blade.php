@extends('layouts.admin.master')
@section('title')
    {{ __('Edit admins') }}
@endsection
@section('content')
    <div class="row">
        <div class="p-5 col-lg-12">
            <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">{{ __('Edit data') }} : {{ $admin->first_name }}</h1>
            </div>
            <form class="user insubmit" method="POST" action="{{ route('admin.admins.update', $admin->id) }}"
                enctype="multipart/form-data">
                @method('patch')
                @csrf
                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <input type="text" class="form-control form-control-user" id="exampleFirstName"
                            placeholder="{{ __('First name') }}" name="first_name" value="{{ $admin->first_name }}">
                        @error('first_name')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <input type="text" class="form-control form-control-user" id="exampleFirstName"
                            placeholder="{{ __('Last name') }}" name="last_name" value="{{ $admin->last_name }}">
                        @error('last_name')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <input type="email" class="form-control form-control-user" id="exampleLastName"
                            placeholder="{{ __('Email') }}" name="email" value="{{ $admin->email }}">
                        @error('email')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-sm-6">
                        <input type="password" class="form-control form-control-user" id="exampleRepeatPassword"
                            placeholder="{{ __('Password') }}" name="password">
                        @error('password')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <input type="number" class="form-control form-control-user" id="exampleInputPassword"
                            placeholder="{{ __('Phone Number') }}" name="mobile" value="{{ $admin->mobile }}">
                        @error('mobile')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <select name="role" class="form-control form-control-user">
                            <option selected disabled>{{ __('Choose role') }}</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->name }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                        @error('role')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <textarea class="form-control form-control-user" placeholder="{{ __('Address') }}" name="address"
                        style="border-radius: 4px">{{ $admin->address }}</textarea>
                    @error('address')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="row">
                    {{-- <div class="col-sm-6 mt-2">
                        <label>{{ __('Status') }}</label>
                        <input type="checkbox" class="form-control-user" value="1" name="status">
                        @error('status')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div> --}}
                    <div class="col-md-6">
                        <label>{{ __('Choose image') }}</label>
                        <input type="file" name="image"><br>
                        @error('image')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <hr>
                <button type="submit" class="btn btn-primary btn-user btn-block">
                    {{ __('Submit') }}
                </button>
            </form>
        </div>
    </div>
@endsection
