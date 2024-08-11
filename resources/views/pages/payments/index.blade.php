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
                            @hasrole('super_admin|admin')
                                <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal"
                                    data-bs-target="#createModal">
                                    Tambah Kontrak
                                </button>
                            @endhasrole
                        </div>
                    </div>
                    {{-- Modal Store --}}
                    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="createModalLabel">Add New Payment</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('payments.store') }}" method="POST">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="createUser" class="form-label">User:</label>
                                            <select class="form-select" name="lease_id" id="createUser">
                                                @forelse ($leases as $lease)
                                                    <option value="{{ $lease->id }}"
                                                        {{ old('lease_id') == $lease->id ? 'selected' : '' }}>
                                                        {{ $lease->user->name }}
                                                    </option>
                                                @empty
                                                    <option value="">Penyewa Tidak Ditemukan</option>
                                                @endforelse
                                            </select>
                                            @error('lease_id')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="createMonth" class="form-label">Month:</label>
                                            <select class="form-select" name="month" id="createMonth">
                                                <option value="Januari" {{ old('month') == 'Januari' ? 'selected' : '' }}>
                                                    Januari</option>
                                                <option value="Februari" {{ old('month') == 'Februari' ? 'selected' : '' }}>
                                                    Februari</option>
                                                <option value="Maret" {{ old('month') == 'Maret' ? 'selected' : '' }}>Maret
                                                </option>
                                                <option value="April" {{ old('month') == 'April' ? 'selected' : '' }}>April
                                                </option>
                                                <option value="Mei" {{ old('month') == 'Mei' ? 'selected' : '' }}>Mei
                                                </option>
                                                <option value="Juni" {{ old('month') == 'Juni' ? 'selected' : '' }}>Juni
                                                </option>
                                                <option value="Juli" {{ old('month') == 'Juli' ? 'selected' : '' }}>Juli
                                                </option>
                                                <option value="Agustus" {{ old('month') == 'Agustus' ? 'selected' : '' }}>
                                                    Agustus</option>
                                                <option value="September"
                                                    {{ old('month') == 'September' ? 'selected' : '' }}>September</option>
                                                <option value="Oktober" {{ old('month') == 'Oktober' ? 'selected' : '' }}>
                                                    Oktober</option>
                                                <option value="November"
                                                    {{ old('month') == 'November' ? 'selected' : '' }}>November</option>
                                                <option value="Desember"
                                                    {{ old('month') == 'Desember' ? 'selected' : '' }}>Desember</option>
                                            </select>
                                            @error('month')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="createDescription" class="form-label">Description:</label>
                                            <textarea class="form-control" name="description" id="createDescription">{{ old('description') }}</textarea>
                                            @error('description')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Add Payment</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- Modal Store --}}
                    <table class="datatables-basic table table-bordered dataTable no-footer dtr-column mb-3"
                        id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info" style="width: 1043px;">
                        <thead>
                            <tr>
                                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                    colspan="1" style="width: 96px;"
                                    aria-label="Name: activate to sort column ascending">
                                    No</th>
                                <th class="sorting" tabindex="0" aria-controls="DataTables_ _0" rowspan="1"
                                    colspan="1" style="width: 96px;"
                                    aria-label="Name: activate to sort column ascending">
                                    Foto User</th>
                                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                    colspan="1" style="width: 98px;"
                                    aria-label="Email: activate to sort column ascending">
                                    Nama User</th>
                                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                    colspan="1" style="width: 87px;"
                                    aria-label="Date: activate to sort column ascending">
                                    Bulan</th>
                                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                    colspan="1" style="width: 87px;"
                                    aria-label="Date: activate to sort column ascending">
                                    Nominal</th>
                                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                    colspan="1" style="width: 87px;"
                                    aria-label="Date: activate to sort column ascending">
                                    Deskripsi</th>
                                <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 123px;"
                                    aria-label="Actions">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($payments as $index => $payment)
                                <tr class="odd">
                                    <th scope="row">{{ $index + 1 }}</th>
                                    <td>
                                        <img style="max-width: 100%"
                                            src="{{ $payment->lease->user->photo ? asset('storage/' . $payment->lease->user->photo) : asset('assets/img/image_not_available.png') }}"
                                            alt="">
                                    </td>
                                    <td>{{ $payment->lease->user->name }}</td>
                                    <td> {{ $payment->month }}</td>
                                    <td>Rp. {{ number_format($payment->nominal) }}</td>
                                    <td>{{ $payment->description ? $payment->description : 'Deskripsi Kosong' }}</td>
                                    @hasrole('super_admin|admin')
                                        <td>
                                            <a type="button" class="" data-bs-toggle="modal"
                                                data-bs-target="#deleteModal{{ $payment->id }}">
                                                <i style="color: red" class="menu-icon tf-icons ri-delete-bin-line"></i>
                                            </a>
                                        </td>
                                    @endhasrole
                                </tr>
                                <!-- Delete Modal -->
                                <div class="modal fade" id="deleteModal{{ $payment->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Hapus
                                                    {{ $payment->lease->user->name }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Apakah anda yakin ingin menghapus Pembayaran ini?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">batal</button>

                                                <form action="{{ route('payments.destroy', $payment->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Delete Modal -->
                            @empty
                                <tr>
                                    <th scope="row" colspan="7" class="text-center">
                                        {{ request('search') ? 'Pembayaran Tidak Ditemukan' : 'Belum Ada Pembayaran' }}
                                    </th>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
@endsection
