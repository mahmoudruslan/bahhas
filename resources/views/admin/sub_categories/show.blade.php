@extends('layouts.admin.master')
@section('title')
    {{ __('Sub category data') }}
@endsection
@section('content')
    <div class="container-fluid">

        <h1 class="h3 mb-2 text-gray-800">{{ __('Sub Category data') }}</h1>
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
                                        <td>{{$sub_category->name_ar}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">{{__('Name in english')}}</th>
                                        <td>{{$sub_category->name_en}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">{{__('Category')}}</th>
                                        <td>{{$sub_category->category['name_' . app()->getLocale()]}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <div style="width: 100%; text-align: center" >
                                <img style="width: 80%" src="{{asset('storage/' . $sub_category->cover)}}" alt="admin image">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
