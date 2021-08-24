@extends('layouts.main_admin_master')
@section('title')
    LS | Store Branch Update
@endsection
@section('content')
    <div class="card shadow mb-4 col-md-5">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-gray">Cities | Update </h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                <form action="/branch_update_action/{{ $store_branch->id }}" method="POST">
                    {{ csrf_field() }} 
                    {{ method_field('PUT') }}
                        <div class="row">
                        <div class="col-md-12 pr-1">
                          <div class="form-group">
                            <label>Region Under</label>
                              <select name="region_number" id="region_number" class="form-control" style="appearance: none;">
                                  <option value="{{ $store_branch->region_number }}" selected>{{ $store_branch->region_number }}</option>
                                  @foreach($regions as $row_region)
                                        <option value="{{ $row_region->region_number }}">{{ $row_region->region_number }}</option>
                                  @endforeach
                              </select>
                          </div>
                        </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 pr-1">
                                <div class="form-group">
                                <label>Province Under</label>
                                    <select name="province_name" id="province_name" class="form-control" style="appearance: none;">
                                        <option value="{{ $store_branch->province_under }}" selected>{{ $store_branch->province_under }}</option>
                                        @foreach($provinces as $row_province)
                                            <option value="{{ $row_province->province_name }}">{{ $row_province->province_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 pr-1">
                                <div class="form-group">
                                <label>City Under</label>
                                    <select name="city_name" id="city_name" class="form-control" style="appearance: none;">
                                        <option value="{{ $store_branch->city_under }}" selected>{{ $store_branch->city_under }}</option>
                                        @foreach($cities as $row_cities)
                                            <option value="{{ $row_cities->city_name }}">{{ $row_cities->city_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 pr-1">
                            <div class="form-group">
                                <label for="branch_name" class="col-form-label">Store Branch Name</label>
                                <input type="text" class="form-control" id="branch_name" name="branch_name" value="{{ $store_branch->branch_name }}">
                            </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="message-text" class="col-form-label">Store Address:</label>
                            <textarea class="form-control" id="message-text" name="branch_address">{{ $store_branch->branch_address }}</textarea>
                        </div>
                    <button type="submit" class="btn btn-success">Update</button>
                    <a href="/show_branches" class="btn btn-danger">Cancel</a>
                </form>
            </div>
            </div>
        </div>
    </div>
@endsection

{{-- this is what the master.blade.php scripts is calling --}}
@section('scripts')
    
@endsection