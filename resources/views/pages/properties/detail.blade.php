@extends('app')
@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-content">
                <div class="card-header">
                    <div class="row">
                        <div class="col-12 col-lg-12">
                            <h3 class="card-title">
                                Detail Kontrakan {{ $property->name }}
                            </h3>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb breadcrumb-style1">
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('properties.index') }}"
                                            class="text-decoration-underline">Kontrakan</a>
                                    </li>
                                    <li class="breadcrumb-item active">Detail</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    {{-- properties --}}
                    <div class="row row-cols-1 row-cols-md-3 g-6 my-5">
                        <div class="col-12 col-lg-6">
                            @if ($property->image)
                                <img class="card-img-top" src="{{ asset('storage/' . $property->image) }}"
                                    alt="Card image cap" />
                            @else
                                <img class="card-img-top" src="{{ asset('assets/img/image_not_available.png') }}"
                                    alt="Card image cap" />
                            @endif
                        </div>
                        <div class="col-12 col-lg-6 ">
                            <h1 class="text-secondary-emphasis">{{ $property->name }}</h1>
                            <h5 class="text-secondary">{{ $property->description }}</h5>
                            @php
                                $status = false;
                            @endphp
                            @foreach ($property->leases as $lease)
                                @if ($lease->user->hasRole('admin'))
                                    <p style="color: blue;">Ketua Kontrakan: {{ $lease->user->name }} <a
                                            data-bs-toggle="modal" data-bs-target="#editPropertyLeaderModal"
                                            style="text-decoration: underline; color:purple; cursor: pointer;">Ubah
                                            Ketua</a>
                                    </p>
                                    @php
                                        $status = true;
                                    @endphp
                                @endif
                            @endforeach

                            @if ($status == false)
                                <p style="color: red;">
                                    Belum Ada Ketua Kontrakan
                                    <a data-bs-toggle="modal" data-bs-target="#addPropertyLeaderModal"
                                        style="text-decoration: underline; color:blue; cursor: pointer;">Tambah Ketua</a>
                                </p>
                            @endif

                            <h2 class="fw-bold text-secondary my-6">
                                {{ 'Rp. ' . number_format($property->rental_price, 0) }}</h2>
                            <div class="badge fs-6 bg-label-secondary mt-6 me-3">Total Orang:
                                <strong>{{ $property->leases->count() }}</strong>
                            </div>
                            /
                            <div class="badge fs-6 bg-label-warning mt-6 me-3">Kapasitas:
                                <strong>{{ $property->capacity }}</strong>
                            </div>
                            @if ($property->status === 'available')
                                <div class="badge fs-6 bg-label-success mt-6">Tersedia</div>
                            @else
                                <div class="badge fs-6 bg-label-danger mt-6">Full</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ANGGOTA --}}
    <div class="col-12">
        <div class="card">
            <div class="card-content">
                <div class="card-header">
                    <div class="row">
                        <div class="col-12 col-lg-12 d-flex justify-content-around">
                            <h3 class="card-title">
                                Daftar Anggota
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="card-body d-flex justify-content-center">
                    @forelse ($property->leases as $lease)
                        <div class="text-center" style="min-width: 12rem; flex-shrink: 0;">
                                <img class="rounded-circle mx-auto d-block" style="width: 5rem; height: 5rem;"
                                    src="{{ $lease->user->photo ? asset('storage/' . $lease->user->photo) : asset('assets/img/image_not_available.png') }}"
                                    alt="{{ $lease->user->name }}">
                                <h4 class="card-title mt-3">{{ $lease->user->name }}</h4>
                                <p class="card-text text-muted">{{ $lease->user->status }}</p>
                        </div>
                    @empty
                        <div class="swiper-slide text-center text-black">Belum ada anggota</div>
                    @endforelse

                </div>
            </div>
        </div>
    </div>

    {{-- Furniture --}}
    <div class="col-12">
        <div class="card">
            <div class="card-content">
                <div class="card-header">
                    <div class="row">
                        <div class="col-12 col-lg-12 d-flex justify-content-around">
                            <h3 class="card-title">
                                Daftar Furniture
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="card-body d-flex justify-content-center">
                    @forelse ($property->furnitures as $furniture)
                        <div class="text-center" style="min-width: 12rem; flex-shrink: 0;">
                                <img class="mx-auto d-block" style="width: 5rem; height: 5rem;"
                                    src="{{ $furniture->photo ? asset('storage/' . $furniture->photo) : asset('/assets/img/image_not_available.png') }}"
                                    alt="{{ $furniture->name }}">
                                <h4 class="card-title mt-3">{{ $furniture->name }}</h4>
                                <p class="card-text text-muted">{{ $furniture->status }}</p>
                        </div>
                    @empty
                        <div class="swiper-slide text-center text-black">Belum ada furniture</div>
                    @endforelse

                </div>
            </div>
        </div>
    </div>

    {{-- MAPS --}}
    <div class="col-12">
        <div class="card">
            <div class="card-content">
                <div class="card-header">
                    <div class="row">
                        <div class="col-12 col-lg-12 d-flex justify-content-around">
                            <h3 class="card-title">
                                Lokasi
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-lg-12">
                            <div class="map-container">
                                <div style="width: 100%;height: 83vh;border-radius: 10px" id="map"></div>
                            </div>
                        </div>
                    </div>
                    <div class="w-full md:w-1/3 bg-white shadow-lg rounded-lg overflow-hidden">
                        <div class="map-container">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Property Leader Modal -->
    <div class="modal fade" id="addPropertyLeaderModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Ketua Kontrakan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('properties.addPropertyLeader') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="col-12 col-lg-12 mb-3">
                            <label for="user_id" class="form-label">Pilih Ketua Kontrakan</label>
                            <select name="user_id" id="user_id" class="form-select" value="{{ old('user_id') }}">
                                @forelse ($addUserPropertyLeader as $user)
                                    <option value="{{ $user->user->id }}">{{ $user->user->name }}</option>
                                @empty
                                    <option value="">Belum Ada Yang Mengontrak di Kontrakan Ini</option>
                                @endforelse
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Add Property Leader Modal -->

    <!-- Change Property Leader Modal -->
    <div class="modal fade" id="editPropertyLeaderModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ubah Ketua Kontrakan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('properties.editPropertyLeader', $property->id) }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="col-12 col-lg-12 mb-3">
                            <label for="user_id" class="form-label">Ubah Ketua Kontrakan</label>
                            <select name="user_id" id="user_id" class="form-select" value="{{ old('user_id') }}">
                                @forelse ($editUserPropertyLeader as $user)
                                    <option value="{{ $user->user->id }}">{{ $user->user->name }}</option>
                                @empty
                                    <option value="">Belum Ada Yang Mengontrak di Kontrakan Ini</option>
                                @endforelse
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Change Property Leader Modal -->
>>>>>>> c846f9e7b563fafae79af20ad9829c3e451d0708

    <script>
        var lat = -7.896591;
        var lng = 112.6089657;
        var zoomLevel = 16;

        var map = L.map('map').setView([lat, lng], zoomLevel);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        var waypoints = [{
                latLng: L.latLng(<?php echo json_encode($property->langtitude); ?>, <?php echo json_encode($property->longtitude); ?>),
                title: <?php echo json_encode($property->name); ?>,
                address: <?php echo json_encode($property->address); ?>,
            },
            {
                latLng: L.latLng(-7.900063, 112.6068816),
                title: "Hummasoft / Hummatech (PT Humma Teknologi Indonesia)",
                address: "Perum Permata Regency 1, Blk. 10 No.28, Perun Gpa, Ngijo, Kec. Karang Ploso, Kabupaten Malang, Jawa Timur 65152"
            }
        ];

        var routingControl = L.Routing.control({
            waypoints: waypoints.map(function(wp) {
                return wp.latLng;
            }),
            routeWhileDragging: true,
            createMarker: function(i, wp, nWps) {
                var popupContent = waypoints[i].title + "<br><br><b>Address:</b>" + waypoints[i].address;
                var marker = L.marker(wp.latLng).bindPopup(popupContent);
                return marker;
            }
        }).addTo(map);
    </script>
@endsection
