@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Caretaker</h1>

        <form action="{{ route('caretakers.update', $caretaker->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Caretaker Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $caretaker->name }}"
                    required>
            </div>

            <div class="mb-3">
                <label for="salary_id" class="form-label">Salary</label>
                <select class="form-control" id="salary_id" name="salary_id" required>
                    <option value="">Select Salary</option>
                    @foreach ($salaries as $salary)
                        <option value="{{ $salary->id }}">{{ $salary->amount }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="vehicle_id" class="form-label">Vehicle</label>
                <select class="form-control" id="vehicle_id" name="vehicle_id" required>
                    <option value="">Select Vehicle</option>
                    @foreach ($vehicles as $vehicle)
                        <option value="{{ $vehicle->id }}">{{ $vehicle->name }}</option>
                    @endforeach
                </select>
            </div>


            @if (isset($users) && count($users) > 0)
                <div class="mb-3">
                    <label for="user_id" class="form-label">Assign User</label>
                    <select class="form-control" id="user_id" name="user_id">
                        <option value="">Select User (optional)</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>
            @endif

            <button type="submit" class="btn btn-primary">Update Caretaker</button>
        </form>
    </div>
@endsection
