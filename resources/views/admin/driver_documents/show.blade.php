@extends('layouts.admin')
@section('title', 'Driver Documents - ' . $driver->name)
@section('content')
@php use Illuminate\Support\Facades\Storage; @endphp

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold mb-0">Driver Documents</h2>
        <p class="text-muted mb-0">{{ $driver->name }} ({{ $driver->email }})</p>
    </div>
    <div class="d-flex gap-2">
        @if($driverDocument)
        <a href="{{ route('admin.driver_documents.edit', $driverDocument->id) }}" class="btn btn-warning shadow-sm">
            <i class="fas fa-edit me-1"></i> Edit Documents
        </a>
        <form action="{{ route('admin.driver_documents.destroy', $driverDocument->id) }}" method="POST"
            onsubmit="return confirm('Delete all documents for this driver?')">
            @csrf @method('DELETE')
            <button class="btn btn-danger shadow-sm">
                <i class="fas fa-trash me-1"></i> Delete
            </button>
        </form>
        @else
        <a href="{{ route('admin.driver_documents.create') }}" class="btn btn-success shadow-sm">
            <i class="fas fa-plus me-1"></i> Add Documents
        </a>
        @endif
        <a href="{{ route('admin.driver_documents.index') }}" class="btn btn-secondary shadow-sm">
            <i class="fas fa-arrow-left me-1"></i> Back
        </a>
    </div>
</div>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

@if($driverDocument)
<div class="row">
    <!-- Driver Info -->
    <div class="col-md-4 mb-4">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="fas fa-user me-2"></i>Driver Information</h5>
            </div>
            <div class="card-body">
                <p><strong>Name:</strong> {{ $driver->name }}</p>
                <p><strong>Email:</strong> {{ $driver->email }}</p>
                <p><strong>Phone:</strong> {{ $driver->phone ?? 'Not provided' }}</p>
                <hr>
                <p><strong>Status:</strong>
                    @if($driver->is_verified)
                    <span class="badge bg-success">Verified</span>
                    @else
                    <span class="badge bg-warning">Pending</span>
                    @endif
                </p>
                <div class="mt-3">
                    @if($driver->is_verified)
                    <form action="{{ route('admin.driver_documents.unverify', $driver->id) }}" method="POST">
                        @csrf
                        <button class="btn btn-warning btn-sm w-100"
                            onclick="return confirm('Revoke verification?')">
                            <i class="fas fa-times-circle me-1"></i> Revoke Verification
                        </button>
                    </form>
                    @else
                    <form action="{{ route('admin.driver_documents.verify', $driver->id) }}" method="POST">
                        @csrf
                        <button class="btn btn-success btn-sm w-100"
                            onclick="return confirm('Verify this driver?')">
                            <i class="fas fa-check-circle me-1"></i> Verify Driver
                        </button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Legal Documents -->
    <div class="col-md-8 mb-4">
        <div class="card shadow-sm">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0"><i class="fas fa-file-contract me-2"></i>Legal Documents</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    @foreach([
                    'driver_license_file' => "Driver's License",
                    'vehicle_registration_file' => 'Vehicle Registration',
                    'insurance_certificate_file' => 'Insurance Certificate',
                    ] as $field => $label)
                    <div class="col-md-4 mb-3">
                        <h6 class="text-primary">{{ $label }}</h6>
                        @if($driverDocument->$field)
                        <img src="{{ Storage::disk('spaces')->url($driverDocument->$field) }}"
                            alt="{{ $label }}"
                            class="img-fluid rounded border"
                            style="max-height: 400px;">
                        @else
                        <p class="text-muted">No document uploaded</p>
                        @endif
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Vehicle Photos -->
<div class="card shadow-sm">
    <div class="card-header bg-info text-white">
        <h5 class="mb-0"><i class="fas fa-images me-2"></i>Vehicle Photos</h5>
    </div>
    <div class="card-body">
        <div class="row">
            @for($i = 1; $i <= 3; $i++)
                <div class="col-md-4 mb-3">
                <h6 class="text-info">Vehicle Photo {{ $i }}</h6>
                @if($driverDocument->{'vehicle_photo_' . $i})
                <img src="{{ Storage::disk('spaces')->url($driverDocument->{'vehicle_photo_' . $i}) }}"
                    alt="Vehicle Photo {{ $i }}"
                    class="img-fluid rounded border"
                    style="max-height: 400px;">
                @else
                <p class="text-muted">No photo uploaded</p>
                @endif
        </div>
        @endfor
    </div>
</div>
</div>

@else
<div class="alert alert-warning">
    <i class="fas fa-exclamation-triangle me-2"></i>
    No documents found for this driver.
    <a href="{{ route('admin.driver_documents.create') }}" class="alert-link">Upload documents now</a>.
</div>
@endif
@endsection