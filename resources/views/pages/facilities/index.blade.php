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
                <button type="button" class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal"
                    data-bs-target="#storeModal"
                    style="width: 160px; padding: 15px 0; border-radius: 10px; background-color: rgba(32,180,134,1); color: white; font-size: 16px;">
                    <i class="ri-add-line ri-20px"></i>Tambah
                </button>
                <i class="ri-search-line ri-20px" id="searchIcon"
                    style="position: absolute; top: 50%; transform: translateY(-50%); left: 3%;"></i>
            </form>
        </div>

        <div class="row">
            @forelse($facilities as $facility)
                <div class="col-md-6 mb-4">
                    <div class="p-4 shadow-sm d-flex justify-content-between" style="border-radius: 15px;">
                        <div class="d-flex">
                            <img src="{{ asset('/assets/img/image_not_available.png') }}" alt="" class="p-2"
                                style="max-width: 100px;">
                            <div>
                                <h4 class="text-primary m-0"
                                    style="max-width: 300px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                    <strong>{{ $facility->name }}</strong>
                                </h4>
                                <div>
                                    <p>{{ $facility->description ? $facility->description : 'Deskripsi Kosong' }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-text-secondary rounded-pill text-muted border-0 p-1" type="button"
                                id="facilityActionsDropdown{{ $facility->id }}" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <i class="ri-more-2-line ri-20px"></i>
                            </button>
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
                        </div>
                    </div>
                </div>

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
                                <form action="{{ route('facility_images.store') }}" class="dropzone" id="imageDropZone"
                                    method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" value="{{ $facility->id }}" name="facility_id">
                                    <button type="submit" id="submit-all" class="btn btn-primary"
                                        style="position: absolute; bottom: 0; right: 0; margin: 10px">
                                        Tambah Gambar
                                    </button>
                                </form>
                            </div>
                            <div class="p-4">
                                <div class="grid grid-cols-3 gap-4 bg-gray-100 rounded-lg shadow-lg">
                                    <div class="row">
                                        @forelse ($facility->facility_images as $index => $image)
                                            <div class="col-12 col-lg-4">
                                                <div
                                                    class="p-2 bg-white rounded-lg overflow-hidden shadow-md hover:shadow-lg transition-shadow duration-300">
                                                    <img src="{{ asset('storage/' . $image->image) }}" alt="Facility Image"
                                                        class="w-100 object-cover rounded-md">
                                                </div>
                                            </div>
                                        @empty
                                            <p class="text-center text-gray-500 col-span-3">Tidak ada gambar tersedia.</p>
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
                                            <img src="{{ $facility->image ? asset('storage/' . $facility->image) : asset('/assets/img/image_not_available.png') }}"
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
                            <label for="facilityDescription" class="form-label">Deskripsi</label>
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

        const myDropzone = new Dropzone("#imageDropZone", {
            url: "{{ route('facility_images.store') }}", // URL untuk mengirimkan gambar
            paramName: "images", // Nama parameter yang digunakan untuk mengirimkan gambar
            maxFilesize: 5, // Batas maksimal ukuran file (MB)
            acceptedFiles: ".jpeg,.jpg,.png", // Tipe file yang diperbolehkan
            autoProcessQueue: false, // Mencegah pengiriman otomatis
            addRemoveLinks: true, // Tampilkan tombol hapus
            dictDefaultMessage: "Letakkan file di sini atau klik untuk mengunggah",
            parallelUploads: 10, // Jumlah file yang diproses sekaligus
            init: function() {
                const submitButton = document.querySelector("#submit-all");
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
                    formData.append("facility_id", document.querySelector('input[name="facility_id"]')
                        .value);
                });

                this.on("success", function(file, response) {
                    console.log('Upload berhasil:', response);
                });

                this.on("queuecomplete", function() {
                    dropzoneInstance.submitForm();
                });
            },
            submitForm: function() {
                document.querySelector("#imageDropZone").submit();
            }
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
