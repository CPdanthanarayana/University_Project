@extends('adminview.layout')

@push('styles')
<link rel="stylesheet" href="{{ asset('admincss/css/vehicleForm.css') }}">
@endpush

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Vehicle Management</h1>
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
                <h2>Add New Vehicle</h2>

                <div id="message-container"></div>

                <form id="addVehicleForm" action="{{ route('vehicle.store') }}" method="POST">
                    @csrf

                    <!-- Basic Details -->
                    <div class="form-section">
                        <div class="section-title">Basic Details</div>
                        <div class="row">
                            <div class="col">
                                <label>1. Vehicle No:</label>
                                <input type="text" name="vehicle_no" placeholder="Ex: ABC-1234" required>
                            </div>
                            <div class="col">
                                <label>2. Vehicle Type:</label>
                                <select name="type" required>
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
                                <input type="text" name="driver" required>
                            </div>
                        </div>
                    </div>

                    <!-- Operational & Maintenance Details -->
                    <div class="section-title">Operational & Maintenance Details</div>
                    <div class="row">
                        <div class="col">
                            <label>5. Fuel Type:</label>
                            <select name="fuel" required>
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
                    <div class="form-actions">
                        <button class="submit-button" type="submit">Add Vehicle</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<!-- Vehicle Table -->
<div class="card mt-5 shadow-lg border-0 rounded-xl">
    <!-- Header -->
    <div class="card-header bg-gradient-to-r from-purple-600 to-indigo-500 text-black d-flex justify-content-between align-items-center py-3 px-4">
        <h5 class="mb-0 text-lg font-semibold text-black tracking-wide">Vehicles List</h5>

    </div>

    <!-- Body -->
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table align-middle mb-0" style="min-width: 100%;">
                <thead class="bg-purple-50 text-purple-700 text-sm uppercase font-semibold border-bottom">
                    <tr>
                        <th>ID</th>
                        <th>Vehicle No</th>
                        <th>Type</th>
                        <th>Capacity</th>
                        <th>Driver</th>
                        <th>Fuel</th>
                        <th>Insurance Expiry</th>
                        <th>Notes</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="vehicleTable" class="text-sm">
                    @if(isset($vehicles) && count($vehicles) > 0)
                        @foreach($vehicles as $vehicle)
                            <tr class="hover:bg-purple-50 transition-colors">
                                <td>{{ $vehicle->id }}</td>
                                <td>{{ $vehicle->vehicle_no }}</td>
                                <td>{{ ucfirst($vehicle->type) }}</td>
                                <td>{{ $vehicle->capacity }}</td>
                                <td>{{ $vehicle->driver }}</td>
                                <td>{{ ucfirst($vehicle->fuel) }}</td>
                                <td>{{ $vehicle->insurance_expiry ?? '-' }}</td>
                                <td>{{ Str::limit($vehicle->notes, 30) ?? '-' }}</td>
                                <td>
                                    <span class="badge
                                        {{ $vehicle->status == 'available' ? 'bg-success' :
                                        ($vehicle->status == 'under_maintenance' ? 'bg-warning' :
                                        ($vehicle->status == 'reserved' ? 'bg-info' : 'bg-secondary')) }}">
                                        {{ ucfirst(str_replace('_', ' ', $vehicle->status)) }}
                                    </span>
                                </td>
                                <td>
                                    <form action="{{ route('vehicle.delete', $vehicle->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger px-3">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="10" class="text-center py-4">No vehicles found</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

        <!-- Pagination & Rows per page -->
        <div class="d-flex justify-content-between align-items-center mt-3 px-4 py-3 border-top bg-purple-50 rounded-b-xl">
            <div class="d-flex align-items-center gap-2">
                <label for="rowsPerPage" class="mb-0 font-semibold text-purple-700">Show:</label>
                <select id="rowsPerPage" class="form-select form-select-sm" style="width: 70px;">
                    <option>5</option>
                    <option selected>10</option>
                    <option>25</option>
                    <option>50</option>
                </select>
            </div>
            <nav aria-label="Page navigation">
                <ul class="pagination pagination-sm mb-0">
                    <li class="page-item disabled">
                        <a class="page-link text-purple-700" href="#" tabindex="-1">Previous</a>
                    </li>
                    <li class="page-item active"><a class="page-link bg-purple-600 border-0 text-white" href="#">1</a></li>
                    <li class="page-item"><a class="page-link text-purple-700" href="#">2</a></li>
                    <li class="page-item"><a class="page-link text-purple-700" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link text-purple-700" href="#">Next</a>
                    </li>
                </ul>
            </nav>
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
    const vehicleType = this.type.value;
    const capacity = this.capacity.value.trim();
    const driverName = this.driver.value.trim();
    const fuelType = this.fuel.value;
    const insuranceExpiry = this.insurance_expiry.value || '-';
    const notes = this.notes.value.trim() || '-';

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


// Add new vehicle row dynamically from form
document.getElementById('addVehicleForm').addEventListener('submit', function(e) {
    e.preventDefault();

    const vehicleNo = this.vehicle_no.value.trim();
    const vehicleType = this.type.value;
    const capacity = this.capacity.value.trim();
    const driverName = this.driver.value.trim();
    const fuelType = this.fuel.value;
    const insuranceExpiry = this.insurance_expiry.value || '-';
    const notes = this.notes.value.trim() || '-';

    if(!vehicleNo || !vehicleType || !capacity || !driverName || !fuelType){
        alert("Please fill in all required fields.");
        return;
    }

    const table = document.getElementById('vehicleTable');
    const rowCount = table.rows.length + 1;

    const newRow = table.insertRow();
    newRow.classList.add('hover:bg-purple-50', 'transition-colors', 'duration-150');
    newRow.innerHTML = `
        <td class="px-4 py-2 text-sm text-purple-700 font-medium">${rowCount}</td>
        <td class="px-4 py-2 text-sm text-purple-700">${vehicleNo}</td>
        <td class="px-4 py-2 text-sm text-purple-700">${vehicleType}</td>
        <td class="px-4 py-2 text-sm text-purple-700">${capacity}</td>
        <td class="px-4 py-2 text-sm text-purple-700">${driverName}</td>
        <td class="px-4 py-2 text-sm text-purple-700">${fuelType}</td>
        <td class="px-4 py-2 text-sm text-purple-700">${insuranceExpiry}</td>
        <td class="px-4 py-2 text-sm text-purple-700">${notes}</td>
        <td class="px-4 py-2 text-sm">
            <span class="badge bg-success text-white px-3 py-1 rounded-pill">Available</span>
        </td>
        <td class="px-4 py-2 text-sm flex gap-2">
            <button class="btn btn-outline-warning btn-sm px-3">Edit</button>
            <button class="btn btn-outline-danger btn-sm px-3">Delete</button>
        </td>
    `;

    this.submit(); //send data to backend
    this.reset(); //reset form fields
});



</script>
@endpush
