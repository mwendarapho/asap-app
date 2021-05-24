@extends('layouts.app')
@section('content')
    <div class="container-fluid">


        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">#id</th>
                <th scope="col">Amount</th>
                <th scope="col">Year</th>
                <th scope="col">Created On</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($subscriptions as $subscription)

                <tr>
                    <th>  {{ $subscription->id }}</th>
                    <td> {{ $subscription->amount }}</td>
                    <td> {{ $subscription->sub_year }}</td>
                    <td> {{ $subscription->created_at }}</td>
                </tr>
            @endforeach


            </tbody>
        </table>

    </div>
    <div class="container-fluid align-content-lg-center">
        {{ $subscriptions->links() }}
    </div>
@endsection

