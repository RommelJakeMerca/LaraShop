@extends('layouts.main_admin_master')
@section('title')
    LS | Client Users
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
      <div class="card card-tasks">
        <div class="card-header ">
          <h5 class="card-category">Client Users List</h5>
        </div>
        <div class="card-body ">
          <div class="table-full-width table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Email</th>
                        <th>Gender</th>
                        <th>Address</th>
                        <th>Number</th>
                        <th>ProvID</th>
                        <th>Details</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($client_users as $row)
                    <tr>
                        <td class="text">{{ $row->id }}</td>
                        <td class="text-left">{{ $row->email }}</td>
                        <td class="text-left">{{ $row->gender }}</td>
                        <td class="text-left">{{ $row->address }}</td>
                        <td class="text-left">{{ $row->contact_number }}</td>
                        <td class="text-left">{{ $row->provider_id }}</td>
                        <td class="td-actions text-right" style="display: flex;">
                            <a href="/client_details/{{ $row->id }}" class="btn btn-warning btn-circle">
                                <i class="fas fa-info-circle" style="color: #fff;"></i>
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