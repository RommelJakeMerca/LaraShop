<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Login and Register</title>
    <!-- admin assets -->
    <link href="{{ asset('admin_assets/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <!-- main style -->
    <link rel="stylesheet" href="{{ asset('auth_assets/style.css') }}">
    <!-- jquery -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js" integrity="sha512-AFwxAkWdvxRd9qhYYp1qbeRZj6/iTNmJ2GFwcxsMOzwwTaRwz2a/2TX225Ebcj3whXte1WGQb38cXE5j7ZQw3g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>	
    <!-- landing css -->
	<link rel="stylesheet" href="{{ asset('landing_asset/css/style.css') }}">
    <!-- add icon link -->
    <link rel="shortcut icon" href="{{ asset('landing_asset/img/logo.ico') }}" />
</head>
<body>
    <div class="container">
        <div class="blueBg">
            <div class="box signin">
                <h2>Already have an account?</h2>
                <button class="signinBtn">Sign in</button>
            </div>
            <div class="box signup">
                <h2>Don't have an account?</h2>
                <button class="signupBtn">Sign up</button>
            </div>
        </div>

        <div class="formBx">
            {{-- login --}}
            <div class="form signinForm">
                <form action="{{ route('login_action') }}" method="POST">
                @csrf
                <h3 style="font-size: 15px;">Admin | Sign in</h3>
                <input type="text" name="email" placeholder="Email" style="font-size: 15px;">
                <input type="password" name="password" placeholder="Password" style="font-size: 15px;">
                <div class="form-group">
                    <div class="custom-control custom-checkbox small">
                        <input type="checkbox" class="custom-control-input" id="customCheck" name="remember" style="cursor: pointer">
                        <label class="custom-control-label" for="customCheck" style="font-size: 15px;">Remember
                            Me</label>
                    </div>
                </div>  
                <a href="{{ route('forgot_show') }}" class="forgot" style="padding-bottom: 10px;">Forgot Password</a>
                <input type="submit" value="Login" style="font-size: 15px;" name="signin">
                </form>
            </div>
            {{-- register --}}
            <div class="form signupForm">
                <form action="{{ route('register_action') }}" method="POST">
                @csrf
                @if(count($errors) > 0)
                    @foreach($errors->all() as $error)
                            <li class="alert alert-danger" style="font-size: 10px; color: red; list-style: none; padding: 5px; text-align: center;">{{ $error }}</li>
                    @endforeach
                @endif
                    <h3 style="font-size: 15px;">Admin | Sign up</h3>
                    <input type="text" name="username" placeholder="Username" style="font-size: 15px;">
                    <input type="email" name="email" placeholder="Email Address" style="font-size: 15px;">
                    <input type="password" name="password" placeholder="Password" style="font-size: 15px;">
                    <input type="password" name="password_confirmation" placeholder="ConfirmPassword" style="font-size: 15px;">
                    <input type="submit" value="Register" style="font-size: 15px;" name="signup">
                </form>
            </div>
        </div>
    </div>

<!-- loader -->
    <div class="loader-wrapper">
        <span class="loader"><span class="loader-inner"></span></span>
    </div>


{{-- sweetalert --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
    @if (session('status'))
    swal({
        title: '{{ session('status') }}',
        icon: '{{ session('statuscode') }}',
    });
    @endif
    </script>

<!-- loader script -->
    <script>
        $(window).on("load",function(){
          $(".loader-wrapper").fadeOut("slow");
        });
    </script>

<!-- main script -->
    <script>
        const signinBtn = document.querySelector('.signinBtn');
        const signupBtn = document.querySelector('.signupBtn');
        const formBx = document.querySelector('.formBx');
        const body = document.querySelector('body');

        signupBtn.onclick = function() {
            formBx.classList.add('active');
            body.classList.add('active');
        }

        signinBtn.onclick = function() {
            formBx.classList.remove('active');
            body.classList.remove('active');
        }
    </script>

</body>
</html>