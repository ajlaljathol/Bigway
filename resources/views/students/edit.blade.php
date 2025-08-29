@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Student</h1>

        <form action="{{ route('students.update', $student->id) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Name --}}
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name"
                    value="{{ old('name', $student->name) }}" required>
            </div>

            {{-- Emergency Contact --}}
            <div class="mb-3">
                <label for="emergency_contact" class="form-label">Emergency Contact</label>
                <input type="text" class="form-control" id="emergency_contact" name="emergency_contact"
                    value="{{ old('emergency_contact', $student->emergency_contact) }}" required>
            </div>

            {{-- Blood Group --}}
            <div class="mb-3">
                <label for="blood_group" class="form-label">Blood Group</label>
                <input type="text" class="form-control" id="blood_group" name="blood_group"
                    value="{{ old('blood_group', $student->blood_group) }}">
            </div>

            {{-- Address --}}
            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <textarea class="form-control" id="address" name="address">{{ old('address', $student->address) }}</textarea>
            </div>

            {{-- Guardian --}}
            <div class="mb-3">
                <label for="guardian_id" class="form-label">Guardian</label>
                <select class="form-select" id="guardian_id" name="guardian_id" required>
                    @foreach ($guardians as $guardian)
                        <option value="{{ $guardian->id }}" {{ $student->guardian_id == $guardian->id ? 'selected' : '' }}>
                            {{ $guardian->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- School --}}
            <div class="mb-3">
                <label for="school_id" class="form-label">School</label>
                <select class="form-select" id="school_id" name="school_id" required>
                    @foreach ($schools as $school)
                        <option value="{{ $school->id }}" {{ $student->school_id == $school->id ? 'selected' : '' }}>
                            {{ $school->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Vehicle (optional) --}}
            <div class="mb-3">
                <label for="vehicle_id" class="form-label">Vehicle</label>
                <select class="form-select" id="vehicle_id" name="vehicle_id">
                    <option value="">-- None --</option>
                    @foreach ($vehicles as $vehicle)
                        <option value="{{ $vehicle->id }}" {{ $student->vehicle_id == $vehicle->id ? 'selected' : '' }}>
                            Vehicle #{{ $vehicle->id }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('students.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection
