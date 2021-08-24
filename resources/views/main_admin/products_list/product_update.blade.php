@extends('layouts.main_admin_master')
@section('title')
    LS | Product Update
@endsection
@section('content')
    <div class="card shadow mb-4 col-md-5">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-gray">Product | Update </h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                <form action="/product_update_action/{{ $products->id }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }} 
                    {{ method_field('PUT') }}
                    <div class="form-group">
                        <label>Click here to choose file</label>
                        <input style="cursor: pointer;" type="file" name="product_image" class="form-control" value="/uploads/product_images/{{ $products->product_image }}">
                        - <a href="/uploads/product_images/{{ $products->product_image }}" class="text-info">Current Image - {{ $products->product_image }}</a>
                    </div>
                    <div class="form-group">
                        <label for="product_name" class="col-form-label">Product Name</label>
                        <input type="text" class="form-control" id="product_name" name="product_name" placeholder="Product Name" value="{{ $products->product_name }}">
                    </div>
                    <div class="row">
                        <div class="col-md-6 pr-1">
                            <div class="form-group">
                                <label>Category under</label>
                                <select name="category_id" id="sel_depart" class="form-control" style="appearance: none;">
                                    <option value="{{ $products->category_id }}" selected>{{ $products->category_name }}</option>
                                    @foreach($categories as $row_categories)
                                        <option value="{{ $row_categories->id }}">{{ $row_categories->category_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 pr-1">
                            <div class="form-group">
                                <label>Subcategory under</label>
                                <select name="subcategory_id" id="sel_depart" class="form-control" style="appearance: none;">
                                    <option value="{{ $products->subcategory_id }}" selected>{{ $products->subcategory_name }}</option>
                                    @foreach($subcategories as $row_subcategories)
                                        <option value="{{ $row_subcategories->id }}">{{ $row_subcategories->subcategory_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 pr-1">
                          <div class="form-group">
                            <label for="product_price" class="col-form-label">Price</label>
                            <input type="number" class="form-control" id="product_price" name="product_price" placeholder="Price" value="{{ $products->product_price }}">
                          </div>
                        </div>
                        <div class="col-md-6 pr-1">
                            <div class="form-group">
                                <label for="stocks" class="col-form-label">Stocks</label>
                                <input type="number" class="form-control" id="stocks" name="stocks" placeholder="Stocks" value="{{ $products->stocks }}">
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label">Product Description:</label>
                        <textarea class="form-control" id="message-text" name="product_description">{{ $products->product_description }}</textarea>
                      </div>
                    <button type="submit" class="btn btn-success">Update</button>
                    <a href="/show_products" class="btn btn-danger">Cancel</a>
                </form>
            </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
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