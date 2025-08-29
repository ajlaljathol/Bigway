@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Staff Members</h1>

        {{-- Success Message --}}
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        {{-- Filter by Role --}}
        <form method="GET" action="{{ route('staff.index') }}" class="mb-3">
            <div class="row">
                <div class="col-md-4">
                    <select name="role" class="form-control" onchange="this.form.submit()">
                        <option value="">-- Filter by Role --</option>
                        <option value="driver" {{ request('role') == 'driver' ? 'selected' : '' }}>Driver</option>
                        <option value="caretaker" {{ request('role') == 'caretaker' ? 'selected' : '' }}>Caretaker</option>
                        <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="other" {{ request('role') == 'other' ? 'selected' : '' }}>Other</option>
                    </select>
                </div>
            </div>
        </form>

        {{-- Staff Table --}}
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Role</th>
                    <th>Phone</th>
                    <th>CNIC</th>
                    <th>Address</th>
                    <th>Salary</th>
                    <th>Vehicle</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($staff as $index => $member)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $member->name }}</td>
                        <td>{{ ucfirst($member->role) }}</td>
                        <td>{{ $member->phone ?? 'N/A' }}</td>
                        <td>{{ $member->cnic ?? 'N/A' }}</td>
                        <td>{{ $member->address ?? 'N/A' }}</td>
                        <td>{{ $member->salary ? $member->salary->salary : 'N/A' }}</td>
                        <td>{{ $member->vehicle ? $member->vehicle->reg_number : 'N/A' }}</td>
                        <td>
                            <a href="{{ route('staff.show', $member->id) }}" class="btn btn-sm btn-info">View</a>
                            <a href="{{ route('staff.edit', $member->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('staff.destroy', $member->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"
                                    onclick="return confirm('Are you sure you want to delete this staff member?')">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center">No staff members found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{-- Add New Staff --}}
        <a href="{{ route('staff.create') }}" class="btn btn-primary">+ Add New Staff</a>
    </div>
@endsection
