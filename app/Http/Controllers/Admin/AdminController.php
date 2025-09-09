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
        // If admin faculty is 'All' → show all faculties approved applications
        $applicants = Applicant::whereHas('applications', function ($query) {
                $query->where('status', 'approved');
            })
            ->with(['applications' => function ($query) {
                $query->where('status', 'approved'); // load only approved apps
            }])
            ->get();
    } else {
        // Existing logic: show only pending applications for that faculty
        $applicants = Applicant::where('faculty', $userFaculty)
            ->whereHas('applications', function ($query) {
                $query->where('status', 'pending');
            })
            ->with(['applications' => function ($query) {
                $query->where('status', 'pending'); // load only pending apps
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

    $application = Application::where('applicant_id', $applicantId)->firstOrFail();
    $application->status = $request->status;
    $application->save();

    $applicant = Applicant::findOrFail($applicantId);

    if ($request->status === 'approved') {
        // Send email to higher admin
        $higherAdminEmail = "hashanewatawala@gmail.com"; // replace with real email
        Mail::to($higherAdminEmail)
            ->send(new ApplicationStatusMail($application, $applicant, Auth::user()));
    } else if ($request->status === 'rejected') {
        // Send rejection email to applicant
        Mail::to($applicant->email)
            ->send(new ApplicationRejectedMail($application));
    }

    return redirect()->back()->with('email_sent', true);
}


}
