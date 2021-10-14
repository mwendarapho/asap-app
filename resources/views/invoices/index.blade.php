@section('title', 'Invoices')
@extends('layouts.app')
@section('styles')

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.11.2/b-2.0.0/datatables.min.css"/>
@endsection
@section('content')
<div class="container py-3">
<h1>Invoices</h1>
        <a href="{{ route('invoice.create') }}" class="btn btn-sm btn-success">Create Invoice</a>

    </div>

    <table class="table table-hover" id="invoice">
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
                <td><a href="invoice/{{ $invoice->docno }}"><span data-feather="arrow-right-circle" class="small text-success"></span></a>{{ $invoice->docno }} </td>
                <td>{{ $invoice->fname.' '.$invoice->lname }}</td>
                <td>{{$invoice->inv_date }}</td>
                <td>{{ $invoice->date }}</td>
                <td>{{ $invoice->amount }}</td>
                {{--<td>{{ ($invoice->status ? 'paid' : 'unpaid') }}</td>--}}
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="container-fluid align-content-lg-center">
        {{-- $invoices->links() --}}
    </div>

@stop
@section('scripts')
    <!-- DataTables -->

    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jq-3.3.1/dt-1.10.18/datatables.min.js" defer></script>

    <!--<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.11.2/b-2.0.0/datatables.min.js"></script>-->


    <script type="text/javascript">

        $(document).ready(function() {
            $('#invoice').DataTable();
        } );

    </script>

@endsection
