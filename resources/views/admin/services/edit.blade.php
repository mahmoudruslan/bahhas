@extends('layouts.admin.master')
@section('title')
    {{ __('Edit Data') }}
@endsection
@section('content')
@section('style')
    <style>
        .pt-10 {
            padding-top: 5rem;
        }
    </style>
@endsection
<!-- Nested Row within Card Body -->
<div class="row">
    <div class="p-5  col-lg-12">
        <a style="margin-left: 20px" href="{{ route('admin.services.index') }}" class="btn btn-secondary btn-icon-split">
            <span class="icon text-white-50">
                <i class="fas fa-arrow-right"></i>
            </span>
            <span class="text">{{ __('services') }}</span>
        </a><br><br>
        <div class="text-center">
            <h1 class="h4 text-gray-900 mb-4">{{ __('Edit Data') }}</h1>
        </div>
        <form class="user" method="POST" action="{{ route('admin.services.update', $product->id) }}"
            enctype="multipart/form-data">
            @csrf
            @method('patch')
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <input value="{{ $product->name_ar }}" type="text" class="form-control form-control-user"
                        id="exampleFirstName" placeholder="{{ __('Enter Name_ar') }}" name="name_ar">
                    @error('name_ar')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-sm-6">
                    <input value="{{ $product->name_en }}" type="text" class="form-control form-control-user"
                        id="name_en" placeholder="{{ __('Enter Name_en') }}" name="name_en">
                    @error('name_en')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="form-group row">

                <div class="col-sm-6">
                    <input value="{{ $product->details_ar }}" type="text" class="form-control form-control-user"
                        id="exampleinput" placeholder="{{ __('Enter Details_ar') }}" name="details_ar">
                    @error('details_ar')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="col-sm-6 mb-3 mb-sm-0">
                    <input value="{{ $product->details_en }}" type="text" class="form-control form-control-user"
                        id="details_en" placeholder="{{ __('Enter Details_en') }}" name="details_en">
                    @error('details_en')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-6">
                    <input value="{{ $product->quantity }}" type="text" class="form-control form-control-user"
                        id="quantity" placeholder="{{ __('Enter quantity') }}" name="quantity">
                    @error('quantity')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-sm-6">
                    <input value="{{ $product->price }}" type="text" class="form-control form-control-user"
                        id="price" placeholder="{{ __('Enter Price') }}" name="price">
                    @error('price')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-6">
                    <select name="category_id"
                        class="form-control select-radius 
                        @error('category_id') is-invalid @enderror">
                        <option value="{{ $product->category->id }}">{{ $product->category['name_' . app()->getLocale()] }}</option>
                        @foreach ($categories as $item)
                            <option value="{{ $item->id }}">{{ $item->name_ar }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <span class="text-danger" role="alert">
                            <small>{{ $message }}</small>
                        </span>
                    @enderror
                </div>
                <div class="col-sm-6">
                    <input value="{{ $product->first_appearing }}" type="number"
                        class="form-control 
                    @error('first_appearing') is-invalid @enderror"
                        name="first_appearing" placeholder="{{ __('First appearing') }}">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-6">
                    <input type="file" class="form-control @error('image') is-invalid @enderror" name="image">
                </div>
                <div class="col-sm-6">
                    <div class="form-check">
                        <label class="form-control  @error('book') is-invalid @enderror" for="book">{{ __('Choose book') }} ({{ __('Optinal') }})</label>
                        <input style="display: none" id="book" type="file" name="book">
                    </div>
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
