@extends('layouts.main_admin_master')

@section('title')
    LS | Dashboard
@endsection

@section('content')
    <!-- Modal for adding new announcement -->
    <div class="modal fade col-md-12" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Announcement</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('add_announcement') }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <style>
                    .form-control {
                        color: #333;
                    }
                    </style>
                    <div class="modal-body">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="inputGroupFile01" name="announcement_image">
                            <label class="custom-file-label" for="inputGroupFile01">Announcement Image</label>
                        </div>
                        <div class="form-group">
                            <label for="announcement_subject" class="col-form-label">Announcement Subject</label>
                            <input type="text" class="form-control" id="product_name" name="announcement_subject" placeholder="Announcement Subject">
                        </div>
                        <div class="form-group">
                            <label>Urgency</label>
                            <select name="announcement_urgency" id="announcement_urgency" class="form-control" style="appearance: none;">
                                <option value="" disabled selected>Select Urgency</option>
                                    <option value="Urgent">Urgent</option>
                                    <option value="Neutral">Neutral</option>
                                    <option value="Important">Important</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="message-text" class="col-form-label">Announcement Details:</label>
                            <textarea class="form-control" id="message-text" name="announcement_details"></textarea>
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

   <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard | Main</h1>
    </div>

    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Number of Users</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $clients+$admin_users }}</div>
                        </div>
                        <div class="col-auto">
                            <a href="/show_client_users" class="btn btn-primary" style="float: right; margin-left: 10px;">Users</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Number of Products</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $products }}</div>
                        </div>
                        <div class="col-auto">
                            <a href="/show_products" class="btn btn-success" style="float: right; margin-left: 10px;">Products</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Number Orders</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $orders }}</div>
                        </div>
                        <div class="col-auto">
                            <a href="/show_order_history" class="btn btn-info" style="float: right; margin-left: 10px;">Orders</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">For Approval</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $approvals }}</div>
                        </div>
                        <div class="col-auto">
                            <a href="/show_latest_order" class="btn btn-warning" style="float: right; margin-left: 10px;">Approvals</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-info">Announcements</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                            aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Actions</div>
                            <a class="dropdown-item" data-toggle="modal" data-target="#exampleModal" href="#">Add Announcement</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="/show_announcements">Go to Announcements</a>
                        </div>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="table-full-width table-responsive">
                        @if (count($announcements) == 0)
                            <div class="text-lg font-weight-bold text-uppercase mb-1 text-center" style="color: rgb(218, 214, 214); padding: 170px;">No Existing Announcements yet</div>
                        @endif
                        <table class="table" width="100%" cellspacing="0">
                            <tbody style="color: #fff;">
                                @foreach($announcements as $row)
                                @if ($row->announcement_urgency == "Important")
                                    <tr class="bg-danger">
                                @elseif ($row->announcement_urgency == "Urgent")
                                    <tr class="bg-warning">
                                @elseif ($row->announcement_urgency == "Neutral")
                                    <tr class="bg-success">
                                @endif
                                        <td><img src="/uploads/announcement_images/{{ $row->announcement_image }}" style="float: left; width: 250px; height: 100px; object-fit: cover;"></td>
                                        <td class="text-left">{{ $row->announcement_subject }}</td>
                                        <td class="text-left">{{ $row->announcement_urgency }}</td>
                                        <td class="td-actions text-right" style="display: flex;">
                                            <a href="/announcement_details/{{ $row->id }}" class="btn btn-circle">
                                                <i class="fas fa-info-circle" style="color: #Fff;"></i>
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

        <!-- Pie Chart -->
        <div class="col-xl-4 col-lg-6">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-info">Clients / Orders</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                            aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Actions</div>
                            <a class="dropdown-item" href="/show_client_users">Go to Clients</a>
                            <a class="dropdown-item" href="/show_order_history">Go to Orders</a>
                        </div>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-pie pt-4 pb-2">
                        @if ($clients == 0 && $orders == 0)
                            <div class="text-lg font-weight-bold text-uppercase mb-1 text-center" style="color: rgb(218, 214, 214); padding: 100px;">No data to show yet</div>
                        @endif
                        <canvas id="myPieChart_0"></canvas>
                    </div>
                    <hr>
                    <br><br>
                    <div class="mt-1 text-center small">
                        <span class="mr-2">
                            <i class="fas fa-circle text-success"></i> Clients
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle text-info"></i> Orders
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection     

@section('scripts')
<script>
    // Set new default font family and font color to mimic Bootstrap's default styling
    Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = '#858796';
    // Pie Chart Example
    var ctx = document.getElementById("myPieChart_0");
    var clients = {{ $clients }};
    var orders = {{ $orders }};
    var myPieChart_0 = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: ["Clients", "Orders"],
        datasets: [{
        data: [clients, orders],
        backgroundColor: [ '#1cc88a', '#36b9cc'],
        hoverBackgroundColor: ['#1cc88a', '#36b9cc'],
        hoverBorderColor: "rgba(234, 236, 244, 1)",
        }],
    },
    options: {
        maintainAspectRatio: false,
        tooltips: {
        backgroundColor: "rgb(255,255,255)",
        bodyFontColor: "#858796",
        borderColor: '#dddfeb',
        borderWidth: 1,
        xPadding: 15,
        yPadding: 15,
        displayColors: false,
        caretPadding: 10,
        },
        legend: {
        display: false
        },
        cutoutPercentage: 80,
    },
    });
</script>
@endsection