@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Schools</h1>

        <a href="{{ route('schools.create') }}" class="btn btn-primary mb-3">Add School</a>

        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Contract Type</th>
                    <th>Payment Status</th>
                    <th>Contact Details</th>
                    <th>Charges</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($schools as $school)
                    <tr>
                        <td>{{ $school->name }}</td>
                        <td>{{ $school->address }}</td>
                        <td>{{ $school->contract_type }}</td>
                        <td>{{ $school->payment_status }}</td>
                        <td>{{ $school->contact_details }}</td>
                        <td>{{ $school->charges }}</td>
                        <td>
                            <a href="{{ route('schools.show', $school->id) }}" class="btn btn-info">View</a>
                            <a href="{{ route('schools.edit', $school->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('schools.destroy', $school->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Delete this school?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
