<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label">Driver Name</label>
        <input name="name" value="{{ old('name', $driver->name ?? '') }}" class="form-control" placeholder="Rahul Sharma" required>
        @error('name')<span class="text-danger small">{{ $message }}</span>@enderror
    </div>
    <div class="col-md-6">
        <label class="form-label">Phone</label>
        <input name="phone" value="{{ old('phone', $driver->phone ?? '') }}" class="form-control" placeholder="98765-43210" required>
        @error('phone')<span class="text-danger small">{{ $message }}</span>@enderror
    </div>
    <div class="col-md-6">
        <label class="form-label">Email</label>
        <input type="email" name="email" value="{{ old('email', $driver->email ?? '') }}" class="form-control" placeholder="driver@example.com">
        @error('email')<span class="text-danger small">{{ $message }}</span>@enderror
    </div>
    <div class="col-md-6">
        <label class="form-label">License Number</label>
        <input name="license_number" value="{{ old('license_number', $driver->license_number ?? '') }}" class="form-control" placeholder="TG-DL-1001">
        @error('license_number')<span class="text-danger small">{{ $message }}</span>@enderror
    </div>
    <div class="col-md-4">
        <label class="form-label">Vehicle Type</label>
        <select name="vehicle_type" class="form-select" required>
            <option value="Bike" @selected(old('vehicle_type', $driver->vehicle_type ?? '') === 'Bike')>🏍️ Bike</option>
            <option value="Scooter" @selected(old('vehicle_type', $driver->vehicle_type ?? '') === 'Scooter')>🛵 Scooter</option>
            <option value="Bicycle" @selected(old('vehicle_type', $driver->vehicle_type ?? '') === 'Bicycle')>🚲 Bicycle</option>
        </select>
        @error('vehicle_type')<span class="text-danger small">{{ $message }}</span>@enderror
    </div>
    <div class="col-md-4">
        <label class="form-label">Delivery Center</label>
        <select name="delivery_center_id" class="form-select">
            <option value="">None</option>
            @foreach($centers as $center)
                <option value="{{ $center->id }}" @selected(old('delivery_center_id', $driver->delivery_center_id ?? '') == $center->id)>{{ $center->name }}</option>
            @endforeach
        </select>
        @error('delivery_center_id')<span class="text-danger small">{{ $message }}</span>@enderror
    </div>
    <div class="col-md-4">
        <label class="form-label">Status</label>
        <select name="status" class="form-select" required>
            <option value="active" @selected(old('status', $driver->status ?? 'active') === 'active')>Active</option>
            <option value="busy" @selected(old('status', $driver->status ?? '') === 'busy')>Busy</option>
            <option value="offline" @selected(old('status', $driver->status ?? '') === 'offline')>Offline</option>
        </select>
        @error('status')<span class="text-danger small">{{ $message }}</span>@enderror
    </div>
</div>
<hr>
