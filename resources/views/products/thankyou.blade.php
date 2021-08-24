@extends('products.products_index')

@section('titlePage', 'LegaShop | Thank you for shopping with us');
@section('content')

<link rel="stylesheet" href="{{asset('products_asset/collection/collection.css')}}">
{{-- <link rel="stylesheet" href="{{asset('products_asset/css/pre-loader.css')}}"> --}}

<!-- BREADCRUM CONTAINER -->
<div class="container breadcrumb-shoppingcart-details">
  <ul class="breadcrumb-items shopping-cart-list">
    <li>SHOPPING CART <i class="fas fa-check"></i></li>
    <li><i class="fas fa-chevron-circle-right"></i></li>
    <li>CHECK OUT <i class="fas fa-check"></i></li>
    <li><i class="fas fa-chevron-circle-right"></i></li>
    <li>PAYMENT <i class="fas fa-check"></i></li>
    <li><i class="fas fa-chevron-circle-right"></i></li>
    <li>THANK YOU FOR SHOPPING WITH US! <i class="fas fa-check"></i></li>
  </ul>
</div>

<!-- RECEIPT CONTAINER -->
<div class="container receipt-details">
  <div class="row thankyou-receipt-container mb-3" >
    <div class="col-md receipt-col">
      <p class="text-end receipt-progress">4 of 4</p>
      <div class="d-flex flex-row-reverse">
        <button class="screenshot" id="screenshot">
          Take Screenshot
        </button>
        <button class="print" id="printPDF">
          Download as PDF
        </button>
      </div>
      <div class="details-container mt-3">
          <div class="row row-receipt" id="receipt-content">
            <div class="col-md-4">
              <img class="receipt-logo" src="{{asset('products_asset/icon/legashop.png')}}">
            </div>
            <div class="col-md-4">
              <p class="thankyou-title">
                THANK YOU FOR SHOPPING WITH US!
              </p>
              <p class="receipt-address">
                2nd Floor Office 17 Eldrees Building
                Malaz Siteen Riyadh, Saudi Arabia
              </p>
              <p class="receipt-email">
                info@ourlegacyglobal.com
              </p>
              <p class="receipt-contact">
                (966) 11 2033378
              </p>
            </div>
            <div class="col-md-4">
              <p class="invoice-title">
                INVOICE
              </p>
              <p class="invoice-number">
                <b>INVOICE NO:</b> {{$clientOrder->id}}
              </p>
              <p class="invoice-date">
                <b>INVOICE DATE:</b> {{$clientOrder->created_at->format('F, d Y')}}
              </p>
            </div><hr>
            <div class="col-md-6 bill-col">
              <p class="bill-title">BILL TO:</p>
              <p class="bill-name"><b>NAME:</b> {{$currentUsers->name}}</p>
              <p class="bill-contact"><b>CONTACT NO:</b> {{$currentUsers->contact_number}}</p>
              <p class="bill-address"><b>ADDRESS:</b> {{$currentUsers->address}}</p>
            </div>
          @foreach ($beneficiaries as $beneficiary)
            <div class="col-md-6 deliver-col">
              <p class="deliver-title">DELIVERY OR PICK-UP DETAILS</p>
              <p class="deliver-region"><b>REGION:</b>{{$beneficiary->region_chosen}}</p>
              <p class="deliver-time"><b>TIME SCHEDULE:</b> {{$beneficiary->time_of_pickup}}</p>
              <p class="deliver-date"><b>DATE SCHEDULE:</b> June 21, 2021</p>
              <p class="deliver-branch"><b>BRANCH STORE:</b> {{$beneficiary->selected_branch}} </p>
            </div> 
            <div class="col-md-12 ship-col">
              <p class="ship-title">SHIP TO:</p>
              <p class="ship-name"><b>NAME:</b> {{$beneficiary->beneficiary_name}}</p>
              <p class="ship-contact"><b>CONTACT NO:</b> {{$beneficiary->phone_number}}</p>
              <p class="ship-relationship"><b>RELATIONSHIP:</b> {{$beneficiary->relationship}}</p>
            </div>
          @endforeach
            <div class="col-md-12 table-responsive mt-3">
              <table class="table table-striped table-products-receipt">
                <thead>
                  <tr>
                    <th class="receipt-table-name">PRODUCT NAME</th>
                    <th class="receipt-table-price">PRICE</th>
                    <th class="receipt-table-quantity">QUANTITY</th>
                    <th class=receipt-table-total>TOTAL</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($paidProducts as $paidProduct)
                  <tr class="table-products-list">
                    <td>{{$paidProduct->product_name}}</td>
                    <td><b>&#8369;</b> {{$paidProduct->product_current_price}}</td>
                    <td class="receipt-quantity">{{$paidProduct->product_quantity}}</td>
                    <td><b>&#8369;</b> {{$paidProduct->product_price}}</td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <div class="col-md-9 mt-4">
              <p>NOTES:</p>
              <p class="notes-text">
                Please save or keep this file for your reference<br>
                For any further questions do not hesitate to contact us.
              </p>
            </div>
            <div class="col-md-3 mt-4 total-container">
             <p class="receipt-subtotal">SUBTOTAL:<b>&#8369;</b> {{$clientOrder->total_payment}}</p>
             <p class="receipt-tax">TAX (12%):<b>&#8369;</b> {{$vatValue}}</p>
             <p class="receipt-total">TOTAL:<b class="bold-total">&#8369;</b> {{$clientOrder->total_payment}}</p>
            </div><hr>
            <div class="col-md-12 legashop-invoice">
              <img class="invoice-logo" src="{{asset('products_asset/icon/legashop.png')}}">
              <p class="legashop-invoice-text">Invoice Powered By LegaShop</p>
              </div>
          </div>
        </div>
    </div>
  </div>
</div>

{{-- JQUERY PLUGIN --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js" 
integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" 
crossorigin="anonymous"></script>

<!-- PRINT PDF JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.js"></script>
 
<!-- SCREENSHOT JS -->
<script src="{{asset('products_asset/js/html2canvas.min.js')}}"></script>

{{-- SWEEET ALERT PLUGINS --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" 
integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" 
crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
$('.sidebar-cart').hide();
  $('#search-bar').hide();
    $('.search-icon').hide();

// PRE LOADER
$(window).on("load",function(){
    $(".loader-wrapper").delay(1000).fadeOut("slow");
    setTimeout(()=> {
      new bootstrap.Modal(document.getElementById('staticModalRoulette'),
      {}).show();
    },1000);
});


//JAVASCRIPT - PRINT INVOICE CONTENT
//GETTING THE ID BUTTON
document.getElementById('printPDF')
.addEventListener('click', () =>{
    //GETTING THE DIV OR CONTAINER CONTENT 
    var invoice = document.getElementById('receipt-content');
    //FOR CUSTOMIZE THE DESIGN OF YOUR PDF PAGE AND FILE NAME
    var opt = {
          margin:0.3,
          filename:'invoicelegashop.pdf',
          jsPDF:{ unit: 'in', format: 'letter', orientation: 'landscape' }
        };
    //PRINT PDF FILE
    html2pdf().set(opt).from(invoice).save();
});

//JAVASCRIPT - SCREENSHOT INVOICE CONTENT
//GETTING THE ID BUTTON
document.getElementById('screenshot')
.addEventListener('click', () => {
  //GETTING THE DIV OR CONTAINER CONTENT 
  html2canvas(document.querySelector("#receipt-content"))
    //PROMISE OBJECT
    .then(canvas => {
    //DISPLAY AN IMAGE TO ANOTHER PAGE
    window.open().document.write('<img style="margin:70px 0 0 300px;"src="'
    + canvas.toDataURL() + '" />');
  });
});

@if (session('status'))
    swal({
        title: '{{ session('status') }}',
        icon: '{{ session('statuscode') }}',
});
@endif
</script>
@endsection

