@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Driver Details</h1>

        <div class="card">
            <div class="card-body">
                <h3 class="card-title">{{ $driver->name }}</h3>

                <p><strong>Staff:</strong>
                    {{ $driver->staff ? $driver->staff->name : '—' }}
                </p>

                <p><strong>User:</strong>
                    {{ $driver->user ? $driver->user->name : '—' }}
                </p>

                <p><strong>Salary:</strong>
                    @if ($driver->salary)
                        {{ $driver->salary->amount }} ({{ $driver->salary->type }})
                    @else
                        —
                    @endif
                </p>

                <p><strong>Created At:</strong> {{ $driver->created_at->format('d M Y, h:i A') }}</p>
                <p><strong>Updated At:</strong> {{ $driver->updated_at->format('d M Y, h:i A') }}</p>
            </div>
        </div>

        <div class="mt-3">
            <a href="{{ route('drivers.index') }}" class="btn btn-secondary">Back to List</a>
            <a href="{{ route('drivers.edit', $driver->id) }}" class="btn btn-warning">Edit</a>
            <form action="{{ route('drivers.destroy', $driver->id) }}" method="POST" style="display:inline-block;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger"
                    onclick="return confirm('Are you sure you want to delete this driver?')">
                    Delete
                </button>
            </form>
        </div>
    </div>
@endsection
