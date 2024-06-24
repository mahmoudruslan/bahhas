@extends('layouts.admin.master')
@section('title')
    {{ __('Settings') }}
@endsection
@section('content')
<div class="container-fluid">

    <h1 class="h3 mb-2 text-gray-800">{{ __('Settings') }}</h1>
    <p class="mb-4"></p>
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive border-table">
                {!! $dataTable->table() !!}
                {!! $dataTable->scripts() !!}
            </div>
        </div>
    </div>

</div>
@endsection

