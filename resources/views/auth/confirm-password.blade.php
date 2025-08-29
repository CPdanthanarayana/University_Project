<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Password - University Vehicle Requisition System</title>
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

        .confirm-container {
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

        .description {
            color: #2d3a4b;
            font-size: 14px;
            line-height: 1.5;
            margin-bottom: 25px;
            opacity: 0.9;
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

        .confirm-btn {
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

        .confirm-btn:hover {
            background-color: #2853ffff;
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
            .confirm-container {
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
    <div class="confirm-container">
        <div class="logo-section">
            <div class="logo">UV</div>
            <h1 class="title">Confirm Password</h1>
            <p class="subtitle">University Vehicle Requisition System</p>
        </div>

        <div class="description">
            This is a secure area of the application. Please confirm your password before continuing.
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

        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf

            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <input id="password" class="form-input" type="password" name="password" required autocomplete="current-password" autofocus placeholder="Enter your current password">
            </div>

            <button type="submit" class="confirm-btn">
                Confirm
            </button>
        </form>
    </div>
</body>
</html>
