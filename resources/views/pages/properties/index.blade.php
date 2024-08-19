@extends('app')

@section('content')
    <div class="col-12 col-lg-12" style="min-height: 200px">
        <div class="d-flex align-items-center justify-content-between" style="padding: 50px 0 30px 0;">
            <h3 class="m-0"><strong>List Kontrakan</strong></h3>
            <div class="d-flex" style="gap: 30px;position: relative">
                <input type="text"
                    style="border: 0;background-color: rgba(32,180,134,0.1);border-radius: 15px;height: 60px; width: 584px;outline:none;padding: 0 50px 0 50px">
                <button type="button" class="btn"
                    style="width: 160px; border-radius: 15px; background-color: rgba(32,180,134,1);color: white;font-size: 16px"><i
                        class="ri-add-line ri-20px"></i>Tambah</button>
                <i class="ri-search-line ri-20px"
                    style="position: absolute;top: 50%;transform: translateY(-50%);left: 2%"></i>
            </div>
        </div>

        <div class="shadow-sm" style="width: 550px; height: 600px; border-radius: 30px; overflow: hidden;">
            <img src="{{ asset('/images/172403214214.jpg') }}" alt="" style="width: 100%;height: 350px;">
            <div class="d-flex justify-content-between px-4 pt-4 pb-2 align-items-center" style="">
                <h5 class="m-0" style="color: rgba(32,180,134,1)"><i class="ri-calendar-line ri-30px me-2"></i>27 Mei
                    2020</h5>
                <span class="badge rounded-pill bg-subtle"
                    style="background-color: rgba(32,180,134,0.2);padding: 8px 23px 8px 23px;color: rgba(32,180,134,0.7) ">Tersedia</span>
            </div>

            <div class="px-4">
                <h4 class="m-0"><strong>Las Vegas</strong></h4>
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Perferendis hic veniam, deleniti obcaecati
                    praesentium a, ratione iste consectetur vero totam repellendus earum fuga quisquam voluptatibus, minima
                    non dolorum.</p>
            </div>

            <div class="d-flex justify-content-between px-4">
                <h4 class="" style="color: rgba(32,180,134,1)">Rp. 300.000 / bln</h4>
                <button class="btn text-white"
                    style="background-color: rgba(32,180,134,1);width: 100px;height: 40px;border-radius:15px;">Detail</button>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-datatable table-responsive pt-0">
            <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                <div class="card-header d-flex align-items-center justify-content-between border-bottom">
                    <div class="head-label text-center">
                        <h5 class="card-title mb-0">List Kontrakan</h5>
                    </div>
                    <a href="{{ route('properties.create') }}" class="btn btn-primary waves-effect waves-light">
                        <i class="ri-add-line ri-16px me-sm-2"></i>
                        Tambah Kontrakan
                    </a>
                </div>
                <div class="mt-3">
                    <div class="card-header d-flex align-items-end justify-content-between mb-3">
                        @if ($properties->lastPage() != 1)
                            <div class="col-sm-12 col-md-6 mt-5 mt-md-0">
                                <strong>Hasil Halaman: {{ $properties->currentPage() }}</strong>
                            </div>
                        @endif
                        <div
                            class="col-sm-12 col-md-6 d-flex {{ $properties->lastPage() != 1 ? 'justify-content-end' : 'justify-content-start' }} gap-3">
                            @if ($properties->lastPage() != 1)
                                <label>Pilih Halaman: <select name="page" aria-controls="DataTables_Table_0"
                                        class="form-select form-select-sm" id="pageSelect">
                                        @for ($i = 1; $i <= $properties->lastPage(); $i++)
                                            <option value="{{ request()->url() }}?page={{ $i }}"
                                                {{ $properties->currentPage() == $i ? 'selected' : '' }}>
                                                {{ $i }}
                                            </option>
                                        @endfor
                                    </select></label>
                            @endif
                            <div id="DataTables_Table_0_filter" class="dataTables_filter"><label>Search:<form
                                        action="{{ route('properties.index') }}" method="GET">
                                        @csrf
                                        <input type="text" name="search" placeholder="name..."
                                            class="form-control form-control-sm" placeholder=""
                                            aria-controls="DataTables_Table_0" value="{{ request('search') }}">
                                    </form></label></div>
                        </div>
                    </div>
                </div>
                <div class="row row-cols-1 row-cols-md-3 g-6 mb-3">
                    @forelse ($properties as $property)
                        <div class="col-md-6 col-lg-4 mb-12" style="">
                            <div class="card h-100 ms-5">
                                <img style="height: 250px;object-fit: cover" class="card-img-top"
                                    src="{{ $property->image ? asset('storage/' . $property->image) : asset('/assets/img/image_not_available.png') }}"
                                    alt="{{ $property->name }}">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $property->name }}</h5>
                                    <div style="min-height: 120px;max-height: 120px; overflow: auto">
                                        <p class="card-text">
                                            {{ $property->description ? $property->description : 'Deskripsi Kosong' }}
                                        </p>
                                    </div>
                                </div>
                                <div class="modal-footer d-flex justify-content-between align-items-center px-5 mb-5">
                                    <a href="{{ route('properties.show', $property->id) }}"
                                        class="btn btn-outline-primary waves-effect">Lihat Detail</a>
                                    <div class="dropdown">
                                        <button class="btn btn-text-secondary rounded-pill text-muted border-0 p-1"
                                            type="button" id="propertyActionsDropdown{{ $property->id }}"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="ri-more-2-line ri-20px"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end"
                                            aria-labelledby="propertyActionsDropdown{{ $property->id }}">
                                            <li><a href="{{ route('properties.edit', $property->id) }}"
                                                    class="dropdown-item">Edit</a></li>
                                            <li><button type="button" class="dropdown-item" data-bs-toggle="modal"
                                                    data-bs-target="#deleteModal{{ $property->id }}">Delete</button></li>
                                        </ul>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <!-- Delete Modal -->
                        <div class="modal fade" id="deleteModal{{ $property->id }}" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Hapus
                                            {{ $property->name }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Apakah anda yakin ingin menghapus kontrakan ini?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Batal</button>

                                        <form action="{{ route('properties.destroy', $property->id) }}" method="POST">
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
                {{ $properties->links() }}
            </div>
        </div>
    </div>
@endsection
