@extends('app')

@section('content')
    <div class="container mt-5">
        {{-- Store Modal --}}
        <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#createModal">Add Lease</button>

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
                                <select class="form-select" name="user_id" id="user_id" required>
                                    <option value="">Select User</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="property_id" class="form-label">Property:</label>
                                <select class="form-select" name="property_id" id="property_id" required>
                                    <option value="">Select Property</option>
                                    @foreach ($properties as $property)
                                        <option value="{{ $property->id }}">{{ $property->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="start_date" class="form-label">Start Date:</label>
                                <input type="date" class="form-control" name="start_date" id="start_date" required>
                            </div>
                            <div class="mb-3">
                                <label for="end_date" class="form-label">End Date:</label>
                                <input type="date" class="form-control" name="end_date" id="end_date" required>
                            </div>
                            <div class="mb-3">
                                <label for="status" class="form-label">Status:</label>
                                <select class="form-select" name="status" id="status" required>
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                    <option value="pending">Pending</option>
                                    <option value="expired">Expired</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description:</label>
                                <textarea class="form-control" name="description" id="description"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="total_iuran" class="form-label">Total Iuran:</label>
                                <input type="number" class="form-control" name="total_iuran" id="total_iuran" step="0.01" required>
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
        {{-- Store Modal --}}

        <h1 class="mb-4">Daftar Lease</h1>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>User</th>
                    <th>Property</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Status</th>
                    <th>Description</th>
                    <th>Total Iuran</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($leases as $index => $lease)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $lease->user->name }}</td>
                        <td>{{ $lease->property->name }}</td>
                        <td>{{ $lease->start_date->format('d/m/Y') }}</td>
                        <td>{{ $lease->end_date->format('d/m/Y') }}</td>
                        <td>{{ ucfirst($lease->status) }}</td>
                        <td>{{ $lease->description }}</td>
                        <td>{{ number_format($lease->total_iuran, 2) }}</td>
                        <td>
                            {{-- Edit Modal --}}
                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editModal{{ $lease->id }}">Edit</button>

                            <div class="modal fade" id="editModal{{ $lease->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $lease->id }}" aria-hidden="true">
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
                                                    <select class="form-select" name="user_id" id="editUser{{ $lease->id }}" required>
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->id }}" {{ $lease->user_id == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="editProperty{{ $lease->id }}" class="form-label">Property:</label>
                                                    <select class="form-select" name="property_id" id="editProperty{{ $lease->id }}" required>
                                                        @foreach ($properties as $property)
                                                            <option value="{{ $property->id }}" {{ $lease->property_id == $property->id ? 'selected' : '' }}>{{ $property->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="editStartDate{{ $lease->id }}" class="form-label">Start Date:</label>
                                                    <input type="date" class="form-control" name="start_date" id="editStartDate{{ $lease->id }}" value="{{ $lease->start_date->format('Y-m-d') }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="editEndDate{{ $lease->id }}" class="form-label">End Date:</label>
                                                    <input type="date" class="form-control" name="end_date" id="editEndDate{{ $lease->id }}" value="{{ $lease->end_date->format('Y-m-d') }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="editStatus{{ $lease->id }}" class="form-label">Status:</label>
                                                    <select class="form-select" name="status" id="editStatus{{ $lease->id }}" required>
                                                        <option value="active" {{ $lease->status == 'active' ? 'selected' : '' }}>Active</option>
                                                        <option value="inactive" {{ $lease->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                                        <option value="pending" {{ $lease->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                                        <option value="expired" {{ $lease->status == 'expired' ? 'selected' : '' }}>Expired</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="editDescription{{ $lease->id }}" class="form-label">Description:</label>
                                                    <textarea class="form-control" name="description" id="editDescription{{ $lease->id }}">{{ $lease->description }}</textarea>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="editTotalIuran{{ $lease->id }}" class="form-label">Total Iuran:</label>
                                                    <input type="number" class="form-control" name="total_iuran" id="editTotalIuran{{ $lease->id }}" value="{{ $lease->total_iuran }}" step="0.01" required>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- Edit Modal --}}

                            {{-- Delete Lease --}}
                            <form action="{{ route('leases.destroy', $lease->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this lease?')">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                            {{-- Delete Lease --}}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center">No data available</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{ $leases->links() }} {{-- Pagination links --}}
    </div>
@endsection
