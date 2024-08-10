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

        if ($request->search) {
            $users = User::where('name', 'LIKE', "%$request->input('search')%")
                ->orWhere('email', 'LIKE', "%{$request->input('search')}%")
                ->paginate(10);
        } else {
            if (Auth::user()->hasRole('super_admin')) {
                $users = User::where('id', '!=', Auth::user()->id)->latest()->paginate(10);
            } else if (Auth::user()->hasRole('admin')) {
                $users = User::whereHas('roles', function ($query) {
                    $query->where('name', 'member');
                })->orWhereHas('roles', function ($query) {
                    $query->where('name', 'admin');
                })->latest()->paginate(10);
            } else if (Auth::User()->hasRole('member')) {
                $users = User::role('member')->latest()->paginate(10);
            }
        }
        return view('pages.users.index', compact('users'));
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
