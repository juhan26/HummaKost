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
    
        // Applying filters using when
        $query->when($search, function ($query, $search) {
            $query->where('name', 'LIKE', "%{$search}%");
        })
        ->when($gender && $gender !== 'all', function ($query) use ($gender) {
            $query->where('gender_target', $gender);
        })
        ->when($availability && $availability !== 'all', function ($query) use ($availability) {
            $query->where('status', $availability);
        })
        ->when($price_range, function ($query) use ($price_range) {
            $query->whereBetween('rental_price', [0, $price_range]);
        });
    
        // Sorting by status (available first, then full)
        $query->orderByRaw("FIELD(status, 'available', 'full') ASC");
    
        // Additional sorting by date if provided
        $query->when($sort, function ($query) use ($sort) {
            if ($sort === 'newest') {
                $query->orderBy('created_at', 'desc');
            } elseif ($sort === 'oldest') {
                $query->orderBy('created_at', 'asc');
            }
        });
    
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
        return view('landing.properties.index', compact('properties', 'price_range'));
    }
    




    public function index(Request $request, User $user)
    {
        // Ambil property_id yang dipilih dari query string
        $properties = Property::latest()->paginate(6);
    
        $selectedPropertyId = $request->input('property_id', $properties->first()->id ?? null);
    
        // Query untuk leases berdasarkan property_id yang dipilih
        $leasesQuery = Lease::query();
        if ($selectedPropertyId) {
            $leasesQuery->where('property_id', $selectedPropertyId);
        }
        $leases = $leasesQuery->with('user')->get();
    
        // Ambil pengguna berdasarkan property_id yang dipilih dari leases
        $userIds = $leases->pluck('user.id')->unique();
        $users = User::whereIn('id', $userIds)->role('tenant')->latest()->get();
    
        $facilities = Facility::all();
        $feedbacks = Feedback::with('user')->get();
    
        // Cek apakah user sudah memberikan feedback untuk properti ini
        // $existingFeedback = Feedback::where('user_id', $user->id)
        //                             ->where('property_id', $selectedPropertyId)
        //                             ->first();
        
        // if ($existingFeedback) {
        //     return redirect()->back()->with('error', 'Anda sudah memberikan feedback untuk properti ini.');
        // }
    
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
