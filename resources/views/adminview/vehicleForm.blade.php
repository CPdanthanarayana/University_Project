@extends('adminview.layout')

@push('styles')
<link rel="stylesheet" href="{{ asset('admincss/css/vehicleForm.css') }}">
@endpush

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Dashboard</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
            <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
            <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
        </div>
        <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
            <i class="bi bi-calendar"></i> This week
        </button>
    </div>
</div>
<div class="container-fluid px-4">
    <div class="row">
        <div class="col-12">
            <h1 class="mt-4 mb-4">Vehicle Registration</h1>
            <div class="form-container">
                <h2>VEHICLE REGISTRATION & DETAILS FORM</h2>

                <div id="message-container"></div>

                <form id="addVehicleForm" enctype="multipart/form-data">

                    <!-- Basic Details -->
                    <div class="section-title">Basic Details</div>
                    <div class="row">
                        <div class="col">
                            <label>1. Vehicle No:</label>
                            <input type="text" name="vehicle_no" placeholder="Ex: ABC-1234" required>
                        </div>
                        <div class="col">
                            <label>2. Vehicle Type:</label>
                            <select name="vehicle_type" required>
                                <option value="">-- Select vehicle type --</option>
                                <option value="car">Car</option>
                                <option value="van">Van</option>
                                <option value="bus">Bus</option>
                                <option value="utility vehicle">Utility vehicle</option>
                            </select>
                        </div>
                        <div class="col">
                            <label>3. Capacity:</label>
                            <input type="number" name="capacity" placeholder="Number of passengers" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <label>4. Driver's Name:</label>
                            <input type="text" name="driver_name" required>
                        </div>
                    </div>

                    <!-- Operational & Maintenance Details -->
                    <div class="section-title">Operational & Maintenance Details</div>
                    <div class="row">
                        <div class="col">
                            <label>5. Fuel Type:</label>
                            <select name="fuel_type" required>
                                <option value="">-- Select type --</option>
                                <option value="petrol">Petrol</option>
                                <option value="diesel">Diesel</option>
                                <option value="electric">Electric</option>
                                <option value="hybrid">Hybrid</option>
                            </select>
                        </div>
                        <div class="col">
                            <label>6. Insurance Expiry Date:</label>
                            <input type="date" name="insurance_expiry">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <label>7. Additional Notes:</label>
                            <textarea name="notes" placeholder="Any additional information about the vehicle..."></textarea>
                        </div>
                    </div>

                    <!-- Submit -->
                    <button class="submit-button" type="submit">Submit</button>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.getElementById('addVehicleForm').addEventListener('submit', function(e) {
    e.preventDefault();

    let errors = [];

    const vehicleNo = this.vehicle_no.value.trim();
    const vehicleType = this.vehicle_type.value;
    const capacity = this.capacity.value.trim();
    const driverName = this.driver_name.value.trim();
    const fuelType = this.fuel_type.value;

    if(vehicleNo.length < 5) errors.push("Vehicle number must be at least 5 characters.");
    if(!vehicleType) errors.push("Please select a vehicle type.");
    if(!capacity || isNaN(capacity) || Number(capacity) <= 0) errors.push("Capacity must be a positive number.");
    if(driverName.length < 3) errors.push("Driver's name must be at least 3 characters.");
    if(!fuelType) errors.push("Please select a fuel type.");

    const messageContainer = document.getElementById('message-container');
    if(errors.length > 0){
        messageContainer.style.display = 'block';
        messageContainer.className = 'error';
        messageContainer.innerHTML = errors.join('<br>');
        window.scrollTo(0,0);
    } else {
        messageContainer.style.display = 'none';
        this.submit();
    }
});
</script>
@endpush
