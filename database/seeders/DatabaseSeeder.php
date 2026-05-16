<?php

namespace Database\Seeders;

use App\Models\DeliveryCenter;
use App\Models\Driver;
use App\Models\Order;
use App\Models\Route;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Demo User',
            'email' => 'demo@example.com',
        ]);

        // ── Delivery Centers (Blinkit-style Dark Stores & Warehouses) ──
        $store1 = DeliveryCenter::create([
            'name' => 'FlashIn Store - Kukatpally',
            'location' => 'KPHB Colony, Kukatpally, Hyderabad, Telangana 500085',
            'phone' => '040-6789-0001',
            'email' => 'kukatpally@flashin.com',
            'type' => 'dark_store',
            'status' => 'active',
            'latitude' => 17.4947,
            'longitude' => 78.3996,
        ]);

        $store2 = DeliveryCenter::create([
            'name' => 'FlashIn Store - Ameerpet',
            'location' => 'Ameerpet Main Road, Ameerpet, Hyderabad, Telangana 500016',
            'phone' => '040-6789-0002',
            'email' => 'ameerpet@flashin.com',
            'type' => 'dark_store',
            'status' => 'active',
            'latitude' => 17.4375,
            'longitude' => 78.4483,
        ]);

        $store3 = DeliveryCenter::create([
            'name' => 'FlashIn Store - Gachibowli',
            'location' => 'Gachibowli Main Road, Gachibowli, Hyderabad, Telangana 500032',
            'phone' => '040-6789-0003',
            'email' => 'gachibowli@flashin.com',
            'type' => 'dark_store',
            'status' => 'active',
            'latitude' => 17.4401,
            'longitude' => 78.3489,
        ]);

        $warehouse1 = DeliveryCenter::create([
            'name' => 'FlashIn Warehouse - Banjara Hills',
            'location' => 'Road No. 12, Banjara Hills, Hyderabad, Telangana 500034',
            'phone' => '040-6789-0004',
            'email' => 'banjarahills@flashin.com',
            'type' => 'warehouse',
            'status' => 'active',
            'latitude' => 17.4156,
            'longitude' => 78.4347,
        ]);

        $store4 = DeliveryCenter::create([
            'name' => 'FlashIn Store - Madhapur',
            'location' => 'Ayyappa Society, Madhapur, Hyderabad, Telangana 500081',
            'phone' => '040-6789-0005',
            'email' => 'madhapur@flashin.com',
            'type' => 'dark_store',
            'status' => 'active',
            'latitude' => 17.4435,
            'longitude' => 78.3772,
        ]);

        // ── Drivers (Bike Delivery Partners) ──
        $driver1 = Driver::create([
            'delivery_center_id' => $store1->id,
            'name' => 'Rahul Sharma',
            'email' => 'rahul@flashin.com',
            'phone' => '98765-43210',
            'license_number' => 'TG-DL-1001',
            'vehicle_type' => 'Bike',
            'status' => 'active',
        ]);

        $driver2 = Driver::create([
            'delivery_center_id' => $store2->id,
            'name' => 'Priya Nair',
            'email' => 'priya@flashin.com',
            'phone' => '98765-43211',
            'license_number' => 'TG-DL-1002',
            'vehicle_type' => 'Scooter',
            'status' => 'active',
        ]);

        $driver3 = Driver::create([
            'delivery_center_id' => $warehouse1->id,
            'name' => 'Vikram Patel',
            'email' => 'vikram@flashin.com',
            'phone' => '98765-43212',
            'license_number' => 'TG-DL-1003',
            'vehicle_type' => 'Bike',
            'status' => 'active',
        ]);

        $driver4 = Driver::create([
            'delivery_center_id' => $store4->id,
            'name' => 'Arjun Kumar',
            'email' => 'arjun@flashin.com',
            'phone' => '98765-43213',
            'license_number' => 'TG-DL-1004',
            'vehicle_type' => 'Bike',
            'status' => 'active',
        ]);

        // ── Routes (short local delivery, all within same city) ──
        $route1 = Route::create([
            'route_name' => 'Kukatpally → Miyapur',
            'driver_id' => $driver1->id,
            'start_location' => 'KPHB Colony, Kukatpally, Hyderabad',
            'end_location' => 'Miyapur, Hyderabad',
            'start_lat' => 17.4947,
            'start_lng' => 78.3996,
            'end_lat' => 17.4969,
            'end_lng' => 78.3548,
            'estimated_distance' => 4.5,
            'estimated_time' => '12 mins',
            'status' => 'active',
        ]);

        $route2 = Route::create([
            'route_name' => 'Ameerpet → SR Nagar',
            'driver_id' => $driver2->id,
            'start_location' => 'Ameerpet Main Road, Hyderabad',
            'end_location' => 'SR Nagar, Hyderabad',
            'start_lat' => 17.4375,
            'start_lng' => 78.4483,
            'end_lat' => 17.4400,
            'end_lng' => 78.4533,
            'estimated_distance' => 1.8,
            'estimated_time' => '7 mins',
            'status' => 'active',
        ]);

        $route3 = Route::create([
            'route_name' => 'Gachibowli → Hitech City',
            'driver_id' => $driver1->id,
            'start_location' => 'Gachibowli, Hyderabad',
            'end_location' => 'Hitech City, Hyderabad',
            'start_lat' => 17.4401,
            'start_lng' => 78.3489,
            'end_lat' => 17.4435,
            'end_lng' => 78.3772,
            'estimated_distance' => 3.2,
            'estimated_time' => '10 mins',
            'status' => 'planned',
        ]);

        $route4 = Route::create([
            'route_name' => 'Banjara Hills → Jubilee Hills',
            'driver_id' => $driver3->id,
            'start_location' => 'Road No. 12, Banjara Hills, Hyderabad',
            'end_location' => 'Jubilee Hills, Hyderabad',
            'start_lat' => 17.4156,
            'start_lng' => 78.4347,
            'end_lat' => 17.4325,
            'end_lng' => 78.4070,
            'estimated_distance' => 3.8,
            'estimated_time' => '11 mins',
            'status' => 'active',
        ]);

        $route5 = Route::create([
            'route_name' => 'Madhapur → Kondapur',
            'driver_id' => $driver4->id,
            'start_location' => 'Ayyappa Society, Madhapur, Hyderabad',
            'end_location' => 'Kondapur, Hyderabad',
            'start_lat' => 17.4435,
            'start_lng' => 78.3772,
            'end_lat' => 17.4625,
            'end_lng' => 78.3541,
            'estimated_distance' => 3.0,
            'estimated_time' => '9 mins',
            'status' => 'completed',
        ]);

        // ── Orders (Blinkit-style: groceries, essentials, quick delivery) ──
        Order::create([
            'delivery_center_id' => $store1->id,
            'route_id' => $route1->id,
            'driver_id' => $driver1->id,
            'order_number' => 'ORD-001',
            'customer_name' => 'Amit Kumar',
            'customer_phone' => '98765-50001',
            'customer_email' => 'amit@example.com',
            'delivery_address' => 'Flat 203, Green Valley Apts, Miyapur, Hyderabad 500049',
            'items_summary' => 'Milk, Bread, Eggs, Butter',
            'status' => 'assigned',
        ]);

        Order::create([
            'delivery_center_id' => $store2->id,
            'route_id' => $route2->id,
            'driver_id' => $driver2->id,
            'order_number' => 'ORD-002',
            'customer_name' => 'Sneha Reddy',
            'customer_phone' => '98765-50002',
            'customer_email' => 'sneha@example.com',
            'delivery_address' => 'House No. 45, SR Nagar Colony, SR Nagar, Hyderabad 500038',
            'items_summary' => 'Rice 5kg, Dal, Cooking Oil',
            'status' => 'assigned',
        ]);

        Order::create([
            'delivery_center_id' => $store3->id,
            'route_id' => $route3->id,
            'order_number' => 'ORD-003',
            'customer_name' => 'Rajesh Verma',
            'customer_phone' => '98765-50003',
            'customer_email' => 'rajesh@example.com',
            'delivery_address' => 'Office 301, Tech Tower, Hitech City, Hyderabad 500081',
            'items_summary' => 'Cold Drinks, Chips, Snacks',
            'status' => 'pending',
        ]);

        Order::create([
            'delivery_center_id' => $warehouse1->id,
            'route_id' => $route4->id,
            'driver_id' => $driver3->id,
            'order_number' => 'ORD-004',
            'customer_name' => 'Pooja Singh',
            'customer_phone' => '98765-50004',
            'customer_email' => 'pooja@example.com',
            'delivery_address' => 'Flat 12, Jubilee Enclave, Jubilee Hills, Hyderabad 500033',
            'items_summary' => 'Fruits, Vegetables, Paneer',
            'status' => 'picked_up',
        ]);

        Order::create([
            'delivery_center_id' => $store4->id,
            'route_id' => $route5->id,
            'driver_id' => $driver4->id,
            'order_number' => 'ORD-005',
            'customer_name' => 'Khushi Patel',
            'customer_phone' => '98765-50005',
            'customer_email' => 'khushi@example.com',
            'delivery_address' => 'Plot 88, Kondapur Main Road, Kondapur, Hyderabad 500084',
            'items_summary' => 'Detergent, Soap, Shampoo',
            'status' => 'delivered',
        ]);
    }
}
