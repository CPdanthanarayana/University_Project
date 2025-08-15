<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Registration</title>
    <!-- Compiled Tailwind CSS -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <!-- Optional: Add any additional styles here -->
    <style>
        /* Custom styles if needed */
        .form-input:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
        }
    </style>
</head>
<body class="bg-gray-100 font-sans antialiased">
    <div class="min-h-screen py-6 flex flex-col justify-center sm:py-12">
        <div class="relative py-3 sm:max-w-xl md:max-w-2xl lg:max-w-3xl mx-auto">
            <div class="relative px-4 py-10 bg-white mx-8 md:mx-0 shadow rounded-3xl sm:p-10">
                <div class="max-w-md mx-auto">
                    <div class="flex items-center space-x-5">
                        <div class="block pl-2 font-semibold text-xl text-gray-700">
                            <h2 class="text-2xl leading-relaxed">Admin Registration</h2>
                            <p class="text-sm text-gray-500 font-normal leading-relaxed">Please fill in your details to register as an admin.</p>
                        </div>
                    </div>
                    <div class="divide-y divide-gray-200">
                        <form method="POST" action="/admin-register" class="py-8 text-base leading-6 space-y-4 text-gray-700 sm:text-lg sm:leading-7">
                            @csrf
                        
                        <!-- Full Name -->
                        <div class="relative">
                            <label for="full_name" class="text-gray-600 font-medium">Full Name</label>
                            <input id="full_name" name="full_name" type="text" 
                                class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600"
                                required autocomplete="name" autofocus>
                            <span class="text-red-500 text-sm mt-1 hidden validation-error"></span>
                        </div>

                        <!-- Email -->
                        <div class="relative">
                            <label for="email" class="text-gray-600 font-medium">Email</label>
                            <input id="email" name="email" type="email" 
                                class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600"
                                required autocomplete="email">
                            <span class="text-red-500 text-sm mt-1 hidden validation-error"></span>
                        </div>

                        <!-- Password -->
                        <div class="relative">
                            <label for="password" class="text-gray-600 font-medium">Password</label>
                            <input id="password" name="password" type="password" 
                                class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600"
                                required autocomplete="new-password">
                            <span class="text-red-500 text-sm mt-1 hidden validation-error"></span>
                        </div>

                        <!-- Confirm Password -->
                        <div class="relative">
                            <label for="password_confirmation" class="text-gray-600 font-medium">Confirm Password</label>
                            <input id="password_confirmation" name="password_confirmation" type="password" 
                                class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600"
                                required autocomplete="new-password">
                            <span class="text-red-500 text-sm mt-1 hidden validation-error"></span>
                        </div>

                        <!-- Faculty -->
                        <div class="relative">
                            <label for="faculty" class="text-gray-600 font-medium">Faculty</label>
                            <select id="faculty" name="faculty" 
                                class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600"
                                required>
                                <option value="" disabled selected>Select faculty</option>
                                <option value="Faculty of Computing">Faculty of Computing</option>
                                <option value="Faculty of Applied Sciences">Faculty of Applied Sciences</option>
                                <option value="Faculty of Social Science and Language">Faculty of Social Science and Language</option>
                                <option value="Faculty of Management Studies">Faculty of Management Studies</option>
                                <option value="Faculty of Agriculture Science">Faculty of Agriculture Science</option>
                                <option value="Faculty of Technology">Faculty of Technology</option>
                                <option value="Faculty of Medicine">Faculty of Medicine</option>
                            </select>
                            <span class="text-red-500 text-sm mt-1 hidden validation-error"></span>
                        </div>

                        <!-- Position -->
                        <div class="relative">
                            <label for="position" class="text-gray-600 font-medium">Position</label>
                            <select id="position" name="position" 
                                class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600"
                                required>
                                <option value="" disabled selected>Select position</option>
                                <option value="dean">Dean</option>
                                <option value="registrar">Registrar</option>
                                <option value="assistant_registrar">Assistant Registrar</option>
                            </select>
                            <span class="text-red-500 text-sm mt-1 hidden validation-error"></span>
                        </div>

                        <!-- Buttons -->
                        <div class="flex items-center justify-between pt-4">
                            <a href="/admin" 
                                class="px-6 py-2 border border-gray-300 rounded-md text-gray-700 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-500">
                                Go Back
                            </a>
                            <button type="submit" 
                                class="px-6 py-2 border border-transparent rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                Register
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    // Client-side validation
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.querySelector('form');
        
        form.addEventListener('submit', function(e) {
            let isValid = true;
            const fullName = document.getElementById('full_name');
            const email = document.getElementById('email');
            const password = document.getElementById('password');
            const passwordConfirmation = document.getElementById('password_confirmation');
            const faculty = document.getElementById('faculty');
            const position = document.getElementById('position');
            
            // Clear previous error messages
            document.querySelectorAll('.validation-error').forEach(el => {
                el.textContent = '';
                el.classList.add('hidden');
            });
            
            // Reset all input borders
            document.querySelectorAll('input, select').forEach(el => {
                el.classList.remove('border-red-500');
            });
            
            // Validate full name
            if (fullName.value.trim() === '') {
                showError(fullName, 'Full name is required');
                isValid = false;
            }
            
            // Validate email
            if (email.value.trim() === '') {
                showError(email, 'Email is required');
                isValid = false;
            } else if (!isValidEmail(email.value)) {
                showError(email, 'Please enter a valid email address');
                isValid = false;
            }
            
            // Validate password
            if (password.value === '') {
                showError(password, 'Password is required');
                isValid = false;
            } else if (password.value.length < 8) {
                showError(password, 'Password must be at least 8 characters');
                isValid = false;
            }
            
            // Validate password confirmation
            if (passwordConfirmation.value === '') {
                showError(passwordConfirmation, 'Please confirm your password');
                isValid = false;
            } else if (password.value !== passwordConfirmation.value) {
                showError(passwordConfirmation, 'Passwords do not match');
                isValid = false;
            }
            
            // Validate faculty
            if (faculty.value === '') {
                showError(faculty, 'Please select your faculty');
                isValid = false;
            }
            
            // Validate position
            if (position.value === '') {
                showError(position, 'Please select your position');
                isValid = false;
            }
            
            if (!isValid) {
                e.preventDefault();
            }
        });
        
        function showError(input, message) {
            const errorSpan = input.parentNode.querySelector('.validation-error');
            errorSpan.textContent = message;
            errorSpan.classList.remove('hidden');
            input.classList.add('border-red-500');
        }
        
        function isValidEmail(email) {
            const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return re.test(email);
        }
    });
</script>
</body>
</html>
