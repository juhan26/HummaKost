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
                        <h5 class="card-title">Total Instansi</h5>
                        <p class="card-text">{{ $instanceCount }}</p>
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
                        <h5 class="card-title">Fasilitas</h5>
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

        {{-- <div class="row">
            <div class="col-md-7">
                <div class="row h-100">
                    @php
                        // Mengambil semua user yang memiliki status pending
                        $pendingUsers = \App\Models\User::where('status', 'pending')->get();
                    @endphp

                    <div class="col-12 mb-6">
                        <div class="card h-100">
                            <div class="card-header">
                                <div class="card-title">Anggota Tertunda</div>
                            </div>
                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($pendingUsers as $user)
                                            <tr>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>
                                                    <span class="badge rounded-pill bg-label-warning me-1">Tertunda</span>
                                                </td>
                                            </tr>
                                        @empty
                                            <td colspan="3" class="text-center">Belum Ada Calon Penyewa</td>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-end mt-3 mb-5 me-4">
                                <!-- Menambahkan filter ke route agar hanya menampilkan pengguna dengan status pending -->
                                <a href="{{ route('user.index') }}" class="btn btn-primary">Lihat Anggota</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 ">

                        <div class="card h-100">
                            <div class="card-header">
                                <div class="card-title">Anggota Terdaftar</div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive text-nowrap">
                                    <table class="table mb-0">
                                        <thead>
                                            <tr class="text-center" style="border-bottom: 1px solid rgba(0,0,0,.15);">
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>Jenis Kelamin</th>
                                                <th>Email</th>
                                                <th>Sekolah</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($users->take(10) as $index => $user)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $user->name }}</td>
                                                    <td>{{ $user->gender === 'male' ? 'Laki-laki' : 'Perempuan' }}</td>
                                                    <td>{{ $user->email }}</td>
                                                    <td>{{ $user->instance ? $user->instance->name : 'Belum Memilih Sekolah' }}
                                                    </td>
                                                    <td>
                                                        <span
                                                            class="px-2 py-1 rounded-lg
                                                            {{ $user->status === 'accepted' ? 'badge rounded-pill bg-label-primary' : 'badge rounded-pill bg-label-danger' }}">
                                                            {{ $user->status === 'accepted' ? 'Diterima' : 'Ditolak' }}
                                                        </span>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="d-flex justify-content-end mt-3">
                                    <a href="{{ route('user.index') }}" class="btn btn-primary">Lihat Anggota</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Chart Section -->
            <div class="col-md-5">
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

            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Chart</div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-center" style="max-height: 800px;">
                            <canvas id="barChart" style="max-width: 700px; "></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}

        <div class="row">
            <div class="col-md-12 mb-4">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Data Penyewa Perbulan</div>
                    </div>
                    <div class="card-body">
                        <div id="barChart"></div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Doughnut Chart</div>
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
        var data = @json($leasesPerMonth);
        var options = {
            series: data,
            chart: {
                type: 'bar',
                height: 350
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '55%',
                    endingShape: 'rounded'
                },
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                show: true,
                width: 2,
                colors: ['transparent']
            },
            xaxis: {
                categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct'],
            },
            // yaxis: {
            //     title: {
            //         text: 'Penyewa'
            //     }
            // },
            fill: {
                opacity: 1
            },
            tooltip: {
                y: {
                    formatter: function(val) {
                        return val + " Penyewa"
                    }
                }
            }
        };

        var chart = new ApexCharts(document.querySelector("#barChart"), options);
        chart.render();



        const doughnutCtx = document.getElementById('dashboardChart').getContext('2d');
        const dashboardChart = new Chart(doughnutCtx, {
            type: 'doughnut',
            data: {
                labels: ['Kontrakan : {{ $propertiesCount }}', 'Anggota : {{ $usersCount }}',
                    'Fasilitas : {{ $facilityCount }}', 'Instansi: {{ $instanceCount }}'
                ],
                datasets: [{
                    data: [{{ $propertiesCount }}, {{ $usersCount }}, {{ $facilityCount }},
                        {{ $instanceCount }}
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
