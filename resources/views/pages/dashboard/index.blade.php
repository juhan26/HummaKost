@extends('app')

@section('content')
    <div class="container mb-6 mt-8">
        <div class="row">
            <!-- Cards Section -->
            <div class="col-md-3 mb-10">
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
            <div class="col-md-12 mb-8">
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
                <div class="card" style="width: 100">
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
                <div class="card" style="height: 98%">
                    {{-- <div class="card-header">
                    </div> --}}
                    <div class="card-body">
                        <div class="card-title">Pemasukan Perbulan</div>
                        <div class="d-flex justify-content-center">
                            <canvas id="lineChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            

            <div class="col-md-12 mt-8 mb-8">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Penyewa Yang Mendekati Batas Tenggat Pembayaran</div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive text-nowrap">
                            <table class="table">
                                <tr class="text-center" style="border-bottom: 1px solid rgba(0,0,0,.15);">
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Sekolah</th>
                                    <th>Kontrakan</th>
                                    <th>Tenggat Waktu</th>
                                    <th>Nominal Minimum Pembayaran</th>
                                    {{-- @if (request()->input('filter') === 'admin')
                                    <th>Kontrakan</th>
                                @else
                                    <th>Status</th>
                                @endif --}}
                                </tr>
                                <tbody class="table-border-bottom-0">
                                    @forelse ($leases as $index => $lease)
                                        @php
                                            foreach ($lease->payments as $payment) {
                                                $due_date = $payment->due_date;
                                            }
                                            $startReminderDate = \Carbon\Carbon::parse($due_date)->subDays(3);
                                            $endReminderDate = \Carbon\Carbon::parse($due_date);
                                            $daysLeft = today()->diffInDays(\Carbon\Carbon::parse($due_date));
                                        @endphp

                                        @if (today()->between($startReminderDate, $endReminderDate))
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>
                                                    <ul
                                                        class="list-unstyled m-0 d-flex avatar-group my-1 align-items-center mx-5">
                                                        <li data-bs-toggle="tooltip" data-bs-html="true"
                                                            title='<img src="{{ $lease->user->photo ? asset('storage/' . $lease->user->photo) : asset('assets/img/image_not_available.png') }}"  class="card-img-top img-fluid" alt="{{ $lease->user->name }}">'
                                                            class="avatar pull-up" data-popup="tooltip-custom"
                                                            data-bs-placement="top" id="tt">
                                                            @if ($lease->user->photo)
                                                                <!-- Jika foto pengguna ada, tampilkan foto tersebut -->
                                                                <img src="{{ asset('storage/' . $lease->user->photo) }}"
                                                                    class="rounded-circle" alt="{{ $lease->user->name }}">
                                                            @elseif ($lease->user->gender === 'male')
                                                                <!-- Jika jenis kelamin pengguna adalah male dan foto tidak ada, tampilkan avatar laki-laki -->
                                                                <img class="rounded-circle"
                                                                    src="../../assets/img/avatars/5.png" alt="Avatar">
                                                            @elseif ($lease->user->gender === 'female')
                                                                <!-- Jika jenis kelamin pengguna adalah female dan foto tidak ada, tampilkan avatar perempuan -->
                                                                <img class="rounded-circle"
                                                                    src="../../assets/img/avatars/10.png" alt="Avatar">
                                                            @endif
                                                        </li>
                                                        <li>
                                                            <span class="card-title ms-3">
                                                                {{ $lease->user->name }}
                                                            </span>
                                                        </li>
                                                    </ul>
                                                    <script>
                                                        document.addEventListener('DOMContentLoaded', () => {
                                                            const tooltip = document.querySelectorAll('#tt')
                                                            tooltip.forEach(t => {
                                                                new bootstrap.Tooltip(t);
                                                            });
                                                        });
                                                    </script>
                                                </td>
                                                <td class="text-center">
                                                    @if ($lease->user->gender === 'male')
                                                        <div class="w-100 px-5">
                                                            Laki-Laki
                                                        </div>
                                                    @else
                                                        <div class="w-100 px-5">
                                                            Perempuan
                                                        </div>
                                                    @endif
                                                </td>
                                                {{-- <td>
                                                <div class="w-100 px-5">
                                                    {{ $lease->user->email }}
                                                </div>
                                            </td> --}}
                                                <td>
                                                    @if ($lease->user->instance_id)
                                                        <div class="w-100 px-5">
                                                            {{ $lease->user->instance->name }}
                                                        </div>
                                                    @else
                                                        <div class="w-100 px-5">
                                                            Belum Memilih Sekolah
                                                        </div>
                                                    @endif
                                                </td>
                                                {{-- <td>
                                                <div class="w-100 px-5">
                                                    {{ $lease->user->phone_number }}
                                                </div>
                                            </td> --}}
                                                <td>
                                                    <div class="w-100 px-5">
                                                        {{ $lease->properties->name }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="w-100 px-5">
                                                        @if ($daysLeft > 0)
                                                            <p><strong style="color: red">{{ $daysLeft }} Hari
                                                                </strong>
                                                            </p>
                                                        @elseif ($daysLeft == 0)
                                                            <p style="color: red;">Hari ini adalah tenggat waktu!</p>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="w-100 px-5">
                                                        {{ 'Rp. ' . number_format($lease->properties->rental_price) }}
                                                    </div>
                                                </td>
                                                {{-- <td>
                                            @if (request()->input('filter') === 'admin')
                                                @php
                                                    $lease = \App\Models\Lease::where('user_id', $lease->user->id)->first();
                                                @endphp
                                                @if ($lease !== null)
                                                    <a class="text-decoration-underline "
                                                        href="{{ '/properties' . '/' . $lease->property_id }}">{{ $lease->properties->name }}</a>
                                                @else
                                                    <span>null</span>
                                                @endif
                                            @else
                                                @if ($lease->user->status === 'pending')
                                                    <span class="badge rounded-pill bg-label-warning me-1">Tertunda</span>
                                                @elseif ($lease->user->status === 'accepted')
                                                    <span class="badge rounded-pill bg-label-primary me-1">Diterima</span>
                                                @else
                                                    <span class="badge rounded-pill bg-label-danger me-1">Ditolak</span>
                                                @endif
                                            @endif
                                        </td>
                                        @php
                                            $adminAccess = 0;
                                            $userRole = Auth::user();

                                            if ($userRole->hasRole('admin')) {
                                                if ($user->hasRole('admin')) {
                                                    $adminAccess = 1;
                                                }
                                            }
                                        @endphp
                                        @if ($adminAccess === 0 && $user->status === 'pending')
                                            <td>
                                                <div class="w-100 px-5">
                                                    <div class="row w-100 ">
                                                        <div class="col-12 col-lg-6 mb-lg-1 mb-sm-3">
                                                            <form action="{{ route('user.accept', $user->id) }}" method="POST"
                                                                class="text-center w-100">
                                                                @csrf
                                                                <button type="submit"
                                                                    class="col-12 btn btn-label-success p-0 m-0 accept-button"
                                                                    style="width: fit-content;border:1px solid rgba(50, 200, 50,.2);">
                                                                    <span class="material-symbols-outlined ">check</span>
                                                                </button>
                                                            </form>
                                                        </div>
                                                        <div class="col-12 col-lg-6">
                                                            <form action="{{ route('user.reject', $user->id) }}" method="POST"
                                                                class="text-center w-100">
                                                                @csrf
                                                                <button type="submit"
                                                                    class="col-12 btn btn-label-danger p-0 m-0 reject-button"
                                                                    style="width: fit-content;border:1px solid rgba(200, 50, 50,.1);">
                                                                    <span class="material-symbols-outlined">close</span>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        @elseif ($adminAccess === 0 && request()->input('filter') === 'admin')
                                            @hasrole('super_admin')
                                                <td>
                                                    <div class="dropdown d-flex justify-content-center">
                                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                            data-bs-toggle="dropdown"><i class="ri-more-2-line"></i></button>
                                                        <div class="dropdown-menu">
                                                            <a href="#" class="dropdown-item" data-bs-toggle="modal"
                                                                data-bs-target="#editModal{{ $user->id }}"><i
                                                                    class="ri-pencil-line me-1"></i>Ubah</a>
                                                            <a href="#" class="dropdown-item" data-bs-toggle="modal"
                                                                data-bs-target="#dismissModal{{ $user->id }}"><i
                                                                    class="ri-close-circle-line me-1"></i>Berhentikan
                                                                sebagai ketua kontrakan</a>

                                                        </div>
                                                    </div>
                                                </td>
                                            @endhasrole
                                        @elseif ($adminAccess === 0 && $user->status !== 'pending')
                                            @hasrole('super_admin')
                                                <td>
                                                    <div class="dropdown d-flex justify-content-center">
                                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                            data-bs-toggle="dropdown"><i class="ri-more-2-line"></i></button>
                                                        <div class="dropdown-menu">
                                                            <a href="#" class="dropdown-item" data-bs-toggle="modal"
                                                                data-bs-target="#editModal{{ $user->id }}"><i
                                                                    class="ri-pencil-line me-1"></i>Ubah</a>
                                                            <a href="#" class="dropdown-item" data-bs-toggle="modal"
                                                                data-bs-target="#deleteModal{{ $user->id }}"><i
                                                                    class="ri-delete-bin-line me-1"></i>Hapus Anggota</a>

                                                        </div>

                                                    </div>
                                                </td>
                                            @endhasrole
                                        @elseif ($adminAccess === 1)
                                        @endif --}}
                                            </tr>
                                        @endif
                                    @empty
                                        <tr class="text-center">
                                            <!-- Update colspan to match the number of columns in your table -->
                                            <td colspan="8" class="">
                                                <h1 class="material-symbols-outlined mt-4"
                                                    style="font-size: 3rem;color:rgba(32, 180, 134,.4);">group</h1>
                                                <p class="card-title" style="color: rgba(0,0,0,.4)">Anggota tidak
                                                    ditemukan
                                                </p>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12 mt-4 ">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Daftar Penyewa yang sering telat melakukan Pembayaran (Perbulan) </div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-center">
                            <canvas id="latePaymentsChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12 mt-8 mb-4">
                <div class="card h-100">
                    <div class="card-header">
                        <div class="card-title">Calon Penyewa Tertunda</div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive text-nowrap" style="max-height: 400px; overflow: auto">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Nomor Telepon</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody style="max-height: 400px; overflow: auto">
                                    @php
                                        $pendingUsers = \App\Models\User::where('status', 'pending')->get();
                                    @endphp
                                    @forelse ($pendingUsers as $user)
                                        <tr>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->phone_number }}</td>
                                            <td>
                                                <span class="badge rounded-pill bg-label-warning me-1">Tertunda</span>
                                            </td>
                                        </tr>
                                    @empty
                                        <td colspan="4" class="text-center">Belum Ada Calon Penyewa</td>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end mt-3 mb-5 me-4">
                        <a href="{{ route('user.index') }}" class="btn btn-primary">Lihat Penyewa</a>
                    </div>
                </div>
            </div>

            <div class="col-md-12 mt-4">
                <div class="card h-100">
                    <div class="card-header">
                        <div class="card-title">Penyewa Terbaru</div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive text-nowrap" style="max-height: 400px; overflow: auto">
                            <table class="table mb-0">
                                <thead>
                                    <tr class="text-center" style="border-bottom: 1px solid rgba(0,0,0,.15);">
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Sekolah</th>
                                        <th>Kontrakan</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users->take(10) as $index => $user)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->gender === 'male' ? 'Laki-laki' : 'Perempuan' }}</td>
                                            <td>{{ $user->instance ? $user->instance->name : 'Belum Memilih Sekolah' }}
                                            </td>
                                            <td>{{ $user->lease ? $user->lease->properties->name : 'Belum Ada Kontrakan' }}
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


            const ctx = document.getElementById('latePaymentsChart').getContext('2d');

            const lateData = @json($lateData);

            console.log('Late Data:', lateData);
            const labels = Object.keys(lateData);

            const datasets = [];
            const users = @json($users->pluck('name', 'id'));

            Object.keys(users).forEach(userId => {
                const userLateData = labels.map(month => lateData[month] && lateData[month][userId] ? lateData[month][
                    userId
                ] : 0);

                // Filter untuk hanya menampilkan pengguna yang memiliki keterlambatan
                if (userLateData.some(daysLate => daysLate > 0)) {
                    datasets.push({
                        label: users[userId],
                        data: userLateData,
                        backgroundColor: `rgba(${Math.floor(Math.random() * 255)}, ${Math.floor(Math.random() * 255)}, ${Math.floor(Math.random() * 255)}, 0.5)`,
                        borderColor: `rgba(${Math.floor(Math.random() * 255)}, ${Math.floor(Math.random() * 255)}, ${Math.floor(Math.random() * 255)}, 1)`,
                        borderWidth: 1,
                        barThickness: 20, // Ukuran ketebalan bar
                        maxBarThickness: 25, // Ketebalan maksimum bar
                    });
                }
            });

            const myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: datasets
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
