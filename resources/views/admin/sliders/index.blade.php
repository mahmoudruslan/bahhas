@extends('layouts.admin.master')
@section('title')
    {{ __('Sliders') }}
@endsection
@section('content')
<div class="container-fluid">

    <h1 class="h3 mb-2 text-gray-800">{{ __('Sliders') }}</h1>
    <p class="mb-4"></p>
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                {!! $dataTable->table() !!}
                {!! $dataTable->scripts() !!}
            </div>
        </div>
    </div>

</div>
@endsection

