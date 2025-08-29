@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Student Details</h1>

    {{-- Search Bar --}}
    <form action="{{ route('students.index') }}" method="GET" class="mb-4">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Search by name..." value="{{ request('search') }}">
            <button class="btn btn-primary" type="submit">Search</button>
        </div>
    </form>

    @if(isset($students) && $students->count())
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Age</th>
                    <th>Emergency Contact</th>
                    <th>Blood Group</th>
                    <th>Address</th>
                    <th>Guardian</th>
                    <th>School</th>
                    <th>Vehicle</th>
                    <th>Route</th>
                </tr>
            </thead>
            <tbody>
                @foreach($students as $student)
                <tr>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->age }}</td>
                    <td>{{ $student->emerg_contact }}</td>
                    <td>{{ $student->blood_grp }}</td>
                    <td>{{ $student->address }}</td>
                    <td>{{ $student->guardian->name ?? 'N/A' }}</td>
                    <td>{{ $student->school->name ?? 'N/A' }}</td>
                    <td>{{ $student->vehicle->name ?? 'N/A' }}</td>
                    <td>{{ $student->route->name ?? 'N/A' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @elseif(isset($student))
        {{-- Single student view --}}
        <div class="card">
            <div class="card-header">
                {{ $student->name }}
            </div>
            <div class="card-body">
                <p><strong>Age:</strong> {{ $student->age }}</p>
                <p><strong>Emergency Contact:</strong> {{ $student->emerg_contact }}</p>
                <p><strong>Blood Group:</strong> {{ $student->blood_grp }}</p>
                <p><strong>Address:</strong> {{ $student->address }}</p>
                <p><strong>Guardian:</strong> {{ $student->guardian->name ?? 'N/A' }}</p>
                <p><strong>School:</strong> {{ $student->school->name ?? 'N/A' }}</p>
                <p><strong>Vehicle:</strong> {{ $student->vehicle->name ?? 'N/A' }}</p>
                <p><strong>Route:</strong> {{ $student->route->name ?? 'N/A' }}</p>
            </div>
        </div>
    @else
        <p>No students found.</p>
    @endif
</div>
@endsection
