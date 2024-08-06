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
                                data-bs-target="#exampleModal">
                                Add Properties
                            </button>

                        </div>
                    </div>
                </div>
                <div class="card-body">
                    {{-- properties --}}
                    <div class="row row-cols-1 row-cols-md-3 g-6 my-5">
                            <div class="col">
                                <div class="card h-100">
                                    <img class="card-img-top" src="{{ asset('storage/' . $property->image) }}"
                                        alt="Card image cap" />
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $property->name }}</h5>
                                        <h5 class="card-title">Rental Price: Rp.{{ number_format($property->rental_price) }}
                                        </h5>
                                        <h5 class="card-title">Address: {{ $property->address }}</h5>
                                        <h5 class="card-title">Capacyty: {{ $property->capacity }}</h5>
                                        <h5 class="card-title">Gender: {{ $property->gender_target }}</h5>
                                        <h5 class="card-title">Langtitude: {{ $property->langtitude }}</h5>
                                        <h5 class="card-title">Longtitude: {{ $property->longtitude }}</h5>
                                        <p class="card-text">Description: {{ $property->description }}</p>
                                        lead-in to
                                        additional content. This content is a little bit longer.</p>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- {{ $properties->links() }} --}}
    </div>
@endsection
