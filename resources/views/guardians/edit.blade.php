@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Guardian</h1>

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

        <form action="{{ route('guardians.update', $guardian->id) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Guardian Name --}}
            <div class="mb-3">
                <label for="name" class="form-label">Guardian Name</label>
                <input type="text" class="form-control" id="name" name="name"
                    value="{{ old('name', $guardian->name) }}" required>
            </div>

            {{-- Guardian Gender --}}
            <div class="mb-3">
                <label for="gender" class="form-label">Gender</label>
                <select class="form-control" id="gender" name="gender" required>
                    <option value="">-- Select Gender --</option>
                    <option value="male" {{ old('gender', $guardian->gender) == 'male' ? 'selected' : '' }}>Male</option>
                    <option value="female" {{ old('gender', $guardian->gender) == 'female' ? 'selected' : '' }}>Female
                    </option>
                    <option value="other" {{ old('gender', $guardian->gender) == 'other' ? 'selected' : '' }}>Other
                    </option>
                </select>
            </div>

            {{-- Guardian Address --}}
            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <textarea class="form-control" id="address" name="address" rows="2" required>{{ old('address', $guardian->address) }}</textarea>
            </div>

            {{-- Dynamic Students Section --}}
            <h4>Students</h4>
            <div id="students-container">
                @foreach ($guardian->students as $index => $student)
                    <div class="student-row mb-3 border p-3 rounded">
                        <input type="hidden" name="students[{{ $index }}][id]" value="{{ $student->id }}">

                        {{-- Student Name --}}
                        <input type="text" class="form-control mb-2" name="students[{{ $index }}][name]"
                            value="{{ old('students.' . $index . '.name', $student->name) }}" placeholder="Student Name"
                            required>

                        {{-- Student Emergency Contact --}}
                        <input type="text" class="form-control mb-2"
                            name="students[{{ $index }}][emergency_contact]"
                            value="{{ old('students.' . $index . '.emergency_contact', $student->emergency_contact) }}"
                            placeholder="Emergency Contact">

                        {{-- Student Blood Group --}}
                        <input type="text" class="form-control mb-2" name="students[{{ $index }}][blood_group]"
                            value="{{ old('students.' . $index . '.blood_group', $student->blood_group) }}"
                            placeholder="Blood Group">

                        {{-- Student Address --}}
                        <textarea class="form-control mb-2" name="students[{{ $index }}][address]" rows="2" placeholder="Address">{{ old('students.' . $index . '.address', $student->address) }}</textarea>

                        {{-- School Dropdown --}}
                        <select class="form-control mb-2" name="students[{{ $index }}][school_id]" required>
                            <option value="">-- Select School --</option>
                            @foreach ($schools as $school)
                                <option value="{{ $school->id }}"
                                    {{ old('students.' . $index . '.school_id', $student->school_id) == $school->id ? 'selected' : '' }}>
                                    {{ $school->name }}
                                </option>
                            @endforeach
                        </select>

                        {{-- Vehicle Dropdown --}}
                        <select class="form-control" name="students[{{ $index }}][vehicle_id]" required>
                            <option value="">-- Select Vehicle --</option>
                            @foreach ($vehicles as $vehicle)
                                <option value="{{ $vehicle->id }}"
                                    {{ old('students.' . $index . '.vehicle_id', $student->vehicle_id) == $vehicle->id ? 'selected' : '' }}>
                                    Vehicle #{{ $vehicle->id }} (Seats: {{ $vehicle->num_seats }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                @endforeach
            </div>

            <button type="button" id="add-student" class="btn btn-secondary mb-3">+ Add Another Student</button>

            <button type="submit" class="btn btn-primary">Update Guardian</button>
        </form>
    </div>

    {{-- Script for dynamically adding student input fields --}}
    @push('scripts')
        <script>
            let studentIndex = {{ $guardian->students->count() }};

            document.getElementById('add-student').addEventListener('click', function() {
                const container = document.getElementById('students-container');

                const html = `
            <div class="student-row mb-3 border p-3 rounded">
                <input type="text" class="form-control mb-2" name="students[${studentIndex}][name]" placeholder="Student Name" required>

                <input type="text" class="form-control mb-2" name="students[${studentIndex}][emergency_contact]" placeholder="Emergency Contact">

                <input type="text" class="form-control mb-2" name="students[${studentIndex}][blood_group]" placeholder="Blood Group">

                <textarea class="form-control mb-2" name="students[${studentIndex}][address]" rows="2" placeholder="Address"></textarea>

                <select class="form-control mb-2" name="students[${studentIndex}][school_id]" required>
                    <option value="">-- Select School --</option>
                    @foreach ($schools as $school)
                        <option value="{{ $school->id }}">{{ $school->name }}</option>
                    @endforeach
                </select>

                <select class="form-control" name="students[${studentIndex}][vehicle_id]" required>
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
