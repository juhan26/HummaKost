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

    <div class="container" style="min-height: 200px">
        <div class="d-flex flex-column gap-3 flex-md-row align-items-center justify-content-between mb-4"
            style="padding: 50px 0 30px 0;">
            <h3 class="m-0 mb-3 mb-md-0"><strong>Pembayaran Perbulan</strong></h3>
            <form action="{{ route('payments.index') }}" method="GET"
                class="d-flex flex-column flex-md-row align-items-center" style="gap: 15px; position: relative; width: 40%;">
                @csrf
                <input type="text" class="form-control" name="search" id="searchInput"
                    style="border: 0; background-color: rgba(32,180,134,0.1); border-radius: 15px; height: 60px; outline: none;"
                    value="{{ request('search') }}">
                {{-- <button type="button" class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal"
                    data-bs-target="#createModal"
                    style="width: 160px; padding: 15px 0; border-radius: 10px; background-color: rgba(32,180,134,1); color: white; font-size: 16px;">
                    <i class="ri-add-line ri-20px"></i>Tambah
                </button> --}}
                <i class="ri-search-line ri-20px" id="searchIcon"
                    style="position: absolute; top: 50%; transform: translateY(-50%); left: 3%;"></i>

                <div class="dropdown d-flex align-items-center w-100 justify-content-end">
                    <button type="button" class="btn btn-primary w-100  dropdown-toggle hide-arrow"
                        data-bs-toggle="dropdown" style="border-radius: 15px;padding-top:.85rem;padding-bottom:.85rem">
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
                                <label class="form-check-label custom-option-content w-100" for="acceptedFilter">
                                    <div class="dropdown-item">
                                        <input name="status[]" class="form-check-input me-2" id="acceptedFilter"
                                            type="checkbox" value="accepted" onclick="this.form.submit()"
                                            @if (in_array('accepted', $status)) checked @endif />
                                        <span>Diterima</span>
                                    </div>
                                </label>
                                <label class="form-check-label custom-option-content w-100" for="rejectedFilter">
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

    <div class="row">
        @forelse ($leases as $lease)
            <div class="col-md-6 col-lg-4 mb-12">
                <div class="card h-100" style="overflow: hidden">
                    @if ($lease->user->photo)
                        <img src="{{ asset('storage/' . $lease->user->photo) }}" class="" alt="{{ $user->name }}">
                    @elseif ($lease->user->gender === 'male')
                        <img class="" src="../../assets/img/avatars/5.png" alt="Avatar">
                    @elseif ($lease->user->gender === 'female')
                        <img class="" src="../../assets/img/avatars/10.png" alt="Avatar">
                    @endif
                    <div class="card-body">
                        <div class="d-flex justify-content-between p-0 m-1 align-items-center">
                            <h5 class="card-title m-0 ">{{ $lease->user->name }}</h5>
                            <span style="border-radius: 15px;height: 28px"
                                class="badge fs-6 {{ $lease->total_nominal >= $lease->total_iuran ? 'bg-label-success' : 'bg-label-danger' }}">
                                {{ $lease->total_nominal >= $lease->total_iuran ? 'Lunas' : 'Belum Lunas' }}
                            </span>
                        </div>
                        <div style="max-height: 120px; overflow: auto">
                            <p class="card-text">
                                @php
                                    $startPayment = '';
                                    $lastPayment = '';
                                    foreach ($lease->payments as $payment) {
                                        $startPayment = $payment->payment_month;
                                        $lastPayment = $payment->month;
                                    }
                                @endphp

                                @if ($lastPayment)
                                    Telah membayar kontrakan dari Bulan <strong>{{ $startPayment }}</strong> sampai
                                    Bulan <strong>{{ $lastPayment }}</strong>
                                @else
                                    Belum pernah melakukan pembayaran
                                @endif
                            </p>
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-end gap-2 align-items-center px-5 mb-5">
                        <div>
                            @if ($lease->total_nominal < $lease->total_iuran)
                                <button type="button" class="btn btn-primary" style="border-radius: 50px;"
                                    data-bs-toggle="modal" data-bs-target="#createModal{{ $lease->id }}">
                                    Bayar
                                </button>
                            @endif

                            <button type="button" class="btn btn-primary"
                                style="border-radius: 50px; background-color: #7B7EFF" data-bs-toggle="modal"
                                data-bs-target="#detailModal{{ $lease->id }}">
                                Detail
                            </button>
                        </div>
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
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row gy-3">
                                <div class="col-12 col-md-4">
                                    <div class="card bg-success-subtle text-center">
                                        <div class="card-body">
                                            <span>Total Yang Sudah Dibayar</span>
                                            <h5 class="text-success mt-2">
                                                {{ 'Rp. ' . number_format($lease->total_nominal) }}
                                            </h5>
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
                                            <th>Pembayaran Sampai Bulan</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0">
                                        @forelse ($lease->payments as $index => $payment)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $payment->lease->user->name }}</td>
                                                <td>{{ 'Rp. ' . number_format($payment->nominal) }}
                                                </td>
                                                <td>{{ \Carbon\Carbon::parse($payment->payment_month)->translatedFormat('F Y') }}
                                                </td>
                                                <td>{{ \Carbon\Carbon::parse($payment->month)->translatedFormat(' F Y') }}
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
                        {{-- <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div> --}}
                    </div>
                </div>
            </div>
            {{-- End of Detail Modal --}}

            {{-- Store Modal --}}
            <div class="modal fade" id="createModal{{ $lease->id }}" tabindex="-1"
                aria-labelledby="createModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="createModalLabel">Pembayaran Penyewa {{ $lease->user->name }}
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('payments.store') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="lease_id" class="form-label">Penyewa</label>
                                    <input type="hidden" class="form-control" name="lease_id"
                                        value="{{ $lease->id }}">
                                    <input type="text" class="form-control" value="{{ $lease->user->name }}"
                                        disabled>
                                    @error('lease_id')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="sisa_iuran" class="form-label">Sisa Iuran Yang Belum Dibayar</label>
                                    <input type="text" class="form-control" name="sisa_iuran"
                                        value="{{ 'Rp. ' . number_format($lease->total_iuran - $lease->total_nominal) }}"
                                        disabled>
                                    @error('sisa_iuran')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="rental_price" class="form-label">Nominal Bayar</label>
                                    <select class="form-select" name="rental_price" id="rental_price">
                                        @php
                                            $rentalPrice = $lease->properties->rental_price; // Misal: 300
                                            $remaining = $lease->total_iuran - $lease->total_nominal; // Misal: 600 - 300 = 300
                                            $index = 1;
                                        @endphp

                                        @while ($remaining > $rentalPrice * $index)
                                            <option value="{{ $rentalPrice * $index }}"
                                                {{ old('rental_price') == $rentalPrice * $index ? 'selected' : '' }}>
                                                {{ 'Rp. ' . number_format($rentalPrice * $index) }}
                                            </option>
                                            @php
                                                $index++;
                                            @endphp
                                        @endwhile

                                        @if ($remaining > 0)
                                            <option value="{{ $remaining }}"
                                                {{ old('rental_price') == $remaining ? 'selected' : '' }}>
                                                {{ 'Rp. ' . number_format($remaining) }}
                                            </option>
                                        @endif
                                    </select>

                                    @error('rental_price')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    {{-- <label for="sisa_iuran" class="form-label">Nominal Bayar</label>
                                        <input type="text" class="form-control" name="sisa_iuran"
                                            value="{{ 'Rp. ' . number_format($lease->properties->rental_price) }}"
                                            disabled>
                                        @error('sisa_iuran')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror --}}
                                </div>
                                <div class="mb-3">
                                    <label for="createDescription" class="form-label">Deskripsi
                                        <small>(Opsional)</small></label>
                                    <textarea class="form-control" name="description" id="createDescription">{{ old('description') }}</textarea>
                                    @error('description')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary">Bayar Sekarang</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Store Modal --}}
        @empty
            <div class="col-12">
                <p class="text-center">
                    {{ request('search') ? 'Pembayaran Tidak Ditemukan' : 'Belum Ada Pembayaran' }}</p>
            </div>
        @endforelse
    </div>
    @if ($leases->hasPages())
        <div class="pagination-container mt-5">
            <ul class="pagination d-flex justify-content-between align-items-center">
                {{-- Previous Page Link --}}
                <style>
                    li {
                        border-radius: none;
                    }
                </style>
                @if ($leases->onFirstPage())
                    <li class="page-item disabled" aria-disabled="true">
                        <span class="page-link px-6 text-white" style="background-color: #63cbab">Prev</span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link px-6 bg-primary text-white" href="{{ $leases->previousPageUrl() }}"
                            rel="prev">Prev</a>
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
                                <a class="page-link" href="{{ $leases->url($i) }}">{{ $i }}</a>
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
                            <a class="page-link" href="{{ $leases->url($totalPages) }}">{{ $totalPages }}</a>
                        </li>
                    @endif
                </div>

                {{-- Next Page Link --}}
                @if ($leases->hasMorePages())
                    <li class="page-item">
                        <a class="page-link px-6 bg-primary text-white" href="{{ $leases->nextPageUrl() }}"
                            rel="next">Next</a>
                    </li>
                @else
                    <li class="page-item disabled" aria-disabled="true">
                        <span class="page-link px-6 text-white" style="background-color: #63cbab">Next</span>
                    </li>
                @endif
            </ul>
            <div class="d-lg-none w-100" style="color: rgba(0,0,0,.4);font-size:.75rem;">
                Menampilkan halaman {{ $currentPage }} / {{ $totalPages }}
            </div>
        </div>
    @endif
@endsection
