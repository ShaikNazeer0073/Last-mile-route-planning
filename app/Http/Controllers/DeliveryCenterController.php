<?php

namespace App\Http\Controllers;

use App\Models\DeliveryCenter;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DeliveryCenterController extends Controller
{
    public function index(): View
    {
        return view('centers.index', [
            'centers' => DeliveryCenter::withCount('orders')->latest()->paginate(10),
        ]);
    }

    public function create(): View
    {
        return view('centers.create');
    }

    public function store(Request $request): RedirectResponse
    {
        DeliveryCenter::create($this->validatedData($request));

        return redirect()->route('centers.index')->with('success', 'Store added successfully.');
    }

    public function show(DeliveryCenter $center): View
    {
        $center->load(['orders.driver', 'drivers']);

        return view('centers.show', compact('center'));
    }

    public function edit(DeliveryCenter $center): View
    {
        return view('centers.edit', compact('center'));
    }

    public function update(Request $request, DeliveryCenter $center): RedirectResponse
    {
        $center->update($this->validatedData($request));

        return redirect()->route('centers.index')->with('success', 'Store updated successfully.');
    }

    public function destroy(DeliveryCenter $center): RedirectResponse
    {
        $center->delete();

        return redirect()->route('centers.index')->with('success', 'Store deleted successfully.');
    }

    private function validatedData(Request $request): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'location' => ['required', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:30'],
            'email' => ['nullable', 'email', 'max:255'],
            'type' => ['required', 'in:dark_store,warehouse,grocery_store'],
            'status' => ['required', 'in:active,inactive'],
            'latitude' => ['nullable', 'numeric'],
            'longitude' => ['nullable', 'numeric'],
        ]);
    }
}
