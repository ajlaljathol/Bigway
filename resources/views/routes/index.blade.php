@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Routes</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="mb-3">
            <a href="{{ route('routes.create') }}" class="btn btn-primary">+ Add New Route</a>
        </div>

        @if ($routes->count())
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Starting Time</th>
                        <th>Total Distance (km)</th>
                        {{--    <th>Vehicle</th> --}}
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($routes as $route)
                        <tr>
                            <td>{{ $route->starting_time }}</td>
                            <td>{{ $route->total_distance }}</td>
                            <td>{{ $route->vehicle->name ?? 'Not Assigned' }}</td>
                            <td>
                                <a href="{{ route('routes.show', $route->id) }}" class="btn btn-info btn-sm">View</a>
                                <a href="{{ route('routes.edit', $route->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('routes.destroy', $route->id) }}" method="POST"
                                    style="display:inline-block;"
                                    onsubmit="return confirm('Are you sure you want to delete this route?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No routes found. <a href="{{ route('routes.create') }}">Create one</a>.</p>
        @endif
    </div>
@endsection
