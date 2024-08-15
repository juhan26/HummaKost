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

                    <div class="row mt-4">
                        @forelse ($leases as $lease)
                            <div class="col-md-6 col-lg-4 mb-12" style="">
                                <div class="card h-100 mt-8 ms-5">
                                    <img style="height: 250px;object-fit: cover" class="card-img-top mt-8"
                                        src="{{ $lease->user->photo ? asset('storage/' . $lease->user->photo) : asset('/assets/img/image_not_available.png') }}"
                                        alt="{{ $lease->user->name }}">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $lease->user->name }}</h5>
                                        <div style="min-height: 120px;max-height: 120px; overflow: auto">
                                            <p class="card-text">
                                                {{ $lease->description ? $lease->description : 'Deskripsi Kosong' }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="modal-footer d-flex justify-content-between align-items-center px-5 mb-5">
                                        <a href="{{ route('payments.show', $lease->id) }}"
                                            class="btn btn-outline-primary waves-effect">Lihat Detail</a>
                                        {{-- <div class="dropdown">
                                            <button class="btn btn-text-secondary rounded-pill text-muted border-0 p-1"
                                                type="button" id="facilityActionsDropdown{{ $facility->id }}"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="ri-more-2-line ri-20px"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end"
                                                aria-labelledby="facilityActionsDropdown{{ $facility->id }}">
                                                <li><a href="{{ route('facilities.edit', $facility->id) }}"
                                                        class="dropdown-item">Edit</a></li>
                                                <li><button type="button" class="dropdown-item" data-bs-toggle="modal"
                                                        data-bs-target="#deleteModal{{ $facility->id }}">Delete</button>
                                                </li>
                                            </ul>
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="col-md-4 mb-4">
                                <div class="card">
                                    <img src="{{ $payment->lease->user->photo ? asset('storage/' . $payment->lease->user->photo) : asset('assets/img/image_not_available.png') }}"
                                        class="card-img-top" alt="{{ $payment->lease->user->name }}">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $payment->lease->user->name }}</h5>
                                        <p class="card-text">
                                            <strong>Bulan:</strong> {{ $payment->month }}<br>
                                            <strong>Nominal:</strong> Rp. {{ number_format($payment->nominal) }}<br>
                                            <strong>Deskripsi:</strong>
                                            {{ $payment->description ?: 'Deskripsi Kosong' }}<br>
                                            <strong>Sisa Iuran:</strong>
                                            {{ $payment->lease->total_iuran == $payment->lease->total_nominal ? 'Lunas' : 'Rp. ' . number_format($payment->lease->total_iuran - $payment->lease->total_nominal) }}<br>
                                            <strong>Tanggal Dan Waktu:</strong>
                                            {{ \Carbon\Carbon::parse($payment->created_at)->locale('id')->format('l, d F Y H:i') }}
                                        </p>
                                        @hasrole('super_admin|admin')
                                            <a href="#" class="btn btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#deleteModal{{ $payment->id }}">Hapus</a>
                                        @endhasrole
                                    </div>
                                </div>

                                <!-- Delete Modal -->
                                <div class="modal fade" id="deleteModal{{ $payment->id }}" tabindex="-1"
                                    aria-labelledby="deleteModalLabel{{ $payment->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteModalLabel{{ $payment->id }}">Hapus
                                                    {{ $payment->lease->user->name }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Apakah anda yakin ingin menghapus Pembayaran ini?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Batal</button>
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
                            </div> --}}
                        @empty
                            <div class="col-12">
                                <p class="text-center">
                                    {{ request('search') ? 'Pembayaran Tidak Ditemukan' : 'Belum Ada Pembayaran' }}</p>
                            </div>
                        @endforelse
                    </div>

                    <div class="d-flex justify-content-center">
                        {{-- {{ $payments->links() }} --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
