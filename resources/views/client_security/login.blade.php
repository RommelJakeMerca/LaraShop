<!DOCTYPE html>
<html>
<head>
	<title>LegaShop - Login</title>
    
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" type="text/css" href="{{ asset('auth_assets_client/style.css') }}">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
	<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
	<!-- add icon link -->
    <link rel="shortcut icon" href="{{ asset('landing_asset/img/logo.ico') }}" />
	 <!-- swiper css -->
	 <link rel="stylesheet" href="{{ asset('landing_asset/css/swiper-bundle.min.css') }}">
	 <!-- box icons -->
	 <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
	 <!-- main css -->
	 <link rel="stylesheet" href="{{ asset('landing_asset/css/style.css') }}">
	 <!-- jquery -->
	 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js" integrity="sha512-AFwxAkWdvxRd9qhYYp1qbeRZj6/iTNmJ2GFwcxsMOzwwTaRwz2a/2TX225Ebcj3whXte1WGQb38cXE5j7ZQw3g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>	
</head>
<body>
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-6 col-md-6 form-container">
				<div class="col-lg-8 col-md-12 col-sm-9 col-xs-12 form-box text-center">
					{{-- <div class="logo mt-5 mb-6">
						<img src="{{ asset('auth_assets/img/logo.png') }}" width="150px">
					</div> --}}
					<div class="heading mb-12">
						<h4>LegaShop - Login</h4>
					</div>
					<form method="POST" action="{{ route('login_action') }}">
                    @csrf
						<div class="form-input">
							{{-- <span><i class="fa fa-envelope"></i></span> --}}
							<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email Address">
							@error('email')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>
						<div class="form-input">
							{{-- <span><i class="fa fa-lock"></i></span> --}}
							<input input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">
							@error('password')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
                            @enderror
						</div>
						<div class="row mb-3">
							<div class="col-6 d-flex">
								<div class="custom-control custom-checkbox">
									<input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }} class="custom-control-input" id="cb1">
									<label class="custom-control-label text-white" for="cb1">Remember me</label>
								</div>
							</div>
							<!-- <div class="col-6 text-right">
								<a href="forget.html" class="forget-link">Forget password</a>
							</div> -->
						</div>
						<div class="text-left mb-3">
							<button type="submit" class="btn">Login</button>
						</div>
						<div class="text-white mb-3">or login with</div>
						<div class="row mb-3">
							<div class="col-6">
								<a href="{{ route('login.facebook') }}" class="btn btn-block btn-social btn-facebook">
									<i class="fa fa-facebook"></i>
								</a>
							</div>
							<div class="col-6">
								<a href="{{ route('login.google') }}" class="btn btn-block btn-social btn-google">
									<i class="fa fa-google"></i>
								</a>
							</div>
						</div>
						<div class="text-white">Don't have an account?
							<a href="" class="register-link">Register here</a>
						</div>
					</form>
				</div>
			</div>

			<div class="col-lg-6 col-md-6 d-none d-md-block image-container"></div>
		</div>
	</div>
<!-- loader -->
<div class="loader-wrapper">
    <span class="loader"><span class="loader-inner"></span></span>
</div>
<!-- scripts -->
    <!-- mixitup filter -->
    <script src="{{ asset('landing_asset/js/mixitup.min.js') }}"></script>
    <!-- swiper js -->
    <script src="{{ asset('landing_asset/js/swiper-bundle.min.js') }}"></script>
    <!-- gsap -->
    <script src="{{ asset('landing_asset/js/gsap.min.js') }}"></script>
    <!-- main js -->
    <script src="{{ asset('landing_asset/js/main.js') }}"></script>
    <!-- script for loading -->
    <script>
        $(window).on("load",function(){
          $(".loader-wrapper").fadeOut("slow");
        });
    </script>
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
</body>
</html>