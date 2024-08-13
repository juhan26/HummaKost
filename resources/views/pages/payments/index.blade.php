@extends('app')

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-content">
                <div class="card-header">
                    <div class="row d-flex align-items-center">
                        <div class="col-12 col-lg-10">
                            <h3 class="card-title">Pembayaran Perbulan</h3>
                            <small>Manajemen dan review Pembayaran perbulan</small>
                        </div>
                        <div class="col-12 col-lg-2 text-lg-end mt-3 mt-lg-0">
                            @hasrole('super_admin|admin')
                                <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal"
                                    data-bs-target="#createModal">
                                    Tambah Pembayaran
                                </button>
                            @endhasrole
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-12 col-md-6">
                            <form action="" method="GET">
                                <div class="input-group">
                                    <input type="search" class="form-control" name="search"
                                        placeholder="Cari Pembayaran..." value="{{ request('search') }}">
                                </div>
                            </form>
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
                    <div class="table-responsive">
                        <table class="table table-hover mt-3 mb-3">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Foto User</th>
                                    <th>Nama User</th>
                                    <th>Bulan</th>
                                    <th>Nominal</th>
                                    <th>Deskripsi</th>
                                    <th>Sisa Iuran</th>
                                    <th>Tanggal Dan Waktu</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($payments as $index => $payment)
                                <tr>
                                    <th scope="row">{{ $index + 1 }}</th>
                                    <td>
                                        <img src="{{ $payment->lease->user->photo ? asset('storage/' . $payment->lease->user->photo) : asset('assets/img/image_not_available.png') }}"
                                            alt="{{ $payment->lease->user->name }}" class="img-fluid">
                                    </td>
                                    <td>{{ $payment->lease->user->name }}</td>
                                    <td>{{ $payment->month }}</td>
                                    <td>Rp. {{ number_format($payment->nominal) }}</td>
                                    <td>{{ $payment->description ?: 'Deskripsi Kosong' }}</td>
                                    <td>{{ $payment->lease->total_iuran == $payment->lease->total_nominal ? 'Lunas' : 'Rp. ' . number_format($payment->lease->total_iuran - $payment->lease->total_nominal) }}
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($payment->created_at)->locale('id')->format('l, d F Y H:i') }}</td>
                                    @hasrole('super_admin|admin')
                                    <td>
                                        <a type="button" class="" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $payment->id }}">
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
                                                <h5 class="modal-title" id="exampleModalLabel">Hapus {{ $payment->lease->user->name }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Apakah anda yakin ingin menghapus Pembayaran ini?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                <form action="{{ route('payments.destroy', $payment->id) }}" method="POST">
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
                                    <td colspan="9" class="text-center">
                                        {{ request('search') ? 'Pembayaran Tidak Ditemukan' : 'Belum Ada Pembayaran' }}
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>                    
                    <div class="d-flex justify-content-center">
                        {{ $payments->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
