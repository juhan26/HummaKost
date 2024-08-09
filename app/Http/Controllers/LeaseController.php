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
    public function index()
    {
        $leases = Lease::latest()->paginate(6);

        $users = User::where(function ($query) {
            $query->whereHas('roles', function ($query) {
                $query->where('name', 'member');
            })->orWhereHas('roles', function ($query) {
                $query->where('name', 'admin');
            });
        })->whereDoesntHave('leases')
            ->latest()
            ->paginate(10);

        $properties = Property::all();

        return view('pages.leases.index', compact('leases', 'users', 'properties'));
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
            return redirect()->route('leases.index')->with('error', 'User already has an existing lease.');
        }

        // Ambil property berdasarkan property_id
        $property = Property::find($request->property_id);

        if (!$property) {
            return redirect()->route('leases.index')->with('error', 'Property not found.');
        }

        // Menggunakan Carbon untuk menangani tanggal
        $startDate = \Carbon\Carbon::parse($request->start_date);
        $endDate = \Carbon\Carbon::parse($request->end_date);

        // Cek apakah end_date lebih awal dari start_date
        if ($endDate->lt($startDate)) {
            return redirect()->back()->with('error', 'End date cannot be earlier than start date.');
        }

        // Hitung jumlah bulan penuh di antara dua tanggal
        $totalMonths = $startDate->copy()->endOfMonth()->diffInMonths($endDate->startOfMonth()) + 1;

        // Hitung total_iuran
        $totalIuran = $totalMonths * $property->rental_price;

        // Buat lease baru

        $capacity = Property::find($request->property_id)->capacity;

        if (Lease::where('property_id', $request->property_id)->where('status', 'active')->count() < $capacity) {

            if (Lease::where('property_id', $request->property_id)->where('status', 'active')->count() == ($capacity - 1)) {
                $property = Property::find($request->property_id);
                $property->update(['status' => 'full']);
            } else {
                $property = Property::find($request->property_id);
                $property->update(['status' => 'available']);
            }
            Lease::create([
                'user_id' => $request->user_id,
                'property_id' => $request->property_id,
                'start_date' => $startDate->format('Y-m-d'),
                'end_date' => $endDate->format('Y-m-d'),
                'description' => $request->description,
                'total_iuran' => number_format($totalIuran, 2, '.', ''), // Format dengan dua desimal
            ]);


            return redirect()->route('leases.index')->with('success', 'Lease successfully added.');
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

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLeaseRequest $request, Lease $lease)
    {
        // Ambil property berdasarkan property_id dari lease yang sedang diperbarui
        $property = Property::find($request->property_id);

        if (!$property) {
            return redirect()->route('leases.index')->with('error', 'Property not found.');
        }

        // Menggunakan Carbon untuk menangani tanggal
        $startDate = \Carbon\Carbon::parse($request->start_date);
        $endDate = \Carbon\Carbon::parse($request->end_date);

        // Cek apakah end_date lebih awal dari start_date
        if ($endDate->lt($startDate)) {
            return redirect()->back()->with('error', 'End date cannot be earlier than start date.');
        }

        // Hitung jumlah bulan penuh di antara dua tanggal
        $totalMonths = $startDate->copy()->endOfMonth()->diffInMonths($endDate->startOfMonth()) + 1;

        // Hitung total_iuran
        $totalIuran = $totalMonths * $property->rental_price;

        // Update lease dengan nilai yang baru
        $lease->update([
            'user_id' => $request->user_id,
            'property_id' => $request->property_id,
            'start_date' => $startDate->format('Y-m-d'),
            'end_date' => $endDate->format('Y-m-d'),
            'status' => $request->status,
            'description' => $request->description,
            'total_iuran' => number_format($totalIuran, 2, '.', ''), // Format dengan dua desimal
        ]);

        return redirect()->route('leases.index')->with('success', 'Lease successfully updated.');
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
