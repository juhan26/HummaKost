@extends('app')

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-content">
                <div class="card-header">
                    <div class="row d-flex align-items-center">
                        <div class="col-12 col-lg-10">
                            <h3 class="card-title">Manajemen Kontrak</h3>
                            <small>Manajemen dan review tujuan kontrak.</small>
                        </div>
                        <div class="col-12 col-lg-2 text-lg-end mt-3 mt-lg-0">
                            @hasrole('super_admin')
                                <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal"
                                    data-bs-target="#createModal">
                                    Tambah Kontrak
                                </button>
                            @endhasrole
                        </div>
                    </div>
                    <div class="row d-flex align-items-center mt-4">
                        <div class="col-12 col-lg-8">
                            <form action="" method="GET" class="d-flex w-100">
                                @csrf
                                <div class="d-flex align-items-center border rounded w-100 px-3">
                                    <form action="{{ route('leases.index') }}" method="GET">
                                        @csrf
                                        <input type="text" name="search" id="searchInput"
                                            class="form-control border-none" value="{{ request()->input('search') }}"
                                            placeholder="Search...">
                                    </form>
                                    <a href="{{ route('leases.index') }}" style="display: none" id="clearSearch"
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
                        <div class="col-12 col-lg-4 mt-4 mt-lg-0">
                            <form action="{{ route('leases.index') }}" method="GET" class="d-flex w-100">
                                <select class="form-select" name="property_filter" onchange="this.form.submit()">
                                    <option value="all" selected>Semua</option>
                                    @foreach ($properties as $property)
                                        <option value="{{ $property->id }}"
                                            {{ request()->input('property_filter') == $property->id ? 'selected' : '' }}>
                                            {{ $property->name }}</option>
                                    @endforeach
                                </select>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    {{-- Data Table --}}
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Foto</th>
                                <th>Nama Penyewa</th>
                                <th>Roles</th>
                                <th>Kontrakan</th>
                                <th>Tanggal Mulai</th>
                                <th>Tanggal Selesai</th>
                                <th>Total Iuran</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($leases as $lease)
                                <tr>
                                    <td>
                                        <img src="{{ $lease->user->photo ? asset('storage/' . $lease->user->photo) : asset('assets/img/image_not_available.png') }}"
                                            alt="{{ $lease->user->name }}" class="img-fluid">
                                    </td>
                                    <td>{{ $lease->user->name }}</td>
                                    <td>
                                        @foreach ($lease->user->getRoleNames() as $role)
                                            @if ($role == 'admin')
                                                <span class="badge bg-warning">{{ $role }}</span>
                                            @elseif ($role == 'super_admin')
                                                <span class="badge bg-danger">{{ $role }}</span>
                                            @else
                                                <span class="badge bg-success">{{ $role }}</span>
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>{{ $lease->properties->name }}</td>
                                    <td>{{ \Carbon\Carbon::parse($lease->start_date)->translatedFormat('j F Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($lease->end_date)->translatedFormat('j F Y') }}</td>
                                    <td>Rp.{{ number_format($lease->total_iuran) }}</td>
                                    <td>
                                        <span
                                            class="badge fs-6 {{ $lease->status === 'active' ? 'bg-label-success' : 'bg-label-danger' }}">
                                            {{ $lease->status }}
                                        </span>
                                    </td>
                                    <td>
                                        <a type="button" class="" data-bs-toggle="modal"
                                            data-bs-target="#editModal{{ $lease->id }}" data-bs-whatever="@mdo"><i
                                                style="color: #e3a805" class="menu-icon tf-icons ri-edit-2-line"></i></a>

                                        <a type="button" class="" data-bs-toggle="modal"
                                            data-bs-target="#deleteModal{{ $lease->id }}">
                                            <i style="color: red" class="menu-icon tf-icons ri-delete-bin-line"></i>
                                        </a>
                                    </td>
                                </tr>

                                {{-- Delete Modal --}}
                                <div class="modal fade" id="deleteModal{{ $lease->id }}" tabindex="-1"
                                    aria-labelledby="deleteModalLabel{{ $lease->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteModalLabel{{ $lease->id }}"> Hapus
                                                    Data Kontrak
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Apakah anda yakin ingin menghapus data kontrak ini?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Kembali</button>
                                                <form action="{{ route('leases.destroy', $lease->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- Edit Modal --}}
                                <div class="modal fade" id="editModal{{ $lease->id }}" tabindex="-1"
                                    aria-labelledby="editModalLabel{{ $lease->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editModalLabel{{ $lease->id }}">Edit Data
                                                    Kontrak
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('leases.update', $lease->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    {{-- <div class="mb-3">
                                                        <label for="editStartDate{{ $lease->id }}"
                                                            class="form-label">Tanggal Mulai:</label>
                                                        <input type="date" class="form-control" name="start_date"
                                                            id="editStartDate{{ $lease->id }}"
                                                            value="{{ old('start_date', \Carbon\Carbon::parse($lease->start_date)->format('Y-m-d')) }}">
                                                        @error('start_date')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div> --}}
                                                    <div class="mb-3">
                                                        <label for="editEndDate{{ $lease->id }}"
                                                            class="form-label">Tanggal Selesai:</label>
                                                        <input type="date" class="form-control" name="end_date"
                                                            id="editEndDate{{ $lease->id }}"
                                                            value="{{ old('end_date', \Carbon\Carbon::parse($lease->end_date)->format('Y-m-d')) }}">
                                                        @error('end_date')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="editDescription{{ $lease->id }}"
                                                            class="form-label">Deskripsi:</label>
                                                        <textarea class="form-control" name="description" id="editDescription{{ $lease->id }}">{{ old('description', $lease->description) }}</textarea>
                                                        @error('description')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Kembali</button>
                                                        <button type="submit" class="btn btn-primary">Edit Data
                                                            Kontrak</button>
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
                    {{ $leases->links() }}
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
                    <h5 class="modal-title" id="createModalLabel">Add New Lease</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('leases.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="createUser" class="form-label">User:</label>
                            <select class="form-select" name="user_id" id="createUser">
                                @forelse ($users as $user)
                                    <option value="{{ $user->id }}"
                                        {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }}
                                    </option>
                                @empty
                                    <option value="">Calon Penyewa Tidak Ditemukan</option>
                                @endforelse
                            </select>
                            @error('user_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="createProperty" class="form-label">Property:</label>
                            <select class="form-select" name="property_id" id="createProperty">
                                @forelse ($properties as $property)
                                    <option value="{{ $property->id }}"
                                        {{ old('property_id') == $property->id ? 'selected' : '' }}>
                                        {{ $property->name }}
                                    </option>
                                @empty
                                    <option value="">Kontrakan Tidak Ditemukan</option>
                                @endforelse
                            </select>
                            @error('property_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="createStartDate" class="form-label">Start Date:</label>
                            <input type="date" class="form-control" name="start_date" id="createStartDate"
                                value="{{ old('start_date') }}">
                            @error('start_date')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="createEndDate" class="form-label">End Date:</label>
                            <input type="date" class="form-control" name="end_date" id="createEndDate"
                                value="{{ old('end_date') }}">
                            @error('end_date')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            {{-- <label for="createStatus" class="form-label">Status:</label>
                            <select class="form-select" name="status" id="createStatus">
                                <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="expired" {{ old('status') == 'expired' ? 'selected' : '' }}>Expired</option>
                            </select>
                            @error('status')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror --}}
                        </div>
                        <div class="mb-3">
                            <label for="createDescription" class="form-label">Description:</label>
                            <textarea class="form-control" name="description" id="createDescription">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
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
@endsection
