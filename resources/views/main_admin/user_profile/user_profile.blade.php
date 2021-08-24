@extends('layouts.main_admin_master')
@section('title')
    LS | User Profile
@endsection
@section('content')
<!-- Modal For update user image -->
<div class="modal fade" id="imageModalPop" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Update User Image</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('user_image_update') }}"  method="POST" enctype="multipart/form-data">
          {{ csrf_field() }}
          {{ method_field('PUT') }}
            <div class="modal-body">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="inputGroupFile01" name="user_image">
                    <label class="custom-file-label" for="inputGroupFile01">User Image</label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-warning">Update</button>
            </div>
        </form>
      </div>
    </div>
</div>
<!-- End of Modal for update user image --> 

<!-- Modal For update user details -->
<div class="modal fade" id="detailsModalPop" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Update User Details</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('user_details_update') }}"  method="POST" enctype="multipart/form-data">
          {{ csrf_field() }}
          {{ method_field('PUT') }}
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-5 pr-1">
                        <div class="form-group">
                            <label for="first_name" class="col-form-label">First Name</label>
                            <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name">
                        </div>
                    </div>
                    <div class="col-md-3 pr-1">
                        <div class="form-group">
                            <label for="middle_name" class="col-form-label">Middle Name</label>
                            <input type="text" class="form-control" id="middle_name" name="middle_name" placeholder="Middle Name">
                        </div>
                    </div>
                    <div class="col-md-4 pr-1">
                        <div class="form-group">
                            <label for="last_name" class="col-form-label">Last Name</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="address" class="col-form-label">Address</label>
                    <input type="text" class="form-control" id="address" name="address" placeholder="Address">
                </div>
                <div class="row">
                    <div class="col-md-6 pr-1">
                        <div class="form-group">
                            <label for="position" class="col-form-label">Position</label>
                            <input type="text" class="form-control" id="position" name="position" placeholder="Position">
                        </div>
                    </div>
                    <div class="col-md-6 pr-1">
                        <div class="form-group">
                            <label for="age" class="col-form-label">Age</label>
                            <input type="text" class="form-control" id="age" name="age" placeholder="Age">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-success">Update</button>
            </div>
        </form>
      </div>
    </div>
</div>
<!-- End of Modal for update user details --> 

<div class="row">
    <div class="col-xl-12 col-md-12 mb-12">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">User Profile</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $currentUser->username }}</div>
                    </div>
                    <div class="col-auto">
                        <div class="h5 mb-0 font-weight-bold text-success">
                            @foreach($currentUser->roles as $roles)
                                {{ $roles->name }}
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br><br>

<div class="row">
    <div class="col-xl-4 col-md-4 mb-5">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem; border-radius: 100%;" src="/uploads/user_images/{{ $currentUser->user_image }}" alt="...">
                    </div>
                </div>
                <div class="col-auto">
                    <div class="text-m text-center font-weight-bold text-info text-uppercase mb-1">{{ $currentUser->email }}</div>
                    <div class="text-xs text-center font-weight-bold text-warning text-uppercase mb-1">
                        @foreach($currentUser->roles as $roles)
                            {{ $roles->name }}
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-5 col-md-5 mb-5">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">User ID</div>
                    <div class="text text-success text-uppercase mb-1">{{ $currentUser->id }}</div>
                    <hr>
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Full Name</div>
                        <div class="text text-success mb-1">
                            @if ($currentUser->first_name == "" && $currentUser->middle_name == "" && $currentUser->last_name == "")
                                Your Name goes here
                            @else
                                {{ $currentUser->first_name }} {{ $currentUser->middle_name }} {{ $currentUser->last_name }}
                            @endif
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Address</div>
                        <div class="text-m text-success mb-1">
                            @if ($currentUser->address == "")
                                Your Address goes here
                            @else
                                {{ $currentUser->address }}
                            @endif
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Age</div>
                        <div class="text-m text-success mb-1">
                            @if ($currentUser->age == "")
                                Your Age goes here
                            @else
                                {{ $currentUser->age }} years old
                            @endif
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Position</div>
                        <div class="text-m text-success mb-1">
                            @if ($currentUser->age == "")
                                Your Position goes here
                            @else
                                {{ $currentUser->position }}
                            @endif
                        </div>
                    </div>
                </div>
                <hr>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-3 mb-3">
        <div class="card border-left-success shadow h-10 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Update Profile Details</div>
                    </div>
                    <div class="col-auto">
                        <button class="btn btn-success" data-toggle="modal" data-target="#detailsModalPop"  style="float: right; margin-left: 10px;">Details</button>
                    </div>
                </div>
            </div>
        </div>
        <br>

        <div class="card border-left-warning shadow h-10 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Update Profile Picture</div>
                    </div>
                    <div class="col-auto">
                        <button class="btn btn-warning" data-toggle="modal" data-target="#imageModalPop"  style="float: right; margin-left: 10px;">Image</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
</div>
@endsection

@section('scripts')
@endsection