@extends('layouts.admin')
@section('title', 'Add Driver Documents')
@section('content')
<div class="card p-4 shadow-sm mx-auto" style="max-width: 700px;">
    <h4 class="mb-4">Upload Driver Documents</h4>
    <form action="{{ route('admin.driver_documents.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label class="form-label">Driver</label>
            <select class="form-select" name="driver_id" required>
                <option value="">Select Driver</option>
                @foreach($drivers as $driver)
                <option value="{{ $driver->id }}">{{ $driver->name }} ({{ $driver->email }})</option>
                @endforeach
            </select>
        </div>
        <hr>
        <h6 class="text-success">Legal Documents</h6>
        <div class="mb-3">
            <label class="form-label">Driver's License</label>
            <input type="file" class="form-control" name="driver_license_file" accept="image/*">
        </div>
        <div class="mb-3">
            <label class="form-label">Vehicle Registration</label>
            <input type="file" class="form-control" name="vehicle_registration_file" accept="image/*">
        </div>
        <div class="mb-3">
            <label class="form-label">Insurance Certificate</label>
            <input type="file" class="form-control" name="insurance_certificate_file" accept="image/*">
        </div>
        <hr>
        <h6 class="text-info">Vehicle Photos</h6>
        @for($i = 1; $i <= 3; $i++)
            <div class="mb-3">
            <label class="form-label">Vehicle Photo {{ $i }}</label>
            <input type="file" class="form-control" name="vehicle_photo_{{ $i }}" accept="image/*">
</div>
@endfor
<button type="submit" class="btn btn-success w-100">
    <i class="fas fa-upload me-1"></i> Upload Documents
</button>
</form>
</div>
@endsection
