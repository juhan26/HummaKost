<!-- resources/views/users/index.blade.php -->

@extends('app')

@section('content')
    <div class="container">
        {{-- Store Modal --}}
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        @endif

        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createModal">Add User</button>

        <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createModalLabel">Add User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('user.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="name" class="col-form-label">Name:</label>
                                <input type="text" class="form-control" name="name" id="name">
                            </div>
                            <div class="form-group">
                                <label for="email" class="col-form-label">Email:</label>
                                <input type="email" class="form-control" name="email" id="email">
                            </div>
                            <div class="form-group">
                                <label for="password" class="col-form-label">Password:</label>
                                <input type="text" class="form-control" name="password" id="password">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Send message</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        {{-- Store Modal --}}
        <h1>Daftar Pengguna</h1>


        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $index => $user)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            {{-- Edit Modal --}}
                            <button type="button" class="btn btn-warning" data-toggle="modal"
                                data-target="#editModal{{ $user->id }}">Edit</button>

                            <div class="modal fade" id="editModal{{ $user->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="editModalLabel{{ $user->id }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editModalLabel{{ $user->id }}">Update User
                                                {{ $user->name }}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('user.update', $user->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="form-group">
                                                    <label for="name" class="col-form-label">Name:</label>
                                                    <input type="text" class="form-control" name="name" id="name"
                                                        value="{{ $user->name }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="email" class="col-form-label">Email:</label>
                                                    <input type="email" class="form-control" name="email" id="email"
                                                        value="{{ $user->email }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="password" class="col-form-label">Password:</label>
                                                    <input type="text" class="form-control" name="password"
                                                        id="password" value="{{ $user->password }}">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Save</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- Edit Modal --}}

                            {{-- Delete User --}}

                            <form action="{{ route('user.destroy', $user->id) }}" method="POST" class="delete-form"
                                onsubmit="return confirm('Are you sure, want to delete this user?')">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>

                            {{-- Delete User --}}
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
        {{ $users->links() }}
    </div>
@endsection
