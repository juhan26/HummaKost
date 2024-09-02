<?php

namespace App\Http\Controllers;

use App\Models\PropertyImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PropertyImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $photoPath = $photo->store('property_detail_photos', 'public');

        PropertyImage::create([
            'property_id'=>$request->property_id,
            'image'=> $photoPath,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(PropertyImage $propertyImage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PropertyImage $propertyImage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PropertyImage $propertyImage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PropertyImage $propertyImage)
    {
        //
    }

    public function destroySelected(Request $request)
{
    // Validasi input untuk memastikan bahwa ada gambar yang dipilih
    $request->validate([
        'images_to_delete' => 'required|array',
        'images_to_delete.*' => 'exists:property_images,id',
    ]);

    // Ambil ID gambar yang akan dihapus
    $imageIds = $request->input('images_to_delete');

    // Hapus gambar dari storage dan database
    foreach ($imageIds as $id) {
        $image = PropertyImage::findOrFail($id);
        Storage::disk('public')->delete($id); // Hapus file gambar dari storage
        $image->delete(); // Hapus record dari database
    }

    // Redirect kembali dengan pesan sukses
    return redirect()->back()->with('success', 'Gambar terpilih berhasil dihapus.');
}

}
