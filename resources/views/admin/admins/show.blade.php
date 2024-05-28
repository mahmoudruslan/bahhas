@extends('layouts.admin.master')
@section('title')
    {{ __('Admin data') }}
@endsection
@section('content')
    <div class="container-fluid">

        <h1 class="h3 mb-2 text-gray-800">{{ __('Admin data') }}</h1>
        <p class="mb-4"></p>
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                    <th scope="row">{{__('First name')}}</th>
                                        <td>{{$admin->first_name}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">{{__('Last name')}}</th>
                                        <td>{{$admin->last_name}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">{{__('Email')}}</th>
                                        <td>{{$admin->email}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">{{__('Mobile')}}</th>
                                        <td>{{$admin->mobile}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">{{__('address')}}</th>
                                        <td>{{$admin->address}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">{{__('Created At')}}</th>
                                        <td>{{$admin->created_at}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <div style="width: 100%; text-align: center" >
                                <img style="width: 80%" src="{{asset('storage/' . $admin->image)}}" alt="admin image">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
