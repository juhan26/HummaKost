@extends('app')

@section('content')
    <div class="container mb-6 mt-8">
        <div class="row">
            <!-- Cards Section -->
            <div class="col-md-3 mb-4">
                <div class="card text-center" style="background-color: #E6F4EA;">
                    <div class="card-body">
                        <div class="icon mb-2">
                            <img src="assets/img/images/iuran.png" alt="" style="width: 70px">
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
                            <img src="assets/img/images/pengguna.png" alt="" style="width: 70px">
                        </div>
                        <h5 class="card-title">Anggota</h5>
                        <p class="card-text">{{ $usersCount }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card text-center" style="background-color: #FFE8E5;">
                    <div class="card-body">
                        <div class="icon mb-2">
                            <img src="assets/img/images/perabotan.png" alt="" style="width: 70px">
                        </div>
                        <h5 class="card-title">Perabotan</h5>
                        <p class="card-text">{{ $facilityCount }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card text-center" style="background-color: #FFF6E5;">
                    <div class="card-body">
                        <div class="icon mb-2">
                            <img src="assets/img/images/rumah.png" alt="" style="width: 70px">
                        </div>
                        <h5 class="card-title">Kontrakan</h5>
                        <p class="card-text">{{ $propertiesCount }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="row h-100">
                    <div class="col-12 mb-4">
                        <div class="card h-100">
                            <div class="card-header">
                                <div class="card-title">Anggota Terdaftar</div>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-center">
                                    <canvas id="anggotChart" style="max-width: 100%; height: auto;"></canvas>
                                    <div class="total-count"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="card h-100">
                            <div class="card-header">
                                <div class="card-title">Pemasukan</div>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-center">
                                    <canvas id="pemasukanChart" style="max-width: 100%; height: auto;"></canvas>
                                    <div class="total-revenue"></div>
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
                        <div class="d-flex justify-content-center" style="max-height: 800px;">
                            <canvas id="dashboardChart" style="max-width: 700px; "></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const anggotCtx = document.getElementById('anggotChart').getContext('2d');
        const anggotChart = new Chart(anggotCtx, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sept', 'Oct', 'Nov', 'Des'],
                datasets: [{
                    label: 'Anggota Terdaftar',
                    data: [5, 10, 8, 12, 15, 14, 13, 19, 16, 18, 20, 19],
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Data for "Pemasukan"
        const pemasukanCtx = document.getElementById('pemasukanChart').getContext('2d');
        const pemasukanChart = new Chart(pemasukanCtx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sept', 'Oct', 'Nov', 'Des'],
                datasets: [{
                    label: 'Pemasukan',
                    data: [500, 700, 650, 1200, 1100, 1500, 1400, 1700, 1600, 1300, 1400, 1800],
                    fill: false,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 2
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        const ctx = document.getElementById('dashboardChart').getContext('2d');
        const dashboardChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Kontrakan : {{ $propertiesCount }}', 'Pengguna : {{ $usersCount }}',
                    'Perabotan : {{ $facilityCount }}', 'Contoh : '
                ],
                datasets: [{
                    data: [{{ $propertiesCount }}, {{ $usersCount }}, {{ $facilityCount }},
                        {{ $leasesCount }}
                    ],
                    backgroundColor: [
                        'rgba(255, 178, 15, 0.5)',
                        'rgba(9, 12, 155, 0.5)',
                        'rgba(196, 69, 54, 0.5)',
                        'rgba(75, 192, 192, 0.5)',

                    ],
                    borderColor: [
                        'rgba(255, 178, 15, 1)',
                        'rgba(9, 12, 155, 1)',
                        'rgba(196, 69, 54, 1)',
                        'rgba(75, 192, 192, 1)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',
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
