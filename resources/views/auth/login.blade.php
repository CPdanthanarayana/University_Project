<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - University Vehicle Requisition System</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: "Hanken Grotesk", sans-serif;
            background: #faf9f7ff;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-container {
            background: #fff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 2px 8px #fcdbcc;
            width: 100%;
            max-width: 400px;
        }

        .logo-section {
            text-align: center;
            margin-bottom: 30px;
        }

        .logo {
            width: 80px;
            height: 80px;
            background: #f8daa7ff;
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
            color: #4b412dff;
            font-size: 28px;
            font-weight: 500;
            margin-bottom: 8px;
            letter-spacing: 1px;
        }

        .subtitle {
            color: #4b412dff;
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
            color: #4b412dff;
            font-size: 14px;
        }

        .form-input {
            width: 100%;
            padding: 7px 10px;
            border: 1px solid #d1cabfff;
            border-radius: 4px;
            font-size: 1em;
            transition: all 0.3s ease;
            background: #fafbfc;
            margin-bottom: 14px;
        }

        .form-input:focus {
            outline: none;
            border-color: #d1cabfff;
            background: white;
            box-shadow: 0 0 0 3px rgba(248, 210, 167, 0.1);
        }

        .checkbox-group {
            display: flex;
            align-items: center;
            margin-bottom: 25px;
        }

        .checkbox {
            width: 18px;
            height: 18px;
            margin-right: 10px;
        }

        .checkbox-label {
            font-size: 14px;
            color: #4b412dff;
            cursor: pointer;
            font-weight: 400;
        }

        .login-btn {
            width: 100%;
            padding: 10px;
            background-color: #f8dea7ff;
            border: none;
            border-radius: 4px;
            color: white;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-bottom: 20px;
        }

        .login-btn:hover {
            background-color: #ff8528ff;
        }

        .forgot-password {
            text-align: center;
        }

        .forgot-password a {
            color: #f8dea7ff;
            text-decoration: none;
            font-size: 14px;
            transition: color 0.3s ease;
        }

        .forgot-password a:hover {
            color: #ff8528ff;
        }

        .alert {
            padding: 7px 10px;
            border-radius: 4px;
            margin-bottom: 14px;
            font-size: 14px;
        }

        .alert-success {
            background: #f6f3eaff;
            color: #4b412dff;
            border: 1px solid #d1ccbfff;
        }

        .alert-error {
            background: #fcdbcc;
            color: #4b412dff;
            border: 1px solid #d1cabfff;
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
            .login-container {
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
    <div class="login-container">
        <div class="logo-section">
            <div class="logo">UV</div>
            <h1 class="title">Welcome Back</h1>
            <p class="subtitle">University Vehicle Requisition System</p>
        </div>

        <!-- Success Message -->
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

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

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group">
                <label for="email" class="form-label">Email Address</label>
                <input id="email" class="form-input" type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="Enter your email">
            </div>

            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <input id="password" class="form-input" type="password" name="password" required autocomplete="current-password" placeholder="Enter your password">
            </div>

            <div class="checkbox-group">
                <input type="checkbox" id="remember_me" name="remember" class="checkbox">
                <label for="remember_me" class="checkbox-label">Remember me</label>
            </div>

            <button type="submit" class="login-btn">
                Sign In
            </button>

            <div class="forgot-password">
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}">
                        Forgot your password?
                    </a>
                @endif
            </div>
        </form>
    </div>
</body>
</html>
