<?php

namespace Tests\Feature;

use App\Models\DeliveryCenter;
use App\Models\Driver;
use App\Models\Order;
use App\Models\Route;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SimpleWorkflowTest extends TestCase
{
    use RefreshDatabase;

    public function test_dashboard_loads(): void
    {
        $this->get('/')->assertOk()->assertSee('Dashboard');
    }

    public function test_can_create_order(): void
    {
        $center = DeliveryCenter::create([
            'name' => 'Test Hub',
            'address' => 'Test Address',
            'status' => 'active',
        ]);

        $this->post(route('orders.store'), [
            'delivery_center_id' => $center->id,
            'order_number' => 'ORD-TEST',
            'customer_name' => 'Test Customer',
            'customer_phone' => '555-0001',
            'customer_email' => 'customer@example.com',
            'delivery_address' => 'Customer Address',
            'status' => 'pending',
        ])->assertRedirect(route('orders.index'));

        $this->assertDatabaseHas('orders', [
            'order_number' => 'ORD-TEST',
            'status' => 'pending',
        ]);
    }

    public function test_route_assigns_orders_and_updates_delivery_status(): void
    {
        $center = DeliveryCenter::create([
            'name' => 'Test Hub',
            'address' => 'Test Address',
            'status' => 'active',
        ]);

        $driver = Driver::create([
            'delivery_center_id' => $center->id,
            'name' => 'Test Driver',
            'phone' => '555-0002',
            'license_number' => 'LIC-TEST',
            'status' => 'active',
        ]);

        $order = Order::create([
            'delivery_center_id' => $center->id,
            'order_number' => 'ORD-ROUTE',
            'customer_name' => 'Route Customer',
            'customer_phone' => '555-0003',
            'delivery_address' => 'Route Address',
            'status' => 'pending',
        ]);

        $this->post(route('routes.store'), [
            'route_code' => 'RT-TEST',
            'delivery_center_id' => $center->id,
            'driver_id' => $driver->id,
            'planned_date' => now()->toDateString(),
            'status' => 'in_progress',
            'order_ids' => [$order->id],
        ])->assertRedirect();

        $route = Route::where('route_code', 'RT-TEST')->first();

        $this->assertNotNull($route);
        $this->assertEquals($route->id, $order->fresh()->route_id);
        $this->assertEquals('out_for_delivery', $order->fresh()->status);
    }
}
