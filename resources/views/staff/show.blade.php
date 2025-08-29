@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Staff Member Details</h1>

        <div class="card mb-4">
            <div class="card-header">
                {{ $staff->name }} ({{ ucfirst($staff->role) }})
            </div>
            <div class="card-body">
                <p><strong>Name:</strong> {{ $staff->name }}</p>
                <p><strong>Role:</strong> {{ ucfirst($staff->role) }}</p>
                <p><strong>Position:</strong> {{ $staff->position ?? 'N/A' }}</p>
                <p><strong>Phone:</strong> {{ $staff->phone ?? 'N/A' }}</p>
                <p><strong>CNIC:</strong> {{ $staff->cnic ?? 'N/A' }}</p>
                <p><strong>Address:</strong> {{ $staff->address ?? 'N/A' }}</p>
                <p><strong>Salary:</strong> {{ $staff->salary ? $staff->salary->salary : 'N/A' }}</p>
                <p><strong>Vehicle:</strong> {{ $staff->vehicle ? $staff->vehicle->reg_number : 'N/A' }}</p>
            </div>
        </div>

        <a href="{{ route('staff.index') }}" class="btn btn-secondary">Back to Staff List</a>
        <a href="{{ route('staff.edit', $staff->id) }}" class="btn btn-warning">Edit Staff</a>
    </div>
@endsection
