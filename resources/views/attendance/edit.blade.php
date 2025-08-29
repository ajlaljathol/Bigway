@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Attendance</h1>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('attendance.update', $attendance->id) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Vehicle --}}
            <div class="mb-3">
                <label for="vehicle_id" class="form-label">Vehicle</label>
                <select name="vehicle_id" id="vehicle_id" class="form-control" required>
                    <option value="">-- Select Vehicle --</option>
                    @foreach ($vehicles as $vehicle)
                        <option value="{{ $vehicle->id }}" {{ $attendance->vehicle_id == $vehicle->id ? 'selected' : '' }}>
                            {{ $vehicle->reg_number }} ({{ $vehicle->vehicle_type }})
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Attendance Date --}}
            <div class="mb-3">
                <label for="date" class="form-label">Date</label>
                <input type="date" name="date" id="date" class="form-control"
                    value="{{ $attendance->date->format('Y-m-d') }}" required>
            </div>

            {{-- Students List --}}
            <div class="mb-3">
                <h4>Students in this Vehicle</h4>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Student Name</th>
                            <th>Present</th>
                            <th>Absent</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($students as $student)
                            @php
                                $status = $attendance->student_attendance_status($student->id) ?? 'absent';
                            @endphp
                            <tr>
                                <td>{{ $student->name }}</td>
                                <td><input type="radio" name="status[{{ $student->id }}]" value="present"
                                        {{ $status == 'present' ? 'checked' : '' }} required></td>
                                <td><input type="radio" name="status[{{ $student->id }}]" value="absent"
                                        {{ $status == 'absent' ? 'checked' : '' }}></td>
                                <input type="hidden" name="student_id[]" value="{{ $student->id }}">
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <button type="submit" class="btn btn-primary">Update Attendance</button>
        </form>
    </div>

    {{-- JS for dynamically fetching students when vehicle changes --}}
    <script>
        const vehicleSelect = document.getElementById('vehicle_id');
        const studentsTable = document.querySelector('tbody');

        vehicleSelect.addEventListener('change', function() {
            const vehicleId = this.value;

            if (!vehicleId) {
                studentsTable.innerHTML = '';
                return;
            }

            fetch(`/api/vehicles/${vehicleId}/students`)
                .then(res => res.json())
                .then(data => {
                    studentsTable.innerHTML = '';
                    data.forEach(student => {
                        const row = document.createElement('tr');
                        row.innerHTML = `
                        <td>${student.name}</td>
                        <td><input type="radio" name="status[${student.id}]" value="present" required></td>
                        <td><input type="radio" name="status[${student.id}]" value="absent"></td>
                        <input type="hidden" name="student_id[]" value="${student.id}">
                    `;
                        studentsTable.appendChild(row);
                    });
                })
                .catch(err => console.error(err));
        });
    </script>
@endsection
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Attendance</h1>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('attendance.update', $attendance->id) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Vehicle --}}
            <div class="mb-3">
                <label for="vehicle_id" class="form-label">Vehicle</label>
                <select name="vehicle_id" id="vehicle_id" class="form-control" required>
                    <option value="">-- Select Vehicle --</option>
                    @foreach ($vehicles as $vehicle)
                        <option value="{{ $vehicle->id }}"
                            {{ $attendance->vehicle_id == $vehicle->id ? 'selected' : '' }}>
                            {{ $vehicle->reg_number }} ({{ $vehicle->vehicle_type }})
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Attendance Date --}}
            <div class="mb-3">
                <label for="date" class="form-label">Date</label>
                <input type="date" name="date" id="date" class="form-control"
                    value="{{ $attendance->date instanceof \Carbon\Carbon ? $attendance->date->format('Y-m-d') : $attendance->date }}"
                    required>
            </div>

            {{-- Students List --}}
            <div class="mb-3">
                <h4>Students in this Vehicle</h4>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Student Name</th>
                            <th>Present</th>
                            <th>Absent</th>
                        </tr>
                    </thead>
                    <tbody id="students-table">
                        @foreach ($students as $student)
                            @php
                                $status = $attendance->student_attendance_status($student->id) ?? 'absent';
                            @endphp
                            <tr>
                                <td>{{ $student->name }}</td>
                                <td>
                                    <input type="radio" name="status[{{ $student->id }}]" value="present"
                                        {{ $status == 'present' ? 'checked' : '' }} required>
                                </td>
                                <td>
                                    <input type="radio" name="status[{{ $student->id }}]" value="absent"
                                        {{ $status == 'absent' ? 'checked' : '' }}>
                                </td>
                                <input type="hidden" name="student_id[]" value="{{ $student->id }}">
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <button type="submit" class="btn btn-primary">Update Attendance</button>
        </form>
    </div>

    {{-- JS for dynamically fetching students when vehicle changes --}}
    <script>
        const vehicleSelect = document.getElementById('vehicle_id');
        const studentsTable = document.getElementById('students-table');

        vehicleSelect.addEventListener('change', function() {
            const vehicleId = this.value;

            if (!vehicleId) {
                studentsTable.innerHTML = '<tr><td colspan="3">No students found</td></tr>';
                return;
            }

            fetch(`/api/vehicles/${vehicleId}/students`)
                .then(res => res.json())
                .then(data => {
                    studentsTable.innerHTML = '';
                    if (data.length === 0) {
                        studentsTable.innerHTML =
                            '<tr><td colspan="3">No students assigned to this vehicle</td></tr>';
                        return;
                    }
                    data.forEach(student => {
                        const row = document.createElement('tr');
                        row.innerHTML = `
                            <td>${student.name}</td>
                            <td><input type="radio" name="status[${student.id}]" value="present" required></td>
                            <td><input type="radio" name="status[${student.id}]" value="absent"></td>
                            <input type="hidden" name="student_id[]" value="${student.id}">
                        `;
                        studentsTable.appendChild(row);
                    });
                })
                .catch(err => {
                    console.error(err);
                    studentsTable.innerHTML = '<tr><td colspan="3">Error fetching students</td></tr>';
                });
        });
    </script>
@endsection
