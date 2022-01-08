@extends('layouts.app')
@section('title','Payments')
@section('styles')

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.11.2/b-2.0.0/datatables.min.css"/>
@endsection

@section('content')
@php
$doc_no=0;
$amount=0;
$member_id=0;
$balance=0;
@endphp

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 py-md-2">
            <h1>Payments</h1>
            <a href="{{ route('payment.create') }}" class="btn btn-sm btn-success">Receive payment</a>
        </div>

    </div>

    <div class="row">
        <div class="col-md-12">
            <table class="table table-condensed table-striped table-responsive-sm" id="payment">
                <thead>
                    <tr>
                        <th scope="col">Date</th>
                        <th scope="col">RCT No</th>
                        <th scope="col">Member</th>
                        <th scope="col">Mode</th>
                        <th scope="col">Reference</th>
                        <th scope="col">Amount[KES]</th>
                        <th scope="col">R-Balacnce[KES]</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($payments as $payment)

                    <tr>
                        <td>{{$payment->pay_date}}</td>
                        <td>
                            <a href="{{'payment/'.$payment->id}}">
                                <span data-feather="arrow-right-circle" class="small text-success d-print-none"></span></a>
                            RCT{{ $payment->id}}
                        </td>
                        <td>{{ $payment->member->fname.' '.$payment->member->lname}}</td>
                        <td>{{ $payment->paymode->name }}</td>
                        <td>{{ $payment->ref }}</td>
                        <td>{{ number_format($payment->amount, 2) }}</td>
                        <td>{{ number_format($balance+=$payment->amount,2) }}</td>
                    </tr>
                    @endforeach
                <tfoot>
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th>{{ number_format($balance,2) }}</th>
                </tfoot>
                </tfoot>
                </tbody>

            </table>

        </div>
    </div>


</div>

@stop
@section('scripts')
    <!-- DataTables -->

    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jq-3.3.1/dt-1.10.18/datatables.min.js" defer></script>

    <!--<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.11.2/b-2.0.0/datatables.min.js"></script>-->


    <script type="text/javascript">

        $(document).ready(function() {
            $('#payment').DataTable({
                "lengthMenu": [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"] ],
            });
        } );

    </script>

@endsection
