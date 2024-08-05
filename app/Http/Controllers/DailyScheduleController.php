<?php

namespace App\Http\Controllers;

use App\Models\DailySchedule;
use App\Models\User;
use Illuminate\Http\Request;

class DailyScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mengambil semua jadwal dan mengelompokkan berdasarkan hari
        $schedules = DailySchedule::with('users')->get()->groupBy('day');

        // Mengubah koleksi menjadi format yang sesuai untuk tampilan
        $formattedSchedules = $schedules->mapWithKeys(function ($items, $day) {
            return [
                $day => $items->map(function ($item) {
                    return [
                        'user_name' => $item->users->name, // Mengambil nama pengguna
                        'task' => $item->task,
                    ];
                })
            ];
        });

        return view('pages.dailyschedules.index', ['schedules' => $formattedSchedules]);
    }


    // app/Http/Controllers/DailyScheduleController.php



    public function random()
    {
        // Mengambil pengguna yang tidak memiliki peran 'super_admin'
        $users = User::role('super_admin')->get(); // Mengambil semua pengguna dengan peran 'super_admin'

        // Ambil semua pengguna kecuali yang dengan peran 'super_admin'
        $users = User::whereDoesntHave('roles', function ($query) {
            $query->where('name', 'super_admin');
        })->get();

        $tasks = ['Masak', 'Cuci Piring', 'Belanja', 'Turu'];
        $days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'];

        DailySchedule::truncate();

        $schedules = [];
        $taskPerUser = ceil(count($users) / count($tasks));

        foreach ($days as $day) {
            $shuffledUsers = collect($users)->shuffle();
            $defaultShuffle = collect($tasks)->shuffle();
            $shuffledTasks = clone $defaultShuffle;

            $dailyTasks = [];
            foreach ($shuffledUsers as $index => $user) {
                if ($shuffledTasks->isEmpty()) {
                    $shuffledTasks = clone $defaultShuffle;
                }

                $task = $shuffledTasks->pop();

                $dailyTasks[] = [
                    'user_id' => $user->id,
                    'task' => $task,
                    'day' => $day,
                    'user_name' => $user->name, // Menyertakan nama pengguna
                ];
            }

            $schedules[$day] = $dailyTasks;
        }

        foreach ($schedules as $day => $tasks) {
            foreach ($tasks as $task) {
                DailySchedule::create($task);
            }
        }

        return redirect()->route('dailyschedule.index')->with('success', 'Jadwal piket berhasil diacak dan disimpan');
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(DailySchedule $dailySchedule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DailySchedule $dailySchedule)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DailySchedule $dailySchedule)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DailySchedule $dailySchedule)
    {
        //
    }
}
