@extends('layouts.main_admin_master')
@section('title')
    LS | Store Branches
@endsection
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <link href="{{ asset('admin_assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
<!-- Modal for adding new data -->
   <div class="modal fade col-md-12" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Store Branch</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('add_store_branch') }}" method="POST">
        {{ csrf_field() }}
        <style>
          .form-control {
            color: #333;
          }
        </style>
        <div class="modal-body">
            <div class="row">
              <div class="col-md-12 pr-1">
                <div class="form-group">
                  <label>Region Under</label>
                    <select name="region_number" id="sel_depart" class="form-control" style="appearance: none;">
                        <option value="" disabled selected>Select Region Number</option>
                        @foreach($regions as $row_region)
                              <option value="{{ $row_region->id }}">{{ $row_region->region_name }}</option>
                        @endforeach
                    </select>
                </div>
              </div>
            </div>
            <div class="row">
                <div class="col-md-12 pr-1">
                  <div class="form-group">
                    <label>Province Under</label>
                      <select name="province_name" id="sel_emp" class="form-control" style="appearance: none;">
                          <option value="">Select Province</option>
                      </select>
                  </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 pr-1">
                  <div class="form-group">
                    <label>City Under</label>
                      <select name="city_name" id="sel_emp1" class="form-control" style="appearance: none;">
                          <option value="">Select City</option>
                      </select>
                  </div>
                </div>
            </div>
            <div class="row">
              <div class="col-md-12 pr-1">
                <div class="form-group">
                  <label for="city_name" class="col-form-label">Branch Name</label>
                  <input type="text" class="form-control" id="branch_name" name="branch_name" placeholder="Branch Name">
                </div>
              </div>
            </div>
            <div class="mb-3">
              <label for="message-text" class="col-form-label">Store Address:</label>
              <textarea class="form-control" id="message-text" name="branch_address"></textarea>
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
            <input type="hidden" name="id" class="form-control" id="delete_branch_id" disabled>
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
   <h1 class="h3 mb-2 text-gray-800">Store Branches</h1>
   <p class="mb-4">Here you can add, view, edit, and delete</p>

   <!-- DataTales Example -->
   <div class="card shadow mb-4">
       <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Store Branches Table Table </h6>
            <a href="#" class="btn btn-success btn-icon-split float-right" data-toggle="modal" data-target="#exampleModal" >
            <span class="icon text-white-50">
                <i class="fas fa-plus"></i>
            </span>
            <span class="text">Add Store Branch</span>
            </a>
       </div>
       <div class="card-body">
           <div class="table-responsive">
               <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                   <thead>
                       <tr>
                            <th>ID</th>
                            <th>CiID</th>
                            <th>ProvID</th>
                            <th>RegID</th>
                            <th>Region</th>
                            <th>Province</th>
                            <th>City</th>
                            <th>Branch</th>
                            <th>Address</th>
                            <th>Edit</th>
                            <th>Delete</th>
                       </tr>
                   </thead>
                   <tfoot>
                       <tr>
                            <th>ID</th>
                            <th>CiID</th>
                            <th>ProvID</th>
                            <th>RegID</th>
                            <th>Region</th>
                            <th>Province</th>
                            <th>City</th>
                            <th>Branch</th>
                            <th>Address</th>
                            <th>Edit</th>
                            <th>Delete</th>
                       </tr>
                   </tfoot>
                   <tbody>
                    @foreach($stores as $row)
                       <tr>
                           <td>{{ $row->id }}</td>
                           <td>{{ $row->city_id }}</td>
                           <td>{{ $row->province_id }}</td>
                           <td>{{ $row->region_id }}</td>
                           <td>{{ $row->region_number }}</td>
                           <td>{{ $row->province_under }}</td>
                           <td>{{ $row->city_under }}</td>
                           <td>{{ $row->branch_name }}</td>
                           <td>{{ $row->branch_address }}</td>
                           <td><a href="/branch_update/{{ $row->id }}" class="btn btn-success">EDIT</a></td>
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
<script type='text/javascript'>
$(document).ready(function(){
    // Department Change
    $('#sel_depart').change(function(){
       // Department id
       var id = $(this).val();
       // Empty the dropdown
       $('#sel_emp').find('option').not(':first').remove();
       // AJAX request 
       $.ajax({
         url: 'getProvince/'+id,
         type: 'get',
         dataType: 'json',
         success: function(response){
           var len = 0;
           if(response['data'] != null){
              len = response['data'].length;
           }
           if(len > 0){
              // Read data and create <option>
              for(var i=0; i<len; i++){
                var province_name = response['data'][i].province_name;
                var id = response['data'][i].id;
                var option = "<option value='"+id+"'>"+province_name+"</option>";
                $("#sel_emp").append(option); 
              }
           }
         }
       });
    });
});
</script>
<script type='text/javascript'>
    $(document).ready(function(){
        // Department Change
        $('#sel_emp').change(function(){
           // Department id
           var id = $(this).val();
           // Empty the dropdown
           $('#sel_emp1').find('option').not(':first').remove();
           // AJAX request 
           $.ajax({
             url: 'getCities/'+id,
             type: 'get',
             dataType: 'json',
             success: function(response){
               var len = 0;
               if(response['data'] != null){
                  len = response['data'].length;
               }
               if(len > 0){
                  // Read data and create <option>
                  for(var i=0; i<len; i++){
                    var city_name = response['data'][i].city_name;
                    var id = response['data'][i].id;
                    var option = "<option value='"+id+"'>"+city_name+"</option>";
                    $("#sel_emp1").append(option); 
                  }
               }
             }
           });
        });
    });
    </script>
<script>
    $(document).ready(function() {
      $('#dataTable').DataTable();
      $('#dataTable').on('click', '.deletbtn', function() {
          $tr = $(this).closest('tr');

          var data = $tr.children("td").map(function() {
            return $(this).text();
          }).get(); 

          // console.log(data);

          $('#delete_branch_id').val(data[0]);
          $('#deleteModalForm').attr('action', '/delete_branch/'+data[0]);
          $('#deleteModalPop').modal('show');
        });
    });
</script>
@endsection