<?php

//namespace App\Http\Controllers;

//use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Auth;

//class AuthManager extends Controller
//{
    //function login(){
        //return view('userview.userlogin');
    //}

    //function loginPost(Request $request){
    // Validate the form data
    //$request->validate([
        //'email' => 'required|email',
        //'password' => 'required',
    //]);

    // Prepare credentials array
   // $credentials = $request->only('email', 'password');

    // Check if "remember me" is checked
    //$remember = $request->has('rememberMe');

    // Attempt to authenticate the user
    //if (Auth::attempt($credentials, $remember)) {
        // Authentication passed, regenerate session for security
        //$request->session()->regenerate();

        // Redirect to intended page or dashboard
        //return redirect()->intended('/');  
    //}

    // Authentication failed, redirect back with error message
    //return back()->withErrors([
      //  'email' => 'The provided credentials do not match our records.',
    //])->onlyInput('email');
    //}
//}
