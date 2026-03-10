@extends('layouts.admin')
@section('title', 'Edit Driver Documents')
@section('content')
<div class="card p-4 shadow-sm mx-auto" style="max-width: 700px;">
    <h4 class="mb-4">Edit Driver Documents</h4>
    <form action="{{ route('admin.driver_documents.update', $document->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <h6 class="text-success">Legal Documents</h6>
        @foreach([
        'driver_license_file' => "Driver's License",
        'vehicle_registration_file' => 'Vehicle Registration',
        'insurance_certificate_file' => 'Insurance Certificate',
        ] as $field => $label)
        <div class="mb-3">
            <label class="form-label">{{ $label }}</label>
            @if($document->$field)
            <div class="mb-1">
                <img src="{{ Storage::disk('spaces')->url($document->$field) }}"
                    class="img-thumbnail" style="max-height: 120px;">
            </div>
            @endif
            <input type="file" class="form-control" name="{{ $field }}" accept="image/*">
            <small class="text-muted">Leave blank to keep existing file</small>
        </div>
        @endforeach
        <hr>
        <h6 class="text-info">Vehicle Photos</h6>
        @for($i = 1; $i <= 3; $i++)
            <div class="mb-3">
            <label class="form-label">Vehicle Photo {{ $i }}</label>
            @if($document->{'vehicle_photo_' . $i})
            <div class="mb-1">
                <img src="{{ Storage::disk('spaces')->url($document->{'vehicle_photo_' . $i}) }}"
                    class="img-thumbnail" style="max-height: 120px;">
            </div>
            @endif
            <input type="file" class="form-control" name="vehicle_photo_{{ $i }}" accept="image/*">
            <small class="text-muted">Leave blank to keep existing file</small>
</div>
@endfor
@if($errors->any())
<div class="alert alert-danger">{{ $errors->first() }}</div>
@endif
<div class="d-flex gap-2">
    <button type="submit" class="btn btn-primary w-100">Update Documents</button>
    <a href="{{ route('admin.driver_documents.show', $document->user_id) }}" class="btn btn-secondary w-100">Cancel</a>
</div>
</form>
</div>
@endsection