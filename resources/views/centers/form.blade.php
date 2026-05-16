<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label">Store Name</label>
        <input name="name" value="{{ old('name', $center->name ?? '') }}" class="form-control" placeholder="FlashIn Store - Kukatpally" required>
        @error('name')<span class="text-danger small">{{ $message }}</span>@enderror
    </div>
    <div class="col-md-6">
        <label class="form-label">Type</label>
        <select name="type" class="form-select" required>
            <option value="">Select type</option>
            <option value="dark_store" @selected(old('type', $center->type ?? '') === 'dark_store')>🏪 Dark Store</option>
            <option value="warehouse" @selected(old('type', $center->type ?? '') === 'warehouse')>📦 Warehouse</option>
            <option value="grocery_store" @selected(old('type', $center->type ?? '') === 'grocery_store')>🛒 Grocery Store</option>
        </select>
        @error('type')<span class="text-danger small">{{ $message }}</span>@enderror
    </div>
    <div class="col-12">
        <label class="form-label">Location / Address</label>
        <input name="location" value="{{ old('location', $center->location ?? '') }}" class="form-control" placeholder="KPHB Colony, Kukatpally, Hyderabad" required>
        @error('location')<span class="text-danger small">{{ $message }}</span>@enderror
    </div>
    <div class="col-md-4">
        <label class="form-label">Phone</label>
        <input name="phone" value="{{ old('phone', $center->phone ?? '') }}" class="form-control" placeholder="040-6789-0001">
        @error('phone')<span class="text-danger small">{{ $message }}</span>@enderror
    </div>
    <div class="col-md-4">
        <label class="form-label">Email</label>
        <input type="email" name="email" value="{{ old('email', $center->email ?? '') }}" class="form-control" placeholder="store@flashin.com">
        @error('email')<span class="text-danger small">{{ $message }}</span>@enderror
    </div>
    <div class="col-md-4">
        <label class="form-label">Status</label>
        <select name="status" class="form-select" required>
            <option value="active" @selected(old('status', $center->status ?? 'active') === 'active')>Active</option>
            <option value="inactive" @selected(old('status', $center->status ?? '') === 'inactive')>Inactive</option>
        </select>
        @error('status')<span class="text-danger small">{{ $message }}</span>@enderror
    </div>
    <div class="col-md-6">
        <label class="form-label">Latitude</label>
        <input type="number" step="0.000001" name="latitude" value="{{ old('latitude', $center->latitude ?? '') }}" class="form-control" placeholder="17.4947">
        @error('latitude')<span class="text-danger small">{{ $message }}</span>@enderror
    </div>
    <div class="col-md-6">
        <label class="form-label">Longitude</label>
        <input type="number" step="0.000001" name="longitude" value="{{ old('longitude', $center->longitude ?? '') }}" class="form-control" placeholder="78.3996">
        @error('longitude')<span class="text-danger small">{{ $message }}</span>@enderror
    </div>
</div>
<hr>
