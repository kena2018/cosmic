<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cosmic Stationery Password Reset</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="icon" href="{{ asset('public/assets/img/Cosmiclogo.ico') }}"/>
    <link rel="stylesheet" href="http://localhost/cosmic-erp/public/assets/css/kaiadmin.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <style>
        body { display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; font-family: "Inter", sans-serif; background-color: #2D2222;}
        .login-card { border-radius: 8px; text-align: center; display: flex; align-items: center; justify-content: space-between; width: 730px;}
        .login-card h2 { font-size: 27px; color: #ffffff; margin-bottom: 5px; margin-top: -8px; font-family: "Inter", sans-serif; font-weight: 400; letter-spacing: 1px;}
        .login-card p { font-size: 11px; font-weight: 300; color: #ffffff; text-transform: uppercase; margin-bottom: 15px; font-family: "Inter", sans-serif; letter-spacing: 2px; word-spacing: 3px;}
        .form-side-img img{ height: 185px; padding: 0px 0px 10px 15px;}
        .right-form { width: 40%; border-left: 1px solid #ddd; padding: 0px 15px 0px 95px; height: 450px; display: flex; justify-content: center; flex-direction: column;}
        .link-reset {font-size: 13px; font-weight: 400; color: #ffffff;text-decoration: underline !important;margin: 5px 0 10px 0;}
        @media (max-width:768px){
             .login-card p{ margin-bottom: 20px;}
            .form-side-img img { height: 125px; padding: 0;}
            .login-card h2 { font-size: 22px;}
            .form-side-img{ margin: 0px 0 45px 0;}
            .login-card { display: block; width: 100%;}
            .right-form {height: auto;width:100%; border-left: none; padding: 0px 10px 0 0;}
        }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="form-side-img">
        @if(str_contains(url('/'), '127.0.0.1'))
            <img src="http://localhost/cosmic-erp/public/assets/img/Cosmiclogo.png">
        @else
            <img src="http://localhost/cosmic-erp/public/assets/img/Cosmiclogo.png">
        @endif
        </div>
        <div class="right-form">
            <h2>Password Reset</h2>
            <p>Click the link below to reset your password:</p>
            <a href="{{ $resetUrl }}" class="link-reset">Reset Password</a>
            <p>If you did not request a password reset, no further action is required.</p>
        </div> 
    </div>
</body>
</html>
