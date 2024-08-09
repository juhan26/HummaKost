@extends('app')

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-content">
                <div class="card-header">
                    <div class="row">
                        <div class="col-12 col-lg-12">
                            <h3 class="card-title">Leases</h3>
                            <small>Manage and review lease agreements.</small>
                        </div>
                    </div>
                    <div class="row d-flex align-items-center mt-4">
                        <div class="col-12 col-lg-10 mt-4">
                            <form action="" method="GET" class="d-flex w-100">
                                @csrf
                                <div class="d-flex align-items-center border rounded w-100 px-3">
                                    <input type="text" name="search" class="form-control border-none"
                                        value="{{ request()->input('search') }}" placeholder="Search...">
                                    <a class="btn-close cursor-pointer" href="{{ route('leases.index') }}"></a>
                                </div>
                            </form>
                        </div>
                        <div class="col-12 mt-4 col-lg-2">
                            <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal"
                                data-bs-target="#createModal">
                                Add Lease
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    {{-- Leases --}}
                    <div class="row row-cols-1 row-cols-md-2 g-4 my-5">
                        @foreach ($leases as $lease)
                            <div class="col">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center mb-3">
                                            @if ($lease->users->photo)
                                                <img src="{{ asset('storage/' . $lease->users->photo) }}"
                                                    alt="{{ $lease->users->name }}" class="rounded-circle me-3"
                                                    style="width: 50px; height: 50px; object-fit: cover;">
                                            @else
                                                <img src="{{ asset('assets/img/image_not_available.png') }}"
                                                    alt="Default Avatar" class="rounded-circle me-3"
                                                    style="width: 50px; height: 50px; object-fit: cover;">
                                            @endif
                                            <h5 class="card-title mb-0">{{ $lease->users->name }}</h5>
                                        </div>
                                        @if ($lease->status === 'active')
                                            <div class="badge fs-6 bg-label-success ">{{ $lease->status }}</div>
                                        @else
                                            <div class="badge fs-6 bg-label-danger ">{{ $lease->status }}</div>
                                        @endif
                                        {{-- <h5 class="card-title">{{ $lease->users->name }}</h5> --}}
                                        <p class="card-text">Property: {{ $lease->properties->name }}</p>
                                        <p class="card-text">Start Date:
                                            {{ \Carbon\Carbon::parse($lease->start_date)->format('d/m/Y') }}</p>
                                        <p class="card-text">End Date:
                                            {{ \Carbon\Carbon::parse($lease->end_date)->format('d/m/Y') }}</p>
                                        <p class="card-text">Description: {{ $lease->description }}</p>
                                        <p class="card-text">Total Iuran: Rp.{{ number_format($lease->total_iuran, 2) }}
                                        </p>
                                        <a href="#" class="btn btn-warning" data-bs-toggle="modal"
                                            data-bs-target="#editModal{{ $lease->id }}">Edit</a>
                                        <form action="{{ route('leases.destroy', $lease->id) }}" method="POST"
                                            class="d-inline">
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        {{ $leases->links() }}
    </div>

    {{-- Create Modal --}}
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">Add Lease</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('leases.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="user_id" class="form-label">User:</label>
                            <select class="form-select" name="user_id" id="user_id">
                                <option value="">Select User</option>
                                @foreach ($userStore as $user2)
                                    <option value="{{ $user2->id }}">{{ $user2->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="property_id" class="form-label">Property:</label>
                            <select class="form-select" name="property_id" id="property_id">
                                <option value="">Select Property</option>
                                @foreach ($properties as $property)
                                    <option value="{{ $property->id }}">{{ $property->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="start_date" class="form-label">Start Date:</label>
                            <input type="date" class="form-control" name="start_date" id="start_date">
                        </div>
                        <div class="mb-3">
                            <label for="end_date" class="form-label">End Date:</label>
                            <input type="date" class="form-control" name="end_date" id="end_date">
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status:</label>
                            <select class="form-select" name="status" id="status">
                                <option value="active">Active</option>
                                <option value="expired">Expired</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description:</label>
                            <textarea class="form-control" name="description" id="description"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="total_iuran" class="form-label">Total Iuran:</label>
                            <input type="number" class="form-control" name="total_iuran" id="total_iuran"
                                step="0.01">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add Lease</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Modal -->

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Leases</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure wan't to delete this property?
                </div>
                @foreach ($leases as $lease)
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>

                        <form action="{{ route('leases.destroy', $lease->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-primary">Delete</button>
                        </form>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Delete Modal -->

    {{-- Edit Modals --}}
    @foreach ($leases as $lease)
        <div class="modal fade" id="editModal{{ $lease->id }}" tabindex="-1"
            aria-labelledby="editModalLabel{{ $lease->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel{{ $lease->id }}">Update Lease</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('leases.update', $lease->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="editUser{{ $lease->id }}" class="form-label">User:</label>
                                <select class="form-select"
                                    value="{{ $lease->user_id }} id="editUser{{ $lease->id }}">
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}"
                                            {{ $lease->user_id == $user->id ? 'selected' : '' }}>
                                            {{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="editProperty{{ $lease->id }}" class="form-label">Property:</label>
                                <select class="form-select" name="property_id" id="editProperty{{ $lease->id }}"">
                                    @foreach ($properties as $property)
                                        <option value="{{ $property->id }}"
                                            {{ $lease->property_id == $property->id ? 'selected' : '' }}>
                                            {{ $property->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="editStartDate{{ $lease->id }}" class="form-label">Start Date:</label>
                                <input type="date" class="form-control" name="start_date"
                                    id="editStartDate{{ $lease->id }}"
                                    value="{{ \Carbon\Carbon::parse($lease->start_date)->format('Y-m-d') }}">
                            </div>
                            <div class="mb-3">
                                <label for="editEndDate{{ $lease->id }}" class="form-label">End Date:</label>
                                <input type="date" class="form-control" name="end_date"
                                    id="editEndDate{{ $lease->id }}"
                                    value="{{ \Carbon\Carbon::parse($lease->end_date)->format('Y-m-d') }}">
                            </div>
                            <div class="mb-3">
                                <label for="editStatus{{ $lease->id }}" class="form-label">Status:</label>
                                <select class="form-select" name="status" id="editStatus{{ $lease->id }}">
                                    <option value="active" {{ $lease->status == 'active' ? 'selected' : '' }}>Active
                                    </option>
                                    <option value="expired" {{ $lease->status == 'expired' ? 'selected' : '' }}>Expired
                                    </option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="editDescription{{ $lease->id }}" class="form-label">Description:</label>
                                <textarea class="form-control" name="description" id="editDescription{{ $lease->id }}">{{ $lease->description }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="editTotalIuran{{ $lease->id }}" class="form-label">Total Iuran:</label>
                                <input type="number" class="form-control" name="total_iuran"
                                    id="editTotalIuran{{ $lease->id }}" step="0.01"
                                    value="{{ $lease->total_iuran }}">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Update Lease</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
