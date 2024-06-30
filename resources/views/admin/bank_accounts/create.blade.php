@extends('layouts.admin.master')
@section('title')
    {{ __('Add bank account') }}
@endsection
@section('content')
    <!-- Nested Row within Card Body -->
    <div class="row">
        <div class="p-5 col-lg-12">
            <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">{{ __('Add bank account') }}</h1>
            </div>
            <form method="POST" action="{{ route('admin.bank-accounts.store') }}"
                enctype="multipart/form-data">
                @csrf
                <div class="form-group row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="form-group"><input type="text" class="form-control form-control-user"
                                id="exampleFirstName" placeholder="{{ __('Account owner') }}" name="owner"
                                value="{{ old('owner') }}">
                            @error('owner')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user"
                                id="exampleFirstName" placeholder="{{ __('Account number') }}" name="number"
                                value="{{ old('number') }}">
                            @error('number')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user"
                                id="exampleFirstName" placeholder="{{ __('IBAN number') }}" name="IBAN_number"
                                value="{{ old('IBAN_number') }}">
                            @error('IBAN_number')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3"></div>
                </div>
                <hr>
                <button type="submit" class="btn btn-primary btn-user btn-block">
                    {{ __('Submit') }}
                </button>
            </form>
        </div>
    </div>
@endsection
