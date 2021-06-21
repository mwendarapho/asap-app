@extends('layouts.app')
@section('title','Statement')

@section('content')


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
                    @php
                    $debit=0;
                    $credit=0;
                    $tcredit=0;
                    $tdebit=0;
                    $balance=0;
                    @endphp
                    @foreach($transactions as $transaction)
                    <tr>
                        <td>2021-06-10</td>
                        <td><a href="{{'receipt/'.$transaction->id}}">
                                <span data-feather="arrow-right-circle" class="small text-success d-print-none"></span>
                            </a>{{$transaction->id}}</td>
                        <td>{{$transaction->fname}}</td>
                        <td>Ivoice</td>
                        <td>{{ number_format($debit=$transaction->debit, 2) }}</td>
                        <td>{{ number_format($credit=$transaction->credit, 2) }}</td>
                        <td>
                            @php

                            $tdebit+=$debit;
                            $tcredit+=$credit;
                            $balance=$tdebit-$tcredit;
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
                </tfoot>
                </tfoot>
                </tbody>

            </table>
        </div>
    </div>


</div>
@endsection