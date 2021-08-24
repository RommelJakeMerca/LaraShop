<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LegaShop - Client Get QR Code</title>
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
<!-- scroll top -->
<a href="{{ url('/') }}" class="scrolltop" id="scroll-top">
    <i class='bx bx-chevron-up scrolltop_icon'></i>
</a>
<!-- main -->
<main class="l-main">
    <!-- Services -->
        <section class="services section bd-container" id="services">
            <span class="section-subtitle">Hey!</span>
            <h2 class="section-title">Here is you auto generated QR Code</h2>
        
                <div class="services_data" style="background: url(./asset/img/shopping.png);">
                    {{ $qr_code }}
                    <h3 class="services_title">NOTE</h3>
                    <p class="services_description" style="color: red;">*Only share this Code to someone you trust, otherwise your purchase will be compromised.</p>
                    <h3 class="services_title">Take a Screenshot or take a picture of this page and for it will be your referrence to present to our partner stores</h3>
                </div>
               
        </section>
    <!-- footer -->
        <footer class="footer">
            <div class="footer_container bd-container">
                <h1 class="footer_title">LegaShop</h1>
                <p class="footer_description">Lorem ipsum dolor sit amet consectetur 
                    adipisicing elit. Maiores, obcaecati.</p>

                <div class="footer_social">
                    <a href="#" class="footer_link"><i class="bx bxl-linkedin"></i></a>
                    <a href="#" class="footer_link"><i class="bx bxl-whatsapp-square"></i></a>
                    <a href="#" class="footer_link"><i class="bx bxl-facebook-square"></i></a>
                </div>

                <p class="footer_copy">&#169; 2021 LegaShop. All rights reserved</p>
            </div>
        </footer>
</main>

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