@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Mark Attendance</h1>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('attendance.store') }}" method="POST">
            @csrf

            {{-- Select Vehicle --}}
            <div class="mb-3">
                <label for="vehicle_id" class="form-label">Select Vehicle</label>
                <select name="vehicle_id" id="vehicle_id" class="form-control" required>
                    <option value="">-- Select Vehicle --</option>
                    @foreach ($vehicles as $vehicle)
                        <option value="{{ $vehicle->id }}">
                            {{ $vehicle->reg_number }} ({{ $vehicle->vehicle_type }})
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Attendance Date --}}
            <div class="mb-3">
                <label for="date" class="form-label">Date</label>
                <input type="date" name="date" id="date" class="form-control" value="{{ date('Y-m-d') }}"
                    required>
            </div>

            {{-- Button to load students --}}
            <div class="mb-3">
                <button type="button" id="load-students-btn" class="btn btn-success" disabled>
                    Load Students
                </button>
            </div>

            {{-- Students List --}}
            <div id="students-section" class="mb-3" style="display: none;">
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
                        {{-- Filled dynamically via JS --}}
                    </tbody>
                </table>
            </div>

            <button type="submit" class="btn btn-primary" style="display: none;" id="submit-attendance-btn">
                Submit Attendance
            </button>
        </form>
    </div>

    {{-- JS --}}
    <script>
        const vehicleSelect = document.getElementById('vehicle_id');
        const loadBtn = document.getElementById('load-students-btn');
        const studentsSection = document.getElementById('students-section');
        const studentsTable = document.getElementById('students-table');
        const submitBtn = document.getElementById('submit-attendance-btn');

        // Enable button only when a vehicle is selected
        vehicleSelect.addEventListener('change', function() {
            loadBtn.disabled = !this.value;
            studentsSection.style.display = 'none';
            studentsTable.innerHTML = '';
            submitBtn.style.display = 'none';
        });

        // Fetch students for the selected vehicle
        loadBtn.addEventListener('click', function() {
            const vehicleId = vehicleSelect.value;

            if (!vehicleId) return;

            // ✅ Route handled by AttendanceController@getStudents
            fetch(`/attendance/students/${vehicleId}`)
                .then(res => res.json())
                .then(data => {
                    studentsTable.innerHTML = '';
                    if (data.length > 0) {
                        data.forEach(student => {
                            const row = document.createElement('tr');
                            row.innerHTML = `
                            <td>${student.name}</td>
                            <td>
                                <input type="radio" name="attendance[${student.id}]" value="present" required>
                            </td>
                            <td>
                                <input type="radio" name="attendance[${student.id}]" value="absent">
                            </td>
                        `;
                            studentsTable.appendChild(row);
                        });
                        studentsSection.style.display = 'block';
                        submitBtn.style.display = 'inline-block';
                    } else {
                        studentsTable.innerHTML =
                            `<tr><td colspan="3">No students found for this vehicle.</td></tr>`;
                        studentsSection.style.display = 'block';
                    }
                })
                .catch(err => {
                    console.error('Error fetching students:', err);
                });
        });
    </script>
@endsection
