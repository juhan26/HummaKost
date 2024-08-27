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
        $search = $request->input('search');
        $gender = $request->input('gender');
        $price_range = $request->input('price_range');
        $sort = $request->input('sort');
        $availability = $request->input('availability');

        if ($search || $gender || $availability || $price_range || $sort) {
        
            $query->where(function ($query) use ($search) {
                $query->where('name', 'LIKE', "%{$search}%");
            })->where(function ($query) use ($gender) {
                if ($gender !== 'all') {
                    $query->where('gender_target', $gender);
                }
            })->where(function ($query) use ($availability) {
                if ($availability !== 'all') {
                    $query->where('status', $availability);
                } else if ($availability == 'available') {
                    $query->where('status', $availability);
                } else if ($availability == 'full') {
                    $query->where('status', $availability);
                }
            })->where(function ($query) use ($price_range) {
                switch ($price_range) {
                    case '0-300':
                        $query->whereBetween('rental_price', [0, 300000]);
                        break;
                    case '301-700':
                        $query->whereBetween('rental_price', [300001, 700000]);
                        break;
                    case '701-1500':
                        $query->whereBetween('rental_price', [700001, 1500000]);
                        break;
                }
            })->where(function ($query) use ($sort) {
                if ( $sort === 'newest') {
                    $query->orderBy('created_at', 'desc');
                } elseif ($sort === 'oldest') {
                    $query->orderBy('created_at', 'asc');
                } 
            });
            
        }



        // Sorting by price (ascending order)
        

        // Pagination
        $properties = $query->paginate(6);

        // Append all query parameters to pagination links
        $properties->appends([
            'search' => $request->input('search'),
            'gender' => $request->input('gender'),
            'availability' => $request->input('availability'),
            'sort' => $request->input('sort'),
            'price_range' => $request->input('price_range'),
        ]);

        // Return view with filtered properties
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
