<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Applicant;
use App\Models\ApplicationMember;
use App\Models\ApplicationVisit;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ApplicationFormController extends Controller
{
    /**
     * Show the application form
     */
    public function index()
    {
        return view('userview.userForm');
    }

    /**
     * Handle form submission from the frontend
     */
    public function submit(Request $request)
    {
        try {
            DB::beginTransaction();

            // Enhanced validation for frontend form
            $validated = $request->validate([
                // UI form fields
                'service_no_name' => 'required|string|max:255',
                'designation' => 'required|string|max:255',
                'faculty' => 'required|string|max:255',
                'department' => 'required|string|max:255',
                'contact_no' => 'required|string|max:50',
                'email' => 'required|email|max:255',
                'purpose' => 'required|string',
                'supporting_docs' => 'required|in:yes,no',
                'from' => 'required|string|max:255',
                'to' => 'required|string|max:255',
                'departure_date' => 'required|date',
                'departure_time' => 'nullable|date_format:H:i',
                'return_date' => 'required|date|after_or_equal:departure_date',
                'return_time' => 'nullable|date_format:H:i',
                'route' => 'nullable|string|max:500',
                'parking_place' => 'nullable|string|max:255',
                'applicant_date' => 'required|date',
                
                // File uploads
                'supporting_documents' => 'nullable|array',
                'supporting_documents.*' => 'file|mimes:pdf,doc,docx,jpg,jpeg,png|max:5120',
                'applicant_signature' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
                
                // Dynamic fields
                'prog1_date' => 'nullable|date',
                'prog1_place' => 'nullable|string|max:255',
                'prog2_date' => 'nullable|date',
                'prog2_place' => 'nullable|string|max:255',
                'prog3_date' => 'nullable|date',
                'prog3_place' => 'nullable|string|max:255',
                'prog4_date' => 'nullable|date',
                'prog4_place' => 'nullable|string|max:255',
                
                // Members
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
            ]);

            // Transform UI data to match model expectations
            $serviceNoName = explode(' - ', $validated['service_no_name']);
            $serviceNo = trim($serviceNoName[0]);
            $applicantName = isset($serviceNoName[1]) ? trim($serviceNoName[1]) : '';

            // Get or create a default user for guests (production should handle proper auth)
            $userId = Auth::id();
            if (!$userId) {
                // For guest submissions, use a default user or create a guest system
                $defaultUser = User::firstOrCreate(
                    ['email' => 'guest@system.local'],
                    [
                        'name' => 'Guest User',
                        'password' => bcrypt('temporary'),
                        'email_verified_at' => now()
                    ]
                );
                $userId = $defaultUser->id;
            }

            // 1. Create or update applicant
            $applicant = Applicant::updateOrCreate(
                ['service_no' => $serviceNo],
                [
                    'name' => $applicantName ?: 'Unknown',
                    'designation' => $validated['designation'],
                    'faculty' => $validated['faculty'],
                    'department' => $validated['department'],
                    'contact_no' => $validated['contact_no'],
                    'email' => $validated['email']
                ]
            );

            // Handle file uploads
            $supportingDocsPath = null;
            $signaturePath = null;

            if ($request->hasFile('supporting_documents')) {
                $documentPaths = [];
                foreach ($request->file('supporting_documents') as $file) {
                    $path = $file->store('supporting_documents', 'public');
                    $documentPaths[] = $path;
                }
                $supportingDocsPath = json_encode($documentPaths);
            }

            if ($request->hasFile('applicant_signature')) {
                $signaturePath = $request->file('applicant_signature')->store('signatures', 'public');
            }

            // 2. Create application
            $application = Application::create([
                'user_id' => $userId,
                'applicant_id' => $applicant->id,
                'purpose' => $validated['purpose'],
                'documents_attached' => $validated['supporting_docs'] === 'yes',
                'supporting_docs' => $supportingDocsPath,
                'from_location' => $validated['from'],
                'to_location' => $validated['to'],
                'departure_date' => $validated['departure_date'],
                'departure_time' => $validated['departure_time'] ?? null,
                'return_date' => $validated['return_date'],
                'return_time' => $validated['return_time'] ?? null,
                'route' => $validated['route'] ?? null,
                'parking_place' => $validated['parking_place'] ?? null,
                'applicant_signature_path' => $signaturePath,
                'applicant_signed_date' => $validated['applicant_date'],
                'status' => 'pending'
            ]);

            // 3. Create members
            $membersCreated = 0;
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

            // 4. Create visits
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

            return response()->json([
                'success' => true,
                'message' => 'Application submitted successfully!',
                'data' => [
                    'id' => $application->id,
                    'applicant' => $applicant->name,
                    'status' => $application->status,
                    'members_created' => $membersCreated,
                    'visits_created' => $visitsCreated,
                    'documents_uploaded' => $request->hasFile('supporting_documents') ? count($request->file('supporting_documents')) : 0,
                    'signature_uploaded' => $request->hasFile('applicant_signature')
                ]
            ], 201);

        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Please check your input',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Form submission failed: ' . $e->getMessage(), ['exception' => $e]); // Log the full exception
            
            return response()->json([
                'success' => false,
                'message' => 'Submission failed. Please try again.'
            ], 500);
        }
    }

    /**
     * Get application status
     */
    public function status($id)
    {
        $application = Application::with(['applicant', 'application_members', 'application_visits'])
            ->findOrFail($id);
            
        return response()->json([
            'success' => true,
            'data' => $application
        ]);
    }
}
