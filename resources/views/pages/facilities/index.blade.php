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
                padding: 0 15px;
            }
        }
    </style>

    <div class="container" style="min-height: 200px;">
        <div class="d-flex flex-column flex-md-row align-items-center justify-content-between mb-4" style="padding: 50px 0 30px;">
            <h3 class="m-0 mb-3 mb-md-0"><strong>List Fasilitas</strong></h3>
            <form action="{{ route('facilities.index') }}" method="GET" class="d-flex flex-column flex-md-row align-items-center" style="gap: 15px; position: relative; width: 70%;">
                @csrf
                <input type="text" class="form-control" name="search" id="searchInput"
                    style="border: 0; background-color: rgba(32,180,134,0.1); border-radius: 15px; height: 60px; outline: none;"
                    value="{{ request('search') }}" placeholder="Cari...">
                <button type="button" class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#storeModal"
                    style="width: 160px; padding: 15px 0; border-radius: 10px; background-color: rgba(32,180,134,1); color: white; font-size: 16px;">
                    <i class="ri-add-line ri-20px"></i>Tambah
                </button>
                <i class="ri-search-line ri-20px" id="searchIcon" style="position: absolute; top: 50%; transform: translateY(-50%); left: 3%;"></i>
            </form>
        </div>

        <div class="row">
            @forelse($facilities as $facility)
                <div class="col-md-6 mb-4">
                    <div class="p-4 shadow-sm d-flex justify-content-between" style="border-radius: 15px;">
                        <div class="d-flex">
                            <img src="{{ asset('/assets/img/image_not_available.png') }}" alt="" class="p-2"
                                style="max-width: 100px; object-fit:cover;">
                            <div class="py-4">
                                <h4 class="text-primary m-0"
                                    style="max-width: 300px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                    <strong>{{ $facility->name }}</strong>
                                </h4>
                                <p class="m-0">{{ $facility->description ?: 'Deskripsi Kosong' }}</p>
                            </div>
                        </div>
                        <div class="dropdown d-flex flex-column justify-content-between align-items-end">
                            <button class="btn btn-text-secondary rounded-pill text-muted border-0 p-1" type="button"
                                id="facilityActionsDropdown{{ $facility->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="ri-more-2-line ri-20px"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="facilityActionsDropdown{{ $facility->id }}">
                                <li>
                                    <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#imageDetail{{ $facility->id }}">
                                        <i class="ri-image-line me-2 ri-20px"></i>Gambar Detail
                                    </button>
                                </li>
                                <li>
                                    <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#updateModal{{ $facility->id }}">
                                        <i class="ri-edit-line me-2 ri-20px"></i>Edit
                                    </button>
                                </li>
                                <li>
                                    <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $facility->id }}">
                                        <i class="ri-delete-bin-line me-2 ri-20px"></i>Hapus
                                    </button>
                                </li>
                            </ul>
                            <button type="button" class="btn btn-primary" style="border-radius: 50px;">Detail</button>
                        </div>
                    </div>
                </div>

                <!-- Image Detail Modal -->
                <div class="modal fade" id="imageDetail{{ $facility->id }}" tabindex="-1" aria-labelledby="imageDetailModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title text-primary" id="facilityUpdateModalLabel">Detail Gambar {{ $facility->id }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('facility_images.store') }}" class="dropzone facility-dropzone" data-facility-id="{{ $facility->id }}" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" value="{{ $facility->id }}" name="facility_id">
                                    <button type="submit" id="submit-all" class="btn btn-primary position-absolute" style="bottom: 10px; right: 10px;">
                                        Tambah Gambar
                                    </button>
                                </form>

                                <div class="p-4 shadow-sm mt-3" style="border-radius:15px;">
                                    <div class="row g-4">
                                        <div class="col-12 mb-3">
                                            <button id="select-all" class="btn btn-secondary">Pilih Semua</button>
                                            <button id="delete-selected" class="btn btn-danger" disabled>Hapus yang Dipilih</button>
                                        </div>
                                        @forelse ($facility->facility_images as $image)
                                            <div class="col-12 col-md-6 col-lg-4 position-relative" data-image-id="{{ $image->id }}">
                                                <div class="position-relative">
                                                    <input type="checkbox" class="image-checkbox" data-image-id="{{ $image->id }}"
                                                        style="position: absolute; top: 10px; left: 10px;">
                                                    <img src="{{ asset('storage/' . $image->image) }}" alt="Facility Image" class="img-fluid rounded"
                                                        style="max-height: 200px; object-fit: cover;">
                                                </div>
                                            </div>
                                        @empty
                                            <div class="col-12">
                                                <p class="text-center m-0 py-3"><strong>Tidak ada gambar detail.</strong></p>
                                            </div>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const selectAllButton = document.getElementById('select-all');
                        const deleteSelectedButton = document.getElementById('delete-selected');
                        const imageCheckboxes = document.querySelectorAll('.image-checkbox');
                        let allSelected = false;

                        selectAllButton.addEventListener('click', function() {
                            allSelected = !allSelected; // Toggle the allSelected flag
                            imageCheckboxes.forEach(checkbox => {
                                checkbox.checked = allSelected;
                            });
                            selectAllButton.textContent = allSelected ? 'Batal Pilih Semua' : 'Pilih Semua';
                            updateDeleteButtonState();
                        });

                        deleteSelectedButton.addEventListener('click', function() {
                            const selectedImageIds = Array.from(imageCheckboxes)
                                .filter(checkbox => checkbox.checked)
                                .map(checkbox => checkbox.dataset.imageId);

                            if (selectedImageIds.length === 0) {
                                alert('Tidak ada gambar yang dipilih.');
                                return;
                            }

                            if (confirm('Apakah Anda yakin ingin menghapus gambar yang dipilih?')) {
                                selectedImageIds.forEach(imageId => {
                                    fetch(`/facility_images/${imageId}`, {
                                        method: 'DELETE',
                                        headers: {
                                            'Content-Type': 'application/json',
                                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                        }
                                    })
                                    .then(response => {
                                        if (response.ok) {
                                            const imageContainer = document.querySelector(`[data-image-id="${imageId}"]`);
                                            if (imageContainer) {
                                                imageContainer.remove();
                                            }
                                            updateDeleteButtonState();
                                        } else {
                                            console.error('Error deleting image', response);
                                        }
                                    })
                                    .catch(error => {
                                        console.error('Error:', error);
                                    });
                                });
                            }
                        });

                        imageCheckboxes.forEach(checkbox => {
                            checkbox.addEventListener('change', updateDeleteButtonState);
                        });

                        function updateDeleteButtonState() {
                            const anyChecked = Array.from(imageCheckboxes).some(checkbox => checkbox.checked);
                            deleteSelectedButton.disabled = !anyChecked;
                        }
                    });
                </script>



                <!-- Update Modal -->
                <div class="modal fade" id="updateModal{{ $facility->id }}" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-md">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title text-primary" id="facilityUpdateModalLabel">Edit {{ $facility->id }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('facilities.update', $facility->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PATCH')
                                    <div class="form-group mb-3">
                                        <label for="facilityName{{ $facility->id }}" class="form-label">Nama Fasilitas</label>
                                        <input type="text" class="form-control" id="facilityName{{ $facility->id }}"
                                            name="name" value="{{ $facility->name }}">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="facilityDescription{{ $facility->id }}" class="form-label">Deskripsi</label>
                                        <textarea class="form-control" id="facilityDescription{{ $facility->id }}" rows="4" name="description">{{ $facility->description }}</textarea>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="facilityImage{{ $facility->id }}" class="form-label">Gambar</label>
                                        <input type="file" class="form-control" id="facilityImage{{ $facility->id }}" name="image">
                                    </div>
                                    <button type="submit" class="btn btn-primary" style="border-radius: 50px; background-color: rgba(32,180,134,1);">Simpan</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Delete Modal -->
                <div class="modal fade" id="deleteModal{{ $facility->id }}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-md">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title text-danger" id="facilityDeleteModalLabel">Hapus {{ $facility->id }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>Apakah Anda yakin ingin menghapus fasilitas ini?</p>
                                <form action="{{ route('facilities.destroy', $facility->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" style="border-radius: 50px;">Hapus</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            @empty
                <div class="col-12">
                    <p class="text-center m-0 py-3"><strong>Belum ada fasilitas.</strong></p>
                </div>
            @endforelse
        </div>
    </div>
@endsection
