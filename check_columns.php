<?php

require_once 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';

echo "=== CHECKING DATABASE COLUMN ISSUE ===\n\n";

try {
    // Check what columns exist in the application_visits table
    $columns = \Illuminate\Support\Facades\DB::select("SHOW COLUMNS FROM application_visits");
    
    echo "Columns in application_visits table:\n";
    foreach ($columns as $column) {
        echo "- {$column->Field} ({$column->Type})\n";
    }
    
    echo "\nModel expects these fillable fields:\n";
    $model = new App\Models\ApplicationVisit();
    $fillable = $model->getFillable();
    foreach ($fillable as $field) {
        echo "- {$field}\n";
    }
    
    // Check for mismatch
    $actualColumns = array_map(function($col) { return $col->Field; }, $columns);
    $missingColumns = array_diff($fillable, $actualColumns);
    $extraColumns = array_diff($actualColumns, $fillable);
    
    if (!empty($missingColumns)) {
        echo "\n❌ Missing columns in database:\n";
        foreach ($missingColumns as $col) {
            echo "- {$col}\n";
        }
    }
    
    if (!empty($extraColumns)) {
        echo "\n⚠️  Extra columns in database:\n";
        foreach ($extraColumns as $col) {
            echo "- {$col}\n";
        }
    }
    
    if (empty($missingColumns) && empty($extraColumns)) {
        echo "\n✅ All columns match!\n";
    }
    
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
