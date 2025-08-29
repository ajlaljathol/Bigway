@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>School Details</h1>

        <div class="card mb-4">
            <div class="card-body">
                <p><strong>Name:</strong> {{ $school->name }}</p>
                <p><strong>Address:</strong> {{ $school->address }}</p>
                <p><strong>Contract Type:</strong> {{ $school->contract_type }}</p>
                <p><strong>Payment Status:</strong> {{ $school->payment_status }}</p>
                <p><strong>Contact Details:</strong> {{ $school->contact_details }}</p>
                <p><strong>Charges:</strong> {{ $school->charges }}</p>
            </div>
        </div>

        {{-- Optional: List students of this school --}}
        @if(isset($school->students) && $school->students->count())
            <h3>Students in this School</h3>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Age</th>
                        <th>Emergency Contact</th>
                        <th>Blood Group</th>
                        <th>Address</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($school->students as $student)
                        <tr>
                            <td>{{ $student->name }}</td>
                            <td>{{ $student->age }}</td>
                            <td>{{ $student->emerg_contact }}</td>
                            <td>{{ $student->blood_grp }}</td>
                            <td>{{ $student->address }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

        <a href="{{ route('schools.index') }}" class="btn btn-secondary mt-3">Back to List</a>
    </div>
@endsection
