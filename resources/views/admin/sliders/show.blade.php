@extends('layouts.admin.master')
@section('title')
    {{ __('Slider data') }}
@endsection
@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">{{ __('Ad slider') }}</h1>
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
                                        <td>{{ $slider->title_ar }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">{{ __('Title in english') }}</th>
                                        <td>{{ $slider->title_en }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">{{ __('Url') }}</th>
                                        <td>{{ $slider->url }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">{{ __('Status') }}</th>
                                        <td>{{ $slider->status() }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">{{ __('Details in arabic') }}</th>
                                        <td>{{ $slider->details_ar }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">{{ __('Details in english') }}</th>
                                        <td>{{ $slider->details_en }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <div style="width: 100%; text-align: center">
                                <img style="width: 80%" src="{{ asset('storage/' . $slider->cover) }}" alt="admin image">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
