@extends('layouts.main_admin_master')
@section('title')
    LS | Announcements
@endsection
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<link href="{{ asset('admin_assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
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
            <input type="hidden" name="id" class="form-control" id="delete_announcement_id" disabled>
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
   <h1 class="h3 mb-2 text-gray-800">Announcements</h1>
   <p class="mb-4">Here you can add, view, edit, and delete</p>

   <!-- DataTales Example -->
   <div class="card shadow mb-4">
       <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-info">Announcements Table </h6>
       </div>
       <div class="card-body">
           <div class="table-responsive">
               <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                   <thead>
                       <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Urgency</th>
                            <th>Subject</th>
                            <th>Details</th>
                            <th>Edit</th>
                            <th>Delete</th>
                       </tr>
                   </thead>
                   <tfoot>
                       <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Urgency</th>
                            <th>Subject</th>
                            <th>Details</th>
                            <th>Edit</th>
                            <th>Delete</th>
                       </tr>
                   </tfoot>
                   <tbody>
                    @foreach($announcements as $row)
                       <tr>
                           <td>{{ $row->id }}</td>
                           <td><img src="/uploads/announcement_images/{{ $row->announcement_image }}" style="float: left; width: 250px; height: 100px; object-fit: cover;"></td>
                           <td>{{ $row->announcement_urgency }}</td>
                           <td>{{ $row->announcement_subject }}</td>
                           <td>{{ $row->announcement_details }}</td>
                           <td><a href="/announcement_update/{{ $row->id }}" class="btn btn-success">EDIT</a></td>
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

          $('#delete_announcement_id').val(data[0]);
          $('#deleteModalForm').attr('action', '/delete_announcement/'+data[0]);
          $('#deleteModalPop').modal('show');
        });
    });
</script>
@endsection