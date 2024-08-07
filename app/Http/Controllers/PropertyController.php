<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePropertyRequest;
use App\Http\Requests\UpdatePropertyRequest;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $properties = Property::latest()->paginate(10);
        return view('pages.properties.index', compact('properties'));
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
    public function store(StorePropertyRequest $request)
    {
        if ($request->image) {
            $imagePath = $request->image->store('propertyImages', 'public');
            Property::create([
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
            Property::create([
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

        return redirect()->route('properties.index')->with('success', 'data berhasil disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Property $property)
    {
        return view('pages.properties.detail', compact('property'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Property $property)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePropertyRequest $request, Property $property)
    {
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

        return redirect()->route('properties.index')->with('success', 'data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Property $property)
    {
        $property->delete();
        return redirect()->route('properties.index')->with('success', 'Success Deleted Property');
    }
}
