@extends('app')

@section('content')
    <div class="card">
        <div class="card-datatable table-responsive pt-0">
            <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                <div class="card-header d-flex align-items-center justify-content-between border-bottom">
                    <div class="head-label text-center">
                        <h5 class="card-title mb-0">Fasilitas Yang Tersedia</h5>
                    </div>
                    <a href="#" class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal"
                        data-bs-target="#storeModal">
                        <i class="ri-add-line ri-16px me-sm-2"></i>
                        Tambah Fasilitas
                    </a>
                </div>
                <div class="d-flex align-items-end justify-content-between mb-3 card-header">
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
                        <div id="DataTables_Table_0_filter" class="dataTables_filter">
                            <label>Search:
                                <form action="{{ route('facilities.index') }}" method="GET">
                                    @csrf
                                    <input type="text" name="search" placeholder="name..."
                                        class="form-control form-control-sm" aria-controls="DataTables_Table_0"
                                        value="{{ request('search') }}">
                                </form>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="row row-cols-1 row-cols-md-3 g-6 mb-3">
                    @forelse ($facilities as $facility)
                        <div class="col-md-6 col-lg-4">
                            <div class="card h-100 ms-5">
                                <img style="height: 225px;object-fit: cover" class="card-img-top"
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
                                    <a href="#" class="btn btn-outline-primary waves-effect" data-bs-toggle="modal"
                                        data-bs-target="#showModal{{ $facility->id }}">Lihat Detail</a>
                                    <div class="dropdown">
                                        <button class="btn btn-text-secondary rounded-pill text-muted border-0 p-1"
                                            type="button" id="facilityActionsDropdown{{ $facility->id }}"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="ri-more-2-line ri-20px"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end"
                                            aria-labelledby="facilityActionsDropdown{{ $facility->id }}">
                                            <li><a href="#" class="dropdown-item" data-bs-toggle="modal"
                                                    data-bs-target="#updateModal{{ $facility->id }}">Edit</a></li>
                                            <li><button type="button" class="dropdown-item" data-bs-toggle="modal"
                                                    data-bs-target="#deleteModal{{ $facility->id }}">Delete</button></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Show Modal -->
                        <div class="modal fade" id="showModal{{ $facility->id }}" tabindex="-1"
                            aria-labelledby="showModalLabel{{ $facility->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="showModalLabel{{ $facility->id }}">
                                            {{ $facility->name }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row align-items-center">
                                            <!-- Gambar -->
                                            <style>
                                                .modal-img {
                                                    width: 300px;
                                                    /* Ubah sesuai kebutuhan */
                                                    height: 200px;
                                                    /* Ubah sesuai kebutuhan */
                                                    object-fit: cover;
                                                    /* Memastikan gambar tidak terdistorsi */
                                                }
                                            </style>
                                            <div class="col-md-4">
                                                <img class="img-fluid modal-img"
                                                    src="{{ $facility->photo ? asset('storage/' . $facility->photo) : asset('/assets/img/image_not_available.png') }}"
                                                    alt="{{ $facility->name }}">
                                            </div>
                                            <!-- Detail Fasilitas -->
                                            <div class="col-md-8">
                                                <h5>{{ $facility->name }}</h5>
                                                <h6>Description:</h6>
                                                <p>{{ $facility->description ? $facility->description : 'Deskripsi Kosong' }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Show Modal -->

                        <!-- Update Modal -->
                        <div class="modal fade" id="updateModal{{ $facility->id }}" tabindex="-1"
                            aria-labelledby="updateModalLabel{{ $facility->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="updateModalLabel{{ $facility->id }}">Edit
                                            {{ $facility->name }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('facilities.update', $facility->id) }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="mb-3">
                                                <label for="facilityName{{ $facility->id }}"
                                                    class="form-label">Name</label>
                                                <input type="text" class="form-control"
                                                    id="facilityName{{ $facility->id }}" name="name"
                                                    value="{{ $facility->name }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="facilityDescription{{ $facility->id }}"
                                                    class="form-label">Description</label>
                                                <textarea class="form-control" id="facilityDescription{{ $facility->id }}" name="description">{{ $facility->description }}</textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label for="facilityPhoto{{ $facility->id }}"
                                                    class="form-label">Photo</label>
                                                <input type="file" class="form-control"
                                                    id="facilityPhoto{{ $facility->id }}" name="photo">
                                            </div>
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Update Modal -->

                        <!-- Delete Modal -->
                        <div class="modal fade" id="deleteModal{{ $facility->id }}" tabindex="-1"
                            aria-labelledby="deleteModalLabel{{ $facility->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteModalLabel{{ $facility->id }}">Hapus
                                            {{ $facility->name }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Apakah anda yakin ingin menghapus fasilitas ini?
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
                                    {{ request('search') ? 'Fasilitas Tidak Ditemukan' : 'Belum Ada Fasilitas' }}</h5>
                            </div>
                        </div>
                    @endforelse
                </div>
                {{ $facilities->links() }}
            </div>
        </div>
    </div>

    <!-- Store Modal -->
    <div class="modal fade" id="storeModal" tabindex="-1" aria-labelledby="storeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="storeModalLabel">Tambah Fasilitas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('facilities.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="facilityName" class="form-label">Name</label>
                            <input type="text" class="form-control" id="facilityName" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="facilityDescription" class="form-label">Description</label>
                            <textarea class="form-control" id="facilityDescription" name="description"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="facilityPhoto" class="form-label">Photo</label>
                            <input type="file" class="form-control" id="facilityPhoto" name="photo">
                        </div>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Store Modal -->
@endsection
