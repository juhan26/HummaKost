@extends('app')

@section('content')
    <style>
        #searchInput {
            padding-left: 60px;
        }

        @media (max-width: 767.98px) {
            #searchIcon {
                display: none;
            }

            #searchInput {
                padding: 0 15px 0 15px
            }
        }
    </style>
    <div class="col-12">
        <div class="card">
            <div class="card-content">
                <div class="card-header">
                    <form action="{{ route('leases.index') }}" method="GET">
                        @csrf
                        <div class="row align-items-center justify-content-start mt-4" style="height:fit-content">
                            <div class="col-12 col-lg-6 h-100 justify-content-center align-items-center mb-sm-5">
                                <h3 class="m-0 mb-3 mb-md-0"><strong>Manajemen Kontrak</strong></h3>
                            </div>
                            <div class="col-10 col-lg-4 h-100 ms-auto">
                                <style>
                                    #divSearchInput {
                                        background-color: rgba(31, 180, 134, .1);
                                    }
                                </style>
                                <div class="d-flex align-items-center w-100 px-3" id="divSearchInput"
                                    style="border-radius: 15px;height: 60px;">
                                    <span class="material-symbols-outlined text-secondary ms-4">search</span>
                                    <input type="text" class="form-control m-0 p-0 ps-4" name="search" id="searchInput"
                                        style="border: 0; border-radius: 15px; height: 60px; outline: none;"
                                        value="{{ request('search') }}" placeholder="Cari...">
                                </div>
                            </div>
                            <div class="col-10 col-lg-1 h-100 ">
                                <div class="dropdown d-flex align-items-center justify-content-end">
                                    <button type="button" class="btn w-100 btn-primary  dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown"
                                        style="border-radius: 15px;padding-top:.85rem;padding-bottom:.85rem">
                                        <span class="material-symbols-outlined">filter_list</span>
                                    </button>
                                    <div class="dropdown-menu">
                                        <div class="row p-3" style="width:20rem;">
                                            <p class="card-title text-primary mb-3">Status</p>
                                            <label class="form-check-label custom-option-content w-100" for="activeFilter">
                                                <div class="dropdown-item">
                                                    <input name="status[]" class="form-check-input me-2" id="activeFilter"
                                                        type="checkbox" value="active" onclick="this.form.submit()"
                                                        @if (in_array('active', $status)) checked @endif />
                                                    <span>Aktif</span>
                                                </div>
                                            </label>
                                            <label class="form-check-label custom-option-content w-100" for="expiredFilter">
                                                <div class="dropdown-item">
                                                    <input name="status[]" class="form-check-input me-2" id="expiredFilter"
                                                        type="checkbox" value="expired" onclick="this.form.submit()"
                                                        @if (in_array('expired', $status)) checked @endif />
                                                    <span>Expired</span>
                                                </div>
                                            </label>
                                            <p class="card-title text-primary my-3">Kontrakan </p>
                                            @foreach ($properties as $property)
                                                <label class="form-check-label custom-option-content w-100"
                                                    for="property_idFilter{{ $property->id }}">
                                                    <div class="dropdown-item">
                                                        <input name="property_id[]" class="form-check-input me-2"
                                                            id="property_idFilter{{ $property->id }}" type="checkbox"
                                                            value="{{ $property->id }}" onclick="this.form.submit()"
                                                            @if (in_array($property->id, $property_id)) checked @endif />
                                                        <span>{{ $property->name }}</span>
                                                    </div>
                                                </label>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-10 col-lg-1 h-100">
                                <div class="px-2">
                                    <button type="button" class="btn btn-primary waves-effect waves-light px-2"
                                        data-bs-toggle="modal" data-bs-target="#createModal"
                                        style=" padding: 15px 0; border-radius: 10px; background-color: rgba(32,180,134,1); color: white; font-size: 16px;">
                                        <i class="ri-add-line ri-20px"></i>Tambah
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-body">
                    <div class="table-responsive text-nowrap">
                        <table class="table">
                            <tr class="text-center" style="border-bottom: 1px solid rgba(0,0,0,.15);">
                                <th>No</th>
                                <th>Foto</th>
                                <th>Nama Penyewa</th>
                                <th>Kontrakan</th>
                                <th>Tanggal Mulai</th>
                                <th>Tanggal Selesai</th>
                                <th>Total Iuran</th>
                                <th>Status Penyewa</th>
                                <th>Total Telah Dibayar</th>
                                <th>Status</th>
                                <th>Deskripsi</th>
                                <th>Aksi</th>
                            </tr>
                            <tbody class="table-border-bottom-0">
                                @forelse ($leases as $index=>$lease)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>
                                            @if ($lease->user->photo)
                                                <img src="{{ asset('storage/' . $lease->user->photo) }}"
                                                    class="rounded-circle img-fluid" alt="{{ $lease->user->name }}">
                                            @elseif ($lease->user->gender === 'male')
                                                <img class="rounded-circle img-fluid" src="../../assets/img/avatars/5.png"
                                                    alt="Avatar">
                                            @elseif ($lease->user->gender === 'female')
                                                <img class="rounded-circle img-fluid" src="../../assets/img/avatars/10.png"
                                                    alt="Avatar">
                                            @endif
                                        </td>
                                        <td>{{ $lease->user->name }}</td>
                                        <td>{{ $lease->properties->name }}</td>
                                        <td>{{ Carbon\Carbon::parse($lease->start_date)->locale('id')->translatedFormat('d F Y') }}
                                        </td>
                                        <td>{{ Carbon\Carbon::parse($lease->end_date)->locale('id')->translatedFormat('d F Y') }}
                                        </td>
                                        <td>{{ 'Rp. ' . number_format($lease->total_iuran) }}
                                        </td>
                                        <td>
                                            <span
                                                class="badge fs-6 {{ $lease->status === 'active' ? 'bg-label-primary' : 'bg-label-secondary' }}">
                                                {{ $lease->status === 'active' ? 'Aktif' : 'Tidak Aktif' }}
                                            </span>
                                        </td>
                                        <td>Rp. {{ number_format($lease->total_nominal) }}
                                        </td>
                                        <td>
                                            <span
                                                class="badge fs-6 {{ $lease->total_nominal >= $lease->total_iuran ? 'bg-label-success' : 'bg-label-danger' }}">
                                                {{ $lease->total_nominal >= $lease->total_iuran ? 'Lunas' : 'Belum Lunas' }}
                                            </span>
                                        </td>
                                        <td>{{ $lease->description ? $lease->description : 'Deskripsi Kosong' }}</td>
                                        <td>
                                            @if ($lease->status === 'active')
                                                <a type="button" class="" data-bs-toggle="modal"
                                                    data-bs-target="#doneModal{{ $lease->id }}"
                                                    data-bs-whatever="@mdo"><i style="color: #00ff37"
                                                        class="menu-icon tf-icons ri-check-line"></i></a>
                                            @endif
                                            <a type="button" class="" data-bs-toggle="modal"
                                                data-bs-target="#editModal{{ $lease->id }}" data-bs-whatever="@mdo"><i
                                                    style="color: #e3a805"
                                                    class="menu-icon tf-icons ri-edit-2-line"></i></a>

                                            <a type="button" class="" data-bs-toggle="modal"
                                                data-bs-target="#deleteModal{{ $lease->id }}">
                                                <i style="color: red" class="menu-icon tf-icons ri-delete-bin-line"></i>
                                            </a>
                                        </td>
                                    </tr>

                                    {{-- Done Detail --}}
                                    <div class="modal fade" id="doneModal{{ $lease->id }}" tabindex="-1"
                                        aria-labelledby="doneModalLabel{{ $lease->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="doneModalLabel{{ $lease->id }}">
                                                        Selesaikan Kontrak
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Apakah ada ingin menyelesaikan kontrak ini?
                                                </div>
                                                <div class="modal-footer">
                                                    <form action="{{ route('leases.done', $lease->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit" class="btn btn-primary">Selesai</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- Done Detail --}}

                                    {{-- Edit Lease Modal --}}
                                    <div class="modal fade" id="editModal{{ $lease->id }}" tabindex="-1"
                                        aria-labelledby="editModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editModalLabel"
                                                        style="color: rgba(32,180,134,1)">Edit
                                                        Kontrak {{ $lease->user->name }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('leases.update', $lease->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="mb-3">
                                                            <label for="user_id" class="form-label">Nama Penyewa</label>
                                                            <input type="text" class="form-control" name="user_id"
                                                                id="user_id" value="{{ $lease->user->name }}" disabled>
                                                            @error('user_id')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="property_id" class="form-label">Kontrakan</label>
                                                            <input type="text" class="form-control" name="property_id"
                                                                id="property_id" value="{{ $lease->properties->name }}"
                                                                disabled>
                                                            @error('property_id')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="start_date" class="form-label">Tanggal
                                                                Mulai</label>
                                                            <input type="date" class="form-control" name="start_date"
                                                                id="start_date" value="{{ $lease->start_date }}"
                                                                disabled>
                                                            @error('start_date')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="end_date" class="form-label">Tanggal
                                                                Berakhir</label>
                                                            <input type="date" class="form-control" name="end_date"
                                                                id="end_date" value="{{ $lease->end_date }}">
                                                            @error('end_date')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="description" class="form-label">Deskripsi
                                                                <small>(Opsional)</small></label>
                                                            <textarea class="form-control" name="description" id="description">{{ $lease->description }}</textarea>
                                                            @error('description')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="d-flex justify-content-end">
                                                            <button type="submit" class="btn btn-primary"><i
                                                                    class="ri-save-line ri-20px"></i>Simpan</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- Edit Lease Modal --}}

                                    {{-- Delete Modal --}}
                                    {{-- <div class="modal fade" id="deleteModal{{ $lease->id }}" tabindex="-1"
                        aria-labelledby="deleteModalLabel{{ $lease->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteModalLabel{{ $lease->id }}">
                                        Hapus
                                        Data Kontrak
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Apakah anda yakin ingin menghapus data kontrak ini?
                                </div>
                                <div class="modal-footer">
                                    <form action="{{ route('leases.destroy', $lease->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                                    {{-- Delete Modal --}}
                                @empty
                                    <tr class="text-center">
                                        <td colspan="50">
                                            <h1 class="material-symbols-outlined mt-4"
                                                style="font-size: 3rem;color:rgba(32, 180, 134,.4);">contract</h1>
                                            <p class="card-title" style="color: rgba(0,0,0,.4)">Kontrak Tidak Ditemukan
                                            </p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    @if ($leases->hasPages())
                        <div class="pagination-container ">
                            <ul class="pagination d-flex justify-content-between align-items-center">
                                {{-- Previous Page Link --}}
                                <style>
                                    li {
                                        border-radius: none;
                                    }
                                </style>
                                @if ($leases->onFirstPage())
                                    <li class="page-item disabled" aria-disabled="true">
                                        <span class="page-link px-6 text-white"
                                            style="background-color: #63cbab">Prev</span>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link px-6 bg-primary text-white"
                                            href="{{ $leases->previousPageUrl() }}" rel="prev">Prev</a>
                                    </li>
                                @endif

                                @php
                                    $currentPage = $leases->currentPage();
                                    $totalPages = $leases->lastPage();
                                    $visiblePages = 1; // Maximum number of page numbers to display
                                @endphp
                                <div class="d-sm-flex d-md-flex d-lg-none ">
                                    <li class="page-item active" aria-disabled="true">
                                        <span class="page-link">{{ $leases->currentPage() }}</span>
                                    </li>
                                </div>
                                {{-- Pagination Elements (visible only on large screens and up) --}}
                                <div class="d-none d-lg-flex gx-4">
                                    {{-- First Page --}}
                                    @if ($currentPage > $visiblePages + 1)
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $leases->url(1) }}">1</a>
                                        </li>
                                        @if ($currentPage > $visiblePages + 2)
                                            <li class="page-item disabled" aria-disabled="true">
                                                <span class="page-link">...</span>
                                            </li>
                                        @endif
                                    @endif

                                    {{-- Page Numbers --}}
                                    @for ($i = max(1, $currentPage - $visiblePages); $i <= min($totalPages, $currentPage + $visiblePages); $i++)
                                        @if ($i == $currentPage)
                                            <li class="page-item active" aria-current="page">
                                                <span class="page-link">{{ $i }}</span>
                                            </li>
                                        @else
                                            <li class="page-item">
                                                <a class="page-link"
                                                    href="{{ $leases->url($i) }}">{{ $i }}</a>
                                            </li>
                                        @endif
                                    @endfor

                                    {{-- Last Page --}}
                                    @if ($currentPage < $totalPages - $visiblePages)
                                        @if ($currentPage < $totalPages - $visiblePages - 1)
                                            <li class="page-item disabled" aria-disabled="true">
                                                <span class="page-link">...</span>
                                            </li>
                                        @endif
                                        <li class="page-item">
                                            <a class="page-link"
                                                href="{{ $leases->url($totalPages) }}">{{ $totalPages }}</a>
                                        </li>
                                    @endif
                                </div>

                                {{-- Next Page Link --}}
                                @if ($leases->hasMorePages())
                                    <li class="page-item">
                                        <a class="page-link px-6 bg-primary text-white"
                                            href="{{ $leases->nextPageUrl() }}" rel="next">Next</a>
                                    </li>
                                @else
                                    <li class="page-item disabled" aria-disabled="true">
                                        <span class="page-link px-6 text-white"
                                            style="background-color: #63cbab">Next</span>
                                    </li>
                                @endif
                            </ul>
                            <div class="d-lg-none w-100" style="color: rgba(0,0,0,.4);font-size:.75rem;">
                                Menampilkan halaman {{ $currentPage }} / {{ $totalPages }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    {{-- Create Lease Modal --}}
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel" style="color: rgba(32,180,134,1)">Tambah Kontrak</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('leases.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <img src="" style="max-width: 250px;border-radius:50%;object-fit: cover;"
                                alt="" id="imgUserCreateModal">
                        </div>
                        <div class="mb-3">
                            <label for="userIdSelect" class="form-label">Nama Penyewa</label>
                            <select class="form-select" name="user_id" id="userIdSelect">
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
                            <label for="property_id" class="form-label">Kontrakan</label>
                            <select class="form-select" name="property_id" id="property_id">
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
                            <label for="start_date" class="form-label">Tanggal Mulai</label>
                            <input type="date" class="form-control" name="start_date" id="start_date"
                                value="{{ old('start_date') }}">
                            @error('start_date')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="end_date" class="form-label">Tanggal Berakhir</label>
                            <input type="date" class="form-control" name="end_date" id="end_date"
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
                            <label for="description" class="form-label">Deskripsi <small>(Opsional)</small></label>
                            <textarea class="form-control" name="description" id="description">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary"><i
                                    class="ri-add-line ri-20px"></i>Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- Create Lease Modal --}}
@endsection
