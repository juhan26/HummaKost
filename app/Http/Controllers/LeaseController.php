<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLeaseRequest;
use App\Http\Requests\UpdateLeaseRequest;
use App\Models\Lease;
use App\Models\Property;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Get the selected property filter if available
        $propertyFilter = $request->input('property_filter');
<<<<<<< HEAD
    
        // Fetch leases, optionally filtered by the selected property
        $leases = Lease::when($propertyFilter, function ($query, $propertyFilter) {
                return $query->where('property_id', $propertyFilter);
            })
            ->latest()
            ->paginate(6);
    
        // Fetch users associated with the selected property
        $users = User::when($propertyFilter, function ($query, $propertyFilter) {
            return $query->whereHas('lease', function ($query) use ($propertyFilter) {
                $query->where('property_id', $propertyFilter);
            });
        })
        ->orWhereDoesntHave('lease') // Include users without any leases
        ->where(function ($query) {
            $query->whereHas('roles', function ($query) {
                $query->where('name', 'member');
            })->orWhereHas('roles', function ($query) {
                $query->where('name', 'admin');
            });
        })
        ->latest()
        ->get();
    
        // Fetch all properties for the dropdown
        $properties = Property::all();
    
        return view('pages.leases.index', compact('leases', 'users', 'properties', 'propertyFilter'));
    }
    
=======

        // Fetch leases, optionally filtered by the selected property
        $leases = Lease::when($propertyFilter, function ($query, $propertyFilter) {
            return $query->where('property_id', $propertyFilter);
        })
            ->orWhereRelation('users','name','LIKE',"%$request->search%")//('nama_tabel','nama_kolom_pada_tabel_relasi','LIKE',"%$request->searchName%")
            ->orWhereRelation('properties','name','LIKE',"%$request->search%")
            ->orWhereRaw('CAST(start_date as CHAR) LIKE?',['%'.$request->search.'%'])//('CAST(nama_kolom as CHAR) LIKE?',['%' . $request->searchName . '%'])
           ->latest()
            ->paginate(6);

        // Fetch users associated with the selected property
        $users = User::when($propertyFilter, function ($query, $propertyFilter) {
            return $query->whereHas('leases', function ($query) use ($propertyFilter) {
                $query->where('property_id', $propertyFilter);
            });
        })
            ->orWhereDoesntHave('leases') // Include users without any leases
            ->where(function ($query) {
                $query->whereHas('roles', function ($query) {
                    $query->where('name', 'member');
                })->orWhereHas('roles', function ($query) {
                    $query->where('name', 'admin');
                });
            })
            ->latest()
            ->get();




        // Fetch all properties for the dropdown
        $properties = Property::all();

        return view('pages.leases.index', compact('leases', 'users', 'properties', 'propertyFilter'));
    }
>>>>>>> d208161f655833351380609fd6a057efe6eb3890


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLeaseRequest $request)
    {
        // Periksa apakah pengguna sudah memiliki kontrak aktif
        $existingLease = Lease::where('user_id', $request->user_id)
            ->where('end_date', '>', now())
            ->first();

        if ($existingLease) {
            return redirect()->route('leases.index')->with('error', 'Pengguna sudah memiliki kontrak aktif.');
        }

        // Ambil properti berdasarkan property_id
        $property = Property::find($request->property_id);

        if (!$property) {
            return redirect()->route('leases.index')->with('error', 'Properti tidak ditemukan.');
        }

        // Gunakan Carbon untuk menangani tanggal
        $startDate = \Carbon\Carbon::parse($request->start_date);
        $endDate = \Carbon\Carbon::parse($request->end_date);

        // Periksa apakah end_date lebih awal dari start_date
        if ($endDate->lt($startDate)) {
            return redirect()->back()->with('error', 'Tanggal selesai tidak boleh lebih awal dari tanggal mulai.');
        }

        // Hitung total iuran berdasarkan jumlah bulan
        $totalMonths = $startDate->copy()->endOfMonth()->diffInMonths($endDate->startOfMonth()) + 1;
        $totalIuran = $totalMonths * $property->rental_price;

        // Simpan kontrak baru
        Lease::create([
            'user_id' => $request->user_id,
            'property_id' => $request->property_id,
            'start_date' => $startDate->format('Y-m-d'),
            'end_date' => $endDate->format('Y-m-d'),
            'description' => $request->description,
            'total_iuran' => number_format($totalIuran, 2, '.', ''), // Format dengan dua desimal
        ]);

        // Tangani pembaruan status properti
        $capacity = $property->capacity;
        $activeLeasesCount = Lease::where('property_id', $request->property_id)->where('status', 'active')->count();

        if ($activeLeasesCount >= $capacity) {
            $property->update(['status' => 'full']);
        } else {
            $property->update(['status' => 'available']);
        }

        return redirect()->route('leases.index')->with('success', 'Kontrak berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Lease $lease)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lease $lease)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLeaseRequest $request, Lease $lease)
    {
        // Periksa apakah pengguna sudah memiliki kontrak aktif
        $existingLease = Lease::where('user_id', $request->user_id)
            ->where('end_date', '>', now())
            ->where('id', '<>', $lease->id) // Kecualikan kontrak yang sedang diperbarui
            ->first();

        if ($existingLease) {
            return redirect()->route('leases.index')->with('error', 'Pengguna sudah memiliki kontrak aktif.');
        }

        // Ambil properti berdasarkan property_id
        $property = Property::find($request->property_id);

        if (!$property) {
            return redirect()->route('leases.index')->with('error', 'Properti tidak ditemukan.');
        }

        // Gunakan Carbon untuk menangani tanggal
        $startDate = \Carbon\Carbon::parse($request->start_date);
        $endDate = \Carbon\Carbon::parse($request->end_date);

        // Periksa apakah end_date lebih awal dari start_date
        if ($endDate->lt($startDate)) {
            return redirect()->back()->with('error', 'Tanggal selesai tidak boleh lebih awal dari tanggal mulai.');
        }

        // Hitung total iuran berdasarkan jumlah bulan
        $totalMonths = $startDate->copy()->endOfMonth()->diffInMonths($endDate->startOfMonth()) + 1;
        $totalIuran = $totalMonths * $property->rental_price;

        // Perbarui kontrak
        $lease->update([
            'user_id' => $request->user_id,
            'property_id' => $request->property_id,
            'start_date' => $startDate->format('Y-m-d'),
            'end_date' => $endDate->format('Y-m-d'),
            'description' => $request->description,
            'total_iuran' => number_format($totalIuran, 2, '.', ''), // Format dengan dua desimal
        ]);

        // Tangani pembaruan status properti
        $capacity = Property::find($request->property_id)->capacity;
        $activeLeasesCount = Lease::where('property_id', $request->property_id)->where('status', 'active')->count();

        if ($activeLeasesCount >= $capacity) {
            $property->update(['status' => 'full']);
        } else {
            $property->update(['status' => 'available']);
        }

        return redirect()->route('leases.index')->with('success', 'Kontrak berhasil diperbarui.');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lease $lease)
    {
        try {
            $property = Property::find($lease->property_id);
            $property->update(['status' => 'available']);
            $lease->delete();
            return redirect()->route('leases.index')->with('success', 'Leases Deleted Success');
        } catch (\Exception $e) {
            if ($e->getCode() === '23000') {
                return redirect()->route('leases.index')->with('error', 'Cannot delete this lease because he/she has related data in other tables');
            }
        }
    }
}
