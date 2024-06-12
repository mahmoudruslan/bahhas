@extends('layouts.admin.master')
@section('title')
    {{ __('Edit sliders') }}
@endsection
@section('content')
    <div class="row">
        <div class="p-5 col-lg-12">
            <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">{{ __('Edit data') }} : {{ $slider['title_' . app()->getLocale()] }}</h1>
            </div>
            <form class="user insubmit" method="POST" action="{{ route('admin.sliders.update', $slider->id) }}"
                enctype="multipart/form-data">
                @method('patch')
                @csrf
                <div class="form-group row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="form-group"><input type="text" class="form-control form-control-user"
                                id="exampleFirstName" placeholder="{{ __('Title in arabic') }}" name="title_ar"
                                value="{{ $slider->title_ar }}">
                            @error('title_ar')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user" id="exampleFirstName"
                                placeholder="{{ __('Title in english') }}" name="title_en" value="{{ $slider->title_en }}">
                            @error('title_en')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user" id="exampleFirstName"
                                placeholder="{{ __('Url') }}" name="url" value="{{ $slider->url }}">
                            @error('url')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <select class="form-control" name="status">
                                <option value="{{ $slider->status }}">{{ __($slider->status()) }}</option>
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
                                value="{{ $slider->details_ar }}">
                            @error('details_ar')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user" id="exampleFirstName"
                                placeholder="{{ __('Details in english') }}" name="details_en"
                                value="{{ $slider->details_en }}">
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
