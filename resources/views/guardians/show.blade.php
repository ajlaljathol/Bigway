@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Guardian Details</h1>

        {{-- Guardian Information --}}
        <div class="card mb-4">
            <div class="card-body">
                <h4 class="card-title">{{ $guardian->name }}</h4>
                <p><strong>Gender:</strong> {{ ucfirst($guardian->gender) }}</p>
                <p><strong>Relation:</strong> {{ $guardian->relation ?? 'N/A' }}</p>
                <p><strong>Contact Number:</strong> {{ $guardian->contact_number ?? 'N/A' }}</p>
                <p><strong>Address:</strong> {{ $guardian->address ?? 'N/A' }}</p>
            </div>
        </div>

        {{-- Students under this Guardian --}}
        <h3>Students</h3>
        @if ($guardian->students->count() > 0)
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Emergency Contact</th>
                        <th>Blood Group</th>
                        <th>Address</th>
                        <th>School</th>
                        <th>Vehicle</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($guardian->students as $index => $student)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $student->name }}</td>
                            <td>{{ $student->emergency_contact ?? 'N/A' }}</td>
                            <td>{{ $student->blood_group ?? 'N/A' }}</td>
                            <td>{{ $student->address ?? 'N/A' }}</td>
                            <td>{{ $student->school->name ?? 'N/A' }}</td>
                            <td>
                                @if ($student->vehicle)
                                    Vehicle #{{ $student->vehicle->id }}
                                @else
                                    N/A
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="text-muted">No students assigned to this guardian.</p>
        @endif

        {{-- Action Buttons --}}
        <div class="mt-3">
            <a href="{{ route('guardians.index') }}" class="btn btn-secondary">Back to List</a>
            <a href="{{ route('guardians.edit', $guardian->id) }}" class="btn btn-warning">Edit</a>
            <form action="{{ route('guardians.destroy', $guardian->id) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger"
                    onclick="return confirm('Are you sure you want to delete this guardian?')">
                    Delete
                </button>
            </form>
        </div>
    </div>
@endsection
