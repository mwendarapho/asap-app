@extends('layouts.app')
@section('title','Paid-Up Members')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3>{{ __('Select Date') }}</h3>
                    </div>

                    @if(Session::has('message'))
                        <div class="alert alert-success alert-dismisable">
                            {{Session::get('message')}}
                        </div>
                    @endif

                    <div class="card-body">
                        <form method="POST" action="{{ route('member.paidup') }}">
                            @csrf



                            <div class="form-group row">
                                <label for="to_date"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Date') }}</label>

                                <div class="col-md-6">
                                    <input id="to_date" type="date"
                                           class="form-control @error('to_date') is-invalid @enderror" name="to_date"
                                           value="{{ old('to_date') }}@php echo date('Y-m-d'); @endphp" required
                                           autocomplete="to_date">

                                    @error('to_date')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                                </div>
                            </div>


                             <div class="form-group row">
                                <label for="group"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Group') }}</label>

                                <div class="col-md-6">

                                    <select class="form-control @error('group') is-invalid @enderror"
                                            name="group" id="group" required>
                                        <option value="" selected>{{ 'Choose Group' }}</option>
                                        <option value="1" >{{ 'Paid Up' }}</option>
                                        <option value="2" >{{ 'Not Paid' }}</option>

                                    </select>

                                    @error('group')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group row mb-0 col-md-6">
                                    <div class="col-md-12 text-md-right">
                                        <button type="submit" class="btn btn-secondary" id="submit">
                                            {{ __('Save') }}
                                        </button>
                                    </div>
                                </div>
                            </div>


                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function () {

            function currentDate() {
                var today = new Date();
                var dd = String(today.getDate());
                var mm = String(today.getMonth() + 1); //January is 0!
                var yyyy = today.getFullYear();

                return today = yyyy + '-' + mm + '-' + dd;
            }


            //console.log(currentDate());

            //alert(currentDate());

        });
    </script>

@endsection
