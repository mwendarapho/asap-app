@extends('layouts.app')
@section('title','Member Statement')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3>{{ __('Member Statment') }}</h3>
                    </div>

                    @if(Session::has('message'))
                        <div class="alert alert-success alert-dismisable">
                            {{Session::get('message')}}
                        </div>
                    @endif

                    <div class="card-body">
                        <form method="POST" action="{{ route('statement') }}">
                            @csrf


                            <div class="form-group row">
                                <label for="from_date"
                                       class="col-md-4 col-form-label text-md-right">{{ __(' From Date') }}</label>

                                <div class="col-md-6">
                                    <input id="from_date" type="date" class="form-control
                                            @error('from_date') is-invalid @enderror"
                                           name="from_date"
                                           value="{{ old('from_date') }}@php echo date('Y-m-01'); @endphp" required
                                           autocomplete="from_date">

                                    @error('from_date')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="to_date"
                                       class="col-md-4 col-form-label text-md-right">{{ __('To Date') }}</label>

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
                                <label for="member_id"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Member') }}</label>

                                <div class="col-md-6">

                                    <select class="form-control @error('member_id') is-invalid @enderror"
                                            name="member_id" id="member_id" required>
                                        <option value="" selected>{{ 'Choose Member' }}</option>

                                        @foreach($members as $member)
                                            <option
                                                value="{{ $member->id}}">{{$member->fname.' '.$member->lname }}</option>
                                        @endforeach

                                    </select>

                                    @error('member_id')
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
                                            {{ __('Save Invoice') }}
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

            $('#qty,#amount').change(function () {
                var qty = parseInt($('#qty').val());
                var amount = $('#amount').val();
                if (isNaN(amount)) {
                    $('#amount').val(0);
                    amount = 0;

                }


                // $('#amount').val(amount.toFixed(2));

                var total = qty * amount;
                //get total to 2dp
                $('#total').val(total.toFixed(2));


                //add a row to the end of table
                $('#add').on('click', 'button', function () {
                    // do something here
                });

            });

        });
    </script>

@endsection
