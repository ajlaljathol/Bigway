@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create Vehicle</h1>

        {{-- Success Message --}}
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('vehicles.store') }}" method="POST">
            @csrf

            {{-- Number of Seats --}}
            <div class="mb-3">
                <label for="num_seats" class="form-label">Number of Seats</label>
                <input type="number" class="form-control" id="num_seats" name="num_seats" min="1" required>
            </div>

            {{-- School --}}
            <div class="mb-3">
                <label for="school_id" class="form-label">School</label>
                <select class="form-control" id="school_id" name="school_id" required>
                    <option value="">Select School</option>
                    @foreach ($schools as $school)
                        <option value="{{ $school->id }}">{{ $school->name }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Route --}}
            <div class="mb-3">
                <label for="route_id" class="form-label">Route</label>
                <select class="form-control" id="route_id" name="route_id" required>
                    <option value="">Select Route</option>
                    @foreach ($routes as $route)
                        <option value="{{ $route->id }}">Route #{{ $route->id }} - {{ $route->starting_time }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Ownership --}}
            <div class="mb-3">
                <label for="ownership" class="form-label">Ownership</label>
                <input type="text" class="form-control" id="ownership" name="ownership" required>
            </div>

            {{-- Caretaker --}}
            <div class="mb-3">
                <label for="caretaker_id" class="form-label">Assign Caretaker</label>
                <select class="form-control" id="caretaker_id" name="caretaker_id" required>
                    <option value="">Select Staff (Caretaker)</option>
                    @foreach ($staff as $member)
                        @if ($member->role == 'Caretaker')
                            <option value="{{ $member->id }}">{{ $member->name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            {{-- Driver --}}
            <div class="mb-3">
                <label for="driver_id" class="form-label">Assign Driver</label>
                <select class="form-control" id="driver_id" name="driver_id" required>
                    <option value="">Select Staff (Driver)</option>
                    @foreach ($staff as $member)
                        @if ($member->role == 'Driver')
                            <option value="{{ $member->id }}">{{ $member->name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            {{-- Registration Number --}}
            <div class="mb-3">
                <label for="reg_number" class="form-label">Registration Number</label>
                <input type="text" class="form-control" id="reg_number" name="reg_number" required>
            </div>

            {{-- Rent --}}
            <div class="mb-3">
                <label for="rent" class="form-label">Rent</label>
                <input type="number" step="0.01" class="form-control" id="rent" name="rent" required>
            </div>

            {{-- Vehicle Type --}}
            <div class="mb-3">
                <label for="vehicle_type" class="form-label">Vehicle Type</label>
                <input type="text" class="form-control" id="vehicle_type" name="vehicle_type" required>
            </div>

            <button type="submit" class="btn btn-primary">Create Vehicle</button>
        </form>
    </div>
@endsection
