<?php

namespace App\Http\Controllers;

use App\Models\DeliveryCenter;
use App\Models\Driver;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DriverWebController extends Controller
{
    public function index(): View
    {
        return view('drivers.index', [
            'drivers' => Driver::with('deliveryCenter')->paginate(10),
        ]);
    }

    public function create(): View
    {
        return view('drivers.create', [
            'centers' => DeliveryCenter::where('status', 'active')->orderBy('name')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        Driver::create($this->validatedData($request));

        return redirect()->route('drivers.index')->with('success', 'Driver created successfully.');
    }

    public function show(Driver $driver): View
    {
        $driver->load(['orders', 'routes', 'deliveryCenter']);

        return view('drivers.show', compact('driver'));
    }

    public function edit(Driver $driver): View
    {
        return view('drivers.edit', [
            'driver' => $driver,
            'centers' => DeliveryCenter::where('status', 'active')->orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, Driver $driver): RedirectResponse
    {
        $driver->update($this->validatedData($request, $driver));

        return redirect()->route('drivers.index')->with('success', 'Driver updated successfully.');
    }

    public function destroy(Driver $driver): RedirectResponse
    {
        $driver->delete();

        return redirect()->route('drivers.index')->with('success', 'Driver deleted successfully.');
    }

    private function validatedData(Request $request, ?Driver $driver = null): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:30'],
            'email' => ['nullable', 'email', 'max:255'],
            'license_number' => ['nullable', 'string', 'max:50'],
            'vehicle_type' => ['required', 'string', 'max:255'],
            'delivery_center_id' => ['nullable', 'exists:delivery_centers,id'],
            'status' => ['required', 'in:active,busy,offline'],
        ]);
    }
}
