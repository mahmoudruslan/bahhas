@extends('layouts.admin.master')
@section('title')
    {{ __('Edit blogs') }}
@endsection
@section('content')
    <div class="row">
        <div class="p-5 col-lg-12">
            <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">{{ __('Edit data') }} : {{ $blog['title_'. app()->getLocale()] }}</h1>
            </div>
            <form class="user insubmit" method="POST" action="{{ route('admin.blogs.update', $blog->id) }}"
                enctype="multipart/form-data">
                @method('patch')
                @csrf
                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <input type="text" class="form-control form-control-user"
                                id="exampleFirstName" placeholder="{{ __('Title in arabic') }}" name="title_ar"
                                value="{{ $blog->title_ar }}">
                            @error('title_ar')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div>
                    <div class="col-sm-6">
                        <input type="text" class="form-control form-control-user"
                                id="exampleFirstName" placeholder="{{ __('Title in english') }}" name="title_en"
                                value="{{ $blog->title_en }}">
                            @error('title_en')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div>
                </div>
                <div class="form-group row">

                    <div class="col-sm-6">
                        <textarea placeholder="{{ __('description in arabic') }}" name="description_ar" 
                        class="form-control" >{{$blog->description_ar}}</textarea>
                        @error('description_ar')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <textarea placeholder="{{ __('Enter Description_en') }}" name="description_en" 
                        class="form-control" >{{$blog->description_en}}</textarea>
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
                            <option selected disabled>{{ __('Choose blog') }}</option>
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
