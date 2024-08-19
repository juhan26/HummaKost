@extends('app')

@section('content')
    <div class="container mb-4 mt-8">
        <div class="row">
            <!-- Cards Section -->
            <div class="col-md-3 mb-4">
                <div class="card text-center" style="background-color: #E6F4EA;">
                    <div class="card-body">
                        <div class="icon mb-2">
                            
                        </div>
                        <h5 class="card-title">Total Iuran</h5>
                        <p class="card-text">Rp. 300.000</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card text-center" style="background-color: #F3F0FF;">
                    <div class="card-body">
                        <div class="icon mb-2">
                            <!-- Add your icon here -->
                        </div>
                        <h5 class="card-title">Anggota</h5>
                        <p class="card-text">19</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card text-center" style="background-color: #FFE8E5;">
                    <div class="card-body">
                        <div class="icon mb-2">
                            <!-- Add your icon here -->
                        </div>
                        <h5 class="card-title">Perabotan</h5>
                        <p class="card-text">13</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card text-center" style="background-color: #FFF6E5;">
                    <div class="card-body">
                        <div class="icon mb-2">
                            <!-- Add your icon here -->
                        </div>
                        <h5 class="card-title">Kontrakan</h5>
                        <p class="card-text">2</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">

            <div class="col-md-6">
                <div class="row  h-100">

                    <div class="col-12 mb-lg-6 mb-md-6">
        
                        <div class="card h-100">
                            <div class="card-header">
                                <div class="card-title">Tenggat Pembayaran</div>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-center">
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-12 ">
        
                        <div class="card h-100">
                            <div class="card-header">
                                <div class="card-title">Tenggat Pembayaran</div>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-center">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Chart Section -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Chart</div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-center">
                            <canvas id="dashboardChart"></canvas>
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
            type: 'doughnut',
            data: {
                labels: ['Kontrakan : {{ $propertiesCount }}', 'Pengguna : {{ $usersCount }}',
                    'Perabotan : {{ $facilityCount }}', 'Contoh : '
                ],
                datasets: [{
                    data: [{{ $propertiesCount }}, {{ $usersCount }}, {{ $facilityCount }}, {{ $leasesCount }}],
                    backgroundColor: [
                        'rgba(9, 12, 155, 0.5)',
                        'rgba(196, 69, 54, 0.5)',
                        'rgba(75, 192, 192, 0.5)',
                        'rgba(255, 178, 15, 0.5)'
                        
                    ],
                    borderColor: [
                        'rgba(9, 12, 155, 1)',
                        'rgba(196, 69, 54, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 178, 15, 1)'
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
