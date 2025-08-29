{{-- resources/views/staff/create.blade.php --}}
@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="mb-4">Add New Staff</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('staff.store') }}" method="POST">
            @csrf

            {{-- Name --}}
            <div class="mb-3">
                <label for="name" class="form-label">Full Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}"
                    required>
            </div>

            {{-- Email --}}
            <div class="mb-3">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}"
                    required>
            </div>

            {{-- Phone --}}
            <div class="mb-3">
                <label for="phone" class="form-label">Phone Number</label>
                <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone') }}"
                    required>
            </div>

            {{-- Role --}}
            <div class="mb-3">
                <label for="role" class="form-label">Role</label>
                <select name="role" id="role" class="form-select" required>
                    <option value="">-- Select Role --</option>
                    <option value="driver" {{ old('role') == 'driver' ? 'selected' : '' }}>Driver</option>
                    <option value="caretaker" {{ old('role') == 'caretaker' ? 'selected' : '' }}>Caretaker</option>
                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="other" {{ old('role') == 'other' ? 'selected' : '' }}>Other</option>
                </select>
            </div>

            {{-- Salary --}}
            <div class="mb-3">
                <label for="salary" class="form-label">Salary</label>
                <input type="number" name="salary" id="salary" class="form-control" value="{{ old('salary') }}"
                    min="0" required>
            </div>

            {{-- Submit --}}
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Save Staff</button>
            </div>
        </form>
    </div>
@endsection
