@extends('products.products_index')

@section('titlePage', 'LegaShop | Product Details');
@section('content')

<link rel="stylesheet" href="{{asset('products_asset/collection/collection.css')}}">

 <!-- BREADCRUM CONTAINER -->
<div class="container breadcrumb-container-details">
  <ul class="breadcrumb-items">
    <li class="previous-link"><a href="{{route('products.store')}}">STORE</a></li>
    <li><i class="fas fa-chevron-right"></i></li>
    <li class="previous-link"><a href="{{url()->previous()}}"> {{$productsDetails->category_name}}</a></li>
    <li><i class="fas fa-chevron-right"></i></li>
    <li>PRODUCT DETAILS</li>
  </ul>
</div>

<!-- PRODUCT CONTAINER -->
<div class="container product-details">
    <div class="row product-details-container">
        <div class="col-md-4 product-details-col">
            <img class="border zoom-product" id="zoom-product"
            src="{{asset('uploads/product_images/'.$productsDetails->product_image)}}">
        </div>
        <div class="col-md-7 product-details-col" data-id="{{$productsDetails->id}}">
            <div class="product-info-container">
                <p class="product-text">{{$productsDetails->product_name}}</p>
                <button class="share-link"><i class="fas fa-share-alt"></i> SHARE</button>
            </div>
            <p class="product-price">&#8369; <b id="product-price">{{$productsDetails->product_price}}.00</b></p>
            <p class="border-bottom product-category-name">CATEGORY: {{$productsDetails->category_name}} </p>
            <div class="d-flex mt-4">
                <p class="quantity">Quantity</p>
                <button class="minus"><i class="fas fa-minus"></i></button>
                <input type="text" name="" id="product-quantity-value"
                class="quantity-value"value="1" maxlength="2">
                <button class="plus"><i class="fas fa-plus"></i></button>
            </div>
            <div class="d-flex mt-3">
                <button class="add-cart" id="add-cart">ADD TO CART</button>
                <button class="buy-now">BUY NOW </button>
            </div>
            <div class="description-container mt-2 d-flex">
                <p class="description-title border">DESCRIPTION</p>
                <p class="description-text border">
                    {{$productsDetails->product_description}}
                </p>
            </div>
        </div>
    </div>  
</div>

{{-- JQUERY PLUGIN --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js" 
integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" 
crossorigin="anonymous"></script>

{{-- SWEEET ALERT PLUGINS --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" 
integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" 
crossorigin="anonymous" referrerpolicy="no-referrer"></script>

{{-- PRODUCT DETAILS JS --}}
<script src="{{asset('products_asset/js/product-details.js')}}"></script>
@endsection