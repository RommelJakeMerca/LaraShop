@extends('layouts.main_admin_master')
@section('title')
    LS | Announcement Update
@endsection
@section('content')
    <div class="card shadow mb-4 col-md-5">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-gray">Announcement | Update </h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                <form action="/announcement_update_action/{{ $announcement->id }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }} 
                    {{ method_field('PUT') }}
                    <div class="form-group">
                        <label>Click here to choose file</label>
                        <input style="cursor: pointer;" type="file" name="announcement_image" class="form-control">
                        <a style="color: red;" href="/uploads/announcement_images/{{ $announcement->announcement_image }}">View previous image - {{ $announcement->announcement_image }}</a>
                    </div>
                    <div class="form-group">
                        <label for="announcement_subject" class="col-form-label">Announcement Subject</label>
                        <input type="text" class="form-control" id="product_name" name="announcement_subject" placeholder="Announcement Subject" value="{{ $announcement->announcement_subject }}">
                    </div>
                    <div class="form-group">
                        <label>Urgency</label>
                        <select name="announcement_urgency" id="announcement_urgency" class="form-control" style="appearance: none;">
                            <option value="{{ $announcement->announcement_urgency }}" selected>{{ $announcement->announcement_urgency }}</option>
                                <option value="Urgent">Urgent</option>
                                <option value="Neutral">Neutral</option>
                                <option value="Important">Important</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label">Announcement Details:</label>
                        <textarea class="form-control" id="message-text" name="announcement_details">{{ $announcement->announcement_details }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-success">Update</button>
                    <a href="/show_announcements" class="btn btn-danger">Cancel</a>
                </form>
            </div>
            </div>
        </div>
    </div>
@endsection

{{-- this is what the master.blade.php scripts is calling --}}
@section('scripts')
    
@endsection