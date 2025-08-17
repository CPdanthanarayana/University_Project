<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Applicant;
use App\Models\Application;
use App\Models\ApplicationMember;
use App\Models\ApplicationVisit;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ApplicationIntegrationTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();
        Storage::fake('public');
    }

    /**
     * Test creating a new applicant through the controller.
     */
    public function test_can_create_applicant()
    {
        $applicantData = [
            'service_no' => 'EMP001',
            'name' => 'John Doe',
            'designation' => 'Senior Lecturer',
            'faculty' => 'Faculty of Technology',
            'department' => 'Computer Science',
            'contact_no' => '0771234567'
        ];

        $response = $this->postJson('/api/applicants', $applicantData);

        $response->assertStatus(201)
                ->assertJson([
                    'success' => true,
                    'message' => 'Applicant created successfully!'
                ]);

        $this->assertDatabaseHas('applicants', $applicantData);
    }

    /**
     * Test creating a complete application with members and visits.
     */
    public function test_can_create_complete_application()
    {
        // Create a user and applicant first
        $user = User::factory()->create();
        $applicant = Applicant::create([
            'service_no' => 'EMP001',
            'name' => 'John Doe',
            'designation' => 'Senior Lecturer',
            'faculty' => 'Faculty of Technology',
            'department' => 'Computer Science',
            'contact_no' => '0771234567'
        ]);

        // Create fake files
        $supportingDoc = UploadedFile::fake()->create('document.pdf', 1000);
        $signature = UploadedFile::fake()->image('signature.jpg');

        $applicationData = [
            'applicant_id' => $applicant->id,
            'purpose' => 'Research collaboration meeting',
            'supporting_docs' => $supportingDoc,
            'program' => 'Academic Visit',
            'from_location' => 'Colombo',
            'to_location' => 'Kandy',
            'departure_date' => '2025-08-20',
            'return_date' => '2025-08-21',
            'applicant_signature_path' => $signature,
            'applicant_signed_date' => '2025-08-17',
            'members' => [
                ['name' => 'Jane Smith', 'service_no' => 'EMP002'],
                ['name' => 'Mike Johnson', 'service_no' => 'EMP003']
            ]
        ];

        $this->actingAs($user);
        $response = $this->postJson('/api/applications', $applicationData);

        $response->assertStatus(201)
                ->assertJson([
                    'success' => true,
                    'message' => 'Application submitted successfully!'
                ]);

        // Check if application was created
        $this->assertDatabaseHas('applications', [
            'user_id' => $user->id,
            'applicant_id' => $applicant->id,
            'purpose' => 'Research collaboration meeting',
            'from_location' => 'Colombo',
            'to_location' => 'Kandy',
            'status' => 'pending'
        ]);

        // Check if members were created
        $application = Application::where('user_id', $user->id)->first();
        $this->assertDatabaseHas('application_members', [
            'application_id' => $application->id,
            'name' => 'Jane Smith',
            'service_no' => 'EMP002'
        ]);

        $this->assertDatabaseHas('application_members', [
            'application_id' => $application->id,
            'name' => 'Mike Johnson',
            'service_no' => 'EMP003'
        ]);
    }

    /**
     * Test creating application visits.
     */
    public function test_can_create_application_visits()
    {
        $user = User::factory()->create();
        $applicant = Applicant::create([
            'service_no' => 'EMP001',
            'name' => 'John Doe',
            'designation' => 'Senior Lecturer',
            'faculty' => 'Faculty of Technology',
            'department' => 'Computer Science',
            'contact_no' => '0771234567'
        ]);

        $application = Application::create([
            'user_id' => $user->id,
            'applicant_id' => $applicant->id,
            'purpose' => 'Research visit',
            'from_location' => 'Colombo',
            'to_location' => 'Kandy',
            'departure_date' => '2025-08-20',
            'return_date' => '2025-08-21',
            'status' => 'pending'
        ]);

        $visitData = [
            'visit_date' => '2025-08-20',
            'visit_time' => '09:00',
            'purpose' => 'University visit',
            'location' => 'University of Peradeniya',
            'notes' => 'Meeting with research team',
            'status' => 'scheduled'
        ];

        $response = $this->postJson("/api/applications/{$application->id}/visits", $visitData);

        $response->assertStatus(201)
                ->assertJson([
                    'success' => true,
                    'message' => 'Visit record created successfully!'
                ]);

        $this->assertDatabaseHas('application_visits', [
            'application_id' => $application->id,
            'visit_date' => '2025-08-20',
            'purpose' => 'University visit',
            'location' => 'University of Peradeniya'
        ]);
    }

    /**
     * Test model relationships work correctly.
     */
    public function test_model_relationships()
    {
        $user = User::factory()->create();
        $applicant = Applicant::create([
            'service_no' => 'EMP001',
            'name' => 'John Doe',
            'designation' => 'Senior Lecturer',
            'faculty' => 'Faculty of Technology',
            'department' => 'Computer Science',
            'contact_no' => '0771234567'
        ]);

        $application = Application::create([
            'user_id' => $user->id,
            'applicant_id' => $applicant->id,
            'purpose' => 'Research visit',
            'from_location' => 'Colombo',
            'to_location' => 'Kandy',
            'departure_date' => '2025-08-20',
            'return_date' => '2025-08-21',
            'status' => 'pending'
        ]);

        $member = ApplicationMember::create([
            'application_id' => $application->id,
            'name' => 'Jane Smith',
            'service_no' => 'EMP002'
        ]);

        $visit = ApplicationVisit::create([
            'application_id' => $application->id,
            'visit_date' => '2025-08-20',
            'purpose' => 'University visit',
            'location' => 'University of Peradeniya'
        ]);

        // Test relationships
        $this->assertInstanceOf(User::class, $application->user);
        $this->assertInstanceOf(Applicant::class, $application->applicant);
        $this->assertTrue($application->application_members->contains($member));
        $this->assertTrue($application->application_visits->contains($visit));
        
        // Test reverse relationships
        $this->assertTrue($user->applications->contains($application));
        $this->assertTrue($applicant->applications->contains($application));
        $this->assertEquals($application->id, $member->application->id);
        $this->assertEquals($application->id, $visit->application->id);
    }

    /**
     * Test field validation works correctly.
     */
    public function test_validation_works()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        // Test missing required fields
        $response = $this->postJson('/api/applications', []);

        $response->assertStatus(422)
                ->assertJsonValidationErrors([
                    'purpose',
                    'from_location',
                    'to_location',
                    'departure_date',
                    'return_date'
                ]);

        // Test invalid date range
        $response = $this->postJson('/api/applications', [
            'purpose' => 'Test purpose',
            'from_location' => 'Colombo',
            'to_location' => 'Kandy',
            'departure_date' => '2025-08-21',
            'return_date' => '2025-08-20', // Return before departure
        ]);

        $response->assertStatus(422)
                ->assertJsonValidationErrors(['return_date']);
    }

    /**
     * Test application status updates.
     */
    public function test_can_update_application_status()
    {
        $user = User::factory()->create();
        $applicant = Applicant::create([
            'service_no' => 'EMP001',
            'name' => 'John Doe',
            'designation' => 'Senior Lecturer',
            'faculty' => 'Faculty of Technology',
            'department' => 'Computer Science',
            'contact_no' => '0771234567'
        ]);

        $application = Application::create([
            'user_id' => $user->id,
            'applicant_id' => $applicant->id,
            'purpose' => 'Research visit',
            'from_location' => 'Colombo',
            'to_location' => 'Kandy',
            'departure_date' => '2025-08-20',
            'return_date' => '2025-08-21',
            'status' => 'pending'
        ]);

        $response = $this->putJson("/api/applications/{$application->id}/status", [
            'status' => 'approved',
            'notes' => 'Application approved by administration'
        ]);

        $response->assertStatus(200)
                ->assertJson([
                    'success' => true,
                    'message' => 'Application status updated successfully!'
                ]);

        $this->assertDatabaseHas('applications', [
            'id' => $application->id,
            'status' => 'approved'
        ]);
    }
}
