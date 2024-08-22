@extends('app')

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-content">
                <div class="card-header">
                    <div class="row d-flex align-items-center mt-4" style="height:fit-content">
                        <div class="col-12 col-lg-6 h-100 justify-content-center align-items-center">
                            <h3 class="card-title">Manajemen Instansi</h3>
                        </div>
                        <div class="col-12 col-lg-4 h-100">
                            <form action="" method="get">
                                @csrf
                                <style>
                                    #divSearchInput {
                                        background-color: rgba(31, 180, 134, .1);
                                    }
                                </style>
                                <div class="d-flex align-items-center w-100 px-3" id="divSearchInput"
                                    style="border-radius: 15px;height: 60px;">
                                    <span class="material-symbols-outlined text-secondary ms-4">search</span>
                                    <input type="text" name="search" id="searchInput" class="form-control border-none"
                                        value="{{ request()->input('search') }}">
                                    <a href="{{ route('instance.index') }}" style="display: none" id="clearSearch"
                                        class="btn-close me-4"></a>
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
                        <div class="col-12 col-lg-2 d-flex justify-content-end">
                            @hasrole('super_admin')
                                <button type="button" class="btn btn-primary shadow-none " data-bs-toggle="modal"
                                    data-bs-target="#createModal" style="border-radius: 15px;height: 60px;width:fit-content">
                                    <span class="material-symbols-outlined">add</span>
                                    Tambah Instansi
                                </button>
                            @endhasrole
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    {{-- Data Table --}}
                    <div class="table-responsive text-nowrap">
                        <table class="table">
                            <tr style="border-bottom: 1px solid rgba(0,0,0,.15);">
                                <th>No</th>
                                <th>Nama Instansi</th>
                                <th>Alamat Instansi</th>
                                <th>Deskripsi</th>
                                <th></th>
                            </tr>
                            <tbody>
                                @foreach ($instances as $index => $instance)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $instance->name }}</td>
                                        <td>{{ $instance->address }}</td>
                                        <td>{{ $instance->description }}</td>
                                        <td>
                                            <div class="dropdown d-flex justify-content-center">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                    data-bs-toggle="dropdown"><i class="ri-more-2-line"></i></button>
                                                <div class="dropdown-menu">
                                                    <a type="button" class="dropdown-item" data-bs-toggle="modal"
                                                        data-bs-target="#editModal{{ $instance->id }}"
                                                        data-bs-whatever="@mdo"><i
                                                        class="ri-pencil-line me-1"></i>Ubah</a>

                                                    <a type="button" class="dropdown-item" data-bs-toggle="modal"
                                                        data-bs-target="#deleteModal{{ $instance->id }}"><i
                                                        class="ri-delete-bin-line me-1"></i>
                                                        Hapus Instansi
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    {{-- Delete Modal --}}
                                    <div class="modal fade" id="deleteModal{{ $instance->id }}" tabindex="-1"
                                        aria-labelledby="deleteModalLabel{{ $instance->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteModalLabel{{ $instance->id }}"> Hapus Instansi <span class="text-danger">{{ $instance->name }}</span>
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Apakah anda yakin ingin menghapus data instansi ini?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Kembali</button>
                                                    <form action="{{ route('instance.destroy', $instance->id) }}"
                                                        method="POST">
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
                                                    <h5 class="modal-title" id="editModalLabel{{ $instance->id }}">Edit
                                                        Instansi <span class="text-primary">{{ $instance->name }}</span>
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('instance.update', $instance->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="mb-3">
                                                            <label for="editDescription{{ $instance->id }}"
                                                                class="form-label">Nama
                                                                instansi</label>
                                                            <input type="text" class="form-control" name="name"
                                                                value="{{ old('name', $instance->name) }}">
                                                            @error('description')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <style>
                                                            textarea{
                                                                resize: none
                                                            }
                                                        </style>
                                                        <div class="mb-3">
                                                            <label for="editDescription{{ $instance->id }}"
                                                                class="form-label">Alamat
                                                                Instansi</label>
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
                                                            <button type="submit" class="btn btn-primary m-0">Simpan perubahan</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
        {{-- Pagination --}}
        <div class="d-flex justify-content-center">
            {{ $instances->links() }}
        </div>


        {{-- Create Lease Modal --}}
        <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createModalLabel">Tambahkan Instansi baru</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('instance.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="createUser" class="form-label">Nama Instansi</label>
                                <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="createProperty" class="form-label">Alamat Instansi:</label>
                                <textarea name="address" class="form-control h-[50px]" id="" cols="20" rows="3">{{ old('address') }}</textarea>
                                @error('address')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="createProperty" class="form-label">Deskripsi:</label>
                                <textarea name="description" class="form-control max-w-full max-h-[50px]" id="" cols="20"
                                    rows="3">{{ old('description') }}</textarea>
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
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-primary">Tambah Instansi</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection
