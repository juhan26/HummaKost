@extends('app')

@section('content')
    <div class="card">
        <div class="card-datatable table-responsive pt-0">
            <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                <div class="card-header d-flex align-items-center justify-content-between border-bottom">
                    <div class="head-label text-center">
                        <h5 class="card-title mb-0">Fasilitas Yang Tersedia</h5>
                    </div>
                    <a href="{{ route('facilities.create') }}" class="btn btn-primary waves-effect waves-light">
                        <i class="ri-add-line ri-16px me-sm-2"></i>
                        Tambah Fasilitas
                    </a>
                </div>
                <div class="row mt-3">
                    <div class="d-flex align-items-end justify-content-between mb-3">
                        @if ($facilities->lastPage() != 1)
                            <div class="col-sm-12 col-md-6 mt-5 mt-md-0">
                                <strong>Hasil Halaman: {{ $facilities->currentPage() }}</strong>
                            </div>
                        @endif
                        <div
                            class="col-sm-12 col-md-6 d-flex {{ $facilities->lastPage() != 1 ? 'justify-content-end' : 'justify-content-start' }} gap-3">
                            @if ($facilities->lastPage() != 1)
                                <label>Pilih Halaman: <select name="page" aria-controls="DataTables_Table_0"
                                        class="form-select form-select-sm" id="pageSelect">
                                        @for ($i = 1; $i <= $facilities->lastPage(); $i++)
                                            <option value="{{ request()->url() }}?page={{ $i }}"
                                                {{ $facilities->currentPage() == $i ? 'selected' : '' }}>
                                                {{ $i }}
                                            </option>
                                        @endfor
                                    </select></label>
                            @endif
                            <div id="DataTables_Table_0_filter" class="dataTables_filter"><label>Search: <form
                                        action="{{ route('facilities.index') }}" method="GET">
                                        @csrf
                                        <input type="text" name="search" placeholder="name..."
                                            class="form-control form-control-sm" placeholder=""
                                            aria-controls="DataTables_Table_0" value="{{ request('search') }}">
                                    </form></label></div>
                        </div>
                    </div>
                </div>
                <div class="row row-cols-1 row-cols-md-3 g-6 mb-3">
                    @forelse ($facilities as $facility)
                        <div class="col-md-6 col-lg-4 mb-12" style="">
                            <div class="card h-100 mt-8 ms-5">
                                <img style="height: 250px;object-fit: cover" class="card-img-top mt-8"
                                    src="{{ $facility->photo ? asset('storage/' . $facility->photo) : asset('/assets/img/image_not_available.png') }}"
                                    alt="{{ $facility->name }}">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $facility->name }}</h5>
                                    <div style="min-height: 120px;max-height: 120px; overflow: auto">
                                        <p class="card-text">
                                            {{ $facility->description ? $facility->description : 'Deskripsi Kosong' }}
                                        </p>
                                    </div>
                                </div>

                                <div class="modal-footer d-flex justify-content-between align-items-center px-5 mb-5">
                                    <a href="{{ route('facilities.show', $facility->id) }}"
                                        class="btn btn-outline-primary waves-effect">Lihat Detail</a>
                                    <div class="dropdown">
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
                                                    data-bs-target="#deleteModal{{ $facility->id }}">Delete</button></li>
                                        </ul>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <!-- Delete Modal -->
                        <div class="modal fade" id="deleteModal{{ $facility->id }}" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Hapus
                                            {{ $facility->name }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Apakah anda yakin ingin menghapus fasillitas ini?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Batal</button>

                                        <form action="{{ route('facilities.destroy', $facility->id) }}" method="POST">
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
                        <div class="card-header flex-column flex-md-row border-top border-bottom w-100">
                            <div class="head-label text-center">
                                <h5 class="card-title mb-0">
                                    {{ request('search') ? 'Kontrakan Tidak Ditemukan' : 'Belum Ada Kontrakan' }}</h5>
                            </div>
                        </div>
                    @endforelse
                </div>
                {{ $facilities->links() }}
            </div>
        </div>
    </div>
@endsection
