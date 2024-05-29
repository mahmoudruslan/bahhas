@extends('layouts.admin.master')
@section('title')
    {{ __('Services') }}
@endsection
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">{{ __('Services') }}</h1>
        <p class="mb-4"></p>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <input type="hidden" id="lang" value="{{app()->getLocale()}}">
            <div class="card-body">
                <div class="table-responsive">
                    {!! $dataTable->table() !!}
                    {!! $dataTable->scripts() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
