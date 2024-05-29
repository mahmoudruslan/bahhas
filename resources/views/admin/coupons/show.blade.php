@extends('layouts.admin.master')
@section('title')
    {{ __('Coupon data') }}
@endsection
@section('content')
    <div class="container-fluid">

        <h1 class="h3 mb-2 text-gray-800">{{ __('Coupon data') }}</h1>
        <p class="mb-4"></p>
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <div class="row">
                        <div class="col-md-8">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th scope="row">{{ __('Description in arabic') }}</th>
                                        <td>{{ $coupon->description_ar }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">{{ __('Description in english') }}</th>
                                        <td>{{ $coupon->description_en }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">{{ __('Code') }}</th>
                                        <td>{{ $coupon->code }}</td>
                                    </tr>
                                    <th scope="row">{{ __('Coupon value') }}</th>
                                    <td>{{ $coupon->value }}</td>
                                    </tr>
                                    <th scope="row">{{ __('Status') }}</th>
                                    <td>{{ $coupon->status() }}</td>
                                    </tr>
                                    <th scope="row">{{ __('Start date') }}</th>
                                    <td>{{ $coupon->start_date }}</td>
                                    </tr>
                                    <th scope="row">{{ __('Expire date') }}</th>
                                    <td>{{ $coupon->expire_date }}</td>
                                    </tr>
                                    <th scope="row">{{ __('Use times') }}</th>
                                    <td>{{ $coupon->use_times }}</td>
                                    </tr>
                                    <th scope="row">{{ __('Used times') }}</th>
                                    <td>{{ $coupon->used_times }}</td>
                                    </tr>
                                    <th scope="row">{{ __('Greater than') }}</th>
                                    <td>{{ $coupon->greater_than }}</td>
                                    </tr>
                                    <th scope="row">{{ __('Created at') }}</th>
                                    <td>{{ $coupon->created_at }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
