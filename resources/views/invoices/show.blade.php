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

                <div class="table p-1">
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
                                <td class="font-weight-bold"> {{env('ORG_NAME')}}<br>{{ env('ORG_ADDRESS') }}, {{env('ORG_CITY')}}<br>{{ env('ORG_PHONE') }} </td>
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
               
                <hr>
                @include('statements.member_summary_statement')
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
                                <td>
                                    M-pesa Pay Bill No: {{env('ORG_PAYBILL_NO')}}<br>
                                    Account: {{env('ORG_PAYBILL_ACCOUNT')}}
                                </td>
                            </tr>
                            <tr>
                                <td>Make all cheques payable to {{env('ORG_NAME')}}</td>
                                <td>If you have any questions concerning this invoice, Please contact the office.</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class=" printed_at d-none d-print-block"><p>{{ Carbon\Carbon::now() }}</p></div>
        </div>
    </div>
</div>
@endsection
