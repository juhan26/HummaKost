<?php

namespace App\Http\Controllers;

use App\Models\Furniture;
use App\Models\Lease;
use App\Models\Property;
use App\Models\User;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    // app/Http/Controllers/YourController.php
    // app/Http/Controllers/YourController.php
    public function index(Request $request)
    {
        // Ambil property_id yang dipilih dari query string
        $properties = Property::latest()->paginate(6);

        $selectedPropertyId = $request->input('property_id', $properties->first()->id ?? null);

        // Ambil semua properti dengan pagination
        
        // Query untuk leases berdasarkan property_id yang dipilih
        $leasesQuery = Lease::query();
        if ($selectedPropertyId) {
            $leasesQuery->where('property_id', $selectedPropertyId);
        }
        // Muat relasi 'users' dengan leases
        $leases = $leasesQuery->with('users')->get();

        // Ambil pengguna berdasarkan property_id yang dipilih dari le  ases
        $userIds = $leases->pluck('users.id')->unique();
        $users = User::whereIn('id', $userIds)->role('member')->latest()->get();

        $furnitures = Furniture::all();

        // Kirim data ke view
        return view('landing.index', compact('furnitures', 'leases', 'properties', 'users', 'selectedPropertyId'));
    }



    public function show($id)
    {
        $leases = Lease::with('users')->get();

        $users = User::all();
        $property = Property::findOrFail($id);
        return view('landing.properties.show', compact('property', 'users', 'leases'));
    }
}
