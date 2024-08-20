@extends('app')
@section('content')
    <div class="col-12">
        <div class="">
            <div class="">
                <div class="">
                    <div class="row align-items-center">
                        <div class="col-12 col-lg-10">
                            <h3 class="mt-5">
                                <strong>Detail Kontrakan "{{ $property->name }}"</strong>
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
                        <div class="col-12 col-lg-2 text-lg-end ms-auto mt-3 mt-lg-0">
                            @hasrole('super_admin')
                                <button type="button" class="btn btn-primary w-75" data-bs-toggle="modal"
                                    data-bs-target="#createModal">
                                    Tambah Kontrak
                                </button>
                            @endhasrole
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row row-cols-1 row-cols-md-3 g-6 my-5">
            <div class="col-12 col-lg-6">
                @if ($property->image)
                    <img class="card-img-top" src="{{ asset('storage/' . $property->image) }}" alt="Card image cap" />
                @else
                    <img class="card-img-top" src="{{ asset('assets/img/image_not_available.png') }}"
                        alt="Card image cap" />
                @endif
            </div>
            <div class="col-12 col-lg-6 ">
                <h1 class="text-secondary-emphasis">{{ $property->name }}</h1>
                <h5 class="text-secondary">{{ $property->description }}</h5>

                <h2 class="fw-bold text-primary my-6">
                    {{ 'Rp. ' . number_format($property->rental_price, 0) . '/ bln' }}</h2>


            @if ($property->status === 'available')
                    <span class="label bg-label-primary me-2" style="padding: 8px 20px; border-radius: 15px;"><strong>Tersedia </strong></span>
              @else
            <span class="label bg-label-danger me-2" style="padding: 8px 20px; border-radius: 15px;"><strong>Full</strong></span>
            @endif

            <span class="label me-2" style="padding: 8px 20px; border-radius: 15px; color: purple; background-color:rgb(248, 216, 248) ;">Total Orang: <strong>{{ $property->leases->count() }}</strong></span>
            <span class="label bg-label-warning me-2" style="padding: 8px 20px; border-radius: 15px;">Kapasitas: <strong>{{ $property->capacity }}</strong></span>

            @if ($property->gender_target === 'male')  
                    <span class="label rounded-pill bg-label-info" style="padding: 8px 20px; border-radius: 15px;">
                        <i class="mdi ri-men-line"></i> Laki-Laki
                    </span>
                @else
                    <span class="label rounded-pill bg-label-danger" style="padding: 8px 20px; border-radius: 15px;">
                        <i class="mdi ri-women-line"></i> Perempuan
                    </span>
                @endif

            @php
                $status = false;
            @endphp
            @foreach ($property->leases as $lease)
                @if ($lease->user->hasRole('admin'))
                    <p style="color: #20b486;" class="mt-10">Ketua Kontrakan: {{ $lease->user->name }}
                        <a data-bs-toggle="modal" class="btn btn-primary ms-3" data-bs-target="#editPropertyLeaderModal"
                            style="text-decoration; color: white;">+</a>
                    </p>
                    @php
                        $status = true;
                    @endphp
                @endif
            @endforeach

            @if ($status == false)
                <p style="color: red;" class="mt-10">
                    *Belum Ada Ketua Kontrakan
                    <a data-bs-toggle="modal" data-bs-target="#addPropertyLeaderModal" class="btn btn-primary ms-3"
                        style="text-decoration; color: white;">+</a>
                </p>
            @endif
        </div>
    </div>

    </div>

    <!-- ANGGOTA -->
    <h3 class="card-title m-0 mt-10">Daftar Anggota -</h3>
    <div class="col-12 mb-12">
        <div class="card shadow-sm">

            <div class="card-body d-flex justify-content-center flex-wrap gap-4">
                @forelse ($property->leases as $lease)
                    <div class="text-center" style="width: 12rem;">
                        <img class="rounded-circle mx-auto d-block" style="width: 5rem; height: 5rem;"
                            src="{{ $lease->user->photo ? asset('storage/' . $lease->user->photo) : asset('assets/img/image_not_available.png') }}"
                            alt="{{ $lease->user->name }}">
                        <h4 class="mt-3 mb-1">{{ $lease->user->name }}</h4>
                        <p class="text-muted mb-0">{{ $lease->user->status }}</p>
                    </div>
                @empty
                    <div class="text-center text-muted">Belum ada anggota</div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- FACILITY -->
    <h3 class="card-title m-0">Daftar Facility -</h3>
    <div class="col-12 mb-8">
        <div class="card shadow-sm">
            <div class="card-body d-flex justify-content-center flex-wrap gap-4">
                @forelse ($property->facilities as $facility)
                    <div class="text-center" style="width: 12rem;">
                        <img class="mx-auto d-block" style="width: 5rem; height: 5rem;"
                            src="{{ $facility->photo ? asset('storage/' . $facility->photo) : asset('/assets/img/image_not_available.png') }}"
                            alt="{{ $facility->name }}">
                        <h4 class="mt-3 mb-1">{{ $facility->name }}</h4>
                        <p class="text-muted mb-0">{{ $facility->status }}</p>
                    </div>
                @empty
                    <div class="text-center text-muted">Belum ada fasilitas</div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- MAPS -->
    <h3 class="card-title">Lokasi -</h3>
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-body p-0">
                <div id="map" style="width: 100%; height: 60vh; border-radius: 10px;"></div>
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
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">Add New Lease</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('leases.store', $property->id) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="createUser" class="form-label">User:</label>
                            <select class="form-select" name="user_id" id="createUser">
                                @forelse ($users as $user)
                                    <option value="{{ $user->id }}"
                                        {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }}
                                    </option>
                                @empty
                                    <option value="">Calon Penyewa Tidak Ditemukan</option>
                                @endforelse
                            </select>
                            @error('user_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="createProperty" class="form-label">Property:</label>
                            <select class="form-select" name="property_id" id="createProperty">
                                <option value="{{ $property->id }}"
                                    {{ old('property_id') == $property->id ? 'selected' : '' }}>
                                    {{ $property->name }}
                                </option>
                            </select>
                            @error('property_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="createStartDate" class="form-label">Start Date:</label>
                            <input type="date" class="form-control" name="start_date" id="createStartDate"
                                value="{{ old('start_date') }}">
                            @error('start_date')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="createEndDate" class="form-label">End Date:</label>
                            <input type="date" class="form-control" name="end_date" id="createEndDate"
                                value="{{ old('end_date') }}">
                            @error('end_date')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            {{-- <label for="createStatus" class="form-label">Status:</label>
                            <select class="form-select" name="status" id="createStatus">
                                <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="expired" {{ old('status') == 'expired' ? 'selected' : '' }}>Expired</option>
                            </select>
                            @error('status')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror --}}
                        </div>
                        <div class="mb-3">
                            <label for="createDescription" class="form-label">Description:</label>
                            <textarea class="form-control" name="description" id="createDescription">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add Lease</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
