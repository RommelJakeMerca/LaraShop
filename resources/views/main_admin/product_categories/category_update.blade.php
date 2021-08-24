@extends('layouts.main_admin_master')
@section('title')
    LS | Category Update
@endsection
@section('content')
    <div class="card shadow mb-4 col-md-5">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-gray">Categories | Update </h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                <form action="/category_update_action/{{ $category->id }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }} 
                    {{ method_field('PUT') }}
                    <div class="form-group">
                        <label>Click here to choose file</label>
                        <input style="cursor: pointer;" type="file" name="category_image" class="form-control" value="{{ $category->category_image }}">
                        <a style="color: red;" href="/uploads/category_images/{{ $category->category_image }}">View previous image - {{ $category->category_image }}</a>
                    </div>
                    <div class="form-group">
                        <label for="category_name" class="col-form-label">Category Name</label>
                        <input type="text" class="form-control" id="category_name" name="category_name" value="{{ $category->category_name }}">
                    </div>
                    <button type="submit" class="btn btn-success">Update</button>
                    <a href="/show_categories" class="btn btn-danger">Cancel</a>
                </form>
            </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    
@endsection