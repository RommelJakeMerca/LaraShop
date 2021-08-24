@extends('products.products_index')

@section('titlePage', 'LegaShop | Transaction History');
@section('content')

<!-- TRANSACTION CONTAINER -->
<div class="container transaction-container">
    <div class="row">
    @include('products.account_nav')
        <div class="col-md-8 transaction-info table-responsive">
            <h3 class="transaction-history">Transaction History</h3>
            <table class="table mt-3 transaction-table">
                <thead>
                  <tr>
                    <th scope="col">Invoice No.</th>
                    <th scope="col">Transaction Date</th>
                    <th scope="col">Purchase Total</th>
                    <th scope="col">Status</th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>1000001</td>
                    <td>June 21, 2021</td>
                    <td>SR 435.35</td>
                    <td class="completed">Completed</td>
                    <td>
                        <a href="{{route('products.transaction-details')}}"
                        class="view-details">View Details
                        </a> 
                    </td>
                  </tr>
                </tbody>
            </table>
        <div>
    </div>
</div>

{{-- JQUERY PLUGIN --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js" 
integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" 
crossorigin="anonymous"></script>
<script>
  $('#search-bar').hide();
    $('.search-icon').hide();
</script>
@endsection