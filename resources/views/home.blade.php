@extends('layouts.app')
@section('title','Dashboard')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas>

                    </div>
                </div>
            </div>
        </div>
    </div>
@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
    <script>
        var ctx = document.getElementById("myChart");
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ["Debit", "Credit"],
                datasets: [{
                    data: [
                        <?php
                        echo $data['debit'] . ',' . $data['credit'];
                        ?>
                    ],
                    lineTension: 0,
                    backgroundColor: [
                        'rgba(255, 205, 86, 0.3)',
                        'rgba(75, 192, 192, 0.3)',
                    ],
                    borderColor: [
                        'rgba(255, 205, 86)',
                        'rgba(75, 192, 192)',
                    ],
                    borderWidth: 1,

                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: false
                        }
                    }]
                },
                legend: {
                    display: false,
                }
            }
        });
    </script>
@endsection

@endsection
