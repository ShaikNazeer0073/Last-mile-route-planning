<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label">Route Name</label>
        <input name="route_name" value="{{ old('route_name', $route->route_name ?? '') }}" class="form-control" placeholder="Kukatpally → Miyapur" required>
        @error('route_name')<span class="text-danger small">{{ $message }}</span>@enderror
    </div>
    <div class="col-md-6">
        <label class="form-label">Delivery Partner</label>
        <select name="driver_id" class="form-select">
            <option value="">Unassigned</option>
            @foreach($drivers as $driver)
                <option value="{{ $driver->id }}" @selected(old('driver_id', $route->driver_id ?? '') == $driver->id)>{{ $driver->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-6">
        <label class="form-label">Start Location (Store / Warehouse)</label>
        <input name="start_location" value="{{ old('start_location', $route->start_location ?? '') }}" class="form-control" placeholder="KPHB Colony, Kukatpally, Hyderabad" required>
        @error('start_location')<span class="text-danger small">{{ $message }}</span>@enderror
    </div>
    <div class="col-md-6">
        <label class="form-label">End Location (Customer Area)</label>
        <input name="end_location" value="{{ old('end_location', $route->end_location ?? '') }}" class="form-control" placeholder="Miyapur, Hyderabad" required>
        @error('end_location')<span class="text-danger small">{{ $message }}</span>@enderror
    </div>
    <div class="col-md-3">
        <label class="form-label">Start Latitude</label>
        <input type="number" step="0.000001" name="start_lat" value="{{ old('start_lat', $route->start_lat ?? '') }}" class="form-control" placeholder="17.4947">
    </div>
    <div class="col-md-3">
        <label class="form-label">Start Longitude</label>
        <input type="number" step="0.000001" name="start_lng" value="{{ old('start_lng', $route->start_lng ?? '') }}" class="form-control" placeholder="78.3996">
    </div>
    <div class="col-md-3">
        <label class="form-label">End Latitude</label>
        <input type="number" step="0.000001" name="end_lat" value="{{ old('end_lat', $route->end_lat ?? '') }}" class="form-control" placeholder="17.4969">
    </div>
    <div class="col-md-3">
        <label class="form-label">End Longitude</label>
        <input type="number" step="0.000001" name="end_lng" value="{{ old('end_lng', $route->end_lng ?? '') }}" class="form-control" placeholder="78.3548">
    </div>
    <div class="col-md-4">
        <label class="form-label">Distance (km)</label>
        <input type="number" name="estimated_distance" value="{{ old('estimated_distance', $route->estimated_distance ?? '') }}" class="form-control" placeholder="4.5" step="0.1" min="0" required>
        @error('estimated_distance')<span class="text-danger small">{{ $message }}</span>@enderror
    </div>
    <div class="col-md-4">
        <label class="form-label">Estimated Time</label>
        <input name="estimated_time" value="{{ old('estimated_time', $route->estimated_time ?? '') }}" class="form-control" placeholder="12 mins" required>
        @error('estimated_time')<span class="text-danger small">{{ $message }}</span>@enderror
    </div>
    <div class="col-md-4">
        <label class="form-label">Route Status</label>
        <select name="status" class="form-select" required>
            <option value="">Select status</option>
            <option value="planned" @selected(old('status', $route->status ?? '') === 'planned')>Planned</option>
            <option value="active" @selected(old('status', $route->status ?? '') === 'active')>Active</option>
            <option value="completed" @selected(old('status', $route->status ?? '') === 'completed')>Completed</option>
        </select>
        @error('status')<span class="text-danger small">{{ $message }}</span>@enderror
    </div>
</div>
<hr>
