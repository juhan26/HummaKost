@extends('app')
@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-content">
                <div class="card-header">
                    <div class="row">
                        <div class="col-12 col-lg-12">
                            <h3 class="card-title">
                                Detail Properties
                            </h3>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb breadcrumb-style1">
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('properties.index') }}"
                                            class="text-decoration-underline">Properties</a>
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
                            <h5 class="text-secondary">{{ $property->description }} Lorem ipsum dolor sit amet consectetur
                                adipisicing elit. Dolor, consequatur?</h5>
                            <h2 class="fw-bold text-secondary my-6">
                                {{ 'Rp. ' . number_format($property->rental_price, 0) }}</h2>
                            <div class="badge fs-6 bg-label-warning mt-6 me-3">Capacity:
                                <strong>{{ $property->capacity }}</strong>
                            </div>
                            @if ($property->status === 'available')
                                <div class="badge fs-6 bg-label-success mt-6">{{ $property->status }}</div>
                            @else
                                <div class="badge fs-6 bg-label-danger mt-6">{{ $property->status }}</div>
                            @endif
                            <div class="d-flex gap-3 mt-3">
                                <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                    data-bs-target="#updateModal">
                                    Edit
                                </button>
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">
                                    Delete
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- {{ $properties->links() }} --}}
        </div>
    </div>

    {{-- Update Modal --}}
    <div class="modal fade " id="updateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Property {{ $property->name }}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('properties.update', $property->id) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">

                            <div class="col-12 col-lg-6">
                                <label for="" class="form-label">Name</label>
                                <input type="text" name="name" class="form-control" value="{{ $property->name }}">
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
                    <button type="submit" name="submit" class="btn btn-primary">Save changes</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    {{-- Update Modal --}}

    <!-- Delete Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete {{ $property->name }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure wan't to delete this property?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>

                    <form action="{{ route('properties.destroy', $property->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-primary">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Delete Modal -->

    {{-- MAPS --}}
    <div class="col-12">
        <div class="card">
            <div class="card-content">
                <div class="card-header">
                    <div class="row">
                        <div class="col-12 col-lg-12">
                            <h3 class="card-title">
                                Location
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    {{-- content maps --}}

                    <div class="w-full md:w-1/3 bg-white shadow-lg rounded-lg overflow-hidden">
                        <div class="map-container">
                            <div style="width: 100%;height: 100vh" id="map"></div>
                        </div>
                    </div>


                </div>
            </div>
            {{-- {{ $properties->links() }} --}}
        </div>
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
