@extends('app')

@section('content')
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">


            <div class="row gy-6 gy-md-0">
                <!-- User Sidebar -->
                <div class="col-xl-5 col-lg-5 col-md-5 order-1 order-md-0">
                    <!-- User Card -->
                    <div class="card mb-6">
                        <div class="card-body pt-12">
                            <div class="user-avatar-section">
                                <div class=" d-flex align-items-center flex-column">
                                    <div
                                        style="width: 400px; height: 400px;
                                    border-radius: 50%;
                                    background-position: center;
                                    background-size: cover;
                                    background-image: url('{{ $user->photo ? asset('storage/' . $user->photo) : ($user->gender === 'male' ? asset('assets/img/avatars/1.png') : asset('assets/img/avatars/10.png')) }}');
                                    ">

                                    </div>
                                    {{-- <img class="img-fluid mb-4 " style="border-radius: 50%; width: 10rem;"
                                        src="{{ $user->photo ? asset('storage/' . $user->photo) : ($user->gender === 'male' ? asset('assets/img/avatars/1.png') : asset('assets/img/avatars/10.png')) }}"
                                        height="120" width="120" alt="{{ $user->name }}"> --}}


                                    <div class="user-info text-center">
                                        <h5 class="mt-3">{{ $user->name }}</h5>
                                        @foreach ($user->getRoleNames() as $role)
                                            @if ($role == 'admin')
                                                <span class="badge bg-label-warning rounded-pill">Ketua Kontrakan</span>
                                            @elseif ($role == 'super_admin')
                                                <span class="badge bg-label-primary rounded-pill">Super Admin</span>
                                            @else
                                                <span class="badge bg-label-danger   rounded-pill">Penyewa</span>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-around flex-wrap my-6 gap-0 gap-md-3 gap-lg-4">
                                <div class="d-flex align-items-center me-5 gap-4">
                                    <div class="avatar">
                                        <div class="avatar-initial bg-label-primary rounded-3">
                                            <span class="material-symbols-outlined">cottage</span>
                                        </div>
                                    </div>
                                    <div>
                                        <h5 class="mb-0">Kontrakan</h5>
                                        <span>{{ $user->lease ? $user->lease->properties->name : 'belum ada' }}</span>
                                    </div>
                                </div>
                                @hasrole('admin|tenant')
                                    <div class="d-flex align-items-center gap-4">
                                        <div class="avatar">
                                            <div class="avatar-initial bg-label-primary rounded-3">
                                                <span class="material-symbols-outlined">school</span>
                                            </div>
                                        </div>
                                        <div>
                                            <h5 class="mb-0">Sekolah</h5>
                                            <span>{{ $user->instance ? $user->instance->name : 'Sekolah Tidak ditemukan' }}</span>
                                        </div>
                                    </div>
                                @endhasrole
                            </div>

                        </div>
                    </div>
                    <!-- /User Card -->
                    <!-- Plan Card -->
                    {{-- <div class="card mb-6 border border-2 border-primary">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start">
                                <span class="badge bg-label-primary rounded-pill">Standard</span>
                                <div class="d-flex justify-content-center">
                                    <sup class="h5 pricing-currency mt-5 mb-0 me-1 text-primary">$</sup>
                                    <h1 class="mb-0 text-primary">99</h1>
                                    <sub class="h6 pricing-duration mt-auto mb-3 fw-normal">month</sub>
                                </div>
                            </div>
                            <ul class="list-unstyled g-2 my-6">
                                <li class="mb-2 d-flex align-items-center"><i
                                        class="ri-circle-fill text-body ri-10px me-2"></i><span>10 Users</span></li>
                                <li class="mb-2 d-flex align-items-center"><i
                                        class="ri-circle-fill text-body ri-10px me-2"></i><span>Up to 10 GB storage</span>
                                </li>
                                <li class="mb-2 d-flex align-items-center"><i
                                        class="ri-circle-fill text-body ri-10px me-2"></i><span>Basic Support</span></li>
                            </ul>
                            <div class="d-flex justify-content-between align-items-center mb-1 fw-medium text-heading">
                                <span>Days</span>
                                <span>26 of 30 Days</span>
                            </div>
                            <div class="progress mb-1 rounded">
                                <div class="progress-bar rounded" role="progressbar" style="width: 75%;" aria-valuenow="75"
                                    aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <small>4 days remaining</small>
                            <div class="d-grid w-100 mt-6">
                                <button class="btn btn-primary waves-effect waves-light" data-bs-target="#upgradePlanModal"
                                    data-bs-toggle="modal">Upgrade Plan</button>
                            </div>
                        </div>
                    </div> --}}
                    <!-- /Plan Card -->
                </div>
                <!--/ User Sidebar -->


                <!-- User Content -->
                <div class="col-xl-7 col-lg-7 col-md-7 order-0 order-md-1">
                    <!-- Activity Timeline -->
                    <div class="col-12">
                        <div class="card text-center mb-4">
                            <div class="card-header p-0">
                                <div class="nav-align-top">
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button type="button"
                                                class="nav-link d-flex flex-column gap-1 waves-effect active" role="tab"
                                                data-bs-toggle="tab" data-bs-target="#navs-profile-card"
                                                aria-controls="navs-profile-card" aria-selected="true" tabindex="-1"><i
                                                    class="tf-icons ri-user-3-line"></i> Profil</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button type="button" class="nav-link d-flex flex-column gap-1 waves-effect"
                                                role="tab" data-bs-toggle="tab" data-bs-target="#navs-messages-card"
                                                aria-controls="navs-messages-card" aria-selected="false" tabindex="-1"><i
                                                    class="tf-icons ri-message-2-line"></i> Keamanan </button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-body" style="width: 100%;  height: 100%;">
                                <div class="tab-content pb-0">
                                    <div class="tab-pane fade active show" id="navs-profile-card" role="tabpanel">
                                        <small
                                            class="card-text text-uppercase text-muted small d-flex justify-content-start">Detail</small>
                                        <ul class="list-unstyled my-3 py-1">
                                            <li class="d-flex align-items-center mb-4"><i
                                                    class="ri-user-3-line ri-24px"></i><span class="fw-medium mx-2">
                                                    Nama:</span> <span>{{ $user->name }}</span></li>
                                            <li class="d-flex align-items-center mb-4">
                                                @if ($user->gender == 'male')
                                                    <i class="ri-men-line ri-24px"></i>
                                                @else
                                                    <i class="ri-women-line ri-24px"></i>
                                                @endif
                                                <span class="fw-medium mx-2">
                                                    Gender:</span> <span>
                                                    @if ($user->gender == 'male')
                                                        Laki-laki
                                                    @else
                                                        Perempuan
                                                    @endif
                                                </span>
                                            </li>
                                            <li class="d-flex align-items-center mb-4"><i
                                                    class="ri-check-line ri-24px"></i><span
                                                    class="fw-medium mx-2">Status:</span>
                                                @if ($user->lease)
                                                    @if ($user->lease->status == 'active')
                                                        <span class="badge bg-label-success rounded-pill">Aktif</span>
                                                    @else
                                                        <span class="badge bg-label-danger rounded-pill">Tidak Aktif</span>
                                                    @endif
                                                @else
                                                    <span class="badge bg-label-danger rounded-pill">Tidak Aktif</span>
                                                @endif
                                            <li class="d-flex align-items-center mb-4"><i
                                                    class="ri-star-smile-line ri-24px"></i><span
                                                    class="fw-medium mx-2">Role:</span>
                                                @foreach ($user->getRoleNames() as $role)
                                                    @if ($role == 'admin')
                                                        <span>Ketua Kontrakan</span>
                                                    @elseif ($role == 'super_admin')
                                                        <span>Super Admin</span>
                                                    @else
                                                        <span>Penyewa</span>
                                                    @endif
                                                @endforeach
                                            </li>
                                        </ul>
                                        <small
                                            class="card-text text-uppercase text-muted small d-flex justify-content-start">Kontak</small>
                                        <ul class="list-unstyled my-3 py-1">
                                            <li class="d-flex align-items-center mb-4"><i
                                                    class="ri-phone-line ri-24px"></i><span class="fw-medium mx-2">No
                                                    Hp:</span>
                                                <span>{{ $user->phone_number }}</span>
                                            </li>
                                            <li class="d-flex align-items-center mb-2"><i
                                                    class="ri-mail-open-line ri-24px"></i><span
                                                    class="fw-medium mx-2">Email:</span>
                                                <span>{{ $user->email }}</span>
                                            </li>
                                        </ul>
                                        <div class="d-flex justify-content-end">
                                            <a href="javascript:;" class="btn btn-primary me-4 waves-effect waves-light"
                                                data-bs-target="#editUser" data-bs-toggle="modal">Edit</a>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="navs-messages-card" role="tabpanel">
                                        <h5 class="card-header">Ganti Password</h5>
                                        <div class="card-body">
                                            <!-- Form action diubah menjadi POST dan menambahkan action ke route changePassword -->
                                            <form id="formChangePassword" method="POST"
                                                action="{{ route('profile.changePassword') }}"
                                                class="fv-plugins-bootstrap5 fv-plugins-framework" novalidate="novalidate">
                                                @csrf <!-- Menambahkan CSRF token untuk keamanan -->
                                                <div class="alert alert-warning alert-dismissible" role="alert">
                                                    <h5 class="alert-heading mb-1">Untuk memastikan bahwa persyaratan ini
                                                        terpenuhi.
                                                        <span>Minimal 8 karakter Untuk Mematikan Bahwa Persyatan Ini Terpernuhi</span>
                                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                            aria-label="Close"></button>
                                                </div>
                                                <div class="row gx-5">
                                                    <div
                                                        class="mb-3 col-12 col-sm-6 form-password-toggle fv-plugins-icon-container">
                                                        <div class="input-group input-group-merge">
                                                            <div class="form-floating form-floating-outline">
                                                                <input class="form-control" type="password"
                                                                    id="password" name="password"
                                                                    placeholder="············">
                                                                <label for="password">Password Baru</label>
                                                            </div>
                                                            <span class="input-group-text cursor-pointer text-heading">
                                                                <i id="password-icon" class=""></i>
                                                            </span>
                                                        </div>
                                                        <div
                                                            class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                        </div>
                                                    </div>

                                                    <div
                                                        class="mb-3 col-12 col-sm-6 form-password-toggle fv-plugins-icon-container">
                                                        <div class="input-group input-group-merge">
                                                            <div class="form-floating form-floating-outline">
                                                                <input class="form-control" type="password"
                                                                    name="confirmPassword" id="confirmPassword"
                                                                    placeholder="············">
                                                                <label for="confirmPassword">Konfirmasi Password Baru</label>
                                                            </div>
                                                            <span class="input-group-text cursor-pointer text-heading">
                                                                <i id="password-icon" class=""></i>
                                                            </span>
                                                        </div>
                                                        <div
                                                            class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <button type="submit"
                                                            class="btn btn-primary me-2 waves-effect waves-light">Ganti
                                                            Password</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="row mt-8">
                            <div class="col-6">
                                <span style="">
                                    <h5 style="text-align: center">Total Yang Sudah Dibayar</h5>
                                </span>
                                <div class="card bg-success-subtle text-center">
                                    <div class="card-content">
                                        <div class="card-body">
                                            <h5 class="text-success mt-2">
                                                {{ $user->lease ? 'Rp. ' . number_format($user->lease->total_nominal) : 'Belum Ada Pembayaran' }}
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <span style="">
                                    <h5 style="text-align: center">Total Yang Harus Dibayar</h5>
                                </span>
                                <div class="card bg-warning-subtle text-center">
                                    <div class="card-content">
                                        <div class="card-body">
                                            <h5 class="text-warning mt-2">
                                                {{ $user->lease ? ($user->lease->total_nominal === $user->lease->total_iuran ? 'Lunas' : 'Rp. ' . number_format($user->lease->total_iuran - $user->lease->total_nominal)) : 'Belum Ada Tagihan' }}
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="card mb-6">
                        <h5 class="pb-4 border-bottom mb-4">Details</h5>
                        <div class="info-container">
                            <ul class="list-unstyled mb-6">
                                <li class="mb-2">
                                    <span class="fw-medium text-heading me-2">Name:</span>
                                    <span>{{ $user->name }}</span>
                                </li>
                                <li class="mb-2">
                                    <span class="fw-medium text-heading me-2">Email:</span>
                                    <span>{{ $user->email }}</span>
                                </li>
                                <li class="mb-2">
                                    <span class="fw-medium text-heading me-2">Status:</span>
                                    @if ($user->status == 'accepted')
                                        <span class="badge bg-label-success rounded-pill">{{ $user->status }}</span>
                                    @else
                                    @endif
                                </li>
                                <li class="mb-2">
                                    <span class="fw-medium text-heading me-2">Contact:</span>
                                    <span>{{ $user->phone_number }}</span>
                                </li>
                                <li class="mb-2">
                                    <span class="fw-medium text-heading me-2">Joined:</span>
                                    <span>{{ $user->created_at->translatedFormat('d F Y') }}</span>
                                </li>
                            </ul>
                            <div class="d-flex justify-content-center">
                                <a href="javascript:;" class="btn btn-primary me-4 waves-effect waves-light"
                                    data-bs-target="#editUser" data-bs-toggle="modal">Edit</a>
                                <a href="javascript:;"
                                    class="btn btn-outline-danger suspend-user waves-effect">Suspend</a>
                            </div>
                        </div>
                        <h5 class="card-header">User Activity Timeline</h5>
                        <div class="card-body pt-0">
                            <ul class="timeline mb-0 mt-2">
                                <li class="timeline-item timeline-item-transparent">
                                    <span class="timeline-point timeline-point-primary"></span>
                                    <div class="timeline-event">
                                        <div class="timeline-header mb-3">
                                            <h6 class="mb-0">12 Invoices have been paid</h6>
                                            <small class="text-muted">12 min ago</small>
                                        </div>
                                        <p class="mb-2">
                                            Invoices have been paid to the company
                                        </p>
                                        <div class="d-flex align-items-center mb-1">
                                            <div class="badge bg-lighter rounded-3 mb-1_5">
                                                <img src="../../assets/img/icons/misc/pdf.png" alt="img"
                                                    width="15" class="me-2">
                                                <span class="h6 mb-0 text-secondary">invoices.pdf</span>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="timeline-item timeline-item-transparent">
                                    <span class="timeline-point timeline-point-success"></span>
                                    <div class="timeline-event">
                                        <div class="timeline-header mb-3">
                                            <h6 class="mb-0">Client Meeting</h6>
                                            <small class="text-muted">45 min ago</small>
                                        </div>
                                        <p class="mb-2">
                                            Project meeting with john @10:15am
                                        </p>
                                        <div class="d-flex justify-content-between flex-wrap gap-2 mb-1_5">
                                            <div class="d-flex flex-wrap align-items-center">
                                                <div class="avatar avatar-sm me-2">
                                                    <img src="../../assets/img/avatars/4.png" alt="Avatar"
                                                        class="rounded-circle">
                                                </div>
                                                <div>
                                                    <p class="mb-0 small fw-medium">Lester McCarthy (Client)</p>
                                                    <small>CEO of Pixinvent</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="timeline-item timeline-item-transparent">
                                    <span class="timeline-point timeline-point-info"></span>
                                    <div class="timeline-event">
                                        <div class="timeline-header mb-3">
                                            <h6 class="mb-0">Create a new project for client</h6>
                                            <small class="text-muted">2 Day Ago</small>
                                        </div>
                                        <p class="mb-2">
                                            6 team members in a project
                                        </p>
                                        <ul class="list-group list-group-flush">
                                            <li
                                                class="list-group-item d-flex justify-content-between align-items-center flex-wrap border-top-0 p-0">
                                                <div class="d-flex flex-wrap align-items-center">
                                                    <ul
                                                        class="list-unstyled users-list d-flex align-items-center avatar-group m-0 me-2">
                                                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom"
                                                            data-bs-placement="top" class="avatar pull-up"
                                                            aria-label="Vinnie Mostowy"
                                                            data-bs-original-title="Vinnie Mostowy">
                                                            <img class="rounded-circle"
                                                                src="../../assets/img/avatars/5.png" alt="Avatar">
                                                        </li>
                                                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom"
                                                            data-bs-placement="top" class="avatar pull-up"
                                                            aria-label="Allen Rieske"
                                                            data-bs-original-title="Allen Rieske">
                                                            <img class="rounded-circle"
                                                                src="../../assets/img/avatars/12.png" alt="Avatar">
                                                        </li>
                                                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom"
                                                            data-bs-placement="top" class="avatar pull-up"
                                                            aria-label="Julee Rossignol"
                                                            data-bs-original-title="Julee Rossignol">
                                                            <img class="rounded-circle"
                                                                src="../../assets/img/avatars/6.png" alt="Avatar">
                                                        </li>
                                                        <li class="avatar">
                                                            <span
                                                                class="avatar-initial rounded-circle pull-up text-heading"
                                                                data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                                data-bs-original-title="3 more">+3</span>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div> --}}
                    <!-- /Activity Timeline -->

                    <!-- Invoice table -->
                    {{-- <div class="card">
                        <div class="table-responsive mb-4">
                            <div id="DataTables_Table_1_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                                <div class="card-header d-flex">
                                    <div class="head-label">
                                        <h5 class="card-title mb-0">Invoice List</h5>
                                    </div>
                                    <div class="dt-action-buttons text-end pt-0">
                                        <div class="dt-buttons btn-group flex-wrap">
                                            <div class="btn-group"><button
                                                    class="btn btn-secondary buttons-collection dropdown-toggle btn-primary float-end mb-0 waves-effect waves-light"
                                                    tabindex="0" aria-controls="DataTables_Table_1" type="button"
                                                    aria-haspopup="dialog" aria-expanded="false"><span><i
                                                            class="ri-upload-2-line me-2"></i>Export</span></button></div>
                                        </div>
                                    </div>
                                </div>
                                <table class="table datatable-invoice dataTable no-footer dtr-column"
                                    id="DataTables_Table_1" aria-describedby="DataTables_Table_1_info">
                                    <thead>
                                        <tr>
                                            <th class="control sorting dtr-hidden" tabindex="0"
                                                aria-controls="DataTables_Table_1" rowspan="1" colspan="1"
                                                style="width: 25.7px; display: none;"
                                                aria-label=": activate to sort column ascending"></th>
                                            <th class="sorting sorting_desc" tabindex="0"
                                                aria-controls="DataTables_Table_1" rowspan="1" colspan="1"
                                                style="width: 38.975px;" aria-sort="descending"
                                                aria-label="#: activate to sort column ascending">#</th>
                                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_1"
                                                rowspan="1" colspan="1" style="width: 105.988px;"
                                                aria-label="Status: activate to sort column ascending">Status</th>
                                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_1"
                                                rowspan="1" colspan="1" style="width: 92.1125px;"
                                                aria-label="Total: activate to sort column ascending">Total</th>
                                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_1"
                                                rowspan="1" colspan="1" style="width: 160.05px;"
                                                aria-label="Issued Date: activate to sort column ascending">Issued Date
                                            </th>
                                            <th class="sorting_disabled" rowspan="1" colspan="1"
                                                style="width: 102.375px;" aria-label="Action">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="odd">
                                            <td valign="top" colspan="5" class="dataTables_empty">Loading...</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="row mx-5 row-gap-2">
                                    <div class="col-sm-12 col-xxl-6 text-xxl-start text-center pe-5">
                                        <div class="dataTables_info" id="DataTables_Table_1_info" role="status"
                                            aria-live="polite">Showing 0 to 0 of 0 entries</div>
                                    </div>
                                    <div class="col-sm-12 col-xxl-6">
                                        <div class="dataTables_paginate paging_simple_numbers"
                                            id="DataTables_Table_1_paginate">
                                            <ul class="pagination justify-content-xxl-end justify-content-center">
                                                <li class="paginate_button page-item previous disabled"
                                                    id="DataTables_Table_1_previous"><a aria-controls="DataTables_Table_1"
                                                        aria-disabled="true" role="link" data-dt-idx="previous"
                                                        tabindex="-1" class="page-link">Previous</a></li>
                                                <li class="paginate_button page-item next disabled"
                                                    id="DataTables_Table_1_next"><a aria-controls="DataTables_Table_1"
                                                        aria-disabled="true" role="link" data-dt-idx="next"
                                                        tabindex="-1" class="page-link">Next</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    <!-- /Invoice table -->
                </div>
                <!--/ User Content -->
            </div>

            <!-- Modal -->
            <!-- Edit User Modal -->
            <div class="modal fade" id="editUser" tabindex="-1" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="text-center mb-6">
                                <h4 class="mb-2">Edit User Information</h4>
                                <p class="mb-6">Updating user details will receive a privacy audit.</p>
                            </div>
                            <!-- Menampilkan Foto Pengguna -->
                            <form action="{{ route('user.update', $user->id) }}" method="post"
                                enctype="multipart/form-data" id="editUserForm"
                                class="row g-5 fv-plugins-bootstrap5 fv-plugins-framework justify-content-center">
                                @csrf
                                @method('PUT')


                                <div class="col-12 col-md-6 d-flex flex-column align-items-center">
                                    <style>
                                        /* Container untuk gambar dan ikon */
                                        .image-container {
                                            position: relative;
                                            display: inline-block;
                                            width: 200px;
                                            height: 200px;
                                            border-radius: 50%;
                                            background-position: center;
                                            background-size: cover;
                                            background-image: url('{{ $user->photo ? asset('storage/' . $user->photo) : ($user->gender === 'male' ? asset('assets/img/avatars/1.png') : asset('assets/img/avatars/10.png')) }}');
                                        }

                                        /* Layer hitam dengan opacity */
                                        .overlay {
                                            position: absolute;
                                            top: 0;
                                            left: 0;
                                            width: 100%;
                                            height: 100%;
                                            background-color: rgba(0, 0, 0, 0.3);
                                            border-radius: 50%;
                                            opacity: 0;
                                            transition: opacity 0.3s ease-in-out;
                                            display: flex;
                                            align-items: center;
                                            justify-content: center;
                                            cursor: pointer;
                                        }

                                        /* Ikon pensil di tengah */
                                        .overlay i {
                                            color: white;
                                            font-size: 24px;
                                            visibility: hidden;
                                        }

                                        /* Efek hover */
                                        .image-container:hover .overlay {
                                            opacity: 1;
                                        }

                                        .image-container:hover .overlay i {
                                            visibility: visible;
                                        }
                                    </style>

                                    <label for="modalEditUserPhoto">
                                        <div class="image-container" id="imgpp">
                                            <div class="overlay">
                                                <i class="ri-edit-line"></i>
                                            </div>
                                            <input accept=".jpeg" type="file" id="modalEditUserPhoto" name="photo"
                                                class="form-control" hidden onchange="previewImage(event)">
                                        </div>
                                    </label>

                                    <script>
                                        function previewImage(event) {
                                            var reader = new FileReader();
                                            reader.onload = function() {
                                                var output = document.getElementById('imgpp');
                                                output.style.backgroundImage = 'url(' + reader.result + ')';
                                            }
                                            reader.readAsDataURL(event.target.files[0]);
                                        }
                                    </script>


                                </div>
                                <div class="col-12 fv-plugins-icon-container">
                                    <div class="form-floating form-floating-outline">
                                        <input type="text" id="name" name="name" class="form-control"
                                            value="{{ old('name', $user->name) }}"
                                            placeholder="{{ old('name', $user->name) }}">
                                        <label for="name">Name</label>
                                    </div>
                                    <div
                                        class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                    </div>
                                </div>

                                <div class="col-12 col-md-12">

                                    <div class="input-group input-group-merge">
                                        <div class="form-floating form-floating-outline">
                                            <input type="text" id="phone_number" name="phone_number"
                                                class="form-control phone-number-mask"
                                                value="{{ old('phone_number', $user->phone_number) }}"
                                                placeholder="{{ old('phone_number', $user->phone_number) }}">
                                            <label for="phone_number">Phone Number</label>
                                        </div>
                                    </div>
                                </div>
                                @hasrole('admin|user')
                                    <div class="col-6">
                                        <div class="form-floating form-floating-outline">
                                            <input type="text" id="school_id" name="school_id" class="form-control"
                                                placeholder="{{ $user->instance->name }}"
                                                value="{{ $user->instance->name }}" disabled>
                                            <label for="school_id">Sekolah</label>
                                        </div>
                                    </div>
                                @endhasrole
                                <div class="col-12">
                                    <div class="form-floating form-floating-outline">
                                        <input type="text" id="email" name="email" class="form-control"
                                            value="{{ $user->email }}" placeholder="{{ $user->email }}" disabled>
                                        <label for="email">Email</label>
                                    </div>
                                </div>
                                <div class="col-12 text-center d-flex flex-wrap justify-content-center gap-4 row-gap-4">
                                    <button type="submit"
                                        class="btn btn-primary waves-effect waves-light">Submit</button>
                                    <button type="reset" class="btn btn-outline-secondary waves-effect"
                                        data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                                </div>
                                <input type="hidden">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ Edit User Modal -->

            <!-- Upgrade Plan -->

            <!--/ Upgrade Plan -->

            <!-- /Modal -->
        </div>
        <!-- / Content -->




        <!-- Footer -->

        <!-- / Footer -->


        <div class="content-backdrop fade"></div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const passwordField = document.getElementById('password');
            const passwordToggle = document.getElementById('password-toggle');
            const passwordIcon = document.getElementById('password-icon');

            passwordToggle.addEventListener('click', function() {
                // Toggle password visibility
                if (passwordField.type === 'password') {
                    passwordField.type = 'text';
                    passwordIcon.classList.remove('ri-eye-off-line');
                    passwordIcon.classList.add('ri-eye-line');
                } else {
                    passwordField.type = 'password';
                    passwordIcon.classList.remove('ri-eye-line');
                    passwordIcon.classList.add('ri-eye-off-line');
                }
            });
        });
    </script>
@endsection
