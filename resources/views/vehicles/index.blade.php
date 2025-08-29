@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Vehicles</h1>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Add Vehicle Button --}}
    <a href="{{ route('vehicles.create') }}" class="btn btn-primary mb-3">+ Add Vehicle</a>

    {{-- Vehicles Table --}}
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Reg. Number</th>
                <th>Type</th>
                <th>Seats</th>
                <th>Rent</th>
                <th>School</th>
                <th>Caretaker</th>
                <th>Driver</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($vehicles as $index => $vehicle)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $vehicle->reg_number }}</td>
                    <td>{{ $vehicle->vehicle_type }}</td>
                    <td>{{ $vehicle->num_seats }}</td>
                    <td>{{ number_format($vehicle->rent, 2) }}</td>
                    <td>{{ $vehicle->school->name ?? 'N/A' }}</td>
                    <td>{{ $vehicle->caretaker->name ?? 'N/A' }} (ID: {{ $vehicle->caretaker_id ?? '-' }})</td>
                    <td>{{ $vehicle->driver->name ?? 'N/A' }} (ID: {{ $vehicle->driver_id ?? '-' }})</td>
                    <td>
                        <a href="{{ route('vehicles.edit', $vehicle->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('vehicles.destroy', $vehicle->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this vehicle?')">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" class="text-center">No vehicles found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
