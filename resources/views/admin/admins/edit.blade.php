@extends('layouts.admin.master')
@section('title')
    {{ __('Edit Data') }}
@endsection
@section('content')
    <!-- Nested Row within Card Body -->
    <div class="row">
        {{-- <div class="col-lg-5 d-none d-lg-block bg-register-image"></div> --}}
            <div class="p-5  col-lg-12">
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
                <form class="user insubmit" method="POST" action="{{ route('admin.admins.update', $admin->id) }}">
                    @csrf
                    @method('patch')
                    <input name="edit" type="hidden" value="true">
                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <input value="{{ $admin->name }}" type="text" class="form-control form-control-user"
                                id="exampleFirstName" placeholder="{{__('Name')}}" name="name">

                            @error('name')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-sm-6">
                            <input value="{{ $admin->email }}" type="email" class="form-control form-control-user"
                                id="exampleLastName" placeholder="{{__('Email')}}" name="email">
                            @error('email')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <input value="{{ $admin->address }}" type="text" class="form-control form-control-user"
                            id="exampleinput" placeholder="{{__('Address')}}" name="address">
                        @error('address')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <input value="{{ $admin->phone }}" type="number" class="form-control form-control-user"
                                id="exampleinput" placeholder="{{__('Phone Number')}}" name="phone">
                            @error('phone')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-sm-6">
                            <input type="password" class="form-control form-control-user" id="exampleRepeatPassword"
                                placeholder="{{__('Password')}}" name="password">
                            @error('password')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-user btn-block">
                        {{ __('Submit') }}
                    </button>
                </form>
                <hr>
            </div>
        </div>
@endsection
