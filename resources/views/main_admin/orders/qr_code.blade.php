@extends('layouts.main_admin_master')
@section('title')
    LS | Approved Order 
@endsection
@section('content')

<div class="row">
    <div class="col-xl-7 col-md-7 mb-7">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2 text-center">
                        {{ $qr_code }}
                    </div>
                    <div class="col-auto" style="">
                        <div class="text-lg font-weight-bold text-info text-uppercase mb-1"><span class="text-m font-weight-bold text-success text-uppercase mb-1">Order Approved!<br><hr></span>QR Code Generated</div>
                        <div class="text-xs font-weight-bold text-danger">*this auto generated QR Code contains the order info</div>
                        <div class="text-xs font-weight-bold text-success">This will serve as a proof of identity and purchase <br> for the client and the clien'ts family</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-3 mb-3">
        @if ($order->email_status == "Not Sent")
            <div class="card border-left-success shadow h-10 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Send Email</div>
                        </div>
                        <div class="col-auto">
                            <a href="/sendQREmail/{{ $order->id }}" class="btn btn-success" style="float: right; margin-left: 10px;">Send</a>
                        </div>
                    </div>
                </div>
            </div>
            <br>
        @else 
            <div class="card border-left-success shadow h-10 py-2" style="display: none;">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Send Email</div>
                        </div>
                        <div class="col-auto">
                            <a href="/sendQREmail/{{ $order->id }}" class="btn btn-success" style="float: right; margin-left: 10px;">Send</a>
                        </div>
                    </div>
                </div>
            </div>
            <br>
        @endif

        <div class="card border-left-warning shadow h-10 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Return</div>
                    </div>
                    <div class="col-auto">
                        <a href="/show_approved_orders" class="btn btn-warning" style="float: right; margin-left: 10px;">Return</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
</div>
@endsection

@section('scripts')
@endsection