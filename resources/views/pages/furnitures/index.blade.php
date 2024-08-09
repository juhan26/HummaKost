@extends('app')

@section('content')
    <div class="card">
        <div class="card-datatable table-responsive pt-0">
            <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                <div class="card-header flex-column flex-md-row border-bottom">
                    <div class="head-label text-center">
                        <h5 class="card-title mb-0">List Furniture</h5>
                    </div>
                </div>
                <div class="row mt-3yy mt-3 mb-3 d-flex">
                    <div class="col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-start">
                        <div id="DataTables_Table_0_filter" class="dataTables_filter d-flex align-items-center gap-2">
                            <label> Search: </label>
                            <form action="{{ route('furnitures.index') }}" method="GET">
                                @csrf
                                <input type="text" name="search" class="form-control form-control-sm" placeholder=""
                                    aria-controls="DataTables_Table_0" value="{{ request('search') }}">
                            </form>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 mt-5 mt-md-0 d-flex justify-content-md-end">
                        <button data-bs-toggle="modal" data-bs-target="#createModal" data-bs-whatever="@mdo"
                            class="btn btn-secondary create-new btn-primary waves-effect waves-light" tabindex="0"
                            aria-controls="DataTables_Table_0" type="button"><span><i
                                    class="ri-add-line ri-16px me-sm-2"></i> <span class="d-none d-sm-inline-block">Tambah
                                    Furniture</span></span></button>
                    </div>
                </div>
                <div class="row row-cols-1 row-cols-md-3 g-6 mb-3" style="min-height: 720px">
                    @forelse ($furnitures as $furniture)
                        <div class="col-md-6 col-lg-4" style="max-height: 361px">
                            <div class="card h-100">
                                <img style="max-height: 180px" class="card-img-top"
                                    src="{{ $furniture->photo ? asset('storage/' . $furniture->photo) : asset('/assets/img/image_not_available.png') }}"
                                    alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $furniture->name }}</h5>
                                    <p class="card-text">
                                        {{ $furniture->description ? $furniture->description : 'Deskripsi Kosong' }}
                                    </p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <a href="javascript:void(0)" class="btn btn-outline-primary waves-effect">Lihat
                                            Detail</a>
                                        <div class="dropdown">
                                            <button
                                                class="btn btn-text-secondary rounded-pill text-muted border-0 p-1 waves-effect waves-light"
                                                type="button" id="performanceOverviewDropdown" data-bs-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">
                                                <i class="ri-more-2-line ri-20px"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end"
                                                aria-labelledby="performanceOverviewDropdown">

                                                <button type="button" class="dropdown-item waves-effect"
                                                    data-bs-toggle="modal" data-bs-target="#updateModal{{ $furniture->id }}"
                                                    data-bs-whatever="@mdo">Edit</button>

                                                <form action="{{ route('furnitures.destroy', $furniture->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="dropdown-item waves-effect">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
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
                                                <form action="{{ route('furnitures.update', $furniture->id) }}"
                                                    method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <img style="max-height: 180px;border-radius: 10px"
                                                                class="mb-3"
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
                                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- Edit Modal --}}
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="card-header flex-column flex-md-row border-top border-bottom w-100">
                            <div class="head-label text-center">
                                <h5 class="card-title mb-0">
                                    {{ request('search') ? 'Data Tidak Ditemukan' : 'Tidak Ada Furniture' }}</h5>
                            </div>
                        </div>
                    @endforelse
                </div>
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
@endsection
