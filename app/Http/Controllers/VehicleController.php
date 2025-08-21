<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    // Show all vehicles
    public function index()
    {
        $vehicles = Vehicle::all();
        return view('adminview.vehicleform', compact('vehicles'));
    }

    // Store a new vehicle 
    public function store(Request $request)
    {
        // Validate form data
        $validated = $request->validate([
            'vehicle_no' => 'required|unique:vehicles,vehicle_no',
            'type' => 'required',
            'capacity' => 'required|integer|min:1',
            'driver' => 'required|string',
            'fuel' => 'required',
            'insurance_expiry' => 'nullable|date',
            'notes' => 'nullable|string',
        ]);

        // Save into database
        Vehicle::create($validated);

        // Redirect back with success message
        return redirect()->route('vehicle.index')->with('success', 'Vehicle added successfully!');
    }

    // Remove a vehicle
    public function destroy(Vehicle $vehicle)
    {
        $vehicle->delete();
        return redirect()->route('vehicle.index')->with('success', 'Vehicle deleted successfully!');
    }

    // Edit a vehicle's details
    public function edit(Vehicle $vehicle)
    {
        return view('adminview.vehicleEdit', compact('vehicle'));
    }

    // Update vehicle details
    public function update(Request $request, Vehicle $vehicle)
    {
        $request->validate([
            'vehicle_no' => 'required|unique:vehicles,vehicle_no,' . $vehicle->id,
            'vehicle_type' => 'required',
            'capacity' => 'required|integer|min:1',
            'driver_name' => 'required|min:3',
            'fuel_type' => 'required',
        ]);

        $vehicle->update([
            'vehicle_no' => $request->vehicle_no,
            'type' => $request->vehicle_type,
            'capacity' => $request->capacity,
            'driver' => $request->driver_name,
            'fuel' => $request->fuel_type,
            'insurance_expiry' => $request->insurance_expiry,
            'notes' => $request->notes,
        ]);

        return redirect()->route('vehicle.index')->with('success', 'Vehicle updated successfully!');
    }

    //Update the status of a vehicle
    public function updateStatus(Request $request, Vehicle $vehicle)
    {
        $request->validate([
            'status' => 'required|in:available,under_maintenance,reserved,out_of_service',
        ]);

        $vehicle->status = $request->status;
        $vehicle->save();

        return redirect()->back()->with('success', 'Vehicle status updated successfully!');
    }

}
