@extends('layouts.main_admin_master')
@section('title')
    LS | Products Search
@endsection
@section('content')
<!-- Content Row -->
<div class="row">
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-12 col-md-12 mb-12">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Products</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">Products | Search Page</div>
                    </div>
                    <div class="col-auto">
                        <a href="/show_products" class="btn btn-warning" style="float: right; margin-left: 10px;">Return</a>
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
@endsection