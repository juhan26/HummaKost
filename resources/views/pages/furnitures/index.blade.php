@extends('app')

@section('content')
    <div class="container mt-5">
        {{-- Store Modal --}}
        <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#createModal">Add
            Furniture</button>

        <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createModalLabel">Add Furniture</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('furnitures.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="photo" class="form-label">Furniture Name:</label>
                                <input type="text" class="form-control" name="name" id="photo">
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">Description:</label>
                                <input type="text" class="form-control" name="description" id="name" required>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Add Furniture</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        {{-- Store Modal --}}

        <h1 class="mb-4">Daftar Furniture</h1>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Furniture Name</th>
                    <th>Description</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($furnitures as $index => $furniture)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $furniture->name }}</td>
                        <td>{{ $furniture->description }}</td>
                        <td>
                            {{-- Edit Modal --}}
                            <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                data-bs-target="#editModal{{ $furniture->id }}">Edit</button>

                            <div class="modal fade" id="editModal{{ $furniture->id }}" tabindex="-1"
                                aria-labelledby="editModalLabel{{ $furniture->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editModalLabel{{ $furniture->id }}">Update Furniture
                                                {{ $furniture->name }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('furnitures.update', $furniture->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="mb-3">
                                                    <label for="editName{{ $furniture->id }}"
                                                        class="form-label">Name:</label>
                                                    <input type="text" class="form-control" name="name"
                                                        id="editName{{ $furniture->id }}" value="{{ $furniture->name }}"
                                                        required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="editName{{ $furniture->id }}"
                                                        class="form-label">Description: (Nullable)</label>
                                                    <input type="text" class="form-control" name="description"
                                                        id="editName{{ $furniture->id }}"
                                                        value="{{ $furniture->description }}" required>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- Edit Modal --}}

                            {{-- Delete Furniture --}}
                            <form action="{{ route('furnitures.destroy', $furniture->id) }}" method="POST" class="d-inline"
                                onsubmit="return confirm('Are you sure you want to delete this furniture?')">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                            {{-- Delete Furniture --}}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">Data is Empty</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        {{-- {{ $users->links() }} --}}
    </div>
@endsection
