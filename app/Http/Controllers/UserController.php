<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Instance;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = User::query();
        $cari = 0;

        // Apply filter if specified
        if ($request->has('filter')) {
            $filter = $request->input('filter');
            $query->whereHas('roles', function ($query) use ($filter) {
                $query->where('name', $filter);
            });
        } elseif ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($query) use ($search) {
                $query->where('name', 'LIKE', "%$search%")
                    ->orWhere('email', 'LIKE', "%$search%");
            })->whereHas('roles', function ($query) {
                $query->where('name', 'tenant')
                    ->orWhere('name', 'admin');
            });
            $cari = 1;
        }
        // Apply role-based filtering
        else {
            if (!Auth::user()->hasRole('tenant')) {
                $query->whereHas('roles', function ($query) {
                    $query->where('name', 'tenant');
                })->where('id', '!=', Auth::user()->id);
            }
            //  elseif (Auth::user()->hasRole('member')) {
            //     $query->role('member');
            // }
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
            ->Paginate(5);

        $instances = Instance::orderBy('name', 'ASC')->get();
        // Return view with users data
        return view('pages.users.index', compact('users', 'cari', 'instances'));
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
        $user->update($request->all());
        return redirect()->route('user.index')->with('success', 'Pengguna berhasil di ubah');
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
            if ($e->getCode() === '23000') {
                return redirect()->route('user.index')->with('error', 'Tidak dapat menghapus pengguna ini karena data memiliki data terkait di tabel lain');
            }
        }
    }
}
