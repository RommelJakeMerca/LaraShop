<div>
    <form action="" method="POST" enctype="multipart/form-data" class="form-horizontal">
        {{ csrf_field() }}
        <div class="card-body">
            <div class="form-group">
                <div class="col-sm-10">
                    <label for="status">Select Class</label>
                    <select class="form-control" wire:model="selectedRegion">
                        <option value="">Select a Class</option>
                        @foreach ($regions as $item)
                        <option value="{{ $item->id }}">{{ $item->region_number }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            {{ $selectedRegion }}
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">Add Assignment</button>
            <div wire:loading>
                Hold On...
            </div>
        </div>
    </form>
</div>

<script>
    <script src="{{ asset('livewire_assets/backend/js/app/jquery.min.js') }}"></script>
    <script src="{{ asset('livewire_assets/backend/js/app/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('livewire_assets/backend/js/app/adminlte.min.js') }}"></script>
    <script src="{{ asset('livewire_assets/pace.min.js') }}"></script>
</script>
