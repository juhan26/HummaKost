@extends('app')

@section('content')
    <div class="card">
        <div class="card-datatable table-responsive pt-0">
            <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                <div class="card-header d-flex align-items-center justify-content-between flex-md-row border-bottom">
                    <div class="head-label text-center">
                        <h5 class="card-title mb-0">List Furniture</h5>
                    </div>
                    <button data-bs-toggle="modal" data-bs-target="#createModal" data-bs-whatever="@mdo"
                        class="btn btn-secondary create-new btn-primary waves-effect waves-light" tabindex="0"
                        aria-controls="DataTables_Table_0" type="button"><span><i class="ri-add-line ri-16px me-sm-2"></i>
                            <span class="d-none d-sm-inline-block">Tambah
                                Furniture</span></span></button>
                    {{-- <div class="dt-action-buttons text-end pt-3 pt-md-0">
                        <div class="dt-buttons btn-group flex-wrap">
                            <div class="btn-group"><button
                                    class="btn btn-secondary buttons-collection dropdown-toggle btn-label-primary me-4 waves-effect waves-light"
                                    tabindex="0" aria-controls="DataTables_Table_0" type="button" aria-haspopup="dialog"
                                    aria-expanded="false"><span><i class="ri-external-link-line me-sm-1"></i> <span
                                            class="d-none d-sm-inline-block">Export</span></span></button></div> <button
                                class="btn btn-secondary create-new btn-primary waves-effect waves-light" tabindex="0"
                                aria-controls="DataTables_Table_0" type="button"><span><i
                                        class="ri-add-line ri-16px me-sm-2"></i> <span class="d-none d-sm-inline-block">Add
                                        New Record</span></span></button>
                        </div>
                    </div> --}}
                </div>
                <div class="row mt-3">
                    <div class="row d-flex align-items-end justify-content-start mb-3">
                        @if ($furnitures->lastPage() != 1)
                            <div class="col-sm-12 col-md-6 mt-5 mt-md-0">
                                <strong>Hasil Halaman: {{ $furnitures->currentPage() }}</strong>
                            </div>
                        @endif
                        <div
                            class="col-sm-12 col-md-6 d-flex {{ $furnitures->lastPage() != 1 ? 'justify-content-end' : 'justify-content-start' }} gap-3">
                            @if ($furnitures->lastPage() != 1)
                                <label>Pilih Halaman: <select name="page" aria-controls="DataTables_Table_0"
                                        class="form-select form-select-sm" id="pageSelect">
                                        @for ($i = 1; $i <= $furnitures->lastPage(); $i++)
                                            <option value="{{ request()->url() }}?page={{ $i }}"
                                                {{ $furnitures->currentPage() == $i ? 'selected' : '' }}>
                                                {{ $i }}
                                            </option>
                                        @endfor
                                    </select></label>
                            @endif
                            <div id="DataTables_Table_0_filter" class="dataTables_filter"><label>Search:<form
                                        action="{{ route('furnitures.index') }}" method="GET">
                                        @csrf
                                        <input type="text" name="search" placeholder="name..."
                                            class="form-control form-control-sm" placeholder=""
                                            aria-controls="DataTables_Table_0" value="{{ request('search') }}">
                                    </form></label></div>
                        </div>
                    </div>
                    {{-- <div id="DataTables_Table_0_filter" class="dataTables_filter mb-3"><label>Search:<form
                                action="{{ route('furnitures.index') }}" method="GET">
                                @csrf
                                <input type="text" name="search" placeholder="name..."
                                    class="form-control form-control-sm" placeholder="" aria-controls="DataTables_Table_0"
                                    value="{{ request('search') }}">
                            </form></label></div>
                </div> --}}
                    <table class="table table-hover mt-3 mb-3">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Foto Furniture</th>
                                <th>Nama Furnitur</th>
                                <th>Deskripsi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($furnitures as $index=>$furniture)
                                <tr class="odd">
                                    <th scope="row">{{ $index + 1 }}</th>
                                    <td>
                                        <img style="max-width: 100%"
                                            src="{{ $furniture->photo ? asset('storage/' . $furniture->photo) : asset('/assets/img/image_not_available.png') }}"
                                            alt="">
                                    </td>
                                    <td>{{ $furniture->name }}</td>
                                    <td>{{ $furniture->description ? $furniture->description : 'Deskripsi Kosong' }}</td>
                                    <td>
                                        <a type="button" class="" data-bs-toggle="modal"
                                            data-bs-target="#updateModal{{ $furniture->id }}" data-bs-whatever="@mdo"><i
                                                style="color: #e3a805" class="menu-icon tf-icons ri-edit-2-line"></i></a>

                                        <a type="button" class="" data-bs-toggle="modal"
                                            data-bs-target="#deleteModal{{ $furniture->id }}">
                                            <i style="color: red" class="menu-icon tf-icons ri-delete-bin-line"></i>
                                        </a>
                                    </td>
                                </tr>
                                {{-- Edit Modal --}}
                                <div class="modal fade" id="updateModal{{ $furniture->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit
                                                    Furniture</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('furnitures.update', $furniture->id) }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <img style="max-height: 180px;border-radius: 10px" class="mb-3"
                                                            src="{{ $furniture->photo ? asset('storage/' . $furniture->photo) : asset('/assets/img/image_not_available.png') }}"
                                                            alt="">
                                                        <input class="form-control" type="file" id="formFile"
                                                            name="photo">
                                                    </div>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="basic-addon1">Nama
                                                            Furniture</span>
                                                        <input type="text" class="form-control" aria-label="Username"
                                                            aria-describedby="basic-addon1" name="name"
                                                            value="{{ $furniture->name }}">
                                                    </div>
                                                    <div class="form-floating">
                                                        <textarea class="form-control" id="floatingTextarea2" style="height: 100px" name="description">{{ $furniture->description }}</textarea>
                                                        <label for="floatingTextarea2">Deskripsi</label>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-warning">Simpan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                {{-- Edit Modal --}}

                                <!-- Delete Modal -->
                                <div class="modal fade" id="deleteModal{{ $furniture->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Hapus
                                                    {{ $furniture->name }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Apakah anda yakin ingin menghapus furnitur ini?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">batal</button>

                                                <form action="{{ route('furnitures.destroy', $furniture->id) }}"
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
                                    <th scope="row" colspan="5" class="text-center">
                                        {{ request('search') ? 'Furniture Tidak Ditemukan' : 'Belum Ada Furniture' }}
                                    </th>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $furnitures->links() }}
                </div>
            </div>
        </div>
        <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Furniture Baru</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('furnitures.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="photo" class="form-label">Foto Furniture</label>
                                <input class="form-control" type="file" id="formFile" name="photo">
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">Nama Furniture</span>
                                <input type="text" class="form-control" aria-label="Username"
                                    aria-describedby="basic-addon1" name="name" value="{{ old('name') }}">
                            </div>
                            <div class="form-floating">
                                <textarea class="form-control" id="floatingTextarea2" style="height: 100px" name="description">{{ old('description') }}</textarea>
                                <label for="floatingTextarea2">Deskripsi</label>
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

        <script>
            document.getElementById('pageSelect').addEventListener('change', function() {
                var page = this.value;
                window.location.href = page;
            });
        </script>

    @endsection
