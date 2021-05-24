@section('title', 'Invoices |')
@extends('layouts.app')
@section('content')

    <table class="table table-hover">
        <thead>
        <tr>

            <th scope="col">#</th>
            <th scope="col">Member ID</th>
            <th scope="col">Amount</th>

            <th scope="col">Date</th>
            <th scope="col">Description</th>
            <th scope="col">Status</th>
            <th>Status</th>
        </tr>
        </thead>
        <tbody>
        @foreach($invoices as $invoice)
            <tr>
                <td>{{ $invoice->id }}</td>
                <td>{{ $invoice->member_id }}</td>
                <td>{{ $invoice->amount }}</td>
                <td>{{ $invoice->date }}</td>
                <td>{{ $invoice->description }}</td>
                <td>{{ ($invoice->status ? 'paid' : 'unpaid') }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="container-fluid align-content-lg-center">
        {{ $invoices->links() }}
    </div>

@endsection
