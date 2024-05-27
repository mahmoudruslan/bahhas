@extends('layouts.admin.master')
@section('title')
    {{ __('Edit Data') }}
@endsection
@section('content')
    <!-- Nested Row within Card Body -->
    <div class="row text-center">
        {{-- <div class="col-lg-5 d-none d-lg-block bg-register-image"></div> --}}
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
                <h1 class="h4 text-gray-900 mb-4">{{ __('Edit Data') }}</h1>
            </div>
            <form class="user insubmit" method="POST" action="{{ route('admin.categories.update', $category->id) }}" enctype="multipart/form-data">
                @csrf
                @method('patch')
                <input name="edit" type="hidden" value="true">

                <div class="form-group">
                    <input value="{{ $category->name_ar }}" type="text" class="form-control form-control-user"
                        id="exampleinput" placeholder="Category Name" name="name_ar">
                    @error('name_ar')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <input value="{{ $category->name_en }}" type="text" class="form-control form-control-user"
                        id="exampleinput" placeholder="Category Name" name="name_en">
                    @error('name_en')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <input type="file" class="form-control" placeholder="{{__('Enter Photo')}}" name="photo">
                    @error('photo')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
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
