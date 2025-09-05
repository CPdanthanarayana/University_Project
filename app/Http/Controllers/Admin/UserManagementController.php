<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserManagementController extends Controller
{
    /**
     * Display a listing of users.
     */
    public function index()
    {
        $users = User::paginate(10);
        return view('adminview.users.index', compact('users'));
    }

    /**
     * Update user type.
     */
    public function updateUserType(Request $request, User $user)
    {
        $request->validate([
            'user_type' => 'required|in:user,admin'
        ]);

        $user->update([
            'user_type' => $request->user_type
        ]);

        return response()->json([
            'success' => true,
            'message' => 'User type updated successfully!'
        ]);
    }

    /**
     * Get user details for modal.
     */
    public function show(User $user)
    {
        return response()->json($user);
    }
}
