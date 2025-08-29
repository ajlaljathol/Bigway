@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Expense Details</h1>

        <div class="card">
            <div class="card-header">
                <strong>Expense ID:</strong> {{ $expense->id }}
            </div>
            <div class="card-body">
                <p><strong>Date:</strong> {{ $expense->date }}</p>
                <p><strong>Amount:</strong> ${{ number_format($expense->amount, 2) }}</p>
                <p><strong>Type:</strong> {{ $expense->type }}</p>
                <p><strong>Description:</strong> {{ $expense->description ?? 'N/A' }}</p>
                <p><strong>Created By:</strong> {{ $expense->user->name ?? 'N/A' }}</p>

                @if ($expense->image)
                    <p><strong>Image:</strong></p>
                    <img src="{{ asset('storage/' . $expense->image) }}" alt="Expense Image" class="img-fluid"
                        style="max-width: 400px;">
                @else
                    <p><strong>Image:</strong> N/A</p>
                @endif
            </div>
            <div class="card-footer">
                <a href="{{ route('expenses.edit', $expense->id) }}" class="btn btn-warning">Edit</a>
                <a href="{{ route('expenses.index') }}" class="btn btn-secondary">Back to List</a>
                <form action="{{ route('expenses.destroy', $expense->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger"
                        onclick="return confirm('Are you sure you want to delete this expense?')">
                        Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
