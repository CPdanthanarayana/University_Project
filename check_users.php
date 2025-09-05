<?php

require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "Users in database:\n";
foreach(App\Models\User::all() as $user) {
    echo $user->id . ' - ' . $user->name . ' - ' . $user->email . ' - Type: ' . $user->user_type . "\n";
}
