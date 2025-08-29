@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Route</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('routes.update', $route->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="starting_time" class="form-label">Starting Time</label>
                <input type="time" class="form-control" id="starting_time" name="starting_time"
                    value="{{ old('starting_time', $route->starting_time) }}" required>
            </div>

            <div class="mb-3">
                <label for="total_distance" class="form-label">Total Distance (km)</label>
                <input type="number" class="form-control" id="total_distance" name="total_distance"
                    value="{{ old('total_distance', $route->total_distance) }}" min="1" required>
            </div>

          {{--  <div class="mb-3">
                <label for="vehicle_id" class="form-label">Assign Vehicle</label>
                <select class="form-control" id="vehicle_id" name="vehicle_id" required>
                    <option value="">Select Vehicle</option>
                    @foreach ($vehicles as $vehicle)
                        <option value="{{ $vehicle->id }}"
                            {{ old('vehicle_id', $route->vehicle_id) == $vehicle->id ? 'selected' : '' }}>
                            {{ $vehicle->name }}
                        </option>
                    @endforeach
                </select>
            </div> --}}

            <button type="submit" class="btn btn-primary">Update Route</button>
            <a href="{{ route('routes.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection
