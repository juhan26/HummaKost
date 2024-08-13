@extends('app')

@section('content')
    <div class="container mb-8">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ __('You are logged in!') }}

                        {{-- Chart Section --}}

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            Chart
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="mt-4">
                            <canvas id="dashboardChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('dashboardChart').getContext('2d');
        const dashboardChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [' Jumlah Data'],
                datasets: [{
                        label: 'Kontrakan', 
                        data: [{{ $propertiesCount }}],
                        backgroundColor: 'rgba(255, 99, 132, 0.2)', 
                        borderColor: 'rgba(255, 99, 132, 1)', 
                        borderWidth: 1
                    },
                    {
                        label: 'Pengguna', 
                        data: [{{ $usersCount }}], 
                        backgroundColor: 'rgba(54, 162, 235, 0.2)', 
                        borderColor: 'rgba(54, 162, 235, 1)', 
                        borderWidth: 1
                    },
                    {
                        label: 'Kontrak', 
                        data: [{{ $leasesCount }}], 
                        backgroundColor: 'rgba(75, 192, 192, 0.2)', 
                        borderColor: 'rgba(75, 192, 192, 1)', 
                        borderWidth: 1
                    }
                ]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endsection
