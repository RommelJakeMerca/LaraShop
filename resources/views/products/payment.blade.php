@extends('products.products_index')

@section('titlePage', 'LegaShop | Payment');
@section('content')

<link rel="stylesheet" href="{{asset('products_asset/collection/collection.css')}}">

<!-- BREADCRUM CONTAINER -->
<div class="container breadcrumb-shoppingcart-details">
  <ul class="breadcrumb-items shopping-cart-list">
    <li>SHOPPING CART <i class="fas fa-check"></i></li>
    <li><i class="fas fa-chevron-circle-right"></i></li>
    <li>CHECK OUT <i class="fas fa-check"></i></li>
    <li><i class="fas fa-chevron-circle-right"></i></li>
    <li>PAYMENT <i class="fas fa-check"></i></li>
    <li class="inactive"><i class="fas fa-chevron-circle-right"></i></li>
    <li class="inactive">THANK YOU FOR SHOPPING WITH US!</li>
  </ul>
</div>

<!-- PRODUCT CONTAINER -->
<div class="container payment-details">
  <div class="row payment-container mb-3">
    <div class="col-md-8 payment-col">
      <h5 class="payment-title">PAYMENT</h5>
      @include('products.message')
      <div class="details-container">
        <h4 class="select-payment-title">SELECT PAYMENT METHOD</h4>
        <p class="payment-progress">3 of 4</p>
      <form action="{{route('paypal_call')}}" method="POST">
          @csrf
        <div class="row payment-details-row">
            <div class="form-check">
                <input class="form-check-input shadow-none" type="radio" 
                name="paypalRadio" id="paypalRadio" value="paypal">
                <label class="form-check-label" for="Paypal">
                    Pay securely using your Paypal
                    <p class="paypal-text">Expect An Additional Fee of 5%</p>
                </label>
                <img class="paypal-image"src="{{asset('products_asset/images/payment-images/paypal.png')}}" height="40x" width="150px">
              </div>
        </div>
      </div>
      <div class="checkout-link mb-3 mt-5">
      <a href="{{route('products.checkout')}}">
        <i class="fas fa-angle-double-left"></i>
        BACK TO CHECKOUT
      </a>
      </div>
    </div>
    <div class="col-md-4">
        <div class="order-info-container">
            <div class="checkout-order-summary-container">
                <p class="order-summary">
                    ORDER SUMMARY
                </p>
            </div>
            <table class="table table-bordered checkout-receipt-container">
                <tr>
                    <td width="70%">Sub Total:</td>
                    {{-- <td>SR 419.69</td> --}}
                    <td>&#8369; <b>{{$totalPrice}}.00</b></td>
                </tr>
                <tr>
                    <td width="70%">Rewards Points Total:</td>
                    <td><b>{{$rewardPoints}}</b> PTS</td>
                </tr>  
                </tr>
                    <td width="70%">Total&nbsp;(Inc. Tax PH)</td>
                    {{-- <td class="checkout-total-price">SR 435.35</td> --}}
                    <td class="checkout-total-price">&#8369; {{$totalPrice}}.00</td>
                </tr>
                </tbody>
            </table>
        </div>
          <p class="terms-condition">By confirming your order, 
          you agree to the <a href="#">Terms and Conditions.</a>
          </p>
            <div class="row">
                <button type="submit" class="btn w-100 proceed-to-payment">CONFIRM PAYMENT</button>
            </div>
      </form>
    </div>
  </div>
</div>

<script>
  $('.sidebar-cart').hide(); 
    $('.form-check-label').click((e)=> {
      let radioCheck = $(e.target).closest('.form-check').find('input[type=radio]');
        $(radioCheck).attr('checked', true);

      // if($(radioCheck).is(':checked')) {
      //     $(radioCheck).attr('checked', "");
      // } else {
      //   $(radioCheck).attr('checked', true);
      // }
      //  $('#paypalRadio').attr('checked', true);
    });

</script>



@endsection