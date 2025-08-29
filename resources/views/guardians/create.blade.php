@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create Guardian</h1>

        {{-- Display Validation Errors --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('guardians.store') }}" method="POST">
            @csrf

            {{-- Guardian Name --}}
            <div class="mb-3">
                <label for="name" class="form-label">Guardian Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
            </div>

            {{-- Guardian Gender --}}
            <div class="mb-3">
                <label for="gender" class="form-label">Gender</label>
                <select class="form-control" id="gender" name="gender" required>
                    <option value="">-- Select Gender --</option>
                    <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                    <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                    <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Other</option>
                </select>
            </div>

            {{-- Guardian Relation --}}
            <div class="mb-3">
                <label for="relation" class="form-label">Relation</label>
                <input type="text" class="form-control" id="relation" name="relation" value="{{ old('relation') }}"
                    required>
            </div>

            {{-- Guardian Contact --}}
            <div class="mb-3">
                <label for="contact_number" class="form-label">Contact Number</label>
                <input type="text" class="form-control" id="contact_number" name="contact_number"
                    value="{{ old('contact_number') }}" required>
            </div>

            {{-- Guardian Address --}}
            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <textarea class="form-control" id="address" name="address" rows="2" required>{{ old('address') }}</textarea>
            </div>

            {{-- Dynamic Students Section --}}
            <h4>Students</h4>
            <div id="students-container">
                <div class="student-row mb-3 border p-3 rounded">
                    <input type="text" class="form-control mb-2" name="students[0][name]" placeholder="Student Name"
                        required>

                    <input type="text" class="form-control mb-2" name="students[0][emergency_contact]"
                        placeholder="Emergency Contact" required>

                    <input type="text" class="form-control mb-2" name="students[0][blood_group]"
                        placeholder="Blood Group">

                    <textarea class="form-control mb-2" name="students[0][address]" rows="2" placeholder="Student Address"></textarea>

                    {{-- School Dropdown --}}
                    <select class="form-control mb-2" name="students[0][school_id]" required>
                        <option value="">-- Select School --</option>
                        @foreach ($schools as $school)
                            <option value="{{ $school->id }}"
                                {{ old('students.0.school_id') == $school->id ? 'selected' : '' }}>
                                {{ $school->name }}
                            </option>
                        @endforeach
                    </select>

                    {{-- Vehicle Dropdown --}}
                    <select class="form-control mb-2" name="students[0][vehicle_id]">
                        <option value="">-- Select Vehicle --</option>
                        @foreach ($vehicles as $vehicle)
                            <option value="{{ $vehicle->id }}"
                                {{ old('students.0.vehicle_id') == $vehicle->id ? 'selected' : '' }}>
                                Vehicle #{{ $vehicle->id }} (Seats: {{ $vehicle->num_seats }})
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <button type="button" id="add-student" class="btn btn-secondary mb-3">+ Add Another Student</button>

            <button type="submit" class="btn btn-primary">Create Guardian</button>
        </form>
    </div>

    {{-- Script for dynamically adding student input fields --}}
    @push('scripts')
        <script>
            let studentIndex = 1;

            document.getElementById('add-student').addEventListener('click', function() {
                const container = document.getElementById('students-container');

                const html = `
                    <div class="student-row mb-3 border p-3 rounded">
                        <input type="text" class="form-control mb-2" name="students[${studentIndex}][name]" placeholder="Student Name" required>

                        <input type="text" class="form-control mb-2" name="students[${studentIndex}][emergency_contact]" placeholder="Emergency Contact" required>

                        <input type="text" class="form-control mb-2" name="students[${studentIndex}][blood_group]" placeholder="Blood Group">

                        <textarea class="form-control mb-2" name="students[${studentIndex}][address]" rows="2" placeholder="Student Address"></textarea>

                        <select class="form-control mb-2" name="students[${studentIndex}][school_id]" required>
                            <option value="">-- Select School --</option>
                            @foreach ($schools as $school)
                                <option value="{{ $school->id }}">{{ $school->name }}</option>
                            @endforeach
                        </select>

                        <select class="form-control mb-2" name="students[${studentIndex}][vehicle_id]">
                            <option value="">-- Select Vehicle --</option>
                            @foreach ($vehicles as $vehicle)
                                <option value="{{ $vehicle->id }}">Vehicle #{{ $vehicle->id }} (Seats: {{ $vehicle->num_seats }})</option>
                            @endforeach
                        </select>
                    </div>
                `;

                container.insertAdjacentHTML('beforeend', html);
                studentIndex++;
            });
        </script>
    @endpush
@endsection
