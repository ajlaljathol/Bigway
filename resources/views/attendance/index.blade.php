@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Attendance Records</h1>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if ($attendances->isEmpty())
            <div class="alert alert-info">No attendance records found.</div>
        @else
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Vehicle</th>
                        <th>Total Students</th>
                        <th>Present</th>
                        <th>Absent</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($attendances as $group => $records)
                        @php
                            $presentCount = $records->where('status', 'present')->count();
                            $absentCount = $records->where('status', 'absent')->count();
                            $total = $records->count();
                            $date = $records->first()->date;
                            $vehicle = $records->first()->vehicle;
                        @endphp
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($date)->format('d M, Y') }}</td>
                            <td>{{ $vehicle->reg_number ?? 'N/A' }} ({{ $vehicle->vehicle_type ?? '-' }})</td>
                            <td>{{ $total }}</td>
                            <td>{{ $presentCount }}</td>
                            <td>{{ $absentCount }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
