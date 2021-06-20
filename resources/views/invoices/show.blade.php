@section('title', 'Invoices |')
@extends('layouts.app')
@section('content')


<!--include css--->
@push('styles')
<link href="{{ asset('css/invoice.css') }}" rel="stylesheet">
@endpush

<!--End of css-->

<div class="container mt-5 mb-3">
    <div class="row d-flex justify-content-center">
        <div class="col-md-8">
            <div class="pageNo">
                <a href="{{ $invoice->id-1 }}"><span data-feather="arrow-left-circle" class="small text-white"></span></a>
                <span class="text-white">{{$invoice->id}}</span>
                <a href="{{ $invoice->id+1 }}"><span data-feather="arrow-right-circle" class="small text-white"></span></a>
            </div>


            <div class="card">
                <table class="table">
                    <tr>
                        <td class="text-center inv" colspan="3"> Tax Invoice</td>
                    </tr>
                    <tr>
                        <td class="text-center">Invoice No</td>
                        <td class="text-right">Invoice Date</td>
                        <td>{{date_format($invoice->created_at,'Y-m-d')}}</td>
                    </tr>
                    <tr>
                        <td class="text-center">INV-{{$invoice->id}}</td>
                        <td class="text-right">Due Date </td>
                        <td>{{$invoice->due_date}}</td>
                    </tr>
                </table>
                <!--<div class="d-flex flex-row p-2">  {{ config('app.name', 'Laravel') }}
                        <div class="d-flex flex-column">
                        <span class="font-weight-bold">Tax Invoice</span>
                            <small>INV-{{$invoice->id}} <br>
                            Invoice Date {{date_format($invoice->created_at,'Y-m-d')}} <br>
                            Due Date {{$invoice->due_date}}</small>
                            </div>
                    </div>
                <hr>-->
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
                                <td class="font-weight-bold"> Test Organization <br>P.O Box 10028-00100, Lusaka Rd<br> Nairobi</td>
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
                            @foreach($invoice->member->item as $item)
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
                                <td>Tax(16%)</td>
                                <td class="text-center">Total</td>
                            </tr>
                            <tr class="content">
                                <td></td>
                                <td>{{number_format($total,2)}}</td>
                                <td>{{number_format($total*0.16,2)}}</td>
                                <td class="text-center">{{number_format($total*1.16,2)}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <hr>
                <div class="address p-2">
                    <table class="table table-borderless">
                        <tbody>
                            <tr class="add">
                                <td>Bank Details</td>
                            </tr>
                            <tr class="content">
                                <td> Bank Name : ADS BANK <br> Swift Code : ADS1234Q <br> Account Holder : Jelly Pepper
                                    <br> Account Number : 5454542WQR <br>
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