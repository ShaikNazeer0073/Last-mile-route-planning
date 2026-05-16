<?php

namespace App\Http\Controllers;

use App\Models\DeliveryCenter;
use App\Models\Driver;
use App\Models\Order;
use App\Models\Route;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        return view('dashboard', [
            'totalOrders' => Order::count(),
            'deliveredOrders' => Order::where('status', 'delivered')->count(),
            'pendingOrders' => Order::where('status', 'pending')->count(),
            'assignedOrders' => Order::where('status', 'assigned')->count(),
            'activeDrivers' => Driver::where('status', 'active')->count(),
            'totalRoutes' => Route::count(),
            'totalDeliveryCenters' => DeliveryCenter::count(),
            'recentOrders' => Order::with(['deliveryCenter', 'driver'])->latest()->limit(5)->get(),
            'recentRoutes' => Route::with('driver')->latest()->limit(5)->get(),
        ]);
    }
}
