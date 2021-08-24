@extends('layouts.main_admin_master')
@section('title')
    LS | Regions
@endsection
@section('content')
<link href="{{ asset('admin_assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
<!-- Modal for adding new data -->
   <div class="modal fade col-md-12" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Region</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('add_region') }}" method="POST">
        {{ csrf_field() }}
        <style>
          .form-control {
            color: #333;
          }
        </style>
        <div class="modal-body">
            <div class="row">
              <div class="col-md-5 pr-1">
                <div class="form-group">
                  <label for="region_number" class="col-form-label">Region Number</label>
                  <input type="text" class="form-control" id="region_number" name="region_number">
                </div>
              </div>
              <div class="col-md-7 px-1">
                <div class="form-group">
                  <label for="region_name" class="col-form-label">Region Name</label>
                  <input type="text" class="form-control" id="region_name" name="region_name">
                </div>
              </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success">SAVE</button>
        </div>
        </form>
      </div>
    </div>
  </div>

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
            <input type="hidden" name="id" class="form-control" id="delete_region_id" disabled>
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

   <!-- Page Heading -->
   <h1 class="h3 mb-2 text-gray-800">Regions</h1>
   <p class="mb-4">Here you can add, view, edit, and delete</p>

   <!-- DataTales Example -->
   <div class="card shadow mb-4">
       <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Regions Table </h6>
            <a href="#" class="btn btn-success btn-icon-split float-right" data-toggle="modal" data-target="#exampleModal" >
            <span class="icon text-white-50">
                <i class="fas fa-plus"></i>
            </span>
            <span class="text">Add Region</span>
            </a>
       </div>
       <div class="card-body">
           <div class="table-responsive">
               <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                   <thead>
                       <tr>
                            <th>ID</th>
                            <th>Region Number</th>
                            <th>Region Name</th>
                            <th>Partner Branches</th>
                            <th>Edit</th>
                            <th>Delete</th>
                       </tr>
                   </thead>
                   <tfoot>
                       <tr>
                            <th>ID</th>
                            <th>Region Number</th>
                            <th>Region Name</th>
                            <th>Partner Branches</th>
                            <th>Edit</th>
                            <th>Delete</th>
                       </tr>
                   </tfoot>
                   <tbody>
                    @foreach($regions as $row)
                       <tr>
                           <td>{{ $row->id }}</td>
                           <td>{{ $row->region_number }}</td>
                           <td>{{ $row->region_name }}</td>
                           <td>{{ count($branches->where("region_id", "==", $row->id)) }}</td>
                           <td><a href="/region_update/{{ $row->id }}" class="btn btn-success">EDIT</a></td>
                           <td><a href="javascript:void(0)" class="btn btn-danger deletbtn">DELETE</a></td>
                       </tr>
                    @endforeach
                   </tbody>
               </table>
           </div>
       </div>
   </div>
@endsection

{{-- this is what the master.blade.php scripts is calling --}}
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

          $('#delete_region_id').val(data[0]);
          $('#deleteModalForm').attr('action', '/delete_region/'+data[0]);
          $('#deleteModalPop').modal('show');
        });
    });
  </script>
@endsection