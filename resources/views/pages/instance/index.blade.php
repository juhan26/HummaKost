@extends('app')

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-content">
                <div class="card-header">
                    <div class="row d-flex align-items-center">
                        <div class="col-12 col-lg-10">
                            <h3 class="card-title">Manajemen Sekolah</h3>
                            <small>Manajemen dan review Sekolahan.</small>
                        </div>
                        <div class="col-12 col-lg-2 text-lg-end mt-3 mt-lg-0">
                            @hasrole('super_admin')
                                <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal"
                                    data-bs-target="#createModal">
                                    Tambah Sekolah
                                </button>
                            @endhasrole
                        </div>
                    </div>
                    <div class="row d-flex align-items-center mt-4">
                        <div class="col-12 col-lg-8">
                            <form action="" method="GET" class="d-flex w-100">
                                @csrf
                                <div class="d-flex align-items-center border rounded w-100 px-3">
                                    <form action="{{ route('instance.index') }}" method="GET">
                                        @csrf
                                        <input type="text" name="search" id="searchInput"
                                            class="form-control border-none" value="{{ request()->input('search') }}"
                                            placeholder="Search...">
                                    </form>
                                    <a href="{{ route('instance.index') }}" style="display: none" id="clearSearch"
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
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    {{-- Data Table --}}
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Nama Sekolah</th>
                                <th>Alamat Sekolah</th>
                                <th>Deskripsi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($instances as $instance)
                                <tr>
                                    <td>{{ $instance->name }}</td>
                                    <td>{{ $instance->address }}</td>
                                    <td>{{ $instance->description }}</td>
                                    <td>
                                        <a type="button" class="" data-bs-toggle="modal"
                                            data-bs-target="#editModal{{ $instance->id }}" data-bs-whatever="@mdo"><i
                                                style="color: #e3a805" class="menu-icon tf-icons ri-edit-2-line"></i></a>

                                        <a type="button" class="" data-bs-toggle="modal"
                                            data-bs-target="#deleteModal{{ $instance->id }}">
                                            <i style="color: red" class="menu-icon tf-icons ri-delete-bin-line"></i>
                                        </a>
                                    </td>
                                </tr>

                                {{-- Delete Modal --}}
                                <div class="modal fade" id="deleteModal{{ $instance->id }}" tabindex="-1"
                                    aria-labelledby="deleteModalLabel{{ $instance->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteModalLabel{{ $instance->id }}"> Hapus
                                                    Data Skolahan
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Apakah anda yakin ingin menghapus data sekolah ini?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Kembali</button>
                                                <form action="{{ route('instance.destroy', $instance->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- Edit Modal --}}
                                <div class="modal fade" id="editModal{{ $instance->id }}" tabindex="-1"
                                    aria-labelledby="editModalLabel{{ $instance->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editModalLabel{{ $instance->id }}">Edit Data
                                                    Sekolah
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('instance.update', $instance->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="mb-3">
                                                        <label for="editDescription{{ $instance->id }}"
                                                            class="form-label">Nama Sekolah</label>
                                                        <input type="text" class="form-control" name="name" value="{{ old('name', $instance->name) }}">
                                                        @error('description')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="editDescription{{ $instance->id }}"
                                                            class="form-label">Alamat Sekolah</label>
                                                        <textarea class="form-control" name="address" id="editDescription{{ $instance->id }}">{{ old('address', $instance->address) }}</textarea>
                                                        @error('description')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="editDescription{{ $instance->id }}"
                                                            class="form-label">Deskripsi:</label>
                                                        <textarea class="form-control" name="description" id="editDescription{{ $instance->id }}">{{ old('description', $instance->description) }}</textarea>
                                                        @error('description')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Kembali</button>
                                                        <button type="submit" class="btn btn-primary">Edit Data Sekolah</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                </div>
                @endforeach
                </tbody>
                </table>

                {{-- Pagination --}}
                <div class="d-flex justify-content-center">
                    {{ $instances->links() }}
                </div>
            </div>
        </div>
    </div>
    </div>


    {{-- Create Lease Modal --}}
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">Tambahkan sekolah baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('instance.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="createUser" class="form-label">Nama Sekolah</label>
                            <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="createProperty" class="form-label">Alamat Sekolah:</label>
                            <textarea name="address" class="form-control h-[50px]" id="" value="{{ old('address') }}" cols="20" rows="10"></textarea>
                            @error('address')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="createProperty" class="form-label">Deskripsi:</label>
                            <textarea name="description" class="form-control max-w-full max-h-[50px]" id="" cols="20" rows="10">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- <div class="mb-3">
                            <label for="createStatus" class="form-label">Status:</label>
                            <select class="form-select" name="status" id="createStatus">
                                <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="expired" {{ old('status') == 'expired' ? 'selected' : '' }}>Expired</option>
                            </select>
                            @error('status')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="createDescription" class="form-label">Description:</label>
                            <textarea class="form-control" name="description" id="createDescription">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div> --}}
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add Lease</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
