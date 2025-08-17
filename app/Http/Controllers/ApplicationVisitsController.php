<?php

namespace App\Http\Controllers;

use App\Models\ApplicationVisit;
use App\Models\Application;
use Illuminate\Http\Request;

class ApplicationVisitsController extends Controller
{
    /**
     * Display a listing of application visits.
     */
    public function index(Application $application)
    {
        $visits = $application->application_visits()->orderBy('visit_date', 'desc')->get();
        return response()->json($visits);
    }

    /**
     * Show the form for creating a new visit record.
     */
    public function create(Application $application)
    {
        return view('application-visits.create', compact('application'));
    }

    /**
     * Store a newly created visit record.
     */
    public function store(Request $request, Application $application)
    {
        $validated = $request->validate([
            'visit_date' => 'required|date',
            'visit_time' => 'nullable|string',
            'purpose' => 'required|string',
            'location' => 'required|string|max:255',
            'notes' => 'nullable|string',
            'status' => 'nullable|in:scheduled,completed,cancelled',
        ]);

        $visit = ApplicationVisit::create([
            'application_id' => $application->id,
            'visit_date' => $validated['visit_date'],
            'visit_time' => $validated['visit_time'] ?? null,
            'purpose' => $validated['purpose'],
            'location' => $validated['location'],
            'notes' => $validated['notes'] ?? null,
            'status' => $validated['status'] ?? 'scheduled',
        ]);

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Visit record created successfully!',
                'data' => $visit
            ], 201);
        }

        return redirect()->route('applications.show', $application)
            ->with('success', 'Visit record created successfully!');
    }

    /**
     * Display the specified visit record.
     */
    public function show(ApplicationVisit $applicationVisit)
    {
        $applicationVisit->load('application');
        return view('application-visits.show', compact('applicationVisit'));
    }

    /**
     * Show the form for editing the specified visit record.
     */
    public function edit(ApplicationVisit $applicationVisit)
    {
        return view('application-visits.edit', compact('applicationVisit'));
    }

    /**
     * Update the specified visit record.
     */
    public function update(Request $request, ApplicationVisit $applicationVisit)
    {
        $validated = $request->validate([
            'visit_date' => 'required|date',
            'visit_time' => 'nullable|string',
            'purpose' => 'required|string',
            'location' => 'required|string|max:255',
            'notes' => 'nullable|string',
            'status' => 'nullable|in:scheduled,completed,cancelled',
        ]);

        $applicationVisit->update($validated);

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Visit record updated successfully!',
                'data' => $applicationVisit
            ]);
        }

        return redirect()->route('applications.show', $applicationVisit->application)
            ->with('success', 'Visit record updated successfully!');
    }

    /**
     * Remove the specified visit record.
     */
    public function destroy(ApplicationVisit $applicationVisit)
    {
        try {
            $applicationVisit->delete();
            
            return response()->json([
                'success' => true,
                'message' => 'Visit record deleted successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting visit record: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update visit status.
     */
    public function updateStatus(Request $request, ApplicationVisit $applicationVisit)
    {
        $validated = $request->validate([
            'status' => 'required|in:scheduled,completed,cancelled',
            'notes' => 'nullable|string'
        ]);

        $applicationVisit->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Visit status updated successfully!',
            'data' => $applicationVisit
        ]);
    }

    /**
     * Get visits by date range.
     */
    public function getByDateRange(Request $request)
    {
        $validated = $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'application_id' => 'nullable|exists:applications,id'
        ]);

        $query = ApplicationVisit::with('application')
            ->whereBetween('visit_date', [$validated['start_date'], $validated['end_date']]);

        if (!empty($validated['application_id'])) {
            $query->where('application_id', $validated['application_id']);
        }

        $visits = $query->orderBy('visit_date', 'asc')->get();

        return response()->json([
            'success' => true,
            'data' => $visits
        ]);
    }
}
