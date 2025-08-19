<?php

// Test script to verify form integration
require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

// Create test request
$request = Illuminate\Http\Request::create('/api/test/field-mapping', 'GET');
$request->headers->set('Accept', 'application/json');

$response = $kernel->handle($request);

echo "=== FIELD MAPPING TEST ===\n";
echo "Status: " . $response->getStatusCode() . "\n";
echo "Response: " . $response->getContent() . "\n\n";

// Test form submission
$request2 = Illuminate\Http\Request::create('/api/test/form-submission', 'GET');
$request2->headers->set('Accept', 'application/json');

$response2 = $kernel->handle($request2);

echo "=== FORM SUBMISSION TEST ===\n";
echo "Status: " . $response2->getStatusCode() . "\n";
echo "Response: " . $response2->getContent() . "\n\n";

$kernel->terminate($request, $response);
$kernel->terminate($request2, $response2);
