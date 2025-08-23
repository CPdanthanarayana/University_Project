@extends('adminview.layout')

@push('styles')
<link rel="stylesheet" href="{{ asset('admincss/css/vehicleForm.css') }}">
@endpush

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Edit Vehicle</h1>
</div>

<!-- Success and Error Messages -->
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="container-fluid">
    <div class="row g-0">
        <div class="col-12">
            <div class="form-container">
                <h2>Update Vehicle Details</h2>

                <form action="{{ route('vehicle.update', $vehicle->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Basic Details -->
                    <div class="form-section">
                        <div class="section-title">Basic Details</div>
                        <div class="row">
                            <div class="col">
                                <label>Vehicle No:</label>
                                <input type="text" name="vehicle_no" value="{{ $vehicle->vehicle_no }}" required>
                            </div>
                            <div class="col">
                                <label>Vehicle Type:</label>
                                <select name="vehicle_type" required>
                                    <option value="car" {{ $vehicle->type == 'car' ? 'selected' : '' }}>Car</option>
                                    <option value="van" {{ $vehicle->type == 'van' ? 'selected' : '' }}>Van</option>
                                    <option value="bus" {{ $vehicle->type == 'bus' ? 'selected' : '' }}>Bus</option>
                                    <option value="utility vehicle" {{ $vehicle->type == 'utility vehicle' ? 'selected' : '' }}>Utility Vehicle</option>
                                </select>
                            </div>
                            <div class="col">
                                <label>Capacity:</label>
                                <input type="number" name="capacity" value="{{ $vehicle->capacity }}" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <label>Driver's Name:</label>
                                <input type="text" name="driver_name" value="{{ $vehicle->driver }}" required>
                            </div>
                        </div>
                    </div>

                    <!-- Operational & Maintenance Details -->
                    <div class="section-title">Operational & Maintenance Details</div>
                    <div class="row">
                        <div class="col">
                            <label>Fuel Type:</label>
                            <select name="fuel_type" required>
                                <option value="petrol" {{ $vehicle->fuel == 'petrol' ? 'selected' : '' }}>Petrol</option>
                                <option value="diesel" {{ $vehicle->fuel == 'diesel' ? 'selected' : '' }}>Diesel</option>
                                <option value="electric" {{ $vehicle->fuel == 'electric' ? 'selected' : '' }}>Electric</option>
                                <option value="hybrid" {{ $vehicle->fuel == 'hybrid' ? 'selected' : '' }}>Hybrid</option>
                            </select>
                        </div>
                        <div class="col">
                            <label>Insurance Expiry Date:</label>
                            <input type="date" name="insurance_expiry" value="{{ $vehicle->insurance_expiry }}">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <label>Additional Notes:</label>
                            <textarea name="notes">{{ $vehicle->notes }}</textarea>
                        </div>
                    </div>

                    <!-- Submit -->
                    <div class="form-actions mt-3">
                        <button class="submit-button btn btn-primary" type="submit">Update Vehicle</button>
                        <a href="{{ route('vehicle.index') }}" class="submit-button btn btn-secondary ms-2">Cancel</a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection
