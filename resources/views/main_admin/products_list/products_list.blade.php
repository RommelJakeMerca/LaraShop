@extends('layouts.main_admin_master')
@section('title')
    LS | Products
@endsection
@section('content')
<!-- Modal for adding new data -->
<div class="modal fade col-md-12" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('add_products') }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <style>
                .form-control {
                    color: #333;
                }
                </style>
                <div class="modal-body">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="inputGroupFile01" name="product_image">
                        <label class="custom-file-label" for="inputGroupFile01">Product Image</label>
                    </div>
                    <div class="form-group">
                        <label for="product_name" class="col-form-label">Product Name</label>
                        <input type="text" class="form-control" id="product_name" name="product_name" placeholder="Product Name">
                    </div>
                    <div class="row">
                        <div class="col-md-6 pr-1">
                            <div class="form-group">
                                <label>Category under</label>
                                <select name="category_id" id="sel_depart" class="form-control" style="appearance: none;">
                                    <option value="" disabled selected>Select Category</option>
                                    @foreach($categories as $row_categories)
                                        <option value="{{ $row_categories->id }}">{{ $row_categories->category_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 pr-1">
                            <div class="form-group">
                                <label>Subcategory under</label>
                                <select name="subcategory_id" id="sel_emp" class="form-control" style="appearance: none;">
                                    <option value="">Select Subcategory</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 pr-1">
                          <div class="form-group">
                            <label for="product_price" class="col-form-label">Price</label>
                            <input type="number" class="form-control" id="product_price" name="product_price" placeholder="Price">
                          </div>
                        </div>
                        <div class="col-md-6 pr-1">
                            <div class="form-group">
                                <label for="stocks" class="col-form-label">Stocks</label>
                                <input type="number" class="form-control" id="stocks" name="stocks" placeholder="Stocks">
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label">Product Description:</label>
                        <textarea class="form-control" id="message-text" name="product_description"></textarea>
                      </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">SAVE</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-12 col-md-12 mb-12">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Products</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">Products | Main Page</div>
                    </div>
                    <div class="col-auto">
                        <form action="{{ route('search_products') }}" enctype="multipart/form-data" class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        {{ csrf_field() }}
                            <div class="input-group">
                                <input type="text" name="query" class="form-control bg-light border-0 small" placeholder="Search Product"
                                    aria-label="Search" aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-warning" type="button">
                                        <i class="fas fa-search fa-sm"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModal" style="float: right; margin-left: 10px;">Add Product</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br><br>
<div class="row">
        @foreach ($products as $item)
        <div class="col-xl-3 col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-info">{{ $item->product_name }}</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                            aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item" href="/products_details/{{ $item->id }}">Details</a>
                        </div>
                    </div>
                </div>
                <div class="card-body" style="background: url('/uploads/product_images/{{ $item->product_image }}'); background-size: cover; background-position: center center;">
                    {{-- <h1 class="text-info shadow" style="font-size: 3em;">591 <span style="font-size: 1em;">| Products</span></h1> --}}
                    <br><br><br><br>
                    <br><br><br><br>
                    <br><br><br><br>
                    <br><br><br><br>
                </div>
            </div>
        </div>
        @endforeach
</div>
@endsection

@section('scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type='text/javascript'>
    $(document).ready(function(){
       $('#sel_depart').change(function(){
          var id = $(this).val();
          $('#sel_emp').find('option').not(':first').remove();
          // AJAX request 
          $.ajax({
            url: 'getSubcategory/'+id,
            type: 'get',
            dataType: 'json',
            success: function(response){
              var len = 0;
              if(response['data'] != null){
                 len = response['data'].length;
              }
              if(len > 0){
                 // Read data and create <option>
                 for(var i=0; i<len; i++){
   
                    var id = response['data'][i].id;
                    var subcategory_name = response['data'][i].subcategory_name;
   
                    var option = "<option value='"+id+"'>"+subcategory_name+"</option>";
   
                    $("#sel_emp").append(option); 
                 }
              }
            }
          });
       });
    });
</script>

@endsection