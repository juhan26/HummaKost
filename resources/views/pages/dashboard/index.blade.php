@extends('app')

@section('content')
    <div class="container mb-8">
        <div class="row justify-content-end">
            {{-- Chart Section --}}
        </div>
    </div>

    <div class="container">
        <div class="row justify-content-end">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            Chart
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="mt-4 d-flex justify-content-center">
                            <div style="width: 100%;"> <!-- Adjust the width as needed -->
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
            type: 'pie', 
            data: {
                labels: ['Kontrakan : {{ $propertiesCount }}', 'Pengguna : {{ $usersCount }}', 'Perabotan : {{ $furnitureCount }}'],
                datasets: [{
                    data: [{{ $propertiesCount }}, {{ $usersCount }}, {{ $furnitureCount }}],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(75, 192, 192, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(75, 192, 192, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const label = context.label || '';
                                const value = context.raw || 0;
                                return `${label}: ${value}`;
                            }
                        }
                    }
                }
            }
        });
    </script>
@endsection
