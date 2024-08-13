<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
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
        }
        elseif ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($query) use ($search) {
                $query->where('name', 'LIKE', "%$search%")
                    ->orWhere('email', 'LIKE', "%$search%");
            })->whereHas('roles', function ($query) {
                $query->where('name', 'member')
                ->orWhere('name', 'admin');
            });
            $cari = 1;
        }
        // Apply role-based filtering
        else {
            if (!Auth::user()->hasRole('member')) {
                $query->whereHas('roles', function ($query) {
                    $query->where('name', 'member');
                })->where('id','!=',Auth::user()->id);
            }
            //  elseif (Auth::user()->hasRole('member')) {
            //     $query->role('member');
            // }
        }

        // Get paginated users
        $users = $query->latest()->paginate(3);

        // Return view with users data
        return view('pages.users.index', compact('users','cari'));
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
        //$income->status = 'Diterima';

        $user->update(['status'=>'accepted']);
        $user->save();
        return redirect()->route('user.index')->with('success', 'Penyewa telah di konfirmasi');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $imagePath = $request->photo->store('photos', 'public');

        User::create([
            'photo' => $imagePath,
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'password' =>  bcrypt($request->password), // Hash the password before storing it
        ])->assignRole('member');
        return redirect()->route('user.index')->with('success', 'User Added Success');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
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
        return redirect()->route('user.index')->with('success', 'User Updated Success');
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
            return redirect()->route('user.index')->with('success', 'User Deleted Success');
        } catch (\Exception $e) {
            if ($e->getCode() === '23000') {
                return redirect()->route('user.index')->with('error', 'Cannot delete this user because he/she has related data in other tables');
            }
        }
    }
}
