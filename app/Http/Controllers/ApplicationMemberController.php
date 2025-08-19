<?php

namespace App\Http\Controllers;

use App\Models\ApplicationMember;
use App\Models\Application;
use Illuminate\Http\Request;

class ApplicationMemberController extends Controller
{
    /**
     * Display a listing of application members.
     */
    public function index(Application $application)
    {
        $members = $application->application_members()->get();
        return response()->json($members);
    }

    /**
     * Store a newly created application member.
     */
    public function store(Request $request, Application $application)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'service_no' => 'nullable|string|max:255',
        ]);

        $member = ApplicationMember::create([
            'application_id' => $application->id,
            'name' => $validated['name'],
            'service_no' => $validated['service_no'] ?? null,
        ]);

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Member added successfully!',
                'data' => $member
            ], 201);
        }

        return redirect()->back()->with('success', 'Member added successfully!');
    }

    /**
     * Display the specified application member.
     */
    public function show(ApplicationMember $applicationMember)
    {
        $applicationMember->load('application');
        return response()->json($applicationMember);
    }

    /**
     * Update the specified application member.
     */
    public function update(Request $request, ApplicationMember $applicationMember)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'service_no' => 'nullable|string|max:255',
        ]);

        $applicationMember->update($validated);

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Member updated successfully!',
                'data' => $applicationMember
            ]);
        }

        return redirect()->back()->with('success', 'Member updated successfully!');
    }

    /**
     * Remove the specified application member.
     */
    public function destroy(ApplicationMember $applicationMember)
    {
        try {
            $applicationMember->delete();
            
            return response()->json([
                'success' => true,
                'message' => 'Member removed successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error removing member: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Add multiple members to an application.
     */
    public function bulkStore(Request $request, Application $application)
    {
        $validated = $request->validate([
            'members' => 'required|array',
            'members.*.name' => 'required|string|max:255',
            'members.*.service_no' => 'nullable|string|max:255',
        ]);

        $members = [];
        foreach ($validated['members'] as $memberData) {
            $members[] = ApplicationMember::create([
                'application_id' => $application->id,
                'name' => $memberData['name'],
                'service_no' => $memberData['service_no'] ?? null,
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => count($members) . ' members added successfully!',
            'data' => $members
        ], 201);
    }
}
