@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create Student</h1>

        <form action="{{ route('students.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>

            <div class="mb-3">
                <label for="emergency_contact" class="form-label">Emergency Contact</label>
                <input type="text" class="form-control" id="emergency_contact" name="emergency_contact" required>
            </div>

            <div class="mb-3">
                <label for="blood_group" class="form-label">Blood Group</label>
                <input type="text" class="form-control" id="blood_group" name="blood_group">
            </div>

            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <input type="text" class="form-control" id="address" name="address">
            </div>

            @if (isset($isGuardian) && $isGuardian)
                @php
                    $guardianModel = auth()->user()->guardian ?? null;
                @endphp
                @if ($guardianModel)
                    <input type="hidden" name="guardian_id" value="{{ $guardianModel->id }}">
                @else
                    <div class="alert alert-danger">
                        Your guardian profile is not set up. Please contact the administrator.
                    </div>
                @endif
            @else
                <div class="mb-3">
                    <label for="guardian_id" class="form-label">Guardian</label>
                    <select class="form-control" id="guardian_id" name="guardian_id" required>
                        <option value="">Select Guardian</option>
                        @foreach ($guardians as $guardian)
                            <option value="{{ $guardian->id }}">{{ $guardian->name }}</option>
                        @endforeach
                    </select>
                </div>
            @endif

            <div class="mb-3">
                <label for="school_id" class="form-label">School</label>
                <select class="form-control" id="school_id" name="school_id" required>
                    <option value="">Select School</option>
                    @foreach ($schools as $school)
                        <option value="{{ $school->id }}">{{ $school->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="vehicle_id" class="form-label">Vehicle</label>
                <select class="form-control" id="vehicle_id" name="vehicle_id">
                    <option value="">Select Vehicle</option>
                    @foreach ($vehicles as $vehicle)
                        <option value="{{ $vehicle->id }}">{{ $vehicle->name }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
@endsection
F
