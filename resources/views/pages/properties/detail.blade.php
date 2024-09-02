@extends('app')

@section('content')

    {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.css" />
    <link rel="stylesheet" href="grid-gallery.css">

    <style>
        .facility-section {
            padding: 20px 0;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .title-container {
            text-align: center;
            margin-bottom: 20px;
        }

        .section-title {
            font-size: 40px;
            font-weight: 600;
            color: #1a202c;
            margin-bottom: 10px;
        }

        .highlight {
            color: #20B486;
        }

        .tabs-container {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            margin-bottom: 20px;
        }

        .facility-tab {
            border: 2px solid #20B486;
            background-color: white;
            color: black;
            border-radius: 30px;
            font-size: 16px;
            padding: 10px 20px;
            margin: 5px;
            cursor: pointer;
            transition: background-color 0.3s, color 0.3s;
        }

        .facility-tab.active,
        .facility-tab:hover {
            background-color: #20B486;
            color: white;
        }

        .images-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        @media (min-width: 768px) {
            .images-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        .facility-img {
            width: 100%;
            height: 250px;
            object-fit: cover;
            border-radius: 8px;
        }

        .empty-message {
            text-align: center;
            grid-column: span 2;
        }

        @media (min-width: 768px) {
            .empty-message {
                grid-column: span 3;
            }
        }


        #loading-screen {
            position: fixed;
            width: 100%;
            height: 100%;
            background: white;
            z-index: 9999;
            display: flex;
            justify-content: center;
            align-items: center;
            opacity: 1;
            transition: opacity 0.5s ease;
        }

        #loading-screen.hidden {
            opacity: 0;
            pointer-events: none;
        }

        #loading-screen img {
            width: 150px;
            height: auto;
            animation: pulse 1.5s infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.1);
            }
        }
    </style>
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
                                <a data-bs-toggle="modal" class="btn btn-warning ms-1" data-bs-target="#editPropertyLeaderModal"
                                    style="text-decoration; color: white;"><i class="ri-edit-line"></i></a>
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

                        @hasrole('super_admin')
                            <a data-bs-toggle="modal" data-bs-target="#addPropertyLeaderModal" class="btn btn-primary ms-1"
                                style="text-decoration; color: white;">+</a>
                        @endhasrole
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

    {{-- <div class="col-12 col-lg-12" style="margin-top: 50px">
        <div class="card shadow-sm">
            <div class="card-content px-3 py-6 d-flex align-items-center "
                style="background-color: rgba(32, 180, 134, 0.1); border-radius: 10px;">
                <h6 class="mb-0">{{ $property->description }}</h6>
            </div>
        </div>
    </div> --}}

    <h4 class="fw-bold text-center">Detail Foto Kontrakan</h4>
    <section class="gallery-block grid-gallery">
        <div class="gallery-container mx-auto 2xl:px-0">
            <div class="row row-cols-5">
                @forelse ($property->property_images as $detailFoto)
                    <div class="col item mb-4">
                        <a class="lightbox" href="{{ asset('storage/' . $detailFoto->image) }}">
                            <img class="img-fluid image scale-on-hover rounded"
                                src="{{ asset('storage/' . $detailFoto->image) }}"
                                alt="{{ $detailFoto->title ?? 'Gambar Kontrakan' }}">
                        </a>
                    </div>
                @empty
                    <div class="col-12 text-center text-muted">Belum Ada Foto Kontrakan</div>
                @endforelse
            </div>
        </div>
    </section>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            baguetteBox.run('.grid-gallery', {
                animation: 'slideIn'
            });
        });
    </script>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.js"></script>
    <script>
        baguetteBox.run('.compact-gallery', {
            animation: 'slideIn'
        });
    </script>


    <h4 class="fw-bold text-center">Daftar Anggota</h4>
    <div class="d-flex gap-3 flex-column flex-lg-row mt-2">
        <!-- ANGGOTA -->
        <div class="col-12 col-lg-12">
            <div class="mt-2">

                <div class="d-flex flex-wrap gap-4">
                    @forelse ($property_member as $member)
                        <div class="text-center" style="width: 12rem;">
                            @if ($member->photo)
                                <img src="{{ asset('storage/' . $member->photo) }}" class="rounded-circle"
                                    style="max-height: 8rem" alt="{{ $member->name }}">
                            @elseif ($member->gender === 'male')
                                <img class="rounded-circle" style="max-height: 8rem" src="../../assets/img/avatars/5.png"
                                    alt="Avatar">
                            @elseif ($member->gender === 'female')
                                <img class="rounded-circle" style="max-height: 8rem" src="../../assets/img/avatars/10.png"
                                    alt="Avatar">
                            @endif
                            <h4 class="mt-3 mb-1">{{ $member->name }}</h4>
                            <p class="text-muted mb-0">{{ $member->phone_number }}</p>
                        </div>
                    @empty
                        <div class="col-12 text-center text-muted">Belum ada anggota</div>
                    @endforelse
                </div>
            </div>
        </div>
        {{-- ANGGOTA --}}

    </div>
   <!-- FACILITIES -->
<h4 class="fw-bold text-center">Daftar Fasilitas</h4>

<div class="tabs-container">
    <button type="button" class="facility-tab active" data-facility="all">
        Semua fasilitas
    </button>

    @foreach ($property->facilities as $facility)
        <button type="button" class="facility-tab" data-facility="{{ $facility->id }}">
            {{ $facility->name }}
        </button>
    @endforeach
</div>

<div class="row gallery-container grid-gallery">
    @forelse ($property->facilities as $facility)
        @forelse ($facility->facility_images as $image)
            <div class="col-lg-3 item mb-4 facility-images" data-facility="{{ $facility->id }}" style="display: none;">
                <a class="lightbox" href="{{ asset('storage/' . $image->image) }}">
                    <img class="img-fluid image scale-on-hover rounded"
                        src="{{ asset('storage/' . $image->image) }}"
                        alt="Facility Image">
                </a>
            </div>
        @empty
            {{-- Optional empty message --}}
        @endforelse
    @empty
        <div class="col-12 text-center text-muted">Belum Ada Foto</div>
    @endforelse
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        function showImages(facilityId) {
            document.querySelectorAll('.facility-images').forEach(function(image) {
                image.style.display = 'none';
            });

            if (facilityId === 'all') {
                document.querySelectorAll('.facility-images').forEach(function(image) {
                    image.style.display = 'block';
                });
            } else {
                var images = document.querySelectorAll('.facility-images[data-facility="' + facilityId + '"]');
                images.forEach(function(image) {
                    image.style.display = 'block';
                });
            }

            baguetteBox.run('.grid-gallery', {
                animation: 'slideIn'
            });
        }

        function setActiveTab(tab) {
            document.querySelectorAll('.facility-tab').forEach(function(btn) {
                btn.classList.remove('active');
            });
            tab.classList.add('active');
        }

        document.querySelectorAll('.facility-tab').forEach(function(tab) {
            tab.addEventListener('click', function() {
                var facilityId = this.getAttribute('data-facility');
                showImages(facilityId);
                setActiveTab(this);
            });
        });

        showImages('all');
    });
</script>


    <!-- FACILITIES -->

    <!-- MAPS -->
    <h4 class="fw-bold text-center">Lokasi</h4>
    <div class="col-12 mt-3">
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

    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel" style="color: rgba(32,180,134,1)">Tambah Kontrak</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('leases.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="userIdSelect" class="form-label">Nama Penyewa</label>
                            <select class="form-select" name="user_id" id="userIdSelect">
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
                            <label for="property_id" class="form-label">Kontrakan</label>
                            <input type="hidden" class="form-control" id="property_id" name="property_id"
                                value="{{ $property->id }}">
                            <input type="text" class="form-control" id="property_id" disabled
                                placeholder="{{ $property->name }}">
                            @error('property_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="start_date" class="form-label">Tanggal Mulai</label>
                            <input type="date" class="form-control" name="start_date" id="start_date"
                                value="{{ old('start_date') }}">
                            @error('start_date')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="end_date" class="form-label">Masa Kontrak</label>
                            <select name="end_date" class="form-select" id="end_date">
                                <option value="" disabled selected>Pilih Berapa Bulan Ngontrak</option>
                                @for ($i = 1; $i <= 12; $i++)
                                    <option value="{{ $i }}" {{ old('end_date') == $i ? 'selected' : '' }}>
                                        {{ $i }} Bulan
                                    </option>
                                @endfor
                            </select>
                            @error('end_date')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="rental_price" class="form-label">Pembayaran Bulan Pertama</label>
                            <input type="hidden" class="form-control" id="hiddenPrice" name="first_paid_month"
                                value="{{ $property->rental_price }}">
                            <input type="text" class="form-control" id="showPrice" disabled placeholder=""
                                value=" Rp. {{ number_format($property->rental_price) }}">
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary"><i
                                    class="ri-add-line ri-20px"></i>Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('propertySelect').addEventListener('change', function() {
            let selectedOption = this.options[this.selectedIndex];
            let price = selectedOption.getAttribute('data-price');
            document.getElementById('hiddenPrice').value = price;
            document.getElementById('showPrice').value = 'Rp. ' + parseInt(price).toString().replace(
                /\B(?=(\d{3})+(?!\d))/g,
                ".");
        })
    </script>

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
                    <h5 class="modal-title" id="createModalLabel" style="color: rgba(32,180,134,1)">Tambah Kontrak</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('leases.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <img src="" style="max-width: 250px;border-radius:50%;object-fit: cover;"
                                alt="" id="imgUserCreateModal">
                        </div>
                        <div class="mb-3">
                            <label for="userIdSelect" class="form-label">Nama Penyewa</label>
                            <select class="form-select" name="user_id" id="userIdSelect">
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
                            <label for="property_id" class="form-label">Kontrakan</label>
                            <select class="form-select" name="property_id" id="property_id">

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
                            <label for="start_date" class="form-label">Tanggal Mulai</label>
                            <input type="date" class="form-control" name="start_date" id="start_date"
                                value="{{ old('start_date') }}">
                            @error('start_date')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="end_date" class="form-label">Tanggal Berakhir</label>
                            <input type="date" class="form-control" name="end_date" id="end_date"
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
                            <label for="description" class="form-label">Deskripsi <small>(Opsional)</small></label>
                            <textarea class="form-control" name="description" id="description">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary"><i
                                    class="ri-add-line ri-20px"></i>Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
