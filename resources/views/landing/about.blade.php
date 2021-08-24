<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LegaShop - About</title>
    <!-- add icon link -->
    <link rel="shortcut icon" href="{{ asset('landing_asset/img/logo.ico') }}" />
    <!-- google fonts cdn link  -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Dancing+Script&display=swap">
    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    <!-- swiper css -->
    <link rel="stylesheet" href="{{ asset('landing_asset/css/swiper-bundle.min.css') }}">
    <!-- box icons -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <!-- main css -->
    <link rel="stylesheet" href="{{ asset('landing_asset/css/about-style.css') }}">
</head>
<body>
<!-- header -->
    <header class="l-header" id="header">
        <nav class="nav bd-container">
            <a href="index.html" class="nav_logo"><img style="margin-top: 30px; width: 50px;" src="{{ asset('landing_asset/img/logo.png') }}" alt="logo"></a>

            <div class="nav_menu" id="nav-menu">
                <ul class="nav_list">
                    <li class="nav_item"><a href="{{ url('/') }}" class="nav_link">Home</a></li>
                    <li class="nav_item"><a href="{{ url('/') }}" class="nav_link">Services</a></li>
                    <li class="nav_item"><a href="{{ url('/about') }}" class="nav_link active-link">About</a></li>
                    <li class="nav_item"><a href="{{ url('/') }}" class="nav_link">Contact Us</a></li>
                </ul>
            </div>
            <div class="nav_toggle" id="nav-toggle">
                <i class='bx bx-menu-alt-right'></i>
            </div>
        </nav>
    </header>

<!-- about secction -->
    <section class="faq" id="faq">
        <h1 class="heading" style="color: #fff; font-size: 40px; font-family: 'Dancing Script', cursive;">Who we are?</h1>
        <div class="row">
            <div class="image">
                <img src="{{ asset('landing_asset/img/about-img.svg') }}" alt="">
            </div>
            <div class="accordion-container">
                <div class="accordion">
                    <h1 class="accordion-heading">
                        What is LegaShop?
                    </h1>
                    <p class="accordion-content">
                        LegaShop is ... Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni, est.
                    </p>
                </div>
                <div class="accordion">
                    <h1 class="accordion-heading">
                        Who are we?
                    </h1>
                    <p class="accordion-content">
                        We are ... Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque natus iure impedit expedita error magnam!
                    </p>
                </div>
                <div class="accordion">
                    <h1 class="accordion-heading">
                        Where can you find us?
                    </h1>
                    <p class="accordion-content">
                        LegaShop is located at ... Lorem, ipsum dolor sit amet consectetur adipisicing elit. Exercitationem, ea! Excepturi, nostrum consequatur. Molestiae, cum!
                    </p>
                </div>
                <div class="accordion">
                    <h1 class="accordion-heading">
                        What are our vision?
                    </h1>
                    <p class="accordion-content">
                        LegaShop aims to ... Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia, ratione.
                    </p>
                </div>
                <div class="accordion">
                    <h1 class="accordion-heading">
                        What are our mission?
                    </h1>
                    <p class="accordion-content">
                        LegaShop intends to ... Lorem ipsum dolor sit, amet consectetur adipisicing elit. Inventore, eius.
                    </p>
                </div>
            </div>
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

    <!-- loader -->
    <div class="loader-wrapper">
        <span class="loader"><span class="loader-inner"></span></span>
    </div>

<!-- jquery cdn link  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- mixitup filter -->
    <script src="{{ asset('landing_asset/js/mixitup.min.js') }}"></script>
    <!-- swiper js -->
    <script src="{{ asset('landing_asset/js/swiper-bundle.min.js') }}"></script>
    <!-- gsap -->
    <script src="{{ asset('landing_asset/js/gsap.min.js') }}"></script>
    <!-- main js -->
    <script src="{{ asset('landing_asset/js/main.js') }}"></script>
    <!-- custom js file link  -->
    <script src="{{ asset('landing_asset/js/about.js') }}"></script>
    <script>
        $(window).on("load",function(){
          $(".loader-wrapper").fadeOut("slow");
        });
    </script>
</body>
</html>