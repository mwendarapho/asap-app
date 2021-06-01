@extends('layouts.app')
@section('title','Create Invoice')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>{{ __('Create Invoice') }}</h3>
                </div>

                @if(Session::has('message'))
                <div class="alert alert-success alert-dismisable">
                    {{Session::get('message')}}
                </div>
                @endif

                <div class="card-body">
                    <form method="POST" action="{{ route('invoice.store') }}">
                        @csrf


                        <div class="form-group row">
                            <label for="invoice_date" class="col-md-4 col-form-label text-md-right">{{ __('Invoice Date') }}</label>

                            <div class="col-md-6">
                                <input id="invoice_date" type="date" class="form-control @error('invoice_date') is-invalid @enderror" name="invoice_date" value="{{ old('invoice_date') }}@php echo date('Y-m-d'); @endphp" required autocomplete="invoice_date">

                                @error('invoice_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="due_date" class="col-md-4 col-form-label text-md-right">{{ __('Due Date') }}</label>

                            <div class="col-md-6">
                                <input id="due_date" type="date" class="form-control @error('due_date') is-invalid @enderror" name="due_date" value="{{ old('due_date') }}@php echo date('Y-m-d'); @endphp" required autocomplete="due_date">

                                @error('due_date')
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
                                    <option value="">{{ 'Select Member' }}</option>
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
                            <table class="table">
                                <thead>
                                    <th>Description</th>
                                    <th>Qty</th>
                                    <th>Amount</th>
                                    <th>Total</th>
                                    <th class="d-print-none"><i data-feather="x"></i></th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td width="40%">
                                            <input id="desc" type="text" class="form-control @error('desc') is-invalid @enderror" name="desc" value="{{ old('desc') }}" required autocomplete="description">

                                            @error('desc')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror

                                        </td>
                                        <td width="10%">
                                            <input id="qty" type="number" min="1" class="form-control @error('qty') is-invalid @enderror" name="qty" value="{{ old('qty') }}" required autocomplete="qty">

                                            @error('qty')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </td>
                                        <td width="16%">
                                            <input id="amount" type="text" class="form-control @error('amount') is-invalid @enderror" name="amount" value="{{ old('amount') }}" required autocomplete="amount">

                                            @error('amount')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </td>
                                        <td width="17%"><input id="total" type="text" class="form-control" value="" disabled></td>
                                        <td width="17%">
                                            <btn id="delete" class="btn btn-danger btn-sm"><i data-feather="x"></i>Del</btn>
                                            <btn id="add" class="btn btn-success btn-sm"><i data-feather="plus"></i>Add</btn>
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