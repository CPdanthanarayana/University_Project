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
}
