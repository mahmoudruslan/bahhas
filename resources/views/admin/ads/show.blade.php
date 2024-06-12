@extends('layouts.admin.master')
@section('title')
    {{ __('Category data') }}
@endsection
@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">{{ __('Ad details') }}</h1>
        <p class="mb-4"></p>
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th scope="row">{{ __('Title in arabic') }}</th>
                                        <td>{{ $ad->title_ar }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">{{ __('Title in english') }}</th>
                                        <td>{{ $ad->title_en }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">{{ __('Url') }}</th>
                                        <td>{{ $ad->url }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">{{ __('Status') }}</th>
                                        <td>{{ $ad->status() }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">{{ __('Details in arabic') }}</th>
                                        <td>{{ $ad->details_ar }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">{{ __('Details in english') }}</th>
                                        <td>{{ $ad->details_en }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <div style="width: 100%; text-align: center">
                                <img style="width: 80%" src="{{ asset('storage/' . $ad->cover) }}" alt="admin image">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
