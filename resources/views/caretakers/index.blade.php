@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Caretakers</h1>

        {{-- No direct creation of caretakers since they come from Staff --}}
        {{-- <a href="{{ route('caretakers.create') }}" class="btn btn-primary mb-3">Add Caretaker</a> --}}

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name (from Staff)</th>
                    <th>Salary</th>
                    <th>Vehicle</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($caretakers as $caretaker)
                    <tr>
                        <td>{{ $caretaker->staff->name ?? 'N/A' }}</td>
                        <td>{{ $caretaker->salary->amount ?? 'N/A' }}</td>
                        <td>{{ $caretaker->vehicle->name ?? 'N/A' }}</td>
                        <td>
                            <a href="{{ route('caretakers.edit', $caretaker->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('caretakers.destroy', $caretaker->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">No caretakers found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
