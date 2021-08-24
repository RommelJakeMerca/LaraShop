@extends('products.products_index')

@section('titlePage', 'LegaShop | Profile Settings');
@section('content')

{{-- <link rel="stylesheet" href="{{asset('products_asset/css/pre-loader.css')}}"> --}}

<!-- MYACCOUNT CONTAINER -->
<div class="container transaction-container">
<div class="row">
@include('products.account_nav')
<div class="col-md-8 myAccount-info">
    @include('products.message')
    <h3 class="myAccount-title">My Account</h3>
        <form class="form-myAccount mt-3" id="myAccountForm"  action="{{route('customerUpdate')}}" method="POST">
            @csrf
            <h5 class="myAccount-details-title">Personal Details</h5>
            <div class="row myAccount-details ">
                <div class="col-lg-6">
                    <label for="name" class="form-label">Firstname</label>
                    <input type="text" class="form-control myAccount-text-details 
                    shadow-none" value="{{$currentUsers->name}}" name="name">
                </div>
                <div class="col-lg-6 con-name">
                    <label for="name" class="form-label">Contact Number</label>
                    <img src="{{asset('products_asset/customer/images/saudi-flag.png')}}" class="img-sa">
                    <input type="text" class="form-control myAccount-text-details con-text
                    shadow-none" value="0513246798" name="contact_number" placeholder="e.g 0513246798">
                </div>
            </div>
            <div class="row myAccount-details mt-3">
                <div class="col-lg-6">
                    <label for="gender" class="form-label">Gender</label>
                    <select class="form-select myAccount-text-details shadow-none" name="gender">
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                    </select>
                </div>
                <div class="col-lg-6">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" class="form-control myAccount-text-details shadow-none"
                    id="emailAddress" value="{{$currentUsers->email}}" readonly name="emailaddress">
                </div>
            </div>
            <div class="row personal-address mt-3">
                <div class="col-lg-12">
                    <label for="address" class="form-label">Complete Address</label>
                    <textarea name="address" class="form-control myAccount-text-details myAccount-address shadow-none" 
                    name="address" rows="3">204 Alamal Plaza Hail StreetPO Box 6659 Jeddah 21452 Saudi Arabia</textarea>
                </div>
            </div>
            <div class="g-recaptcha mt-3 d-flex flex-row-reverse"
                data-sitekey="6LdwZl0bAAAAAKHzzNTNL8Ps8_iTvbNsLJ4BjjPF">
            </div>
            <div class="row personal-address mt-4">
                <div class="col-lg">
                    <button class="w-50 saveChanges-btn" type="submit">
                    SAVE CHANGES
                    </button>
                </div>
            </div>
        </form>
    <div>
</div>
</div>


<!-- GOOGLE RECAPTCHA API -->
<script src="https://www.google.com/recaptcha/api.js" async defer></script>

{{-- JQUERY PLUGIN --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js" 
integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" 
crossorigin="anonymous"></script>

{{-- SWEEET ALERT PLUGINS --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" 
integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" 
crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    // PRE LOADER
    // $(window).on("load",function(){
    //     $(".loader-wrapper").delay(1000).fadeOut("slow");
    // });
@if(session('success'))
    swal({
        icon:'success',
        title:'Success!',
        text:'{{session('success')}}',
        timer: 5000,
        className:'swal-back'
    });
@endif

$('#search-bar').hide();
    $('.search-icon').hide();
</script>
@endsection