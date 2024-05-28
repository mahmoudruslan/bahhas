@extends('layouts.admin.master')
@section('title')
    {{ __('Add parent category') }}
@endsection
@section('content')
    <!-- Nested Row within Card Body -->
    <div class="row">
        <div class="p-5 col-lg-12">
            <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">{{ __('Add parent category') }}</h1>
            </div>
            <form method="POST" action="{{ route('admin.parent-categories.store') }}"
                enctype="multipart/form-data">
                @csrf
                <div class="form-group row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="form-group"><input type="text" class="form-control form-control-user"
                                id="exampleFirstName" placeholder="{{ __('Name in arabic') }}" name="name_ar"
                                value="{{ old('name_ar') }}">
                            @error('name_ar')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group"><input type="text" class="form-control form-control-user"
                                id="exampleFirstName" placeholder="{{ __('Name in english') }}" name="name_en"
                                value="{{ old('name_en') }}">
                            @error('name_en')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <select name="type" class="form-control">
                                <option selected disabled>{{ __('Choose role') }}</option>
                                <option value="products">{{ __('Products') }}</option>
                                <option value="services">{{ __('Services') }}</option>
                            </select>
                            @error('role')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>{{ __('Choose image') }}</label>
                            <input type="file" name="cover"><br>
                            @error('cover')
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
