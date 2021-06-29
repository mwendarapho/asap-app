@extends('layouts.app')
@section('title','Statement')

@section('content')

    {{--
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
        Launch demo modal
    </button>--}}

    <a class="btn btn-success" href="statement">Statement</a>


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
                        <th scope="col">Owed[KES]</th>
                        <th scope="col">Paid[KES]</th>
                        <th scope="col">R-Balacnce[KES]</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $debit= $balBF['debit'];
                    $credit= $balBF['credit'];
                    $tcredit=$balBF['credit'];
                    $tdebit=$balBF['debit'];
                    $balance=abs($balBF['credit']-$balBF['debit']);
                    @endphp
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th>B/F</th>
                        <th>{{ number_format($debit,2) }}</th>
                        <th>{{ number_format($credit,2) }}</th>
                        <th>{{ number_format($balance,2) }}</th>
                    </tr>
                    @foreach($transactions as $transaction)
                    <tr>
                        <td>{{$transaction->date}}</td>
                        <td><a href="{{ ($transaction->owed ==0 ? 'payment' : 'invoice').'/'.$transaction->docno}}">
                                <span data-feather="arrow-right-circle" class="small text-success d-print-none"></span>
                            </a>{{ ($transaction->owed ==0 ? 'RCT' : 'INV'). $transaction->docno}}</td>
                        <td>{{$transaction->fname .' '.$transaction->lname }}</td>
                        <td>{{ ($transaction->owed ==0 ? 'RCT' : 'INV') }}</td>
                        <td>{{ number_format($debit=$transaction->owed, 2) }}</td>
                        <td>{{ number_format($credit=$transaction->paid, 2) }}</td>
                        <td>
                            @php

                            $tdebit+=$debit;
                            $tcredit+=$credit;
                            $balance= abs($tdebit-$tcredit);
                            @endphp
                            {{ number_format($balance,2) }}
                        </td>
                    </tr>
                    @endforeach
                <tfoot>
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th>{{ number_format($tdebit,2) }}</th>
                        <th>{{ number_format($tcredit,2) }}</th>
                        <th>{{ number_format($balance,2) }}</th>
                    </tr>
                </tfoot>
                </tfoot>
                </tbody>

            </table>
        </div>
    </div>


</div>



<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Select Date &amp; Member</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

@endsection
