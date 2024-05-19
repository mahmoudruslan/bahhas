@extends('layouts.admin.master')
@section('title')
    {{ __('Ads') }}
@endsection
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">{{ __('Ads') }}</h1>
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
                    <table class="table table-bordered text-center yajra-datatable" id="dataTable" width="100%"
                        cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center">{{ __('#') }}</th>
                                <th class="text-center">{{ __('Link') }}</th>
                                <th class="text-center">{{ __('Ad photo') }}</th>
                                <th class="text-center">{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($ads as $ad)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td><a href="{{ $ad->target }}">{{ $ad->target }}</a></td>
                                    <td><img style="width: 7rem;" src="{{asset("images/ads/" . $ad->photo)}}" alt="ad Photo"></td>
                                    <td>
                                        <a class="btn btn-info btn-circle" href="{{route('admin.ads.edit', $ad->id)}}">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a class="btn btn-danger btn-circle" href="#"
                                            data-toggle="modal"data-target="#deletemodel{{$ad->id}}">
                                            <i class="fas fa-trash">

                                            </i>
                                        </a>
                                        <a class="btn btn-warning btn-circle" href="{{route('admin.ads.show', $ad->id)}}">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                                @include('admin.ads.delete')
                                @empty
                                <td colspan="4">{{__('There is no data to display')}}</td>
                            @endforelse
                        </tbody>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection