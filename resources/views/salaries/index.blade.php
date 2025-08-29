@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Salary Records</h2>

        {{-- Success Message --}}
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="mb-3">
            <a href="{{ route('salaries.create') }}" class="btn btn-primary">+ Add Salary</a>
        </div>

        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Staff</th>
                    <th>Amount</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($salaries as $salary)
                    <tr>
                        <td>{{ $salary->id }}</td>
                        <td>
                            {{ $salary->staff->name ?? 'N/A' }}
                            <small>({{ $salary->staff->position ?? '' }})</small>
                        </td>
                        <td>{{ number_format($salary->amount, 2) }}</td>
                        <td>{{ \Carbon\Carbon::parse($salary->date)->format('d M Y') }}</td>
                        <td>
                            <a href="{{ route('salaries.show', $salary->id) }}" class="btn btn-info btn-sm">View</a>
                            <a href="{{ route('salaries.edit', $salary->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('salaries.destroy', $salary->id) }}" method="POST"
                                style="display:inline-block;"
                                onsubmit="return confirm('Are you sure you want to delete this salary record?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">No salary records found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
