@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Expenses</h1>

        {{-- Success Message --}}
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        {{-- Filter by Type --}}
        <form method="GET" action="{{ route('expenses.index') }}" class="mb-3">
            <div class="row g-2">
                <div class="col-md-4">
                    <input type="text" name="type" class="form-control" placeholder="Filter by Type"
                        value="{{ request('type') }}">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary">Filter</button>
                </div>
            </div>
        </form>

        {{-- Add New Expense --}}
        <a href="{{ route('expenses.create') }}" class="btn btn-success mb-3">+ Add New Expense</a>

        {{-- Expenses Table --}}
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Date</th>
                    <th>Amount</th>
                    <th>Type</th>
                    <th>Description</th>
                    <th>Created By</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($expenses as $index => $expense)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $expense->date }}</td>
                        <td>{{ number_format($expense->amount, 2) }}</td>
                        <td>{{ $expense->type }}</td>
                        <td>{{ $expense->description ?? 'N/A' }}</td>
                        <td>{{ $expense->user->name ?? 'N/A' }}</td>
                        <td>
                            @if ($expense->image)
                                <img src="{{ asset('storage/' . $expense->image) }}" alt="Expense Image"
                                    style="max-width: 100px;">
                            @else
                                N/A
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('expenses.show', $expense->id) }}" class="btn btn-sm btn-info">View</a>
                            <a href="{{ route('expenses.edit', $expense->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('expenses.destroy', $expense->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"
                                    onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center">No expenses found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
