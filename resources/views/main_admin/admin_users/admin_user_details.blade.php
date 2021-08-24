@extends('layouts.main_admin_master')
@section('title')
    LS | Admin User Details
@endsection
@section('content')
<!-- Modal For confirm delete -->
<div class="modal fade" id="updateModalPop" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Update User Role</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="/update_user_role/{{ $admin_users->id }}" method="POST">
            {{ csrf_field() }} 
            {{ method_field('PUT') }}
            <div class="modal-body">
                <div class="form-group">
                    <label>Update Role</label>
                    <select name="role" id="role" class="form-control" >
                        <option value="" disabled selected>Select Role</option>
                        @foreach ($data['roles'] as $roles)
                            <option value="{{ $roles->id }}">{{ $roles->name }}</option>
                        @endforeach
                    </select>
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
<!-- End of Modal for confirm delete --> 

<div class="row">
    <div class="col-xl-9 col-md-9 mb-9">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;" src="/uploads/user_images/{{ $admin_users->user_image }}" alt="...">
                    </div>
                    <div class="col-auto" style="margin-right: 30px;">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">User ID</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $admin_users->id }}</div>
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">User Name</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $admin_users->username }}</div>
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Email</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $admin_users->email }}</div>
                        <br><br>

                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Full Name</div>
                        <div class="h5 mb-0 text-gray-800" style="font-size: 1em;">{{ $admin_users->first_name }} 
                            {{ $admin_users->middle_name }} {{ $admin_users->last_name }}</div> 
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Age</div>
                        <div class="h5 mb-0 text-gray-800" style="font-size: 1em;">{{ $admin_users->age }}</div>
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Address</div>
                        <div class="h5 mb-0 text-gray-800" style="font-size: 1em;">{{ $admin_users->address }}</div>

                        

                        <br><br>
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Position</div>
                        <div class="h5 mb-0 text-gray-800" style="font-size: 1em;">{{ $admin_users->position }}</div>
                        <hr>
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Role</div>
                        <div class="h5 mb-0 text-gray-800" style="font-size: 1em;">{{ $role->name }}</div>

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
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Update Role</div>
                    </div>
                    <div class="col-auto">
                        <button class="btn btn-success" data-toggle="modal" data-target="#updateModalPop"  style="float: right; margin-left: 10px;">Role</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
</div>
@endsection

@section('scripts')
@endsection