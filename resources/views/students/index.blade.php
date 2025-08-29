@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Students</h1>

        <a href="{{ route('students.create') }}" class="btn btn-primary mb-3">Add Student</a>

        @if ($students->count() > 0)
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Emergency Contact</th>
                        <th>Blood Group</th>
                        <th>Address</th>
                        <th>Guardian</th>
                        <th>School</th>
                        <th>Vehicle</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($students as $index => $student)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $student->name }}</td>
                            <td>{{ $student->emergency_contact ?? 'N/A' }}</td>
                            <td>{{ $student->blood_group ?? 'N/A' }}</td>
                            <td>{{ $student->address ?? 'N/A' }}</td>
                            <td>{{ $student->guardian->name ?? 'N/A' }}</td>
                            <td>{{ $student->school->name ?? 'N/A' }}</td>
                            <td>
                                @if ($student->vehicle)
                                    Vehicle #{{ $student->vehicle->id }}
                                @else
                                    N/A
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('students.edit', $student->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('students.destroy', $student->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Are you sure you want to delete this student?')">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="text-muted">No students found.</p>
        @endif
    </div>
@endsection
