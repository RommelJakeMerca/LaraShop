@extends('layouts.main_admin_master')
@section('title')
    LS | Products Details
@endsection
@section('content')
<!-- Modal For confirm delete -->
<div class="modal fade" id="deleteModalPop" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Confirm Delete</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('delete_product') }}" method="POST">
          {{ csrf_field() }}
          {{ method_field('DELETE') }}
            <div class="modal-body">
                <div class="form-group">
                    <h5>Are you sure you want to delete this product?</h5>
                    <input type="hidden" name="id" class="form-control" id="delete_subcategory_id" value="{{ $products->id }}">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-danger">Confirm Delete</button>
            </div>
        </form>
      </div>
    </div>
</div>
<!-- End of Modal for confirm delete --> 

<div class="row">
    <div class="col-xl-9 col-md-9 mb-9">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;" src="/uploads/product_images/{{ $products->product_image }}" alt="...">
                    </div>
                    <div class="col-auto" style="margin-right: 30px;">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Product ID</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $products->id }}</div>
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Product Name</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $products->product_name }}</div>
                        <br><br>

                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Description</div>
                        <div class="h5 mb-0 text-gray-800" style="font-size: 1em;">{{ $products->product_description }}</div>
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Price</div>
                        <div class="h5 mb-0 text-gray-800" style="font-size: 1em;">{{ $products->product_price }}</div>
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Stocks Available</div>
                        @if ($products->stocks > 200)
                            <div class="h5 mb-0 text-gray-800" style="font-size: 1em;">{{ $products->stocks }} - Enough</div>
                        @elseif($products->stocks < 100)
                            <div class="h5 mb-0 text-red-800" style="font-size: 1em; color: red;">{{ $products->stocks }} - Warning</div>
                        @endif

                        

                        <br><br>
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Category</div>
                        <div class="h5 mb-0 text-gray-800" style="font-size: 1em;">{{ $products->category_name }}</div>
                        <hr>
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Subcategory</div>
                        <div class="h5 mb-0 text-gray-800" style="font-size: 1em;">{{ $products->subcategory_name }}</div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-3 mb-3">
        <div class="card border-left-success shadow h-10 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Edit Product</div>
                    </div>
                    <div class="col-auto">
                        <a href="/product_update/{{ $products->id }}" class="btn btn-success" style="float: right; margin-left: 10px;">Edit</a>
                    </div>
                </div>
            </div>
        </div>
        <br>

        <div class="card border-left-danger shadow h-10 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Delete Product</div>
                    </div>
                    <div class="col-auto">
                        <button class="btn btn-danger" data-toggle="modal" data-target="#deleteModalPop"  style="float: right; margin-left: 10px;">Delete</button>
                    </div>
                </div>
            </div>
        </div>
        <br>

        <div class="card border-left-warning shadow h-10 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Return</div>
                    </div>
                    <div class="col-auto">
                        <a href="/show_products" class="btn btn-warning" style="float: right; margin-left: 10px;">Return</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
</div>
@endsection

@section('scripts')
@endsection