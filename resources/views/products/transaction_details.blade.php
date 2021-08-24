@extends('products.products_index')

@section('titlePage', 'LegaShop | Transaction Details');
@section('content')


<!-- VIEW DETAILS CONTAINER -->
<div class="container transaction-viewDetails">
    <div class="row thankyou-receipt-container mb-3">
      <div class="col-md receipt-col">
          <h5 class="transaction-details-title">TRANSACTION DETAILS</h5>
        <div class="d-flex flex-row-reverse mt-3">
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
                <img class="receipt-logo" style="margin-left:-10px;"
                src="{{asset('products_asset/icon/legashop.png')}}">
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
                  <b>INVOICE NO:</b> 1000001
                </p>
                <p class="invoice-date">
                  <b>INVOICE DATE:</b> JUNE 21, 2021
                </p>
              </div><hr>
              <div class="col-md-6 bill-col">
                <p class="bill-title">BILL TO:</p>
                <p class="bill-name"><b>NAME:</b> Juan Dela Cruz</p>
                <p class="bill-contact"><b>CONTACT NO:</b> 09123456789</p>
                <p class="bill-address"><b>ADDRESS:</b> 280 G. Araneta Avenue, Quezon City</p>
              </div>
              <div class="col-md-6 deliver-col">
                <p class="deliver-title">DELIVERY OR PICK-UP DETAILS</p>
                <p class="deliver-region"><b>REGION:</b> NCR</p>
                <p class="deliver-time"><b>TIME SCHEDULE:</b> 5:00 pm</p>
                <p class="deliver-date"><b>DATE SCHEDULE:</b> June 21, 2021</p>
                <p class="deliver-branch"><b>BRANCH STORE:</b> Puregold España </p>
              </div> 
              <div class="col-md-12 ship-col">
                <p class="ship-title">SHIP TO:</p>
                <p class="ship-name"><b>NAME:</b> Pedro Dela Cruz</p>
                <p class="ship-contact"><b>CONTACT NO:</b> 09123456483</p>
                <p class="ship-relationship"><b>RELATIONSHIP:</b> Brother</p>
              </div>
              <div class="col-md-12 table-responsive mt-3">
                <table class="table table-striped table-products-receipt">
                  <thead>
                    <tr>
                      <th width="50%">PRODUCT NAME</th>
                      <th>PRICE</th>
                      <th>QUANTITY</th>
                      <th>TOTAL</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>Harvester's Thai Jasmine Rice | 25KG</td>
                      <td><b>SR</b> 156.70</td>
                      <td class="receipt-quantity">3</td>
                      <td><b>SR</b> 470.07</td>
                    </tr>
                    <tr>
                      <td>DOÑA MARIA MIPONICA | 25KG</td>
                      <td><b>SR</b> 153.54</td>
                      <td class="receipt-quantity">2</td>
                      <td><b>SR</b> 307.08</td>
                    </tr>
                    <tr>
                      <td>HARVESTER'S SPECIAL DINORADO RICE | 25KG</td>
                      <td><b>SR</b> 106.29</td>
                      <td class="receipt-quantity">4</td>
                      <td><b>SR</b> 425.16</td>
                    </tr>
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
               <p class="receipt-subtotal">SUBTOTAL:<b>SR</b> 1,202.31 </p>
               <p class="receipt-tax">TAX (12%):<b>SR</b> 144.28</p>
               <p class="receipt-total">TOTAL:<b class="bold-total">SR</b> 1,346.59</p>
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

<script>
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

$('#search-bar').hide();
    $('.search-icon').hide();
</script>
@endsection