<?php

namespace App\Services;

use App\Models\Route;
use App\Models\RouteStop;
use App\Models\Order;

class DeliveryMetricsService
{
    /**
     * Calculate route efficiency metrics
     */
    public function getRouteMetrics(Route $route)
    {
        $totalStops = $route->total_stops;
        $totalDistance = $route->total_distance_km;
        $totalTime = $this->getTotalTime($route);

        return [
            'route_id' => $route->id,
            'total_distance_km' => $totalDistance,
            'total_stops' => $totalStops,
            'completed_stops' => $route->completed_stops,
            'pending_stops' => $totalStops - $route->completed_stops,
            'distance_per_stop' => $totalStops > 0 ? round($totalDistance / $totalStops, 2) : 0,
            'time_per_stop_minutes' => $totalTime > 0 ? round($totalTime / $totalStops, 2) : 0,
            'total_time_minutes' => $totalTime,
            'efficiency_score' => $this->calculateEfficiency($totalDistance, $totalStops, $totalTime),
            'utilization_rate' => $this->calculateUtilization($route),
            'on_time_rate' => $this->calculateOnTimeRate($route),
        ];
    }

    /**
     * Calculate delivery center metrics
     */
    public function getCenterMetrics($centerId)
    {
        $routes = Route::where('delivery_center_id', $centerId)->get();
        $orders = Order::where('delivery_center_id', $centerId)->get();

        $totalDistance = $routes->sum('total_distance_km');
        $totalDeliveries = $orders->where('status', 'delivered')->count();
        $failedDeliveries = $orders->where('status', 'failed')->count();
        $totalOrders = $orders->count();

        return [
            'center_id' => $centerId,
            'total_routes' => $routes->count(),
            'active_routes' => $routes->where('status', 'in_progress')->count(),
            'completed_routes' => $routes->where('status', 'completed')->count(),
            'total_orders' => $totalOrders,
            'delivered_orders' => $totalDeliveries,
            'failed_orders' => $failedDeliveries,
            'pending_orders' => $orders->where('status', 'pending')->count(),
            'total_distance_km' => round($totalDistance, 2),
            'average_distance_per_route' => $routes->count() > 0 ? round($totalDistance / $routes->count(), 2) : 0,
            'delivery_success_rate' => $totalOrders > 0 ? round((($totalDeliveries / $totalOrders) * 100), 2) : 0,
            'failure_rate' => $totalOrders > 0 ? round((($failedDeliveries / $totalOrders) * 100), 2) : 0,
        ];
    }

    /**
     * Calculate driver performance metrics
     */
    public function getDriverMetrics($driverId)
    {
        $routes = Route::where('driver_id', $driverId)->get();
        $orders = Order::whereHas('routeStop', function ($query) use ($driverId) {
            $query->whereHas('route', function ($q) use ($driverId) {
                $q->where('driver_id', $driverId);
            });
        })->get();

        $totalDistance = $routes->sum('total_distance_km');
        $totalStops = $routes->sum('total_stops');
        $completedStops = $routes->sum('completed_stops');

        return [
            'driver_id' => $driverId,
            'total_routes' => $routes->count(),
            'completed_routes' => $routes->where('status', 'completed')->count(),
            'total_deliveries' => $completedStops,
            'total_distance_km' => round($totalDistance, 2),
            'average_distance_per_route' => $routes->count() > 0 ? round($totalDistance / $routes->count(), 2) : 0,
            'average_stops_per_route' => $routes->count() > 0 ? round($totalStops / $routes->count(), 2) : 0,
            'completion_rate' => $totalStops > 0 ? round((($completedStops / $totalStops) * 100), 2) : 0,
            'performance_score' => $this->calculateDriverScore($driverId),
        ];
    }

    /**
     * Get delivery time window compliance
     */
    public function getComplianceMetrics(Route $route)
    {
        $stops = $route->stops()->with('order')->get();
        $onTimeCount = 0;
        $lateCount = 0;

        foreach ($stops as $stop) {
            if ($stop->status === 'completed' && $stop->actual_arrival && $stop->order) {
                $orderEnd = $stop->order->time_window_end;
                if ($stop->actual_arrival->format('H:i:s') <= $orderEnd) {
                    $onTimeCount++;
                } else {
                    $lateCount++;
                }
            }
        }

        $total = $onTimeCount + $lateCount;

        return [
            'route_id' => $route->id,
            'total_stops' => $stops->count(),
            'on_time_deliveries' => $onTimeCount,
            'late_deliveries' => $lateCount,
            'on_time_rate' => $total > 0 ? round((($onTimeCount / $total) * 100), 2) : 0,
        ];
    }

    /**
     * Calculate efficiency score
     */
    private function calculateEfficiency($distance, $stops, $time)
    {
        if ($stops === 0 || $distance === 0) {
            return 0;
        }

        $distanceScore = 1 / ($distance / $stops); // Lower distance per stop = higher score
        $timeScore = 1 / ($time / $stops); // Lower time per stop = higher score
        $stopsScore = $stops / 20; // Benchmark: 20 stops per route

        return round((($distanceScore + $timeScore + $stopsScore) / 3) * 100, 2);
    }

    /**
     * Calculate vehicle utilization rate
     */
    private function calculateUtilization(Route $route)
    {
        $vehicle = $route->vehicle;
        $weightUtilization = ($route->total_weight_kg / $vehicle->capacity_kg) * 100;
        $volumeUtilization = ($route->total_volume_cbm / $vehicle->capacity_cbm) * 100;

        return round(($weightUtilization + $volumeUtilization) / 2, 2);
    }

    /**
     * Calculate on-time delivery rate
     */
    private function calculateOnTimeRate(Route $route)
    {
        $compliance = $this->getComplianceMetrics($route);
        return $compliance['on_time_rate'];
    }

    /**
     * Get total route time in minutes
     */
    private function getTotalTime(Route $route)
    {
        if (!$route->start_time || !$route->end_time) {
            return 0;
        }

        return $route->end_time->diffInMinutes($route->start_time);
    }

    /**
     * Calculate driver performance score
     */
    private function calculateDriverScore($driverId)
    {
        $routes = Route::where('driver_id', $driverId)->get();
        
        if ($routes->isEmpty()) {
            return 0;
        }

        $completionRate = 0;
        foreach ($routes as $route) {
            $compliance = $this->getComplianceMetrics($route);
            $completionRate += $compliance['on_time_rate'];
        }

        return round($completionRate / $routes->count(), 2);
    }
}
