@section('title', 'Invoices')
@extends('layouts.app')
@section('content')


<!--include css--->
@section('styles')
<link href="{{ asset('css/invoice.css') }}" rel="stylesheet">
@endsection

<!--End of css-->


<div class="container mt-5 mb-3">
    <div class="row d-flex justify-content-center">
        <div class="col-md-12">
            <div class="pageNo d-print-none">
                <a href="{{ ($invoice->id>1)? $invoice->id-1:$invoice->id }}"><span data-feather="arrow-left-circle" class="small text-white"></span></a>
                <span class="text-white">{{$invoice->id}}</span>
                <a href="{{ ($invoice->id<$totalinvoice) ? $invoice->id+1:$invoice->id }}"><span data-feather="arrow-right-circle" class="small text-white"></span></a>
            </div>


            <div class="card">
                <table class="table">
                    <tr>
                        <td class="text-center inv" colspan="3"> Subscription Invoice</td>
                    </tr>
                    <tr>
                        <td class="text-center">Invoice No</td>
                        <td class="text-right">Invoice Date</td>
                        <td>{{$invoice->invoice_date}}</td>
                    </tr>
                    <tr>
                        <td class="text-center">INV-{{$invoice->id}}</td>
                        <td class="text-right">Due Date </td>
                        <td>{{$invoice->due_date}}</td>
                    </tr>
                </table>

                <div class="table-responsive p-2">
                    <table class="table table-borderless">
                        <tbody>
                            <tr class="add">
                                <td>To</td>
                                <td>From</td>
                            </tr>
                            <tr class="content">
                                <td class="font-weight-bold">{{$invoice->member->fname}} {{$invoice->member->lname}}
                                    <br>{{$invoice->member->address}}<br>{{$invoice->member->email}}<br>{{$invoice->member->phone}}
                                </td>
                                <td class="font-weight-bold"> {{env('ORG_NAME')}} <br>{{ env('ORG_ADDRESS') }}, {{env('ORG_CITY')}}<br>{{ env('ORG_PHONE') }} </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <hr>
                <div class="products p-2">
                    <table class="table table-borderless">
                        <tbody>
                            <tr class="add">
                                <td>Description</td>
                                <td>Qty</td>
                                <td>Amount</td>
                                <td class="text-center">Total</td>
                            </tr>
                            @php $total =0; @endphp
                            @foreach($items as $item)
                            <tr class="content">
                                <td>{{$item->description}}</td>
                                <td>{{$item->qty}}</td>
                                <td>{{ number_format($item->amount,2)}}</td>
                                <td class="text-center">{{ number_format($item->qty * $item->amount,2)}}</td>
                            </tr>
                            @php $total+=$item->qty * $item->amount @endphp
                            @endforeach

                        </tbody>
                    </table>
                </div>
                <hr>
                <div class="products p-2">
                    <table class="table table-borderless">
                        <tbody>
                            <tr class="add">
                                <td></td>
                                <td>Subtotal</td>
                                <td></td>
                                <td class="text-center">Total</td>
                            </tr>
                            <tr class="content">
                                <td></td>
                                <td>{{number_format($total,2)}}</td>
                                <td>{{--number_format($total*0.16,2)--}}</td>
                                <td class="text-center">{{number_format($total,2)}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
               
                {{-- <hr>
                    <div class="row">
                    <div class="col-md-12">
            
                        <table class="table table-condensed table-striped table-responsive-sm" id="statement">
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
                                    <td><a href="{{ ($transaction->owed ==0 ? ($transaction->credit!=0 ? 'credit' : 'payment') : 'invoice').'/'.$transaction->docno}}">
                                            <span data-feather="arrow-right-circle" class="small text-success d-print-none"></span>
                                        </a>{{ ($transaction->owed ==0 ? ($transaction->credit!=0 ? 'CRD' : 'RCT') : 'INV').$transaction->docno}}</td>
                                    <td>{{$transaction->fname .' '.$transaction->lname }}</td>
                                    <td>{{ ($transaction->owed ==0 ? ($transaction->credit!=0 ? 'CRD' : 'RCT') : 'INV') }}</td>
                                    <td>{{ number_format($debit=$transaction->owed, 2) }}</td>
                                    <td>{{ ($transaction->credit!=0 ? number_format($credit=$transaction->credit, 2) : number_format($credit=$transaction->paid, 2) ) }}</td>
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
                </div>--}}
                <hr>
                <div class="address p-2">
                    <table class="table table-borderless">
                        <tbody>
                            <tr class="add">
                                <td>Bank Details</td>
                            </tr>
                            <tr class="content">
                                <td> Bank Name : {{env('ORG_BANK')}} <br> Swift Code : {{ env('ORG_BANK_SWIFT_CODE') }} <br> Account Holder : {{env('ORG_ACCOUNT_NAME')}}
                                    <br> Account Number : {{env('ORG_ACCOUNT_NO')}} <br>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
