<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Email - University Vehicle Requisition System</title>
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

        .verify-container {
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

        .description {
            color: #2d3a4b;
            font-size: 14px;
            line-height: 1.5;
            margin-bottom: 25px;
            opacity: 0.9;
        }

        .action-buttons {
            display: flex;
            flex-direction: column;
            gap: 15px;
            margin-bottom: 20px;
        }

        .resend-btn {
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
        }

        .resend-btn:hover {
            background-color: #2853ffff;
        }

        .secondary-actions {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 10px;
            padding-top: 20px;
            border-top: 1px solid #bfc9d1;
        }

        .secondary-actions a,
        .secondary-actions button {
            color: #a7d4f8ff;
            text-decoration: none;
            font-size: 14px;
            transition: color 0.3s ease;
            background: none;
            border: none;
            cursor: pointer;
            font-family: inherit;
        }

        .secondary-actions a:hover,
        .secondary-actions button:hover {
            color: #2853ffff;
        }

        .alert {
            padding: 7px 10px;
            border-radius: 4px;
            margin-bottom: 14px;
            font-size: 14px;
        }

        .alert-success {
            background: #eaf0f6;
            color: #2d3a4b;
            border: 1px solid #bfc9d1;
        }

        @media (max-width: 480px) {
            .verify-container {
                margin: 20px;
                padding: 30px 25px;
            }

            .title {
                font-size: 24px;
            }

            .secondary-actions {
                flex-direction: column;
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <div class="verify-container">
        <div class="logo-section">
            <div class="logo">UV</div>
            <h1 class="title">Verify Email</h1>
            <p class="subtitle">University Vehicle Requisition System</p>
        </div>

        <div class="description">
            Before continuing, could you verify your email address by clicking on the link we just emailed to you? If you didn't receive the email, we will gladly send you another.
        </div>

        <!-- Success Message -->
        @if (session('status') == 'verification-link-sent')
            <div class="alert alert-success">
                A new verification link has been sent to the email address you provided in your profile settings.
            </div>
        @endif

        <div class="action-buttons">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button type="submit" class="resend-btn">
                    Resend Verification Email
                </button>
            </form>
        </div>

        <div class="secondary-actions">
            <a href="{{ route('profile.show') }}">
                Edit Profile
            </a>

            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                @csrf
                <button type="submit">
                    Log Out
                </button>
            </form>
        </div>
    </div>
</body>
</html>
