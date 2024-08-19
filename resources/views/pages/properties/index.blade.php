@extends('app')

@section('content')
    <div class="container" style="min-height: 200px">
        <div class="d-flex flex-column flex-md-row align-items-center justify-content-between mb-4"
            style="padding: 50px 0 30px 0;">
            <h3 class="m-0 mb-3 mb-md-0"><strong>List Kontrakan</strong></h3>
            <div class="d-flex flex-column flex-md-row align-items-center" style="gap: 15px; position: relative; width: 70%;">
                <input type="text" class="form-control"
                    style="border: 0; background-color: rgba(32,180,134,0.1); border-radius: 15px; height: 60px; outline: none; "
                    value="{{ request('search') }}" placeholder="Cari...">
                <a href="{{ route('properties.create') }}" class="btn"
                    style="width: 160px; padding: 15px 0 ;border-radius: 10px; background-color: rgba(32,180,134,1);color: white;font-size: 16px"><i
                        class="ri-add-line ri-20px"></i>Tambah</a>
                {{-- <i class="ri-search-line ri-20px"

                {{-- style="position: absolute; top: 25%;transform: translateY(-50%); left: 10px;"></i>  --}}
            </div>
        </div>

        <div class="container">
            <div class="row">
                @foreach ($properties as $property)
                    <div class="col-md-4 mb-4">
                        <div class="card shadow-sm position-relative" style="border-radius: 20px; overflow: hidden;">
                            <!-- Edit and Delete Icons -->
                            <div class="position-absolute top-0 end-0 p-2 d-flex gap-2" style="display: none;"
                                id="card-actions-{{ $property->id }}">
                                <a href="{{ route('properties.edit', $property->id) }}" class="btn btn-primary btn-sm">
                                    <i class="ri-edit-line"></i>
                                </a>
                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal{{ $property->id }}">
                                    <i class="ri-delete-bin-line"></i>
                                </button>
                            </div>

                            <img src="{{ $property->image ? asset('storage/' . $property->image) : asset('/assets/img/image_not_available.png') }}"
                                alt="{{ $property->name }}" class="card-img-top" style="height: 250px; object-fit: cover;">

                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h5 class="m-0" style="color: rgba(32,180,134,1)">
                                        <i
                                            class="ri-calendar-line ri-20px me-2"></i>{{ \Carbon\Carbon::parse($property->created_at)->locale('id')->translatedFormat('j F Y') }}
                                    </h5>
                                    <span class="badge rounded-pill bg-light"
                                        style="padding: 8px 20px; color: rgba(32,180,134,0.7); background-color: rgba(32,180,134,0.2);">Tersedia</span>
                                </div>
                                <h4 class="card-title"><strong>{{ $property->name }}</strong></h4>
                                <p class="card-text" style="height: 80px; overflow: hidden; text-overflow: ellipsis;">
                                    {{ $property->description ? $property->description : 'Deskripsi Kosong' }}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5 class="m-0" style="color: rgba(32,180,134,1)">Rp.
                                        {{ number_format($property->rental_price, 0, ',', '.') }} / bln</h5>

                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#propertyDetailModal">
                                        Detail
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Property Detail Modal -->
                    <div class="modal fade" id="propertyDetailModal" tabindex="-1"
                        aria-labelledby="propertyDetailModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="propertyDetailModalLabel">Detail Kontrakan
                                        {{ $property->name }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="card">
                                        <div class="card-content">
                                            <div class="card-body">
                                                {{-- properties --}}
                                                <div class="row row-cols-1 row-cols-md-3 g-6 my-5">
                                                    <div class="col-12 col-lg-6">
                                                        @if ($property->image)
                                                            <img class="card-img-top"
                                                                src="{{ asset('storage/' . $property->image) }}"
                                                                alt="Card image cap" />
                                                        @else
                                                            <img class="card-img-top"
                                                                src="{{ asset('assets/img/image_not_available.png') }}"
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
                                                                <p style="color: blue;">
                                                                    Ketua Kontrakan: {{ $lease->user->name }}
                                                                    <a data-bs-toggle="modal"
                                                                        data-bs-target="#editPropertyLeaderModal"
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
                                                                <a data-bs-toggle="modal"
                                                                    data-bs-target="#addPropertyLeaderModal"
                                                                    style="text-decoration: underline; color:blue; cursor: pointer;">Tambah
                                                                    Ketua</a>
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
                                                    <div class="col-12 col-lg-2 text-lg-end mt-3 mt-lg-0">
                                                        @hasrole('super_admin')
                                                            <button type="button" class="btn btn-primary w-100"
                                                                data-bs-toggle="modal" data-bs-target="#createModal">
                                                                Tambah Kontrak
                                                            </button>
                                                        @endhasrole
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- ANGGOTA --}}
                                    <div class="card mt-3">
                                        <div class="card-content">
                                            <div class="card-header">
                                                <h3 class="card-title">Daftar Anggota</h3>
                                            </div>
                                            <div class="card-body d-flex justify-content-center">
                                                @forelse ($property->leases as $lease)
                                                    <div class="text-center" style="min-width: 12rem; flex-shrink: 0;">
                                                        <img class="rounded-circle mx-auto d-block"
                                                            style="width: 5rem; height: 5rem;"
                                                            src="{{ $lease->user->photo ? asset('storage/' . $lease->user->photo) : asset('assets/img/image_not_available.png') }}"
                                                            alt="{{ $lease->user->name }}">
                                                        <h4 class="card-title mt-3">{{ $lease->user->name }}</h4>
                                                        <p class="card-text text-muted">{{ $lease->user->status }}</p>
                                                    </div>
                                                @empty
                                                    <div class="swiper-slide text-center text-black">Belum ada anggota
                                                    </div>
                                                @endforelse
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Facility --}}
                                    <div class="card mt-3 mb-6">
                                        <div class="card-content">
                                            <div class="card-header">
                                                <h3 class="card-title">Daftar Facility</h3>
                                            </div>
                                            <div class="card-body d-flex justify-content-center">
                                                @forelse ($property->facilities as $facility)
                                                    <div class="text-center" style="min-width: 12rem; flex-shrink: 0;">
                                                        <img class="mx-auto d-block" style="width: 5rem; height: 5rem;"
                                                            src="{{ $facility->photo ? asset('storage/' . $facility->photo) : asset('/assets/img/image_not_available.png') }}"
                                                            alt="{{ $facility->name }}">
                                                        <h4 class="card-title mt-3">{{ $facility->name }}</h4>
                                                        <p class="card-text text-muted">{{ $facility->status }}</p>
                                                    </div>
                                                @empty
                                                    <div class="swiper-slide text-center text-black">Belum ada fasilitas
                                                    </div>
                                                @endforelse
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
                                                                <div style="width: 100%;height: 83vh;border-radius: 10px"
                                                                    id="map"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="w-full md:w-1/3 bg-white shadow-lg rounded-lg overflow-hidden">
                                                        <div class="map-container">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Include Leaflet CSS and JS -->


                                    <script>
                                        var lat = -7.896591;
                                        var lng = 112.6089657;
                                        var zoomLevel = 18;

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

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Add Property Leader Modal -->
                    {{-- <div class="modal fade" id="addPropertyLeaderModal" tabindex="-1"
                        aria-labelledby="addPropertyLeaderModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addPropertyLeaderModalLabel">Tambah Ketua Kontrakan</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form action="{{ route('properties.addPropertyLeader') }}" method="POST">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="col-12 col-lg-12 mb-3">
                                            <label for="user_id" class="form-label">Pilih Ketua Kontrakan</label>
                                            <select name="user_id" id="user_id" class="form-select">
                                                @forelse ($addUserPropertyLeader as $user)
                                                    <option value="{{ $user->user->id }}">{{ $user->user->name }}
                                                    </option>
                                                @empty
                                                    <option value="">Belum Ada Yang Mengontrak di Kontrakan Ini
                                                    </option>
                                                @endforelse
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-primary">Tambah</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div> --}}

                    <!-- Delete Modal -->
                    <div class="modal fade" id="deleteModal{{ $property->id }}" tabindex="-1"
                        aria-labelledby="deleteModalLabel{{ $property->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteModalLabel{{ $property->id }}">Hapus Properti</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Apakah Anda yakin ingin menghapus properti ini?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Batal</button>
                                    <form action="{{ route('properties.destroy', $property->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endsection
