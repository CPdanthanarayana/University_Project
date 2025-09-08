<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class ApplicationAllocationController extends Controller
{
    public function availableVehicles($id)
    {
        // Just make sure the application exists
        $application = Application::findOrFail($id);

        // Get all vehicles that are currently available
        $vehicles = Vehicle::where('status', 'available')->get();

        return response()->json($vehicles);
    }

    public function allocateVehicle(Request $request)
    {
        $request->validate([
            'application_id' => 'required|exists:applications,id',
            'vehicle_id' => 'required|exists:vehicles,id',
        ]);

        $application = Application::findOrFail($request->application_id);
        $vehicle = Vehicle::findOrFail($request->vehicle_id);

        if ($vehicle->status !== 'available') {
            return response()->json([
                'success' => false,
                'message' => 'Vehicle not available'
            ], 400);
        }

        // Transaction for safety
        \DB::transaction(function () use ($application, $vehicle) {
            // Reserve vehicle
            $vehicle->update(['status' => 'reserved']);

            // Update application
            $application->update([
                'status' => 'allocated',
                'vehicle_id' => $vehicle->id
            ]);
        });

        return response()->json([
            'success' => true,
            'message' => 'Vehicle allocated successfully',
            'application_id' => $application->id,
            'vehicle_id' => $vehicle->id
        ], 200);
    }


}
