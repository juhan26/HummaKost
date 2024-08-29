<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use App\Models\Instance;
use App\Models\Lease;
use App\Models\Property;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $instanceCount = Instance::count();
        $usersCount = User::count();
        $leasesCount = Lease::count();
        $facilityCount = Facility::count();

        $properties = Property::with(['leases' => function ($query) {
            $query->selectRaw('property_id, MONTH(created_at) as month, COUNT(*) as total')
                ->groupBy('property_id', 'month')
                ->orderBy('month');
        }])->get();

        $leasesPerMonth = [];

        foreach ($properties as $property) {
            $data = array_fill(0, 12, 0);

            foreach ($property->leases as $lease) {
                $data[$lease->month - 1] = $lease->total;
            }

            $leasesPerMonth[] = [
                'name' => $property->name,
                'data' => $data,
            ];
        }
        $properties = Property::all();

        $users = User::whereDoesntHave('roles', function ($query) {
            $query->where('name', 'super_admin');
        })->get();

        return view('pages.dashboard.index', compact('leasesPerMonth', 'properties', 'propertiesCount', 'usersCount', 'leasesCount', 'facilityCount', 'instanceCount', 'users'));
    }
}
