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
                        <div class="card-title">Status Penyewa</div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-center">
                            <canvas id="dashboardChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Pemasukan Perbulan</div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-center">
                            <canvas id="lineChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12 mt-4">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Penyewa Yang Mendekati Batas Tenggat Pembayaran</div>
                </div>
                <div class="card-body">
                    <div class="row">
                        @forelse ($leases as $lease)
                            @php
                                foreach ($lease->payments as $payment) {
                                    $due_date = $payment->due_date;
                                }
                                $startReminderDate = \Carbon\Carbon::parse($due_date)->subDays(3);
                                $endReminderDate = \Carbon\Carbon::parse($due_date);
                                $daysLeft = today()->diffInDays(\Carbon\Carbon::parse($due_date));
                            @endphp
            
                            @if (today()->between($startReminderDate, $endReminderDate))
                                <div class="col-md-4 col-lg-4">
                                    <div class="card h-100" style="overflow: hidden">
                                        <span
                                            style="border-radius: 15px;height: 28px;top: 10px;right:10px;{{ $lease->total_nominal >= $lease->total_iuran ? 'border:1px solid rgba(50,200,50,.4);' : 'border:1px solid rgba(200,50,50,.4);' }}"
                                            class="badge fs-6 position-absolute {{ $lease->total_nominal >= $lease->total_iuran ? 'bg-label-success' : 'bg-label-danger' }}">
                                            {{ $lease->total_nominal >= $lease->total_iuran ? 'Lunas' : 'Belum Lunas' }}
                                        </span>
                                        <span
                                            style="border-radius: 15px;height: 28px;top: 10px;left:10px;border:1px solid rgba(50,50,200,.4);"
                                            class="badge fs-6 position-absolute bg-label-warning">
                                            {{ $lease->properties->name }}
                                        </span>
                                        @if ($lease->user->photo)
                                            <img src="{{ asset('storage/' . $lease->user->photo) }}" class=""
                                                alt="{{ $lease->user->name }}">
                                        @elseif ($lease->user->gender === 'male')
                                            <img class="" src="../../assets/img/avatars/5.png" alt="Avatar">
                                        @elseif ($lease->user->gender === 'female')
                                            <img class="" src="../../assets/img/avatars/10.png" alt="Avatar">
                                        @endif
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between p-0 m-1 align-items-center">
                                                <h4 class="card-title"><strong>{{ $lease->user->name }}</strong></h4>
                                            </div>
                                            <div style="height:fit-content;">
                                                <p class="card-text"
                                                    style="width:70%; overflow: hidden; text-overflow: ellipsis;display: -webkit-box;-webkit-line-clamp: 4;-webkit-box-orient: vertical">
                                                    @if ($daysLeft > 0)
                                                        <p>Penyewa ini memiliki tenggat waktu semakin dekat, <strong style="color: red">sisa {{ $daysLeft }} hari lagi!</strong>
                                                        </p>
                                                    @elseif ($daysLeft == 0)
                                                        <p style="color: red;">Hari ini adalah tenggat waktu!</p>
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                        <div class="modal-footer d-flex justify-content-end gap-2 align-items-center px-5 mb-5">
                                            <div>
                                                @if ($lease->total_nominal < $lease->total_iuran && $lease->status == 'active')
                                                    <button type="button" class="btn btn-primary" style="border-radius: 50px;"
                                                        data-bs-toggle="modal" data-bs-target="#createModal{{ $lease->id }}">
                                                        Bayar
                                                    </button>
                                                @endif
            
                                                <button type="button" class="btn btn-primary"
                                                    style="border-radius: 50px; background-color: #7B7EFF" data-bs-toggle="modal"
                                                    data-bs-target="#detailModal{{ $lease->id }}">
                                                    Detail
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @empty
                            <p>Tidak ada data yang tenggat waktunya tersisa 3 hari atau kurang.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        {{-- <div class="col-md-12">
            <div class="row h-100">
                @php
                    // Mengambil semua user yang memiliki status pending
                    $pendingUsers = \App\Models\User::where('status', 'pending')->get();
                @endphp

                <div class="col-12 mt-4">
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
        </div> --}}
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        var data = @json($leasesPerMonth);
        var currentMonth = new Date().getMonth();

        var months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        var latestMonth = months.slice(0, currentMonth + 1);
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
                categories: latestMonth,
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
                labels: ['Diterima : {{ $userAccepted }}', 'Pending : {{ $userPending }}',
                    'Ditolak : {{ $userRejected }}'

                ],
                datasets: [{
                    data: [
                        {{ $userAccepted }},
                        {{ $userPending }},
                        {{ $userRejected }},
                    ],
                    backgroundColor: [
                        'rgb(32, 180, 133)',
                        'rgb(255, 193, 7)',
                        'rgb(220, 53, 69)',
                    ],
                    borderColor: [
                        'rgb(32, 180, 133)',
                        'rgb(255, 193, 7)',
                        'rgb(220, 53, 69)',
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

        var incomeMonthlyTotals = @json($incomeMonthlyTotals);
        const lineCtx = document.getElementById('lineChart').getContext('2d');
        const lineChart = new Chart(lineCtx, {
            type: 'line',
            data: {
                labels: latestMonth,
                datasets: [{
                    label: 'Pemasukan Perbulan',
                    data: Object.values(incomeMonthlyTotals),
                    fill: false,
                    borderColor: 'rgb(75, 192, 192)',
                    tension: 0.1
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
                                const label = context.dataset.label || '';
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
