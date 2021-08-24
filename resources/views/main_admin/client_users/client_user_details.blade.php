@extends('layouts.main_admin_master')
@section('title')
    LS | Client Details
@endsection
@section('content')
<div class="row">
    <div class="col-xl-6 col-md-6 mb-6">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-5">
                        <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 15rem;" src="{{ $client->avatar }}" alt="...">
                    </div>
                    <div class="col-auto" style="margin-right: 30px;">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Client ID</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $client->id }}</div>
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Client Name</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $client->name }}</div>
                        <br><br>

                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Client Email</div>
                        <div class="h5 mb-0 text-gray-800" style="font-size: 1em;">{{ $client->email }}</div>
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Gender</div>
                        <div class="h5 mb-0 text-gray-800" style="font-size: 1em;">{{ $client->gender }}</div>
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Contact Number</div>
                        <div class="h5 mb-0 text-gray-800" style="font-size: 1em;">{{ $client->contact_number }}</div>

                        <br><br>
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Provider ID</div>
                        <div class="h5 mb-0 text-gray-800" style="font-size: 1em;">{{ $client->provider_id }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-3 mb-3">
        <div class="card border-left-warning shadow h-10 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Return</div>
                    </div>
                    <div class="col-auto">
                        <a href="/show_client_users" class="btn btn-warning" style="float: right; margin-left: 10px;">&larr; Return</a>
                    </div>
                </div>
            </div>
        </div>
        <br>
    </div>
</div>
@endsection

@section('scripts')
@endsection