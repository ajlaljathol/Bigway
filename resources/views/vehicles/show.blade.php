@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Vehicle Details</h1>

        {{-- Vehicle Info Card --}}
        <div class="card mb-3">
            <div class="card-header">
                Vehicle: {{ $vehicle->reg_number }}
            </div>
            <div class="card-body">
                <p><strong>Vehicle Type:</strong> {{ $vehicle->vehicle_type }}</p>
                <p><strong>Number of Seats:</strong> {{ $vehicle->num_seats }}</p>
                <p><strong>Rent:</strong> {{ number_format($vehicle->rent, 2) }}</p>
                <p><strong>Ownership:</strong> {{ $vehicle->ownership }}</p>
                <p><strong>School:</strong> {{ $vehicle->school->name ?? 'N/A' }}</p>
                <p><strong>Route:</strong> {{ $vehicle->route->name ?? 'N/A' }}</p>
                <p><strong>Caretaker:</strong> {{ $vehicle->caretaker->name ?? 'N/A' }} (ID:
                    {{ $vehicle->caretaker_id ?? '-' }})</p>
                <p><strong>Driver:</strong> {{ $vehicle->driver->name ?? 'N/A' }} (ID: {{ $vehicle->driver_id ?? '-' }})
                </p>
            </div>
        </div>

        {{-- Actions --}}
        <a href="{{ route('vehicles.edit', $vehicle->id) }}" class="btn btn-warning">Edit Vehicle</a>
        <a href="{{ route('vehicles.index') }}" class="btn btn-secondary">Back to Vehicles</a>
    </div>
@endsection
