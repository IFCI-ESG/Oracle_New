<!DOCTYPE html>
<html>
<head>
    <title>Forgot Password - ESG PRAKRIT Portal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #00bcd4;
            background-image: linear-gradient(135deg, #00bcd4 0%, #007b8a 100%);
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
            font-family: 'Inter', sans-serif;
        }
        .main-container {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }
        .logo-container {
            text-align: center;
            margin-bottom: 30px;
        }
        .logo {
            width: 120px;
            height: auto;
            margin-bottom: 15px;
        }
        .brand-name {
            color: #333;
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 5px;
        }
        .brand-tagline {
            color: #666;
            font-size: 14px;
        }
        .card {
            background: white;
            width: 100%;
            max-width: 400px;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            padding: 40px;
            transform: translateY(0);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
        }
        .card-title {
            text-align: center;
            color: #333;
            margin-bottom: 25px;
            font-size: 15px;
            line-height: 1.6;
            font-weight: 400;
        }
        .form-label {
            font-weight: 500;
            font-size: 14px;
            color: #444;
            margin-bottom: 8px;
        }
        .form-control {
            border-radius: 12px;
            padding: 12px 16px;
            margin-bottom: 20px;
            border: 2px solid #e1e1e1;
            font-size: 15px;
            transition: all 0.3s ease;
        }
        .form-control:focus {
            border-color: #6c5ce7;
            box-shadow: 0 0 0 3px rgba(108, 92, 231, 0.1);
        }
        .form-control::placeholder {
            color: #aaa;
        }
        .btn {
            padding: 12px 20px;
            border-radius: 12px;
            font-weight: 500;
            font-size: 15px;
            transition: all 0.3s ease;
        }
        .btn-reset {
            background-color: #6c5ce7;
            border: none;
            width: 100%;
            color: white;
            margin-top: 10px;
        }
        .btn-reset:hover {
            background-color: #5b4cdb;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(108, 92, 231, 0.2);
        }
        .btn-signin {
            background-color: transparent;
            border: 2px solid #6c5ce7;
            width: 100%;
            color: #6c5ce7;
            margin-top: 15px;
        }
        .btn-signin:hover {
            background-color: #6c5ce7;
            color: white;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(108, 92, 231, 0.2);
        }
        .alert {
            border-radius: 12px;
            margin-bottom: 25px;
            padding: 15px 20px;
            font-size: 14px;
            border: none;
        }
        .alert-success {
            background-color: #d4edda;
            color: #155724;
        }
        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
        }
        .alert ul {
            margin-bottom: 0;
        }
        .footer {
            text-align: center;
            padding: 20px;
            color: rgba(255, 255, 255, 0.9);
            font-size: 14px;
            font-weight: 500;
        }
        .footer a {
            color: white;
            text-decoration: none;
            font-weight: 600;
        }
        .footer a:hover {
            text-decoration: underline;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .card {
            animation: fadeIn 0.6s ease-out;
        }
    </style>
</head>
<body>
    <div class="main-container">
        <div class="card">
            <div class="card-body p-0">
                <div class="logo-container">
                    <img src="{{ asset('images/logo/home-logo1.jpg') }}" alt="ESG PRAKRIT Logo" class="logo">
                    <div class="brand-name">ESG PRAKRIT</div>
                    <div class="brand-tagline">Password Recovery</div>
                </div>

                <div class="card-title">
                    Enter your email address and we'll send you an email with instructions to reset your password.
                </div>

                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0 list-unstyled">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" 
                               class="form-control" 
                               id="email" 
                               name="email" 
                               placeholder="Enter your email"
                               required
                               autocomplete="email"
                               autofocus>
                    </div>
                    <button type="submit" class="btn btn-reset">Reset Password</button>
                </form>
                <a href="/admin/login" class="btn btn-signin">Back to Sign In</a>
            </div>
        </div>
    </div>
    <footer class="footer">
        <div>2024 - 2025 &copy; <a href="#">ESG Prakrit</a> - All rights reserved</div>
    </footer>
</body>
</html>
