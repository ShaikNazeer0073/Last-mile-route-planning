<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label">Customer Name</label>
        <input name="customer_name" value="{{ old('customer_name', $order->customer_name ?? '') }}" class="form-control" placeholder="Amit Kumar" required>
        @error('customer_name')<span class="text-danger small">{{ $message }}</span>@enderror
    </div>
    <div class="col-md-3">
        <label class="form-label">Phone</label>
        <input name="customer_phone" value="{{ old('customer_phone', $order->customer_phone ?? '') }}" class="form-control" placeholder="98765-50001" required>
        @error('customer_phone')<span class="text-danger small">{{ $message }}</span>@enderror
    </div>
    <div class="col-md-3">
        <label class="form-label">Email</label>
        <input type="email" name="customer_email" value="{{ old('customer_email', $order->customer_email ?? '') }}" class="form-control" placeholder="customer@example.com">
        @error('customer_email')<span class="text-danger small">{{ $message }}</span>@enderror
    </div>
    <div class="col-12">
        <label class="form-label">Delivery Address</label>
        <input name="delivery_address" value="{{ old('delivery_address', $order->delivery_address ?? '') }}" class="form-control" placeholder="Flat 203, Green Valley Apts, Miyapur, Hyderabad" required>
        @error('delivery_address')<span class="text-danger small">{{ $message }}</span>@enderror
    </div>
    <div class="col-12">
        <label class="form-label">Items (e.g. Milk, Bread, Eggs)</label>
        <input name="items_summary" value="{{ old('items_summary', $order->items_summary ?? '') }}" class="form-control" placeholder="Milk, Bread, Eggs, Butter">
        @error('items_summary')<span class="text-danger small">{{ $message }}</span>@enderror
    </div>

    <div class="col-md-4">
        <label class="form-label">Delivery Partner</label>
        <select name="driver_id" class="form-select">
            <option value="">Unassigned</option>
            @foreach($drivers as $driver)
                <option value="{{ $driver->id }}" @selected(old('driver_id', $order->driver_id ?? '') == $driver->id)>{{ $driver->name }}</option>
            @endforeach
        </select>
        @error('driver_id')<span class="text-danger small">{{ $message }}</span>@enderror
    </div>
    <div class="col-md-4">
        <label class="form-label">Status</label>
        <select name="status" class="form-select" required>
            <option value="pending" @selected(old('status', $order->status ?? 'pending') === 'pending')>Pending</option>
            <option value="assigned" @selected(old('status', $order->status ?? '') === 'assigned')>Assigned</option>
            <option value="picked_up" @selected(old('status', $order->status ?? '') === 'picked_up')>Picked Up</option>
            <option value="delivered" @selected(old('status', $order->status ?? '') === 'delivered')>Delivered</option>
        </select>
        @error('status')<span class="text-danger small">{{ $message }}</span>@enderror
    </div>
    <div class="col-md-4">
        <label class="form-label">Route (optional)</label>
        <select name="route_id" class="form-select">
            <option value="">No route</option>
            @foreach($routes as $route)
                <option value="{{ $route->id }}" @selected(old('route_id', $order->route_id ?? '') == $route->id)>{{ $route->route_name }}</option>
            @endforeach
        </select>
        @error('route_id')<span class="text-danger small">{{ $message }}</span>@enderror
    </div>
</div>
<hr>
