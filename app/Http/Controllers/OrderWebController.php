<?php

namespace App\Http\Controllers;

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
            'orders' => Order::with(['driver', 'route'])->latest()->paginate(10),
        ]);
    }

    public function create(): View
    {
        return view('orders.create', [
            'drivers' => Driver::where('status', '!=', 'offline')->orderBy('name')->get(),
            'routes' => Route::orderBy('route_name')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validatedData($request);
        $data['order_number'] = 'ORD-' . str_pad(Order::count() + 1, 3, '0', STR_PAD_LEFT);

        Order::create($data);

        return redirect()->route('orders.index')->with('success', 'Order created successfully.');
    }

    public function show(Order $order): View
    {
        $order->load(['driver', 'route']);

        return view('orders.show', compact('order'));
    }

    public function edit(Order $order): View
    {
        return view('orders.edit', [
            'order' => $order,
            'drivers' => Driver::where('status', '!=', 'offline')->orderBy('name')->get(),
            'routes' => Route::orderBy('route_name')->get(),
        ]);
    }

    public function update(Request $request, Order $order): RedirectResponse
    {
        $order->update($this->validatedData($request, $order));

        return redirect()->route('orders.index')->with('success', 'Order updated successfully.');
    }

    public function updateStatus(Request $request, Order $order): RedirectResponse
    {
        $request->validate([
            'status' => ['required', 'in:pending,processing,out_for_delivery,delivered'],
        ]);

        $order->update(['status' => $request->status]);

        return back()->with('success', 'Order status updated to ' . ucfirst(str_replace('_', ' ', $request->status)));
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
            'status' => ['required', 'in:pending,processing,out_for_delivery,delivered,assigned,picked_up'],
            'driver_id' => ['nullable', 'exists:drivers,_id'],
            'route_id' => ['nullable', 'exists:routes,_id'],
        ]);
    }
}
