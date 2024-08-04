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
        $schedules = DailySchedule::all();
        return view('pages.dailyschedules.index', compact('schedules'));
    }

    public function random()
    {

        $users = User::all();
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
                    'day' => $day
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
