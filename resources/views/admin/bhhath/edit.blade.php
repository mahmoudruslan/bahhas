@extends('layouts.admin.master')
@section('title')
    {{ __('Bhhath') }}
@endsection
@section('content')
    <div class="row">
        <div class="p-5 col-lg-12">
            <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">{{ __('Edit contact information') }}</h1>
            </div>
            <form class="user insubmit" method="POST" action="{{ route('admin.bhhath.update', $bhhath->id) }}"
                enctype="multipart/form-data">
                {{-- @method('patch') --}}
                @csrf
                <div class="form-group row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user" id="exampleFirstName"
                                placeholder="{{ __('facebook_link') }}" name="facebook_link" value="{{ $bhhath->facebook_link }}">
                            @error('facebook_link')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group"><input type="text" class="form-control form-control-user"
                            id="exampleFirstName" placeholder="{{ __('Title in arabic') }}" name="youtube_link"
                            value="{{ $bhhath->youtube_link }}">
                        @error('youtube_link')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="exampleFirstName"
                            placeholder="{{ __('Title in english') }}" name="X_link" value="{{ $bhhath->X_link }}">
                        @error('X_link')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="exampleFirstName"
                            placeholder="{{ __('instagram_link') }}" name="instagram_link" value="{{ $bhhath->instagram_link }}">
                        @error('instagram_link')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" name="brief_ar" placeholder="{{ __('Breif in arabic') }}">
                            {{ $bhhath->brief_ar }}
                        </textarea>
                    @error('brief_ar')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                        <textarea class="form-control" name="brief_en" placeholder="{{ __('Breif in english') }}">
                            {{ $bhhath->brief_en }}
                        </textarea>
                    @error('brief_en')
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
