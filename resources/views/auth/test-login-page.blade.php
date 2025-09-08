@extends('auth.test-layout')

@section('title', 'User Login')

@section('content')
    <div class="container mt-5">
        <div class="mx-auto border-0 shadow-lg card rounded-4" style="max-width: 450px;">
            <div class="p-4 card-body">
                <h3 class="mb-4 text-center fw-bold text-primary">Vehicle Allocation System</h3>
                <h5 class="mb-4 text-center">User Login</h5>
                
                <form action="/user-login" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label fw-semibold">Email Address</label>
                        <input type="email" name="email" class="form-control rounded-3" id="email" placeholder="Enter your email" required>
                        <div class="form-text">We’ll never share your email with anyone else.</div>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label fw-semibold">Password</label>
                        <input type="password" name="password" class="form-control rounded-3" id="password" placeholder="Enter your password" required>
                    </div>

                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="rememberMe" name="remember">
                        <label class="form-check-label" for="rememberMe">Remember me</label>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 rounded-3">Login</button>
                </form>

                <div class="mt-3 text-center">
                    <a href="#" class="text-decoration-none">Forgot your password?</a>
                </div>

                <div class="mt-2 text-center">
                    <p class="mb-0">
                        Don't have an account? 
                        <a href="/user-register" class="text-decoration-none fw-semibold text-primary">Sign up here</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
