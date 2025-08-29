@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Attendance Details</h1>

        {{-- Attendance Info --}}
        <div class="card mb-3">
            <div class="card-header">
                Vehicle: {{ $attendance->vehicle->reg_number ?? 'N/A' }}
                ({{ $attendance->vehicle->vehicle_type ?? 'N/A' }})
            </div>
            <div class="card-body">
                <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($attendance->date)->format('d-m-Y') }}</p>
                <p><strong>Home Pickup:</strong> {{ $attendance->home_pickup ?? 'N/A' }}</p>
                <p><strong>School Pickup:</strong> {{ $attendance->school_pickup ?? 'N/A' }}</p>
                <p><strong>Home Drop:</strong> {{ $attendance->home_drop ?? 'N/A' }}</p>
                <p><strong>School Drop:</strong> {{ $attendance->school_drop ?? 'N/A' }}</p>
            </div>
        </div>

        {{-- Students Attendance --}}
        <div class="card">
            <div class="card-header">Students Attendance</div>
            <div class="card-body">
                @if ($attendance->students && $attendance->students->count() > 0)
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Student Name</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($attendance->students as $index => $student)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $student->name ?? 'N/A' }}</td>
                                    <td>
                                        @if ($student->pivot && $student->pivot->status === 'present')
                                            <span class="badge bg-success">Present</span>
                                        @elseif ($student->pivot && $student->pivot->status === 'absent')
                                            <span class="badge bg-danger">Absent</span>
                                        @else
                                            <span class="badge bg-secondary">Not Marked</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p>No students found for this attendance.</p>
                @endif
            </div>
        </div>

        <a href="{{ route('attendance.index') }}" class="btn btn-secondary mt-3">Back to Attendance</a>
    </div>
@endsection
