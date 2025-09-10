<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Vehicle Allocation System - Sabaragamuwa University of Sri Lanka</title>
    
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5 CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    
    <style>
        :root {
            --primary: #124C82;
            --secondary: #4A90E2;
            --accent: #6EC1E4;
            --dark: #333333;
            --light: #F8F9FA;
        }
        
        body {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 50%, #dee2e6 100%);
            min-height: 100vh;
            width: 100%;
            color: #333;
            font-family: 'Poppins', sans-serif;
            overflow-x: hidden;
            position: relative;
        }
        
        html {
            scroll-behavior: smooth;
        }
        
        /* Clean modern styling */
        
        /* Clean background styling */
        
        .landing-container {
            min-height: 100vh;
            padding: 2rem 1rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            position: relative;
        }
        
        .content-card {
            background-color: #ffffff;
            padding: 3.5rem;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(31, 38, 135, 0.1);
            max-width: 1000px;
            width: 100%;
            min-height: 500px;
            margin: 0 auto;
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        
        .content-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 36px rgba(31, 38, 135, 0.25);
        }
        
        .university-logo {
            width: 180px;
            margin-bottom: 40px;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }
        
        .main-heading {
            font-weight: 700;
            margin-bottom: 16px;
            font-size: 3rem;
            color: #124C82;
            letter-spacing: -0.5px;
        }
        
        .sub-heading {
            font-weight: 400;
            margin-bottom: 25px;
            font-size: 1.5rem;
            color: #4A4A4A;
        }
        
        .lead {
            color: #6B7280;
            max-width: 700px;
            margin-left: auto;
            margin-right: auto;
            font-size: 1.1rem;
            line-height: 1.7;
        }
        
        .btn-container {
            margin-top: 40px;
            margin-bottom: 15px;
        }
        
        .btn-landing {
            padding: 12px 35px;
            font-size: 1rem;
            margin: 0 12px;
            transition: all 0.3s ease;
            font-weight: 600;
            border-radius: 50px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            position: relative;
            overflow: hidden;
            letter-spacing: 0.5px;
            z-index: 1;
        }
        
        .btn-landing:before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(
                90deg,
                rgba(255, 255, 255, 0.1),
                rgba(255, 255, 255, 0.5),
                rgba(255, 255, 255, 0.1)
            );
            transition: all 0.6s;
            z-index: -1;
        }
        
        .btn-landing:hover:before {
            left: 100%;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #124C82, #0D3C68);
            border: none;
        }
        
        .btn-primary:hover {
            background: linear-gradient(135deg, #0D3C68, #124C82);
            transform: translateY(-3px);
            box-shadow: 0 6px 18px rgba(18, 76, 130, 0.25);
        }
        
        .btn-outline {
            color: #124C82;
            border: 2px solid #124C82;
            background: transparent;
            background: transparent;
        }
        
        .btn-outline:hover {
            background: rgba(18, 76, 130, 0.1);
            transform: translateY(-3px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
        }
        
        .footer {
            position: relative;
            margin-top: 2rem;
            width: 100%;
            text-align: center;
            color: #6B7280;
            font-size: 0.9rem;
            padding: 1rem 0;
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
        
        /* Responsive styling */
        @media (max-width: 1200px) {
            .content-card {
                max-width: 90%;
                padding: 2.5rem;
            }
        }
        
        @media (max-width: 991px) {
            .main-heading {
                font-size: 2.5rem;
            }
            
            .sub-heading {
                font-size: 1.3rem;
            }
            
            .lead {
                font-size: 1rem;
                max-width: 90%;
            }
        }
        
        @media (max-width: 768px) {
            .content-card {
                min-height: auto;
                padding: 2rem;
            }
            
            .university-logo {
                width: 140px;
                margin-bottom: 25px;
            }
            
            .main-heading {
                font-size: 2.2rem;
                margin-bottom: 15px;
            }
            
            .sub-heading {
                font-size: 1.2rem;
                margin-bottom: 20px;
            }
            
            .btn-container {
                margin-top: 30px;
                display: flex;
                flex-direction: column;
                align-items: center;
            }
            
            .btn-landing {
                margin: 10px 0;
                padding: 12px 30px;
                width: 200px;
            }
        }
        
        @media (max-width: 576px) {
            .content-card {
                padding: 1.5rem;
            }
            
            .main-heading {
                font-size: 1.8rem;
            }
            
            .sub-heading {
                font-size: 1.1rem;
            }
            
            .lead {
                font-size: 0.95rem;
                line-height: 1.6;
            }
            
            .wave-container svg {
                height: 100px;
            }
        }
        
        /* Add Google font */
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
    </style>
</head>
<body>
    
    <div class="container-fluid landing-container">
        <div class="row justify-content-center">
            <div class="col-md-12 text-center">
                <div class="content-card">
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