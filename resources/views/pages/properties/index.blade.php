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
                <a href="{{ route('properties.create') }}" class="btn"
                    style="width: 160px; padding: 15px 0 ;border-radius: 10px; background-color: rgba(32,180,134,1);color: white;font-size: 16px"><i
                        class="ri-add-line ri-20px"></i>Tambah</a>
                <i class="ri-search-line ri-20px" id="searchIcon"
                    style="position: absolute; top: 50%;transform: translateY(-50%); left: 3%;"></i>
            </form>
        </div>

        <div class="row">
            @forelse ($properties as $property)
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm position-relative" style="border-radius: 20px; overflow: hidden;">
                        <!-- Edit and Delete Icons -->
                        @if ($property->gender_target === 'male')
                            <span class="badge rounded-pill bg-label-info position-absolute top-0 start-0 m-2">
                                <i class="mdi ri-men-line"></i> Laki-Laki
                            </span>
                        @else
                            <span class="badge rounded-pill bg-label-danger position-absolute top-0 start-0 m-2">
                                <i class="mdi ri-women-line"></i> Perempuan
                            </span>
                        @endif

                        <div class="position-absolute top-0 end-0 p-2 d-flex gap-2" style="display: none;"
                            id="card-actions-{{ $property->id }}">
                            <a href="{{ route('properties.edit', $property->id) }}" class="btn btn-primary btn-sm">
                                <i class="ri-edit-line"></i>
                            </a>
                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                data-bs-target="#deleteModal{{ $property->id }}">
                                <i class="ri-delete-bin-line"></i>
                            </button>

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
                            alt="{{ $property->name }}" class="card-img-top" style="height: 250px; object-fit: cover;">

                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="m-0" style="color: rgba(32,180,134,1)">
                                    <i
                                        class="ri-calendar-line ri-20px me-2"></i>{{ \Carbon\Carbon::parse($property->created_at)->locale('id')->translatedFormat('j F Y') }}
                                </h5>
                                <span class="label bg-label-primary"
                                    style="padding: 8px 20px; border-radius: 15px;">Tersedia</span>
                            </div>
                            <h4 class="card-title"><strong>{{ $property->name }}</strong></h4>
                            <p class="card-text" style="height: 80px; overflow: hidden; text-overflow: ellipsis;">
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
                </div>
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
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('.card').hover(
                function() {
                    let id = $(this).data('id');
                    $('#card-actions-' + id).show();
                },
                function() {
                    let id = $(this).data('id');
                    $('#card-actions-' + id).hide();
                }
            );
        });
    </script>
@endsection
