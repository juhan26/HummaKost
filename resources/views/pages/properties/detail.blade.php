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
                                        <a href="{{ route('dashboard') }}" class="text-decoration-underline">Dashboard</a>
                                    </li>
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

                        </div>
                    </div>
                </div>
            </div>
            {{-- {{ $properties->links() }} --}}
        </div>
    </div>

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

                </div>
            </div>
            {{-- {{ $properties->links() }} --}}
        </div>
    </div>
@endsection
