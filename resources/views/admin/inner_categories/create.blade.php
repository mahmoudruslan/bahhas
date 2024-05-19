@extends('layouts.admin.master')
@section('title')
    {{ __('Add Category') }}
@endsection
@section('content')
    <!-- Nested Row within Card Body -->
    <div class="row">
        {{-- <div class="col-lg-5 d-none d-lg-block bg-register-image"></div> --}}
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
                <h1 class="h4 text-gray-900 mb-4">{{ __('Add Category') }}</h1>
            </div>
            <form class="user insubmit" method="POST" action="{{ route('admin.inner_categories.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <input type="text" class="form-control form-control-user" placeholder="{{ __('Enter Name_ar') }}"
                        name="name_ar">
                    @error('name_ar')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <input type="text" class="form-control form-control-user" placeholder="{{ __('Enter Name_en') }}"
                        name="name_en">
                    @error('name_en')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <input type="file" class="form-control" placeholder="{{ __('Enter Photo') }}" name="photo">
                    @error('photo')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <select name="category_id" class="form-control @error('category_id') is-invalid @enderror">
                        <option disabled selected>{{ __('Enter Category') }}</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ __($category['name_' . app()->getLocale()]) }}</option>
                        @endforeach
                    </select>
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
