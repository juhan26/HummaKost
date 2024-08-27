<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePropertyRequest;
use App\Http\Requests\UpdatePropertyRequest;
use App\Models\Facility;
use App\Models\Lease;
use App\Models\Property;
use App\Models\PropertyFacility;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->input('search')) {
            $properties = Property::with('property_images')->where('name', 'LIKE', "%{$request->input('search')}%")
                ->orWhere('description', 'LIKE', "%($request->input('search'))%")
                ->paginate(6);
        } else {
            $properties = Property::orderByRaw("CASE WHEN status = 'available' THEN 1 ELSE 0 END")->latest()->paginate(6);
        }

        $properties->appends([
            'search' => $request->search
        ]);

        return view('pages.properties.index', compact('properties',));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $facilities = Facility::all();
        return view('pages.properties.create', compact('facilities'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePropertyRequest $request)
    {
        $facilities = $request->facility_id;
        if ($request->image) {
            $imagePath = $request->image->store('propertyImages', 'public');
            $property = Property::create([
                'name' => $request->name,
                'image' => $imagePath,
                'rental_price' => $request->rental_price,
                'description' => $request->description,
                'address' => $request->address,
                'capacity' => $request->capacity,
                'gender_target' => $request->gender_target,
                'langtitude' => $request->langtitude,
                'longtitude' => $request->longtitude,
            ]);
        } else {
            $property = Property::create([
                'name' => $request->name,
                'rental_price' => $request->rental_price,
                'description' => $request->description,
                'address' => $request->address,
                'capacity' => $request->capacity,
                'gender_target' => $request->gender_target,
                'langtitude' => $request->langtitude,
                'longtitude' => $request->longtitude,
            ]);
        }

        if ($facilities) {
            foreach ($facilities as $facility) {
                $property->facilities()->attach($facility);
            }
        }

        return redirect()->route('properties.index')->with('success', 'data berhasil disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Property $property)
    {
        $users = User::orWhereDoesntHave('lease')
            ->where(function ($query) {
                $query->whereHas('roles', function ($query) {
                    $query->where('name', 'tenant');
                });
            })->where('status', 'accepted')
            ->latest()
            ->get();
        $addUserPropertyLeader = Lease::where('property_id', $property->id)->get();
        $editUserPropertyLeader = Lease::where('property_id', $property->id)->whereHas('user', function ($query) {
            $query->whereDoesntHave('roles', function ($query) {
                $query->where('name', 'admin');
            });
        })->get();

        $properties = Property::all();
        return view('pages.properties.detail', compact('property', 'properties', 'users', 'addUserPropertyLeader', 'editUserPropertyLeader'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Property $property)
    {
        $facilities = Facility::all();
        $selectedFacility = $property->facilities->pluck('id')->toArray();
        return view('pages.properties.edit', compact('property', 'facilities', 'selectedFacility'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePropertyRequest $request, Property $property)
    {
        $facilities = $request->facility_id;

        if ($request->capacity < $property->leases->count()) {
            return redirect()->route('properties.edit', $property->id)->with('error', 'Jumlah kapasitas yang anda masukkan kurang dari yang jumlah orang yang terdapat di dalam kontrakan.');
        } else {
            if ($request->image) {

                if ($property->image) {
                    Storage::delete('public/' . $property->image);
                }

                $newImage = $request->image->store('propertyImages', 'public');

                $property->update([
                    'name' => $request->name,
                    'image' => $newImage,
                    'rental_price' => $request->rental_price,
                    'description' => $request->description,
                    'address' => $request->address,
                    'capacity' => $request->capacity,
                    'gender_target' => $request->gender_target,
                    'langtitude' => $request->langtitude,
                    'longtitude' => $request->longtitude,
                ]);
            } else {
                $property->update([
                    'name' => $request->name,
                    'rental_price' => $request->rental_price,
                    'description' => $request->description,
                    'address' => $request->address,
                    'capacity' => $request->capacity,
                    'gender_target' => $request->gender_target,
                    'langtitude' => $request->langtitude,
                    'longtitude' => $request->longtitude,
                ]);
            }

            if ($facilities) {
                $property->facilities()->sync($facilities);
            }

            return redirect()->route('properties.index')->with('success', 'Data berhasil diubah');
        }
    }

    public function addPropertyLeader(Request $request)
    {
        $user = User::find($request->user_id);
        $user->removeRole('tenant');
        $user->assignRole('admin');

        return redirect()->back()->with('success', 'Berhasil Menambah Ketua Kontrakan');
    }

    public function editPropertyLeader(Request $request, Property $property)
    {

        $lastLeader = $property->leases()->whereHas('user.roles', function ($query) {
            $query->where('name', 'admin');
        })->first();

        if ($lastLeader) {
            $lastLeader->user->removeRole('admin');
            $lastLeader->user->assignRole('tenant');
        }

        $newLeader = User::find($request->user_id);
        $newLeader->removeRole('tenant');
        $newLeader->assignRole('admin');


        return redirect()->back()->with('success', 'Berhasil Mengubah Ketua Kontrakan');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Property $property)
    {
        try {
            $property->delete();
            return redirect()->route('properties.index')->with('success', 'Data Kontrakan berhasil di hapus');
        } catch (QueryException $e) {
            return redirect()->route('properties.index')->with('error', 'Tidak dapat menghapus data kontrakan, karena data ini sedang digunakan dalam kontrak');
        }
    }
}
