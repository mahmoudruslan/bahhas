@extends('layouts.admin.master')
@section('title')
    {{ __('Edit experts') }}
@endsection
@section('content')
    <div class="row">
        <div class="p-5 col-lg-12">
            <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">{{ __('Edit data') }} : {{ $expert->full_name }}</h1>
            </div>
            <form class="user insubmit" method="POST" action="{{ route('admin.experts.update', $expert->id) }}"
                enctype="multipart/form-data">
                @csrf
                @method('patch')
                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <input value="{{ $expert->full_name }}" type="text" class="form-control form-control-user"
                            id="exampleFirstName" placeholder="{{ __('Full name') }}" name="full_name">
                        @error('full_name')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    

                    <div class="col-sm-6">
                        <input value="{{ $expert->email }}" type="email" class="form-control form-control-user"
                            id="email" placeholder="{{ __('Email') }}" name="email">
                        @error('email')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                </div>
                <div class="form-group row">
                    <div class="col-sm-4">
                        <input value="{{ $expert->degree }}" type="text" class="form-control form-control-user"
                            id="degree" placeholder="{{ __('Enter degree') }}" name="degree">
                        @error('degree')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-sm-4">
                        <input value="{{ $expert->specialization }}" type="text" class="form-control form-control-user"
                            id="specialization" placeholder="{{ __('Enter specialization') }}" name="specialization">
                        @error('specialization')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-sm-4">
                        <input value="{{ $expert->university }}" type="text" class="form-control form-control-user"
                            id="university" placeholder="{{ __('Enter university') }}" name="university">
                        @error('university')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <input value="{{ $expert->international_bank_number }}" type="number"
                            class="form-control form-control-user"
                            placeholder="{{ __('Enter international_bank_number') }}" name="international_bank_number">
                        @error('international_bank_number')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-sm-6">
                        <input value="{{ $expert->phone }}" type="text" class="form-control form-control-user"
                            id="phone" placeholder="{{ __('Enter phone') }}" name="phone">
                        @error('phone')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                @livewire('cascading-dropdown-address', ['countries' => $countries, $expert])
                <div class="form-group row">
                    {{-- <div class="col-sm-6 mb-3 mb-sm-0">
                        <label for="iban-certificate" class="form-control">{{ __('Upload IBAN certificate') }}</label>
                        <input id="iban-certificate" style="display: none" value="{{ $expert->IBAN_certificate }}"
                            type="file" class="form-control" name="IBAN_certificate">
                        @error('IBAN_certificate')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div> --}}
                    {{-- <div class="col-sm-6 mb-3 mb-sm-0">
                        <label for="the_biography" class="form-control">{{ __('Upload biography') }}</label>
                        <input style="display: none" value="{{ $expert->the_biography }}" type="file"
                            class="form-control" id="the_biography" placeholder="{{ __('Enter the_biography') }}"
                            name="the_biography">
                        @error('the_biography')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div> --}}
                    
                </div>
                <div class="form-group row">
                </div>
                {{-- <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <label>{{ __('Do you agree to display the main information (name - rank - university - biographical information) on the Bhhath platform?') }}</label>
                        @error('show_information')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input value="1" class="form-check-input" type="radio"
                                        name="show_information" id="show_information1">
                                    <label class="form-check-label" for="show_information1">
                                        {{ __('Yes') }}
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input value="0" class="form-check-input" type="radio"
                                        name="show_information" id="show_information2">
                                    <label class="form-check-label" for="show_information2">
                                        {{ __('No') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <label>{{ __('Do you have a scientific author or digital product that you would like to market on the Bahaath platform (books - live courses - recorded courses - training packages...)') }}</label>
                        @error('publish_achievements')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input value="1" class="form-check-input" type="radio"
                                        name="publish_achievements" id="publish_achievements1">
                                    <label class="form-check-label" for="publish_achievements1">
                                        {{ __('Yes') }}
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="publish_achievements"
                                        id="publish_achievements2">
                                    <label value="0" class="form-check-label" for="publish_achievements2">
                                        {{ __('No') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label for="image" class="form-control">{{ __('Choose image') }}</label>
                        <input style="display: none" value="{{ $expert->image }}" type="file" class="form-control"
                            id="image" placeholder="{{ __('Enter image') }}" name="image">
                        @error('image')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    {{-- <div class="col-sm-6">
                        <select class="form-control" name="gender">
                            <option selected disabled>{{ __('Gender') }}</option>
                            <option value="1">{{ __('Male') }}</option>
                            <option value="0">{{ __('Female') }}</option>
                        </select>
                        @error('gender')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div> --}}
                    <div class="col-sm-6">
                        <select class="form-control" name="status">
                            <option selected disabled>{{ __('Status') }}</option>
                            <option value="1">{{ __('Active') }}</option>
                            <option value="0">{{ __('Inactive') }}</option>
                        </select>
                        @error('status')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12 mb-3 mb-sm-0">
                        <textarea class="form-control" name="text_introduction" placeholder="{{ __('Enter text_introduction') }}">
                            {{ $expert->text_introduction }}
                        </textarea>
                        @error('text_introduction')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-user btn-block">
                    {{ __('Submit') }}
                </button>
                <hr>
            </form>
        </div>
    </div>
@endsection
