<?php

// Test form submission to debug the issue
require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

echo "=== DEBUGGING FORM SUBMISSION ISSUE ===\n\n";

// Test 1: Check if the controller exists and is accessible
echo "1. Testing Controller Access...\n";
try {
    $controller = new App\Http\Controllers\ApplicationFormController();
    echo "   ✓ ApplicationFormController exists\n";
} catch (Exception $e) {
    echo "   ✗ Controller Error: " . $e->getMessage() . "\n";
}

// Test 2: Simulate a form submission
echo "\n2. Testing Form Submission...\n";
try {
    // Create a test request with all required fields
    $request = Illuminate\Http\Request::create('/submit-application', 'POST');
    $request->headers->set('Accept', 'application/json');
    $request->headers->set('X-CSRF-TOKEN', 'test-token');
    $request->headers->set('X-Requested-With', 'XMLHttpRequest');
    
    // Add form data that matches your UI
    $formData = [
        'service_no_name' => 'EMP001 - John Doe',
        'designation' => 'Senior Lecturer',
        'faculty' => 'Faculty of Technology',
        'department' => 'Computer Science',
        'contact_no' => '0771234567',
        'purpose' => 'Research collaboration meeting',
        'supporting_docs' => 'no',
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
        'applicant_date' => '2025-08-17'
    ];
    
    $request->merge($formData);
    
    $response = $kernel->handle($request);
    
    echo "   Status Code: " . $response->getStatusCode() . "\n";
    echo "   Response: " . substr($response->getContent(), 0, 500) . "...\n";
    
    if ($response->getStatusCode() === 422) {
        echo "   ⚠️  Validation errors detected\n";
        $content = json_decode($response->getContent(), true);
        if (isset($content['errors'])) {
            foreach ($content['errors'] as $field => $errors) {
                echo "     - {$field}: " . implode(', ', $errors) . "\n";
            }
        }
    } elseif ($response->getStatusCode() === 500) {
        echo "   ✗ Server error detected\n";
    } elseif ($response->getStatusCode() === 419) {
        echo "   ⚠️  CSRF token issue (expected in testing)\n";
    } elseif ($response->getStatusCode() === 201 || $response->getStatusCode() === 200) {
        echo "   ✓ Form submission successful!\n";
    }
    
} catch (Exception $e) {
    echo "   ✗ Error: " . $e->getMessage() . "\n";
    echo "   Stack trace: " . $e->getTraceAsString() . "\n";
}

// Test 3: Check database records before and after
echo "\n3. Checking Database Records...\n";
try {
    $applicantCount = App\Models\Applicant::count();
    $applicationCount = App\Models\Application::count();
    $memberCount = App\Models\ApplicationMember::count();
    $visitCount = App\Models\ApplicationVisit::count();
    
    echo "   Current record counts:\n";
    echo "   - Applicants: {$applicantCount}\n";
    echo "   - Applications: {$applicationCount}\n";
    echo "   - Members: {$memberCount}\n";
    echo "   - Visits: {$visitCount}\n";
    
    // Check if there are any recent records
    $recentApplication = App\Models\Application::latest()->first();
    if ($recentApplication) {
        echo "   Latest application: ID {$recentApplication->id}, created {$recentApplication->created_at}\n";
    } else {
        echo "   No applications found in database\n";
    }
    
} catch (Exception $e) {
    echo "   ✗ Database Error: " . $e->getMessage() . "\n";
}

// Test 4: Check if there are any Laravel logs
echo "\n4. Checking for Errors in Laravel Logs...\n";
try {
    $logFile = storage_path('logs/laravel.log');
    if (file_exists($logFile)) {
        $logContent = file_get_contents($logFile);
        $recentErrors = [];
        $lines = explode("\n", $logContent);
        
        // Get last 10 lines that contain errors
        $errorLines = array_filter($lines, function($line) {
            return strpos($line, '[ERROR]') !== false || strpos($line, 'Exception') !== false;
        });
        
        $recentErrors = array_slice($errorLines, -5); // Last 5 errors
        
        if (!empty($recentErrors)) {
            echo "   Recent errors found:\n";
            foreach ($recentErrors as $error) {
                echo "   - " . substr($error, 0, 100) . "...\n";
            }
        } else {
            echo "   No recent errors in logs\n";
        }
    } else {
        echo "   No log file found\n";
    }
} catch (Exception $e) {
    echo "   ✗ Log check error: " . $e->getMessage() . "\n";
}

echo "\n=== LIKELY ISSUES TO CHECK ===\n";
echo "1. CSRF token validation failing in browser\n";
echo "2. Validation errors preventing submission\n";
echo "3. JavaScript errors in browser console\n";
echo "4. Network connectivity issues\n";
echo "5. Server configuration problems\n";

echo "\n=== DEBUGGING STEPS ===\n";
echo "1. Open browser Developer Tools (F12)\n";
echo "2. Go to Console tab to check for JavaScript errors\n";
echo "3. Go to Network tab to see the actual request/response\n";
echo "4. Try submitting the form and check what happens\n";

$kernel->terminate($request, $response);
