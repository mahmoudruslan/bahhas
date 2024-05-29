@extends('layouts.admin.master')
@section('title')
    {{ __('Category details') }}
@endsection
@section('content')
    <div class="container-fluid">

        <h1 class="h3 mb-2 text-gray-800">{{ __('Category details') }}</h1>
        <p class="mb-4"></p>
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                    <th scope="row">{{__('Name in arabic')}}</th>
                                        <td>{{$category->name_ar}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">{{__('Name in english')}}</th>
                                        <td>{{$category->name_en}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">{{__('Parent category')}}</th>
                                        <td>{{$category->parent['name_' . app()->getLocale()]}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <div style="width: 100%; text-align: center" >
                                <img style="width: 80%" src="{{asset('storage/' . $category->cover)}}" alt="admin image">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
