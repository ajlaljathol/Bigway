@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Add New Expense</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('expenses.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- Date --}}
            <div class="mb-3">
                <label for="date" class="form-label">Expense Date</label>
                <input type="date" class="form-control" id="date" name="date" value="{{ old('date') }}" required>
            </div>

            {{-- Amount --}}
            <div class="mb-3">
                <label for="amount" class="form-label">Amount</label>
                <input type="number" step="0.01" class="form-control" id="amount" name="amount"
                    value="{{ old('amount') }}" required>
            </div>

            {{-- Type --}}
            <div class="mb-3">
                <label for="type" class="form-label">Type</label>
                <input type="text" class="form-control" id="type" name="type" value="{{ old('type') }}"
                    placeholder="e.g. Utility, Salary, Maintenance" required>
            </div>

            {{-- Description --}}
            <div class="mb-3">
                <label for="description" class="form-label">Description (optional)</label>
                <textarea class="form-control" id="description" name="description" rows="3">{{ old('description') }}</textarea>
            </div>

            {{-- Optional Image --}}
            <div class="mb-3">
                <label for="image" class="form-label">Attach Image (optional)</label>
                <input type="file" class="form-control" id="image" name="image" accept="image/*">
            </div>

            <button type="submit" class="btn btn-primary">Add Expense</button>
        </form>
    </div>
@endsection
