@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Guardians</h1>

        {{-- Success Message --}}
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        {{-- Add Guardian --}}
        <div class="mb-3">
            <a href="{{ route('guardians.create') }}" class="btn btn-primary">+ Add Guardian</a>
        </div>

        {{-- Guardians Table --}}
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Guardian Name</th>
                    <th>Gender</th>
                    <th>Relation</th>
                    <th>Contact</th>
                    <th>Address</th>
                    <th>Students</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($guardians as $guardian)
                    <tr>
                        <td>{{ $guardian->name }}</td>
                        <td>{{ ucfirst($guardian->gender) }}</td>
                        <td>{{ $guardian->relation }}</td>
                        <td>{{ $guardian->contact_number }}</td>
                        <td>{{ $guardian->address }}</td>
                        <td>
                            @if ($guardian->students->count())
                                <ul class="list-unstyled mb-0">
                                    @foreach ($guardian->students as $student)
                                        <li>
                                            <strong>{{ $student->name }}</strong>
                                            (Blood Group: {{ $student->blood_group ?? 'N/A' }},
                                            Emergency: {{ $student->emergency_contact ?? 'N/A' }},
                                            School: {{ $student->school->name ?? 'N/A' }},
                                            Vehicle: {{ $student->vehicle->id ?? 'N/A' }})
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <span class="text-muted">No students assigned</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('guardians.edit', $guardian->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('guardians.destroy', $guardian->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger"
                                    onclick="return confirm('Are you sure you want to delete this guardian?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">No guardians found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
