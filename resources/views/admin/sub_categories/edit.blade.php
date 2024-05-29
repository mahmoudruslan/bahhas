@extends('layouts.admin.master')
@section('title')
    {{ __('Edit sub categories') }}
@endsection
@section('content')
    <div class="row">
        <div class="p-5 col-lg-12">
            <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">{{ __('Edit data') }} : {{ $sub_category['name_'. app()->getLocale()] }}</h1>
            </div>
            <form class="user insubmit" method="POST" action="{{ route('admin.sub-categories.update', $sub_category->id) }}"
                enctype="multipart/form-data">
                @method('patch')
                @csrf
                <div class="form-group row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="form-group"><input type="text" class="form-control form-control-user"
                                id="exampleFirstName" placeholder="{{ __('Name in arabic') }}" name="name_ar"
                                value="{{ $sub_category->name_ar }}">
                            @error('name_ar')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user"
                                id="exampleFirstName" placeholder="{{ __('Name in english') }}" name="name_en"
                                value="{{ $sub_category->name_en }}">
                            @error('name_en')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <select name="category_id" class="form-control">
                                <option selected value="{{$sub_category->category_id}}">{{ $sub_category->category['name_' . app()->getLocale()] }}</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category['name_'. app()->getLocale()] }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
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
