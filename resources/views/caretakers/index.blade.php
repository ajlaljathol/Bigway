@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Add Caretaker</h1>

        {{-- Validation Errors --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('caretakers.store') }}" method="POST">
            @csrf

            {{-- Staff (filtered caretakers) --}}
            <div class="mb-3">
                <label for="staff_id" class="form-label">Select Caretaker (Staff)</label>
                <select name="staff_id" id="staff_id" class="form-control" required>
                    <option value="">-- Select Caretaker --</option>
                    @foreach ($staff as $member)
                        <option value="{{ $member->id }}" {{ old('staff_id') == $member->id ? 'selected' : '' }}>
                            {{ $member->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Salary --}}
            <div class="mb-3">
                <label for="salary_id" class="form-label">Select Salary</label>
                <select name="salary_id" id="salary_id" class="form-control" required>
                    <option value="">-- Select Salary --</option>
                    @foreach ($salaries as $salary)
                        <option value="{{ $salary->id }}" {{ old('salary_id') == $salary->id ? 'selected' : '' }}>
                            {{ $salary->amount }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Vehicle --}}
            <div class="mb-3">
                <label for="vehicle_id" class="form-label">Select Vehicle</label>
                <select name="vehicle_id" id="vehicle_id" class="form-control" required>
                    <option value="">-- Select Vehicle --</option>
                    @foreach ($vehicles as $vehicle)
                        <option value="{{ $vehicle->id }}" {{ old('vehicle_id') == $vehicle->id ? 'selected' : '' }}>
                            {{ $vehicle->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-success">Save Caretaker</button>
            <a href="{{ route('caretakers.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection