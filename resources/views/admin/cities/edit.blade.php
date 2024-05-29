@extends('layouts.admin.master')
@section('title')
    {{ __('Edit categories') }}
@endsection
@section('content')
    <div class="row">
        <div class="p-5 col-lg-12">
            <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">{{ __('Edit data') }} : {{ $category['name_'. app()->getLocale()] }}</h1>
            </div>
            <form class="user insubmit" method="POST" action="{{ route('admin.categories.update', $category->id) }}"
                enctype="multipart/form-data">
                @method('patch')
                @csrf
                <div class="form-group row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="form-group"><input type="text" class="form-control form-control-user"
                                id="exampleFirstName" placeholder="{{ __('Name in arabic') }}" name="name_ar"
                                value="{{ $category->name_ar }}">
                            @error('name_ar')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user"
                                id="exampleFirstName" placeholder="{{ __('Name in english') }}" name="name_en"
                                value="{{ $category->name_en }}">
                            @error('name_en')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <select name="parent_category_id" class="form-control">
                                <option selected value="{{$category->parent_category_id}}">{{ $category->parent['name_' . app()->getLocale()] }}</option>
                                @foreach ($parent_categories as $parent_category)
                                    <option value="{{ $parent_category->id }}">{{ $parent_category['name_'. app()->getLocale()] }}</option>
                                @endforeach
                            </select>
                            @error('parent_category_id')
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
