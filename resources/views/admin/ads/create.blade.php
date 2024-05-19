@extends('layouts.admin.master')
@section('title')
{{__('Add ads')}}
@endsection
@section('content')
    <!-- Nested Row within Card Body -->
    <div class="row">
        @if (Session::has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ Session::get('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="col"></div>
            <div class="p-5 col-md-6">
                <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">{{__('Link')}}</h1>
                </div>
                <form class="user insubmit" method="POST" action="{{ route('admin.ads.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" placeholder="{{__('Enter Link')}}" name="target">
                        @error('target')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="file" class="form-control @error('photo') is-invalid @enderror" placeholder="{{__('Ad Photo')}}" name="photo">
                    </div>
                    <button type="submit" class="btn btn-primary btn-user btn-block">
                        {{ __('Submit') }}
                    </button>
                    <hr>
                </form>
            </div>
            <div class="col"></div>

    </div>
@endsection
