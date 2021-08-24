@extends('layouts.main_admin_master')
@section('title')
    LS | Order Details
@endsection
@section('content')
<!-- Modal For approval -->
<div class="modal fade" id="approveModalPop" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Approve</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="/approve_order/{{ $order->id }}" method="POST">
          {{ csrf_field() }}
          {{ method_field('PUT') }}
            <div class="modal-body">
                <div class="form-group">
                    <h5>Are you sure you want to approve this order?</h5>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-warning">Approve</button>
            </div>
        </form>
      </div>
    </div>
</div>

<!-- Modal For decline -->
<div class="modal fade" id="declineModalPop" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Decline</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="/decline_order/{{ $order->id }}" method="POST">
          {{ csrf_field() }}
          {{ method_field('PUT') }}
            <div class="modal-body">
                <div class="form-group">
                    <h5>Are you sure you want to decline this order?</h5>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-danger">Decline</button>
            </div>
        </form>
      </div>
    </div>
</div>

<!-- Modal for adding new data -->
<div class="modal fade col-md-12" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Client Info</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="col-xl-12 col-md-12 mb-12">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">User ID</div>
                            <div class="h5 mb-0 text-gray-800">{{ $client->id }}</div>
                            <hr>
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">User Name</div>
                            <div class="h5 mb-0 text-gray-800">{{ $client->name }}</div>
                            <hr>
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">User Email</div>
                            <div class="h5 mb-0 text-gray-800">{{ $client->email }}</div>
                            <hr>
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Gender</div>
                            <div class="h5 mb-0 text-gray-800">{{ $client->gender }}</div>
                            <hr>
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Address</div>
                            <div class="h5 mb-0 text-gray-800">{{ $client->address }}</div>
                            <hr>
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Contact Number</div>
                            <div class="h5 mb-0 text-gray-800">{{ $client->contact_number }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-12 col-md-12 mb-12">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Order ID</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $order->id }}</div>
                    </div>
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Client ID</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $order->client_id }}</div>
                    </div>
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Mode of Payment</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $order->mode_of_payment }}</div>
                    </div>
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $order->total_payment }}</div>
                    </div>
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Status</div>
                        @if ($order->status == "For Approval")
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $order->status }}</div>
                        @elseif ($order->status == "Approved")
                            <div class="h5 mb-0 font-weight-bold text-success">{{ $order->status }}</div>
                        @elseif ($order->status == "Declined")
                            <div class="h5 mb-0 font-weight-bold text-danger">{{ $order->status }}</div>
                        @endif
                    </div>
                    <div class="col-auto">
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModal" style="float: right; margin-left: 10px;">Client Info</button>
                    </div>
                    <div class="col-auto">
                        @if ($order->status == "Approved")
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#declineModalPop" style="float: right; margin-left: 10px;">Decline</button>
                        @else
                            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#approveModalPop" style="display: none; float: right; margin-left: 10px;">Approve</button>
                        @endif
                    </div>
                    <div class="col-auto">
                        @if ($order->status == "Declined")
                            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#approveModalPop" style="float: right; margin-left: 10px;">Approve</button>
                        @else
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#declineModalPop" style="display: none; float: right; margin-left: 10px;">Decline</button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br><br>
<div class="h5 mb-0 font-weight-bold text-gray-800">Order List | Products</div>
<hr>
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