@extends('layouts.main_admin_master')
@section('title')
    LS | Subcategory Update
@endsection
@section('content')
    <div class="card shadow mb-4 col-md-5">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-gray">Subcategory | Update </h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                <form action="/subcategory_update_action/{{ $subcategory->id }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }} 
                    {{ method_field('PUT') }}
                    <div class="form-group">
                        <label>Category</label>
                        <select name="category_id" id="category_id" class="form-control" style="appearance: none;">
                            <option value="{{ $subcategory->category_id }}" disabled selected>{{ $subcategory->category_name }}</option>
                            @foreach($categories as $row_categories)
                                    <option value="{{ $row_categories->id }}">{{ $row_categories->category_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="subcategory_name" class="col-form-label">Subategory Name</label>
                        <input type="text" class="form-control" id="subcategory_name" name="subcategory_name" value="{{ $subcategory->subcategory_name }}">
                    </div>
                    <button type="submit" class="btn btn-success">Update</button>
                    <a href="/show_subcategories" class="btn btn-danger">Cancel</a>
                </form>
            </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    
@endsection