@extends('products.products_index')

@section('titlePage', 'LegaShop | Store')
@section('content')

<link rel="stylesheet" href="{{asset('products_asset/css/pre-loader.css')}}">

@if (Auth::id())
<button type="button" class="legashop-spin-btn" data-bs-toggle="modal" 
data-bs-target="#staticModalRoulette">FREE SPIN <i class="fas fa-hand-point-left"></i>
</button>
@endif

<div class="container images-container">
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
      </div>
        <div class="carousel-inner">
          <div class="carousel-item active" data-bs-interval="2000">
            <img src="{{ asset('products_asset/images/slider/grocery-1.jpg') }}" class="d-block w-100">
            <h2 class="caption-title">Stay Home,<br> & Get your daily Need's</h2>
            <p class="caption-text">Start your daily shopping with <b>LegaShop</b></p>
            <a href="#latest-item" class="btn-order">Order Now <span>
            <i class="fas fa-hand-point-right"></i></span></a>
          </div>
          <div class="carousel-item" data-bs-interval="2000">
            <img src="{{ asset('products_asset/images/slider/grocery-2.jpg') }}" class="d-block w-100">
            <h2 class="caption-title">Fast, Free Shipping,<br>Contactless Delivery.</h2>
            <p class="caption-text">Try it now, risk free!</p>
            <a href="#latest-item" class="btn-order">Order Now <span>
            <i class="fas fa-hand-point-right"></i></span></a>
          </div>
          <div class="carousel-item">
            <img src="{{ asset('products_asset/images/slider/grocery-3.jpg') }}" class="d-block w-100">
            <h2 class="caption-title">We are all for you,<br>A range of quality products </h2>
            <p class="caption-text">Start your daily shopping with <b>LegaShop</b></p>
            <a href="#latest-item" class="btn-order">Order Now <span>
            <i class="fas fa-hand-point-right"></i></span></a>
          </div>
        </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
      </div>
    </div>

  <!-- CONTAINER IMAGES CATEGORY -->
  <div class="container mt-5">
    <h1 class="text-center lp"><span>CATEGORIES</span></h1>
      <div class="row pt-3">
        <div class="col-md-4 img-col" data-aos="zoom-in" data-aos-duration="300">
          <img src="{{asset('products_asset/images/categories/rice.jpg')}}" class="d-block w-100">
            <div class="overlay">
              <div class="text">RICE&nbsp;&&nbsp;GRAINS</div>
                <a href="{{route('products.rice_grains')}}">VIEW ITEMS <i class="fas fa-angle-double-right"></i></a>
            </div>
        </div> 
        <div class="col-md-4 img-col" data-aos="zoom-in" data-aos-duration="500">
          <img src="{{asset('products_asset/images/categories/vegetables.jpg')}}" class="d-block w-100">
            <div class="overlay">
              <div class="text">FRUITS & VEGETABLES</div>
                <a href="{{route('products.fruits_vegetables')}}">VIEW ITEMS <i class="fas fa-angle-double-right"></i></a>
            </div>
        </div>
         <div class="col-md-4 img-col" data-aos="zoom-in" data-aos-duration="700">
          <img src="{{asset('products_asset/images/categories/canned-goods.jpg')}}" class="d-block w-100 pharmacy">
            <div class="overlay">
              <div class="text">CANNED&nbsp;GOODS</div>
                <a href="{{route('products.cannedGoods')}}">VIEW ITEMS  <i class="fas fa-angle-double-right"></i></a>
            </div>
        </div>
        <div class="col-md-6 img-col" data-aos="zoom-in" data-aos-duration="900">
          <img src="{{asset('products_asset/images/categories/beverage.jpg')}}" class="d-block w-100">
            <div class="overlay">
              <div class="text-medium">SNACKS & BEVERAGES</div>
                <a class="link-medium" href="{{route('products.snacksBeverages')}}">VIEW ITEMS <i class="fas fa-angle-double-right"></i></a>
            </div>
        </div>
        <div class="col-md-6 img-col" data-aos="zoom-in" data-aos-duration="1000">
          <img src="{{asset('products_asset/images/categories/household.jpg')}}" class="d-block w-100">
            <div class="overlay">
              <div class="text-medium">HOUSEHOLD NEEDS</div>
                <a class="link-medium" href="{{route('products.householdCare')}}">VIEW ITEMS <i class="fas fa-angle-double-right"></i></a>
            </div>
        </div>
      </div>
  </div>

  <!-- LATEST ITEM CATEGORY -->
  <div class="container item-category"> 
    <h1 class="text-center lp" id="latest-item"><span>LATEST PRODUCT</span></h1>
    <div class="row mb-4">
      <div class="col-md-3">
        <div class="card">
          <div class="card-body" data-aos="zoom-in" data-aos-duration="500"
           style="box-shadow: 1px 1px 15px 2px rgba(0,0,0,0.2);border-radius:5px;">
           <img src="{{asset('products_asset/images/categories/fruits.jpg') }}" class="card-img-top">
            <div class="items-info-container">
              <p class="card-title mt-4 mb-3">&#8369; <b>140.00</b></p>
              <p class="card-text">BANANA 1KG</p>
              <a class="addToCart" href="#">ADD TO CART
              <i class="fas fa-cart-plus"></span></i></a>
              <p class="category-name">FRUITS</p>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card">
          <div class="card-body" data-aos="zoom-in" data-aos-duration="500"
           style="box-shadow: 1px 1px 15px 2px rgba(0,0,0,0.2);border-radius:5px;">
           <img src="{{asset('products_asset/images/categories/fruits.jpg')}}" class="card-img-top">
            <div class="items-info-container">
              <p class="card-title mt-4 mb-3">&#8369; <b>140.00</b></p>
              <p class="card-text">BANANA 1KG</p>
              <a class="addToCart" href="#">ADD TO CART
              <i class="fas fa-cart-plus"></span></i></a>
              <p class="category-name">VEGETABLES</p>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card">
          <div class="card-body" data-aos="zoom-in" data-aos-duration="500"
           style="box-shadow: 1px 1px 15px 2px rgba(0,0,0,0.2);border-radius:5px;">
           <img src="{{asset('products_asset/images/categories/fruits.jpg')}}" class="card-img-top">
            <div class="items-info-container">
              <p class="card-title mt-4 mb-3">&#8369; <b>140.00</b></p>
              <p class="card-text">BANANA 1KG</p>
              <a class="addToCart" href="#">ADD TO CART
              <i class="fas fa-cart-plus"></span></i></a>
              <p class="category-name">PHARMACY</p>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card">
          <div class="card-body" data-aos="zoom-in" data-aos-duration="500"
           style="box-shadow: 1px 1px 15px 2px rgba(0,0,0,0.2);border-radius:5px;">
           <img src="{{asset('products_asset/images/categories/fruits.jpg')}}" class="card-img-top">
            <div class="items-info-container">
              <p class="card-title mt-4 mb-3">&#8369; <b>140.00</b></p>
              <p class="card-text">BANANA 1KG</p>
              <a class="addToCart" href="#">ADD TO CART
              <i class="fas fa-cart-plus"></span></i></a>
              <p class="category-name">HOUSEHOLD NEEDS</p>
            </div>
          </div>
        </div>
      </div>
    </div>


    @if (Auth::id())
    <!-- MODAL ROULETTE -->
    <div class="modal fade" id="staticModalRoulette" data-bs-backdrop="static" 
     data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
       <div class="modal-dialog modal-dialog-centered">
         <div class="modal-content" >
           <div class="modal-header roulette-header">
             <h5 class="modal-title roulette-label" id="staticRouletteLabel">Legashop: Wheel Of Fortune</h5>
             <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
           </div>
           <div class="modal-body" style="position:relative;">
              <div class="roulette-container">
                <canvas class="canvasRoulette" id="canvas" width="450" height="450"></canvas>
                  @forelse ($rewardDatas as $rewardData)
                    <input id="spin" type="button" value="SPIN" class="spin" 
                    {{$rewardData->spin_button}} style="color:{{$rewardData->spin_color}};">
                    <audio src="{{asset('products_asset/sound/wheel.mp3')}}" id="myAudio"></audio>
                    <i class="fas fa-gifts reward-points-icon"></i>
                    <p class="spin-text">SPIN THE WHEEL TO EARN MORE REWARD POINTS!</p>
                    <p class="spin-countdown">YOUR NEXT SPIN: 
                    <span id="spin-countdown">{{$rewardData->countdown_timer}}</span></p>
                  @empty
                      <input id="spin" type="button" value="SPIN" class="spin" style="color:#0E67B9;">
                      <audio src="{{asset('products_asset/sound/wheel.mp3')}}" id="myAudio"></audio>
                      <i class="fas fa-gifts reward-points-icon"></i>
                      <p class="spin-text">SPIN THE WHEEL TO EARN MORE REWARD POINTS!</p>
                  @endforelse
              </div>
           </div>
         </div>
       </div>
     </div>
    @endif
   

    <!-- <div class="owl-carousel">
      <div class="col p-1">
        <div class="card">
          <div class="card-body" data-aos="zoom-in" data-aos-duration="500"
           style="box-shadow: 1px 1px 15px 2px rgba(0,0,0,0.2);border-radius:5px;">
           <img src="images/categories/fruits.jpg" class="card-img-top">
            <div class="items-info-container">
              <p class="card-title mt-4 mb-3">&#8369; <b>140.00</b></p>
              <p class="card-text">BANANA 1KG</p>
              <a class="addToCart" href="#">ADD TO CART
              <i class="fas fa-cart-plus"></span></i></a>
              <p class="category-name">HOUSEHOLD NEEDS</p>
            </div>
          </div>
        </div>
      </div>  
      </div> -->
      <!-- <div class="row mb-4 product-list">
        <div class="col-md-3">
          <div class="card">
            <div class="card-body" data-aos="zoom-in" data-aos-duration="500"
             style="box-shadow: 1px 1px 15px 2px rgba(0,0,0,0.2);border-radius:5px;">
             <img src="images/categories/fruits.jpg" class="card-img-top">
              <div class="items-info-container">
                <p class="card-title mt-4 mb-3">&#8369; <b>140.00</b></p>
                <p class="card-text">BANANA 1KG</p>
                <a class="addToCart" href="#">ADD TO CART
                <i class="fas fa-cart-plus"></span></i></a>
                <p class="category-name">FRUITS</p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card">
            <div class="card-body" data-aos="zoom-in" data-aos-duration="500"
             style="box-shadow: 1px 1px 15px 2px rgba(0,0,0,0.2);border-radius:5px;">
             <img src="images/categories/fruits.jpg" class="card-img-top">
              <div class="items-info-container">
                <p class="card-title mt-4 mb-3">&#8369; <b>140.00</b></p>
                <p class="card-text">BANANA 1KG</p>
                <a class="addToCart" href="#">ADD TO CART
                <i class="fas fa-cart-plus"></span></i></a>
                <p class="category-name">FRUITS</p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card">
            <div class="card-body" data-aos="zoom-in" data-aos-duration="500"
             style="box-shadow: 1px 1px 15px 2px rgba(0,0,0,0.2);border-radius:5px;">
             <img src="images/categories/fruits.jpg" class="card-img-top">
              <div class="items-info-container">
                <p class="card-title mt-4 mb-3">&#8369; <b>140.00</b></p>
                <p class="card-text">BANANA 1KG</p>
                <a class="addToCart" href="#">ADD TO CART
                <i class="fas fa-cart-plus"></span></i></a>
                <p class="category-name">FRUITS</p>
              </div>
            </div>
          </div>
        </div>
        <div class="arrow-prev">
            <span><i class="fas fa-chevron-left"></i></span>
        </div>
        
      </div> -->
  </div>

{{-- JQUERY PLUGIN --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js" 
integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" 
crossorigin="anonymous"></script>   


<script>
// PRE LOADER
$(window).on("load",function(){
    $(".loader-wrapper").delay(1000).fadeOut("slow");
    setTimeout(()=> {
      new bootstrap.Modal(document.getElementById('staticModalRoulette'),
      {}).show();
    },1000);
});

 function insertRewards() {
      let formData = $('#formRoulette').serialize();
      $.ajax({
        url:'{{route("insertRewards")}}',
        type:'POST',
        data:formData,
        dataType:'json',
        success:function() {
        }
      });
    }

    function updateRewards() {
      let formData = $('#formUpdateRouletteTime').serialize();
      $.ajax({
        url:'{{route("updateRewards")}}',
        type:'POST',
        data:formData,
        dataType:'json',
        success:function() {  
        }
      });
    }
    
    setInterval(function (){
      updateRewards();
    },5000);
</script>
@endsection