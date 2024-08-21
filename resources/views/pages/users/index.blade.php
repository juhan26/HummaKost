@extends('app')

@section('content')
    <div class="col-5">
        <style>
            #switchUser {
                border: 1px solid rgba(0, 0, 0, .05);
                transition: ease-in .2s;
            }

            #switchUser:hover {
                background-color: rgba(31, 180, 134, .1);
                transition: ease-in .2s;
                border: 1px solid rgba(31, 180, 134, .3);
            }

            #divSearchInput {
                background-color: rgba(31, 180, 134, .1);
            }
        </style>
        <div class="card" id="switchUser">
            <form action="" method="get">
                @csrf
                <div class="row g-0">
                    <div class="col-6">
                        <label class="form-check-label custom-option-content w-100" for="tenantRadio">
                            <div class="card w-100 shadow-none bg-transparent" id="cardtenant">
                                <div class="card-content">
                                    <div class="card-body d-flex justify-content-center">
                                        <span>Penyewa</span>
                                        <input name="filter" class="form-check-input" id="tenantRadio" type="radio"
                                            value="tenant" onclick="this.form.submit()" checked hidden />
                                    </div>
                                </div>
                            </div>
                        </label>
                    </div>
                    <div class="col-6">
                        <label class="form-check-label custom-option-content w-100" for="adminRadio">
                            <div class="card w-100 shadow-none bg-transparent" id="cardadmin">
                                <div class="card-content">
                                    <div class="card-body d-flex justify-content-center">
                                        <span>Ketua kontrakan</span>
                                        <input name="filter" class="form-check-input" id="adminRadio" type="radio"
                                            value="admin" onclick="this.form.submit()" hidden />
                                    </div>
                                </div>
                            </div>
                        </label>
                    </div>
                </div>
                <script>
                    // Fungsi untuk mendapatkan parameter dari URL
                    function getParameterByName(name) {
                        const urlParams = new URLSearchParams(window.location.search);
                        return urlParams.get(name);
                    }

                    // Ambil nilai dari parameter 'filter'
                    const filterValue = getParameterByName('filter');

                    // Jika ada nilai parameter 'filter' di URL
                    if (filterValue) {
                        // Temukan radio button yang cocok dan set sebagai checked
                        const radio = document.querySelector(`input[name="filter"][value="${filterValue}"]`);
                        const card = document.querySelector(`#card${filterValue}`);
                        if (radio && card) {
                            radio.checked = true;
                            card.classList.toggle('bg-primary')
                            card.classList.toggle('text-white')
                        }
                    } else {
                        const radio = document.querySelector(`input[name="filter"][value="tenant"]`);
                        const card = document.querySelector(`#cardtenant`);
                        if (radio && card) {
                            radio.checked = true;
                            card.classList.toggle('bg-primary')
                            card.classList.toggle('text-white')
                        }
                    }
                </script>
        </div>
    </div>
    <div class="col-12">
        <div class="card">
            <div class="card-content">
                <div class="card-header">
                    <div class="row d-flex align-items-center mt-4" style="height:fit-content">
                        <div class="col-12 col-lg-7 h-100 justify-content-center align-items-center">
                            @php
                                $filteredUsers = $users->filter(function ($user) {
                                    return $user->roles->contains('name', 'tenant');
                                });
                                $title = $filteredUsers->isNotEmpty() ? 'Penyewa' : 'Ketua kontrakan';
                            @endphp
                            <h3 class="card-title">{{ $title }}</h3>
                        </div>
                        <div class="col-12 col-lg-4 h-100">
                            <div class="d-flex align-items-center w-100 px-3" id="divSearchInput"
                                style="border-radius: 15px;height: 60px;">
                                <span class="material-symbols-outlined text-secondary ms-4">search</span>
                                <input type="text" name="search" id="searchInput" class="form-control border-none"
                                    value="{{ request()->input('search') }}">
                                <a href="{{ route('user.index') }}" style="display: none" id="clearSearch"
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
                        </div>
                        <div class="col-12 col-lg-1 ">
                            <div class="dropdown d-flex align-items-center w-100 justify-content-end">
                                <button type="button" class="btn btn-primary w-100  dropdown-toggle hide-arrow"
                                    data-bs-toggle="dropdown"
                                    style="border-radius: 15px;padding-top:.85rem;padding-bottom:.85rem">
                                    <span class="material-symbols-outlined">filter_list</span>
                                </button>
                                <div class="dropdown-menu">
                                    <div class="row p-3" style="width:20rem;">
                                        <div class="col-12">
                                            <p class="card-title">Status</p>
                                            <label class="form-check-label custom-option-content w-100" for="pendingFilter">
                                                <div class="dropdown-item">
                                                    <input name="status[]" class="form-check-input me-2" id="pendingFilter"
                                                        type="checkbox" value="pending" onclick="this.form.submit()"
                                                        @if (in_array('pending', $status)) checked @endif />
                                                    <span>Ditunggu</span>
                                                </div>
                                            </label>
                                            <label class="form-check-label custom-option-content w-100"
                                                for="acceptedFilter">
                                                <div class="dropdown-item">
                                                    <input name="status[]" class="form-check-input me-2" id="acceptedFilter"
                                                        type="checkbox" value="accepted" onclick="this.form.submit()"
                                                        @if (in_array('accepted', $status)) checked @endif />
                                                    <span>Diterima</span>
                                                </div>
                                            </label>
                                            <label class="form-check-label custom-option-content w-100"
                                                for="rejectedFilter">
                                                <div class="dropdown-item">
                                                    <input name="status[]" class="form-check-input me-2" id="rejectedFilter"
                                                        type="checkbox" value="rejected" onclick="this.form.submit()"
                                                        @if (in_array('rejected', $status)) checked @endif />
                                                    <span>Ditolak</span>
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Users -->
                    <div class="table-responsive text-nowrap">
                        <table class="table">
                            <tr class="text-center" style="border-bottom: 1px solid rgba(0,0,0,.15);">
                                <th>No</th>
                                <th>Nama</th>
                                <th>Jenis Kelamin</th>
                                <th>Email</th>
                                <th>Sekolah</th>
                                <th>Nomor Telepon</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                            <tbody class="table-border-bottom-0">
                                @forelse ($users as $index => $user)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>
                                            <ul class="list-unstyled m-0 d-flex avatar-group my-1 align-items-center mx-5">
                                                <li data-bs-toggle="tooltip" data-bs-html="true"
                                                    title='<img src="{{ $user->photo ? asset('storage/' . $user->photo) : asset('assets/img/image_not_available.png') }}"  class="card-img-top img-fluid" alt="{{ $user->name }}">'
                                                    class="avatar pull-up" data-popup="tooltip-custom"
                                                    data-bs-placement="top" id="tt">
                                                    @if ($user->photo)
                                                        <!-- Jika foto pengguna ada, tampilkan foto tersebut -->
                                                        <img src="{{ asset('storage/' . $user->photo) }}"
                                                            class="rounded-circle" alt="{{ $user->name }}">
                                                    @elseif ($user->gender === 'male')
                                                        <!-- Jika jenis kelamin pengguna adalah male dan foto tidak ada, tampilkan avatar laki-laki -->
                                                        <img class="rounded-circle" src="../../assets/img/avatars/5.png"
                                                            alt="Avatar">
                                                    @elseif ($user->gender === 'female')
                                                        <!-- Jika jenis kelamin pengguna adalah female dan foto tidak ada, tampilkan avatar perempuan -->
                                                        <img class="rounded-circle" src="../../assets/img/avatars/10.png"
                                                            alt="Avatar">
                                                    @endif
                                                </li>
                                                <li>
                                                    <span class="card-title ms-3">
                                                        {{ $user->name }}
                                                    </span>
                                                </li>
                                            </ul>
                                            <script>
                                                document.addEventListener('DOMContentLoaded', () => {
                                                    const tooltip = document.querySelectorAll('#tt')
                                                    tooltip.forEach(t => {
                                                        new bootstrap.Tooltip(t);
                                                    });
                                                });
                                            </script>
                                        </td>
                                        <td class="text-center">
                                            @if ($user->gender === 'male')
                                                <div class="w-100 px-5">
                                                    Laki-Laki
                                                </div>
                                            @else
                                                <div class="w-100 px-5">
                                                    Perempuan
                                                </div>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="w-100 px-5">
                                                {{ $user->email }}
                                            </div>
                                        </td>
                                        <td>
                                            @if ($user->instance_id)
                                                <div class="w-100 px-5">
                                                    {{ $user->instance->name }}
                                                </div>
                                            @else
                                                <div class="w-100 px-5">
                                                    Belum Memilih Sekolah
                                                </div>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="w-100 px-5">
                                                {{ $user->instance->name }}
                                            </div>
                                        </td>
                                        <td>
                                            @if ($user->status === 'pending')
                                                <span class="badge rounded-pill bg-label-warning me-1">Tertunda</span>
                                            @elseif ($user->status === 'accepted')
                                                <span class="badge rounded-pill bg-label-primary me-1">Diterima</span>
                                            @else
                                                <span class="badge rounded-pill bg-label-danger me-1">Ditolak</span>
                                            @endif
                                        </td>
                                        @php
                                            $adminAccess = 0;
                                            $userRole = Auth::user();

                                            if ($userRole->hasRole('admin')) {
                                                if ($user->hasRole('admin')) {
                                                    $adminAccess = 1;
                                                }
                                            }
                                        @endphp
                                        @if ($adminAccess === 0 && $user->status === 'pending')
                                            <td>
                                                <div class="w-100 px-5">
                                                    <div class="row w-100 ">
                                                        <div class="col-12 col-lg-6 mb-lg-1">
                                                            <form action="{{ route('user.accept', $user->id) }}"
                                                                method="POST" class="text-center w-100">
                                                                @csrf
                                                                <button type="submit"
                                                                    class="col-12 btn btn-label-success p-0 m-0"
                                                                    style="width: fit-content">
                                                                    <span class="material-symbols-outlined ">check</span>
                                                                </button>
                                                            </form>
                                                        </div>
                                                        <div class="col-12 col-lg-6">
                                                            <form action="{{ route('user.reject', $user->id) }}"
                                                                method="POST" class="text-center w-100">
                                                                @csrf
                                                                <button type="submit"
                                                                    class="col-12 btn btn-label-danger  p-0 m-0 "
                                                                    style="width: fit-content">
                                                                    <span class="material-symbols-outlined ">close</span>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        @elseif ($adminAccess === 0 && $user->status !== 'pending')
                                            <td>
                                                <div class="dropdown d-flex justify-content-center">
                                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                        data-bs-toggle="dropdown"><i class="ri-more-2-line"></i></button>
                                                    <div class="dropdown-menu">
                                                        <a href="#" class="dropdown-item" data-bs-toggle="modal"
                                                            data-bs-target="#editModal{{ $user->id }}"><i
                                                                class="ri-pencil-line me-1"></i>Edit</a>
                                                        <form action="{{ route('user.destroy', $user->id) }}"
                                                            method="POST" class="d-inline"
                                                            onsubmit="return confirm('Apakah kamu yakin akan menghapus data ini?')">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button type="submit" class="dropdown-item"><i
                                                                    class="ri-delete-bin-7-line me-1"></i> Delete</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                                        @elseif ($adminAccess === 1)
                                        @endif
                                    </tr>
                                    <div class="modal fade" id="editModal{{ $user->id }}" tabindex="-1"
                                        aria-labelledby="editModalLabel{{ $user->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editModalLabel{{ $user->id }}">Update
                                                        User {{ $user->name }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('user.update', $user->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="mb-3">
                                                            <label for="editName{{ $user->id }}"
                                                                class="form-label">Name:</label>
                                                            <input type="text" class="form-control" name="name"
                                                                id="editName{{ $user->id }}"
                                                                value="{{ $user->name }}">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="editEmail{{ $user->id }}"
                                                                class="form-label">Email:</label>
                                                            <input type="email" class="form-control" name="email"
                                                                id="editEmail{{ $user->id }}"
                                                                value="{{ $user->email }}">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="editPassword{{ $user->id }}"
                                                                class="form-label">Password:</label>
                                                            <input type="password" class="form-control" name="password"
                                                                id="editPassword{{ $user->id }}">
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Save
                                                                changes</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- Edit Modal --}}
                                @empty
                                    <tr class="text-center">
                                        <!-- Update colspan to match the number of columns in your table -->
                                        <td colspan="8" class="mt-4">
                                            <span class="material-symbols-outlined">group</span>
                                            <p class="card-title">Anggota tidak ditemukan</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    @if ($users->hasPages())
                        <div class="pagination-container ">

                            <ul class="pagination d-lg-flex justify-content-lg-between align-items-lg-center">
                                {{-- Previous Page Link --}}
                                <style>
                                    li{
                                        border-radius: none;
                                    }
                                </style>
                                @if ($users->onFirstPage())
                                    <li class="page-item disabled" aria-disabled="true">
                                        <span class="page-link">&lsaquo;</span>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $users->previousPageUrl() }}"
                                            rel="prev">&lsaquo;</a>
                                    </li>
                                @endif

                                <div class="d-sm-flex d-md-flex d-lg-none ">
                                    <li class="page-item active" aria-disabled="true">
                                        <span class="page-link">{{ $users->currentPage() }}</span>
                                    </li>
                                </div>
                                {{-- Pagination Elements (visible only on large screens and up) --}}
                                <div class="d-none d-lg-flex">
                                    @php
                                        $currentPage = $users->currentPage();
                                        $totalPages = $users->lastPage();
                                        $visiblePages = 1; // Maximum number of page numbers to display
                                    @endphp
                                    {{-- First Page --}}
                                    @if ($currentPage > $visiblePages + 1)
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $users->url(1) }}">1</a>
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
                                                    href="{{ $users->url($i) }}">{{ $i }}</a>
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
                                                href="{{ $users->url($totalPages) }}">{{ $totalPages }}</a>
                                        </li>
                                    @endif
                                </div>

                                {{-- Next Page Link --}}
                                @if ($users->hasMorePages())
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $users->nextPageUrl() }}"
                                            rel="next">&rsaquo;</a>
                                    </li>
                                @else
                                    <li class="page-item disabled" aria-disabled="true">
                                        <span class="page-link">&rsaquo;</span>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    @endif



                    {{-- {{ $users->links() }} --}}
                </div>
            </div>
        </div>
    </div>

    {{-- Create Modal --}}
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">Tambah data penyewa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf
                        <div class="row">

                            <div class="mb-5">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" class="form-control" name="name" id="name"
                                        value="{{ old('name') }}">
                                    <label for="name" class="floatingInput" placeholder="Nama">Name:</label>
                                </div>
                            </div>
                            <div class="mb-5">
                                <div class="form-floating form-floating-outline">
                                    <input type="email" class="form-control" name="email" id="email"
                                        value="{{ old('email') }}">
                                    <label for="email" class="floatingInput" placeholder="Email">Email:</label>
                                </div>
                            </div>
                            <div class="mb-5">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" class="form-control" name="phone_number" id="phone_number"
                                        value="{{ old('phone_number') }}">
                                    <label for="phone_number" class="floatingInput" placeholder="Nomor Telepon">Phone
                                        Number:</label>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6 mb-5 mt-lg-5">
                                <div class="form-floating form-floating-outline">
                                    <select id="selectpickerBasic" class="selectpicker w-100" data-style="btn-default"
                                        name="gender">
                                        <option value="male">Laki-laki</option>
                                        <option value="female">Perempuan</option>
                                    </select>
                                    <label for="selectpickerBasic">Jenis Kelamin</label>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6 mb-5 mt-lg-5">
                                <div class="form-floating form-floating-outline">
                                    <select id="selectpickerBasic" class="select2 w-100"
                                        @foreach ($instances as $instance)
                                            data-style="btn-default" name="instance_id">
                                            <option value="{{ $instance->id }}">
                                                {{ $instance->name }}
                                            </option> @endforeach
                                        </select>
                                        <label for="selectpickerBasic">Instansi</label>
                                </div>
                            </div>

                            <div class="mb-5">
                                <label for="photo" class="form-label">Profile Photo:</label>
                                <input type="file" class="form-control" name="photo" id="photo">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
