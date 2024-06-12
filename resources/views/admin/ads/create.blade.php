@extends('layouts.admin.master')
@section('title')
    {{ __('Add ad') }}
@endsection
@section('content')
    <!-- Nested Row within Card Body -->
    <div class="row">
        <div class="p-5 col-lg-12">
            <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">{{ __('Add ad') }}</h1>
            </div>
            <form method="POST" action="{{ route('admin.ads.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="form-group"><input type="text" class="form-control form-control-user"
                                id="exampleFirstName" placeholder="{{ __('Title in arabic') }}" name="title_ar"
                                value="{{ old('title_ar') }}">
                            @error('title_ar')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user" id="exampleFirstName"
                                placeholder="{{ __('Title in english') }}" name="title_en" value="{{ old('title_en') }}">
                            @error('title_en')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user" id="exampleFirstName"
                                placeholder="{{ __('Url') }}" name="url" value="{{ old('url') }}">
                            @error('url')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <select class="form-control" name="status">
                                <option selected disabled>{{ __('Status') }}</option>
                                <option value="1">{{ __('Active') }}</option>
                                <option value="0">{{ __('Inactive') }}</option>
                            </select>
                            @error('status')
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
                        <div class="form-group"><input type="text" class="form-control form-control-user"
                            id="exampleFirstName" placeholder="{{ __('Details in arabic') }}" name="details_ar"
                            value="{{ old('details_ar') }}">
                        @error('details_ar')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="exampleFirstName"
                            placeholder="{{ __('Details in english') }}" name="details_en" value="{{ old('details_en') }}">
                        @error('details_en')
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
