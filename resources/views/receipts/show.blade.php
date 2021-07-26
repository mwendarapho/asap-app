@extends('layouts.app')
@section('title','Payments')

@section('content')
@php
$doc_no=0;
$amount=0;
$member_id=0;
$balance=0;
@endphp

<div class="container-fluid">
    <div class="row ">
        <div class="col-md-12 text-center">
            <div class="d-none d-print-block">
                <h2>{{env('ORG_NAME')}} </h2>
                <h3>{{env('ORG_ADDRESS')}} </h3>
                <p>{{env('ORG_EMAIL').' | '.env('ORG_PHONE')}} </p>
            </div>

            <h3>Receipt</h3>

            <table class="table">
                <tr>
                    <td class="text-left">Bill To</td>
                    <td>Date</td>
                    <td>RCT #</td>
                </tr>
                <tr>
                    <td class="text-left">
                        {{$payment->member->lname.', '.$payment->member->fname}}<br> {{$payment->member->address}}
                    </td>
                    <td>{{$payment->pay_date}}</td>
                    <td class="bold">RCT{{ $payment->id}}</td>
                </tr>
            </table>

        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered table-condensed  ">
                <thead>
                    <tr class="bg-dark text-white bold">



                        <th scope="col">Mode</th>
                        <th scope="col">Reference</th>
                        <th scope="col">Amount[KES]</th>

                    </tr>
                </thead>
                <tbody>


                    <tr>

                        <td>{{ $payment->paymode->name }}</td>
                        <td>{{ $payment->ref }}</td>
                        <td>{{ number_format($payment->amount, 2) }}</td>
                        @php $balance+=$payment->amount @endphp
                    </tr>

                <tfoot>
                    <tr>

                        <th></th>
                        <th class="text-right">Amount Paid</th>
                        <th>{{ number_format($balance,2) }}</th>
                </tfoot>
                </tfoot>
                </tbody>

            </table>
            <div class="container-fluid align-content-lg-center">

            </div>
        </div>
    </div>


</div>
@endsection
