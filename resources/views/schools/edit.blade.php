@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit School</h1>

        <form action="{{ route('schools.update', $school->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $school->name }}" required>
            </div>

            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <input type="text" class="form-control" id="address" name="address" value="{{ $school->address }}" required>
            </div>

            <div class="mb-3">
                <label for="contract_type" class="form-label">Contract Type</label>
                <input type="text" class="form-control" id="contract_type" name="contract_type" value="{{ $school->contract_type }}" required>
            </div>

            <div class="mb-3">
                <label for="payment_status" class="form-label">Payment Status</label>
                <input type="text" class="form-control" id="payment_status" name="payment_status" value="{{ $school->payment_status }}" required>
            </div>

            <div class="mb-3">
                <label for="contact_details" class="form-label">Contact Details</label>
                <input type="text" class="form-control" id="contact_details" name="contact_details" value="{{ $school->contact_details }}" required>
            </div>

            <div class="mb-3">
                <label for="charges" class="form-label">Charges</label>
                <input type="number" step="0.01" class="form-control" id="charges" name="charges" value="{{ $school->charges }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
