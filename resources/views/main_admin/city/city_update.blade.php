@extends('layouts.main_admin_master')
@section('title')
    LS | City Update
@endsection
@section('content')
    <div class="card shadow mb-4 col-md-5">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-gray">Cities | Update </h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                <form action="/city_update_action/{{ $city->id }}" method="POST">
                    {{ csrf_field() }} 
                    {{ method_field('PUT') }}
                        <div class="row">
                        <div class="col-md-12 pr-1">
                          <div class="form-group">
                            <label>Region Under</label>
                              <select name="region_number" id="region_number" class="form-control" style="appearance: none;">
                                  <option value="{{ $city->region_number }}" selected>{{ $city->region_number }}</option>
                                  @foreach($regions as $row_region)
                                        <option value="{{ $row_region->region_number }}">{{ $row_region->region_name }}</option>
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
                                        <option value="{{ $city->province_name }}" selected>{{ $city->province_name }}</option>
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
                                <label for="city_name" class="col-form-label">City Name</label>
                                <input type="text" class="form-control" id="city_name" name="city_name" value="{{ $city->city_name }}">
                            </div>
                            </div>
                        </div>
                    <button type="submit" class="btn btn-success">Update</button>
                    <a href="/show_cities" class="btn btn-danger">Cancel</a>
                </form>
            </div>
            </div>
        </div>
    </div>
@endsection

{{-- this is what the master.blade.php scripts is calling --}}
@section('scripts')
    
@endsection