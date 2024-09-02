<div class="col-12 tab-pane fade show active" id="tenant-tab-pane" role="tabpanel" aria-labelledby="tenant-tab"
    tabindex="0">
    <div class="card">
        <div class="card-content">
            <div class="card-header">
                <div class="row align-items-center mt-4" style="height:fit-content">
                    <div class="col-12 col-lg-7 h-100 justify-content-center align-items-center mb-sm-5">
                        <h3 class="card-title">Penyewa</h3>
                    </div>
                    <div class="col-10 col-lg-4 h-100 ms-auto">
                        <form action="" method="get">
                            @csrf
                            <div class="d-flex align-items-center w-100 px-3" id="divSearchInput"
                                style="border-radius: 15px;height: 60px;border: 0; background-color: rgba(32,180,134,0.1); outline: none; ">

                                <span class="material-symbols-outlined text-secondary ms-4">search</span>
                                <input type="text" name="search" id="searchInput" class="form-control border-none"
                                    placeholder="Cari..." value="{{ request()->input('search') }}">
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
                    @if (request()->input('filter') === 'admin')
                    @else
                        <div class="col-2 col-lg-1 ">
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
                                            <label class="form-check-label custom-option-content w-100"
                                                for="pendingFilter">
                                                <div class="dropdown-item">
                                                    <input name="status[]" class="form-check-input me-2"
                                                        id="pendingFilter" type="checkbox" value="pending"
                                                        onclick="this.form.submit()"
                                                        @if (in_array('pending', $status)) checked @endif />
                                                    <span>Tertunda</span>
                                                </div>
                                            </label>
                                            <label class="form-check-label custom-option-content w-100"
                                                for="acceptedFilter">
                                                <div class="dropdown-item">
                                                    <input name="status[]" class="form-check-input me-2"
                                                        id="acceptedFilter" type="checkbox" value="accepted"
                                                        onclick="this.form.submit()"
                                                        @if (in_array('accepted', $status)) checked @endif />
                                                    <span>Diterima</span>
                                                </div>
                                            </label>
                                            <label class="form-check-label custom-option-content w-100"
                                                for="rejectedFilter">
                                                <div class="dropdown-item">
                                                    <input name="status[]" class="form-check-input me-2"
                                                        id="rejectedFilter" type="checkbox" value="rejected"
                                                        onclick="this.form.submit()"
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
                    @endif
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
                                            {{ $user->phone_number }}
                                        </div>
                                    </td>
                                    <td>
                                        @if (request()->input('filter') === 'admin')
                                            @php
                                                $lease = \App\Models\Lease::where('user_id', $user->id)->first();
                                            @endphp
                                            @if ($lease !== null)
                                                <a class="text-decoration-underline "
                                                    href="{{ '/properties' . '/' . $lease->property_id }}">{{ $lease->properties->name }}</a>
                                            @else
                                                <span>null</span>
                                            @endif
                                        @else
                                            @if ($user->status === 'pending')
                                                <span class="badge rounded-pill bg-label-warning me-1">Tertunda</span>
                                            @elseif ($user->status === 'accepted')
                                                <span class="badge rounded-pill bg-label-primary me-1">Diterima</span>
                                            @else
                                                <span class="badge rounded-pill bg-label-danger me-1">Ditolak</span>
                                            @endif
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
                                        @hasrole('super_admin')
                                            <td>
                                                <div class="w-100 px-5">
                                                    <div class="row w-100 ">
                                                        <div class="col-12 col-lg-6 mb-lg-1 mb-sm-3">
                                                            <form action="{{ route('user.accept', $user->id) }}"
                                                                method="POST" class="text-center w-100">
                                                                @csrf
                                                                <button type="submit"
                                                                    class="col-12 btn btn-label-success p-0 m-0 accept-button"
                                                                    style="width: fit-content;border:1px solid rgba(50, 200, 50,.2);">
                                                                    <span class="material-symbols-outlined ">check</span>
                                                                </button>
                                                            </form>
                                                        </div>
                                                        <div class="col-12 col-lg-6">
                                                            <form action="{{ route('user.reject', $user->id) }}"
                                                                method="POST" class="text-center w-100">
                                                                @csrf
                                                                <button type="submit"
                                                                    class="col-12 btn btn-label-danger p-0 m-0 reject-button"
                                                                    style="width: fit-content;border:1px solid rgba(200, 50, 50,.1);">
                                                                    <span class="material-symbols-outlined">close</span>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        @endhasrole
                                    @elseif ($adminAccess === 0 && request()->input('filter') === 'admin')
                                        @hasrole('super_admin')
                                            <td>
                                                <div class="dropdown d-flex justify-content-center">
                                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                        data-bs-toggle="dropdown"><i class="ri-more-2-line"></i></button>
                                                    <div class="dropdown-menu">
                                                        <a href="#" class="dropdown-item" data-bs-toggle="modal"
                                                            data-bs-target="#editModal{{ $user->id }}"><i
                                                                class="ri-pencil-line me-1"></i>Ubah</a>
                                                        <a href="#" class="dropdown-item" data-bs-toggle="modal"
                                                            data-bs-target="#dismissModal{{ $user->id }}"><i
                                                                class="ri-close-circle-line me-1"></i>Berhentikan
                                                            sebagai ketua kontrakan</a>

                                                    </div>
                                                </div>
                                            </td>
                                        @endhasrole
                                    @elseif ($adminAccess === 0 && $user->status !== 'pending')
                                        @hasrole('super_admin')
                                            <td>
                                                <div class="dropdown d-flex justify-content-center">
                                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                        data-bs-toggle="dropdown"><i class="ri-more-2-line"></i></button>
                                                    <div class="dropdown-menu">
                                                        <a href="#" class="dropdown-item" data-bs-toggle="modal"
                                                            data-bs-target="#editModal{{ $user->id }}"><i
                                                                class="ri-pencil-line me-1"></i>Ubah</a>
                                                        <a href="#" class="dropdown-item" data-bs-toggle="modal"
                                                            data-bs-target="#deleteModal{{ $user->id }}"><i
                                                                class="ri-delete-bin-line me-1"></i>Hapus
                                                            Anggota</a>

                                                    </div>

                                                </div>
                                            </td>
                                        @endhasrole
                                    @elseif ($adminAccess === 1)
                                    @endif
                                </tr>
                                <div class="modal fade" id="editModal{{ $user->id }}" tabindex="-1"
                                    aria-labelledby="editModalLabel{{ $user->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editModalLabel{{ $user->id }}">
                                                    Ubah data anggota <span
                                                        class="text-primary">{{ $user->name }}</span>
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('user.update', $user->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="row">
                                                        <div class="col-12 col-lg-12">
                                                            <div class="mb-3">
                                                                <label for="editName{{ $user->id }}"
                                                                    class="form-label">Name:</label>
                                                                <input type="hidden" class="form-control"
                                                                    name="memberMenu" value="y">
                                                                <input type="text" class="form-control"
                                                                    name="name" id="editName{{ $user->id }}"
                                                                    value="{{ $user->name }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-lg-12">
                                                            <div class="mb-3">
                                                                <label for="editEmail{{ $user->id }}"
                                                                    class="form-label">Email:</label>
                                                                <input type="email" class="form-control"
                                                                    name="email" disabled
                                                                    id="editEmail{{ $user->id }}"
                                                                    value="{{ $user->email }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="edittel{{ $user->id }}"
                                                                    class="form-label">Nomor
                                                                    Telepon:</label>
                                                                <input type="number" class="form-control"
                                                                    name="phone_number"
                                                                    id="edittel{{ $user->id }}"
                                                                    value="{{ $user->phone_number }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="selectGender{{ $user->id }}"
                                                                    class="form-label">Jenis
                                                                    Kelamin</label>
                                                                <select id="selectGender{{ $user->id }}"
                                                                    class="form-select" name="gender">
                                                                    <option value="male"
                                                                        {{ $user->gender == 'male' ? 'selected' : '' }}>
                                                                        Laki-laki</option>
                                                                    <option value="female"
                                                                        {{ $user->gender == 'female' ? 'selected' : '' }}>
                                                                        Perempuan</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-lg-12 mb-5 mt-lg-5">
                                                            <label for="selectInstance{{ $user->id }}"
                                                                class="form-label">Instansi</label>
                                                            <select id="selectInstance{{ $user->id }}"
                                                                class="form-select" name="instance_id" disabled>
                                                                @foreach ($instances as $instance)
                                                                    <option value="{{ $instance->id }}"
                                                                        {{ $user->instance_id == $instance->id ? 'selected' : '' }}>
                                                                        {{ $instance->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Tutup</button>
                                                        <button type="submit" class="btn btn-primary">Simpan
                                                            Perubahan</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal fade" id="deleteModal{{ $user->id }}" tabindex="-1"
                                    aria-labelledby="deleteModalLabel{{ $user->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteModalLabel{{ $user->id }}">
                                                    Hapus anggota <span class="text-danger">{{ $user->name }}</span>
                                                    </span>
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p class="card-">Apakah anda yakin akan menghapus anggota
                                                    ini?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal" aria-label="Close">Batal</button>
                                                <form action="{{ route('user.destroy', $user->id) }}" method="POST"
                                                    class="d-inline">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger">Hapus
                                                        Anggota</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" id="dismissModal{{ $user->id }}" tabindex="-1"
                                    aria-labelledby="dismissModalLabel{{ $user->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="dismissModalLabel{{ $user->id }}">
                                                    Berhentikan <span class="text-primary">{{ $user->name }}</span>
                                                    </span>
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p class="card-">Apakah anda yakin akan memberhentikan
                                                    <span class="text-primary">{{ $user->name }}</span>
                                                    sebagai ketua
                                                    kontrakan?
                                                </p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal" aria-label="Close">Batal</button>
                                                <form action="{{ route('user.dismissHeadLease', $user->id) }}"
                                                    method="POST" class="d-inline">
                                                    @method('POST')
                                                    @csrf
                                                    <button type="submit" class="btn btn-primary">simpan</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- Edit Modal --}}
                            @empty
                                <tr class="text-center">
                                    <!-- Update colspan to match the number of columns in your table -->
                                    <td colspan="8" class="">
                                        <h1 class="material-symbols-outlined mt-4"
                                            style="font-size: 3rem;color:rgba(32, 180, 134,.4);">group</h1>
                                        <p class="card-title" style="color: rgba(0,0,0,.4)">Anggota tidak
                                            ditemukan
                                        </p>
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
                        @php
                            $currentPage = $users->currentPage();
                            $totalPages = $users->lastPage();
                            $visiblePages = 1;

                            $totalData = \App\Models\User::count();
                            $dataPerPage = $users->perPage();
                            $startItem = ($currentPage - 1) * $dataPerPage + 1;
                            $endItem = min($currentPage * $dataPerPage, $totalData);
                        @endphp
                        <div class="w-100 my-3" style="color: rgba(0,0,0,.6); font-size:.75rem;">
                            Menampilkan data {{ $startItem }} - {{ $endItem }} dari
                            {{ $totalData }}
                        </div>
                        <ul class="pagination d-flex justify-content-between align-items-center">
                            {{-- Previous Page Link --}}
                            <style>
                                li {
                                    border-radius: none;
                                }
                            </style>
                            @if ($users->onFirstPage())
                                <li class="page-item disabled" aria-disabled="true">
                                    <span class="page-link px-6 text-white"
                                        style="background-color: #63cbab">Prev</span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link px-6 bg-primary text-white"
                                        href="{{ $users->previousPageUrl() }}" rel="prev">Prev</a>
                                </li>
                            @endif


                            <div class="d-sm-flex d-md-flex d-lg-none ">
                                <li class="page-item active" aria-disabled="true">
                                    <span class="page-link">{{ $users->currentPage() }}</span>
                                </li>
                            </div>
                            {{-- Pagination Elements (visible only on large screens and up) --}}
                            <div class="d-none d-lg-flex gx-4">
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
                                    <a class="page-link px-6 bg-primary text-white"
                                        href="{{ $users->nextPageUrl() }}" rel="next">Next</a>
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
