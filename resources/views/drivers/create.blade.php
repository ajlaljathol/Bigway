@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create Driver</h1>

        {{-- Show validation errors --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input:
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('drivers.store') }}" method="POST">
            @csrf

            {{-- Driver Name --}}
            <div class="mb-3">
                <label for="name" class="form-label">Driver Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
            </div>

            {{-- Staff --}}
            <div class="mb-3">
                <label for="staff_id" class="form-label">Assign Staff</label>
                <select class="form-control" id="staff_id" name="staff_id">
                    <option value="">Select Staff</option>
                    @foreach ($staff as $st)
                        <option value="{{ $st->id }}" {{ old('staff_id') == $st->id ? 'selected' : '' }}>
                            {{ $st->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- User --}}
            <div class="mb-3">
                <label for="user_id" class="form-label">Assign User</label>
                <select class="form-control" id="user_id" name="user_id">
                    <option value="">Select User</option>
                    @foreach ($users as $usr)
                        <option value="{{ $usr->id }}" {{ old('user_id') == $usr->id ? 'selected' : '' }}>
                            {{ $usr->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Salary --}}
            <div class="mb-3">
                <label for="salary_id" class="form-label">Assign Salary</label>
                <select class="form-control" id="salary_id" name="salary_id">
                    <option value="">Select Salary</option>
                    @foreach ($salaries as $sal)
                        <option value="{{ $sal->id }}" {{ old('salary_id') == $sal->id ? 'selected' : '' }}>
                            {{ $sal->amount }} ({{ $sal->type }})
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Create Driver</button>
            <a href="{{ route('drivers.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection
