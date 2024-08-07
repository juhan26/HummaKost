@extends('app')

@section('content')
    <div class="container mt-5">
        {{-- Store Modal --}}
        <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#createModal">Add
            User</button>

        <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createModalLabel">Add User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="photo" class="form-label">Profile Photo:</label>
                                <input type="file" class="form-control" name="photo" id="photo">
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">Name:</label>
                                <input type="text" class="form-control" name="name" id="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email:</label>
                                <input type="email" class="form-control" name="email" id="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="phone_number" class="form-label">Phone Number:</label>
                                <input type="number" class="form-control" name="phone_number" id="phone_number" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password:</label>
                                <input type="password" class="form-control" name="password" id="password" required>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Add User</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        {{-- Store Modal --}}

        <h1 class="mb-4">Daftar Pengguna</h1>

        <div class="row">
            @forelse ($users as $user)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <img src="{{ $user->photo ? asset('storage/' . $user->photo) : asset('assets/img/image_not_available.png') }}"
                            class="card-img-top" alt="{{ $user->name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $user->name }}</h5>
                            <p class="card-text">
                                <strong>Email:</strong> {{ $user->email }}<br>
                                <strong>Phone Number:</strong> {{ $user->phone_number }}
                            </p>
                            <a href="#" class="btn btn-warning" data-bs-toggle="modal"
                                data-bs-target="#editModal{{ $user->id }}">Edit</a>
                            <form action="{{ route('user.destroy', $user->id) }}" method="POST" class="d-inline"
                                onsubmit="return confirm('Are you sure you want to delete this user?')">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>

                {{-- Edit Modal --}}
                <div class="modal fade" id="editModal{{ $user->id }}" tabindex="-1"
                    aria-labelledby="editModalLabel{{ $user->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editModalLabel{{ $user->id }}">Update User
                                    {{ $user->name }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('user.update', $user->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <label for="editName{{ $user->id }}" class="form-label">Name:</label>
                                        <input type="text" class="form-control" name="name"
                                            id="editName{{ $user->id }}" value="{{ $user->name }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="editEmail{{ $user->id }}" class="form-label">Email:</label>
                                        <input type="email" class="form-control" name="email"
                                            id="editEmail{{ $user->id }}" value="{{ $user->email }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="editPassword{{ $user->id }}" class="form-label">Password:</label>
                                        <input type="password" class="form-control" name="password"
                                            id="editPassword{{ $user->id }}">
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

            @empty
                <p class="text-center">Data is Empty</p>
            @endforelse
        </div>

        {{ $users->links() }}
    </div>
@endsection
