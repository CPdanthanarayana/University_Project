<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - University Vehicle Requisition System</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: "Hanken Grotesk", sans-serif;
            background: #f7f8fa;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .register-container {
            background: #fff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 2px 8px #fcdbcc;
            width: 100%;
            max-width: 450px;
        }

        .logo-section {
            text-align: center;
            margin-bottom: 30px;
        }

        .logo {
            width: 80px;
            height: 80px;
            background: #a7d4f8ff;
            border-radius: 50%;
            margin: 0 auto 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 24px;
            font-weight: bold;
        }

        .title {
            color: #2d3a4b;
            font-size: 28px;
            font-weight: 500;
            margin-bottom: 8px;
            letter-spacing: 1px;
        }

        .subtitle {
            color: #2d3a4b;
            font-size: 14px;
            margin-bottom: 30px;
            opacity: 0.8;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            margin-bottom: 5px;
            font-weight: 500;
            color: #2d3a4b;
            font-size: 14px;
        }

        .form-input {
            width: 100%;
            padding: 7px 10px;
            border: 1px solid #bfc9d1;
            border-radius: 4px;
            font-size: 1em;
            transition: all 0.3s ease;
            background: #fafbfc;
            margin-bottom: 14px;
        }

        .form-input:focus {
            outline: none;
            border-color: #a7d4f8ff;
            background: white;
            box-shadow: 0 0 0 3px rgba(167, 212, 248, 0.1);
        }

        .checkbox-group {
            display: flex;
            align-items: flex-start;
            margin-bottom: 25px;
        }

        .checkbox {
            width: 18px;
            height: 18px;
            margin-right: 10px;
            margin-top: 2px;
        }

        .checkbox-label {
            font-size: 14px;
            color: #2d3a4b;
            cursor: pointer;
            font-weight: 400;
            line-height: 1.4;
        }

        .checkbox-label a {
            color: #a7d4f8ff;
            text-decoration: none;
        }

        .checkbox-label a:hover {
            color: #2853ffff;
        }

        .register-btn {
            width: 100%;
            padding: 10px;
            background-color: #a7d4f8ff;
            border: none;
            border-radius: 4px;
            color: white;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-bottom: 20px;
        }

        .register-btn:hover {
            background-color: #2853ffff;
        }

        .login-link {
            text-align: center;
        }

        .login-link a {
            color: #a7d4f8ff;
            text-decoration: none;
            font-size: 14px;
            transition: color 0.3s ease;
        }

        .login-link a:hover {
            color: #2853ffff;
        }

        .alert {
            padding: 7px 10px;
            border-radius: 4px;
            margin-bottom: 14px;
            font-size: 14px;
        }

        .alert-error {
            background: #fcdbcc;
            color: #2d3a4b;
            border: 1px solid #bfc9d1;
        }

        .error-list {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .error-list li {
            margin-bottom: 5px;
        }

        @media (max-width: 480px) {
            .register-container {
                margin: 20px;
                padding: 30px 25px;
            }

            .title {
                font-size: 24px;
            }
        }
    </style>
</head>
<body>
    <div class="register-container">
        <div class="logo-section">
            <div class="logo">UV</div>
            <h1 class="title">Create Account</h1>
            <p class="subtitle">University Vehicle Requisition System</p>
        </div>

        <!-- Error Messages -->
        @if ($errors->any())
            <div class="alert alert-error">
                <ul class="error-list">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="form-group">
                <label for="name" class="form-label">Full Name</label>
                <input id="name" class="form-input" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" placeholder="Enter your full name">
            </div>

            <div class="form-group">
                <label for="email" class="form-label">Email Address</label>
                <input id="email" class="form-input" type="email" name="email" value="{{ old('email') }}" required placeholder="Enter your email">
            </div>

            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <input id="password" class="form-input" type="password" name="password" required autocomplete="new-password" placeholder="Enter your password">
            </div>

            <div class="form-group">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <input id="password_confirmation" class="form-input" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm your password">
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="checkbox-group">
                    <input type="checkbox" name="terms" id="terms" class="checkbox" required>
                    <label for="terms" class="checkbox-label">
                        {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'">'.__('Terms of Service').'</a>',
                                'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'">'.__('Privacy Policy').'</a>',
                        ]) !!}
                    </label>
                </div>
            @endif

            <button type="submit" class="register-btn">
                Create Account
            </button>

            <div class="login-link">
                <a href="{{ route('login') }}">
                    Already have an account? Sign in
                </a>
            </div>
        </form>
    </div>
</body>
</html>
