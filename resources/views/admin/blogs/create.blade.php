@extends('layouts.admin.master')
@section('title')
    {{ __('Add to blog') }}
@endsection
@section('content')
    <!-- Nested Row within Card Body -->
    <div class="row">
        <div class="p-5 col-lg-12">
            <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">{{ __('Add to blog') }}</h1>
            </div>
            <form method="POST" action="{{ route('admin.blogs.store') }}"
                enctype="multipart/form-data">
                @csrf
                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <input type="text" class="form-control form-control-user"
                                id="exampleFirstName" placeholder="{{ __('Title in arabic') }}" name="title_ar"
                                value="{{ old('title_ar') }}">
                            @error('title_ar')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div>
                    <div class="col-sm-6">
                        <input type="text" class="form-control form-control-user"
                                id="exampleFirstName" placeholder="{{ __('Title in english') }}" name="title_en"
                                value="{{ old('title_en') }}">
                            @error('title_en')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div>
                </div>
                <div class="form-group row">

                    <div class="col-sm-6">
                        <textarea placeholder="{{ __('Description in arabic') }}" name="description_ar" 
                        class="form-control" >{{old('description_ar')}}</textarea>
                        @error('description_ar')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <textarea placeholder="{{ __('Description in english') }}" name="description_en" 
                        class="form-control" >{{old('description_en')}}</textarea>
                        @error('description_en')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                
                <div class="form-group row">
                    <div class="col-sm-6">
                        <input type="file" class="form-control @error('image') is-invalid @enderror" name="image">
                    </div>
                    <div class="col-sm-6">
                        
                        <select name="blog_id" class="form-control">
                            <option selected disabled>{{ __('Choose blog') }} ({{__('Related')}})</option>
                            @foreach ($blogs as $blog)
                                <option value="{{ $blog->id }}">{{ $blog['title_'. app()->getLocale()] }}</option>
                            @endforeach
                        </select>
                        @error('blog_id')
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
