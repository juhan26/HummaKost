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
                    </div>
                </div>
            </div>
        </div>

        <div class="row row-cols-1 row-cols-md-3 g-6 my-5">
            <div class="col-12 col-lg-6" style="border-radius: 15px">
                @if ($property->image)
                    <img class="card-img-top" style="border-radius: 15px; box-shadow: 0 4px 8px rgba(0,0,0,0.2);"
                        src="{{ asset('storage/' . $property->image) }}" alt="Card image cap" />
                @else
                    <img class="card-img-top" style="border-radius: 15px; box-shadow: 0 4px 8px rgba(0,0,0,0.2);"
                        src="{{ asset('assets/img/image_not_available.png') }}" alt="Card image cap" />
                @endif
            </div>

            <div class="col-12 col-lg-6 ">
                <h1 class="text-secondary-emphasis">{{ $property->name }}</h1>
                <div class="mb-10 w-full">
                    {{-- <h5 class="text-secondary">{{ $property->description }}</h5>     --}}

                    @if ($property->status === 'available')
                        <span class="label bg-label-primary me-2"
                            style="padding: 8px 20px; border-radius: 15px;"><strong>Tersedia </strong></span>
                    @else
                        <span class="label bg-label-danger me-2"
                            style="padding: 8px 20px; border-radius: 15px;"><strong>Full</strong></span>
                    @endif

                    <span class="label me-2"
                        style="padding: 8px 20px; border-radius: 15px; color: purple; background-color:rgb(248, 216, 248) ;">Total
                        Orang: <strong>{{ $property->leases->count() }}</strong></span>
                    <span class="label bg-label-warning me-2" style="padding: 8px 20px; border-radius: 15px;">Kapasitas:
                        <strong>{{ $property->capacity }}</strong></span>

                    @if ($property->gender_target === 'male')
                        <span class="label rounded-pill bg-label-info" style="padding: 8px 20px; border-radius: 15px;">
                            <i class="mdi ri-men-line"></i> Laki-Laki
                        </span>
                    @else
                        <span class="label rounded-pill bg-label-danger" style="padding: 8px 20px; border-radius: 15px;">
                            <i class="mdi ri-women-line"></i> Perempuan
                        </span>
                    @endif
                </div>

                <div class="" style="margin-top: 50px">

                    @php
                        $status = false;
                    @endphp
                    @foreach ($property->leases as $lease)
                        @if ($lease->user->hasRole('admin'))
                            <h5 class="fw-bold">Ketua:</h5>
                            <span class="label bg-label-warning me-1" style="padding: 8px 20px; border-radius: 10px; ">Ketua
                                Kontrakan: {{ $lease->user->name }}</strong></span>

                            @hasrole('super_admin')
                                <a data-bs-toggle="modal" class="btn btn-primary ms-1" data-bs-target="#editPropertyLeaderModal"
                                    style="text-decoration; color: white;">+</a>
                            @endhasrole
                            @php
                                $status = true;
                            @endphp
                        @endif
                    @endforeach

                    @if ($status == false)
                        <h5 class="fw-bold">Ketua:</h5>
                        <span class="label bg-label-danger me-1"
                            style="padding: 8px 20px; border-radius: 10px;"><strong>Ketua
                                Tidak Tersedia</strong></span>

                        <a data-bs-toggle="modal" data-bs-target="#addPropertyLeaderModal" class="btn btn-primary ms-1"
                            style="text-decoration; color: white;">+</a>
                    @endif
                </div>

                {{-- price  --}}
                <h2 class="fw-bold text-primary my-6">
                    {{ 'Rp. ' . number_format($property->rental_price, 0) . '/ bln' }}</h2>
                {{-- tambah kontrak  --}}
                <div class="mt-3">
                    @hasrole('super_admin')
                        <button type="button" class="btn btn-primary w-25" style="border-radius: 17px" data-bs-toggle="modal"
                            data-bs-target="#createModal">
                            Tambah Kontrak
                        </button>
                    @endhasrole
                </div>

            </div>



        </div>

    </div>

    <h4 class="fw-bold card-title m-0 mt-10">Detail Foto Kontrakan</h4>
    <div class="col-12 mb-12">
        <div class="card shadow-sm">

            <div class="card-body d-flex justify-content-start flex-wrap gap-4">
                @forelse ($property->property_images as $index => $detailFoto)
                    <div class="text-center mx-5" style="width: fit-content;">
                        <div class="img rounded d-block"
                            style="
                            height:12rem;
                            width:12rem;
                            background: url({{ asset('storage/' . $detailFoto->image) }});
                            background-position:center;
                            background-size:cover;
                            "
                        ></div>
                    <h4 class="mt-3 mb-1">Gambar ke {{ $index + 1 }}</h4>
                        {{-- <img class="rounded mx-auto d-block" style="width: 15rem; height: 15rem;"
                            src="{{ $detailFoto->image ? asset('storage/' . $detailFoto->image) : asset('assets/img/image_not_available.png') }}"> --}}
                        {{-- <p class="text-muted mb-0">{{ $detailFoto->user->status }}</p> --}}
                    </div>
                @empty
                    <div class="text-center text-muted">Belum ada anggota</div>
                @endforelse
            </div>
        </div>
    </div>

    <div class="col-12 col-lg-12" style="margin-top: 50px">
        <div class="card shadow-sm">
            <div class="card-content px-3 py-6 d-flex align-items-center "
                style="background-color: rgba(32, 180, 134, 0.1); border-radius: 10px;">
                <h6 class="mb-0">{{ $property->description }}</h6>
            </div>
        </div>
    </div>



    <!-- ANGGOTA -->
    <h4 class="fw-bold card-title m-0 mt-10">Daftar Anggota</h4>
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
    <h4 class="fw-bold card-title m-0">Daftar Facility</h4>
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
    <h4 class="fw-bold card-title">Lokasi</h4>
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-body p-0">
                <div id="map" style="width: 100%; height: 60vh; border-radius: 10px;">

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
                            <label for="user_id" class="form-label">Pilih Ketua Kontrakan</label>
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
                        <button type="submit" class="btn btn-primary">Ubah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Change Property Leader Modal -->
    </div>


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
