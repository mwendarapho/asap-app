@extends('layouts.app')
@section('title','Credit Note')


@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3>{{ __('Create Credit Note') }}</h3>
                    </div>

                    @if(Session::has('message'))
                        <div class="alert alert-success alert-dismisable">
                            {{Session::get('message')}}
                        </div>
                    @endif

                    <div class="card-body">
                        <form method="POST" action="{{ route('credit.store') }}">
                            @csrf


                            <div class="form-group row">
                                <label for="credit_date"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Date Credited') }}</label>

                                <div class="col-md-6">
                                    <input id="credit_date" type="date"
                                           class="form-control @error('credit_date') is-invalid @enderror"
                                           name="credit_date"
                                           value="{{ old('credit_date') }}@php echo date('Y-m-d'); @endphp" required
                                           autocomplete="credit_date">

                                    @error('credit_date')
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
                                    <th>Member</th>
                                    <th>Invoice No</th>
                                    <th>Reference / Remarks</th>
                                    <th>Amount</th>


                                    </thead>
                                    <tbody>
                                    <tr>

                                            @livewire('member-invoice')


                                        <td width="45%">
                                            <input id="credit_ref" type="text"
                                                   class="form-control @error('credit_ref') is-invalid @enderror"
                                                   name="credit_ref" value="{{ old('credit_ref') }}" required
                                                   autocomplete="credit_ref">

                                            @error('credit_ref')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </td>
                                        <td width="15%">
                                            <input id="amount" type="text"
                                                   class="form-control @error('amount') is-invalid @enderror"
                                                   name="amount" value="{{ old('amount') }}" required
                                                   autocomplete="amount">

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
                                        {{ __('Save Credit Note') }}
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
        $(document).ready(function () {

            function currentDate() {
                var today = new Date();
                var dd = String(today.getDate());
                var mm = String(today.getMonth() + 1); //January is 0!
                var yyyy = today.getFullYear();

                return today = yyyy + '-' + mm + '-' + dd;
            }

            $('#member_id').blur(function () {
               window.location.reload();
            });

        });
    </script>

@endsection
