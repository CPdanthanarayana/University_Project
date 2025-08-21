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

    // Remove a vehicle
    public function destroy(Vehicle $vehicle)
    {
        $vehicle->delete();
        return redirect()->route('vehicle.index')->with('success', 'Vehicle deleted successfully!');
    }
}
