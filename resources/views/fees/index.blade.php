@extends('layouts.app')
@section('content')

    <table class="table table-hover">
        <thead>
        <tr>
            <th scope="col">Name</th>
            <th scope="col">Amount</th>


        </tr>
        </thead>
        <tbody>
        @foreach($fees as $fee)

            <tr>
                <th>  {{ $fee->name }}</th>
                <td> {{ $fee->amount }}</td>

            </tr>
        @endforeach


        </tbody>
    </table>

    <div class="container-fluid align-content-lg-center">
        {{ $fees->links() }}
    </div>

@endsection
