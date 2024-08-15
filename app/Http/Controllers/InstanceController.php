<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInstanceRequest;
use App\Http\Requests\StoreIntanceRequest;
use App\Http\Requests\UpdateInstanceRequest;
use App\Http\Requests\UpdateIntanceRequest;
use App\Models\Instance;
use Illuminate\Http\Request;

class InstanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $instances = Instance::where('name','LIKE',"%$request->search%")->paginate(5);
        return view('pages.instance.index', compact('instances'));
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
    public function store(StoreInstanceRequest $request)
    {
        $instance = Instance::create([
            'name' => $request->name,
            'address' => $request->address,
            'description' => $request->description
        ]);

        return back()->with('success', 'data berhasil disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Instance $instance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Instance $instance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInstanceRequest $request, Instance $instance)
    {
        $instance->update([
            'name' => $request->name,
            'address' => $request->address,
            'description' => $request->description,
        ]);
        return back()->with('success', 'data berhasil disimpan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Instance $instance)
    {
        try {
            $instance->delete();
            return back()->with('success', 'Kontrak berhasil dihapus');
        } catch (\Exception $e) {
            // Cek kode kesalahan 23000 untuk constraint violation (misalnya, foreign key constraint)
            if ($e->getCode() === '23000') {
                return back()->with('error', 'Tidak dapat menghapus kontrak ini karena data memiliki keterkaitan di tabel lain');
            }
            // Tangani exception lain yang mungkin tidak terduga
            return back()->with('error', 'Terjadi kesalahan saat menghapus kontrak');
        }
    }
}
