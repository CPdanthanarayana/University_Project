<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ApplicantController extends Controller
{
    /**
     * Display a listing of applicants.
     */
    public function index()
    {
        $applicants = Applicant::with('applications')->paginate(15);
        return view('applicants.index', compact('applicants'));
    }

    /**
     * Show the form for creating a new applicant.
     */
    public function create()
    {
        return view('applicants.create');
    }

    /**
     * Store a newly created applicant in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'service_no' => 'nullable|string|max:255|unique:applicants,service_no',
            'name' => 'required|string|max:255',
            'designation' => 'nullable|string|max:255',
            'faculty' => 'nullable|string|max:255',
            'department' => 'nullable|string|max:255',
            'contact_no' => 'nullable|string|max:20',
        ]);

        $applicant = Applicant::create($validated);

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Applicant created successfully!',
                'data' => $applicant
            ], 201);
        }

        return redirect()->route('applicants.index')
            ->with('success', 'Applicant created successfully!');
    }

    /**
     * Display the specified applicant.
     */
    public function show(Applicant $applicant)
    {
        $applicant->load(['applications.application_members', 'applications.application_visits']);
        return view('applicants.show', compact('applicant'));
    }

    /**
     * Show the form for editing the specified applicant.
     */
    public function edit(Applicant $applicant)
    {
        return view('applicants.edit', compact('applicant'));
    }

    /**
     * Update the specified applicant in storage.
     */
    public function update(Request $request, Applicant $applicant)
    {
        $validated = $request->validate([
            'service_no' => 'nullable|string|max:255|unique:applicants,service_no,' . $applicant->id,
            'name' => 'required|string|max:255',
            'designation' => 'nullable|string|max:255',
            'faculty' => 'nullable|string|max:255',
            'department' => 'nullable|string|max:255',
            'contact_no' => 'nullable|string|max:20',
        ]);

        $applicant->update($validated);

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Applicant updated successfully!',
                'data' => $applicant
            ]);
        }

        return redirect()->route('applicants.index')
            ->with('success', 'Applicant updated successfully!');
    }

    /**
     * Remove the specified applicant from storage.
     */
    public function destroy(Applicant $applicant)
    {
        try {
            $applicant->delete();
            
            return response()->json([
                'success' => true,
                'message' => 'Applicant deleted successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting applicant: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Search applicants by name or service number.
     */
    public function search(Request $request): JsonResponse
    {
        $query = $request->get('q');
        
        $applicants = Applicant::where('name', 'LIKE', "%{$query}%")
            ->orWhere('service_no', 'LIKE', "%{$query}%")
            ->limit(10)
            ->get(['id', 'name', 'service_no', 'designation', 'department']);

        return response()->json($applicants);
    }
}
