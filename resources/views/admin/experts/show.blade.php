@extends('layouts.admin.master')
@section('title')
    {{ __('Expert details') }}
@endsection

@section('content')
@php
    $lang = app()->getLocale();
@endphp
    <!-- Nested Row within Card Body -->
    <div class="row">
        <div class="p-5  col-lg-6">
            <div>
                <a style="margin-left: 20px" href="{{ route('admin.experts.index') }}" class="btn btn-secondary btn-icon-split">
                    <span class="icon text-white-50">
                        <i class="fas fa-arrow-right"></i>
                    </span>
                    <span class="text">{{ __('Experts') }}</span>
                </a>
            </div>
            <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">{{ __('Expert details') }}</h1>
            </div>
            <table class="table table-striped">
                <tbody>
                    <tr>
                        <th scope="row">{{ __('Name') }}</th>
                        <td>{{ $expert->full_name }}</td>
                    </tr>
                    <tr>
                        <th scope="row">{{ __('Specialization') }}</th>
                        <td>{{ $expert->specialization }}</td>
                    </tr>

                    <tr>
                        <th scope="row">{{ __('Degree') }}</th>
                        <td>{{ $expert->degree }}</td>
                    </tr>
                    <tr>
                        <th scope="row">{{ __('University') }}</th>
                        <td>{{$expert->university}}</td>
                    </tr>
                    <tr>
                        <th scope="row">{{ __('Country') }}</th>
                        <td>{{ $expert->country['name_' . $lang] }}</td>
                    </tr>
                    <tr>
                        <th scope="row">{{ __('City') }}</th>
                        <td>{{ $expert->city['name_' . $lang] }}</td>
                    </tr>
                    <tr>
                        <th scope="row">{{ __('Brief introduction') }}</th>
                        <td>{{ $expert->text_introduction }}</td>
                    </tr>
                    <tr>
                        <th scope="row">{{ __('Status') }}</th>
                        <td>{{ $expert->status() }}</td>
                    </tr>
                    <tr>
                        <th scope="row">{{ __('Mobile') }}</th>
                        <td>{{ $expert->phone }}</td>
                    </tr>
                    <tr>
                        <th scope="row">{{ __('Email') }}</th>
                        <td>{{ $expert->email }}</td>
                    </tr>
                    <tr>
                        <th scope="row">{{ __('International bank number') }}</th>
                        <td>{{ $expert->international_bank_number }}</td>
                    </tr>
                    <tr>
                        <th scope="row">{{ __('Created at') }}</th>
                        <td><a href="{{ route('admin.expert.download', ['id' => $expert->id, 'input_name' => 'IBAN_certificate']) }}" >Open the pdf!</a></td>
                    </tr>
                    <tr>
                        <th scope="row">{{ __('Created at') }}</th>
                        <td><a href="{{ route('admin.expert.download', ['id' => $expert->id, 'input_name' => 'the_biography']) }}">Open the pdf!</a></td>
                    </tr>
                    <tr>
                        <th scope="row">{{ __('Show information on bhhas') }}</th>
                        <td>{{ $expert->show_information }}</td>
                    </tr>
                    <tr>
                        <th scope="row">{{ __('publish achievements on bhhas') }}</th>
                        <td>{{ $expert->publish_achievements }}</td>
                    </tr>
                    <tr>
                        <th scope="row">{{ __('Gender') }}</th>
                        <td>{{ $expert->gender() }}</td>
                    </tr>
                    <tr>
                        <th scope="row">{{ __('Created at') }}</th>
                        <td>{{ $expert->created_at }}</td>
                    </tr>
                </tbody>
            </table>
            <div class="table-responsive">
            </div>
        </div>
        <div style="margin-top: 140px" class="col-lg-5">
            @if ($expert->image)
                <img style="width: 90%;" src="{{ asset('storage/' . $expert->image) }}">
            @else
                {{__('Image not found')}}
            @endif
        </div>
    </div>
@endsection
