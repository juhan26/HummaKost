@extends('app')

@section('content')
    <style>
        .is-invalid {
            border-color: #dc3545;
            background-color: #white;
        }

        .invalid-feedback {
            color: #dc3545;
            display: block;
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
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name') }}">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-12 col-lg-6 mb-3">
                            <label for="capacity" class="form-label">Kapasitas <small>(Yang Dapat Ditampung)</small></label>
                            <input type="number" name="capacity"
                                class="form-control @error('capacity') is-invalid @enderror" value="{{ old('capacity') }}">
                            @error('capacity')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-12 col-lg-12 mb-3">
                            <img src="" style="max-width: 250px" alt="" id="imgPreview">
                            <label for="image" class="form-label">Foto Kontrakan</label>
                            <input type="file" name="image" id="imageInput"
                                class="form-control @error('image') is-invalid @enderror" value="{{ old('image') }}">
                            @error('image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-12 col-lg-6 mb-3">
                            <label for="rental_price" class="form-label">Harga Sewa/Bulan</label>
                            <input type="number" name="rental_price"
                                class="form-control @error('rental_price') is-invalid @enderror"
                                value="{{ old('rental_price') }}">
                            @error('rental_price')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-12 col-lg-6 mb-3">
                            <label for="gender_target" class="form-label">Penghuni Kontrakan</label>
                            <select name="gender_target" id="gender_target"
                                class="form-select @error('gender_target') is-invalid @enderror">
                                <option value="male" {{ old('gender_target') == 'male' ? 'selected' : '' }}>Laki - Laki
                                </option>
                                <option value="female" {{ old('gender_target') == 'female' ? 'selected' : '' }}>Perempuan
                                </option>
                            </select>
                            @error('gender_target')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-floating col-12 col-lg-12 mb-3">
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                                style="height: 100px">{{ old('description') }}</textarea>
                            <label for="description">Deskripsi <small>(Opsional)</small></label>
                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-12 col-lg-12 mb-3">
                            <label for="address" class="form-label">Alamat</label>
                            <input type="text" name="address" class="form-control @error('address') is-invalid @enderror"
                                value="{{ old('address') }}">
                            @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-12 col-lg-12 mb-3" style="max-height: 300px; overflow: auto">
                            <label for="facility_id[]" class="form-label">Fasilitas</label>
                            <div class="d-flex flex-wrap gap-3">
                                @forelse ($facilities as $facility)
                                    <div class="d-flex mb-2 col-12 col-lg-2">
                                        <div class="input-group-text form-check mb-0 " style="border-radius: 15px 0 0 15px">
                                            <input class="form-check-input m-auto" type="checkbox"
                                                value="{{ $facility->id }}" name="facility_id[]"
                                                aria-label="Checkbox for following text input"
                                                @if (is_array(old('facility_id')) && in_array($facility->id, old('facility_id'))) checked @endif>
                                        </div>
                                        <input type="text" disabled class="form-control"
                                            style="border-radius: 0 15px 15px 0" aria-label="Text input with checkbox"
                                            value="{{ $facility->name }}">
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
                                    class="form-control @error('searchLocation') is-invalid @enderror"
                                    value="{{ old('searchLocation') }}">
                                <button type="button" id="search-button" class="btn btn-primary"><i
                                        class="ri-search-line ri-16px me-sm-2"></i>Cari</button>
                            </div>
                            @error('searchLocation')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-12 col-lg-6">
                            <label for="langtitude" class="form-label">Langtitude</label>
                            <input type="text" id="langtitude" name="langtitude"
                                class="form-control @error('langtitude') is-invalid @enderror"
                                value="{{ old('langtitude') }}">
                            @error('langtitude')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-12 col-lg-6">
                            <label for="longtitude" class="form-label">Longtitude</label>
                            <input type="text" id="longtitude" name="longtitude"
                                class="form-control @error('longtitude') is-invalid @enderror"
                                value="{{ old('longtitude') }}">
                            @error('longtitude')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
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

            var apiKey = '8bc19529d2bf4e1c93b380dfd6acb17b';
            var url = `https://api.opencagedata.com/geocode/v1/json?q=${lat}+${lng}&key=${apiKey}`;

            fetch(url)
                .then(response => response.json())
                .then(data => {
                    if (data.results.length > 0) {
                        var locationDetails = data.results[0].formatted;
                        marker.bindPopup(locationDetails).openPopup();

                        document.getElementById('langtitude').value = lat;
                        document.getElementById('longtitude').value = lng;
                    } else {
                        alert('Lokasi Tidak Ditemukan.');
                    }
                })
                .catch(error => console.error('Error:', error));
        }

        function onMapClick(e) {
            var clickedLat = e.latlng.lat;
            var clickedLng = e.latlng.lng;

            updateMarkerAndPopup(clickedLat, clickedLng);

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

                            updateMarkerAndPopup(lat, lng);

                            document.getElementById('langtitude').value = lat;
                            document.getElementById('longtitude').value = lng;
                        } else {
                            alert('Lokasi Tidak Ditemukan.');
                        }
                    })
                    .catch(error => console.error('Error:', error));
            }
        });

        document.getElementById('search-coordinates-button').addEventListener('click', function() {
            var lat = document.getElementById('langtitude').value;
            var lng = document.getElementById('longtitude').value;
            var apiKey = '8bc19529d2bf4e1c93b380dfd6acb17b';
            var url = `https://api.opencagedata.com/geocode/v1/json?q=${lat}+${lng}&key=${apiKey}`;

            fetch(url)
                .then(response => response.json())
                .then(data => {
                    if (data.results.length > 0) {
                        map.setView([lat, lng], 13);

                        updateMarkerAndPopup(lat, lng);
                    } else {
                        alert('Lokasi Tidak Ditemukan.');
                    }
                })
                .catch(error => console.error('Error:', error));
        });

        document.getElementById('imageInput').addEventListener('change', function(e) {
            const file = e.target.files[0];
            console.log(file);
            const reader = new FileReader();

            reader.onload = (e) => {
                const imagePreview = document.getElementById('imgPreview');
                imagePreview.src = e.target.result;
                imagePreview.style.display = 'block';
            }

            if (file) {
                reader.readAsDataURL(file);
            }
        })
    </script>
@endsection
