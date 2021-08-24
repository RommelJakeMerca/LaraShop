@extends('products.products_index')

@section('titlePage', 'LegaShop | Shopping Cart');
@section('content')

<link rel="stylesheet" href="{{asset('products_asset/collection/collection.css')}}">

<!-- BREADCRUM CONTAINER -->
<div class="container breadcrumb-shoppingcart-details">
  <ul class="breadcrumb-items shopping-cart-list">
    <li>SHOPPING CART <i class="fas fa-check"></i></li>
    <li class="inactive"><i class="fas fa-chevron-circle-right"></i></li>
    <li class="inactive">CHECK OUT </li>
    <li class="inactive"><i class="fas fa-chevron-circle-right"></i></li>
    <li class="inactive">PAYMENT</li>
    <li class="inactive"><i class="fas fa-chevron-circle-right"></i></li>
    <li class="inactive">THANK YOU FOR SHOPPING WITH US!</li>
  </ul>
</div>

<!-- PRODUCT CONTAINER -->
<div class="container cart-details">
  <div class="row cart-container">
    <div class="col-md-8 shopping-cart-col">
      <h5 class="cart-title">SHOPPING CART</h5>
      <p class="cart-progress">1 of 4</p>
      <div class="minimum-container">
        <p class="minimum-order">
          There is a minimum order amount of <b style="color:#0E67B9;">&#8369;500</b> is required before checking out.
        </p>
        <button class="close-minimum"><i class="fas fa-times"></i></button>
      </div>
      <div class="table-container table-responsive">
        <table class="table mt-3 table-borderless table-con">
          <thead>
            <tr>
              <th scope="col" style="padding-left:45px;">PRODUCT</th>
              <th scope="col" style="padding-left:60px;">PRODUCT NAME</th>
              <th scope="col">QUANTITY</th>
              <th scope="col" style="padding-left:30px;">PRICE</th>
              <th scope="col">REMOVE</th>
            </tr>
          </thead>
          <tbody class="tbody table-cart">
            @foreach($cartTables as $cartTable)
              <tr class="cartpage">
                <td><img src="{{asset('uploads/product_images/'.$cartTable->product_image)}}"></td>
                <td class="alignment">{{$cartTable->product_name}}<br><b style="font-size:12px;">&#8369;{{$cartTable->product_current_price}}.00</b></td>
                {{-- <form id="formShoppingCartUpdate" action="{{route('updateShoppingCart')}}" method="POST">
                @csrf --}}
                <td class="alignment"><input type="text" name="product_quantity" id="product_quantity" 
                class="td-product-quantity" value="{{$cartTable->product_quantity}}" maxlength="2"></td>
                <td class="alignment"><p class="td-price">&#8369;<b class="price-value">{{$cartTable->product_price}}</b></p></td> 
                <td class="alignment"><button id="delete_product" class="delete-product"><i class="fas fa-minus-circle"></i></button></td>
                <td id="td-product-price"><input type="hidden" name="product_current_price" value="{{$cartTable->product_current_price}}" class="product-current-price"></td>
                <td id="td-product-id"><input type="hidden" name="product_id" value="{{$cartTable->product_id}}" class="product-id"></td>
                {{-- <button>submit</button> --}}
              {{-- </form> --}}
              </tr>
            @endforeach
          </tbody>
        </table>
        <div class="div-empty-cart"></div>
        @if(count($cartTables) == 0)
          <div class="div-empty-cart">
            <center><img class="td-empty-cart" src="{{asset('/products_asset/images/error/empty-cart.png')}}"></center>
            <p class='td-shopping-cart'>YOUR SHOPPING CART IS EMPTY</i></p>
          </div>
        @endif
      </div>
        <div class="shopping-link mb-3 mt-3"><a href="{{route('products.rice_grains')}}">
          <i class="fas fa-angle-double-left"></i>
          CONTINUE SHOPPING</a>
        </div>
    </div>
    <div class="col-md-4">
        <div class="order-summary-container">
          <p class="order-summary">
            ORDER SUMMARY
          </p>
        </div>
        <div class="receipt-container-col">
          <p class="subtotal">Sub Total:</p>
          <p class="receipt-price">&#8369; <b class="receipt-value">{{$totalPrice}}</b></p>
          <p class="vat">Tax:</p>
          <p class="vat-price">&#8369; <b class="vat-value">{{$vatValue}}</b></p>
          <p class="reward">Reward Points:</p>
          <p class="points"><b class="reward-points-number">{{$rewardPoints}}</b> Pts</p>
        </div>
        <div class="order-total-container">
          <p>Order Total:</p>
          <p class="total-price">&#8369; <b class="total-value">{{$totalPrice}}</b></p>
        </div>
        <a href="{{route('products.checkout')}}" class="btn w-100 proceed-to-checkout">
          PROCEED TO CHECKOUT
        </a>
    </div>
  </div>
</div>


{{-- JQUERY PLUGIN --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js" 
integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" 
crossorigin="anonymous">
</script> 



<script>
$('.sidebar-cart').hide();
  $('#search-bar').hide();
    $('.search-icon').hide();
$('.td-product-quantity').change((event)=> {
  let quantityValue = parseInt($(event.target).val());
  let productIdValue = $(event.target).closest('.cartpage').find('.product-id').val();
  let productCurrentPriceValue = $(event.target).closest('.cartpage').find('.product-current-price').val();
  
  dataCart = {
    "_token":"{{csrf_token()}}",
    "product_quantity":quantityValue,
    "product_id":productIdValue,
    "product_current_price":productCurrentPriceValue,
  }

  $.ajax({
    url:'{{route("updateShoppingCart")}}',
    type:'POST',
    data:dataCart,
    dataType:'json',
    success:function(){
      swal({
          icon:'success',
          title:'Success!',
          text:'Successfully Updated!',
          timer: 1500,
          button:false,
          className:'swal-back'
      });
      GetExistingProduct();
    },
  });
});

$('[id=delete_product]').click((event)=> {
  let productIdValue = $(event.target).closest('.cartpage').find('.product-id').val();
  deleteCart = {
          "_token":"{{ csrf_token()}}",
          "product_id":productIdValue
        }
  $.ajax({
    url:'{{route("deleteShoppingCart")}}',
    type:'DELETE',
    data:deleteCart,
    dataType:'json',
    success:function(data){
      swal({
        icon:'success',
        title:'Success!',
        text:'Successfully Deleted!',
        timer: 1500,
        button:false,
        className:'swal-back'
      });
      GetExistingProduct();
    }
  });
});

function GetExistingProduct() {
  $.ajax({
    url:'{{route("showExistingShoppingCart")}}',
    type:'GET',
    dataType:'json',
    success:function(products){
      $('.table-cart').html(products[0]);
      $('.div-empty-cart').html(products[1]);
      $('.count-products').html(products[2]);
      $('.receipt-value').html(products[3]);
      $('.reward-points-number').html(products[4]);
      $('.vat-value').html(products[5]);
      $('.total-value').html(products[3]);
      $('[id=delete_product]').click((event)=> {
        let productIdValue = $(event.target).closest('.cartpage').find('.product-id').val();
        deleteCart = {
          "_token":"{{ csrf_token()}}",
          "product_id":productIdValue
        }
        $.ajax({
          url:'{{route("deleteShoppingCart")}}',
          type:'DELETE',
          data:deleteCart,
          dataType:'json',
          success:function(data){
            swal({
              icon:'success',
              title:'Success!',
              text:'Successfully Deleted!',
              timer: 1500,
              button:false,
              className:'swal-back'
            });
            GetExistingProduct();
          }
        });
      });
      $('.td-product-quantity').change((event)=> {
        let quantityValue = parseInt($(event.target).val());
        let productIdValue = $(event.target).closest('.cartpage').find('.product-id').val();
        let productCurrentPriceValue = $(event.target).closest('.cartpage').find('.product-current-price').val();
        dataCart = {
          "_token":"{{ csrf_token()}}",
          "product_quantity":quantityValue,
          "product_id":productIdValue,
          "product_current_price":productCurrentPriceValue,
        }
        $.ajax({
          url:'{{route("updateShoppingCart")}}',
          type:'POST',
          data:dataCart,
          dataType:'json',
          success:function(){
            swal({
                icon:'success',
                title:'Success!',
                text:'Successfully Updated!',
                timer: 1500,
                button:false,
                className:'swal-back'
            });
            GetExistingProduct();
          },
        });
      });
    }
  });
}

//CLOSE MINIMUM CONTAINER
$('.close-minimum').click(()=> {
  $('.minimum-container').hide();
});
</script>
@endsection