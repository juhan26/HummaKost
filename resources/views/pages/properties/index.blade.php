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
            <h3 class="m-0 mb-3 mb-md-0"><strong>List Kontrakan</strong></h3>
            <form action="{{ route('properties.index') }}" method="GET"
                class="d-flex flex-column flex-md-row align-items-center" style="gap: 15px; position: relative; width: 70%;">
                @csrf
                <input type="text" class="form-control" name="search" id="searchInput"
                    style="border: 0; background-color: rgba(32,180,134,0.1); border-radius: 15px; height: 60px; outline: none; "
                    value="{{ request('search') }}" placeholder="Cari...">
                @hasrole('super_admin')
                    <a href="{{ route('properties.create') }}" class="btn"
                        style="width: 160px; padding: 15px 0 ;border-radius: 10px; background-color: rgba(32,180,134,1);color: white;font-size: 16px"><i
                            class="ri-add-line ri-20px"></i>Tambah</a>
                @endhasrole
                <i class="ri-search-line ri-20px" id="searchIcon"
                    style="position: absolute; top: 50%;transform: translateY(-50%); left: 3%;"></i>
            </form>
        </div>

        <style>
            .card-grid {
                display: grid;
                grid-template-columns: repeat(auto-fill, minmax(25%, 1fr));
                gap: 1rem;
                /* Jarak antar kartu */
            }

            .card {
                display: flex;
                flex-direction: column;
                height: 100%;
                /* Atur tinggi minimum untuk menyesuaikan dengan gambar */
                min-height: 400px;
            }

            .card-img-top {
                height: 100%;
                /* Atur sesuai kebutuhan */
                object-fit: cover;
            }

            .card-body {
                flex: 1;
                /* Membuat body kartu mengisi ruang yang tersisa */
            }

            .image-not-available {
                opacity: 1;
                /* Atur opacity sesuai kebutuhan */
            }
        </style>

        <div class="card-grid">
            @forelse ($properties as $property)
                <div class="card shadow-sm position-relative">
                    <div class="position-absolute top-0 end-0 p-2 d-flex gap-2" style="display: none;"
                        id="card-actions-{{ $property->id }}">
                        @hasrole('admin|super_admin')
                            <button class="btn btn-white btn-text-white shadow-sm  p-2" type="button"
                                id="propertyActionsDropdown{{ $property->id }}" data-bs-toggle="dropdown" aria-expanded="false"
                                style="border-radius: none;border:1px solid rgba(0,0,0,.1);">
                                <i class="ri-more-2-line ri-20px"></i>
                            </button>
                        @endhasrole
                        <ul class="dropdown-menu dropdown-menu-end"
                            aria-labelledby="propertyActionsDropdown{{ $property->id }}">

                            @hasrole('admin|super_admin')
                                <li>
                                    <button type="button" class="dropdown-item" data-bs-toggle="modal"
                                        data-bs-target="#imageDetail{{ $property->id }}"><i
                                            class="ri-image-add-line me-2 ri-20px text-primary"></i>Tambah Foto
                                        Detail</button>
                                </li>
                            @endhasrole

                            @hasrole('super_admin')
                                <li>
                                    <a href="{{ route('properties.edit', $property->id) }}" class="dropdown-item">
                                        <i class="ri-edit-line me-2 text-secondary"></i>
                                        Edit Kontrakan
                                    </a>
                                </li>

                                <li>
                                    <button type="button" class="dropdown-item" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal{{ $property->id }}">
                                        <i class="ri-delete-bin-line me-2 text-danger"></i>
                                        Hapus Kontrakan
                                    </button>
                                </li>
                            @endhasrole

                        </ul>

                        <!-- Delete Modal -->
                        <div class="modal fade" id="deleteModal{{ $property->id }}" tabindex="-1"
                            aria-labelledby="deleteModalLabel{{ $property->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteModalLabel{{ $property->id }}">Hapus
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
                    </div>

                    <img src="{{ $property->image ? asset('storage/' . $property->image) : asset('/assets/img/image_not_available.png') }}"
                        alt="{{ $property->name }}" class="card-img-top"
                        style="max-height: 400px; object-fit: cover; opacity: {{ $property->image ? '1' : '0.5' }};">


                    <div class="card-body">
                        <div class="d-flex justify-content-start align-items-center mb-3 mt-3">
                            <i class="ri-calendar-line ri-20px me-2" style="color: rgba(32,180,134,.7)"></i>
                            <h5 class="m-0 me-auto" style="color: rgba(32,180,134,.7);font-size:1rem;">
                                {{ \Carbon\Carbon::parse($property->created_at)->locale('id')->translatedFormat('j F Y') }}
                            </h5>
                            @if ($property->gender_target === 'male')
                                <span class="label bg-label-info" style="padding: 6px 15px; border-radius: 15px;">
                                    Laki-Laki
                                </span>
                            @else
                                <span class="label bg-label-danger" style="padding: 6px 15px; border-radius: 15px;">
                                    Perempuan
                                </span>
                            @endif
                            <span class="label bg-label-primary ms-1"
                                style="padding: 6px 15px; border-radius: 15px;">Tersedia</span>
                        </div>
                        <h4 class="card-title"><strong>{{ $property->name }}</strong></h4>
                        <p class="card-text mb-6"
                            style="height: 80px;width:70%; overflow: hidden; text-overflow: ellipsis;display: -webkit-box;-webkit-line-clamp: 4;-webkit-box-orient: vertical">
                            {{ $property->description ? $property->description : 'Deskripsi Kosong' }}</p>

                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="m-0" style="color: rgba(32,180,134,1)">Rp.
                                {{ number_format($property->rental_price, 0, ',', '.') }} / bln</h5>
                            {{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#propertyDetailModal{{ $property->id }}">
                                    Detail
                                </button> --}}
                            <a href="{{ route('properties.show', $property->id) }}" class="btn btn-primary">Detail</a>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="imageDetail{{ $property->id }}" tabindex="-1"
                    aria-labelledby="imageDetailModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title text-primary" id="propertyUpdateModalLabel">Detail Gambar
                                    {{ $property->id }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('property_images.store') }}" class="dropzone property-dropzone"
                                    data-property-id="{{ $property->id }}" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" value="{{ $property->id }}" name="property_id">
                                    <button type="submit" id="submit-all" class="btn btn-primary position-absolute"
                                        style="bottom: 10px; right: 10px;">
                                        Tambah Gambar
                                    </button>
                                </form>

                                <div class="p-4 shadow-sm mt-3" style="border-radius:15px">
                                    <div class="row g-4">
                                        @forelse ($property->property_images as $index => $image)
                                            <div class="col-12 col-md-6 col-lg-4">
                                                <img src="{{ asset('storage/' . $image->image) }}" alt="Property Image"
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
            @empty
                <div class="card-header flex-column flex-md-row w-100">
                    <div class="head-label text-center">
                        <h1 class="material-symbols-outlined mt-4" style="font-size: 3rem;color:rgba(32, 180, 134,.4);">
                            cottage</h1>
                        <p class="card-title" style="color: rgba(0,0,0,.4)">Kontrakan tidak ditemukan</p>
                    </div>
                </div>
            @endforelse
        </div>

        {{-- <div class="row">
            @forelse ($properties as $property)
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm position-relative" style="bo rder-radius: 20px; overflow: hidden;">
                        <!-- Edit and Delete Icons -->

                    </div>
                </div>

                <!-- Image Detail Modal -->

                <!-- Image Detail Modal -->
            @empty
                <div class="card-header flex-column flex-md-row w-100">
                    <div class="head-label text-center">
                        <h1 class="material-symbols-outlined mt-4" style="font-size: 3rem;color:rgba(32, 180, 134,.4);">
                            cottage</h1>
                        <p class="card-title" style="color: rgba(0,0,0,.4)">Kontrakan tidak ditemukan
                        </p>
                    </div>
                </div>
            @endforelse
        </div> --}}
        @if ($properties->hasPages())
            <div class="pagination-container mt-5">
                @php
                    $currentPage = $properties->currentPage();
                    $totalPages = $properties->lastPage();
                    $visiblePages = 1;

                    $totalData = \App\Models\Property::count();
                    $dataPerPage = $properties->perPage();
                    $startItem = ($currentPage - 1) * $dataPerPage + 1;
                    $endItem = min($currentPage * $dataPerPage, $totalData);
                @endphp
                <div class="w-100 my-3" style="color: rgba(0,0,0,.6); font-size:.75rem;">
                    Menampilkan data {{ $startItem }} - {{ $endItem }} dari {{ $totalData }}
                </div>
                <ul class="pagination d-flex justify-content-between align-items-center">
                    {{-- Previous Page Link --}}
                    <style>
                        li {
                            border-radius: none;
                        }
                    </style>
                    @if ($properties->onFirstPage())
                        <li class="page-item disabled" aria-disabled="true">
                            <span class="page-link px-6 text-white" style="background-color: #63cbab">Prev</span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link px-6 bg-primary text-white" href="{{ $properties->previousPageUrl() }}"
                                rel="prev">Prev</a>
                        </li>
                    @endif


                    <div class="d-sm-flex d-md-flex d-lg-none ">
                        <li class="page-item active" aria-disabled="true">
                            <span class="page-link">{{ $properties->currentPage() }}</span>
                        </li>
                    </div>
                    {{-- Pagination Elements (visible only on large screens and up) --}}
                    <div class="d-none d-lg-flex gx-4">
                        {{-- First Page --}}
                        @if ($currentPage > $visiblePages + 1)
                            <li class="page-item">
                                <a class="page-link" href="{{ $properties->url(1) }}">1</a>
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
                                    <a class="page-link" href="{{ $properties->url($i) }}">{{ $i }}</a>
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
                                <a class="page-link" href="{{ $properties->url($totalPages) }}">{{ $totalPages }}</a>
                            </li>
                        @endif
                    </div>

                    {{-- Next Page Link --}}
                    @if ($properties->hasMorePages())
                        <li class="page-item">
                            <a class="page-link px-6 bg-primary text-white" href="{{ $properties->nextPageUrl() }}"
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

    <script>
        Dropzone.autoDiscover = false;

        document.querySelectorAll('.property-dropzone').forEach(function(dropzoneElement) {
            const propertyId = dropzoneElement.dataset.propertyId;
            const myDropzone = new Dropzone(dropzoneElement, {
                url: "{{ route('property_images.store') }}",
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
                        formData.append("property_id", propertyId);
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
    </script>
@endsection
