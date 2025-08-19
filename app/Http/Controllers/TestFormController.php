<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Applicant;
use App\Models\ApplicationMember;
use App\Models\ApplicationVisit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TestFormController extends Controller
{
    /**
     * Test form submission with UI field names
     */
    public function testFormSubmission(Request $request)
    {
        try {
            DB::beginTransaction();

            // Simulate processing form data with current UI field names
            $formData = [
                // UI form field names (as they currently exist)
                'service_no_name' => 'EMP001 - John Doe',
                'designation' => 'Senior Lecturer',
                'faculty' => 'Faculty of Technology',
                'department' => 'Computer Science',
                'contact_no' => '0771234567',
                'purpose' => 'Research collaboration meeting',
                'supporting_docs' => 'yes',
                'from' => 'Colombo',
                'to' => 'Kandy',
                'departure_date' => '2025-08-20',
                'departure_time' => '08:00',
                'return_date' => '2025-08-21',
                'return_time' => '18:00',
                'route' => 'Colombo-Kandy via Kegalle',
                'parking_place' => 'University Parking',
                'prog1_date' => '2025-08-20',
                'prog1_place' => 'University of Peradeniya',
                'prog2_date' => '2025-08-21',
                'prog2_place' => 'PGIS Campus',
                'sn1_service_no' => 'EMP002',
                'sn1_name' => 'Jane Smith',
                'sn2_service_no' => 'EMP003',
                'sn2_name' => 'Mike Johnson',
                'applicant_date' => '2025-08-17'
            ];

            // Transform UI data to match model expectations
            $serviceNoName = explode(' - ', $formData['service_no_name']);
            $serviceNo = trim($serviceNoName[0]);
            $applicantName = trim($serviceNoName[1] ?? '');

            // 1. Create or find applicant
            $applicant = Applicant::updateOrCreate(
                ['service_no' => $serviceNo],
                [
                    'name' => $applicantName,
                    'designation' => $formData['designation'],
                    'faculty' => $formData['faculty'],
                    'department' => $formData['department'],
                    'contact_no' => $formData['contact_no']
                ]
            );

            // 2. Create application with transformed field names
            $application = Application::create([
                'user_id' => 6, // Use existing user for testing
                'applicant_id' => $applicant->id,
                'purpose' => $formData['purpose'],
                'documents_attached' => $formData['supporting_docs'] === 'yes',
                'from_location' => $formData['from'], // UI field mapped to model field
                'to_location' => $formData['to'],     // UI field mapped to model field
                'departure_date' => $formData['departure_date'],
                'return_date' => $formData['return_date'],
                'applicant_signed_date' => $formData['applicant_date'], // UI field mapped to model field
                'status' => 'pending'
            ]);

            // 3. Create members from UI format
            $members = [];
            for ($i = 1; $i <= 5; $i++) {
                $serviceNoKey = "sn{$i}_service_no";
                $nameKey = "sn{$i}_name";
                
                if (!empty($formData[$serviceNoKey]) && !empty($formData[$nameKey])) {
                    $members[] = ApplicationMember::create([
                        'application_id' => $application->id,
                        'service_no' => $formData[$serviceNoKey],
                        'name' => $formData[$nameKey]
                    ]);
                }
            }

            // 4. Create visits from UI program format
            $visits = [];
            for ($i = 1; $i <= 4; $i++) {
                $dateKey = "prog{$i}_date";
                $placeKey = "prog{$i}_place";
                
                if (!empty($formData[$dateKey]) && !empty($formData[$placeKey])) {
                    $visits[] = ApplicationVisit::create([
                        'application_id' => $application->id,
                        'visit_date' => $formData[$dateKey],
                        'purpose' => 'Program visit', // Default purpose
                        'location' => $formData[$placeKey] // UI field mapped to model field
                    ]);
                }
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Form submission test successful!',
                'data' => [
                    'applicant' => $applicant,
                    'application' => $application->load(['applicant', 'application_members', 'application_visits']),
                    'members_created' => count($members),
                    'visits_created' => count($visits)
                ]
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            
            return response()->json([
                'success' => false,
                'message' => 'Form submission test failed: ' . $e->getMessage(),
                'error' => $e->getTraceAsString()
            ], 500);
        }
    }

    /**
     * Test field mapping validation
     */
    public function testFieldMapping()
    {
        $uiFields = [
            'service_no_name', 'designation', 'faculty', 'department', 'contact_no',
            'purpose', 'supporting_docs', 'from', 'to', 'departure_date', 'departure_time',
            'return_date', 'return_time', 'route', 'parking_place',
            'prog1_date', 'prog1_place', 'prog2_date', 'prog2_place',
            'sn1_service_no', 'sn1_name', 'sn2_service_no', 'sn2_name',
            'applicant_date'
        ];

        $applicantFields = (new Applicant())->getFillable();
        $applicationFields = (new Application())->getFillable();
        $memberFields = (new ApplicationMember())->getFillable();
        $visitFields = (new ApplicationVisit())->getFillable();

        return response()->json([
            'ui_form_fields' => $uiFields,
            'model_fillables' => [
                'applicant' => $applicantFields,
                'application' => $applicationFields,
                'application_member' => $memberFields,
                'application_visit' => $visitFields
            ],
            'field_mappings' => [
                'from → from_location' => 'UI field maps to Application model',
                'to → to_location' => 'UI field maps to Application model',
                'service_no_name → service_no + name' => 'UI field splits into Applicant model fields',
                'applicant_date → applicant_signed_date' => 'UI field maps to Application model',
                'prog*_date → visit_date' => 'UI fields map to ApplicationVisit model',
                'prog*_place → location' => 'UI fields map to ApplicationVisit model',
                'sn*_service_no → service_no' => 'UI fields map to ApplicationMember model',
                'sn*_name → name' => 'UI fields map to ApplicationMember model'
            ]
        ]);
    }
}
