@extends('layouts.admin.master')
@section('title')
    {{ __('Category data') }}
@endsection
@section('content')
    <div class="container-fluid">

        <h1 class="h3 mb-2 text-gray-800">{{ __('Category data') }}</h1>
        <p class="mb-4"></p>
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                    <th scope="row">{{__('Title in arabic')}}</th>
                                        <td>{{$blog->title_ar}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">{{__('Title in english')}}</th>
                                        <td>{{$blog->title_en}}</td>
                                    </tr>
                            
                                    <th scope="row">{{__('Description in arabic')}}</th>
                                        <td>{{$blog->description_ar}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">{{__('Description in english')}}</th>
                                        <td>{{$blog->description_en}}</td>
                                    </tr>
                                    <th scope="row">{{__('Related')}}</th>
                                        <td>{{$blog->related['title_' . app()->getLocale()] ?? __('No related')}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <div style="width: 100%; text-align: center" >
                                <img style="width: 80%" src="{{asset('storage/' . $blog->image)}}" alt="admin image">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
