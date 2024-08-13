@extends('app')

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <form action="" method="get">
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <label class="form-check-label custom-option-content w-100" for="tenantRadio">
                                    <div class="card w-100" id="cardmember">
                                        <div class="card-content">
                                            <div class="card-body d-flex justify-content-center">
                                                <span>Penyewa</span>
                                                <input name="filter" class="form-check-input" id="tenantRadio"
                                                    type="radio" value="member" onclick="this.form.submit()" checked
                                                    hidden />
                                            </div>
                                        </div>
                                    </div>
                                </label>
                            </div>
                            <div class="col-6">
                                <label class="form-check-label custom-option-content w-100" for="adminRadio">
                                    <div class="card w-100" id="cardadmin">
                                        <div class="card-content">
                                            <div class="card-body d-flex justify-content-center">
                                                <span>Ketua kontrakan</span>
                                                <input name="filter" class="form-check-input" id="adminRadio"
                                                    type="radio" value="admin" onclick="this.form.submit()" hidden />
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
                                const radio = document.querySelector(`input[name="filter"][value="member"]`);
                                const card = document.querySelector(`#cardmember`);
                                if (radio && card) {
                                    radio.checked = true;
                                    card.classList.toggle('bg-primary')
                                    card.classList.toggle('text-white')
                                }
                            }
                        </script>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="card">
            <div class="card-content">
                <div class="card-header">
                    <div class="row">
                        <div class="col-12 col-lg-12">
                            @php
                                if ($cari === 1) {
                                    $title = 'Hasil pencarian..';
                                } else {
                                    $filteredUsers = $users->filter(function ($user) {
                                        return $user->roles->contains('name', 'member');
                                    });
                                    $title = $filteredUsers->isNotEmpty() ? 'Penyewa' : 'Ketua kontrakan';
                                }
                            @endphp
                            <h3 class="card-title">{{ $title }}</h3>
                            <small>Kelola profil dan detail pengguna secara efisien.</small>
                        </div>
                    </div>
                    <div class="row d-flex align-items-center mt-4">
                        <div class="col-12 col-lg-8 mt-4">
                            <form action="" method="GET" class="d-flex w-100 ">
                                @csrf
                                <div class="d-flex align-items-center border rounded w-100 px-3">
                                    <input type="text" name="search" id="searchInput" class="form-control border-none"
                                        value="{{ request()->input('search') }}" placeholder="Search...">
                                    <a href="{{ route('user.index') }}" style="display: none" id="clearSearch"
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
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="d-flex align-items-center w-100 px-3 justify-content-between">
                                <button class="btn btn-secondary w-25" type="submit"><i class="mdi ri-search-line"></i></button>
                                </form>
                                @if ($title !== 'Ketua kontrakan') 
                                    <button type="button" class="btn btn-primary w-50" data-bs-toggle="modal" data-bs-target="#createModal">
                                        Add user
                                    </button>
                                @endif
                            </div>
                        </div>                        
                    </div>
                </div>
                <div class="card-body">
                    <!-- Users -->
                    <div class="table-responsive text-nowrap">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Foto</th>
                                    <th>Nama</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Email</th>
                                    <th>Divisi</th>
                                    <th>Nomor Telepon</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            </thead>

                            <tbody class="table-border-bottom-0">
                                @forelse ($users as $index => $user)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>
                                            <ul class="list-unstyled m-0 d-flex avatar-group my-4">
                                                <li data-bs-toggle="tooltip" data-bs-html="true"
                                                    title='<img src="{{ $user->photo ? asset('storage/' . $user->photo) : asset('assets/img/image_not_available.png') }}"  class="card-img-top img-fluid" alt="{{ $user->name }}">'
                                                    class="avatar pull-up" data-popup="tooltip-custom"
                                                    data-bs-placement="top" id="tt">
                                                    @if ($user->gender === 'male')
                                                        <img class="rounded-circle" src="../../assets/img/avatars/5.png"
                                                            alt="Avatar">
                                                    @else
                                                        <img class="rounded-circle" src="../../assets/img/avatars/10.png"
                                                            alt="Avatar">
                                                    @endif
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
                                        <td>{{ $user->name }}</td>
                                        <td>
                                            @if ($user->gender === 'male')
                                                <span class="badge rounded-pill bg-label-primary me-1"><i
                                                        class="mdi ri-men-line"></i></span>
                                            @else
                                                <span class="badge rounded-pill bg-label-danger me-1"><i
                                                        class="mdi ri-women-line"></i></span>
                                            @endif
                                        </td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            @if ($user->division === 'website')
                                                <span class="fw-medium badge bg-label-primary"><i
                                                        class="ri-global-line ri-22px me-1"></i>
                                                    {{ $user->division }}</span>
                                            @elseif ($user->division === 'mobile')
                                                <span class="fw-medium badge bg-label-danger"><i
                                                        class="ri-smartphone-line ri-22px me-1"></i>
                                                    {{ $user->division }}</span>
                                            @elseif ($user->division === 'uiux')
                                                <span class="fw-medium badge bg-label-success"><i
                                                        class="ri-macbook-line ri-22px me-1"></i>
                                                    {{ $user->division }}</span>
                                            @elseif ($user->division === 'digmar')
                                                <span class="fw-medium badge bg-label-warning"><i
                                                        class="ri-store-3-line ri-22px me-1"></i>
                                                    {{ $user->division }}</span>
                                            @else
                                                <span class="fw-medium badge bg-label-secondary">
                                                    Belum Memilih divisi</span>
                                            @endif
                                        </td>
                                        <td>{{ $user->phone_number }}</td>
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
                                                <div class="row">
                                                    <form action="{{ route('user.accept', $user->id) }}" method="POST"
                                                        class="col-lg-6 col-sm-6 mt-1">
                                                        @csrf
                                                        <button type="submit" class="col-12 btn btn-success"
                                                            type="button"><i class="ri-check-line"></i></button>
                                                    </form>
                                                    <form action="{{ route('user.reject', $user->id) }}" method="POST"
                                                        class="col-lg-6 col-sm-6 mt-1">
                                                        @csrf
                                                        <button type="submit" class="col-12 btn btn-danger"
                                                            type="button"><i class="ri-close-line"></i></button>
                                                    </form>
                                                </div>
                                            </td>
                                        @elseif ($adminAccess === 0 && $user->status !== 'pending')
                                            <td>
                                                <div class="dropdown">
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
                                    {{-- <tr>
                                  <td><i class="ri-basketball-fill ri-22px text-info me-4"></i><span class="fw-medium">Sports Project</span></td>
                                  <td>Barry Hunter</td>
                                  <td>
                                    <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                                      <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" title="Lilian Fuller">
                                        <img src="../../assets/img/avatars/5.png" alt="Avatar" class="rounded-circle">
                                      </li>
                                      <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" title="Sophia Wilkerson">
                                        <img src="../../assets/img/avatars/6.png" alt="Avatar" class="rounded-circle">
                                      </li>
                                      <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" title="Christina Parker">
                                        <img src="../../assets/img/avatars/7.png" alt="Avatar" class="rounded-circle">
                                      </li>
                                    </ul>
                                  </td>
                                  <td><span class="badge rounded-pill bg-label-success me-1">Completed</span></td>
                                  <td>
                                    <div class="dropdown">
                                      <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="ri-more-2-line"></i></button>
                                      <div class="dropdown-menu">
                                        <a class="dropdown-item" href="javascript:void(0);"><i class="ri-pencil-line me-2"></i> Edit</a>
                                        <a class="dropdown-item" href="javascript:void(0);"><i class="ri-delete-bin-7-line me-2"></i> Delete</a>
                                      </div>
                                    </div>
                                  </td>
                                </tr>
                                <tr>
                                  <td><i class="ri-leaf-fill ri-22px text-success me-4"></i><span class="fw-medium">Greenhouse Project</span></td>
                                  <td>Trevor Baker</td>
                                  <td>
                                    <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                                      <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" title="Lilian Fuller">
                                        <img src="../../assets/img/avatars/5.png" alt="Avatar" class="rounded-circle">
                                      </li>
                                      <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" title="Sophia Wilkerson">
                                        <img src="../../assets/img/avatars/6.png" alt="Avatar" class="rounded-circle">
                                      </li>
                                      <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" title="Christina Parker">
                                        <img src="../../assets/img/avatars/7.png" alt="Avatar" class="rounded-circle">
                                      </li>
                                    </ul>
                                  </td>
                                  <td><span class="badge rounded-pill bg-label-info me-1">Scheduled</span></td>
                                  <td>
                                    <div class="dropdown">
                                      <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="ri-more-2-line"></i></button>
                                      <div class="dropdown-menu">
                                        <a class="dropdown-item" href="javascript:void(0);"><i class="ri-pencil-line me-2"></i> Edit</a>
                                        <a class="dropdown-item" href="javascript:void(0);"><i class="ri-delete-bin-7-line me-2"></i> Delete</a>
                                      </div>
                                    </div>
                                  </td>
                                </tr>
                                <tr>
                                  <td><i class="ri-bank-fill ri-22px text-primary me-4"></i><span class="fw-medium">Bank Project</span></td>
                                  <td>Jerry Milton</td>
                                  <td>
                                    <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                                      <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" title="Lilian Fuller">
                                        <img src="../../assets/img/avatars/5.png" alt="Avatar" class="rounded-circle">
                                      </li>
                                      <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" title="Sophia Wilkerson">
                                        <img src="../../assets/img/avatars/6.png" alt="Avatar" class="rounded-circle">
                                      </li>
                                      <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" title="Christina Parker">
                                        <img src="../../assets/img/avatars/7.png" alt="Avatar" class="rounded-circle">
                                      </li>
                                    </ul>
                                  </td>
                                  <td><span class="badge rounded-pill bg-label-warning me-1">Pending</span></td>
                                  <td>
                                    <div class="dropdown">
                                      <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="ri-more-2-line"></i></button>
                                      <div class="dropdown-menu">
                                        <a class="dropdown-item" href="javascript:void(0);"><i class="ri-pencil-line me-2"></i> Edit</a>
                                        <a class="dropdown-item" href="javascript:void(0);"><i class="ri-delete-bin-7-line me-2"></i> Delete</a>
                                      </div>
                                    </div>
                                  </td>
                                </tr> --}}
                                    {{-- <div class="col">
                                    <div class="card h-100">
                                        <img src="{{ $user->photo ? asset('storage/' . $user->photo) : asset('assets/img/image_not_available.png') }}"
                                        class="card-img-top img-fluid" alt="{{ $user->name }}">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $user->name }}</h5>
                                            <p class="card-text">
                                                <strong>Email:</strong> {{ $user->email }}<br>
                                            <strong>Phone Number:</strong> {{ $user->phone_number }}
                                        </p>
                                        <a href="#" class="btn btn-warning" data-bs-toggle="modal"
                                            data-bs-target="#editModal{{ $user->id }}">Edit</a>
                                        <form action="{{ route('user.destroy', $user->id) }}" method="POST"
                                            class="d-inline"
                                            onsubmit="return confirm('Are you sure you want to delete this user?')">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div> --}}
                                    {{-- Edit Modal --}}
                                    <div class="modal fade" id="editModal{{ $user->id }}" tabindex="-1"
                                        aria-labelledby="editModalLabel{{ $user->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editModalLabel{{ $user->id }}">Update
                                                        User
                                                        {{ $user->name }}</h5>
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
                                    <p class="text-center">No users found.</p>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    {{ $users->links() }}
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
                                    <select id="selectpickerBasic" class="selectpicker w-100" data-style="btn-default"
                                        name="division">
                                        <option value="null">Belum memilih</option>
                                        <option value="website">Website</option>
                                        <option value="mobile">Mobile</option>
                                        <option value="uiux">UI/UX</option>
                                        <option value="digmar">Digital Marketing</option>
                                    </select>
                                    <label for="selectpickerBasic">Divisi</label>
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
