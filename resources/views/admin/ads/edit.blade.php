@extends('layouts.admin.master')
@section('title')
    {{ __('Edit Ad') }}
@endsection
@section('content')
    <div class="row text-center">
        <div class="col"></div>
        <div class="p-5  col-md-6">
            @if (Session::has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ __(Session::get('success')) }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">{{ __('Edit Ad') }}</h1>
            </div>
            <form class="user insubmit" method="POST" action="{{ route('admin.ads.update', $ad->id) }}" enctype="multipart/form-data">
                @csrf
                @method('patch')
                <div class="form-group">
                    <input value="{{ $ad->target }}" type="text" class="form-control form-control-user"
                        id="exampleinput" placeholder="Enter Link" name="target">
                    @error('target')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <input type="file" class="form-control" placeholder="{{__('Enter Photo')}}" name="photo">
                </div>
                <button type="submit" class="btn btn-primary btn-user btn-block">
                    {{ __('Submit') }}
                </button>
            </form>
            <hr>
        </div>
        <div class="col"></div>

    </div>
@endsection
