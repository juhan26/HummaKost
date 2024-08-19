@extends('app')

@section('content')
    <div class="col-12 col-lg-12" style="min-height: 200px">
        <div class="d-flex align-items-center justify-content-between" style="padding: 50px 0 30px 0;">
            <h3 class="m-0"><strong>List Kontrakan</strong></h3>
            <div class="d-flex" style="gap: 30px;position: relative">
                <input type="text"
                    style="border: 0;background-color: rgba(32,180,134,0.1);border-radius: 15px;height: 60px; width: 584px;outline:none;padding: 0 50px 0 50px"
                    value="{{ request('search') }}" placeholder="Cari...">
                <a href="{{ route('properties.create') }}" class="btn"
                    style="width: 160px; border-radius: 15px; background-color: rgba(32,180,134,1);color: white;font-size: 16px"><i
                        class="ri-add-line ri-20px"></i>Tambah</a>
                <i class="ri-search-line ri-20px"
                    style="position: absolute;top: 50%;transform: translateY(-50%);left: 2%"></i>
            </div>
        </div>

        <div class="row row-cols-1 row-cols-md-3 g-4 mb-3">
            @forelse ($properties as $property)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card shadow-sm" style="border-radius: 20px; overflow: hidden;">
                        <img src="{{ $property->image ? asset('storage/' . $property->image) : asset('/assets/img/image_not_available.png') }}"
                            alt="{{ $property->name }}" class="card-img-top" style="height: 250px; object-fit: cover;">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="m-0" style="color: rgba(32,180,134,1)"><i
                                        class="ri-calendar-line ri-20px me-2"></i>{{ $property->available_date }}</h5>
                                <span class="badge rounded-pill bg-light"
                                    style="padding: 8px 20px; color: rgba(32,180,134,0.7); background-color: rgba(32,180,134,0.2);">Tersedia</span>
                            </div>
                            <h4 class="card-title"><strong>{{ $property->name }}</strong></h4>
                            <p class="card-text" style="height: 80px; overflow: hidden; text-overflow: ellipsis;">{{ $property->description ? $property->description : 'Deskripsi Kosong' }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="m-0" style="color: rgba(32,180,134,1)">Rp. {{ number_format($property->rental_price, 0, ',', '.') }} / bln</h5>
                                <a href="{{ route('properties.show', $property->id) }}" class="btn text-white"
                                    style="background-color: rgba(32,180,134,1); width: 100px; height: 40px; border-radius: 10px;">Detail</a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="card-header flex-column flex-md-row border-top border-bottom w-100">
                        <div class="head-label text-center">
                            <h5 class="card-title mb-0">
                                {{ request('search') ? 'Kontrakan Tidak Ditemukan' : 'Belum Ada Kontrakan' }}</h5>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>

        {{ $properties->links() }}
    </div>
@endsection
