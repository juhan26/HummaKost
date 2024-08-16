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
                            <div class="col-md-6 col-lg-4 mb-12">
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
                                        <button type="button" class="btn btn-outline-primary waves-effect"
                                            data-bs-toggle="modal" data-bs-target="#detailModal{{ $lease->id }}">
                                            Lihat Detail
                                        </button>
                                    </div>
                                </div>
                            </div>

                            {{-- Detail Modal --}}
                            <div class="modal fade" id="detailModal{{ $lease->id }}" tabindex="-1"
                                aria-labelledby="detailModalLabel{{ $lease->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="detailModalLabel{{ $lease->id }}">Detail
                                                Pembayaran</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row gy-3">
                                                <div class="col-12 col-md-4">
                                                    <div class="card bg-success-subtle text-center">
                                                        <div class="card-body">
                                                            <span>Total Yang Sudah Dibayar</span>
                                                            <h5 class="text-success mt-2">
                                                                {{ 'Rp. ' . number_format($lease->total_nominal) }}</h5>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-4">
                                                    <div class="card bg-danger-subtle text-center">
                                                        <div class="card-body">
                                                            <span>Total Iuran</span>
                                                            <h5 class="text-danger mt-2">
                                                                {{ 'Rp. ' . number_format($lease->total_iuran) }}</h5>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-4">
                                                    <div class="card bg-warning-subtle text-center">
                                                        <div class="card-body">
                                                            <span>Sisa Tagihan
                                                            </span>
                                                            <h5 class="text-warning mt-2">
                                                                {{ $lease->total_nominal === $lease->total_iuran ? 'Lunas' : 'Rp. ' . number_format($lease->total_iuran - $lease->total_nominal) }}
                                                            </h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="table-responsive text-nowrap mt-4">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Nama</th>
                                                            <th>Nominal</th>
                                                            <th>Pembayaran Untuk Bulan</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="table-border-bottom-0">
                                                        @forelse ($lease->payments as $index => $payment)
                                                            <tr>
                                                                <td>{{ $index + 1 }}</td>
                                                                <td>{{ $payment->lease->user->name }}</td>
                                                                <td>{{ 'Rp. ' . number_format($payment->nominal) }}</td>
                                                                <td>{{ \Carbon\Carbon::parse($payment->month)->format('F Y') }}
                                                                </td>
                                                            </tr>
                                                        @empty
                                                            <tr>
                                                                <td colspan="6" class="text-center">Belum ada
                                                                    pembayaran.</td>
                                                            </tr>
                                                        @endforelse
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- End of Detail Modal --}}

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
