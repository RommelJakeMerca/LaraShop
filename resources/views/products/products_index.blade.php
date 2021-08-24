<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSS ANIMATION -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <!-- CSS BOOTSTRAP-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x"
    crossorigin="anonymous">

    <!-- CSS STYLESHEET-->
    <link rel="stylesheet" href="{{ asset('products_asset/css/resposive.css')}}">
    <link rel="stylesheet" href="{{ asset('products_asset/css/style.css')}}">
    <link rel="stylesheet" href="{{ asset('products_asset/css/roulette.css')}}">
    <link rel="stylesheet" href="{{asset('products_asset/collection/collection.css')}}">
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>

    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"> -->

    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
     <!-- ICON -->
     <link rel="icon" sizes="114x114" href="{{asset('products_asset/icon/legashop-1.png')}}">
  
    <title>@yield('titlePage')</title>
    </head>

  <body>
    <div class="loader-wrapper">
      <span class="loader"><span class="loader-inner"></span></span>
    </div>

      <!-- FOR MOBILE DEVICES -->
      <button onclick="openSidebar()" class="hamburger"><i class="fas fa-bars"></i></button>  
      <div class="sidebar-navigation" id="sidebar-navigation">
        <header>Categories <button onclick="closeSidebar()" 
                class="close-btn"><i class="fas fa-times"></i></button>
        </header>
        <ul class="sidebar-list">
          <li id="nav-collapse">
            <span>Fruits <i class="fas fa-sort-down"></i></span>
              <ul class="nav-mobile-items">
                <li><a href="#">Apple</a></li>
                <li><a href="#">Banana</a></li>
                <li><a href="#">Cherry</a></li>
                <li><a href="#">Mangoes</a></li>
                <li><a href="#">Oranges</a></li>
              </ul>
          </li>
          <li id="nav-collapse">
            <span>Vegetables <i class="fas fa-sort-down"></i></span>
            <ul class="nav-mobile-items">
              <li><a href="#">Adult Diaper</a></li>
              <li><a href="#">Antiseptics</a></li>
              <li><a href="#">HandFoot Care</a></li>
              <li><a href="#">Health Supplements</a></li>
              <li><a href="#">OTCs</a></li>
              <li><a href="#">Pain Relievers</a></li>
            </ul>
          </li>
          <li class="nav-collapse">
            <span>Pharmacy <i class="fas fa-sort-down"></i></span>
            <ul class="nav-mobile-items">
              <li><a href="#">Adult Diaper</a></li>
              <li><a href="#">Antiseptics</a></li>
              <li><a href="#">HandFoot Care</a></li>
              <li><a href="#">Health Supplements</a></li>
              <li><a href="#">OTCs</a></li>
              <li><a href="#">Pain Relievers</a></li>
            </ul>
          </li>
        <li id="nav-collapse">
          <span>SNACKS & BEVERAGES<i class="fas fa-sort-down"></i></span>
            <ul class="nav-mobile-items">
              <li><a href="#">Canned Frozen Foods</a></li> 
              <li><a href="#">Baking Dessert Items</a></li>
              <li><a href="#">Baking Ingredients</a></li>
              <li><a href="#">Dessert Mixes</a></li>
              <li><a href="#">Frozen Foods</a></li>
              <li><a href="#">Custard Jelly</a></li>
              <li><a href="#">Noodles</a></li>
              <li><a href="#">Instant Noodles</a></li>
            </ul>
        </li>
        <li id="nav-collapse">
          <span>HouseHold Care <i class="fas fa-sort-down"></i></span>
            <ul class="nav-mobile-items">
              <li><a href="#">Adult Diaper</a></li>
              <li><a href="#">Antiseptics</a></li>
              <li><a href="#">HandFoot Care</a></li>
              <li><a href="#">Health Supplements</a></li>
              <li><a href="#">OTCs</a></li>
              <li><a href="#">Pain Relievers</a></li>
            </ul>
        </li>
      </ul>
    </div>

    {{-- SIDEBAR CART --}}
    @include('products.sidebar_cart')

    {{-- PRODUCT HEADER / NAVIGATION --}}
    @include('products.header')

    {{-- PRODUCT / STORE AND  PROFILE CONTENT --}}
    <div class="container content-container" style="height:0px;"> 
      @yield('content')
    </div>

    {{-- ROULETTE WINS TEXT --}}
    <div id="fireworks" class="pyro">
      <div class="before"></div>
        <div class="after" ></div>
          <h3 id="roulette-points">YOU GOT 2 POINTS!</h3>
            <h3 id="roulette-emoji">👏😎🥳😱😍</h3>
    </div>

    <form id="formRoulette" action="{{route('insertRewards')}}" method="POST">
      @csrf
      <input type="hidden" name="rewardpoints" id="roulette-reward-points">
        <input type="hidden" name="roulettetitle" id="daily-roulette-spin">
    </form>

    <form id="formUpdateRouletteTime" action="{{route('updateRewards')}}" method="POST">
      @csrf
    </form>
  

<!-- JQUERY -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" 
integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" 
crossorigin="anonymous"></script>   

{{-- ZOOM PRODUCTS PLUGIN JS --}}
<script src="{{asset('products_asset/js/okzoom.min.js')}}"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script> -->

<!-- ANIMATE JS -->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="{{asset('products_asset/js/animation.js')}}"></script>

{{-- ADD TO CART JS --}}
<script src="{{asset('products_asset/js/cart.js')}}"></script>

{{-- ADD SEARCH JS --}}
{{-- <script src="{{asset('products_asset/js/search.js')}}"></script> --}}

<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" 
integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" 
crossorigin="anonymous"></script>

{{-- ROULETTE JS --}}
<script src="{{asset('products_asset/js/roulette.js')}}"></script>

<!-- DATE PLUGIN -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

{{-- INFINITE SCROLL PLUGIN --}}
<script src="{{asset('products_asset/js/jquery.jscroll.min.js')}}"></script>
<script src="{{asset('products_asset/js/infinite-scroll.js')}}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" 
integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" 
crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
  @if(session('status'))
    swal({
        title: '{{ session('status') }}',
        icon: '{{ session('statuscode') }}',
    });
  @endif

$('#search-bar').keyup(function () {
    var searchProduct = $(this).val();

    var replaceSearchProducts = searchProduct.replace(/\s/g,'');

    console.log(replaceSearchProducts);

  $.ajax({
    type:'GET',
    dataType: 'json',
    data:{'product_name':searchProduct},
    url:'{{route("productsSearch")}}',
    beforeSend: function () {
        $('#preloader-products').show();
        $('.product-container').hide();
    },
    success:function(products) {
      if(searchProduct.length >= 1){
        $('#preloader-products').hide();
          $('.product-container').fadeIn(500); 
            $('.product-container').html(products);
              $('[id=add-cart]').click((event)=> {
                event.preventDefault();
                addToCart();
                quantityValidation();
                incrementButton();
                decrementButton();
              });
       
      } else {
        $('.product-container').html(); 
          $('#preloader-products').hide();   
            $('.product-container').fadeIn(500); 
      }
    } 
  });
});

$('[id=add-cart]').click((event)=> {
    event.preventDefault();
    addToCart();
});

function addToCart() {
  let getDataProductId = $(event.target)
    .closest('.product-col')
    .data('id');

  let getProductImage = $(event.target)
    .closest('.product-col')
    .find('.product-img')
    .attr('src');

  let getSubtringImage = getProductImage
    .substring(getProductImage
    .lastIndexOf('images/')+7);

  let getProductName = $(event.target)
    .closest('.product-col')
    .find('.card-name')
    .text();

  let getProductQuantity = parseInt($(event.target)
    .closest('.product-col')
    .find('#product-quantity-value')
    .val());


  let getProductPrice = parseFloat($(event.target)
    .closest('.product-col')
    .find('#price-product')
    .text());
  
  data = {
    "_token": "{{ csrf_token() }}",
    "product_id": getDataProductId,
    "product_image": getSubtringImage,
    "product_name": getProductName,
    "product_quantity": getProductQuantity,
    "product_price": getProductPrice,
    "product_current_price": getProductPrice,
  }

  // let formCart= $('#formCart').serialize();
  $.ajax({
    url:'{{route("addCart")}}',
    type:'POST',
    data:data,
    dataType:'json',
    success:function(products) {  
        swal({
            icon:'success',
            title:'Success!',
            text:'Product successfully added to your cart',
            timer: 1500,
            button:false,
            className:'swal-back'
        });
    },
    error:function() { 
        window.location.href = '/client_login';
    }       
  });

  $.ajax({
    type:'GET',
    dataType: 'json',
    data: {
        'product_image':getSubtringImage,
        'product_name':getProductName,
        'product_quantity':getProductQuantity,
        'product_price':getProductPrice,
    },
    url:'{{route("showCart")}}',
    success:function(products) {
        $('.cart-sidebar-content').html(products[0]);
        $('.sidebar-cart-total').html(products[1]);
        $('.count-products').html(products[2]);
        let cartTotalValue = $('#cart-total-price').text();
        let cartTotalValueInt = parseInt(cartTotalValue);
        let cartTotalValueWithComma = (cartTotalValueInt).toLocaleString(undefined,
                {minimumFractionDigits:2,maximumFractionDigits: 2});
        $('#cart-total-price').text(cartTotalValueWithComma);
    }   
  });
}

let cartTotalValue = $('#cart-total-price').text();

let cartTotalValueInt = parseInt(cartTotalValue);

let cartTotalValueWithComma = (cartTotalValueInt).toLocaleString(undefined,
        {minimumFractionDigits:2,maximumFractionDigits: 2});

$('#cart-total-price').text(cartTotalValueWithComma);

function quantityValidation() {
  //VALIDATION FOR QUANTITY
  $('.product-quantity-value').bind('keyup paste', function(e){
      this.value = this.value.replace(/[^0-9]/g, '1'); 
  });
}

function incrementButton() {
  //SPECIFIC PRODUCT INCREMENT BUTTON 
  $('[class=plus-product]').click((event)=> {
      let plusQuantity = $(event.target)
                          .closest('.product-col')
                          .find('#product-quantity-value');
      let plusValueQuantity = parseInt(plusQuantity.val());

      if( plusValueQuantity >= 0) {
          plusValueQuantity++;
          parseInt(plusQuantity.val(plusValueQuantity));
          $(event.target).closest('.product-col')
                        .find('.minus-product')
                        .removeAttr('disabled');
    }
  });
}

function decrementButton() {
  //SPECIFIC PRODUCT DECREMENT BUTTON 
  $('[class=minus-product]').click((event)=> {
      let minusQuantity = $(event.target)
                      .closest('.product-col')
                      .find('#product-quantity-value');
      let minusValueQuantity = parseInt(minusQuantity.val());

      if( minusValueQuantity > 1) {
          minusValueQuantity--;
          parseInt(minusQuantity.val(minusValueQuantity));
      } else {
          $(event.target).closest('.product-col')
                        .find('.minus-product')
                        .prop("disabled", true);
    }
  });
}
    </script>
  </body>
</html>

