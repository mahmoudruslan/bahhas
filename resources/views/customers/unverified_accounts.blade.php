@extends('layouts.admin.master')
@section('title')
    {{ __('Unverified accounts') }}
@endsection
@section('content')

<div class="container-fluid">

    <h1 class="h3 mb-2 text-gray-800">{{ __('Unverified accounts') }}</h1>
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
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered text-center yajra-datatable" id="dataTable" width="100%"
                    cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-center">{{ __('#') }}</th>
                            <th class="text-center">{{ __('Name') }}</th>
                            <th class="text-center">{{ __('Phone Number') }}</th>
                            <th class="text-center">{{ __('Other Phone') }}</th>
                            <th class="text-center">{{ __('Governorate') }}</th>
                            <th class="text-center">{{ __('District') }}</th>
                            <th class="text-center">{{ __('Activity Type') }}</th>
                            <th class="text-center">{{ __('Address') }}</th>
                            <th class="text-center">{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection

@section('js')
<script type="text/javascript">
    $(function() {
        var table = $('.yajra-datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('customers.documentation') }}",
            columns: [
                {
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'phone',
                    name: 'phone'
                },
                {
                    data: 'other_phone',
                    name: 'other_phone'
                },
                {
                    data: 'governorate',
                    name: 'governorate'
                },
                {
                    data: 'district',
                    name: 'district'
                },
                {
                    data: 'activity_type',
                    name: 'activity_type'
                },
                {
                    data: 'address',
                    name: 'address'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: true,
                    searchable: true
                },
            ]
        });
    });
</script>
@endsection
