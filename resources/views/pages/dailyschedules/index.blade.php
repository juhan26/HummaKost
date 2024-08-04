    <!-- resources/views/financials/index.blade.php -->

    @extends('app')

    @section('content')
        <form action="{{ route('dailyschedule.random') }}" method="POST">
            @csrf
            <button type="submit">Random Schedule</button>
        </form>
    @endsection
