<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFacilityRequest;
use App\Http\Requests\UpdateFacilityRequest;
use App\Models\Facility;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FacilityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->search) {
            $facilities = Facility::where('name', 'LIKE', "%" . $request->search . "%")->paginate(6);
        } else {
            $facilities = Facility::latest()->paginate(6);
        }
        return view('pages.facilities.index', compact('facilities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.facilities.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFacilityRequest $request)
    {
        if ($request->photo) {
            $photoPath = $request->photo->store('facility_photos', 'public');
            Facility::create([
                'photo' => $photoPath,
                'name' => $request->name,
                'description' => $request->description,
            ]);
        } else {
            Facility::create([
                'name' => $request->name,
                'description' => $request->description,
            ]);
        }
        return redirect()->route('facilities.index')->with('success', "Berhasil Menambah Fasilitas");
    }
    public function upload(Request $request)
    {
        $photo = $request->file('photo');
        $imageName = time() . rand(1, 100) . '.' . $photo->extension();
        $photo->move(public_path('images'), $imageName);
        return response()->json(['success' => $imageName]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Facility $facility)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Facility $facility)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFacilityRequest $request, Facility $facility)
    {
        if ($request->photo) {

            if ($facility->photo) {
                Storage::delete('public/' . $facility->photo);
            }

            $newPhoto = $request->photo->store('facility_photos', 'public');

            $facility->update([
                'photo' => $newPhoto,
                'name' => $request->name,
                'description' => $request->description,
            ]);
        } else {
            $facility->update([
                'name' => $request->name,
                'description' => $request->description,
            ]);
        }
        return redirect()->route('facilities.index')->with('success', "Berhasil Mengubah Fasilitas");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Facility $facility)
    {
        try {
            if ($facility->photo) {
                Storage::delete('public/' . $facility->photo);
            }
            $facility->delete();
            return redirect()->route('facilities.index')->with('success', "Berhasil Menghapus Fasilitas");
        } catch (QueryException $e) {
            return redirect()->route('facilities.index')->with('error', "Tidak dapat menghapus fasilitas ini karena sedang digunakan di kontrakan");
        }
    }
}
