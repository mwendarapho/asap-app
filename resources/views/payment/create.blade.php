@extends('layouts.app')
@section('title','Payment')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>{{ __('Create Receipt') }}</h3>
                </div>

                @if(Session::has('message'))
                <div class="alert alert-success alert-dismisable">
                    {{Session::get('message')}}
                </div>
                @endif

                <div class="card-body">
                    <form method="POST" action="{{ route('payment.store') }}">
                        @csrf


                        <div class="form-group row">
                            <label for="pay_date" class="col-md-4 col-form-label text-md-right">{{ __('Date Paid') }}</label>

                            <div class="col-md-6">
                                <input id="pay_date" type="date" class="form-control @error('pay_date') is-invalid @enderror" name="pay_date" value="{{ old('pay_date') }}@php echo date('Y-m-d'); @endphp" required autocomplete="pay_date">

                                @error('pay_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="member_id" class="col-md-4 col-form-label text-md-right">{{ __('Member') }}</label>

                            <div class="col-md-6">

                                <select class="form-control @error('member_id') is-invalid @enderror" name="member_id" id="member_id" required>
                                    <option value="" selected>{{ 'Choose Member' }}</option>

                                    @foreach($members as $member)
                                    <option value="{{ $member->id}}">{{$member->fname.' '.$member->lname }}</option>
                                    @endforeach

                                </select>

                                @error('member_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>


                        <!--Items lists start-->

                        <div class="row">
                            <table class="table table-bordered">
                                <thead class=" table-dark">

                                    <th>Mode</th>
                                    <th>Reference / Remarks</th>
                                    <th>Amount</th>


                                </thead>
                                <tbody>
                                    <tr>

                                        <td width="20%">
                                            <select class="form-control @error('paymode_id') is-invalid @enderror" name="paymode_id" id="paymode_id" required>
                                                <option value="" selected>{{ 'Choose Mode' }}</option>

                                                @foreach($paymodes as $paymode)
                                                <option value="{{ $paymode->id}}">{{ $paymode->name }}</option>
                                                @endforeach


                                            </select>
                                        </td>
                                        <td width="50%">
                                            <input id="ref" type="text" class="form-control @error('ref') is-invalid @enderror" name="ref" value="{{ old('ref') }}" required autocomplete="ref">

                                            @error('ref')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </td>
                                        <td width="30%">
                                            <input id="amount" type="text" class="form-control @error('amount') is-invalid @enderror" name="amount" value="{{ old('amount') }}" required autocomplete="amount">

                                            @error('amount')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>

                        <!--Items lists end-->


                        <div class="form-group row mb-0">
                            <div class="col-md-12 text-md-right">
                                <button type="submit" class="btn btn-secondary" id="submit">
                                    {{ __('Save Invoice') }}
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
@section('scripts')
<script>
    $(document).ready(function() {

        function currentDate() {
            var today = new Date();
            var dd = String(today.getDate());
            var mm = String(today.getMonth() + 1); //January is 0!
            var yyyy = today.getFullYear();

            return today = yyyy + '-' + mm + '-' + dd;
        }


        //console.log(currentDate());

        //alert(currentDate());

        $('#qty,#amount').change(function() {
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
            $('#add').on('click', 'button', function() {
                // do something here
            });

        });

    });
</script>

@endsection
