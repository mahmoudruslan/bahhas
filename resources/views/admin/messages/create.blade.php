@extends('layouts.admin.master')
@section('title')
    {{ __('Add Notification') }}
@endsection
@section('content')
    <!-- Nested Row within Card Body -->
    <div class="row">
        {{-- <div class="col-lg-5 d-none d-lg-block bg-register-image"></div> --}}
        @if (Session::has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ __(Session::get('success')) }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="p-5 col-lg-12">
            <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">{{ __('Add Notification Message') }}</h1>
            </div>
            <form id="form" class="user insubmit" method="post" action="{{ route('admin.messages.store') }}">
                @csrf
                <div class="form-group row">
                    <div class="col-sm-12 mb-3 mb-sm-0">
                        <textarea id="content" style="min-height: 108px" class="form-control-user form-control" name="content">
                        </textarea>
                        @error('content')
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
