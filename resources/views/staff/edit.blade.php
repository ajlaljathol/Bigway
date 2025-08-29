{{-- resources/views/staff/edit.blade.php --}}
@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="mb-4">Edit Staff</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('staff.update', $staff->id) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Name --}}
            <div class="mb-3">
                <label for="name" class="form-label">Full Name</label>
                <input type="text" name="name" id="name" class="form-control"
                    value="{{ old('name', $staff->name) }}" required>
            </div>

            {{-- Email --}}
            <div class="mb-3">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" name="email" id="email" class="form-control"
                    value="{{ old('email', $staff->email) }}" required>
            </div>

            {{-- Phone --}}
            <div class="mb-3">
                <label for="phone" class="form-label">Phone Number</label>
                <input type="text" name="phone" id="phone" class="form-control"
                    value="{{ old('phone', $staff->phone) }}" required>
            </div>

            {{-- Role --}}
            <div class="mb-3">
                <label for="role" class="form-label">Role</label>
                <select name="role" id="role" class="form-select" required>
                    <option value="">-- Select Role --</option>
                    <option value="driver" {{ old('role', $staff->role) == 'driver' ? 'selected' : '' }}>Driver</option>
                    <option value="caretaker" {{ old('role', $staff->role) == 'caretaker' ? 'selected' : '' }}>Caretaker
                    </option>
                    <option value="admin" {{ old('role', $staff->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="other" {{ old('role', $staff->role) == 'other' ? 'selected' : '' }}>Other</option>
                </select>
            </div>

            {{-- Salary --}}
            <div class="mb-3">
                <label for="salary" class="form-label">Salary</label>
                <input type="number" name="salary" id="salary" class="form-control"
                    value="{{ old('salary', $staff->salary) }}" min="0" required>
            </div>

            {{-- Submit --}}
            <div class="d-grid">
                <button type="submit" class="btn btn-success">Update Staff</button>
            </div>
        </form>
    </div>
@endsection
