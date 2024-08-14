@extends('app')
@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-content">
                <div class="card-header">
                    <div class="row">
                        <div class="col-12 col-lg-12">
                            <h3 class="card-title">
                                Property And Facilities
                            </h3>
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
                                    <a href="{{ route('user.index') }}" style="display: none" id="clearSearch"
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
                                    Add user
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    {{-- properties --}}
                    <div class="row row-cols-1 row-cols-md-3 g-6 my-5">
                        @forelse ($properties as $property)
                            <div class="col">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <div class="row justify-content-between">
                                            <div class="col-12 col-lg-12 mb-6">
                                                {{-- Tolong frontend diperbaiki UI nya --}}
                                                <h3 class="card-title m-0 p-0">{{ $property->name }}</h3>
                                                @forelse ($property->facilities as $facility)
                                                    <p class="card-text">Facility: {{ $facility->name }}</p>
                                                @empty
                                                    <p class="card-text">Empty</p>
                                                @endforelse

                                                <button type="button" class="btn btn-primary " data-bs-toggle="modal"
                                                    data-bs-target="#createModal{{ $property->id }}">
                                                    Set Property And Facility
                                                </button>

                                                {{-- create modal --}}
                                                <div class="modal fade " id="createModal{{ $property->id }}" tabindex="-1"
                                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog ">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Set
                                                                    Property And Facility</h1>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <form action="{{ route('property_facilities.store') }}"
                                                                method="post" enctype="multipart/form-data">
                                                                <div class="modal-body">
                                                                    @csrf
                                                                    <div class="row">
                                                                        <div class="input-group mb-3 col-12 col-lg-16">
                                                                            <span class="input-group-text"
                                                                                id="inputGroup-sizing-default">Property
                                                                                Name</span>
                                                                            <input type="hidden"
                                                                                value="{{ $property->id }}"
                                                                                name="property_id">
                                                                            <input type="text" class="form-control"
                                                                                aria-label="Sizing example input"
                                                                                aria-describedby="inputGroup-sizing-default"
                                                                                value="{{ $property->name }}" disabled>
                                                                        </div>

                                                                        <div class="col-12 col-lg-6">
                                                                            <label for="" class="form-label">Select
                                                                                Facility</label>
                                                                            @forelse ($facilities as $facility)
                                                                                <div class="form-check form-switch">
                                                                                    <input class="form-check-input"
                                                                                        type="checkbox"
                                                                                        name="facility_id[]"
                                                                                        id="flexSwitchCheck{{ $facility->id }}"
                                                                                        value="{{ $facility->id }}"
                                                                                        @if ($property->facilities->contains($facility->id)) checked @endif>
                                                                                    <label class="form-check-label"
                                                                                        for="flexSwitchCheck{{ $facility->id }}">{{ $facility->name }}</label>
                                                                                </div>
                                                                            @empty
                                                                                <div class="form-check form-switch">
                                                                                    <input class="form-check-input"
                                                                                        type="checkbox"
                                                                                        id="flexSwitchCheckDisabled"
                                                                                        disabled>
                                                                                    <label class="form-check-label"
                                                                                        for="flexSwitchCheckDisabled">No
                                                                                        Facility
                                                                                        Exists</label>
                                                                                </div>
                                                                            @endforelse
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="submit" name="submit"
                                                                        class="btn btn-primary">Add</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="">Tidak Ada Kontrakan</div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
