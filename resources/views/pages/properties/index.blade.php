@extends('app')

@section('content')
    <div class="card">
        <div class="card-datatable table-responsive pt-0">
            <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                <div class="card-header d-flex align-items-center justify-content-between border-bottom">
                    <div class="head-label text-center">
                        <h5 class="card-title mb-0">List Kontrakan</h5>
                    </div>
                    <a href="{{ route('properties.create') }}" class="btn btn-primary waves-effect waves-light">
                        <i class="ri-add-line ri-16px me-sm-2"></i>
                        Tambah Kontrakan
                    </a>
                </div>
                <div class="row mt-3">
                    <div class="d-flex align-items-end justify-content-between mb-3">
                        @if ($properties->lastPage() != 1)
                            <div class="col-sm-12 col-md-6 mt-5 mt-md-0">
                                <strong>Hasil Halaman: {{ $properties->currentPage() }}</strong>
                            </div>
                        @endif
                        <div
                            class="col-sm-12 col-md-6 d-flex {{ $properties->lastPage() != 1 ? 'justify-content-end' : 'justify-content-start' }} gap-3">
                            @if ($properties->lastPage() != 1)
                                <label>Pilih Halaman: <select name="page" aria-controls="DataTables_Table_0"
                                        class="form-select form-select-sm" id="pageSelect">
                                        @for ($i = 1; $i <= $properties->lastPage(); $i++)
                                            <option value="{{ request()->url() }}?page={{ $i }}"
                                                {{ $properties->currentPage() == $i ? 'selected' : '' }}>
                                                {{ $i }}
                                            </option>
                                        @endfor
                                    </select></label>
                            @endif
                            <div id="DataTables_Table_0_filter" class="dataTables_filter"><label>Search:<form
                                        action="{{ route('properties.index') }}" method="GET">
                                        @csrf
                                        <input type="text" name="search" placeholder="name..."
                                            class="form-control form-control-sm" placeholder=""
                                            aria-controls="DataTables_Table_0" value="{{ request('search') }}">
                                    </form></label></div>
                        </div>
                    </div>
                </div>
                <div class="row row-cols-1 row-cols-md-3 g-6 mb-3">
                    @forelse ($properties as $property)
                        <div class="col-md-6 col-lg-4" style="">
                            <div class="card h-100">
                                <img style="width: 100%" class="card-img-top"
                                    src="{{ $property->image ? asset('storage/' . $property->image) : asset('/assets/img/image_not_available.png') }}"
                                    alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $property->name }}</h5>
                                    <div style="min-height: 120px; overflow: auto">
                                        <p class="card-text">
                                            {{ $property->description ? $property->description : 'Deskripsi Kosong' }}
                                        </p>
                                    </div>
                                </div>
                                <div class="modal-footer d-flex justify-content-between align-items-center px-5 mb-5">
                                    <a href="{{ route('properties.show', [$property->id]) }}"
                                        class="btn btn-outline-primary waves-effect">Lihat Detail</a>
                                    <div class="dropdown">
                                        <button
                                            class="btn btn-text-secondary rounded-pill text-muted border-0 p-1 waves-effect waves-light"
                                            type="button" id="performanceOverviewDropdown" data-bs-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            <i class="ri-more-2-line ri-20px"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end"
                                            aria-labelledby="performanceOverviewDropdown">

                                            <button type="button" class="dropdown-item waves-effect" data-bs-toggle="modal"
                                                data-bs-target="#updateModal{{ $property->id }}"
                                                data-bs-whatever="@mdo">Edit</button>

                                            <button type="button" class="dropdown-item waves-effect" data-bs-toggle="modal"
                                                data-bs-target="#deleteModal{{ $property->id }}">
                                                Delete
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Update Modal --}}
                        <div class="modal fade " id="updateModal{{ $property->id }}" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog ">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Property
                                            {{ $property->name }}</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('properties.update', $property->id) }}" method="post"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="row">

                                                <div class="col-12 col-lg-6">
                                                    <label for="" class="form-label">Name</label>
                                                    <input type="text" name="name" class="form-control"
                                                        value="{{ $property->name }}">
                                                </div>
                                                <div class="col-12 col-lg-6">
                                                    <label for="" class="form-label">Capacity</label>
                                                    <input type="number" name="capacity" class="form-control"
                                                        value="{{ $property->capacity }}">

                                                </div>
                                                <div class="col-12 col-lg-12">
                                                    <label for="" class="form-label">Photo</label>
                                                    <input type="file" name="image" class="form-control">

                                                </div>
                                                <div class="col-12 col-lg-6">
                                                    <label for="" class="form-label">Rental Price</label>
                                                    <input type="number" name="rental_price" class="form-control"
                                                        value="{{ $property->rental_price }}">

                                                </div>
                                                <div class="col-12 col-lg-6">
                                                    <label for="" class="form-label">Gender Target</label>
                                                    <select name="gender_target" id="" class="form-select"
                                                        value="{{ $property->gender_target }}">
                                                        <option value="male">Male</option>
                                                        <option value="female">Female</option>
                                                    </select>

                                                </div>
                                                <div class="col-12 col-lg-12">
                                                    <label for="" class="form-label">Description</label>
                                                    <input type="text" name="description" class="form-control"
                                                        value="{{ $property->description }}">

                                                </div>
                                                <div class="col-12 col-lg-12">
                                                    <label for="" class="form-label">Address</label>
                                                    <input type="text" name="address" class="form-control"
                                                        value="{{ $property->address }}">
                                                </div>
                                                <div class="col-12 col-lg-6">
                                                    <label for="" class="form-label">langtitude</label>
                                                    <input type="text" name="langtitude" class="form-control"
                                                        value="{{ $property->langtitude }}">
                                                </div>
                                                <div class="col-12 col-lg-6">
                                                    <label for="" class="form-label">longtitude</label>
                                                    <input type="text" name="longtitude" class="form-control"
                                                        value="{{ $property->longtitude }}">
                                                </div>

                                            </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" name="submit" class="btn btn-primary">Save
                                            changes</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        {{-- Update Modal --}}

                        <!-- Delete Modal -->
                        <div class="modal fade" id="deleteModal{{ $property->id }}" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Hapus
                                            {{ $property->name }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Apakah anda yakin ingin menghapus kontrakan ini?
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
                        <!-- Delete Modal -->
                    @empty
                        <div class="card-header flex-column flex-md-row border-top border-bottom w-100">
                            <div class="head-label text-center">
                                <h5 class="card-title mb-0">
                                    {{ request('search') ? 'Kontrakan Tidak Ditemukan' : 'Belum Ada Kontrakan' }}</h5>
                            </div>
                        </div>
                    @endforelse
                </div>
                {{ $properties->links() }}
            </div>
        </div>
    </div>

    <script>
        var lat = -7.8965894;
        var lng = 112.6090665;
        var zoomLevel = 15.39;

        var map = L.map('map').setView([lat, lng], zoomLevel);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        var marker = null;

        function onMapClick(e) {
            var clickedLat = e.latlng.lat;
            var clickedLng = e.latlng.lng;

            if (!marker) {
                marker = L.marker([clickedLat, clickedLng]).addTo(map);
            } else {
                marker.setLatLng([clickedLat, clickedLng]);
            }

            document.getElementById('langtitude').value = clickedLat;
            document.getElementById('longtitude').value = clickedLng;
        }

        map.on('click', onMapClick);

        document.getElementById('search-button').addEventListener('click', function() {
            var location = encodeURIComponent(document.getElementById('location-search').value);
            if (location) {
                fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${location}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.length > 0) {
                            var lat = data[0].lat;
                            var lng = data[0].lon;
                            map.setView([lat, lng], 16);

                            if (marker) {
                                marker.setLatLng([lat, lng]);
                            } else {
                                marker = L.marker([lat, lng]).addTo(map);
                            }

                            document.getElementById('langtitude').value = lat;
                            document.getElementById('longtitude').value = lng;
                        } else {
                            alert('Location not found.');
                        }
                    })
                    .catch(error => console.error('Error:', error));
            }
        });

        document.getElementById('search-coordinates-button').addEventListener('click', function() {
            var lat = document.getElementById('langtitude').value;
            var lng = document.getElementById('longtitude').value;
            var apiKey = '8bc19529d2bf4e1c93b380dfd6acb17b'; // Ganti dengan API key Anda
            var url = `https://api.opencagedata.com/geocode/v1/json?q=${lat}+${lng}&key=${apiKey}`;

            fetch(url)
                .then(response => response.json())
                .then(data => {
                    if (data.results.length > 0) {
                        map.setView([lat, lng], 13);

                        if (marker) {
                            marker.setLatLng([lat, lng]);
                        } else {
                            marker = L.marker([lat, lng]).addTo(map);
                        }

                        marker.bindPopup(data.results[0].formatted).openPopup();
                    } else {
                        alert('Location not found.');
                    }
                })
                .catch(error => console.error('Error:', error));
        });
    </script>
@endsection
