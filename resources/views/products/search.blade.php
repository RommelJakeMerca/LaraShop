@extends('products.products_index')

@section('titlePage', 'LegaShop | Search');
@section('content')

<link rel="stylesheet" href="{{asset('products_asset/collection/collection.css')}}">

{{-- JQUERY PLUGIN --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js" 
integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" 
crossorigin="anonymous"></script> 
@endsection