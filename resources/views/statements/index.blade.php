@extends('layouts.app')
@section('title','Statement')

@section('content')
@php
$doc_no=0;
$amount=0;
$member_id=0;
$balance=0;
$debit=0;
$credit=0;
$tdebit=0;
$tcredit=0;
@endphp

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <h1>Statement</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-condensed table-striped table-responsive-sm">
                <thead>
                    <tr>
                        <th scope="col">Date</th>
                        <th scope="col">Doc No</th>
                        <th scope="col">Member</th>
                        <th scope="col">Category</th>
                        <th scope="col">Debit[KES]</th>
                        <th scope="col">Credit[KES]</th>
                        <th scope="col">R-Balacnce[KES]</th>
                    </tr>
                </thead>
                <tbody>
                    @for ($i = 0; $i < 10; $i++) @php $doc_no=rand(10,1000); $debit=rand(1000,100000); $credit=rand(0,10000); $member_id=rand(1,10); @endphp <tr>
                        <td>2021-06-10</td>
                        <td><a href="{{'receipt/'.$doc_no}}"><span data-feather="arrow-right-circle" class="small text-success d-print-none"></span></a>RCT{{$doc_no}}</td>
                        <td>{{$member_id}}</td>
                        <td>Ivoice</td>
                        <td>{{ number_format($debit, 2) }}</td>
                        <td>{{ number_format($credit, 2) }}</td>
                        <td>
                            @php
                            
                            $tdebit+=$debit;
                            $tcredit+=$credit;
                            $balance=$tdebit-$tcredit;
                            @endphp
                            {{ number_format($balance,2) }}
                        </td>
                        </tr>
                        @endfor
                <tfoot>
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th>{{ number_format($tdebit,2) }}</th>
                        <th>{{ number_format($tcredit,2) }}</th>
                        <th>{{ number_format($balance,2) }}</th>
                </tfoot>
                </tfoot>
                </tbody>

            </table>
        </div>
    </div>


</div>
@endsection