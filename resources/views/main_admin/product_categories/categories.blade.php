@extends('layouts.main_admin_master')
@section('title')
    LS | Product Categories
@endsection
@section('content')
<!-- Modal for adding new data -->
    <div class="modal fade col-md-12" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('add_category') }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <style>
                    .form-control {
                        color: #333;
                    }
                    </style>
                    <div class="modal-body">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="inputGroupFile01" name="category_image">
                            <label class="custom-file-label" for="inputGroupFile01">Category Image</label>
                        </div>
                        <div class="form-group">
                            <label for="category_name" class="col-form-label">Category Name</label>
                            <input type="text" class="form-control" id="category_name" name="category_name">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">SAVE</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<!-- End of Modal for adding data --> 

<!-- Modal For confirm delete -->
<div class="modal fade" id="deleteModalPop" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Confirm Delete</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="deleteModalForm" method="POST">
          {{ csrf_field() }}
          {{ method_field('DELETE') }}
            <div class="modal-body">
                <div class="form-group">
                    <h5>Are you sure you want to delete this record?</h5>
                    <input type="hidden" name="id" class="form-control" id="delete_category_id" disabled>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Confirm Delete</button>
            </div>
        </form>
      </div>
    </div>
</div>
<!-- End of Modal for confirm delete --> 

<div class="row">
    <div class="col-md-8">
      <div class="card card-tasks">
        <div class="card-header ">
          <h5 class="card-category">Category List</h5>
        </div>
        <div class="card-body ">
          <div class="table-full-width table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Category Name</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $row)
                    <tr>
                        
                        <td class="text">{{ $row->id }}</td>
                        <td><img src="/uploads/category_images/{{ $row->category_image }}" style="float: left; width: 250px; height: 100px; object-fit: cover;"></td>
                        <td class="text-left">{{ $row->category_name }}</td>
                        <td class="td-actions text-right" style="display: flex;">
                            <a href="/category_update/{{ $row->id }}" class="btn btn-warning btn-circle">
                                <i class="fas fa-pencil-alt"></i>
                            </a>
                        </td>
                        <td>
                            <a href="javascript:void(0)" class="btn btn-danger btn-circle">
                                <i class="fas fa-trash-alt deletbtn"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-2">
      <div class="card card-tasks">
        <div class="card-header ">
          <h5 class="card-category text-center">Action</h5>
        </div>
        <div class="card-body ">
          <button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModal" style="float: left;">Add Category</button>
        </div>
        </div>
      </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('admin_assets/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script>
        $(document).ready(function() {
        $('#dataTable').DataTable();
        $('#dataTable').on('click', '.deletbtn', function() {
            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function() {
                return $(this).text();
            }).get(); 

            // console.log(data);

            $('#delete_category_id').val(data[0]);
            $('#deleteModalForm').attr('action', '/delete_category/'+data[0]);
            $('#deleteModalPop').modal('show');
            });
        });
    </script>
@endsection