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
                                data-bs-target="#exampleModal">
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
                                    <div class="card-body">
                                        <div class="row justify-content-between">
                                            <div class="col-12 col-lg-12 mb-6">
                                                <h3 class="card-title m-0 p-0">{{ $property->name }}</h3>
                                                @foreach ($property->furnitures as $furniture)
                                                    <p class="card-text">{{ $furniture->name }}</p>
                                                @endforeach
                                            </div>
                                            <div class="col-12 col-lg-12 d-flex">
                                                <p class="card-text w-75">Address:
                                                    <br>{{ $property->address }}
                                                </p>
                                                <p class="card-text w-25">Capacity: <br><span
                                                        class="badge bg-success w-100">{{ $property->capacity }}</span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
