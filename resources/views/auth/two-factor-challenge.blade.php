<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Two-Factor Authentication - University Vehicle Requisition System</title>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
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

        .two-factor-container {
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
            text-align: center;
            letter-spacing: 2px;
        }

        .form-input:focus {
            outline: none;
            border-color: #a7d4f8ff;
            background: white;
            box-shadow: 0 0 0 3px rgba(167, 212, 248, 0.1);
        }

        .verify-btn {
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

        .verify-btn:hover {
            background-color: #2853ffff;
        }

        .toggle-links {
            text-align: center;
            margin-bottom: 20px;
        }

        .toggle-link {
            color: #a7d4f8ff;
            text-decoration: none;
            font-size: 14px;
            transition: color 0.3s ease;
            background: none;
            border: none;
            cursor: pointer;
            font-family: inherit;
        }

        .toggle-link:hover {
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

        [x-cloak] {
            display: none !important;
        }

        @media (max-width: 480px) {
            .two-factor-container {
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
    <div class="two-factor-container">
        <div class="logo-section">
            <div class="logo">UV</div>
            <h1 class="title">Two-Factor Auth</h1>
            <p class="subtitle">University Vehicle Requisition System</p>
        </div>

        <div x-data="{ recovery: false }">
            <div class="description" x-show="! recovery">
                Please confirm access to your account by entering the authentication code provided by your authenticator application.
            </div>

            <div class="description" x-show="recovery" x-cloak>
                Please confirm access to your account by entering one of your emergency recovery codes.
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

            <form method="POST" action="{{ route('two-factor.login') }}">
                @csrf

                <div class="form-group" x-show="! recovery">
                    <label for="code" class="form-label">Authentication Code</label>
                    <input id="code" class="form-input" type="text" inputmode="numeric" name="code" autofocus x-ref="code" autocomplete="one-time-code" placeholder="000000">
                </div>

                <div class="form-group" x-show="recovery" x-cloak>
                    <label for="recovery_code" class="form-label">Recovery Code</label>
                    <input id="recovery_code" class="form-input" type="text" name="recovery_code" x-ref="recovery_code" autocomplete="one-time-code" placeholder="Enter recovery code">
                </div>

                <div class="toggle-links">
                    <button type="button" class="toggle-link"
                            x-show="! recovery"
                            x-on:click="
                                recovery = true;
                                $nextTick(() => { $refs.recovery_code.focus() })
                            ">
                        Use a recovery code
                    </button>

                    <button type="button" class="toggle-link"
                            x-show="recovery"
                            x-cloak
                            x-on:click="
                                recovery = false;
                                $nextTick(() => { $refs.code.focus() })
                            ">
                        Use an authentication code
                    </button>
                </div>

                <button type="submit" class="verify-btn">
                    Verify & Login
                </button>
            </form>
        </div>
    </div>
</body>
</html>
