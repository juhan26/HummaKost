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
        <div class="d-flex flex-column flex-md-row align-items-center justify-content-between mb-4"
            style="padding: 50px 0 30px 0;">
            <h3 class="m-0 mb-3 mb-md-0"><strong>List Fasilitas</strong></h3>
            <form action="{{ route('facilities.index') }}" method="GET"
                class="d-flex flex-column flex-md-row align-items-center" style="gap: 15px; position: relative; width: 70%;">
                @csrf
                <input type="text" class="form-control" name="search" id="searchInput"
                    style="border: 0; background-color: rgba(32,180,134,0.1); border-radius: 15px; height: 60px; outline: none;"
                    value="{{ request('search') }}" placeholder="Cari...">
                @hasrole('admin|super_admin')
                    <button type="button" class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal"
                        data-bs-target="#storeModal"
                        style="width: 160px; padding: 15px 0; border-radius: 10px; background-color: rgba(32,180,134,1); color: white; font-size: 16px;">
                        <i class="ri-add-line ri-20px"></i>Tambah
                    </button>
                @endhasrole
                <i class="ri-search-line ri-20px" id="searchIcon"
                    style="position: absolute; top: 50%; transform: translateY(-50%); left: 3%;"></i>
            </form>
        </div>

        <div class="row">
            @forelse($facilities as $facility)
                <div class="col-md-6 mb-4">
                    <div class="p-4 shadow-sm d-flex justify-content-between" style="border-radius: 15px;">
                        <div class="d-flex">
                            <img src="{{ $facility->photo ? asset('storage/' . $facility->photo) : asset('/assets/img/image_not_available.png') }}"
                                alt="" class="p-2" style="max-width: 100px;object-fit:cover; border-radius:15px">
                            <div class="py-4">
                                <h4 class="text-primary m-0"
                                    style="max-width: 300px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                    <strong>{{ $facility->name }}</strong>
                                </h4>
                                <div>
                                    <p class="m-0">
                                        {{ $facility->description ? $facility->description : 'Deskripsi Kosong' }}</p>
                                </div>
                            </div>
                        </div>
                        <div
                            class="dropdown d-flex flex-column {{ Auth::user()->hasRole('super_admin') || Auth::user()->hasRole('admin') ? 'justify-content-between' : 'justify-content-end' }} align-items-end">
                            @hasrole('admin|super_admin')
                                <button class="btn btn-text-secondary rounded-pill text-muted border-0 p-1" type="button"
                                    id="facilityActionsDropdown{{ $facility->id }}" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class="ri-more-2-line ri-20px"></i>
                                </button>
                            @endhasrole

                            <ul class="dropdown-menu dropdown-menu-end"
                                aria-labelledby="facilityActionsDropdown{{ $facility->id }}">

                                <li>
                                    <button type="button" class="dropdown-item" data-bs-toggle="modal"
                                        data-bs-target="#imageDetail{{ $facility->id }}"><i
                                            class="ri-image-line me-2 ri-20px"></i>Gambar Detail</button>
                                </li>

                                <li>
                                    <button type="button" class="dropdown-item" data-bs-toggle="modal"
                                        data-bs-target="#updateModal{{ $facility->id }}"><i
                                            class="ri-edit-line me-2 ri-20px"></i>Edit</button>
                                </li>

                                <li>
                                    <button type="button" class="dropdown-item" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal{{ $facility->id }}"><i
                                            class="ri-delete-bin-line me-2 ri-20px"></i>Hapus</button>
                                </li>

                            </ul>
                            <button type="button" class="btn btn-primary" style="border-radius: 50px"
                                data-bs-toggle="modal" data-bs-target="#detailModal{{ $facility->id }}">Detail</button>
                        </div>
                    </div>
                </div>

                <!-- Detail Modal -->
                <div class="modal fade" id="detailModal{{ $facility->id }}" tabindex="-1"
                    aria-labelledby="detailModalLabel aria-hidden="true">
                    <div class="modal-dialog modal-md">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title text-primary" id="facilityUpdateModalLabel">Detail
                                    {{ $facility->id }}
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="d-flex">
                                    <div class="p-4">
                                        <img src="{{ $facility->photo ? asset('storage/' . $facility->photo) : asset('/assets/img/image_not_available.png') }}"
                                            alt="{{ $facility->name }}"
                                            style="max-width: 200px;max-height:200px;object-fit:cover;border-radius:15px">
                                    </div>
                                    <div class="p-4 w-100">
                                        <h3 class="mb-2" style="color: rgba(32,180,134,1)">{{ $facility->name }}</h3>
                                        <div style="background-color: rgba(32,180,134,0.1); border-radius:15px;min-height: 85px"
                                            class="w-100 p-3">
                                            <p class="m-0" style="color: black">
                                                {{ $facility->description ? $facility->description : 'Deskripsi Kosong' }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <span class="p-4"><strong>Foto Detail</strong></span>
                                <div class="p-4 shadow-sm mt-3" style="border-radius:15px">
                                    <div class="row g-4">
                                        @forelse ($facility->facility_images as $index => $image)
                                            <div class="col-12 col-md-6 col-lg-4">
                                                <img src="{{ asset('storage/' . $image->image) }}" alt="Facility Image"
                                                    class="img-fluid rounded"
                                                    style="max-height: 250px; object-fit: cover;">
                                            </div>
                                        @empty
                                            <div class="col-12">
                                                <p class="text-center m-0 py-3"><strong>Tidak ada gambar detail.</strong>
                                                </p>
                                            </div>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Detail Modal -->

                <!-- Image Detail Modal -->
                <div class="modal fade" id="imageDetail{{ $facility->id }}" tabindex="-1"
                    aria-labelledby="imageDetailModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title text-primary" id="facilityUpdateModalLabel">Detail Gambar
                                    {{ $facility->id }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('facility_images.store') }}" class="dropzone facility-dropzone"
                                    data-facility-id="{{ $facility->id }}" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" value="{{ $facility->id }}" name="facility_id">
                                    <button type="submit" id="submit-all" class="btn btn-primary position-absolute"
                                        style="bottom: 10px; right: 10px;">
                                        Tambah Gambar
                                    </button>
                                </form>

                                <div class="p-4 shadow-sm mt-3" style="border-radius:15px">
                                    <div class="row g-4">
                                        @forelse ($facility->facility_images as $index => $image)
                                            <div class="col-12 col-md-6 col-lg-4">
                                                <img src="{{ asset('storage/' . $image->image) }}" alt="Facility Image"
                                                    class="img-fluid rounded"
                                                    style="max-height: 250px; object-fit: cover;">
                                            </div>
                                        @empty
                                            <div class="col-12">
                                                <p class="text-center m-0 py-3"><strong>Tidak ada gambar detail.</strong>
                                                </p>
                                            </div>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Image Detail Modal -->

                <!-- Update Modal -->
                <div class="modal fade" id="updateModal{{ $facility->id }}" tabindex="-1"
                    aria-labelledby="updateModalLabel aria-hidden="true">
                    <div class="modal-dialog modal-md">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title text-primary" id="facilityUpdateModalLabel">Edit
                                    {{ $facility->id }}
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('facilities.update', $facility->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <div class="d-flex justify-content-center">
                                            <img src="{{ $facility->photo ? asset('storage/' . $facility->photo) : asset('/assets/img/image_not_available.png') }}"
                                                id="imgPreviewEdit" alt="{{ $facility->name }}"
                                                style="max-width:250px;max-height:250px;object-fit:cover">
                                        </div>
                                        <label for="facilityPhoto" class="form-label">Foto Fasilitas</label>
                                        <input type="file" id="imageInputEdit" class="form-control" name="photo">
                                    </div>
                                    <div class="mb-3">
                                        <label for="facilityName" class="form-label">Nama Fasilitas</label>
                                        <input type="text" class="form-control" id="facilityName" name="name"
                                            value="{{ $facility->name }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="facilityDescription" class="form-label">Deskripsi</label>
                                        <textarea class="form-control" id="facilityDescription" name="description">{{ $facility->desciption }}</textarea>
                                    </div>
                                    <div class="d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary"><i
                                                class="ri-save-line ri-20px"></i>Simpan</button>
                                    </div>
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
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
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
                            {{ request('search') ? 'Fasilitas Yang Anda Cari Tidak Ditemukan' : 'Belum Ada Fasilitas' }}
                        </h5>
                    </div>
                </div>
            @endforelse
        </div>
        @if ($facilities->hasPages())
            <div class="pagination-container mt-5">
                <ul class="pagination d-flex justify-content-between align-items-center">
                    {{-- Previous Page Link --}}
                    <style>
                        li {
                            border-radius: none;
                        }
                    </style>
                    @if ($facilities->onFirstPage())
                        <li class="page-item disabled" aria-disabled="true">
                            <span class="page-link px-6 text-white" style="background-color: #63cbab">Prev</span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link px-6 bg-primary text-white" href="{{ $facilities->previousPageUrl() }}"
                                rel="prev">Prev</a>
                        </li>
                    @endif

                    @php
                        $currentPage = $facilities->currentPage();
                        $totalPages = $facilities->lastPage();
                        $visiblePages = 1; // Maximum number of page numbers to display
                    @endphp
                    <div class="d-sm-flex d-md-flex d-lg-none ">
                        <li class="page-item active" aria-disabled="true">
                            <span class="page-link">{{ $facilities->currentPage() }}</span>
                        </li>
                    </div>
                    {{-- Pagination Elements (visible only on large screens and up) --}}
                    <div class="d-none d-lg-flex gx-4">
                        {{-- First Page --}}
                        @if ($currentPage > $visiblePages + 1)
                            <li class="page-item">
                                <a class="page-link" href="{{ $facilities->url(1) }}">1</a>
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
                                    <a class="page-link" href="{{ $facilities->url($i) }}">{{ $i }}</a>
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
                                <a class="page-link" href="{{ $facilities->url($totalPages) }}">{{ $totalPages }}</a>
                            </li>
                        @endif
                    </div>

                    {{-- Next Page Link --}}
                    @if ($facilities->hasMorePages())
                        <li class="page-item">
                            <a class="page-link px-6 bg-primary text-white" href="{{ $facilities->nextPageUrl() }}"
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
    </div>

    <!-- Store Modal -->
    <div class="modal fade" id="storeModal" tabindex="-1" aria-labelledby="storeModalLabel aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-primary" id="facilityStoreModalLabel">Tambah Fasilitas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('facilities.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <div class="d-flex justify-content-center">
                                <img src="" id="imgPreview" alt=""
                                    style="max-width:250px;max-height:250px;object-fit:cover">
                            </div>
                            <label for="facilityPhoto" class="form-label">Foto Fasilitas</label>
                            <input type="file" id="imageInput" class="form-control" name="photo">
                        </div>
                        <div class="mb-3">
                            <label for="facilityName" class="form-label">Nama Fasilitas</label>
                            <input type="text" class="form-control" id="facilityName" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="facilityDescription" class="form-label">Deskripsi <small>(max: 50
                                    karakter)</small></label>
                            <textarea class="form-control" id="facilityDescription" name="description"></textarea>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary"><i
                                    class="ri-add-line ri-20px"></i>Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Store Modal -->

    <script>
        Dropzone.autoDiscover = false;

        document.querySelectorAll('.facility-dropzone').forEach(function(dropzoneElement) {
            const facilityId = dropzoneElement.dataset.facilityId;
            const myDropzone = new Dropzone(dropzoneElement, {
                url: "{{ route('facility_images.store') }}",
                paramName: "images",
                maxFilesize: 2,
                acceptedFiles: ".jpeg,.jpg,.png",
                autoProcessQueue: false,
                addRemoveLinks: true,
                dictDefaultMessage: "Letakkan file di sini atau klik untuk mengunggah",
                parallelUploads: 6,
                init: function() {
                    const submitButton = dropzoneElement.querySelector(".btn-primary");
                    const dropzoneInstance = this;

                    submitButton.addEventListener("click", function(e) {
                        e.preventDefault();
                        e.stopPropagation();

                        if (dropzoneInstance.getQueuedFiles().length > 0) {
                            dropzoneInstance.processQueue();
                        } else {
                            dropzoneInstance.submitForm();
                        }
                    });

                    this.on("sending", function(file, xhr, formData) {
                        formData.append("_token", "{{ csrf_token() }}");
                        formData.append("facility_id", facilityId);
                    });

                    this.on("success", function(file, response) {
                        console.log('Upload berhasil:', response);
                    });

                    this.on("queuecomplete", function() {
                        dropzoneInstance.submitForm();
                    });
                },
                submitForm: function() {
                    dropzoneElement.submit();
                }
            });
        });



        document.getElementById('imageInput').addEventListener('change', function(e) {
            const file = e.target.files[0];
            console.log(file);
            const reader = new FileReader();

            reader.onload = (e) => {
                const imagePreview = document.getElementById('imgPreview');
                imagePreview.src = e.target.result;
                imagePreview.style.display = 'block';
            }

            if (file) {
                reader.readAsDataURL(file);
            }
        })

        document.getElementById('imageInputEdit').addEventListener('change', function(e) {
            const file = e.target.files[0];
            console.log(file);
            const reader = new FileReader();

            reader.onload = (e) => {
                const imagePreview = document.getElementById('imgPreviewEdit');
                imagePreview.src = e.target.result;
                imagePreview.style.display = 'block';
            }

            if (file) {
                reader.readAsDataURL(file);
            }
        })
    </script>
@endsection
