@extends('layouts.app')
@section('title','Members')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Edit Member') }} </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        @if(Session::has('message'))
                            <div class="alert alert-success alert-dismisable">
                                {{Session::get('message')}}
                            </div>
                        @endif


                        <form method="POST" action="{{ route('member.update',$member->id) }}">
                            @csrf
                            @method('PUT')

                            <div class="form-group row">
                                <label for="fname"
                                       class="col-md-4 col-form-label text-md-right">{{ __('First Name') }}</label>

                                <div class="col-md-6">
                                    <input id="fname" type="text"
                                           class="form-control @error('fname') is-invalid @enderror" name="fname"
                                           value="{{ $member->fname }}" required autocomplete="fname" autofocus>

                                    @error('fname')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="lname"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Last Name') }}</label>

                                <div class="col-md-6">
                                    <input id="lname" type="text"
                                           class="form-control @error('lname') is-invalid @enderror" name="lname"
                                           value="{{ $member->lname }}"  autocomplete="lname" autofocus>

                                    @error('lname')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email"
                                       class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                           class="form-control @error('email') is-invalid @enderror" name="email"
                                           value="{{ $member->email }}"  autocomplete="email">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="mobile"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Mobile') }}</label>

                                <div class="col-md-6">
                                    <input id="mobile" type="text"
                                           class="form-control @error('mobile') is-invalid @enderror" name="mobile"
                                           value="{{ $member->mobile }}"  autocomplete="mobile">

                                    @error('mobile')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="address"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>

                                <div class="col-md-6">
                                    <input id="address" type="text"
                                           class="form-control @error('address') is-invalid @enderror" name="address"
                                           value=" {{ $member->address }}" autocomplete="address">

                                    @error('address')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="dob" class="col-md-4 col-form-label text-md-right">{{ __('DOB') }}</label>

                                <div class="col-md-6">
                                    <input id="dob" type="date" class="form-control
                                        @error('dob') is-invalid @enderror"
                                           name="dob" value="{{ $member->dob }}" autocomplete="dob">

                                    @error('dob')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="spouse_name"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Spouse Name') }}</label>

                                <div class="col-md-6">
                                    <input id="spouse_name" type="text"
                                           class="form-control @error('spouse_name') is-invalid @enderror"
                                           name="spouse_name" value=" {{ $member->spouse_name }} "
                                           autocomplete="spouse_name" autofocus>

                                    @error('spouse_name')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="spouse_mobile"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Spouse Mobile') }}</label>

                                <div class="col-md-6">
                                    <input id="spouse_mobile" type="text"
                                           class="form-control @error('spouse_mobile') is-invalid @enderror"
                                           name="spouse_mobile" value=" {{ $member->spouse_mobile }}"
                                           autocomplete="spouse_mobile">

                                    @error('spouse_mobile')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="joined_on"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Joined On') }}</label>

                                <div class="col-md-6">
                                    <input id="joined_on" type="date" class="form-control
                                        @error('joined_on') is-invalid @enderror"
                                           name="joined_on" value="{{ $member->joined_on }}" autocomplete="joined_on">

                                    @error('joined_on')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="left_on"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Left On') }}</label>

                                <div class="col-md-6">
                                    <input id="left_on" type="date"
                                           class="form-control @error('left_on') is-invalid @enderror"
                                           name="left_on" value="{{ $member->left_on }}" autocomplete="left_on">

                                    @error('left_on')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary" id="submit">
                                        {{ __('Save ') }}
                                    </button>
                                </div>
                            </div>


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

