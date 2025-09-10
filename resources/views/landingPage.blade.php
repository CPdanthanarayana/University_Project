<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Vehicle Allocation System - Sabaragamuwa University of Sri Lanka</title>
    
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5 CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    
    <style>
        body {
            background: #ffffff;
            height: 100vh;
            color: #333;
            font-family: 'Poppins', sans-serif;
            overflow-x: hidden;
        }
        
        .landing-container {
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            position: relative;
        }
        
        .university-logo {
            width: 120px;
            margin-bottom: 30px;
        }
        
        .main-heading {
            font-weight: 700;
            margin-bottom: 15px;
            font-size: 3rem;
            color: #124C82;
            letter-spacing: -0.5px;
        }
        
        .sub-heading {
            font-weight: 400;
            margin-bottom: 20px;
            font-size: 1.5rem;
            color: #4A4A4A;
        }
        
        .lead {
            color: #6B7280;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }
        
        .btn-container {
            margin-top: 40px;
        }
        
        .btn-landing {
            padding: 12px 32px;
            font-size: 1rem;
            margin: 0 10px;
            transition: all 0.3s ease;
            font-weight: 500;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        
        .btn-primary {
            background: #124C82;
            border-color: #124C82;
        }
        
        .btn-primary:hover {
            background: #0D3C68;
            border-color: #0D3C68;
            transform: translateY(-3px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }
        
        .btn-outline {
            color: #124C82;
            border: 2px solid #124C82;
            background: transparent;
        }
        
        .btn-outline:hover {
            background: rgba(18, 76, 130, 0.1);
            transform: translateY(-3px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
        }
        
        .footer {
            position: absolute;
            bottom: 20px;
            width: 100%;
            text-align: center;
            color: #6B7280;
            font-size: 0.9rem;
        }
        
        .wave-container {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            overflow: hidden;
            line-height: 0;
            transform: rotate(180deg);
            z-index: -1;
        }
        
        .wave-container svg {
            display: block;
            width: calc(100% + 1.3px);
            height: 150px;
        }
        
        .wave-container .shape-fill {
            fill: #124C82;
            opacity: 0.05;
        }
        
        /* Add Google font */
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
    </style>
</head>
<body>
    <div class="container landing-container">
        <div class="row justify-content-center">
            <div class="col-md-10 text-center">
                <img src="{{asset('images/Logo-SUSL.png')}}" alt="Sabaragamuwa University Logo" class="university-logo">
                <h1 class="main-heading">Vehicle Allocation System</h1>
                <h2 class="sub-heading">Sabaragamuwa University of Sri Lanka</h2>
                <p class="lead mb-4">Efficient management of requesting and scheduling of university vehicles</p>
                
                <div class="btn-container">
                    <a href="/login" class="btn btn-primary btn-landing">
                        <i class="fas fa-sign-in-alt me-2"></i> Login
                    </a>
                    <a href="/register" class="btn btn-outline btn-landing">
                        <i class="fas fa-user-plus me-2"></i> Register
                    </a>
                </div>
                
                
            </div>
        </div>
        
        <div class="footer">
            <p>&copy; {{ date('Y') }} Sabaragamuwa University of Sri Lanka. All Rights Reserved.</p>
        </div>
        
        <!-- Decorative wave shape -->
        <div class="wave-container">
            <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" class="shape-fill"></path>
            </svg>
        </div>
    </div>
    
    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>