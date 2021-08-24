@extends('products.products_index')

@section('titlePage', 'LegaShop | 404 Not Found');
@section('content')



<link rel="stylesheet" href="{{asset('products_asset/collection/collection.css')}}">


<!-- 404 NOT FOUND CONTAINER -->
<div class="container method-not-allowed-container">
    <img src="{{asset('products_asset/images/error/405-error.png')}}">
    <h1>
        Oops!
    </h1>  
    <p>
        The method is not allowed for the request URL.
    </p>
    <a href="{{route('products.store')}}">
        &#8592; Back to Store Page
    </a>
</div>

{{-- JQUERY PLUGIN --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js" 
integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" 
crossorigin="anonymous"></script> 

{{-- SWEEET ALERT PLUGINS --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" 
integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" 
crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    $('#navbar-top').hide();
        $('.navbar-bottom').hide();
</script>
@endsection
