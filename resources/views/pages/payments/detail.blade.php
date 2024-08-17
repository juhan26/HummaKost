@extends('app')

@section('content')
    <div class="row gy-3">
        <div class="col-12 col-md-4">
            <div class="card bg-success-subtle text-center">
                <div class="card-body">
                    <span>Total Yang Sudah Dibayar</span>
                    <h5 class="text-success mt-2">{{ 'Rp. ' . number_format($lease->total_nominal) }}</h5>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="card bg-danger-subtle text-center">
                <div class="card-body">
                    <span>Total Iuran</span>
                    <h5 class="text-danger mt-2">{{ 'Rp. ' . number_format($lease->total_iuran) }}</h5>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="card bg-warning-subtle text-center">
                <div class="card-body">
                    <span>Sisa Nominal Yang Harus Dibayar</span>
                    <h5 class="text-warning mt-2">
                        {{ $lease->total_nominal === $lease->total_iuran ? 'Lunas' : 'Rp. ' . number_format($lease->total_iuran - $lease->total_nominal) }}
                    </h5>
                </div>
            </div>
        </div>
    </div>


    <div class="card">
        <div class="card-datatable table-responsive pt-0">
            <div
                class="card-header d-flex align-items-center justify-content-between border-bottom flex-column flex-md-row mb-3">
                <h5 class="card-title mb-0 text-center">Data Pembayaran Kontrakan Perbulan</h5>
                <small class="mt-2 mt-md-0">Nama: {{ $lease->user->name }}</small>
            </div>

            {{-- <div class="d-flex align-items-end justify-content-between mb-3 card-header flex-column flex-md-row">
                <form action="{{ route('payments.index') }}" method="GET" class="w-100 w-md-auto">
                    @csrf
                    <div class="input-group">
                        <input type="text" name="search" placeholder="Cari Nama..." class="form-control form-control-sm"
                            value="{{ request('search') }}">
                        <button class="btn btn-primary btn-sm" type="submit">Search</button>
                    </div>
                </form>
            </div> --}}
            <div class="table-responsive text-nowrap px-5">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Nominal</th>
                            <th>Pembayaran Untuk Bulan</th>
                            <th>Tanggal Pembayaran</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @forelse ($lease->payments as $index => $payment)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $payment->lease->user->name }}</td>
                                <td>{{ 'Rp. ' . number_format($payment->nominal) }}</td>
                                <td>{{ \Carbon\Carbon::parse($payment->month)->format('F Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($payment->created_at)->locale('id')->translatedFormat('d F Y H:i') }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Belum ada pembayaran.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="d-flex justify-content-center">
                </div>
            </div>
        </div>
    </div>
@endsection
