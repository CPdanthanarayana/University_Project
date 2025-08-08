<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    /**
     * Display the specified application.
     *
     * @param  \App\Models\Application  $application
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Application $application)
    {
        return response()->json($application);
    }
}
