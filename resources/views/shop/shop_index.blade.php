<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- add icon link -->
        <link rel="shortcut icon" href="{{ asset('landing_asset/img/logo.ico') }}" />
        <!--========== BOX ICONS ==========-->
        <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
        <!--========== CSS ==========-->
        <link rel="stylesheet" href="{{ asset('shop_index_assets/css/styles.css') }}">
        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <title>LegaShop - Shop Index</title>
        <!-- jquery -->
	    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js" integrity="sha512-AFwxAkWdvxRd9qhYYp1qbeRZj6/iTNmJ2GFwcxsMOzwwTaRwz2a/2TX225Ebcj3whXte1WGQb38cXE5j7ZQw3g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>	
    </head>
    <body>

        <!--========== SCROLL TOP ==========-->
        <a href="#" class="scrolltop" id="scroll-top">
            <i class='bx bx-chevron-up scrolltop__icon'></i>
        </a>

        <!--========== HEADER ==========-->
        <header class="l-header" id="header">
            <nav class="nav bd-container">
                <a href="#" class="nav__logo">LegaShop - Online Groceries</a>

                <div class="nav__menu" id="nav-menu">
                    <ul class="nav__list">
                        <li class="nav__item"><a href="#" class="nav__link"><img src="{{ $currentUsers->avatar }}" alt="{{ $currentUsers->name }}" style="border: 1px solid #ccc; border-radius: 50px; width: 25px; height: auto; float: left; margin-right: 7px;">{{ $currentUsers->name }}</a></li>
                        <li class="nav__item"><a href="{{ route('client.logout') }}" class="nav__link" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">Logout</a></li>
                        <form id="logout-form" action="{{ route('client.logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                        <li><i class='bx bx-moon change-theme' id="theme-button"></i></li>
                    </ul>
                </div>

                <div class="nav__toggle" id="nav-toggle">
                    <i class='bx bx-menu'></i>
                </div>
            </nav>
        </header>

        <!--========== MENU ==========-->
        <section class="menu section bd-container" id="menu">
            <span class="section-subtitle">First things first</span>
            <h2 class="section-title">Please choose how you want to shop</h2>

            <div class="menu__container bd-grid">
                <div class="menu__content">
                    <img src="{{ asset('shop_index_assets/img/pickup.svg') }}" alt="" class="menu__img">
                    <h3 class="menu__name">Pickup</h3>
                    <span class="menu__detail">Buy groceries for your family and let them be the one to pick it up.</span>
                    <!-- <span class="menu__preci">Charges may apply</span> -->
                    <a href="/beneficiary_info/{{Auth::id()}}" class="button menu__button"><i class='bx bx-cart-alt'></i></a>
                </div>

                <div class="menu__content">
                    <img src="{{ asset('shop_index_assets/img/delivery.svg') }}" alt="" class="menu__img">
                    <h3 class="menu__name">Delivery</h3>
                    <span class="menu__detail">Buy it online and we will deliver it directy at your family's doorstep</span>
                    <!-- <span class="menu__preci">$12.00</span> -->
                    <a href="#" class="button menu__button"><i class='bx bx-cart-alt'></i></a>
                </div>
                
                <div class="menu__content">
                    <img src="{{ asset('shop_index_assets/img/voucher.svg') }}" alt="" class="menu__img">
                    <h3 class="menu__name">Voucher</h3>
                    <span class="menu__detail">Buy your family a voucher worth of your choice, and let them be the one to do the shopping.</span>
                    <!-- <span class="menu__preci">$9.50</span> -->
                    <a href="#" class="button menu__button"><i class='bx bx-cart-alt'></i></a>
                </div>
            </div>
        </section>

        <!-- loader -->
        <div class="loader-wrapper">
            <span class="loader"><span class="loader-inner"></span></span>
        </div>
  
        <!--========== SCROLL REVEAL ==========-->
        <script src="https://unpkg.com/scrollreveal"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAswPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
        <!--========== MAIN JS ==========-->
        <script src="{{ asset('shop_index_assets/js/main.js') }}"></script>
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