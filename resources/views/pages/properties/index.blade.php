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
                            alt="{{ $property->name }}" class="card-img-top"
                            style="height: 250px; object-fit: cover;">

                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="m-0" style="color: rgba(32,180,134,1)">
                                    <i class="ri-calendar-line ri-20px me-2"></i>{{ \Carbon\Carbon::parse($property->created_at)->locale('id')->translatedFormat('j F Y') }}
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

                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#propertyDetailModal{{ $property->id }}">
                                    Detail
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Property Detail Modal -->
                <div class="modal fade" id="propertyDetailModal{{ $property->id }}" tabindex="-1"
                    aria-labelledby="propertyDetailModalLabel{{ $property->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title text-primary" id="propertyDetailModalLabel{{ $property->id }}">
                                    Detail Kontrakan "{{ $property->name }}"</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row g-4">
                                    <div class="col-12">
                                        @if ($property->image)
                                            <img class="img-fluid rounded" src="{{ asset('storage/' . $property->image) }}"
                                                alt="Gambar {{ $property->name }}" />
                                        @else
                                            <img class="img-fluid rounded" src="{{ asset('assets/img/image_not_available.png') }}"
                                                alt="Gambar tidak tersedia" />
                                        @endif
                                    </div>
                                    <div class="col-12">
                                        <h3 class="text-black">{{ $property->name }}</h3>
                                        <p>{{ $property->description }}</p>
                                
                                       
                                
                                        <h4 class="fw-bold text-primary my-3">
                                            {{ 'Rp. ' . number_format($property->rental_price, 0) . '/ bln'}}
                                        </h4>
                                
                                        <div class="d-flex align-items-center my-2 mb-8">
                                            <span class="badge me-2 {{ $property->status === 'available' ? 'bg-label-primary' : 'bg-label-danger' }}">
                                                {{ $property->status === 'available' ? 'Tersedia' : 'Full' }}
                                            </span>
                                            <span class="badge bg-label-secondary me-2">Total Orang:
                                                <strong>{{ $property->leases->count() }}</strong>
                                            </span>
                                            <span class="badge bg-label-warning me-2">Kapasitas:
                                                <strong>{{ $property->capacity }}</strong>
                                            </span>
                                        </div>

                                         {{-- Menampilkan status Ketua Kontrakan --}}
                                         {{-- @php $status = false; @endphp
                                
                                         @foreach ($property->leases as $lease)
                                             @if ($lease->user->hasRole('admin'))
                                                 <p class="text-primary">
                                                     Ketua Kontrakan: {{ $lease->user->name }}
                                                     <a data-bs-toggle="modal"
                                                        data-bs-target="#editPropertyLeaderModal{{ $property->id }}"
                                                        class="text-decoration-underline text-primary"
                                                        style="cursor: pointer;">Ubah Ketua</a>
                                                 </p>
                                                 @php $status = true; @endphp
                                             @endif
                                         @endforeach
                                 
                                         @if (!$status)
                                             <p class="text-danger">
                                                 Belum Ada Ketua Kontrakan
                                                 <button data-bs-toggle="modal"
                                                    data-bs-target="#addPropertyLeaderModal{{ $property->id }}"
                                                    class="btn btn-primary"
                                                    style="cursor: pointer; width: 1px; height: 0px;"></button>
                                             </p>
                                         @endif --}}
                                
                                        @hasrole('super_admin')
                                            
                                        <button type="button" class="btn btn-primary w-30 mt-3" 
                                        data-bs-toggle="modal"
                                        data-bs-target="#createModal" 
                                        >Tambah Kontrak</button>


                                        @endhasrole
                                    </div>
                                </div>
                                
                
                                {{-- ANGGOTA --}}
                                <div class="card mt-4">
                                    <div class="card-header">
                                        <h4 class="card-title">Daftar Anggota</h4>
                                    </div>
                                    <div class="card-body d-flex justify-content-center flex-wrap">
                                        @forelse ($property->leases as $lease)
                                            <div class="text-center me-3 mb-3" style="width: 120px;">
                                                <img class="rounded-circle mx-auto d-block"
                                                    style="width: 80px; height: 80px; object-fit: cover;"
                                                    src="{{ $lease->user->photo ? asset('storage/' . $lease->user->photo) : asset('assets/img/image_not_available.png') }}"
                                                    alt="{{ $lease->user->name }}">
                                                <h5 class="card-title mt-2">{{ $lease->user->name }}</h5>
                                                <p class="card-text text-muted">{{ $lease->user->status }}</p>
                                            </div>
                                        @empty
                                            <p class="text-center text-muted">Belum ada anggota</p>
                                        @endforelse
                                    </div>
                                </div>
                                {{-- END ANGGOTA --}}
                            </div>
                        </div>
                    </div>
                </div>
                
                {{-- End Detail Modal --}}
            @endforeach
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
