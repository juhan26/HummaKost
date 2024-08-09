@extends('app')
@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-content">
                <div class="card-header">
                    <div class="row">
                        <div class="col-12 col-lg-12">
                            <h3 class="card-title">Properties</h3>
                            <small>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Magni totam, eaque voluptas
                                veritatis nisi consequuntur.</small>
                        </div>
                    </div>
                    <div class="row d-flex align-items-center mt-4">

                        <div class="col-12 col-lg-8 mt-4">
                            <form action="" method="GET" class="d-flex w-100 ">
                                @csrf
                                <div class="d-flex align-items-center border rounded w-100 px-3">
                                    <input type="text" name="search" id="searchInput" class="form-control border-none"
                                        value="{{ request()->input('search') }}" placeholder="Search...">
                                    <a href="{{ route('properties.index') }}" style="display: none" id="clearSearch"
                                        class="btn-close"></a>
                                </div>
                                <script>
                                    const key = document.getElementById('searchInput');
                                    const close = document.getElementById('clearSearch');

                                    document.addEventListener('DOMContentLoaded', function() {
                                        if (key.value.trim() !== '') {
                                            close.style.display = 'block';
                                        } else {
                                            close.style.display = 'none';
                                        }
                                    });


                                    key.addEventListener('input', function() {
                                        if (key.value.trim() !== '') {
                                            close.style.display = 'block';
                                        } else {
                                            close.style.display = 'none';
                                        }
                                    });
                                </script>
                        </div>
                        <div class="col-12 mt-4 col-lg-4">
                            <div class="d-flex align-items-center w-100 px-3 justify-content-between">
                                <button class="btn btn-secondary w-25" type="submit"><i
                                        class="mdi ri-search-line"></i></button>
                                </form>
                                <button type="button" class="btn btn-primary w-50 " data-bs-toggle="modal"
                                    data-bs-target="#createModal">
                                    Add Properties
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row row-cols-1 row-cols-md-3 g-6 my-5">
                        @forelse ($properties as $property)
                            <div class="col">
                                <div class="card h-100">
                                    @if ($property->image)
                                        <img class="card-img-top" src="{{ asset('storage/' . $property->image) }}"
                                            alt="Card image cap" />
                                    @else
                                        <img class="card-img-top" src="{{ asset('/assets/img/image_not_available.png') }}"
                                            alt="Card image cap" />
                                    @endif
                                    <div class="card-body">
                                        <div class="row justify-content-between">
                                            <div class="col-12 col-lg-12 mb-6">
                                                <h3 class="card-title m-0 p-0">{{ $property->name }}</h3>
                                                <p class="card-text">{{ $property->description }}</p>
                                            </div>
                                            <div class="col-12 col-lg-12 d-flex">
                                                <p class="card-text w-75">Address: <br>{{ $property->address }}</p>
                                                <p class="card-text w-25">Capacity: <br><span
                                                        class="badge bg-success w-100">{{ $property->capacity }}</span></p>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-12">
                                            <a href="{{ route('properties.show', [$property->id]) }}"
                                                class="btn btn-primary w-100">Detail</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
        {{ $properties->links() }}
    </div>

    {{-- Create Modal --}}
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add Properties</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('properties.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-12 col-lg-6">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" name="name" class="form-control">
                            </div>
                            <div class="col-12 col-lg-6">
                                <label for="capacity" class="form-label">Capacity</label>
                                <input type="number" name="capacity" class="form-control">
                            </div>
                            <div class="col-12 col-lg-12">
                                <label for="image" class="form-label">Photo</label>
                                <input type="file" name="image" class="form-control">
                            </div>
                            <div class="col-12 col-lg-6">
                                <label for="rental_price" class="form-label">Rental Price</label>
                                <input type="number" name="rental_price" class="form-control">
                            </div>
                            <div class="col-12 col-lg-6">
                                <label for="gender_target" class="form-label">Gender Target</label>
                                <select name="gender_target" id="gender_target" class="form-select">
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                            </div>
                            <div class="col-12 col-lg-12">
                                <label for="description" class="form-label">Description</label>
                                <input type="text" name="description" class="form-control">
                            </div>
                            <div class="col-12 col-lg-12">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" name="address" class="form-control">
                            </div>
                            <div class="col-12 col-lg-12 mt-3">
                                <label class="form-label">Maps Coordinate: (Use Search Location/Input Latitude and
                                    Longitude/Click The Map)</label>
                                <div class="d-flex gap-3 mb-3">
                                    <input type="text" id="location-search" class="form-control"
                                        placeholder="Enter location...">
                                    <button type="button" id="search-button" class="btn btn-primary">Search</button>
                                </div>
                                <div class="d-flex mb-3 gap-3">

                                    <input type="text" placeholder="click the map" name="langtitude" id="latitude"
                                        class="form-control" readonly>
                                    <input type="text" placeholder="click the map" name="longtitude" id="longitude"
                                        class="form-control" readonly>
                                </div>
                                <div id="map" style="width: 100%; height: 400px"></div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="submit" class="btn btn-primary">Add</button>
                    </form>
                </div>
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

            document.getElementById('latitude').value = clickedLat;
            document.getElementById('longitude').value = clickedLng;
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

                            document.getElementById('latitude').value = lat;
                            document.getElementById('longitude').value = lng;
                        } else {
                            alert('Location not found.');
                        }
                    })
                    .catch(error => console.error('Error:', error));
            }
        });

        document.getElementById('search-coordinates-button').addEventListener('click', function() {
            var lat = document.getElementById('latitude').value;
            var lng = document.getElementById('longitude').value;
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
