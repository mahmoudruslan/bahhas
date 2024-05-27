@extends('layouts.admin.master')
@section('title')
{{ __('Blogs') }}
@endsection
@section('content')

    <!-- Begin Page Content -->
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">{{ __('Blogs') }}</h1>
        <p class="mb-4"></p>
        <div class="card shadow mb-4">
            @if (Session::has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ __(Session::get('success')) }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @if (Session::has('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ __(Session::get('error')) }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            
            <div class="card-body">
                
            <div class="table-responsive">
                {!! $dataTable->table() !!}
                {!! $dataTable->scripts() !!}
                </div>
            </div>
        </div>

    </div>
@endsection
