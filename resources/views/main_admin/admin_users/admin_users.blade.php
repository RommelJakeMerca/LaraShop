@extends('layouts.main_admin_master')
@section('title')
    LS | Admin Users
@endsection
@section('content')
<div class="row">
    <div class="col-xl-12 col-md-12 mb-12">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Admin Users</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">Admin Users | Main Page</div>
                    </div>
                    <div class="col-auto">
                        <form action="{{ route('search_admin_users') }}" enctype="multipart/form-data" class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        {{ csrf_field() }}
                            <div class="input-group">
                                <input type="text" name="query" class="form-control bg-light border-0 small" placeholder="Search User"
                                    aria-label="Search" aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-success" type="button">
                                        <i class="fas fa-search fa-sm"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br><br>
<div class="row">
        @foreach ($admin_users as $item)
        <div class="col-xl-3 col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-info">{{ $item->username }}</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                            aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item" href="/admin_user_details/{{ $item->id }}">Details</a>
                        </div>
                    </div>
                </div>
                <div class="card-body" style="background: url('/uploads/user_images/{{ $item->user_image }}'); background-size: cover; background-position: center center;">
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