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
        $query = Lease::with(['user', 'properties']);

        $propertySearch = $request->input('search');
        $status = $request->input('status', []);
        $property_id = $request->input('property_id', []);

        if ($propertySearch || $status || $property_id) {
            $query->where(function ($query) use ($propertySearch, $status, $property_id) {

                if ($propertySearch) {
                    $query->whereHas('user', function ($query) use ($propertySearch) {
                        $query->where('name', 'LIKE', "%{$propertySearch}%");
                    });

                    $query->orWhereHas('properties', function ($query) use ($propertySearch) {
                        $query->where('name', 'LIKE', "%{$propertySearch}%");
                    });

                    $query->orWhere('status', 'LIKE', "%{$propertySearch}%");
                }

                if (!empty($status)) {
                    $query->whereIn('status', $status);
                }

                if (!empty($property_id)) {
                    $query->whereIn('property_id', $property_id);
                }
            });
        }

        $leases = $query->orderByRaw("
        CASE
            WHEN status = 'active' THEN 1
            WHEN status = 'expired' THEN 2
            ELSE 3
        END
    ")
            ->latest()
            ->paginate(10);

        $properties = Property::all();
        $users = User::with(['lease'])->where('id', '!=', Auth::user()->id)->whereDoesntHave('lease')->get();

        return view('pages.leases.index', compact('leases', 'properties', 'status', 'property_id', 'users'));
    }




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
        // Cek apakah user sudah memiliki lease yang aktif
        $existingLease = Lease::where('user_id', $request->user_id)
            ->where('end_date', '>', now()) // Memeriksa lease yang aktif
            ->first();

        if ($existingLease) {
            return redirect()->route('leases.index')->with('error', 'Pengguna sudah memiliki sewa.');
        }

        // Ambil property berdasarkan property_id
        $property = Property::find($request->property_id);

        if (!$property) {
            return redirect()->route('leases.index')->with('error', 'Kontrakan tidak di temukan.');
        }

        // Menggunakan Carbon untuk menangani tanggal
        $startDate = \Carbon\Carbon::parse($request->start_date);
        $endDate = \Carbon\Carbon::parse($request->end_date);

        // Cek apakah end_date lebih awal dari start_date
        if ($endDate->lt($startDate)) {
            return redirect()->back()->with('error', 'Tanggal akhir tidak boleh lebih awal dari tanggal mulai.');
        }

        // Cek apakah start_date dan end_date berada di bulan yang sama
        if ($startDate->isSameMonth($endDate)) {
            // Hitung total_iuran menggunakan rental_price dari property
            $totalIuran = $property->rental_price;
        } else {
            // Hitung jumlah bulan penuh di antara dua tanggal
            $totalMonths = $startDate->copy()->endOfMonth()->diffInMonths($endDate->startOfMonth()) + 1;

            // Hitung total_iuran
            $totalIuran = $totalMonths * $property->rental_price;
        }

        // Cek kapasitas dan status property
        $capacity = $property->capacity;

        if (Lease::where('property_id', $request->property_id)->where('status', 'active')->count() < $capacity) {

            if (Lease::where('property_id', $request->property_id)->where('status', 'active')->count() == ($capacity - 1)) {
                $property->update(['status' => 'full']);
            } else {
                $property->update(['status' => 'available']);
            }

            Lease::create([
                'user_id' => $request->user_id,
                'property_id' => $request->property_id,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'description' => $request->description,
                'total_iuran' => number_format($totalIuran, 2, '.', ''), // Format dengan dua desimal
                'total_nominal' => 0,
            ]);

            return redirect()->back()->with('success', 'Kontrak berhasil di tambahkan.');
        } else {
            return redirect()->route('leases.index')->with('error', 'Kontrakan Sudah Penuh.');
        }
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

    public function done(Lease $lease)
    {
        if ($lease->total_nominal >= $lease->total_iuran) {
            $lease->update([
                'status' => 'expired',
            ]);
            return redirect()->route('leases.index')->with('success', 'Berhasil Menyelesaikan Kontrak.');
        } else {
            return redirect()->route('leases.index')->with('error', 'Tidak bisa menyelesaikan kontrak, kaarena penyewa ini belum menyelesaikan pembayaran.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLeaseRequest $request, Lease $lease)
    {
        $property = Property::find($lease->properties->id);

        if (!$property) {
            return redirect()->route('leases.index')->with('error', 'Kontrakan tidak di temukan.');
        }

        // Menggunakan Carbon untuk menangani tanggal
        $startDate = \Carbon\Carbon::parse($request->start_date);
        $endDate = \Carbon\Carbon::parse($request->end_date);

        // Cek apakah end_date lebih awal dari start_date
        if ($endDate->lt($startDate)) {
            return redirect()->back()->with('error', 'Tanggal akhir tidak boleh lebih awal dari tanggal mulai.');
        }

        if ($startDate->isSameMonth($endDate)) {
            $totalIuran = $property->rental_price;
        } else {
            $totalMonths = $startDate->copy()->endOfMonth()->diffInMonths($endDate->startOfMonth()) + 1;
            $totalIuran = $totalMonths * $property->rental_price;
        }

        if($request->end_date > $lease->end_date) {
            $lease->update([
                'end_date' => $request->end_date,
                'status' => 'active',
                'description' => $request->description,
                'total_iuran' => number_format($totalIuran, 2, '.', ''), // Format dengan dua desimal
            ]);
        } else {
            $lease->update([
                'end_date' => $request->end_date,
                'description' => $request->description,
                'total_iuran' => number_format($totalIuran, 2, '.', ''), // Format dengan dua desimal
            ]);

        }

        return redirect()->route('leases.index')->with('success', 'Data kontrakan berhasil di ubah.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lease $lease)
    {
        try {
            $property = Property::find($lease->property_id);
            $property->update(['status' => 'available']);

            if ($lease->user->hasRole('admin')) {
                $lease->user->removeRole('admin');
                $lease->user->assignRole('tenant');
            }

            $lease->delete();
            return redirect()->route('leases.index')->with('success', 'Kontrak berhasil di hapus');
        } catch (\Exception $e) {
            if ($e->getCode() === '23000') {
                return redirect()->route('leases.index')->with('error', 'Tidak dapat menghapus kontrak ini karena data memiliki data terkait di tabel lain');
            }
        }
    }
}
