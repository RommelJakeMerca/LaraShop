@extends('layouts.main_admin_master')
@section('title')
    LS | Approved Orders
@endsection
@section('content')
<link href="{{ asset('admin_assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
<!-- Page Heading -->
   <h1 class="h3 mb-2 text-gray-800">Approved Orders</h1>

   <!-- DataTales Example -->
   <div class="card shadow mb-4">
       <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Approved Orders Table </h6>
       </div>
       <div class="card-body">
           <div class="table-responsive">
               <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                   <thead>
                       <tr>
                            <th>ID</th>
                            <th>Client ID</th>
                            <th>Mode of Payment</th>
                            <th>Total Payment</th>
                            <th>Status</th>
                            <th>Details</th>
                       </tr>
                   </thead>
                   <tfoot>
                       <tr>
                            <th>ID</th>
                            <th>Client ID</th>
                            <th>Mode of Payment</th>
                            <th>Total Payment</th>
                            <th>Status</th>
                            <th>Details</th>
                       </tr>
                   </tfoot>
                   <tbody>
                    @foreach($approved_orders as $row)
                       <tr>
                           <td>{{ $row->id }}</td>
                           <td>{{ $row->client_id }}</td>
                           <td>{{ $row->mode_of_payment }}</td>
                           <td>{{ $row->total_payment }}</td>
                           <td>{{ $row->status }}</td>
                           <td><a href="/show_order_details/{{ $row->id }}" class="btn btn-success">Details</a></td>
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

          $('#delete_city_id').val(data[0]);
          $('#deleteModalForm').attr('action', '/delete_city/'+data[0]);
          $('#deleteModalPop').modal('show');
        });
    });
</script>
@endsection