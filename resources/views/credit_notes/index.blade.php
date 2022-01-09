@extends('layouts.app')
@section('title','Credit')
@section('styles')

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.11.2/b-2.0.0/datatables.min.css"/>
@endsection

@section('content')
@php
$doc_no=0;
$amount=0;
$member_id=0;
$balance=0;
@endphp

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <h1>Credit Note</h1>
            <a href="{{ route('credit.create') }}" class="btn btn-sm btn-success">Credit Invoice</a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-condensed table-striped table-responsive-sm" id="creditnote">
                <thead>
                    <tr>
                        <th scope="col">Date</th>
                        <th scope="col">CRD No</th>
                        <th scope="col">Member</th>
                        <th scope="col">Invoice No</th>
                        <th scope="col">Reference</th>
                        <th scope="col">Amount[KES]</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($credits as $credit)

                    <tr>
                        <td>{{$credit->credit_date}}</td>
                        <td>
                            <a href="{{'credit/'.$credit->id}}">
                                <span data-feather="arrow-right-circle" class="small text-success d-print-none"></span></a>
                            CRD {{ $credit->id}}
                        </td>
                        <td>{{$credit->member->fname.' '.$credit->member->lname}}</td>
                        <td>{{ $credit->invoice_id }}</td>
                        <td>{{ $credit->credit_ref }}</td>
                        <td>{{ number_format($credit->amount, 2) }}</td>

                    </tr>
                    @endforeach
                <tfoot>
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th>{{ number_format($balance,2) }}</th>
                </tfoot>
                </tfoot>
                </tbody>

            </table>
            <div class="container-fluid align-content-lg-center">
                {{ $credits->links() }}
            </div>
        </div>
    </div>


</div>
@stop
@section('scripts')
    <!-- DataTables -->

    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jq-3.3.1/dt-1.10.18/datatables.min.js" defer></script>

    <!--<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.11.2/b-2.0.0/datatables.min.js"></script>-->


    <script type="text/javascript">

        $(document).ready(function() {
            $('#creditnote').DataTable({
                "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
                
                buttons: [
                    'copy', 'excel', 'pdf'
                ] 
            });
        } );

    </script>

@endsection
