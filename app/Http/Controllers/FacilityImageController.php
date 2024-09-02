<?php

namespace App\Http\Controllers;

use App\Models\FacilityImage;
use Illuminate\Http\Request;

class FacilityImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

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
    public function store(Request $request)
    {
        $photo = $request->images;
        $photoPath = $photo->store('facility_detail_photos', 'public');

        FacilityImage::create([
            'facility_id'=>$request->facility_id,
            'property_id'=>$request->property_id,
            'image'=> $photoPath,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(FacilityImage $facilityImage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FacilityImage $facilityImage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FacilityImage $facilityImage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FacilityImage $facilityImage)
    {
        // Get the image path
        $imagePath = storage_path('public/' . $facilityImage->image);

        // Check if the image file exists and delete it
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }

        // Delete the record from the database
        $facilityImage->delete();

        // Redirect or return a response
        return redirect()->back()->with('success', 'Gambar berhasil dihapus.');
    }

}
