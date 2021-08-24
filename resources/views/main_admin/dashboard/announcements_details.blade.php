@extends('layouts.main_admin_master')
@section('title')
    LS | Announcement Details
@endsection
@section('content')
<div class="row">
    <div class="col-lg-7 mb-4">
        <div class="card shadow mb-4">
            <div class="d-sm-flex card-header py-3 justify-content-between align-items-center">
                <h6 class="mb-0 font-weight-bold text-info">Announcement Details - {{ $announcement->announcement_subject }}</h6>
                <a href="/show_dashboard_main" class="d-none d-sm-inline-block btn btn-sm btn-info shadow-lg">&larr; Return</a>
            </div>
            <div class="card-body">
                <div class="text-center">
                    <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 100%;"
                        src="/uploads/announcement_images/{{ $announcement->announcement_image }}" alt="...">
                   
                </div>
                <p>{{ $announcement->announcement_details }}</p>
                <hr>
                @if ($announcement->announcement_urgency == "Important")
                <div class="text-danger float-right font-weight-bold">{{ $announcement->announcement_urgency }}</div>
                @elseif ($announcement->announcement_urgency == "Urgent")
                    <div class="text-warning float-right font-weight-bold">{{ $announcement->announcement_urgency }}</div>
                @elseif ($announcement->announcement_urgency == "Neutral")
                    <div class="text-success float-right font-weight-bold">{{ $announcement->announcement_urgency }}</div>
                @endif
                
            </div>
        </div>
    </div>
    {{-- <div class="col-xl-5 col-lg-6">
        <div class="card shadow mb-4">
            <div
                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-info">Further Details</h6>
            </div>
            <div class="card-body">
                
            </div>
        </div>
    </div> --}}

</div>
@endsection

@section('scripts')
@endsection