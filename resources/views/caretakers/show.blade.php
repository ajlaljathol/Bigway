@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Caretaker Details</h1>

        {{-- Search Bar --}}
        <form action="{{ route('caretakers.index') }}" method="GET" class="mb-4">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search by name..."
                    value="{{ request('search') }}">
                <button class="btn btn-primary" type="submit">Search</button>
            </div>
        </form>

        {{-- Caretakers Table --}}
        @if (isset($caretakers) && $caretakers->count())
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Staff</th>
                        <th>User</th>
                        <th>Salary</th>
                        <th>Vehicle</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($caretakers as $caretaker)
                        <tr>
                            <td>{{ $caretaker->name }}</td>
                            <td>{{ $caretaker->staff->name ?? 'N/A' }}</td>
                            <td>{{ $caretaker->user->name ?? 'N/A' }}</td>
                            <td>{{ $caretaker->salary->amount ?? 'N/A' }}</td>
                            <td>{{ $caretaker->vehicle->name ?? 'N/A' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @elseif(isset($caretaker))
            <div class="card">
                <div class="card-header">
                    {{ $caretaker->name }}
                </div>
                <div class="card-body">
                    <p><strong>Staff:</strong> {{ $caretaker->staff->name ?? 'N/A' }}</p>
                    <p><strong>User:</strong> {{ $caretaker->user->name ?? 'N/A' }}</p>
                    <p><strong>Salary:</strong> {{ $caretaker->salary->amount ?? 'N/A' }}</p>
                    <p><strong>Vehicle:</strong> {{ $caretaker->vehicle->name ?? 'N/A' }}</p>
                </div>
            </div>
        @else
            <p>No caretakers found.</p>
        @endif
    </div>
@endsection
