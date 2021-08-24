@extends('products.products_index')

@section('titlePage', 'LegaShop | Checkout');
@section('content')

<link rel="stylesheet" href="{{asset('products_asset/collection/collection.css')}}">

<!-- BREADCRUM CONTAINER -->
<div class="container breadcrumb-shoppingcart-details">
  <ul class="breadcrumb-items shopping-cart-list">
    <li>SHOPPING CART <i class="fas fa-check"></i></li>
    <li><i class="fas fa-chevron-circle-right"></i></li>
    <li>CHECK OUT <i class="fas fa-check"></i></li>
    <li class="inactive"><i class="fas fa-chevron-circle-right"></i></li>
    <li class="inactive">PAYMENT</li>
    <li class="inactive"><i class="fas fa-chevron-circle-right"></i></li>
    <li class="inactive">THANK YOU FOR SHOPPING WITH US!</li>
  </ul>
</div>

<!-- PRODUCT CONTAINER -->
<div class="container checkout-details">
  <div class="row checkout-container mb-3">
    <div class="col-md-8 checkout-col">
      <h5 class="checkout-title">CHECKOUT</h5>
      <div class="details-container">
        <h4 class="personal-title">PERSONAL DETAILS</h4>
        <p class="checkout-progress">2 of 4</p>
        <div class="row personal-details">
            <div class="col-lg-6">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control text-details 
                shadow-none" value="{{$currentUsers->name}}" readonly>
            </div>
            <div class="col-lg-6">
                <label for="contactNumber" class="form-label">Contact Number</label>
                <input type="text" class="form-control text-details 
                shadow-none" value="{{$currentUsers->contact_number}}" readonly>
            </div>
        </div>
        <div class="row personal-address mt-3">
            <div class="col-md">
                <label for="address" class="form-label">Address</label>
                <textarea class="form-control text-details shadow-none" 
                rows="3" readonly>{{$currentUsers->address}}</textarea>
            </div>
        </div>
        @foreach ($beneficiaries as $beneficiary)
        <h4 class="beneficiary-title">BENEFICIARY DETAILS</h4>
        <div class="row beneficiary-details"> 
            <button class="editBeneficiary"  data-bs-toggle="modal" 
            data-bs-target="#editBeneficiaryForm">
                EDIT BENEFICIARY 
            </button>
            <div class="col-lg-4">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control text-details 
                shadow-none" value="{{$beneficiary->beneficiary_name}}" readonly>
            </div>
            <div class="col-lg-4">
                <label for="contactNumber" class="form-label">Relationship</label>
                <input type="text" class="form-control text-details 
                shadow-none" value="{{$beneficiary->relationship}}" readonly>
            </div>
            <div class="col-lg-4">
                <label for="contactNumber" class="form-label">Contact Number</label>
                <input type="text" class="form-control text-details 
                shadow-none" value="{{$beneficiary->phone_number}}" readonly>
            </div>
        </div>
        <h4 class="dop-title">DELIVERY OR PICK-UP DETAILS</h4>
        <div class="row dop-details">
            <div class="col-lg-6">
                <label for="region" class="form-label">Region</label>
                <input type="text" class="form-control text-details 
                shadow-none" value="{{$beneficiary->region_chosen}}" readonly>
            </div>
            <div class="col-lg-6">
                <label for="branchStore" class="form-label">Branch Store</label>
                <input type="text" class="form-control text-details 
                shadow-none" value="{{$beneficiary->selected_branch}}" readonly>
            </div>
        </div>
        <div class="row dop-datetime-details mt-3 mb-3">
            <div class="col-lg-6">
                <label for="region" class="form-label">Date Schedule</label>
                <input type="text" class="form-control text-details 
                shadow-none" value="June 21, 2021" readonly>
            </div>
            <div class="col-lg-6">
                <label for="branchStore" class="form-label">Time Schedule</label>
                <input type="text" class="form-control text-details 
                shadow-none" value="{{$beneficiary->time_of_pickup}}" readonly>
            </div>
        </div>
        @endforeach
      </div>
        <div class="cart-link mb-3 mt-4">
        <a href="{{route('products.shopping-cart')}}">
          <i class="fas fa-angle-double-left"></i>
          BACK TO SHOPPING CART
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
                    {{-- <td>SR 479.44</td> --}}
                    <td>&#8369; <b>{{$totalPrice}}.00</b></td>

                </tr>
                <tr>
                  <td width="70%">Rewards Points Total:</td>
                  <td><b>{{$rewardPoints}}</b> PTS</td>
                </tr>
                </tr>
                    <td width="70%">Total&nbsp;(Inc. Tax PH)</td>
                    {{-- <td class="checkout-total-price">SR 479.44</td> --}}
                    <td class="checkout-total-price">&#8369; {{$totalPrice}}.00</td>
                </tr>   
                </tbody>
            </table>
        </div>
          <p class="terms-condition">By confirming your order, 
          you agree to the <a href="#">Terms and Conditions.</a>
          </p>
          <button class="btn w-100 proceed-to-payment">
              PROCEED TO PAYMENT METHOD
        </button>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade editBeneficiaryForm" id="editBeneficiaryForm" data-bs-backdrop="static" data-bs-keyboard="false" 
    tabindex="-1" aria-labelledby="editBeneficiaryForm" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title w-100 text-center beneficiary-modal-title" id="staticBackdropLabel">
                    EDIT BENEFICIARY FORM
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Email address</label>
                      <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                      <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Password</label>
                      <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                    </div>
                    <button type="submit" class="btn btn-primary mt-3" style="float:right;">
                        Submit
                    </button>
                  </form>
            </div>
      </div>
    </div>
</div>

<script>
$('.sidebar-cart').hide(); 
$('.proceed-to-payment').click(()=> {
    swal({  
        icon:'warning',
        title:'IMPORTANT!',
        text:'PLEASE DOUBLE-CHECK THE INFORMATION BEFORE PROCEED TO THE PAYMENT METHOD. THE STORE WILL NOT ACCEPT RESPONSIBILITY FOR THE INCORRECT INFORMATION.',
        className:'swal-checkout',
        closeOnClickOutside: false,
        buttons: {
        cancel: true,
        confirm: 'PROCEED TO PAYMENT METHOD',
        }
    }).then( isConfirmed => {
        isConfirmed ?  window.location.href = "/products/payment" :  swal.close();
    });
});
</script>
@endsection