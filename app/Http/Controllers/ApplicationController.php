<?php

namespace App\Http\Controllers;

use App\Models\Application;

use App\Models\Applicant;
use App\Models\ApplicationMember;
use App\Models\ApplicationVisit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class ApplicationController extends Controller
{
    public function adminIndex()
    {
        $applications = Application::with(['applicant', 'user'])->orderBy('created_at', 'desc')->get();

        return view('adminview.index', compact('applications'));
    }

    /**
     * Show the form for creating a new application.
     */
    public function create()
    {
        $applicants = Applicant::orderBy('name')->get();
        return view('applications.create', compact('applicants'));
    }

    /**
     * Store a newly created application in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            // UI form field names (support both old and new formats)
            'service_no_name' => 'nullable|string|max:255', // New UI format
            'applicant_id' => 'nullable|exists:applicants,id',
            'applicant_name' => 'required_without:applicant_id|string|max:255',
            'service_no' => 'nullable|string|max:255',
            'designation' => 'required|string|max:255',
            'faculty' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'contact_no' => 'required|string|max:20',

            // Application details with UI field mapping
            'purpose' => 'required|string',
            'supporting_docs' => 'required|in:yes,no', // UI radio button format
            'supporting_documents' => 'nullable|array',
            'supporting_documents.*' => 'file|mimes:pdf,doc,docx,jpg,jpeg,png|max:5120',
            'program' => 'nullable|string|max:255',
            'from' => 'nullable|string|max:255', // UI field name
            'to' => 'nullable|string|max:255',   // UI field name
            'from_location' => 'nullable|string|max:255', // API field name
            'to_location' => 'nullable|string|max:255',   // API field name
            'departure_date' => 'required|date',
            'departure_time' => 'nullable|date_format:H:i',
            'return_date' => 'required|date|after_or_equal:departure_date',
            'return_time' => 'nullable|date_format:H:i',
            'route' => 'nullable|string|max:500',
            'parking_place' => 'nullable|string|max:255',

            // Signature with UI field mapping
            'applicant_signature' => 'nullable|file|mimes:jpg,jpeg,png|max:2048', // UI field name
            'applicant_signature_path' => 'nullable|file|mimes:jpg,jpeg,png|max:2048', // API field name
            'applicant_date' => 'nullable|date', // UI field name
            'applicant_signed_date' => 'nullable|date', // API field name

            // Program visits (UI format)
            'prog1_date' => 'nullable|date',
            'prog1_place' => 'nullable|string|max:255',
            'prog2_date' => 'nullable|date',
            'prog2_place' => 'nullable|string|max:255',
            'prog3_date' => 'nullable|date',
            'prog3_place' => 'nullable|string|max:255',
            'prog4_date' => 'nullable|date',
            'prog4_place' => 'nullable|string|max:255',

            // Members (UI format - support both existing and new)
            'members' => 'nullable|array',
            'members.*.name' => 'required|string|max:255',
            'members.*.service_no' => 'nullable|string|max:255',

            // UI member format (sn1_name, sn2_name, etc.)
            'sn1_service_no' => 'nullable|string|max:50',
            'sn1_name' => 'nullable|string|max:255',
            'sn2_service_no' => 'nullable|string|max:50',
            'sn2_name' => 'nullable|string|max:255',
            'sn3_service_no' => 'nullable|string|max:50',
            'sn3_name' => 'nullable|string|max:255',
            'sn4_service_no' => 'nullable|string|max:50',
            'sn4_name' => 'nullable|string|max:255',
            'sn5_service_no' => 'nullable|string|max:50',
            'sn5_name' => 'nullable|string|max:255',

            // Authentication
            'user_id' => 'nullable|exists:users,id'
        ]);

        try {
            DB::beginTransaction();

            // Transform UI field names to match model expectations
            // Handle service_no_name format (e.g., "EMP001 - John Doe")
            if (!empty($validated['service_no_name'])) {
                $serviceNoName = explode(' - ', $validated['service_no_name']);
                $validated['service_no'] = trim($serviceNoName[0]);
                $validated['applicant_name'] = isset($serviceNoName[1]) ? trim($serviceNoName[1]) : '';
            }

            // Map UI location fields to model fields
            $validated['from_location'] = $validated['from'] ?? $validated['from_location'] ?? '';
            $validated['to_location'] = $validated['to'] ?? $validated['to_location'] ?? '';

            // Map UI signature fields
            $signatureFile = $request->file('applicant_signature') ?? $request->file('applicant_signature_path');
            $validated['applicant_signed_date'] = $validated['applicant_date'] ?? $validated['applicant_signed_date'] ?? null;

            // Create or find applicant
            if (!$validated['applicant_id']) {
                $applicant = Applicant::updateOrCreate(
                    ['service_no' => $validated['service_no']],
                    [
                        'name' => $validated['applicant_name'],
                        'designation' => $validated['designation'] ?? null,
                        'faculty' => $validated['faculty'] ?? null,
                        'department' => $validated['department'] ?? null,
                        'contact_no' => $validated['contact_no'] ?? null,
                    ]
                );
                $validated['applicant_id'] = $applicant->id;
            }

            // Handle multiple supporting documents
            $supportingDocsPath = null;
            if ($request->hasFile('supporting_documents')) {
                $documentPaths = [];
                foreach ($request->file('supporting_documents') as $file) {
                    $path = $file->store('supporting_documents', 'public');
                    $documentPaths[] = $path;
                }
                $supportingDocsPath = json_encode($documentPaths);
                $validated['documents_attached'] = true;
            } elseif ($request->hasFile('supporting_docs')) {
                // Handle legacy single file upload
                $supportingDocsPath = $request->file('supporting_docs')->store('docs', 'public');
                $validated['documents_attached'] = true;
            } else {
                $validated['documents_attached'] = $validated['supporting_docs'] === 'yes';
            }

            // Handle signature upload
            if ($signatureFile) {
                $validated['applicant_signature_path'] = $signatureFile->store('signatures', 'public');
            }

            // Set user_id with fallback to authenticated user or provided user_id
            $validated['user_id'] = auth()->id() ?? $validated['user_id'] ?? null;

            if (!$validated['user_id']) {
                throw new \Exception('User authentication required');
            }

            // Create application
            $application = Application::create([
                'user_id' => $validated['user_id'],
                'applicant_id' => $validated['applicant_id'],
                'purpose' => $validated['purpose'],
                'documents_attached' => $validated['documents_attached'],
                'supporting_docs' => $supportingDocsPath,
                'program' => $validated['program'] ?? null,
                'from_location' => $validated['from_location'],
                'to_location' => $validated['to_location'],
                'departure_date' => $validated['departure_date'],
                'return_date' => $validated['return_date'],
                'applicant_signature_path' => $validated['applicant_signature_path'] ?? null,
                'applicant_signed_date' => $validated['applicant_signed_date'],
                'status' => 'pending',
            ]);

            // Add members from both formats
            $membersCreated = 0;

            // Handle legacy members array format
            if (!empty($validated['members'])) {
                foreach ($validated['members'] as $member) {
                    ApplicationMember::create([
                        'application_id' => $application->id,
                        'name' => $member['name'],
                        'service_no' => $member['service_no'] ?? null,
                    ]);
                    $membersCreated++;
                }
            }

            // Handle UI format members (sn1_name, sn2_name, etc.)
            for ($i = 1; $i <= 10; $i++) {
                $serviceNoKey = "sn{$i}_service_no";
                $nameKey = "sn{$i}_name";

                if (!empty($validated[$serviceNoKey]) && !empty($validated[$nameKey])) {
                    ApplicationMember::create([
                        'application_id' => $application->id,
                        'service_no' => $validated[$serviceNoKey],
                        'name' => $validated[$nameKey]
                    ]);
                    $membersCreated++;
                }
            }

            // Add program visits from UI format
            $visitsCreated = 0;
            for ($i = 1; $i <= 10; $i++) {
                $dateKey = "prog{$i}_date";
                $placeKey = "prog{$i}_place";

                if (!empty($validated[$dateKey]) && !empty($validated[$placeKey])) {
                    ApplicationVisit::create([
                        'application_id' => $application->id,
                        'visit_date' => $validated[$dateKey],
                        'purpose' => 'Program visit',
                        'location' => $validated[$placeKey],
                        'status' => 'scheduled'
                    ]);
                    $visitsCreated++;
                }
            }

            DB::commit();

            if ($request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Application submitted successfully!',
                    'data' => $application->load(['applicant', 'application_members', 'application_visits']),
                    'summary' => [
                        'members_created' => $membersCreated,
                        'visits_created' => $visitsCreated,
                        'documents_uploaded' => $request->hasFile('supporting_documents') ? count($request->file('supporting_documents')) : 0
                    ]
                ], 201);
            }

            return redirect()->route('applications.show', $application)
                ->with('success', 'Application submitted successfully!');

        } catch (\Exception $e) {
            DB::rollBack();

            if ($request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error creating application: ' . $e->getMessage()
                ], 500);
            }

            return redirect()->back()
                ->withInput()
                ->with('error', 'Error creating application: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified application.
     */
    public function show(Application $application)
    {
        $application->load(['applicant', 'user', 'application_members', 'application_visits']);
        return view('applications.show', compact('application'));
    }

    /**
     * Show the form for editing the specified application.
     */
    public function edit(Application $application)
    {
        $applicants = Applicant::orderBy('name')->get();
        $application->load(['applicant', 'application_members']);
        return view('applications.edit', compact('application', 'applicants'));
    }

    /**
     * Update the specified application in storage.
     */
    public function update(Request $request, Application $application)
    {
        $validated = $request->validate([
            'purpose' => 'required|string',
            'supporting_docs' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:10240',
            'program' => 'nullable|string|max:255',
            'from_location' => 'required|string|max:255',
            'to_location' => 'required|string|max:255',
            'departure_date' => 'required|date',
            'return_date' => 'required|date|after_or_equal:departure_date',
            'status' => 'required|in:pending,approved,rejected',
        ]);

        try {
            // Handle file upload
            if ($request->hasFile('supporting_docs')) {
                $validated['supporting_docs'] = $request->file('supporting_docs')->store('docs', 'public');
                $validated['documents_attached'] = true;
            }

            $application->update($validated);

            if ($request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Application updated successfully!',
                    'data' => $application
                ]);
            }

            return redirect()->route('applications.show', $application)
                ->with('success', 'Application updated successfully!');

        } catch (\Exception $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error updating application: ' . $e->getMessage()
                ], 500);
            }

            return redirect()->back()
                ->withInput()
                ->with('error', 'Error updating application: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified application from storage.
     */
    public function destroy(Application $application)
    {
        try {
            $application->delete();

            return response()->json([
                'success' => true,
                'message' => 'Application deleted successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting application: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update application status.
     */
    public function updateStatus(Request $request, Application $application)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,approved,rejected',
            'notes' => 'nullable|string'
        ]);

        $application->update(['status' => $validated['status']]);

        return response()->json([
            'success' => true,
            'message' => 'Application status updated successfully!',
            'data' => $application
        ]);
    }



}
