<?php

namespace App\Http\Controllers;

use App\Models\Facility;
<<<<<<< HEAD
use App\Models\Furniture;
=======
>>>>>>> dd757a4a36ae7b1f44d56db864c9fd960107ad66
use App\Models\Lease;
use App\Models\Property;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $propertiesCount = Property::count();
        $usersCount = User::count();
        $leasesCount = Lease::count();
        $facilityCount = Facility::count();

        return view('pages.dashboard.index', compact('propertiesCount', 'usersCount', 'leasesCount', 'facilityCount'));
    }
}
