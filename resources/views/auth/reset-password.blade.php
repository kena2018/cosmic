<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="icon" href="{{ asset('public/assets/img/Cosmiclogo.ico') }}"/>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: "Inter", sans-serif;
            background-color: #2D2222;
        }

        .login-card {
            border-radius: 8px;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 730px;
        }

        .login-card h2 {
            font-size: 27px;
            color: #ffffff;
            margin-bottom: 5px;
            margin-top: -8px;
            font-family: "Inter", sans-serif;
            font-weight: 400;
            letter-spacing: 1px;
        }

        .login-card p {
            font-size: 12px;
            font-weight: 300;
            color: #ffffff;
            text-transform: uppercase;
            margin-bottom: 25px;
            font-family: "Inter", sans-serif;
            letter-spacing: 1px;
        }

        .form-group {
            margin-bottom: 12px;
        }

        .form-group input::placeholder {
            text-transform: uppercase;
            font-size: 12px;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: #000; 
        }

        .form-group input {
            width: 94%;
            padding: 0.5rem;
            border: 1px solid #ccc;
            border-radius: 4px;
            outline: none;
        }

        button {
            width: 86%;
            padding: 10px;
            border: none;
            border-radius: 4px;
            background-color: #6B4023;
            color: #fff;
            font-size: 13px;
            cursor: pointer;
            transition: .5s;
            text-transform: uppercase;
        }

        .form-side-img img {
            height: 185px;
            padding: 0px 0px 10px 15px;
        }

        .right-form {
            width: 40%;
            border-left: 1px solid #ddd;
            padding: 0px 15px 0px 95px;
            height: 450px;
            display: flex;
            justify-content: center;
            flex-direction: column;
        }

        .password-inp-grp {
            margin-bottom: 25px;
        }

        button:hover {
            background-color: #774524;
        }

        .error {
            color: red;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }

        .right-form .alert-danger ul li {
            font-size: 12px;
            list-style: none;
            margin-left: -40px;
            color: #f00;
        }

        @media (max-width: 768px) {
            .form-side-img { margin: 0 70px 0 49px; }
            .login-card { justify-content: center; width: 100%; }
            .right-form { width: 100%; padding: 40px 15px 0px 15px; border-left: 1px solid #ddd; }
            .login-card p { margin-bottom: 20px; }
            button { width: 68%; margin-top: 8px; }
            .form-group input { width: 80%; }
        }

        @media (max-width: 600px) {
            .form-side-img img { height: 150px; padding: 0; }
            .login-card h2 { font-size: 22px; }
            .form-side-img { margin: 0px 0 45px 0; }
            .login-card { display: block; width: 100%; }
            .right-form { height: auto; width: 100%; border-left: none; padding: 40px 10px 0 0; }
            .login-card p { margin-bottom: 20px; }
            button { width: 55%; margin-top: 8px; }
            .form-group input { width: 65%; }
        }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="form-side-img">
            @if(str_contains(url('/'), '127.0.0.1'))
                <img src="{{ asset('assets/img/Cosmiclogo.png') }}">
            @else
                <img src="{{ asset('public/assets/img/Cosmiclogo.png') }}">
            @endif
        </div>

        <div class="right-form">
            <h2>Reset Password</h2>
            <p>Enter your new password below.</p>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('forgot.passchange', $token) }}" id="ResetPasswordForm">
                @csrf

                <div class="form-group">
                    <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="Email">
                    <div id="emailError" class="error"></div>
                </div>

                <div class="form-group">
                    <input type="password" id="password" name="password" placeholder="New Password">
                    <div id="passwordError" class="error"></div>
                </div>

                <div class="form-group">
                    <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password">
                    <div id="passwordConfirmationError" class="error"></div>
                </div>

                <button type="submit">Reset Password</button>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#ResetPasswordForm').on('submit', function(event) {
                var valid = true;
                $('.error').text('');

                var email = $('#email').val();
                var password = $('#password').val();
                var passwordConfirmation = $('#password_confirmation').val();

                if (email === '') {
                    $('#emailError').text('Email is required.');
                    valid = false;
                } else if (!validateEmail(email)) {
                    $('#emailError').text('Invalid email format.');
                    valid = false;
                }

                if (password === '') {
                    $('#passwordError').text('Password is required.');
                    valid = false;
                } else if (password.length < 8) {
                    $('#passwordError').text('Password must be at least 8 characters long.');
                    valid = false;
                } else if (!/[A-Z]/.test(password)) { // Uppercase letter check
                    $('#passwordError').text('Password must contain at least one uppercase letter.');
                    valid = false;
                } else if (!/[!@#$%^&*(),.?":{}|<>]/.test(password)) { // Special character check
                    $('#passwordError').text('Password must contain at least one special character.');
                    valid = false;
                }

                if (password !== passwordConfirmation) {
                    $('#passwordConfirmationError').text('Passwords do not match.');
                    valid = false;
                }

                if (!valid) {
                    event.preventDefault();
                }
            });

            function validateEmail(email) {
                var re = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
                return re.test(email);
            }
        });
    </script>
</body>
</html>
