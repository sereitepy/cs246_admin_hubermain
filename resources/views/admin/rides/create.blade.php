@extends('layouts.admin')
@section('title', 'Add Ride')
@section('subtitle', 'Create a new ride')
@section('content')
<div class="card p-4 shadow-sm mx-auto" style="max-width: 600px;">
    <form action="{{ route('admin.rides.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="user_id" class="form-label">Driver</label>
            <select class="form-select" id="user_id" name="user_id" required>
                <option value="">Select Driver</option>
                @foreach($drivers as $driver)
                <option value="{{ $driver->id }}" {{ old('user_id') == $driver->id ? 'selected' : '' }}>{{ $driver->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="station_location" class="form-label">Origin</label>
            <input type="text" class="form-control" id="station_location" name="station_location" value="{{ old('station_location') }}" required>
        </div>
        <div class="mb-3">
            <label for="destination" class="form-label">Destination</label>
            <input type="text" class="form-control" id="destination" name="destination" value="{{ old('destination') }}" required>
        </div>
        <div class="mb-3">
            <label for="date" class="form-label">Date</label>
            <input type="date" class="form-control" id="date" name="date" value="{{ old('date') }}" required>
        </div>
        <div class="mb-3">
            <label for="time" class="form-label">Time</label>
            <input type="time" class="form-control" id="time" name="time" value="{{ old('time') }}" required>
        </div>
        <div class="mb-3">
            <label for="available_seats" class="form-label">Available Seats</label>
            <input type="number" class="form-control" id="available_seats" name="available_seats" value="{{ old('available_seats') }}" min="1" max="20" required>
        </div>
        <div class="mb-3">
            <label for="go_to_price_per_person" class="form-label">Price Per Person</label>
            <input type="number" step="0.01" class="form-control" id="go_to_price_per_person" name="go_to_price_per_person" value="{{ old('go_to_price_per_person') }}">
        </div>
        <div class="mb-3">
            <label for="go_to_exclusive_price" class="form-label">Exclusive Price</label>
            <input type="number" step="0.01" class="form-control" id="go_to_exclusive_price" name="go_to_exclusive_price" value="{{ old('go_to_exclusive_price') }}">
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="is_exclusive" name="is_exclusive" value="1" {{ old('is_exclusive') ? 'checked' : '' }}>
            <label class="form-check-label" for="is_exclusive">Exclusive Ride</label>
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="is_two_way" name="is_two_way" value="1" {{ old('is_two_way') ? 'checked' : '' }}>
            <label class="form-check-label" for="is_two_way">Two Way Ride</label>
        </div>
        <button type="submit" class="btn btn-success w-100">
            <i class="fas fa-plus me-1"></i> Add Ride
        </button>
    </form>
</div>
@endsection
