<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use App\Models\Feedback;
use App\Models\Furniture;
use App\Models\Lease;
use App\Models\Property;
use App\Models\User;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    // app/Http/Controllers/YourController.php
    // app/Http/Controllers/YourController.php

    public function home(Request $request)
    {
        $query = Property::with('property_images');

        if ($request->input('search')) {
            $query->where('name', 'LIKE', "%{$request->input('search')}%")
            ->orWhere('description', 'LIKE', "%{$request->input('search')}%");
        }

        if ($request->input('gender')) {
            $gender = $request->input('gender');
            if ($gender !== 'all') {
                $query->where('gender_target', $gender);
            }
        }

        $properties = $query->latest()->paginate(6);

        $properties->appends([
            'search' => $request->input('search'),
            'gender' => $request->input('gender'),
        ]);

        return view('landing.properties.index', compact('properties'));
    }



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
        $leases = $leasesQuery->with('user')->get();

        // Ambil pengguna berdasarkan property_id yang dipilih dari le  ases
        $userIds = $leases->pluck('user.id')->unique();
        $users = User::whereIn('id', $userIds)->role('tenant')->latest()->get();

        $facilities = Facility::all();
        $feedbacks = Feedback::with('user')->get();


        // Kirim data ke view
        return view('landing.index', compact('facilities', 'leases', 'properties', 'users', 'selectedPropertyId', 'feedbacks'));
    }



    public function show($id)
    {
        // Ambil data properti berdasarkan ID dan muat lease serta pengguna yang terkait
        $property = Property::with('leases.user')->findOrFail($id);
        // dd($property);
        $properties = Property::all();
        // Ambil semua pengguna
        $leases = Lease::all();

        $userIds = $leases->pluck('user.id')->unique();
        $users = User::whereIn('id', $userIds)->role('tenant')->latest()->get();


        // Kembalikan view dengan data yang dibutuhkan
        return view('landing.properties.show', compact('property', 'properties', 'users', 'leases'));
    }
}
