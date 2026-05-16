<?php

namespace App\Http\Controllers;

use App\Models\DeliveryCenter;
use App\Models\Driver;
use App\Models\Order;
use App\Models\Route;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OrderWebController extends Controller
{
    public function index(): View
    {
        return view('orders.index', [
            'orders' => Order::with(['deliveryCenter', 'driver', 'route'])->latest()->paginate(10),
        ]);
    }

    public function create(): View
    {
        return view('orders.create', [
            'centers' => DeliveryCenter::where('status', 'active')->orderBy('name')->get(),
            'drivers' => Driver::where('status', '!=', 'offline')->orderBy('name')->get(),
            'routes' => Route::orderBy('route_name')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validatedData($request);
        $data['order_number'] = 'ORD-' . str_pad(Order::max('id') + 1, 3, '0', STR_PAD_LEFT);

        Order::create($data);

        return redirect()->route('orders.index')->with('success', 'Order created successfully.');
    }

    public function show(Order $order): View
    {
        $order->load(['deliveryCenter', 'driver', 'route']);

        return view('orders.show', compact('order'));
    }

    public function edit(Order $order): View
    {
        return view('orders.edit', [
            'order' => $order,
            'centers' => DeliveryCenter::where('status', 'active')->orderBy('name')->get(),
            'drivers' => Driver::where('status', '!=', 'offline')->orderBy('name')->get(),
            'routes' => Route::orderBy('route_name')->get(),
        ]);
    }

    public function update(Request $request, Order $order): RedirectResponse
    {
        $order->update($this->validatedData($request, $order));

        return redirect()->route('orders.index')->with('success', 'Order updated successfully.');
    }

    public function destroy(Order $order): RedirectResponse
    {
        $order->delete();

        return redirect()->route('orders.index')->with('success', 'Order deleted successfully.');
    }

    private function validatedData(Request $request, ?Order $order = null): array
    {
        return $request->validate([
            'customer_name' => ['required', 'string', 'max:255'],
            'customer_phone' => ['required', 'string', 'max:30'],
            'customer_email' => ['nullable', 'email', 'max:255'],
            'delivery_address' => ['required', 'string', 'max:500'],
            'items_summary' => ['nullable', 'string', 'max:500'],
            'status' => ['required', 'in:pending,assigned,picked_up,delivered'],
            'delivery_center_id' => ['required', 'exists:delivery_centers,id'],
            'driver_id' => ['nullable', 'exists:drivers,id'],
            'route_id' => ['nullable', 'exists:routes,id'],
        ]);
    }
}
