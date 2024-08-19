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
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4 mb-3">
            @forelse ($properties as $property)
                <div class="col">
                    <div class="card shadow-sm" style="border-radius: 20px; overflow: hidden;">
                        <img src="{{ $property->image ? asset('storage/' . $property->image) : asset('/assets/img/image_not_available.png') }}"
                            alt="{{ $property->name }}" class="card-img-top"
                            style="min-height: 250px;max-height: 350px; object-fit: cover;">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="m-0" style="color: rgba(32,180,134,1)">
                                    <i
                                        class="ri-calendar-line ri-20px me-2"></i>{{ \Carbon\Carbon::parse($property->created_at)->locale('id')->translatedFormat('j F Y') }}
                                </h5>
                                @if ($property->status === 'available')
                                    <span class="badge rounded-pill bg-light"
                                        style="padding: 8px 20px; color: rgba(32,180,134,0.7); background-color: rgba(32,180,134,0.2);">Tersedia</span>
                                @else
                                    <span class="badge rounded-pill bg-light"
                                        style="padding: 8px 20px; color: rgba(196,69,54,0.7); background-color: rgba(196,69,54,0.2);">Penuh</span>
                                @endif
                            </div>
                            <h4 class="card-title"><strong>{{ $property->name }}</strong></h4>
                            <p class="card-text" style="height: 80px; overflow: hidden; text-overflow: ellipsis;">
                                {{ $property->description ? $property->description : 'Deskripsi Kosong' }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="m-0" style="color: rgba(32,180,134,1)">Rp.
                                    {{ number_format($property->rental_price, 0, ',', '.') }} / bln</h5>
                                <a href="{{ route('properties.show', $property->id) }}" class="btn text-white"
                                    style="background-color: rgba(32,180,134,1); width: 100px; height: 40px; border-radius: 10px;">Detail</a>
                            </div>
                        </div>
                    </div>
        <!-- Delete Modal -->
        <div class="modal fade" id="deleteModal{{ $property->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $property->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel{{ $property->id }}">Hapus Properti</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
</div>
@endsection
