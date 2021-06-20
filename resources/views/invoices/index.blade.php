@section('title', 'Invoices |')
@extends('layouts.app')
@section('content')
<div class="container py-3">
<h1>Invoices</h1>
        <a href="{{ route('invoice.create') }}" class="btn btn-sm btn-success">Create Invoice</a>

    </div>

    <table class="table table-hover">
        <thead>
        <tr>

            <th scope="col">Invoice No</th>
            <th scope="col">Member</th>
            <th scope="col">Invoice Date</th>
            <th scope="col">Due Date</th>
            <th>Total</th>
        </tr>
        </thead>
        <tbody>
        @foreach($invoices as $invoice)
            <tr>
                <td><a href="invoice/{{ $invoice->id }}"><span data-feather="arrow-right-circle" class="small text-success"></span></a>{{ $invoice->id }} </td>
                <td>{{ $invoice->member->fname.' '.$invoice->member->lname }}</td>
                <td>{{$invoice->invoice_date }}</td>
                <td>{{ $invoice->due_date }}</td>
                <td>{{ $invoice->amount }}</td>
                {{--<td>{{ ($invoice->status ? 'paid' : 'unpaid') }}</td>--}}
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="container-fluid align-content-lg-center">
        {{ $invoices->links() }}
    </div>

@endsection
