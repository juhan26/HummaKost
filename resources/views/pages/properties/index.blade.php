@extends('app')
@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-content">
                <div class="card-header">
                    <div class="row">
                        <div class="col-12 col-lg-12">
                            <h3 class="card-title">
                                Properties
                            </h3>
                            <small>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Magni totam, eaque voluptas
                                veritatis nisi consequuntur.</small>
                        </div>
                    </div>
                    <div class="row d-flex align-items-center mt-4">
                        <div class="col-12 col-lg-10 mt-4">
                            <form action="" method="GET" class="d-flex w-100 ">
                                @csrf
                                <div class="d-flex align-items-center border rounded w-100 px-3">
                                    <input type="text" name="search" class="form-control border-none"
                                        value="{{ request()->input('search') }}" placeholder="Search...">
                                    <a class="btn-close cursor-pointer" href="{{ route('properties.index') }}"></a>
                                </div>
                            </form>
                        </div>
                        <div class="col-12 mt-4 col-lg-2">
                            <button type="button" class="btn btn-primary w-100 " data-bs-toggle="modal"
                                data-bs-target="#createModal">
                                Add Properties
                            </button>

                        </div>
                    </div>
                </div>
                <div class="card-body">
                    {{-- properties --}}
                    <div class="row row-cols-1 row-cols-md-3 g-6 my-5">
                        @foreach ($properties as $property)
                            <div class="col">
                                <div class="card h-100">
                                    @if ($property->image)
                                        <img class="card-img-top" src="{{ asset('storage/' . $property->image) }}"
                                            alt="Card image cap" />
                                    @else
                                        <img class="card-img-top" src="{{ asset('assets/img/image_not_available.png') }}"
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
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        {{ $properties->links() }}
    </div>
    {{-- create modal --}}
    <div class="modal fade " id="createModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add Properties</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('properties.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <div class="row">

                            <div class="col-12 col-lg-6">
                                <label for="" class="form-label">Name</label>
                                <input type="text" name="name" class="form-control">
                            </div>
                            <div class="col-12 col-lg-6">
                                <label for="" class="form-label">Capacity</label>
                                <input type="number" name="capacity" class="form-control">

                            </div>
                            <div class="col-12 col-lg-12">
                                <label for="" class="form-label">Photo</label>
                                <input type="file" name="image" class="form-control">

                            </div>
                            <div class="col-12 col-lg-6">
                                <label for="" class="form-label">Rental Price</label>
                                <input type="number" name="rental_price" class="form-control">

                            </div>
                            <div class="col-12 col-lg-6">
                                <label for="" class="form-label">Gender Target</label>
                                <select name="gender_target" id="" class="form-select">
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>

                            </div>
                            <div class="col-12 col-lg-12">
                                <label for="" class="form-label">Description</label>
                                <input type="text" name="description" class="form-control">

                            </div>
                            <div class="col-12 col-lg-12">
                                <label for="" class="form-label">Address</label>
                                <input type="text" name="address" class="form-control">
                            </div>
                            <div class="col-12 col-lg-12 mt-3">
                                <div class="d-flex justify-content-around">
                                    <small class="form-label">Latitude</small>
                                    <small class="form-label">Longtitude</small>
                                </div>
                                <div class="d-flex mb-3 gap-3">

                                    <input type="text" placeholder="click the map" name="langtitude" id="latitude" class="form-control"
                                        readonly>
                                    <input type="text" placeholder="click the map" name="longtitude" id="longitude" class="form-control"
                                        readonly>
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
        var lat = -7.896591;
        var lng = 112.6089657;
        var zoomLevel = 16;

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
        map.on('click', onMapClick)
    </script>
@endsection
{{--
<div class="container">

    @hasrole('member|admin')
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">Add
            Financial</button>

        <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createModalLabel">Add Add
                            Financial</h5>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('financial.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="user_id" class="col-form-label">Name:</label>
                                <input type="hidden" class="form-control" name="user_id" id="user_id"
                                    value="{{ Auth::user()->id }}">
                                <input type="text" class="form-control" disabled value="{{ Auth::user()->name }}">
                            </div>
                            <div class="form-group">
                                <label for="types" class="col-form-label">Type:</label>
                                <select class="form-select" aria-label="Default select example" name="types"
                                    id="types">
                                    <option selected>Open this select menu</option>
                                    <option value="Income">Income</option>
                                    <option value="Expense">Expense</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="nominal" class="col-form-label">Nominal:</label>
                                <input type="number" class="form-control" name="nominal" id="nominal">
                            </div>
                            <div class="form-group">
                                <label for="payment_proof" class="col-form-label">Payment Proof:</label>
                                <input type="file" class="form-control" name="payment_proof" id="payment_proof">
                            </div>
                            <div class="form-group">
                                <label for="financial_date" class="col-form-label">Financial Date:</label>
                                <input type="date" class="form-control" name="financial_date" id="financial_date">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Send message</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endhasrole
    <h1>Financial Data</h1>

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Payment Proof</th>
                    <th>Name</th>
                    <th>Amount</th>
                    <th>Types</th>
                    <th>Nominal</th>
                    <th>Status</th>
                    <th>Financial Date</th>
                    <th>Has Paid Until</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($financials as $index => $financial)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            <img style="width: 200px" src="{{ asset('storage/' . $financial->payment_proof) }}"
                                alt="Error">
                        </td>
                        <td>{{ $financial->users->name }}</td>
                        <td>{{ $financial->amount }}</td>
                        <td>{{ $financial->types }}</td>
                        <td>{{ $financial->nominal }}</td>
                        <td>{{ $financial->status }}</td>
                        <td>{{ $financial->financial_date }}</td>
                        <td>{{ $financial->has_paid_until }}</td>
                        <td>
                            @if ($financial->status === 'Pending')
                                <form action="{{ route('financial.accept', $financial->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-success">Accept</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td>
                            Data is Empty
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    {{ $financials->links() }}
</div>

--}}
