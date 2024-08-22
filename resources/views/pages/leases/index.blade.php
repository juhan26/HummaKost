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
            <h3 class="m-0 mb-3 mb-md-0"><strong>Manajemen Kontrak</strong></h3>
            <form action="{{ route('leases.index') }}" method="GET"
                class="d-flex me-lg-3 mb-3 mb-lg-0 flex-column flex-md-row align-items-center"
                style="gap: 15px; position: relative; width: 70%;">
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

                <div class="dropdown d-flex align-items-center justify-content-end">
                    <button type="button" class="btn btn-primary  dropdown-toggle hide-arrow" data-bs-toggle="dropdown"
                        style="border-radius: 15px;padding-top:.85rem;padding-bottom:.85rem">
                        <span class="material-symbols-outlined">filter_list</span>
                    </button>
                    <div class="dropdown-menu">
                        <div class="row p-3" style="width:20rem;">
                            <div class="">
                                <p class="card-title">Status</p>
                                <label class="form-check-label custom-option-content w-100" for="activeFilter">
                                    <div class="dropdown-item">
                                        <input name="status[]" class="form-check-input me-2" id="activeFilter"
                                            type="checkbox" value="active" onclick="this.form.submit()"
                                            @if (in_array('active', $status)) checked @endif />
                                        <span>Aktif</span>
                                    </div>
                                </label>
                                <label class="form-check-label custom-option-content w-100" for="expiredFilter">
                                    <div class="dropdown-item">
                                        <input name="status[]" class="form-check-input me-2" id="expiredFilter"
                                            type="checkbox" value="expired" onclick="this.form.submit()"
                                            @if (in_array('expired', $status)) checked @endif />
                                        <span>Expired</span>
                                    </div>
                                </label>
                                @foreach ($properties as $property)
                                    <label class="form-check-label custom-option-content w-100"
                                        for="property_idFilter{{ $property->id }}">
                                        <div class="dropdown-item">
                                            <input name="property_id[]" class="form-check-input me-2"
                                                id="property_idFilter{{ $property->id }}" type="checkbox"
                                                value="{{ $property->id }}" onclick="this.form.submit()"
                                                @if (in_array($property->id, $property_id)) checked @endif />
                                            <span>{{ $property->name }}</span>
                                        </div>
                                    </label>
                                @endforeach
                            </div>
                        </div>
            </form>

        </div>
    </div>
    </form>
    </div>


    <div class="table-responsive text-nowrap">
        <table class="table">
            <tr class="text-center" style="border-bottom: 1px solid rgba(0,0,0,.15);">
                <th>No</th>
                <th>Foto</th>
                <th>Nama Penyewa</th>
                <th>Kontrakan</th>
                <th>Tanggal Mulai</th>
                <th>Tanggal Selesai</th>
                <th>Total Iuran</th>
                <th>Status</th>
                <th>Total Telah Dibayar</th>
                <th>Aksi</th>
            </tr>
            <tbody class="table-border-bottom-0">
                @forelse ($leases as $index=>$lease)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            <img src="{{ $lease->user->photo ? asset('storage/' . $lease->user->photo) : asset('assets/img/image_not_available.png') }}"
                                alt="{{ $lease->user->name }}" class="img-fluid">
                        </td>
                        <td>{{ $lease->user->name }}</td>
                        <td>{{ $lease->properties->name }}</td>
                        <td>{{ \Carbon\Carbon::parse($lease->start_date)->translatedFormat('j F Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($lease->end_date)->translatedFormat('j F Y') }}</td>
                        <td>{{ $lease->total_iuran == $lease->total_nominal ? 'Lunas' : 'Rp. ' . number_format($lease->total_iuran) }}
                        </td>
                        <td>
                            <span
                                class="badge fs-6 {{ $lease->status === 'active' ? 'bg-label-success' : 'bg-label-danger' }}">
                                {{ $lease->status }}
                            </span>
                        </td>
                        <td>Rp. {{ number_format($lease->total_nominal) }}
                        </td>
                        <td>
                            <a type="button" class="" data-bs-toggle="modal"
                                data-bs-target="#editModal{{ $lease->id }}" data-bs-whatever="@mdo"><i
                                    style="color: #e3a805" class="menu-icon tf-icons ri-edit-2-line"></i></a>

                            <a type="button" class="" data-bs-toggle="modal"
                                data-bs-target="#deleteModal{{ $lease->id }}">
                                <i style="color: red" class="menu-icon tf-icons ri-delete-bin-line"></i>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr class="text-center">
                        <td colspan="10" class="mt-4">
                            <span class="material-symbols-outlined">contract</span>
                            <p class="card-title m-0">Kontrak Tidak Ditemukan</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>


    </div>
@endsection
