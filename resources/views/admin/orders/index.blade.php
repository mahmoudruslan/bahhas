@extends('layouts.admin.master')
@section('title')
    {{ __('Orders') }}
@endsection
@section('style')
<style>
    .stu {
        padding: 3px;
    font-size: smaller;
    }
</style>
    
@endsection
@section('content')
    <!-- Begin Page Content -->

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                {{__('File Save')}}
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a href="{{ route('admin.export.csv') }}" class="dropdown-item"><i
                        class="fas fa-download fa-sm text-white-50"></i>{{ __('Save as csv file') }}</a>
                <a href="{{ route('admin.export.excel') }}" class="dropdown-item"><i
                        class="fas fa-download fa-sm text-white-50"></i>{{ __('Save as excel file') }}</a>
                        <a href="{{ url('/admin/print-orders') }}" class="dropdown-item">{{__('Orders Print')}}</a>
            </div>
        </div>

        <p class="mb-4"></p>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            @if (Session::has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ __(Session::get('success')) }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <input type="hidden" id="lang" value="{{app()->getLocale()}}">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered text-center yajra-datatable" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center">{{ __('#') }}</th>
                                <th class="text-center">{{ __('Customer Name') }}</th>
                                <th class="text-center">{{ __('Phone Number') }}</th>
                                <th class="text-center">{{ __('Address') }}</th>
                                <th class="text-center">{{ __('Price') }}</th>
                                <th class="text-center">{{ __('Status') }}</th>
                                <th class="text-center">{{ __('Order Date') }}</th>
                                <th class="text-center">{{ __('Notes') }}</th>

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
        var lang = $('#lang').val();
        var table = $('.yajra-datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.orders.index') }}",
            columns: [
                {
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'username',
                    name: 'username'
                },
                {
                    data: 'phone',
                    name: 'phone'
                },
                {
                    data: 'address',
                    name: 'address'
                },
                {
                    data: 'price',
                    name: 'price'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'created_at',
                    name: 'created_at'
                },
                {
                    data: 'notes',
                    name: 'notes'
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
<script type="text/javascript">
    $(document).ready(function(){
    $('.btnprn').printPage();
    });
    </script>
@endsection
