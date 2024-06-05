@extends('layouts.admin.master')
@section('title')
    {{ __('Contact me') }}
@endsection
@section('content')
    <div class="row">
        <div class="p-5 col-lg-12">
            <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">{{ __('Edit contact information') }}</h1>
            </div>
            <form class="user insubmit" method="POST" action="{{ route('admin.contact-me.update', $contact_me->id) }}"
                enctype="multipart/form-data">
                @csrf
                <div class="form-group row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="form-group"><input type="text" class="form-control form-control-user"
                                id="exampleFirstName" placeholder="{{ __('Title in arabic') }}" name="whatsapp_number"
                                value="{{ $contact_me->whatsapp_number }}">
                            @error('whatsapp_number')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="number" class="form-control form-control-user" id="exampleFirstName"
                                placeholder="{{ __('Title in english') }}" name="phone" value="{{ $contact_me->phone }}">
                            @error('phone')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control form-control-user" id="exampleFirstName"
                                placeholder="{{ __('email') }}" name="email" value="{{ $contact_me->email }}">
                            @error('email')
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
