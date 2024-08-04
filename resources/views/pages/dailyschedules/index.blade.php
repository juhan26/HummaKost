<!-- resources/views/dailyschedules/index.blade.php -->

@extends('app')

@section('content')
    <!-- Form untuk menghasilkan jadwal acak -->
    <form action="{{ route('dailyschedule.random') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-primary mb-4">Randomize Schedule</button>
    </form>

    <!-- Menampilkan jadwal piket -->
    <div class="container">
        @if (isset($schedules) && $schedules->isNotEmpty())
            @foreach ($schedules as $day => $tasks)
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">{{ $day }}</h5>
                    </div>
                    <div class="card-body">
                        @if ($tasks->isNotEmpty())
                            <ul class="list-group">
                                @foreach ($tasks as $task)
                                    <li class="list-group-item">
                                        <strong>{{ $task['user_name'] }}:</strong> {{ $task['task'] }}
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-muted">No tasks scheduled for this day.</p>
                        @endif
                    </div>
                </div>
            @endforeach
        @else
            <p>No schedules available. Please generate a schedule.</p>
        @endif
    </div>
@endsection
