<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Models\Route;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RouteWebController extends Controller
{
    public function index(): View
    {
        return view('routes.index', [
            'routes' => Route::with(['driver', 'orders'])->latest()->paginate(10),
        ]);
    }

    public function create(): View
    {
        return view('routes.create', [
            'drivers' => Driver::where('status', '!=', 'offline')->orderBy('name')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        Route::create($this->validatedData($request));

        return redirect()->route('routes.index')->with('success', 'Route created successfully.');
    }

    public function show(Route $route): View
    {
        $route->load(['driver', 'orders']);

        return view('routes.show', compact('route'));
    }

    public function edit(Route $route): View
    {
        return view('routes.edit', [
            'route' => $route,
            'drivers' => Driver::where('status', '!=', 'offline')->orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, Route $route): RedirectResponse
    {
        $route->update($this->validatedData($request, $route));

        return redirect()->route('routes.index')->with('success', 'Route updated successfully.');
    }

    public function destroy(Route $route): RedirectResponse
    {
        $route->delete();

        return redirect()->route('routes.index')->with('success', 'Route deleted successfully.');
    }

    private function validatedData(Request $request, ?Route $route = null): array
    {
        return $request->validate([
            'route_name' => ['required', 'string', 'max:255'],
            'driver_id' => ['nullable', 'exists:drivers,_id'],
            'start_location' => ['required', 'string', 'max:500'],
            'end_location' => ['required', 'string', 'max:500'],
            'start_lat' => ['nullable', 'numeric'],
            'start_lng' => ['nullable', 'numeric'],
            'end_lat' => ['nullable', 'numeric'],
            'end_lng' => ['nullable', 'numeric'],
            'estimated_distance' => ['required', 'numeric', 'min:0'],
            'estimated_time' => ['required', 'string', 'max:100'],
            'status' => ['required', 'in:planned,active,completed'],
        ]);
    }
}
