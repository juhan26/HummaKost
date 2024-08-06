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

                     <div class="w-full md:w-1/3 bg-white shadow-lg rounded-lg overflow-hidden">
                    <div class="map-container">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3952.0178408331612!2d112.6072341752953!3d-7.893201792129538!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7881004f40cd03%3A0x39bbcdf0b563b7d4!2sKontrakan%20Las%20Vegas!5e0!3m2!1sid!2sid!4v1722925022734!5m2!1sid!2sid"
                            style="border:0; width:100%; height:100%;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>

                </div>
            </div>
            {{-- {{ $properties->links() }} --}}
        </div>
    </div>
@endsection
