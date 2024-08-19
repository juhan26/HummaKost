@extends('app')

@section('content')
    <div class="container" style="min-height: 200px">
        <div class="d-flex flex-column flex-md-row align-items-center justify-content-between mb-4"
            style="padding: 50px 0 30px 0;">
            <h3 class="m-0 mb-3 mb-md-0"><strong>List Kontrakan</strong></h3>
            <div class="d-flex flex-column flex-md-row align-items-center" style="gap: 15px; position: relative; width: 70%;">
                <input type="text" class="form-control"
                    style="border: 0; background-color: rgba(32,180,134,0.1); border-radius: 15px; height: 60px; outline: none; "
                    value="{{ request('search') }}" placeholder="Cari...">
                <a href="{{ route('properties.create') }}" class="btn"
                    style="width: 160px; padding: 15px 0 ;border-radius: 10px; background-color: rgba(32,180,134,1);color: white;font-size: 16px"><i
                        class="ri-add-line ri-20px"></i>Tambah</a>
                {{-- <i class="ri-search-line ri-20px"
                {{-- style="position: absolute; top: 25%;transform: translateY(-50%); left: 10px;"></i>  --}}
            </div>
        </div>

        <div class="row">
            @foreach ($properties as $property)
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm position-relative" style="border-radius: 20px; overflow: hidden;">
                    <!-- Edit and Delete Icons -->
                    <div class="position-absolute top-0 end-0 p-2 d-flex gap-2" style="display: none;"
                        id="card-actions-{{ $property->id }}">
                        <a href="{{ route('properties.edit', $property->id) }}" class="btn btn-primary btn-sm">
                            <i class="ri-edit-line"></i>
                        </a>
                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                            data-bs-target="#deleteModal{{ $property->id }}">
                            <i class="ri-delete-bin-line"></i>
                        </button>
                    </div>
            
                    <img src="{{ $property->image ? asset('storage/' . $property->image) : asset('/assets/img/image_not_available.png') }}"
                        alt="{{ $property->name }}" class="card-img-top" style="height: 250px; object-fit: cover;">
            
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="m-0" style="color: rgba(32,180,134,1)">
                                <i class="ri-calendar-line ri-20px me-2"></i>{{ \Carbon\Carbon::parse($property->created_at)->locale('id')->translatedFormat('j F Y') }}
                            </h5>
                            <span class="badge rounded-pill bg-light"
                                style="padding: 8px 20px; color: rgba(32,180,134,0.7); background-color: rgba(32,180,134,0.2);">Tersedia</span>
                        </div>
                        <h4 class="card-title"><strong>{{ $property->name }}</strong></h4>
                        <p class="card-text" style="height: 80px; overflow: hidden; text-overflow: ellipsis;">
                            {{ $property->description ? $property->description : 'Deskripsi Kosong' }}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="m-0" style="color: rgba(32,180,134,1)">Rp.
                                {{ number_format($property->rental_price, 0, ',', '.') }} / bln</h5>
                            <!-- Button to trigger modal -->
                            <button type="button" class="btn text-white" style="background-color: rgba(32,180,134,1); width: 100px; height: 40px; border-radius: 10px;"
                                data-bs-toggle="modal" data-bs-target="#detailModal{{ $property->id }}">
                                Detail
                            </button>
                        </div>
                    </div>
                </div>
            </div>

                <!-- Detail Modal -->
                <div class="modal fade" id="detailModal{{ $property->id }}" tabindex="-1"
                    aria-labelledby="detailModalLabel{{ $property->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title text-primary" id="detailModalLabel{{ $property->id }}">Detail Kontrakan</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="d-flex flex-lg-row flex-column align-items-center">
                                    <!-- Gambar Kontrakan -->
                                    <div class="mb-4 text-center text-lg-start">
                                        <img src="{{ $property->image ? asset('storage/' . $property->image) : asset('/assets/img/image_not_available.png') }}"
                                            alt="{{ $property->name }}" class="img-fluid mb-4"
                                            style="max-width: 250px; border-radius: 10px;">
                                    </div>
                                    <!-- Detail Properti -->
                                    <div class="ms-lg-4">
                                        <h4 class="text-primary"><strong>{{ $property->name }}</strong></h4>
                                        <p class="text-secondary">
                                            {{ $property->category ? $property->category->name : 'Kategori tidak tersedia' }}
                                        </p>
                                        <h4 class="text-success mb-3"><strong>Rp. {{ number_format($property->rental_price, 0, ',', '.') }} / bln</strong></h4>
                
                                        <div class="d-flex justify-content-start gap-3 mb-4">
                                            <span class="badge bg-success">Tersedia</span>
                                            <span class="badge" style="background-color: rgba(9, 12, 155, 0.2); color: rgba(9, 12, 155, 1);">Total Orang: 19</span>
                                            <span class="badge bg-warning">Kapasitas: 2</span>
                                        </div>
                
                                        <p class="text-danger">*Ketua tidak tersedia</p>
                                    </div>
                                </div>
                                <!-- Tombol Tambah Kontrak -->
                                <div class="text-center mt-4">
                                    <a href="{{ route('leases.create', $property->id) }}" class="btn btn-success btn-lg">Tambah Kontrak</a>
                                </div>
                                <!-- Peta Lokasi -->
                                <div class="mt-4">
                                    <img src="https://via.placeholder.com/600x300" alt="Map" class="img-fluid" style="border-radius: 10px;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                


                <!-- Delete Modal -->
                <div class="modal fade" id="deleteModal{{ $property->id }}" tabindex="-1"
                    aria-labelledby="deleteModalLabel{{ $property->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteModalLabel{{ $property->id }}">Hapus Properti</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Apakah Anda yakin ingin menghapus properti ini?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <form action="{{ route('properties.destroy', $property->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endsection
