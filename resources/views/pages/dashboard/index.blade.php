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
                labels: [' Jumlah Data'], // Label untuk sumbu X
                datasets: [{
                        label: 'Kontrakan', // Label untuk Properties
                        data: [{{ $propertiesCount }}], // Data untuk Properties
                        backgroundColor: 'rgba(255, 99, 132, 0.2)', // Warna background untuk Properties
                        borderColor: 'rgba(255, 99, 132, 1)', // Warna border untuk Properties
                        borderWidth: 1
                    },
                    {
                        label: 'Pengguna', // Label untuk Users
                        data: [{{ $usersCount }}], // Data untuk Users
                        backgroundColor: 'rgba(54, 162, 235, 0.2)', // Warna background untuk Users
                        borderColor: 'rgba(54, 162, 235, 1)', // Warna border untuk Users
                        borderWidth: 1
                    },
                    {
                        label: 'Kontrak', // Label untuk Leases
                        data: [{{ $leasesCount }}], // Data untuk Leases
                        backgroundColor: 'rgba(75, 192, 192, 0.2)', // Warna background untuk Leases
                        borderColor: 'rgba(75, 192, 192, 1)', // Warna border untuk Leases
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
