<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Applicant;
use App\Models\Application;
use App\Mail\ApplicationStatusMail;
use Illuminate\Support\Facades\Mail;
use App\Mail\ApplicationRejectedMail;

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

    if ($userFaculty === 'All') {
        // Admin of "All" faculty: show apps with status approved & final_status still pending
        $applicants = Applicant::whereHas('applications', function ($query) {
                $query->where('status', 'approved')
                      ->where('final_status', 'pending');
            })
            ->with(['applications' => function ($query) {
                $query->where('status', 'approved')
                      ->where('final_status', 'pending');
            }])
            ->get();
    } else {
        // Other faculty admins: show apps with status pending & final_status still pending
        $applicants = Applicant::where('faculty', $userFaculty)
            ->whereHas('applications', function ($query) {
                $query->where('status', 'pending')
                      ->where('final_status', 'pending');
            })
            ->with(['applications' => function ($query) {
                $query->where('status', 'pending')
                      ->where('final_status', 'pending');
            }])
            ->get();
    }

    return view('adminview.index', compact('applicants'));
}




public function updateStatus(Request $request, $applicantId)
{
    $request->validate([
        'status' => 'required|in:approved,rejected',
    ]);

    $userFaculty = Auth::user()->faculty;

    $application = Application::where('applicant_id', $applicantId)->firstOrFail();
    $applicant   = Applicant::findOrFail($applicantId);

    if ($userFaculty === 'All') {
        // Super admin → update final_status instead of status
        $application->final_status = $request->status;
        $application->save();

        // Always notify applicant directly (approve or reject)
        if ($request->status === 'approved') {
            Mail::to($applicant->email)
                ->send(new ApplicationStatusMail($application, $applicant, Auth::user()));
        } else if ($request->status === 'rejected') {
            Mail::to($applicant->email)
                ->send(new ApplicationRejectedMail($application));
        }

    } else {
        // Regular faculty admin → old behavior
        $application->status = $request->status;
        $application->save();

        if ($request->status === 'approved') {
            // Send to higher admin
            $higherAdminEmail = "hashanewatawala@gmail.com"; // replace with real email
            Mail::to($higherAdminEmail)
                ->send(new ApplicationStatusMail($application, $applicant, Auth::user()));
        } else if ($request->status === 'rejected') {
            // Send rejection to applicant
            Mail::to($applicant->email)
                ->send(new ApplicationRejectedMail($application));
        }
    }

    return redirect()->back()->with('email_sent', true);
}



}
