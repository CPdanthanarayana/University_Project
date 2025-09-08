<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Applicant;

class AdminController extends Controller
{
    public function logout(Request $request)
{
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/login');
}
public function index()
    {
        $userFaculty = Auth::user()->faculty;

        // fetch applicants that belong to same faculty
        $applicants = Applicant::where('faculty', $userFaculty)->get();

        return view('adminview.index', compact('applicants'));
    }
}
