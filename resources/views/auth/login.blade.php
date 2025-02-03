<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cosmic Stationery Login Page</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="icon" href="{{ asset('public/assets/img/Cosmiclogo.ico') }}"/>
    <link rel="stylesheet" href="http://localhost/cosmic-erp/public/assets/css/kaiadmin.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <style>
        body { display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; font-family: "Inter", sans-serif; background-color: #2D2222;}
        .login-card { border-radius: 8px; text-align: center; display: flex; align-items: center; justify-content: space-between; width: 730px;}
        .login-card h2 { font-size: 27px; color: #ffffff; margin-bottom: 5px; margin-top: -8px; font-family: "Inter", sans-serif; font-weight: 400; letter-spacing: 1px;}
        .login-card p { font-size: 12px; font-weight: 300; color: #ffffff; text-transform: uppercase; margin-bottom: 25px; font-family: "Inter", sans-serif; letter-spacing: 1px;}
        .form-group { margin-bottom: 15px;}
        .form-group input::placeholder{text-transform: uppercase; font-size:12px;}
        .form-group label { display: block; margin-bottom: 0.5rem; color: #000; }
        .form-group input { width: 94%; padding: 0.5rem; border: 1px solid #ccc; border-radius: 4px; outline:none;}
        .log-in-btn { width: 86%; padding: 10px; border: none; border-radius: 4px; background-color: #6B4023; color: #fff; font-size: 13px; cursor: pointer; transition: .5s; text-transform: uppercase;}
        .form-side-img img{ height: 185px; padding: 0px 0px 10px 15px;}
        .right-form { width: 40%; border-left: 1px solid #ddd; padding: 0px 15px 0px 95px; height: 450px; display: flex; justify-content: center; flex-direction: column;}
        .log-in-btn:hover {  background-color: #774524;}
        .error { color: red;font-size: 0.875rem; margin-top: 0.25rem;}
        .right-form .alert-danger ul li { font-size: 12px; list-style: none; margin-left: -40px; color: #f00;}
        .forgot-passwrd-link { text-align: end;  margin: -10px 0px 20px 0;}
        .forgot-passwrd-link .link-forgot  { font-size: 12px; font-weight: 400; color: #ffffff;}
        @media (max-width:768px){
             .login-card p{ margin-bottom: 20px;}
            .forgot-passwrd-link {  margin: -10px 25px 20px 0;}
            .form-side-img img { height: 125px; padding: 0;}
            .login-card h2 { font-size: 22px;}
            .form-side-img{ margin: 0px 0 45px 0;}
            .login-card { display: block; width: 100%;}
            .right-form {height: auto;width:100%; border-left: none; padding: 0px 10px 0 0;}
            .log-in-btn { width: 55%; margin-top: 8px;}
            .form-group input { width: 65%;}
            .forgot-passwrd-link { width: 84%;}
        }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="form-side-img">
        @if(str_contains(url('/'), '127.0.0.1'))
            <img src="{{ asset('assets/img/Cosmiclogo.png')}}">
        @else
            <img src="{{ asset('public/assets/img/Cosmiclogo.png')}}">
        @endif
        </div>

        <div class="right-form">
            <h2>Welcome</h2>
            <p>Please Login to Admin Dashboard</p>
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <form method="POST" action="{{ route('login') }}" id="loginForm">
            @csrf
            <div class="form-group">
                <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="Email">
                <div id="emailError" class="error"></div>
            </div>
            <div class="form-group password-inp-grp">
                <input type="password" id="password" name="password" autocomplete="current-password" placeholder="Password">
                <div id="passwordError" class="error"></div>
            </div>
            <div class="forgot-passwrd-link">
                <a href="{{route('admin.forgot-password')}}" class="link-primary fs-6 fw-bold link-forgot">Forgot Password ?</a>
            </div>
            <button class="log-in-btn" type="submit">Log in</button>
            </form>
        </div> 
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": true, // Optional: Set to true to show newest notifications on top
        "progressBar": true,
        "positionClass": "toast-top-center", // Position notifications in the top-right corner
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }

    @if (session('success'))
        toastr.success("{{ session('success') }}");
    @endif

    @if (session('error'))
        toastr.error("{{ session('error') }}");
    @endif

    @if (session('warning'))
        toastr.warning("{{ session('warning') }}");
    @endif

    @if (session('info'))
        toastr.info("{{ session('info') }}");
    @endif
</script>
    <script>
        $(document).ready(function() {
            $('#loginForm').on('submit', function(event) {
                var valid = true;
                $('.error').text('');

                var email = $('#email').val();
                var password = $('#password').val();

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
                } else if (password.length < 6) {
                    $('#passwordError').text('Password must be at least 6 characters long.');
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
