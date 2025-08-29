@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Drivers</h1>

        {{-- Flash messages --}}
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="mb-3">
            <a href="{{ route('drivers.create') }}" class="btn btn-primary">Add New Driver</a>
        </div>

        @if ($drivers->count())
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Staff</th>
                        <th>User</th>
                        <th>Salary</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($drivers as $driver)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $driver->name }}</td>
                            <td>{{ $driver->staff ? $driver->staff->name : '—' }}</td>
                            <td>{{ $driver->user ? $driver->user->name : '—' }}</td>
                            <td>
                                @if ($driver->salary)
                                    {{ $driver->salary->amount }} ({{ $driver->salary->type }})
                                @else
                                    —
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('drivers.edit', $driver->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('drivers.destroy', $driver->id) }}" method="POST"
                                    style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Are you sure you want to delete this driver?')">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No drivers found.</p>
        @endif
    </div>
@endsection
