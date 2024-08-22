<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Instance;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = User::query();
        $search = $request->input('search');
        $status = $request->input('status', []);

        if ($request->has('filter') || $request->has('search') || $request->has('status')) {
            $filter = $request->input('filter');
            $query->whereHas('roles', function ($query) use ($filter) {
                $query->where('name', $filter);
            })->where(function ($query) use ($search) {
                $query->where('name', 'LIKE', "%$search%")
                    ->orWhere('email', 'LIKE', "%$search%");
            })->where(function ($query) use ($status) {
                if (!empty($status)) {
                    $query->whereIn('status', $status);
                }
            })->whereHas('roles', function ($query) {
                $query->where('name', 'tenant')
                    ->orWhere('name', 'admin');
            });
        } else {
            if (!Auth::user()->hasRole('tenant')) {
                $query->whereHas('roles', function ($query) {
                    $query->where('name', 'tenant');
                })->where('id', '!=', Auth::user()->id);
            }
        }

        // Get paginated users
        $users = $query->orderByRaw("
        CASE
            WHEN status = 'pending' THEN 1
            WHEN status = 'rejected' THEN 2
            WHEN status = 'accepted' THEN 3
            ELSE 4
        END
    ")
            ->latest()
            ->paginate(10);

        $instances = Instance::orderBy('name', 'ASC')->get();

        // Pass the status filter to the view
        $isStatusFiltered = !empty($status);
        // Return view with users data
        return view('pages.users.index', compact('users', 'instances', 'status', 'isStatusFiltered'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }
    public function accept(User $user)
    {
        $user->update(['status' => 'accepted']);
        $user->save();
        return redirect()->route('user.index')->with('success', 'Penyewa telah di konfirmasi');
    }
    public function reject(User $user)
    {
        $user->status = 'rejected';
        $user->save();
        return redirect()->route('user.index')->with('success', 'Penyewa telah berhasil ditolak');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        // dd($request->instance_id);
        if ($request->photo) {

            $imagePath = $request->photo->store('photos', 'public');
            User::create([
                'photo' => $imagePath,
                'gender' => $request->gender,
                'name' => $request->name,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'instance_id' => $request->instance_id,
                'status' => 'accepted',
                'password' =>  bcrypt('Tenant2024'), // Hash the password before storing it
            ])->assignRole('tenant');
        } else
            User::create([
                'gender' => $request->gender,
                'name' => $request->name,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'instance_id' => $request->instance_id,
                'status' => 'accepted',
                'password' =>  bcrypt('Tenant2024'), // Hash the password before storing it
            ])->assignRole('tenant');
        return redirect()->route('user.index')->with('success', 'Pengguna berhasil di tambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        if (Auth::user()->id !== $user->id) {
            return redirect()->route('user.index')->with('error', 'Anda tidak memiliki akses ke halaman ini');
        }

        // Mengambil data instance untuk dropdown atau pilihan lainnya
        $instances = Instance::orderBy('name', 'ASC')->get();

        // Mengirim data pengguna dan instance ke view
        return view('landing.users.show', compact('user', 'instances'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'instance_id' => $request->instance_id,
            'gender' => $request->gender,
        ]);

        return redirect()->route('user.index')->with('success', 'Pengguna berhasil diubah');
    }


    public function deletePropertyLeader(User $user)
     {

        $lastLeader = $user->lease()->whereHas('user.roles', function ($query) {
            $query->where('name', 'admin');
        })->first();

        if ($lastLeader) {
            $lastLeader->user->removeRole('admin');
            $lastLeader->user->assignRole('tenant');
        }
        return redirect()->route('user.index')->with('success', 'Berhasil memberhentikan Ketua Kontrakan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        try {
            if ($user->photo) {
                Storage::disk('public')->delete($user->photo);
            }
            $user->delete();
            return redirect()->route('user.index')->with('success', 'Pengguna berhasil di hapus');
        } catch (\Exception $e) {
            $user->assignRole('tenant');
            return redirect()->route('user.index')->with('error', 'Tidak dapat menghapus pengguna ini karena pengguna memiliki kontrak');
        }
    }
}
