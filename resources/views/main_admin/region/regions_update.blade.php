@extends('layouts.main_admin_master')
@section('title')
    LS | Regions Update
@endsection
@section('content')
    <div class="card shadow mb-4 col-md-5">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-gray">Regions | Update </h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                <form action="/region_update_action/{{ $region->id }}" method="POST">
                    {{ csrf_field() }} 
                    {{ method_field('PUT') }}
                    <div class="form-group">
                        <label>Region Number</label>
                        <input type="text" name="region_number" class="form-control text-info" placeholder="Region Number" value="{{ $region->region_number }}">
                    </div>
                    <div class="form-group">
                        <label>Region Name</label>
                        <input type="text" name="region_name"   class="form-control text-info" placeholder="Region Name" value="{{ $region->region_name }}">
                    </div>
                    <button type="submit" class="btn btn-success">Update</button>
                    <a href="/show_regions" class="btn btn-danger">Cancel</a>
                </form>
            </div>
            </div>
        </div>
    </div>
@endsection

{{-- this is what the master.blade.php scripts is calling --}}
@section('scripts')
    
@endsection