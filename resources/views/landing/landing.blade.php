<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LegaShop - Home</title>
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

<!-- header -->
    <header class="l-header" id="header">
        <nav class="nav bd-container">
            <a href="#" class="nav_logo"><img style="width: 50px;" src="{{ asset('landing_asset/img/logo.png') }}" alt="logo"></a>
            <div class="nav_menu" id="nav-menu">
                <ul class="nav_list">
                    <li class="nav_item"><a href="#home" class="nav_link active-link">Home</a></li>
                    <li class="nav_item"><a href="#services" class="nav_link">Services</a></li>
                    <li class="nav_item"><a href="#about" class="nav_link">About</a></li>
                    <li class="nav_item"><a href="#contact" class="nav_link">Contact Us</a></li>
                    <li class="nav_item"><a href="{{ route('sentinel_login') }}" class="nav_link">Admin</a></li>
                </ul>
            </div>
            <div class="nav_toggle" id="nav-toggle">
                <i class='bx bx-menu-alt-right'></i>
            </div>
        </nav>
    </header>

<!-- main -->
<main class="l-main">
    <!-- home -->
        <section class="home" id="home">
            <div class="home_container bd-container bd-grid">
                <div class="home_data">
                    <span class="home_greeting">Welcome to </span>
                    <h1 class="home_name">LegaShop</span></h1>
                    <span class="home_profession">"Malayo ka man sa piling nila, ramdam parin ang alaga mo. ♡" <br> <span style="font-size: .5em;">Mula sa Pinoy para sa Pinoy</span></span>
                    
                    <a href="#services" class="button button-light home_button">Let's shop</a>
                </div>
                <!-- <div class="home_social">
                    <a href="#" class="home_social-icon"><i class='bx bxl-facebook-square'></i></a>
                    <a href="#" class="home_social-icon"><i class='bx bxl-instagram'></i></a>
                    <a href="#" class="home_social-icon"><i class='bx bxl-twitter'></i></a>
                </div> -->
                <div class="home_img">
                    <img src="{{ asset('landing_asset/img/pinoy.png') }}" alt="home">
                </div>
            </div>
        </section>

    
    <!-- Services -->
        <section class="services section bd-container" id="services">
            <span class="section-subtitle">What we Offer</span>
            <h2 class="section-title">Services</h2>
        
            <div class="services_container bd-grid">
                <div class="services_data" style="background: url(./asset/img/shopping.png);">
                    <i class="bx bxs-cart services_icon"></i>
                    <h3 class="services_title">Groceries</h3>
                    <p class="services_description">We offer online grocery services, where you can buy groceries for your family.</p>
                    <a href="{{ route('products.store') }}" class="button">Go to Shop</a>
                </div>

                <div class="services_data" style="background: url(./asset/img/paybills.png);">
                    <i class="bx bxs-bank services_icon"></i>
                    <h3 class="services_title">Pay Bills</h3>
                    <p class="services_description">We have our online paybills to securely give support from you to your loved ones.</p>
                    <a href="{{ url('/unavailable') }}" class="button">Go to Bills</a>
                </div>

                <div class="services_data" style="background: url(./asset/img/drugstore.png);">
                    <i class="bx bx-plus-medical services_icon"></i>
                    <h3 class="services_title">Drug Store</h3>
                    <p class="services_description">Your worries are our worries too, you can still take care of your family even if you're not there.</p>
                    <a href="{{ url('/unavailable') }}" class="button">Go to Store</a>
                </div>
            </div>


        </section>

    <!-- Projects in mind -->
        <section class="project section bd-container" id="about">
            <div class="project_container bd-grid">
                <div class="project_data">
                    <img style="width: 100px;" src="{{ asset('landing_asset/img/logo.png') }}" alt="logo">
                    <div>
                        <h2 class="project_title">Who we are</h2>
                        <p class="project_description">
                            Want to know more about us?
                        </p>
                    </div>
                    <a href="{{ url('/about') }}" class="button button-white">Click here</a>
                </div>
            </div>
        </section>

    <!-- Porfolio -->
        <section class="portfolio section bd-container" id="portfolio" style="display: none;">
            <div class="portfolio_container bd-grid">
            </div>
        </section>

    <!-- Testimonial -->
        <section class="testimonial section bd-container">
            <span class="section-subtitle">Who we are</span>
            <h2 class="section-title">Partners</h2>

            <div class="testimonial_container swiper-container">
                <div class="swiper-wrapper">
                    <div class="testimonial_content swiper-slide">
                        <img src="{{ asset('landing_asset/img/market.jpg') }}" alt="client" class="testimonial_img">
                        <h3 class="testiminial_title">Store Name</h3>
                        <span class="testimonial_client">Partner</span>
                        <p class="testimonial_description">This store is trusted by the Filipinos, and will surely have what you need.</p>
                    </div>

                    <div class="testimonial_content swiper-slide">
                        <img src="{{ asset('landing_asset/img/market.jpg') }}" alt="client" class="testimonial_img">
                        <h3 class="testiminial_title">Store Name</h3>
                        <span class="testimonial_client">Partner</span>
                        <p class="testimonial_description">This store is trusted by the Filipinos, and will surely have what you need.</p>
                    </div>

                    <div class="testimonial_content swiper-slide">
                        <img src="{{ asset('landing_asset/img/market.jpg') }}" alt="client" class="testimonial_img">
                        <h3 class="testiminial_title">Store Name</h3>
                        <span class="testimonial_client">Partner</span>
                        <p class="testimonial_description">This store is trusted by the Filipinos, and will surely have what you need.</p>
                    </div>
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </section>

    <!-- contact me -->
        <section class="contact section bd-container" id="contact">
            <span class="section-subtitle">For Inquiries</span>
            <h2 class="section-title">Contact us</h2>

            <div class="contact_container bd-grid">
                <div class="contact_content bd-grid">
                    <div class="contact_box">
                        <i class='bx bx-home contact_icon'></i>
                        <h3 class="contact_title">Location</h3>
                        <span class="contact_description">#123 Manila - Philippines </span>
                    </div>

                    <div class="contact_box">
                        <i class='bx bx-phone contact_icon'></i>
                        <h3 class="contact_title">Phone</h3>
                        <span class="contact_description">999-888-777 </span>
                    </div>

                    <div class="contact_box">
                        <i class='bx bx-envelope contact_icon'></i>
                        <h3 class="contact_title">Gmail</h3>
                        <span class="contact_description">john.doe@gmail.com </span>
                    </div>

                    <div class="contact_box">
                        <i class='bx bx-chat contact_icon'></i>
                        <h3 class="contact_title">Chat</h3>
                        <div>
                            <a href="#" class="contact_social"><i class='bx bxl-whatsapp-square'></i></a>
                            <a href="#" class="contact_social"><i class='bx bxl-telegram'></i></a>
                            <a href="#" class="contact_social"><i class='bx bxl-messenger'></i></a>
                        </div>
                    </div>
                </div>
                <!-- <form action="" class="contact_form">
                    <div class="contact_inputs">
                        <input type="text" placeholder="Name" class="contact_input">
                        <input type="email" placeholder="Email" class="contact_input">
                    </div>

                    <div class="contact_inputs">
                        <input type="text" placeholder="Project" class="contact_input">
                        <input type="number" placeholder="Number" class="contact_input">
                    </div>

                    <textarea name="" id="" cols="0" rows="7" placeholder="Message" class="contact_input"></textarea>
                    <input type="submit" value="Send Message" class="button contact_button">
                </form> -->
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