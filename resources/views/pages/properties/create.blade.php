@extends('app')

@section('content')
    <style>
        .checkbox {
            width: 100%;
            height: 100%;
            position: absolute;
            top: 0;
            left: 0;
            opacity: 0;
            cursor: pointer;
        }

        .parentCheckbox {
            border-radius: 15px;
            position: relative;
            padding: 10px;
            background-color: #FFFFFF;
            text-align: center;
            transition: background-color 0.3s;
        }

        .parentCheckbox:hover {
            background-color: rgba(32, 180, 134, 0.1);
        }

        .checked-icon {
            display: none;
            color: white;
            font-size: 1.5em;
            margin-left: 5px;
        }

        .parentCheckbox.checked .checked-icon {
            display: inline;
        }

        .parentCheckbox.checked #facility-name {
            color: white
        }

        .parentCheckbox.checked {
            background-color: rgba(32, 180, 134, 1);
        }
    </style>

    <div class="col-md-12">
        <div class="card mb-6">
            <h5 class="card-header">Tambah Kontrakan Baru</h5>
            <div class="card-body demo-vertical-spacing demo-only-element">
                <form action="{{ route('properties.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-12 col-lg-6 mb-3">
                            <label for="name" class="form-label">Nama Kontrakan</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                        </div>
                        <div class="col-12 col-lg-6 mb-3">
                            <label for="capacity" class="form-label">Kapasitas <small>(Yang Dapat
                                    Ditampung)</small></label>
                            <input type="number" name="capacity" class="form-control" value="{{ old('capacity') }}">
                        </div>
                        <div class="col-12 col-lg-12 mb-3">
                            <label for="image" class="form-label">Foto Kontrakan</label>
                            <input type="file" name="image" class="form-control" value="{{ old('image') }}">
                        </div>
                        <div class="col-12 col-lg-6 mb-3">
                            <label for="rental_price" class="form-label">Harga Sewa/Bulan</label>
                            <input type="number" name="rental_price" class="form-control"
                                value="{{ old('rental_price') }}">
                        </div>
                        <div class="col-12 col-lg-6 mb-3">
                            <label for="gender_target" class="form-label">Penghuni Kontrakan </label>
                            <select name="gender_target" id="gender_target" class="form-select"
                                value="{{ old('gender_target') }}">
                                <option value="male">Laki - Laki</option>
                                <option value="female">Perempuan</option>
                            </select>
                        </div>

                        <div class="form-floating col-12 col-lg-12 mb-3">
                            <textarea class="form-control" id="description" name="description" style="height: 100px">{{ old('description') }}</textarea>
                            <label for="description">Deskripsi <small>(Opsional)</small></label>
                        </div>

                        <div class="col-12 col-lg-12 mb-3">
                            <label for="address" class="form-label">Alamat</label>
                            <input type="text" name="address" class="form-control" value="{{ old('address') }}">
                        </div>

                        <div class="col-12 col-lg-12 mb-3 py-3" style="max-height: 300px; overflow: auto">
                            <label for="facility_id[]" class="form-label">Fasilitas</label>
                            <div class="row gap-3">
                                @forelse ($facilities as $facility)
                                    <div class="p-4 col-2 col-lg-2 text-center shadow-sm parentCheckbox">
                                        <input type="checkbox" name="facility_id[]" id="facility_{{ $facility->id }}"
                                            class="checkbox" value="{{ $facility->id }}"
                                            @if (is_array(old('facility_id')) && in_array($facility->id, old('facility_id'))) checked @endif>
                                        <span style="white-space: nowrap;" id="facility-name">
                                            {{ $facility->name }} <span class="checked-icon">✓</span>
                                        </span>
                                    </div>
                                @empty
                                    <div class="input-group mb-2">
                                        <div class="input-group-text form-check mb-0">
                                            <input class="form-check-input m-auto" type="checkbox" disabled value=""
                                                aria-label="Checkbox for following text input">
                                        </div>
                                        <input type="text" disabled class="form-control"
                                            aria-label="Text input with checkbox" value="Belum Ada Facility">
                                    </div>
                                @endforelse
                            </div>
                        </div>

                        <div class="mb-5 mt-2">
                            <p class="text-center m-0"><strong>Kordinat Maps</strong></p>
                            <p class="text-center">Bisa menggunakan cari lokasi atau langtitude dan longtitude.</p>
                        </div>

                        <div class="col-12 col-lg-12">
                            <label for="searchLocation" class="form-label">Cari Lokasi
                                <small>(Lokasi/Alamat)</small></label>
                            <div class="d-flex gap-3 mb-3 ">
                                <input type="text" id="location-search" name="searchLocation" id="searchLocation"
                                    class="form-control" value="{{ old('searchLocation') }}">
                                <button type="button" id="search-button" class="btn btn-primary"><i
                                        class="ri-search-line ri-16px me-sm-2"></i>Cari</button>
                            </div>
                        </div>

                        <div class="col-12 col-lg-6">
                            <label for="langtitude" class="form-label">Langtitude</label>
                            <input type="text" id="langtitude" name="langtitude" id="langtitude"
                                class="form-control" value="{{ old('langtitude') }}">
                        </div>

                        <div class="col-12 col-lg-6">
                            <label for="longtitude" class="form-label">Longtitude</label>
                            <input type="text" id="longtitude" name="longtitude" id="longtitude"
                                class="form-control" value="{{ old('longtitude') }}">
                        </div>

                        <div class="col-12 col-lg-12 mt-3 d-flex justify-content-end">
                            <button id="search-coordinates-button" class="btn btn-primary" style="height: 48px"
                                type="button"><i class="ri-map-pin-add-line ri-16px me-sm-2"></i>Cari Berdasarkan
                                Kordinat Lang/Long</button>
                        </div>

                        <div class="col-12 col-lg-12 mb-3">
                            <small>Atau Pilih Lokasi Dengan Mengklik Map</small>
                            <div id="map" style="width: 100%; height: 400px"></div>
                        </div>

                        <div class="col-12 col-lg-12 d-flex justify-content-between">
                            <a href="{{ route('properties.index') }}" class="btn btn-secondary">
                                <i class="ri-arrow-go-back-line ri-16px me-sm-2"></i>Batal
                            </a>

                            <button class="btn btn-primary create-new btn-primary waves-effect waves-light" tabindex="0"
                                aria-controls="DataTables_Table_0" type="submit"><span><i
                                        class="ri-add-line ri-16px me-sm-2"></i>
                                    <span class="d-none d-sm-inline-block">Tambah
                                    </span></span></button>
                        </div>
                    </div>
                </form>
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

        var marker = null; // Tidak ada marker saat halaman pertama kali dimuat

        function updateMarkerAndPopup(lat, lng) {
            if (!marker) {
                // Jika marker belum ada, tambahkan marker ke peta
                marker = L.marker([lat, lng]).addTo(map);
            } else {
                // Jika marker sudah ada, pindahkan marker ke lokasi baru
                marker.setLatLng([lat, lng]);
            }

            var apiKey = '8bc19529d2bf4e1e8e90f0b275f8109f';
            var url = `https://api.opencagedata.com/geocode/v1/json?q=${lat}+${lng}&key=${apiKey}`;

            fetch(url)
                .then(response => response.json())
                .then(data => {
                    if (data.results && data.results.length > 0) {
                        var address = data.results[0].formatted;
                        marker.bindPopup(address).openPopup();
                    }
                });
        }

        document.getElementById('map').addEventListener('click', function(e) {
            var lat = e.latlng.lat;
            var lng = e.latlng.lng;

            document.getElementById('langtitude').value = lat;
            document.getElementById('longtitude').value = lng;

            updateMarkerAndPopup(lat, lng);
        });

        document.getElementById('search-button').addEventListener('click', function() {
            var address = document.getElementById('location-search').value;

            var geocodeUrl = `https://api.opencagedata.com/geocode/v1/json?q=${address}&key=${apiKey}`;

            fetch(geocodeUrl)
                .then(response => response.json())
                .then(data => {
                    if (data.results && data.results.length > 0) {
                        var lat = data.results[0].geometry.lat;
                        var lng = data.results[0].geometry.lng;

                        map.setView([lat, lng], zoomLevel);
                        document.getElementById('langtitude').value = lat;
                        document.getElementById('longtitude').value = lng;

                        updateMarkerAndPopup(lat, lng);
                    }
                });
        });

        document.getElementById('search-coordinates-button').addEventListener('click', function() {
            var lat = parseFloat(document.getElementById('langtitude').value);
            var lng = parseFloat(document.getElementById('longtitude').value);

            if (!isNaN(lat) && !isNaN(lng)) {
                map.setView([lat, lng], zoomLevel);
                updateMarkerAndPopup(lat, lng);
            }
        });

        document.querySelectorAll('.checkbox').forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                const parentDiv = checkbox.closest('.parentCheckbox');
                if (checkbox.checked) {
                    parentDiv.classList.add('checked');
                } else {
                    parentDiv.classList.remove('checked');
                }
            });
        });
    </script>
@endsection
