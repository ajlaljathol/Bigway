@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Edit Salary Record</h2>

        {{-- Show validation errors --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('salaries.update', $salary->id) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Staff Selection --}}
            <div class="form-group mb-3">
                <label for="staff_id">Staff Member</label>
                <select name="staff_id" id="staff_id" class="form-control" required>
                    <option value="">-- Select Staff --</option>
                    @foreach ($staff as $s)
                        <option value="{{ $s->id }}"
                            {{ old('staff_id', $salary->staff_id) == $s->id ? 'selected' : '' }}>
                            {{ $s->name }} ({{ $s->position ?? '' }})
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Salary Amount --}}
            <div class="form-group mb-3">
                <label for="amount">Salary Amount</label>
                <input type="number" name="amount" id="amount" class="form-control"
                       value="{{ old('amount', $salary->amount) }}" required min="0">
            </div>

            {{-- Date --}}
            <div class="form-group mb-3">
                <label for="date">Payment Date</label>
                <input type="date" name="date" id="date" class="form-control"
                       value="{{ old('date', $salary->date) }}" required>
            </div>

            <button type="submit" class="btn btn-success">Update Salary</button>
            <a href="{{ route('salaries.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection
